<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("model/db.php");
require_once("model/post.php");
require_once("controller/con_posts.php");

//$date = new DateTime(date('h:i:s'));
//$post = new Post($_POST['title'], $_POST['content'], $_POST['photo'], date('Y-m-d H:i:s'), $_POST['isimposter'], $_POST['impost_id'], $_POST['usr'],$_POST['comments']);
//insertPost($post);

//affiche les posts
// $posts = getPosts(1);
// foreach ($posts as $post) {
//     echo $post->getContent() . "<br>";
//     echo $post->getCreated() . "<br>";
//     echo $post->getIsimposteur() . "<br>";
//     echo $post->getImpostId() . "<br>";
//     echo $post->getUsr() . "<br>";
//     echo $post->getComments() . "<br>";
// }
// deletePost(2);
$co = new DB();
$res = pg_query($co->getDbconn(), "SELECT pst_isImposter FROM main.posts WHERE pst_id=12");
var_dump(pg_fetch_row($res));
?>
<!--<form action="test.php" method="post">
    <input type="text" name="title" value="title">
    <input type="text" name="content" value="content">
    <input type="text" name="photo" value="photo">
    <input type="number" name="isimposter" value="1">
    <input type="number" name="impost_id" value="1">
    <input type="number" name="usr" value="1">
    <input type="text" name="comments" value="comments">
    <button type="submit">valider</button>
</form>-->
</body>
</html>