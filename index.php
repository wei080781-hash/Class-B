<?php include_once "api/db.php";?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>卓越科技大學校園資訊系統</title>
    <?php include "head.php";?>
    <style> 
    .btn {
        text-align: center;
        margin: 5px auto;
    }
    </style>
</head>

<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
                onclick="cl(&#39;#cover&#39;)">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>

    <div id="main">
        <?php 
            $title=$Title->find(['sh'=>1]);
        ?>
        <a title="" href="<?=$title['text'];?>" href="index.php">
            <div class="ti" style="background:url('upload/<?=$title['img'];?>'); background-size:cover;"></div>
            <!--標題-->
        </a>
        <div id="ms">
            <div id="lf" style="float:left;">
                <div id="menuput" class="dbor">
                    <!--主選單放此-->
                    <span class="t botli">主選單區</span>
                    <?php
					    $mains=$Menu->all(['main_id'=>0,'sh'=>1]);
						foreach($mains as $main){
							 echo "<div class='mainmu'>";
							 echo "<a href='{$main['href']}'>{$main['text']}";
							 if($Menu->count(['main_id'=>$main['id']])>0){
								$subs=$Menu->all(['main_id'=>$main['id']]);
								echo "<div class='mw'>";
								foreach($subs as $sub){
                                    echo "<div class='mainmu2'>";
                                    echo "<a href='{$sub['href']}'>";
                                    echo $sub['text'];
                                    echo "</a>";
                                    echo "</div>";
                                }
								echo "</div>";
							}

							echo "</a>";
                            echo "</div>";
						}
                    ?>
                </div>
                <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    <span class="t">進站總人數 :
                        <?php
							$total=$Total->find(1);
                        	echo $total['total'];
                        ?>
                    </span>
                </div>
            </div>
            <?php 
					$do=$_GET['do']??"main";
					
					$file="./front/".$do.".php";
					
					if(file_exists($file)){
						include $file;
					}else{
						include "./front/main.php";
					}            
            ?>
            <div id="alt"
                style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
            </div>
            <script>
            $(".sswww").hover(
                function() {
                    $("#alt").html("" + $(this).children(".all").html() + "").css({
                        "top": $(this).offset().top - 50
                    })
                    $("#alt").show()
                }
            )
            $(".sswww").mouseout(
                function() {
                    $("#alt").hide()
                }
            ) 
            </script>
            <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left;">
                <!-- 右邊 -->
                <?php if(isset($_SESSION['admin'])):?>
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" 
                     onclick="lo(&#39;back.php&#39;)">返回管理</button>
                <?php else:?>
                 <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
                     onclick="lo(&#39;?do=login&#39;)">管理登入</button>
                <?php endif;?>
                <div style="width:89%; height:480px;" class="dbor">
                    <span class="t botli">校園映象區</span>
                    <div class='btn' onclick="pp(1)"><img src="imagess/up.jpg" alt="" srcset=""></div> 
                    <div>
                        <?php
                            $images=$Image->all(['sh'=>1]);
                            foreach($images as $key => $img){
                            echo "<div class='im' id='ssaa{$key}' style='display:none;text-align:center;margin:3px 0'>";
                            echo "<img src='upload/{$img['img']}' style='width:150px;height:103px;border:3px solid orange;'>";
                            echo "</div>";
                            }
                        ?>
                        </div>
                        <div class='btn' onclick="pp(2)"><img src="imagess/dn.jpg" alt="" srcset=""></div>
                        <script>
                            var nowpage = 0,
                                num = <?=count($images)?>;
                            function pp(x) {
                                var s, t;
                                if (x == 1 && nowpage - 1 >= 0) {
                                    nowpage--;
                                }
                                if (x == 2 && (nowpage + 1) <= num * 1 - 3) {
                                    nowpage++;
                                }
                                $(".im").hide()
                                for (s = 0; s <= 2; s++) {
                                    t = s * 1 + nowpage * 1;
                                    $("#ssaa" + t).show()
                                    }
                                     console.log(x, nowpage, num); // 把 num 也印出來
                            }
                            pp(1)      
                        </script>
                    </div>      
                </div>    
            </div>    
        </div>
    </div>

</body>

</html>