<?php

require_once('../mysql_login.php');
try {
    $pdo = new PDO($dsn_acnh, $db_user, $db_pass);
} catch (PDOException $e) {
    exit('データベース接続失敗 ' . $e->getMessage());
}

// PDOクラスをインスタンス化
$pdo = new PDO($dsn_acnh, $db_user, $db_pass);

// PDOStatementオブジェクトに結果セット保持
$sql =  $_POST['sql'];
$stmt = $pdo->query($sql);

// 値を取得
$results = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<div class="result">
<?php
if (count($results)>=1){
    $columns = array_keys($results[0]);
    ?>
    <table>
        <tr>
        <?php foreach ($columns as $column){ ?>
            <th><?php print_r($column); ?></th>
        <?php } ?>
        </tr>
        <?php foreach ($results as $result){ ?>
        <tr>
            <?php foreach ($result as $value){ ?>
                <td><?php print_r($value); ?></td>
            <?php } ?>
        <?php } ?>
        </tr>
    </table>
<?php 
} else {
    ?>
    <p>Empty set</p>
<?php } ?>
</div>