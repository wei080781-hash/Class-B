<?php
session_start();
/***
 * 建立一個簡單的資料庫連接類別，使用 PDO 來進行資料庫操作
 * 包括連接資料庫、執行查詢、新增、更新、刪除等功能
 * @author Your Name
 * @version 1.0
 * @date 2025-12-12
 * 
 */

Class DB{
    private $dsn="mysql:host=localhost;dbname=db01;charset=utf8";
    private $table;
    private $pdo;
                                
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    public function all(...$arg){

        $sql="select * from `$this->table` ";
        
            if(isset($arg[0])){
                if(is_array($arg[0])){
                    //多條件
                    $tmp=$this->arrayToSql($arg[0]);
                    $sql .= " where " . implode(" && ",$tmp);
                }else{
                    //單條件
                    $sql .=$arg[0];
                }
            }

            if(isset($arg[1])){
                $sql .=$arg[1];
            }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id){
        $sql="select * from `$this->table` ";
                if(is_array($id)){
                    //多條件
                    $tmp=$this->arrayToSql($id);
                    $sql .= " where " . implode(" && ",$tmp);
                }else{
                    //單條件
                    $sql .= " where `id`='$id' ";
                }
          
        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array){
        if(isset($array['id'])){
            $this->update($array);
        }else{
            $this->insert($array);
        }

    }

    //計算符合條件的資料筆數
    function count(...$arg){
        $sql="select count(*) from `$this->table` ";
        
            if(isset($arg[0])){
                if(is_array($arg[0])){
                    //多條件
                    $tmp=$this->arrayToSql($arg[0]);
                    $sql .= " where " . implode(" && ",$tmp);
                }else{
                    //單條件
                    $sql .=$arg[0];
                }
            }

            if(isset($arg[1])){
                $sql .=$arg[1];
            }
        // echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    function update($array){
        $sql="UPDATE $this->table ";
        $tmp=$this->arrayToSql($array);
        $sql .=" SET ".join(", ",$tmp);
        $sql .=" WHERE id='{$array['id']}'";
        //$sql .=" WHERE id='$id'";
        
        //echo $sql;
        return $this->pdo->exec($sql);
    }

    function insert($array){

        $sql="INSERT INTO `{$this->table}` ";
        $keys=array_keys($array);
        $sql .="(`". join("`,`",$keys). "`)";
        $sql .=" VALUES ('". join("','",$array). "')";
        echo $sql;
        //echo "<hr>";
        return $this->pdo->exec($sql);

    }

    function del($id){
        $sql="DELETE from `$this->table` ";
                if(is_array($id)){
                    //多條件
                    $tmp=$this->arrayToSql($id);
                    $sql .= " where " . implode(" && ",$tmp);
                }else{
                    //單條件
                    $sql .= " where `id`='$id' ";
                }
          
       //echo $sql;
        return $this->pdo->exec($sql);
    }


    private function arrayToSql($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }

        return $tmp;
    }
}

function q($sql){
    $dsn="mysql:host=localhost;dbname=db01;charset=utf8";
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchALL(PDO::FETCH_ASSOC);
}


function to($url){
    header("location:".$url);
}


$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$News=new DB('news');
$Image=new DB('image');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Total=new DB('total');
$Bottom=new DB('bottom');


if(!isset($_SESSION['view'])){
    $_SESSION['view']=1;
    $total=$Total->find(1);
    $total['total']++;
    $Total->save($total);

}

?>