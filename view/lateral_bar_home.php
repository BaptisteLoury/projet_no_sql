<?php
        require_once("lateral_bar.php");
?>
    <div id="trend">
        <div id="trend-title">Tendances</div>
        <div id="trend-list">
            <?php
                require_once("../controller/con_posts.php");
                require_once("../model/post.php");
                require_once("../model/db.php");
                $topusers = getTop10Likes();
                $i = 0;
                foreach($topusers as $tuser) {
                    require("comp_trending_user.php");
                    if($i != 9)
                        echo "<hr>";
                    $i++;
                }
            ?>
        </div>
    </div>
</div>