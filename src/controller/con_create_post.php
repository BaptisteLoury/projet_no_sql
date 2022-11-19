<?php
session_start();
$user_id = $_SESSION['usr_id'];
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../model/db.php');
require_once('../model/post.php');
require_once('../controller/con_posts.php');


$content = pg_escape_string($_POST['textNewPost']);

$post = new Post($content, false, $user_id, $user_id);

if(insertPost($post) == 1){
    if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        
        if (pathinfo($filename, PATHINFO_EXTENSION) != "jpg") {
            header('Location: ../view/view_create_post.php?err=2');
        } else {
            // get post id
//            echo is_writable("../users/");
//            die();
            // echo "GET POST ID";
            $co = new DB();
            $connect = $co->getDbconn();
            $query = "SELECT MAX(pst_id) FROM main.posts WHERE usr_id = $user_id";
            $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
            $res = pg_fetch_row($result);
            $post_id = $res[0];
            // echo "postid :".$post_id;
            $co->close();
            
            // move file
            $folder = '../users/'.$user_id.'/'.$post_id.'.jpg';
            if (move_uploaded_file($tempname, $folder)) {
                header('Location: ../view/view_profile.php');
            } else {
                header('Location: ../view/view_create_post.php?err=1');
            }
        }
    }
    header('Location: ../view/view_profile.php');
} else {
    header('Location: ../view/view_create_post.php?err=1');
}

?>