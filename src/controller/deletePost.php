<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('con_posts.php');
$pst_id = $_POST['id'];
deletePost($pst_id);
header('Location: ../view/view_admin.php');
