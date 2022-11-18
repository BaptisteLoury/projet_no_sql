<?php
// var_dump($_POST);
// error_reporting(E_ALL);
//


// recup des donnees
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
$verifpassword = htmlspecialchars($_POST['verifpassword'], ENT_QUOTES, 'UTF-8');

if ($password != $verifpassword) {
    header('Location: ../view/view_signUp.php?err=4');
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // $output = "Invalid email format";
    header('Location: ../view/view_signUp.php?err=3');
    // echo "mail format";
}

require_once('../model/db.php');
$d = new DB();
$co = $d->getDbconn();
// verif d'unicité du mail ou pseudo
$query = "SELECT usr_id FROM main.users WHERE usr_email = '" . pg_escape_string($email) . "' OR usr_pseudo = '" . pg_escape_string($pseudo) . "'";
$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    // il existe deja quelqu'un qui a un mail ou un pseudo identique
    $d->close();
    header('Location: ../view/view_signUp.php?err=1');
    // echo "pseudo|mail non unique";
} else {
    // role 1 : admin, role 2: user
    $query = "INSERT INTO main.users(  usr_email,  usr_pseudo, usr_password,   usr_private,    usr_bio,    usr_points, rol_id)
                    VALUES (        '" . pg_escape_string($email) . "', '" . pg_escape_string($pseudo) . "',  '" . pg_escape_string($password) . "',     false,          '',         0,          2)";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    // get users id 
    $query = "SELECT usr_id FROM main.users WHERE usr_email = '" . pg_escape_string($email) . "' AND usr_pseudo = '" . pg_escape_string($pseudo) . "'";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
    $usr_id = $line['usr_id'];

    // creation du dossier de l'utilisateur
    $structure = '../users/' . $usr_id;
    umask(0);
    if (!mkdir($structure, 0777, true)) {
        die('Échec lors de la création du dossier...');
    }
    chmod($structure, 0777);
    $d->close();
    header('Location: ../view/view_signIn.php?err=0');
    // echo "done";
}

// echo "erreure inconnue";
?>
