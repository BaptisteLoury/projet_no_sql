<?php
    $id = $f_usr->getId();
    $pseudo = $f_usr->getPseudo();
    if(file_exists("../users/$id/pp.jpg")) {
        $img = "../users/$id/pp.jpg";
    }
    else
        $img = "../media/img/spy.png";
    $name = "@$pseudo";
?>
<a href="view_other.php?searched_usr=<?php echo $id; ?>"><div class="comp-follow">
    <img src="<?php echo $img; ?>">
    <span><?php echo $name; ?></span>
</div></a>