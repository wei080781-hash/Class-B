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
        $sql = "select * from $this -> table ";
        if (!empty($arg[0] && is_array($arg[0]))) {
            foreach ($arg[0] as $sky => $value) {
                $tmp[] = sprintf("`%s` ='%s'", $key, $value);
            }
            $sql = $sql . implode(" && ", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll();
    }
    public function count(...$arg)
     {
        $sql = "select count * from $this -> table ";
        if (!empty($arg[0] && is_array($arg[0]))) {
            foreach ($arg[0] as $sky => $value) {
                $tmp[] = sprintf("`%s` ='%s'", $key, $value);
            }
            $sql = $sql . implode(" && ", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll();
    }
    public function find($arg) {}

    public function del($arg) {}
    public function save($arg) {}
    public function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll();
    }
}

function to($url)
{
    header("location:" . $url);
}