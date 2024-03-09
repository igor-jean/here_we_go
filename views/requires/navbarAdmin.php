<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a href="index.php" class="navbar-brand">HERE <b>WE GO</b></a>  		
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav">
            <a href="?controller=pages&action=home" class="nav-item nav-link">Accueil</a>		
            <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Categories</a>
                <div class="dropdown-menu">
                    <?php foreach (Categorie::all() as $key) {
                        echo '<a href="?controller=pages&action=categorie&id_categorie='.$key->getIdCategorie().'" class="dropdown-item">'.$key->getLibelleCategorie().'</a>';
                        
                    } ?>
 
                </div>
            </div>
            <div id="boutton-datepicker" class="nav-item"><span class="nav-item nav-link boutton-datepicker-textcontent">Par Date</span></div>
            <form action="?controller=evenements&action=resultsSearch" method="post" class="navbar-form form-inline d-flex ">
                <div class="datepicker">
                    <input type="date" name="date" id="search" class="form-control">
                </div> 
                <div id="searchBox" class="input-group search-box">								
                    <input type="text" id="search" class="form-control" name="search" placeholder="Recherche ..">
                </div>
                <button type="submit" id="boutton-rechercher"><i class="fa fa-search">&#xE8B6;</i></button>
            </form>
            <div class="nav-item">
                <a href="?controller=evenements&action=newEvent" class="nav-item nav-link">Ajouter un evenement</a>
            </div>
            <div class="nav-item">
                <a href="?controller=admin&action=indexAdministration" class="nav-item nav-link">Gestion du site</a>
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
<script src="js/datepicker.js"></script>