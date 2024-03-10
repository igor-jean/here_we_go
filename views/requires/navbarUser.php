<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a href="/here_we_go/accueil" class="navbar-brand">HERE <b>WE GO</b></a>  		
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav">
            <a href="/here_we_go/accueil" class="nav-item nav-link">Accueil</a>		
            <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Categorie</a>
                <div class="dropdown-menu">					
                <?php foreach (Categorie::all() as $key) {
                        echo '<a href="/here_we_go/categorie/'.$key->getIdCategorie().'" class="dropdown-item">'.$key->getLibelleCategorie().'</a>';
                        
                    } ?>
                </div>
            </div>
            <form action="/here_we_go/recherche" method="post" class="navbar-form form-inline d-flex ">
                <div class="datepicker">
                    <input type="date" name="date" id="search" class="form-control" style="border-radius: 4px 0px 0px 4px !important;">
                </div> 
                <div id="searchBox" class="input-group search-box">								
                    <input type="text" id="search" class="form-control" name="search" placeholder="Recherche .." style="border-radius: 4px 0px 0px 4px !important;">
                </div>
                <div id="boutton-datepicker" class="nav-item"><span class="nav-item nav-link boutton-datepicker-textcontent">Par Date</span></div>
                <button type="submit" id="boutton-rechercher"><i class="fa fa-search">&#xE8B6;</i></button>
            </form>
            <div class="nav-item">
                <a href="/here_we_go/creation_evenement" class="nav-item nav-link">Ajouter un evenement</a>
            </div>
            <div class="nav-item">
                <a href="/here_we_go/monCompte" class="nav-item nav-link">Mon compte</a>
            </div>
            <div class="nav-item">
            <a href="/here_we_go/deconnexion" class="nav-item nav-link">Deconnexion</a>
            </div>
        </div>
    </div>
</nav>
<script src="js/datepicker.js"></script>