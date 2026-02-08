<?php
include_once "base.php"; // 載入 base.php 以取得 DB 類別和 $Bottom 物件

echo "<pre>";
echo "<h2>檢查 \$bottom 變數內容：</h2>";
var_dump($bottom);
echo "</pre>";

echo "<hr>";

echo "<h2>檢查 bottom 資料表所有資料：</h2>";
$allBottomData = $Bottom->all();
var_dump($allBottomData);
echo "</pre>";
?>