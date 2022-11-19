<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Sign up un Post'eur</title>
    <link rel="stylesheet" href="../view/style/global.css"> 
    <link rel="stylesheet" href="../view/style/signUp_style.css">
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
            <a href="view_signIn.php"><img src="../media/img/logo.png" alt="logo"></a>
        </div>
        <!-- Partie formulaire d'inscription -->
        <div class="informations_side"> 
            <div class="informations">
                <div class="title">
                    <h2>Inscrivez-vous pour devenir un Post'eur !</h2>
                </div>
                <div class="indications">
                    <?php
                        if (isset($_GET['err'])) {
                            switch ($_GET['err']) {
                                case 1:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Votre inscription a échouée. Un utilisateur est déjà inscrit avec ce mail ou ce pseudo.</p> 
                                        </div>";
                                    break;
                                case 2:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Erreur inconnue, veuillez contacter un administrateur.</p> 
                                        </div>";
                                    break;
                                case 3:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Votre inscription a échouée. Le format du mail renseigné n'est pas valide.</p> 
                                        </div>";
                                    break;
                                case 4:
                                    echo "
                                        <div class='erreur'> 
                                            <p>Votre inscription a échouée. La validation du mot de passe ne correspond pas au mot de passe renseigné.</p> 
                                        </div>";
                                    break;
                                default:     
                            }
                        } else {
                            echo"
                                 <div>
                                    <p>
                                        Pour vous inscrire, veuillez remplir le formulaire d'inscription ci-dessous.
                                     </p>
                                 </div>"; 
                        }
                    ?>
                </div>    
            </div>
            <div class="formulaire">
                <form  action="../controller/con_signup.php" method="POST">
                     <div class="formFieldInscription">
                         <div class="firstInput"><label for="identifiantInscription"></label></div>
                         <div class="effect-1"><input type="text" class="inputFormInscription" name="email" placeholder="Votre e-mail" required></div>
                     </div>
                     <div class="formFieldInscription">
                         <div class="identifiantInscription"><label for="identifiantInscription"></label></div>
                         <div class="textIdentifiantInscription"><input type="text" class="inputFormInscription" name="pseudo" placeholder="Pseudo" required></div>
                     </div>

                    
                     <div class="formFieldInscription">
                         <div class="mdpInscription"><label for="mdpInscription"></label></div>
                         <div class="textMdpInscription"><input type="password" class="inputFormInscription" name="password" placeholder="Entrez votre mot de passe" required></div>
                     </div>

                     <div class="formFieldInscription">
                         <div class="VerifMdpInscription"><label for="VerifMdpInscription"></label></div>
                         <div class="textMdpInscription"><input type="password" class="inputFormInscription" name="verifpassword" placeholder="Entrez à nouveau votre mot de passe" required></div>
                     </div>
                     
                     <div class="CGU">
                         <label for="CGUInscription">J'accepte les <a href="">conditions générales d'utilisation</a> </label>
                         <span class="CGUInscription"><input class="inputFormInscriptionCase" type="checkbox" name="CGUInscription" required></span>
                     </div>

                     
                         <div class="buttonInscription">
                             <input type="submit" class='inputFormInscriptionBtn' value="S'inscrire">
                        </div>
                     
                </form>
            </div>
        </div>
    </main>
</body>
</html>