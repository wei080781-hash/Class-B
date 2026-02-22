  <div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
        <p class="t cent botli">校園映象資料管理</p>
        <form method="post" action="./api/edit.php?table=<?=$do;?>">
          <table width="100%">  
                <tbody>
                    <tr class="yel">
                        <td width="68%">校園映象資料</td>
                        <td width="7%">顯示</td>
                        <td width="7%">刪除</td>
                        <td></td>
                    </tr>
                    <?php
                        $total=$Image->count();
                        $div=3;
                        $pages=ceil($total/$div);
                        $now=$_GET['p']??1;
                        $start=($now-1)*$div;
                        $rows=$Image->all(" limit $start,$div");
                        foreach($rows as $row):
                    ?>
                    <tr>
                        <td width="68%">
                        <img src="./upload/<?=$row['img'];?>" style="width:100px;height:68px;">
                        <input type="hidden" name='id[]' value="<?=$row['id'];?>"> 
                        </td>
                        <td width="7%">
                            <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?"checked":"";?>>   
                        </td>
                        <td width="7%">
                            <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                        </td>
                        <td>
                        <input type="button" value="更換圖片" 
                            onclick="op('#cover','#cvr','./modal/update.php?table=<?=$do;?>&id=<?=$row['id'];?>')">
                        </td>               
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody> 
            </table>








        </from>
    </div
>