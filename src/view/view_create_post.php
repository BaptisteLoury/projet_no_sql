<?php
    session_start();
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Créer un post</title>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/post.css">
    <link rel="stylesheet" href="style/create_post.css">
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/jquery-ui.css">
    <script type="text/javascript" src="../controller/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="../controller/jquery-ui.js"></script>
    <script type="text/javascript" src="../controller/con_ajax.js"></script>
    <script type="text/javascript" src="../controller/search_bar.js"></script>
</head>

<body>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("image_visualisation");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <?php
    $path = "../";
    require_once("header.php");

    $current_file = basename(__FILE__);
    ?>
    <main>
        <?php
        require_once("lateral_bar_profile.php");

        echo "<div id=\"new_post\" class=\"scroll-container\">";
        ?>
        <div class="informations_side">
            <div>
                <img class="image_ecrire" src="../media/img/writePost2.png" alt="logo ecrire un post">
            </div>
            <div class="informations">
                <div class="titre">
                    <h1>Créer un post</h1>
                </div>

                <div class="consignes">
                <?php
                        if (isset($_GET['err'])) {
                            switch ($_GET['err']) {
                                case 0:
                                    echo "
                                        <div class='erreur'> 
                                            <p>le Post a bien été créé</p> 
                                        </div>";
                                    break;
                                case 1:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Essayez à nouveau, l'envoi'a échoué</p> 
                                        </div>";
                                    break;
                                case 2:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Selectionnez un fichier jpg</p> 
                                        </div>";
                                    break;
                             
                                default:     
                            }
                        } else {
                            echo"
                                 <div>
                                        <p>
                                            Ce post' sera visible par les personnes qui sont abonnées à votre compte
                                        </p>
                                 </div>"; 
                        }
                    ?>
                </div>
            </div>
        </div>


        <form action="../controller/con_create_post.php" method="POST" enctype="multipart/form-data">
            <div class="formulaire">
                <div class="formImg">
                    <div class="imgPost">
                        <input class="inputImg" type="button" onclick="document.getElementById('imgInp').click()" value="Importer une image">
                        <input type="file" onchange="showPreview(event);" class="btnImg" name="uploadfile" accept=".jpg" id="imgInp">
                    </div>
                    <div class="img_visualisation">
                        <img id="image_visualisation" src="../media/img/girafe1.jpg" width="200px" height="auto" alt="image du post"/>
                    </div>
                </div>
                <div class="formCreatePost">
                    <textarea class="textCreatePost" type="textarea" name="textNewPost" placeholder="Ecrivez votre texte ici" required></textarea>
                </div>
            </div>
            <div class="buttonCreatePost">
                <input type="submit" class='btnCreatePost' value="Publier le post">
            </div>
        </form>

        </div>
    </main>

    <?php
    require_once("footer.php");
    ?>

</body>

</html>