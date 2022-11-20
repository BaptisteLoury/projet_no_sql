<?php
/**
 * Récupère les posts d'un utilisateur
 * @param $usr_id
 * @return array|void
 */
function getPosts($usr_id)
{
    $co = new DB();
    $query = "SELECT * FROM main.posts NATURAL JOIN main.users WHERE usr_id = $usr_id ORDER BY pst_created DESC";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $posts = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $line['pst_comments'] = getComments($line['pst_id']);
        $posts[] = new Post($line);
    }

    $co->close();
    return $posts;
}

/**
 * Insert un post dans la base de données
 * @param Post $post
 * @return bool
 */
function insertPost(Post $post)
{
    require_once('../model/post.php');
    require_once('../model/db.php');
    $insert = array(
        'pst_content' => $post->content,
        'pst_isimposteur' => (int)$post->isimposteur,
        'impost_id' => (int)$post->impost_id,
        'usr_id' => (int)$post->usr,
    );
    $co = new DB();
    if (!pg_insert($co->getDbconn(), 'main.posts', $insert)){
        $co->close();
        return 0;
    }
    $co->close();
    return 1;

}


/**
 * Supprime un post dans la base de données
 * @param $pst_id
 * @return void
 */
function deletePost($pst_id)
{
    require_once('../model/db.php');
    $co = new DB();
    pg_delete($co->getDbconn(), 'main.liked', array('pst_id' => $pst_id));
    pg_delete($co->getDbconn(), 'main.comment', array('pst_id' => $pst_id));
    pg_delete($co->getDbconn(), 'main.flaged', array('pst_id' => $pst_id));
    pg_delete($co->getDbconn(), 'main.posts', array('pst_id' => $pst_id));
    $co->close();
}

/**
 * Récupère tous les posts des utilisateurs suivit par l'utilisateur
 * @param $usr_id
 * @return array
 */
function getPostsFollowed($usr_id): array
{
    $co = new DB();
    $query = "SELECT * FROM main.posts NATURAL JOIN main.users WHERE usr_id IN (SELECT usr_id_1 FROM main.follow WHERE usr_id = $usr_id) ORDER BY pst_created DESC";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $posts = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $line['pst_comments'] = getComments($line['pst_id']);
        $posts[] = new Post($line);
    }
    $co->close();
    return $posts;
}

/**
 * Récupère tous les posts signalés
 * @return array
 */
function getFlaggedPosts(): array
{
    $co = new DB();
    $query = "SELECT posts.*, users.*, count(*) as nb_flagged FROM main.flaged
    JOIN main.posts ON(flaged.pst_id=posts.pst_id)
    JOIN main.users ON(posts.usr_id=users.usr_id)
    GROUP BY flaged.pst_id, posts.pst_id, users.usr_id";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $posts = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $line['pst_comments'] = getComments($line['pst_id']);
        $posts[] = [new Post($line),$line['nb_flagged']];
    }
    $co->close();
    return $posts;
}

/**
 * Récupère les commentaires d'un post
 * @param $pst_id
 * @return array
 */
function getComments($pst_id)
{
    $query = "SELECT usr_pseudo, usr_id, cmt_content, pst_id FROM main.comment NATURAL JOIN main.users WHERE pst_id = $pst_id ORDER BY cmt_created DESC";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $comments = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $comments[] = $line;
    }
    return $comments;
}


/**
 * Récupère les 10 utilisateurs avec le plus de like ces dernières 24h
 * @return array
 */
function getTop10Likes(): array
{
    $co = new DB();
    $query = "SELECT usr_pseudo, p.usr_id, COUNT(*) AS nb_likes
                FROM main.users NATURAL JOIN main.posts p  JOIN main.liked l ON (p.pst_id = l.pst_id)
                WHERE pst_created > (NOW() - INTERVAL '24 hours')
                GROUP BY usr_pseudo, p.usr_id
                ORDER BY nb_likes DESC LIMIT 10";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $users = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $users[] = $line;
    }
    $co->close();
    return $users;
}

/**
 * Récupère tous les posts signalés classés par nombre de signalements
 * @return array
 */

function getFlagged()
{
    $co = new DB();
    $query = "SELECT *,COUNT(*) as nb_flagged FROM main.posts WHERE pst_id IN (SELECT pst_id FROM main.flaged) GROUP BY pst_id ORDER BY nb_flagged DESC";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $posts = array();
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        ;
        $posts[] = $line;
    }
    $co->close();
    return $posts;
}