<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Sign In un Post'eur</title>
    <link rel="stylesheet" href="../view/style/global.css"> 
    <link rel="stylesheet" href="../view/style/signIn_style.css">
    <!-- <link rel="stylesheet" href="../view/style/test_style.css"> -->
    <script src="script.js"></script>
</head>

<body>
    <main>
        <!-- partie image gauche  -->
        <div class="design_side">
            
            <div class="welcome_message">
                    <h1>Bienvenue</h1>
            </div>   
            <img src="../media/img/logo.png" alt="logo"> 
        </div>
        <!-- Partie formulaire d'inscription -->
        <div class="informations_side"> 
            <div class="informations">
                <div class="title">
                    <h2>Connectez-vous</h2>
                </div>
                <div class="indications">
                    <?php
                        if (isset($_GET['err'])) {
                            switch ($_GET['err']) {
                                case 0:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Votre inscription a bien été prise en compte</p> 
                                        </div>";
                                    break;
                                case 1:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Votre connexion a échouée. Le pseudo ou le mot de passe est incorrect<br/> 
                                            Veuillez ressaisir les informaions demandées</p> 
                                        </div>";
                                    break;
                                case 2:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Essayez à nouveau, la connexion a échouée</p> 
                                        </div>";
                                    break;
                                default:     
                            }
                        } else {
                            echo"
                                 <div>
                                    <p>
                                        Pour vous connecter, veuillez remplir les informations ci-dessous.
                                     </p>
                                 </div>"; 
                        }
                    ?>
                </div>    
            </div>
            <div class="formulaire">
                <form  action="../controller/con_signin.php" method="POST">
                     
                     <div class="formFieldConnexion">
                         <div class="identifiantConnexion"><label for="identifiantConnexion"></label></div>
                         <div class="textIdentifiantConnexion"><input type="text" class="inputFormConnexion" name="pseudo" placeholder="Pseudo" required></div>
                     </div>

                    
                     <div class="formFieldConnexion">
                         <div class="mdpConnexion"><label for="mdpConnexion"></label></div>
                         <div class="textMdpConnexion"><input type="password" class="inputFormConnexion" name="password" placeholder="Entrez votre mot de passe" required></div>
                     </div>

                    <div class="forgetMdp">
                        <a href="https://la-conjugaison.nouvelobs.com/du/verbe/se_demerder.php">Mot de passe oublié ?</a>
                    </div>
                     <div class="buttonConnexion">
                        <input type="submit" class='inputFormConnexionBtn' value="Se connecter">
                    </div>
                     
                    <div class="noSuscribe">
                        <a href="view_signUp.php">Pas encore inscrit ?</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>