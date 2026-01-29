<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{
    private $table;
    private $dsn = "mysql:host=localhost;charset=utf8;dbname=db01";
    private $root = "root";
    private $pw = "";
    private $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, $this->root, $this->pw);
    }

    public function all(...$arg)
    {
        $sql = "select * from `$this->table` "; // 修正了空格與反引號
        if (!empty($arg[0]) && is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql .= " where " . implode(" && ", $tmp);
        }
        if (!empty($arg[1])) {
            $sql .="" . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($arg) {
        $sql = "select * from `$this->table` where ";
        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql .= implode(" && ", $tmp);
        } else {
            $sql .= " `id` = '$arg'"; 
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($arg) {
        $sql = "delete from `$this->table` where ";
        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql .= implode(" && ", $tmp);
        } else {
            $sql .= " `id` = '$arg'"; 
        }
        return $this->pdo->exec($sql);
    }

    public function save($arg) {
        if(!empty($arg['id'])){
            // Update 邏輯
            $tmp = [];
            foreach($arg as $key => $value){
                if($key != 'id'){
                    $tmp[] = sprintf("`%s` = '%s'", $key, $value);
                }
            }
            $sql = "update `$this->table` set " . implode(",", $tmp) . " where `id`='" . $arg['id'] . "'";
        } else {
            // Insert 邏輯 (防止 $sql 未定義)
            $keys = array_keys($arg);
            $sql = sprintf("insert into `%s` (`%s`) values ('%s')", 
                            $this->table, 
                            implode("`,`", $keys), 
                            implode("','", $arg));
        }
        return $this->pdo->exec($sql);
    }

    public function q($sql) {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

function to($url){
    header("location:".$url);
}

// 實例化物件 (注意大小寫一致性喔！)
$Title = new DB("title");
$Ad = new DB("ad");
$Mvim = new DB("mvim");
$Image = new DB("image");
$Total = new DB("total");
$Bottom = new DB("bottom");
$News = new DB("news");
$Admin = new DB("admin");
$Menu = new DB("menu");


// 抓取進站人數
$total = $Total->find(1);
if(!$total){ // 如果沒資料，我們幫它生一個預設值，才不會報錯喔
    $total = ['total' => 0];
}

// 抓取頁尾版權 (也要抓喔！不然 admin.php 會找不到 $bottom)
$bottom = $Bottom->find(1);
if(!$bottom){
    $bottom = ['bottom' => ''];
}

// 訪客計數邏輯
if(empty($_SESSION['visited'])){
    // 只有在 $total 真的存在於資料庫時才加 1
    if(isset($total['id'])){
        $total['total']++;
        $Total->save($total);
    }
    $_SESSION['visited'] = 1;
}
?>