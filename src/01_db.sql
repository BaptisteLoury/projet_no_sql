-- DROP TABLE IF EXISTS main.flaged;
-- DROP TABLE IF EXISTS main.follow;
-- DROP TABLE IF EXISTS main.comment;
-- DROP TABLE IF EXISTS main.posses;
-- DROP TABLE IF EXISTS main.liked;
-- DROP TABLE IF EXISTS main.discovered;
-- DROP TABLE IF EXISTS main.posts;
-- DROP TABLE IF EXISTS main.users;
-- DROP TABLE IF EXISTS main.rights;
-- DROP TABLE IF EXISTS main.role;

-- DROP SCHEMA main CASCADE;

CREATE SCHEMA main;


CREATE TABLE main.role
(
    rol_id   SERIAL,
    rol_name TEXT,
    PRIMARY KEY (rol_id)
);

CREATE TABLE main.rights
(
    rgh_id   SERIAL,
    rgh_name TEXT,
    PRIMARY KEY (rgh_id)
);

CREATE TABLE main.users
(
    usr_id       SERIAL,
    usr_email    TEXT NOT NULL UNIQUE,
    usr_pseudo   TEXT,
    usr_password TEXT NOT NULL,
    usr_private  BOOLEAN,
    usr_bio      TEXT,
    usr_points   INT,
    rol_id       INT  NOT NULL,
    usr_avatar   TEXT,
    PRIMARY KEY (usr_id),
    FOREIGN KEY (rol_id) REFERENCES main.role (rol_id)
);

CREATE TABLE main.posts
(
    pst_id          SERIAL,
    pst_content     TEXT    NOT NULL,
    pst_created     timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    pst_isImposteur BOOLEAN NOT NULL,
    impost_id       INT,
    usr_id          INT     NOT NULL,
    PRIMARY KEY (pst_id),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (impost_id) REFERENCES main.users (usr_id)
);

CREATE TABLE main.liked
(
    usr_id INT,
    pst_id INT,
    PRIMARY KEY (usr_id, pst_id),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (pst_id) REFERENCES main.posts (pst_id)
);

CREATE TABLE main.posses
(
    rol_id INT,
    rgh_id INT,
    PRIMARY KEY (rol_id, rgh_id),
    FOREIGN KEY (rol_id) REFERENCES main.role (rol_id),
    FOREIGN KEY (rgh_id) REFERENCES main.rights (rgh_id)
);

CREATE TABLE main.comment
(
    cmt_id      SERIAL,
    usr_id      INT,
    pst_id      INT,
    cmt_content TEXT,
    cmt_created timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (cmt_id,usr_id, pst_id),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (pst_id) REFERENCES main.posts (pst_id)
);

CREATE TABLE main.follow
(
    usr_id   INT,
    usr_id_1 INT,
    PRIMARY KEY (usr_id, usr_id_1),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (usr_id_1) REFERENCES main.users (usr_id)
);

CREATE TABLE main.flaged
(
    usr_id INT,
    pst_id INT,
    PRIMARY KEY (usr_id, pst_id),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (pst_id) REFERENCES main.posts (pst_id)
);

CREATE TABLE main.discovered
(
    usr_id INT,
    pst_id INT,
    PRIMARY KEY (usr_id, pst_id),
    FOREIGN KEY (usr_id) REFERENCES main.users (usr_id),
    FOREIGN KEY (pst_id) REFERENCES main.posts (pst_id)
);
