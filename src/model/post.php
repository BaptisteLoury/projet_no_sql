<?php

class Post
{
    public $content;
    public $created;
    public $isimposteur;
    public $impost_id;
    public $usr;
    public $comments;
    public $pseudo;
    public $id;

    /**
     * Constructeur de la classe Post
     * Choisis en fonction du nombre d'arguments, 1 ou plusieurs
     */
    public function __construct()
    {
        $numargs = func_num_args();
        $arg_list = func_get_args();
        switch ($numargs) {
            case 1:
                $this->fromArray($arg_list[0]);
                break;
            default:
                $this->fromNothing($arg_list);
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructeur de la classe Post à partir de rien
     * @param $content
     * @param $created
     * @param $isimposteur
     * @param $impost_id
     * @param $usr
     */
    public function fromNothing($args)
    {
        $this->content = $args[0];
        $this->created = date("Y-m-d H:i:s");
        $this->isimposteur = $args[1];
        $this->impost_id = $args[2];
        $this->usr = $args[3];
    }

    /**
     * Constructeur à partir d'un array
     * @param $post
     * @return Post
     */
    public function fromArray($post)
    {
        $this->content = $post['pst_content'];
        $this->comments = $post['pst_comments'];
        $this->created = $post['pst_created'];
        $this->isimposteur = $post['pst_isimposteur'];
        $this->impost_id = $post['impost_id'];
        $this->usr = $post['usr_id'];
        $this->pseudo = $post['usr_pseudo'];
        $this->id = $post['pst_id'];
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getIsimposteur()
    {
        return $this->isimposteur;
    }

    /**
     * @param mixed $isimposteur
     */
    public function setIsimposteur($isimposteur)
    {
        $this->isimposteur = $isimposteur;
    }

    /**
     * @return mixed
     */
    public function getImpostId()
    {
        return $this->impost_id;
    }

    /**
     * @param mixed $impost_id
     */
    public function setImpostId($impost_id)
    {
        $this->impost_id = $impost_id;
    }

    /**
     * @return mixed
     */
    public function getUsr()
    {
        return $this->usr;
    }

    /**
     * @param mixed $usr
     */
    public function setUsr($usr)
    {
        $this->usr = $usr;
    }

    /**
     * Récupère les commentaires d'un post
     * @return mixed
     */
    public function getComments($pst_id)
    {
        $co = new DB();
        $query = "SELECT * FROM main.comments WHERE pst_id = $pst_id";
        $res = pg_query($co->getDbconn(), $query);
        foreach (pg_fetch_array($res) as $comment) {
            $this->comments[] = $comment;
        }
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Renvoie true si l'utilisateur à liked le post
     */
    public function isLiked($usr_id)
    {
        $co = new DB();
        $query = "SELECT * FROM main.liked WHERE pst_id = $this->id AND usr_id = $usr_id";
        $res = pg_query($co->getDbconn(), $query);
        $co->close();
        return pg_num_rows($res) > 0;
    }

    /**
     * Renvoi true si le post à été signalé par l'utilisateur
     */

    function isFlagged($usr_id)
    {
        $co = new DB();
        $query = "SELECT * FROM main.flaged WHERE pst_id = $this->id AND usr_id = $usr_id";
        $res = pg_query($co->getDbconn(), $query);
        $co->close();
        return pg_num_rows($res) > 0;
    }


    /**
     * Renvoi true si le post à été découvert par l'utilisateur
     */

    function isDiscovered($usr_id)
    {
        $co = new DB();
        $query = "SELECT * FROM main.discovered WHERE pst_id = $this->id AND usr_id = $usr_id";
        $res = pg_query($co->getDbconn(), $query);
        $co->close();
        return pg_num_rows($res) > 0;
    }
}