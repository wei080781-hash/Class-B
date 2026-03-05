            <div class="di"
                style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
                <marquee scrolldelay="120" direction="left" style="position:absolute;   width:100%; height:40px;">
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
                <!-- 正中央 -->

                <div style="width:100%; padding:2px; height:290px;">
                    <div id="mwww" loop="true" style="width:100%; height:100%;">
                        <div>沒有資料</div>
                    </div>
                </div>
                <script>
                    var lin = new Array();
                    <?php
                        $mvims=$Mvim->all(['sh'=>1]);
                        foreach($mvims as $mv){
                             echo "lin.push('upload/{$mv['img']}');\n";
                    }
                ?>

                var now = 0;
                ww()
                if (lin.length > 1) {
                    setInterval("ww()", 3000);
                    now = 1;
                }

                </script>

            </div>