DELETE FROM main.flaged;
DELETE FROM main.follow;
DELETE FROM main.comment;
DELETE FROM main.posses;
DELETE FROM main.liked;
DELETE FROM main.posts;
DELETE FROM main.users;
DELETE FROM main.rights;
DELETE FROM main.role;

ALTER SEQUENCE main.role_rol_id_seq RESTART WITH 1;
INSERT INTO main.role (rol_name) VALUES ('admin');
INSERT INTO main.role (rol_name) VALUES ('user');
INSERT INTO main.role (rol_name) VALUES ('modo');

ALTER SEQUENCE main.users_usr_id_seq RESTART WITH 1;
insert into main.users (usr_email, usr_pseudo, usr_password, usr_private, usr_bio, usr_points, rol_id)
values ('a@a.a','admin','admin',false,'Je suis le chef',0,1);
-- insert into main.users (usr_email, usr_pseudo, usr_password, usr_private, usr_bio, usr_points, rol_id)
-- values ('putinator@test.com','Poutine','Master of the world',false,'Président officiel et légitime de la Russie',0,2);
-- insert into main.users (usr_email, usr_pseudo, usr_password, usr_private, usr_bio, usr_points, rol_id)
-- values ('heheboy@test.com','rapide','etfurieux',false,'Fast and Curious',0,2);

-- ALTER SEQUENCE main.posts_pst_id_seq RESTART WITH 1;
-- INSERT INTO main.posts (  pst_content, pst_isimposteur, impost_id, usr_id)
-- VALUES ('Php c est vraiment de la merde !',false,null,1);
-- INSERT INTO main.posts (  pst_content, pst_isimposteur, impost_id, usr_id)
-- VALUES ('Vennez en russie on vous offre une chapka !',false,null,2);
-- INSERT INTO main.posts (  pst_content, pst_isimposteur, impost_id, usr_id)
-- VALUES ('Bonjour, je suis rapide mais surtout furieux. VROUM VROUM',false,null,3);

-- INSERT INTO main.follow (usr_id, usr_id_1) VALUES (1,2);
-- INSERT INTO main.follow (usr_id, usr_id_1) VALUES (3,1);
-- INSERT INTO main.follow (usr_id, usr_id_1) VALUES (3,2);

-- INSERT INTO main.flaged (usr_id, pst_id) VALUES (2,2);

-- INSERT INTO main.comment (usr_id, pst_id, cmt_content) 
-- VALUES (2,1,'Moi Vladimir, moi mâitre du monde');
-- INSERT INTO main.comment (usr_id, pst_id, cmt_content) 
-- VALUES (3,1,'Je suis Vin Diesel');

-- INSERT INTO main.LIKED(usr_id,pst_id) VALUES (1,3);
-- INSERT INTO main.LIKED(usr_id,pst_id) VALUES (2,3);
-- INSERT INTO main.LIKED(usr_id,pst_id) VALUES (3,2);

-- Cette partie sert a reset partiellement la bdd en la vidant
-- ALTER SEQUENCE main.role_rol_id_seq RESTART WITH 1;
-- INSERT INTO main.role (rol_name) VALUES ('admin');
-- INSERT INTO main.role (rol_name) VALUES ('user');
-- INSERT INTO main.role (rol_name) VALUES ('modo');
-- ALTER SEQUENCE main.users_usr_id_seq RESTART WITH 1;
-- ALTER SEQUENCE main.posts_pst_id_seq RESTART WITH 1;
