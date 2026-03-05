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
        </div>
    </div>

</body>

</html>