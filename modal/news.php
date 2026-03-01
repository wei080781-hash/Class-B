<div class="cent">新增最新消息</div>
<hr>
<form action="./api/insert.php?table=<?=$_GET['table'];?>" method="post" enctype="multipart/form-data">
    <table style="width:70%;margin:auto">
        <tr>
            <td>最新消息資料</td>
            <td>
                <textarea name="text" id="" style="width:75%;height:100px"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </td>
            <td></td>
        </tr>
    </table>
</form>