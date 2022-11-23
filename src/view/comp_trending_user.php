<?php
    $id_tusr = $tuser[0];
    if(file_exists("../users/$id_tusr/pp.jpg")) {
        $img = "../users/$id_tusr/pp.jpg";
    }
    else
        $img = "../media/img/spy.png";
    $name = $tuser[1];
    $nbLike = $tuser[2]
?>
<a href="view_other.php?searched_usr=<?php echo $id_tusr; ?>"><div class="comp-trending-user">
    <div class="comp-trending-user-left">
        <img src="<?php echo $img; ?>">
        <span>@<?php echo $name; ?></span>
    </div>
    <div class="comp-trending-user-right">
        <?php echo $nbLike; ?><img src="../media/img/heart.png">
    </div>
</div></a>