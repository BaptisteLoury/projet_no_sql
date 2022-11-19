
<?php
        require_once("../model/user.php");
        require_once("../model/db.php");

        $id_usr = $_SESSION['usr_id'];
        $pseudo = $_SESSION['usr_pseudo'];

        $curr_user = getUser($id_usr);
        $nbTrophies = $curr_user->getPoints();
        
        
        require_once("lateral_bar.php");
        $bio = $_SESSION['usr_bio'];
        if(file_exists("../users/$id_usr/pp.jpg")) {
            $img = "../users/$id_usr/pp.jpg";
        }
        else
            $img = "../media/img/spy.png";
        $user = new User(
            $id_usr,
            $pseudo,
            null,
            null,
            null,
            null,
            null
        );
        $followed_users = $user->getFollowedUsers();
?>

<!-- 
<script>
    function goCreatePost(){
      window.location.href="./view_create_post.php"
    }
</script> -->

    <div id="edit-profile">
        <div id="edit-profile-img">
            <div id="edit-profile-img-circle">
                <img src="<?php echo $img; ?>" alt="Image de profile">
            </div>
        </div>
        <div id="edit-profile-pseudo">
            <?php echo "@".$pseudo; ?><a href="view_edit_profile.php"><button><img src="../media/img/edit.png"></button></a>
        </div>
        <div id="edit-profile-bio">
            <div id="edit-profile-bio-title">
                <div id="edit-profile-bio-title-trophies">
                    <img src="../media/img/trophy-small.png"><span><?php echo $nbTrophies; ?></span>
                </div>
            </div>
            <div id="edit-profile-bio-call">
                Bio :
            </div>
            <div id="edit-profile-bio-text">
                <?php echo $bio; ?>
            </div>
        </div>
        <?php
        if($current_file == "view_profile.php") {
            echo "<form action=\"view_create_post.php\">
                <input type=\"submit\" value=\"Créer un nouveau post\" />
            </form>";
        }
        ?>
    </div>
    <div id="follow-title">
        Follows :
    </div>
    <div id="follow-list">
        <?php
            foreach($followed_users as &$f_usr) {
                require("comp_follow.php");
            }
        ?>
    </div>
</div>