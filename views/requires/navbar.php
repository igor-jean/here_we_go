<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a href="index.php" class="navbar-brand">HERE <b>WE GO</b></a>  		
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav">
            <a href="?controller=pages&action=home" class="nav-item nav-link">Accueil</a>		
            <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Categorie</a>
                <div class="dropdown-menu">					
                <?php foreach (Categorie::all() as $key) {
                        echo '<a href="?controller=pages&action=categorie&id_categorie='.$key->getIdCategorie().'" class="dropdown-item">'.$key->getLibelleCategorie().'</a>';
                        
                    } ?>
                </div>
            </div>
        </div>
        <form class="navbar-form form-inline">
            <div class="input-group search-box">								
                <input type="text" id="search" class="form-control" placeholder="Recherche ..">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="material-icons">&#xE8B6;</i>
                    </span>
                </div>
            </div>
        </form>
        <div class="navbar-nav ml-auto action-buttons">
            <div class="nav-item dropdown">
                <a href="?controller=pages&action=connexion" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Connexion</a>
                <div class="dropdown-menu action-form">
                    <form action="?controller=utilisateurs&action=login" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre mail" required="required" name="mail" id="">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mot de  passe" required="required" name="pwd" id="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Connexion">
                    </form>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Crée votre compte</a>
                <div class="dropdown-menu action-form">
                    <form action="?controller=utilisateurs&action=register" method="post">
                        <div class="form-group">
                            <input type="mail" class="form-control" placeholder="Votre E-mail" required="required">
                        </div>
                        <div class="form-group">
                            <input type="mail" class="form-control" placeholder="Confirmation E-mail" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre nom" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre prénom" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre " required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre prénom" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Mot de passe" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirmation mot de passe" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label"><input type="checkbox" required="required"> J'accepte les <a href="#">Termes &amp; Conditions</a></label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Valider">
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
