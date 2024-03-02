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
            <div class="nav-item">
                <a href="?controller=evenements&action=newEvent" class="nav-item nav-link">Ajouter un evenement</a>
            </div>
            <div class="nav-item">
                <a href="?controller=utilisateurs&action=monCompte" class="nav-item nav-link">Mon compte</a>
            </div>
            <div class="nav-item">
            <a href="?controller=utilisateurs&action=deconnexion" class="nav-item nav-link">Deconnexion</a>
            </div>
        </div>
    </div>
</nav>
