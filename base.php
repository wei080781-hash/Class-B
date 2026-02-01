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

$title=$Title->find(['sh'=>1]);
$bottom=$Bottom->find(1);
$total=$Total->find(1);
if(empty($_SESSION['visited'])){
    $total['total']++;
    $Total->save($total);
    $total=$Total->find(1);
    $_SESSION['visited']=1;
}

?>