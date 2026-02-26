<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">管理者帳號管理</p>
    <form method="post" action="./api/edit.php?table=<?=$do;?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="45%">帳號</td>
                    <td width="45%">密碼</td>
                    <td>刪除</td>
                </tr>
                <?php
                    $rows=$Admin->all();
                    foreach($rows as $row):
                    // echo '<pre>';
                    // print_r($rows);
                    // echo '</pre>';                      
                ?>
                <tr>
                    <td>
                        <input type="text" name='acc[<?=$row['id'];?>]' value="<?=$row['acc'];?>">
                    </td>
                    <td>
                        <input type="password" name='pw[<?=$row['id'];?>]' value="<?=$row['pw'];?>">
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
            <table style="margin-top:40px; width:70%;">
                    <tbody>
                        <tr>
                            <td width="200px">
                                <input type="button"
                                    onclick="op('#cover','#cvr','./modal/<?=$do;?>.php?table=<?=$do;?>')"
                                    value="新增管理者帳號">
                            </td>
                            <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                            </td>
                        </tr>
                    </tbody>
            </table>

        </table>

    </form>
</div>