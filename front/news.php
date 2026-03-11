<div class="di"
    style="height:540px; border:#999 1px solid; width:53.2%; margin:auto;text-align:center;   float:left; position:relative; left:20px;">
    <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%;  height:40px;top: 0;left: 0;">
      <?php
            $ads=$Ad->all(['sh'=>1]);
            foreach($ads as $ad){
                echo $ad['text']."&nbsp;&nbsp;&nbsp;&nbsp;";
                
            }
            /* $ad=q("select GROUP_CONCAT(`text` SEPARATOR '&nbsp;&nbsp;&nbsp;&nbsp;') as `texts` from `ad` where `sh`=1 GROUP BY `sh`")[0];
            echo $ad['texts']; */
        ?>   
    </marquee>
    <div style="height:32px; display:block;"></div> 
    <!--正中央-->
    <h3>更多最新消息最顯示區</h3>
    <hr>
    <?php
        $total=$News->count(['sh'=>1]);
        $div=5;
        $pages=ceil($total/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;
        $news=$News->all(['sh'=>1]," limit $start,$div");	
		
    ?>
    <ol class="ssaa" start="<?=$start+1;?>" style="list-style-type:decimal;">
    </ol>
</div>