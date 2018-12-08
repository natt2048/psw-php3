<?php
require_once 'db_connect_psw.php';

$onlyTh = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmtQuery = "SELECT * FROM users";
    $filterArray = array_filter($_POST);
    $count = count($filterArray);
    $i = 0;
    $paramsType = [];
    $paramsFilter = [];
    if ($count > 0) {
        $stmtQuery .= ' WHERE ';
    }
    foreach ($filterArray as $key => $filter) {
        $stmtQuery .= $key . " LIKE ?";
        if ($count > 1 && $i++ < $count - 1) {
            $stmtQuery .= ' AND ';
        }
        $paramsType[] = 's';
        $paramsFilter[] = $filter;
    }
//    var_dump($stmtQuery);

    $stmt = $conn->prepare($stmtQuery);
    if (!empty($paramsFilter)) {
        $stmt->bind_param(implode($paramsType, ''), ...$paramsFilter);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $dbRow = $result instanceof mysqli_result ? $result->fetch_all(MYSQLI_ASSOC) : [];
//    var_dump($_POST);
    if (empty($dbRow)) {
        foreach ($_POST as $key => $filter) {
            $dbRow[0][$key] = $filter;
            $onlyTh = true;
        }
    }
} else {
    $stmt = $conn->query("SELECT * FROM users");
    $dbRow = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
}
?>

<table border="1 solid">
    <form method="POST">
        <tr>
            <?php foreach (array_keys($dbRow[0]) as $key): ?>
                <th><?= $key; ?>&nbsp;<input id="<?= $key; ?>" type="text" name="<?= $key; ?>"
                                             value="<?= isset($_POST[$key]) ? $_POST[$key] : ''; ?>"></th>
            <?php endforeach; ?>
            <th>
                <button type="submit">Filtruj</button>
                <button type="reset">Wyczyść zmiany</button>
            </th>
        </tr>
    </form>
    <?php if (!$onlyTh): ?>
        <?php foreach ($dbRow as $key => $user): ?>
            <tr>
                <?php foreach ($user as $column => $value): ?>
                    <td><?= $value; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>