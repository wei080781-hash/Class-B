

<!-- 這第一版本 -->
<!-- <?php  
switch($_GET['do']){
    case "title":
        include "./back/title.php";
        break;
    case "image":
        include "./back/image.php";
        break;
    case "total":
        include "./back/total.php";
        break;
    case "bottom":
        include "./back/bottom.php";
        break;
    case "news":
        include "./back/new.php";
        break;
    case "admin":
        include "./back/admin.php";
        break;
    case "menu":
        include "./back/menu.php";
        break;
    default:
        include "./back/title.php";                            

}
?> -->

<!-- 第二版(新版) -->
 <?php  
switch($_GET['do']){
    case "title":
?>
<form action="?" method="post">
    <table>
        <tr>
            <td>標題區圖片</td>
            <td><input type="file" name="title_img" id=""></td>
        </tr>
        <tr>
            <td>標題區替代文字</td>
            <td><input type="text" name="alt" id=""></td>
        </tr>
    </table>
</form>
        
  <?php      
        break;
    case "image":
        include "./back/image.php";
        break;
    case "total":
        include "./back/total.php";
        break;
    case "bottom":
        include "./back/bottom.php";
        break;
    case "news":
        include "./back/new.php";
        break;
    case "admin":
        include "./back/admin.php";
        break;
    case "menu":
        include "./back/menu.php";
        break;
    default:
        include "./back/title.php";                            

}
?>