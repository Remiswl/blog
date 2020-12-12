<header> 
    <a href="index.php" id="linkToHome"><i class="fas fa-microphone"></i>Le blog d'un voyageur</a>
    <nav>
        <a href="index.php" id="linkToIndex"><i class="fas fa-home"></i>Accueil</a>
        <a href="admin.php" id="linkToAdmin"><i class="fas fa-cogs"></i>Administrateur</a>
        <a href="create_account.phtml" id="linkToRegister"><i class="fas fa-plus-square"></i>S'enregistrer</a>
        <a href="my_profile.php" id="linkToProfile"><i class="fas fa-user"></i>Mon profil</a>

        <!-- Afficher le menu de déconnexion si la session est active; et la connexion sinon -->
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
            <a href="logout.php" id="logout"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
        <?php else: ?>
            <a href="login.phtml" id="linkToLogin"><i class="fas fa-sign-in-alt"></i>Se connecter</a> 
        <?php endif; ?>
    </nav>
</header>