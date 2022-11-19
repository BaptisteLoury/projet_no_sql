<header>
    <div id="top-nav">
        <div id="nav-container">
                <ul>
                    <a href="view_home.php"><li class="normal-tab">Accueil<img src="<?php echo $path ?>media/img/home.png"></li></a>
                    <a href="view_profile.php"><li class="normal-tab">Mon profil<img src="<?php echo $path ?>media/img/user.png"></li></a>
                    <?php if ($_SESSION['rol_id'] == 1) echo "<a href=\"view_admin.php\"><li class=\"normal-tab\">Administration</li></a>" ?>
                    <li class="search-tab">
                        <input id="search-bar" type="search">
                        <button onclick="goToUser()"><img src="<?php echo $path ?>media/img/search.png"></button>
                    </li>
                    <a href="view_signIn.php"><li class="disconnect"><img src="<?php echo $path ?>media/img/so_long_connexion.png"></li></a>
                </ul>
        </div>
    </div>
</header>