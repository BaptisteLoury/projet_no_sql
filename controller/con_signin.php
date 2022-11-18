<?php
// error_reporting(E_ALL);


// recup des donnees
$pseudo     = htmlspecialchars($_POST['pseudo'],    ENT_QUOTES, 'UTF-8');
$password   = htmlspecialchars($_POST['password'],  ENT_QUOTES, 'UTF-8');

require_once('../model/db.php');
$d = new DB();
$co = $d->getDbconn();

$pseudo = pg_escape_string($pseudo);
$password = pg_escape_string($password);

$query = "SELECT * FROM main.users WHERE usr_password = '$password' AND usr_pseudo = '$pseudo'";
$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    // result found -> connect
    require_once('../model/user.php');
    session_start();
    
    // stockage de l'utilisateur dans la session
    $_SESSION['usr_id']         = $line['usr_id'];
    $_SESSION['usr_pseudo']     = $line['usr_pseudo'];
    $_SESSION['usr_email']      = $line['usr_email'];
    $_SESSION['usr_password']   = $line['usr_password'];
    $_SESSION['usr_private']    = $line['usr_private'];
    $_SESSION['usr_bio']        = $line['usr_bio'];
    $_SESSION['usr_points']     = $line['usr_points'];
    $_SESSION['rol_id']         = $line['rol_id'];

    $d->close();

    header('Location: ../view/view_home.php');

} else {
    // no result -> no connect
    $d->close();
    header('Location: ../view/view_signIn.php?err=1');
}
?>
