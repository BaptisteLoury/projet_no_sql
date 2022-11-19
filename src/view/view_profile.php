<?php
    session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon profile</title>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/post.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/jquery-ui.css">
    <script type="text/javascript" src="../controller/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="../controller/jquery-ui.js"></script>
    <script type="text/javascript" src="../controller/con_ajax.js"></script>
    <script type="text/javascript" src="../controller/search_bar.js"></script>
</head>
<body>
    <?php
        $path = "../";
        require_once("header.php");
    ?>
    <main>
        <?php
            require_once("../controller/con_posts.php");
            require_once("../model/post.php");
            require_once("../model/db.php");

            $current_file = basename(__FILE__);
            
            require_once("lateral_bar_profile.php");
            echo "<div id=\"profile\" class=\"scroll-container\">";
            $posts = getPosts($_SESSION['usr_id']);
            foreach($posts as $post) {
                require("comp_post.php");
            }
            echo "</div>";
        ?>
    </main>
        
    <?php
        require_once("footer.php");
    ?>

</body>
</html>