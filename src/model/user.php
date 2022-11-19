<?php

// exemple d'utilisation dans $_SESSION
// $u = new User("david", 5);
// $_SESSION['user'] = $u;
// var_dump($_SESSION);
// echo $_SESSION['user']->pseudo;


class User
{
    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $private;
    private $bio;
    private $points;
    private $role;

    // constructor
    public function __construct($id, $pseudo, $email, $private, $bio, $points, $role)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->private = $private;
        $this->bio = $bio;
        $this->points = $points;
        $this->role = $role;
    }

    public function changePassword($password)
    {
        $co = new DB();
        pg_update($co->getDbconn(), "main.users", array("usr_password" => $password), array("usr_id" => $this->id));
        $this->password = $password;
    }

    public function deleteUser()
    {
        $co = new DB();
        pg_delete($co->getDbconn(), "main.users", array("usr_id" => $this->id));
        $co->close();
    }

    /**
     * Renvoie les utilisateurs que l'on suit
     * @return array
     */
    public function getFollowedUsers(){
        $co = new DB();
        $res = pg_query($co->getDbconn(), "SELECT usr_id,usr_pseudo,usr_email,usr_private,usr_bio,usr_points,rol_id from main.users WHERE usr_id IN (SELECT usr_id_1 FROM main.follow WHERE usr_id = $this->id)");
        $users = array();
        while ($row = pg_fetch_row($res))
            $users[] = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
        return $users;
    }

    

    // getters and setters


    // getter and setter for id
    public function getId()
    {
        return $this->id;
    }

    //setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    //getter for pseudo
    public function getPseudo()
    {
        return $this->pseudo;
    }

    //setter for pseudo
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    //getter for email
    public function getEmail()
    {
        return $this->email;
    }

    //setter for email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    //getter for password
    public function getPassword()
    {
        return $this->password;
    }

    //setter for password
    public function setPassword($password)
    {
        $this->password = $password;
    }

    //getter for private
    public function getPrivate()
    {
        return $this->private;
    }

    //setter for private
    public function setPrivate($private)
    {
        $this->private = $private;
    }

    //getter for bio
    public function getBio()
    {
        return $this->bio;
    }

    //setter for bio
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    //getter for points
    public function getPoints()
    {
        return $this->points;
    }

    //setter for points
    public function setPoints($points)
    {
        $co = new DB();
        $this->points = $points;
        pg_update($co->getDbconn(), "main.users", array("usr_points" => $points), array("usr_id" => $this->id));
    }

    //getter for role
    public function getRole()
    {
        return $this->role;
    }

    //setter for role
    public function setRole($role)
    {
        $this->role = $role;        //setter for role
    }

}
function getUser($userid){
    require_once('../model/user.php');
    require_once('../model/db.php');
    $co = new DB();
    $res = pg_query($co->getDbconn(), "SELECT usr_id,usr_pseudo,usr_email,usr_private,usr_bio,usr_points,rol_id from main.users WHERE usr_id = $userid");
    $row = pg_fetch_row($res);
    $user = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
    return $user;
}

?>
