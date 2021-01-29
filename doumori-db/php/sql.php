<?php

// ユーザ情報取得
require_once('mysql_login.php');

// データベース情報
if($_POST['database']=='acnl'){
    $dsn = 'mysql:host=mysql5.star.ne.jp;dbname=ruricomugi_acnl;charset=utf8';
}else if($_POST['database']=='acnh'){
    $dsn = 'mysql:host=mysql5.star.ne.jp;dbname=ruricomugi_acnh;charset=utf8';
}

// if($_POST['database']=='acnl'){
//     $dsn = 'mysql:host=localhost;dbname=acnl;charset=utf8';
// }else if($_POST['database']=='acnh'){
//     $dsn = 'mysql:host=localhost;dbname=acnh;charset=utf8';
// }



// データベースに接続
try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
} catch (PDOException $e) {
    exit('データベース接続失敗 ' . $e->getMessage());
}

// PDOクラスをインスタンス化
$pdo = new PDO($dsn, $db_user, $db_pass);

// クエリのログ保存
$query_log = $_POST['query_log'];
$count = $pdo->exec($query_log);

// クエリ実行
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