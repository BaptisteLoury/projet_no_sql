<?php
session_start();
if ($_SESSION['rol_id'] != 1)
    header('Location: view_home.php');
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Administration</title>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="style/post.css">
    <link rel="stylesheet" href="style/create_post.css">
    <link rel="stylesheet" href="style/profile.css">
</head>

<body>

<?php
$path = "../";
require_once("header.php");
?>
<main>
    <div id="admin">
        <table>
            <tr>
                <th>Contenu</th>
                <th>Date</th>
                <th>Auteur</th>
                <th>Nombre de signalements</th>
                <th>Supprimer post</th>
            </tr>
            <?php
            require_once("../controller/con_posts.php");
            require_once("../model/post.php");
            require_once("../model/db.php");
            require_once("../model/user.php");
            $posts = getFlaggedPosts();
            foreach ($posts as list($post, $nb_flag)) {
                echo "<tr>";
                echo "<td>" . $post->getContent() . "</td>";
                echo "<td>" . $post->getCreated() . "</td>";
                echo "<td>" . getUser($post->getUsr())->getPseudo() . "</td>";
                echo "<td>" . $nb_flag . "</td>";
                echo "<td><form action='../controller/deletePost.php' method='post'><input type='hidden' name='id' value=" . $post->getId() . "><input type='submit' value ='Supprimer post'> </form> </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</main>

<?php
require_once("footer.php");
?>

</body>

</html>