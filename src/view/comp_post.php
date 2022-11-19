<?php
    $id_active_usr = $_SESSION['usr_id'];
    $id_usr = $post->usr;
    $user = $post->pseudo;
    $id_post = $post->id;
    if(file_exists("../users/$id_usr/$id_post.jpg")) {
        $image = "../users/$id_usr/$id_post.jpg";
    }
    else
        $image = "";
    $message = $post->content;
    $comments = $post->comments;
    if(file_exists("../users/$id_usr/pp.jpg")) {
        $img_profile = "../users/$id_usr/pp.jpg";
    }
    else
        $img_profile = "../media/img/spy.png";
    $is_liked = $post->isLiked($id_active_usr);
    $is_flaged = $post->isFlagged($id_active_usr);
    $is_discovered = $post->isDiscovered($id_active_usr);
    $active_usr_pseudo = $_SESSION['usr_pseudo'];
?>
<div class="post">
    <div class="post-left">
        <div class="post-left-img">
                <img src="<?php echo $image; ?>">
        </div>
        <div class="post-left-reactions">
            <ul>
                <li><button class=
                    <?php 
                        echo "\"react-heart";
                        if($is_liked) {echo " active";}
                        echo "\"";
                        echo " onclick=\"change_state_like($id_active_usr,$id_post,this)\""; 
                    ?>>
                    <img src="../media/img/heart.png"></button></li>
                <li><button class=
                    <?php 
                        echo "\"react-spy";
                        if($is_discovered) {echo " active";}
                        echo "\"";
                        echo " onclick=\"change_state_discovered($id_active_usr,$id_post,this)\""; 
                    ?>>
                    <img src="../media/img/spy-react.png"></button></li>
                <li><button class=
                    <?php 
                        echo "\"react-flag";
                        if($is_flaged) {echo " active";}
                        echo "\"";
                        echo " onclick=\"change_state_flaged($id_active_usr,$id_post,this)\""; 
                    ?>>
                    <img src="../media/img/flag.png"></button></li>
            </ul>
        </div>
    </div> 
    <div class="post-core">
        <div class="post-core-top">
            <div class="post-core-top-left">
                <div class="post-core-top-left-img">
                    <img src="<?php echo $img_profile; ?>">
                </div>
            </div>
            <div class="post-core-top-right">
                <div class="post-core-usr">
                    <span><a href="view_other.php?searched_usr=<?php echo $id_usr; ?>">@<?php echo $user; ?></a></span>
                </div>
                <div class="post-core-msg">
                    <span><?php echo $message; ?></span>
                </div>
            </div>
        </div>
        <div class="post-comments-list">
            <div id="cmt-box-<?php echo $id_post; ?>" class="post-comments-list-container">
            <?php
                foreach ($comments as &$comment) {
                    $usr = $comment['usr_pseudo'];
                    $msg = $comment['cmt_content'];
                    echo "
                        <div class=\"post-comments-list-elem";
                    echo "\">
                            <span class=\"post-comments-list-elem-usr\">$usr</span> : $msg
                        </div>
                        ";
                }
            ?>
            </div>
        </div>
        <div class="post-comments-new">
                <input id="text-comment-<?php echo $id_post;?>" type="text" placeholder="Écrire ici...">
                <button
                    <?php 
                        echo " onclick=\"add_comment($id_active_usr,$id_post,'$active_usr_pseudo')\""; 
                    ?>><img src="<?php echo $path; ?>media/img/send.png" alt="send"></input></button>
        </div>
    </div>
</div>