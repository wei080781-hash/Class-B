<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do;?>">
        <table width="100%">
            <tr class="yel">
                <td width="80%">最新消息資料</td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
                <td></td>
            </tr>
            <?php
                $total=$News->count();
                $div=5;
                $pages=ceil($total/$div);
                $now=$_GET['p']??1;
                $start=($now-1)*$div;
                $rows=$News->all(" limit $start,$div");
                foreach($rows as $row):
                echo '<pre>';
                print_r($rows);
                echo '<pre>';    
            ?>
            <?php
             endforeach
            ?>
        </table>
    </form>
</div>