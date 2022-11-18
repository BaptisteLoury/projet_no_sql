<?php
// show errors
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../model/db.php');
$d = new DB();
$co = $d->getDbconn();

$_SESSION['usr_bio'] = $_POST['textNewBio'];
$content = pg_escape_string($_POST['textNewBio']);
var_dump($content);
$query = "UPDATE main.users SET usr_bio = '$content' WHERE usr_id = ".$_SESSION['usr_id'];
$result = pg_query($query);


if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
    
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    
    if (pathinfo($filename, PATHINFO_EXTENSION) != "jpg") {
        $d->close();
        header('Location: ../view/view_edit_profile.php?err=2');
    } else {
        $folder = '../users/'. $_SESSION['usr_id']. '/' . 'pp.jpg';
        if (move_uploaded_file($tempname, $folder)) {
            $d->close();
            header('Location: ../view/view_profile.php');
        } else {
            $d->close();
            header('Location: ../view/view_edit_profile.php?err=1');
        }
    }
}
$d->close();
header('Location: ../view/view_profile.php');

?>
