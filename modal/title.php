<div class="cent">新增標題區圖片</div>
<hr>
<form action="./api/insert.php?table=<?=$_GET['table'];?>" method="post" enctype="multipart/form-data">
     <table style="width:70%;margin:auto">
        <tr>
        <tr>
            <td>標題區圖片</td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        <tr>
            <td>標題區替代文字</td>
            <td><input type="text" name="text" id=""></td>
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