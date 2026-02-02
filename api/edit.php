<?php
include_once "../base.php";

// 取得操作的資料表
$table = $_POST['table'];
$db = new DB($table);
// ✨ 改用 id[] 跑迴圈，這樣沒勾刪除也會執行更新！
if(isset($_POST['id'])){
    foreach($_POST['id'] as $key => $id){
        
        // 1. 判斷是否要刪除
        if(!empty($_POST['del']) && in_array($id, $_POST['del'])){
            $db->del($id);
        } else {
            // 2. 如果不刪除，就更新資料
            $data = $db->find($id);

            // 根據資料表類型處理更新內容
            switch($table){
                case "title":
                    $data['text'] = $_POST['text'][$key];
                    // Title 是單選 radio，直接比對 ID
                    $data['sh'] = ($id == $_POST['sh']) ? 1 : 0;
                break;
                case "admin":
                    $data['acc'] = $_POST['acc'][$key];
                    $data['pw'] = $_POST['pw'][$key];
                break;
                default:
                    // Ad, News, Mvim 等通常是複選 checkbox
                    $data['text'] = $_POST['text'][$key];
                    $data['sh'] = (!empty($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
                break;
            }
            // 3. 寫入資料庫
            $db->save($data);
        }
    }
}

to("../admin.php?do=$table");
?>