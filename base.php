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

    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->pw);
    }
        

    public function all(...$arg){
        $sql="select * from $this->table ";
        if(!empty($arg[0]) && is_array($arg[0])){
           foreach($arg[0] as $key => $value){
                $tmp[]=sprintf("`%s` = '%s'",$key,$value);
           } 
           // 肯定修正：加上 " WHERE "
           $sql .= " WHERE " . implode(" && ",$tmp);
        }
        if(!empty($arg[1])){
            $sql .= " " . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(...$arg){
       $sql="select count(*) from $this->table " ;
       if(!empty($arg[0]) && is_array($arg[0])){
            foreach($arg[0] as $key => $value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            // 肯定修正：加上 " WHERE "
            $sql .= " WHERE " . implode(" && ",$tmp);
       }
       if(!empty($arg[1])){
            $sql .= " " . $arg[1];
       }
       // 修正：count 應該回傳單一數值
       return $this->pdo->query($sql)->fetchColumn();
    }

    public function find($arg){
        $sql="select * from $this->table ";

        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[]=sprintf("`%s` ='%s'",$key,$value);
            }
            $sql=$sql . " where " . implode(" && ",$tmp);
        }else{
            $sql= $sql . " where `id`='$arg'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($arg){
        $sql="delete from $this->table ";

        if(is_array($arg)){
            foreach($arg as $key => $value){
                $tmp[]=sprintf("`%s` ='%s'",$key,$value);
            }
            $sql=$sql . " where " . implode(" && ",$tmp);
        }else{
            $sql= $sql . " where `id`='$arg'";
        }
        return $this->pdo->exec($sql);
    }
    public function save($arg){
        if(!empty($arg['id'])){
            $tmp = []; // 確保陣列初始化
            foreach($arg as $key => $value){
                if($key != 'id'){

                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
            }
            $sql="update `$this->table` set " . implode(",",$tmp) . " where `id` = '".$arg['id']."'";
        }else{
            $sql="insert into `$this->table` (`".implode("`,`",array_keys($arg))."`) values('".implode("','",$arg)."')";
            // echo "<pre>";
            // print_r($arg);
            // echo "</pre>";
            // exit;
        }
        // 這行 echo 會顯示在頁面上，如果不成功，請複製這行 SQL 到資料庫執行看看

        return $this->pdo->exec($sql);
    }
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll();
    }


} 

function to($url){
    header("location:".$url);
}

$Title=new DB("title");
$Ad=new DB("ad");
$Mvim=new DB("mvim");
$Image=new DB("image");
$Total=new DB("total");
$Bottom=new DB("bottom");
$News=new DB("news");
$Admin=new DB("admin");
$Menu=new DB("menu");

// --- 標題與頁尾 ---
$title = $Title->find(['sh' => 1]);
$bottom = $Bottom->find(1);

// 如果資料庫沒資料，強制給一個預設結構
if (!$bottom) {
    $bottom = ['id' => 1, 'bottom' => '預設頁尾內容'];
}

// --- 進站人數處理 (重點修正) ---
$total = $Total->find(1);

if (!$total) {
    // 資料庫沒資料時，手動創一筆 id=1 的資料
    $total = ['id' => 1, 'total' => 0];
    $Total->save($total);
    // 確保變數現在有東西
}

if (empty($_SESSION['visited'])) {
    $total['total']++;
    $Total->save($total);
    // 儲存後重新讀取，確保資料同步
    $total = $Total->find(1);
    $_SESSION['visited'] = 1;
}

// 萬一 find(1) 還是失敗 (例如 ID 被跳過了)，補一個最後防線
if (!isset($total['total'])) {
    $total = ['total' => 0];
}

?>