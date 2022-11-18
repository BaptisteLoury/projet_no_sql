

<?php
         

        require_once("../model/user.php");
        require_once("../model/db.php");


        if(file_exists("../users/$id_other/pp.jpg")) {
            $img = "../users/$id_other/pp.jpg";
        }
        else
            $img = "../media/img/spy.png";
        
        // "../users/".$id_other."/pp.jpg";
        require_once("lateral_bar.php");
       

       
        $other_user=getUser($id_other); //On créer un user avec l'ID et on récupère toutes ses informations 
        $pseudo_other=$other_user->getPseudo();
        $nbTrophies_other=$other_user->getPoints();
        $bio_other=$other_user->getBio();
        $followed_users = $other_user->getFollowedUsers();
        $is_following = false;
        $my_id = $_SESSION['usr_id'];
        $curr_usr = new User($my_id,null,null,null,null,null,null);
        $followed = $curr_usr->getFollowedUsers();
        foreach($followed as &$f) {
            if($f->getId() == $id_other) {
                $is_following = true;
            }
        }
?>


<!-- <script>
    function goCreatePost(){
      window.location.href="./view_create_imposture.php"
    }
</script> -->


    <div id="edit-profile">
        <div id="edit-profile-img">
            <div id="edit-profile-img-circle">
                <img src="<?php echo $img; ?>" alt="Image de profile">
            </div>
        </div>
        
            <div id="edit-profile-pseudo">
                 <?php echo "@".$pseudo_other; ?>  <button id="follow-button"<?php if($is_following) {echo "class=\"active\"";}?> onclick=<?php echo "\"follow($my_id,$id_other,this)\""?>><img src="../media/img/heart.png"></button> 
            </div>
        
        <div id="edit-profile-bio">
            <div id="edit-profile-bio-title">
                <div id="edit-profile-bio-title-trophies">
                    <img src="../media/img/trophy-small.png"><span><?php echo $nbTrophies_other; ?></span>
                </div>
            </div>
            <div id="edit-profile-bio-call">
                Bio :
            </div>
            <div id="edit-profile-bio-text">
                <?php echo $bio_other;?>
            </div>  
        </div>
        <?php if($file=='view_other.php'){ ?>
            <form action= "view_create_imposture.php" method="GET">
                 <input type="hidden" name="searched_usr" value="<?php echo $id_other;?>" />
                <input type="submit" value="Créer une imposture" />
            </form>
        <?php } ?>
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