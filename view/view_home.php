<?php
    session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/post.css">
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
            require_once("lateral_bar_home.php");
            require_once("../controller/con_posts.php");
            require_once("../model/post.php");
            require_once("../model/db.php");

            $posts = getPostsFollowed($_SESSION['usr_id']);

            echo "<div id=\"home\" class=\"scroll-container\">";
                foreach ($posts as $p) {
                    $post = $p;
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