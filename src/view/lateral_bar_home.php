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
                require_once("../model/redis.php");
                $cache = new Cache();
                $redis = $cache->getConn();

                $i = 1;
                while($redis->exists("trend_user_" . $i)) {
                    $tuser = $redis->lrange("trend_user_" . $i, 0, -1);
                    require("comp_trending_user.php");
                    $i += 1;
                }
            ?>
        </div>
    </div>
</div>