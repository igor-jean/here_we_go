<nav class="navbar navbar-expand-xxl navbar-light bg-light sticky-top">
    <a href="/here_we_go/accueil" class="navbar-brand">HERE <b>WE GO</b></a>  		
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav">
            <a href="/here_we_go/accueil" class="nav-item nav-link"><span class="black-hover">Acc</span>ueil</a>		
            <div class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle"><span class="black-hover">Cate</span>gorie</a>
                <div class="dropdown-menu">					
                <?php foreach (Categorie::all() as $key) {
                        echo '<a href="/here_we_go/categorie/'.$key->getIdCategorie().'" class="dropdown-item">'.$key->getLibelleCategorie().'</a>';
                        
                    } ?>
                </div>
            </div>
            <form action="/here_we_go/recherche" method="post" class="navbar-form form-inline d-flex ">
                <div class="datepicker">
                    <input type="date" name="date" id="searchDate" class="form-control">
                </div> 
                <div id="searchBox" class="input-group search-box">								
                    <input type="text" id="search" class="form-control" name="search" placeholder="Recherche ..">
                </div>
                <div id="boutton-datepicker" class="nav-item">
                    <input id="checkbox_toggle" type="checkbox" class="check">
                    <div class="checkbox">
                        <label class="slide" for="checkbox_toggle">
                            <label class="toggle" for="checkbox_toggle"></label>
                            <label class="text" for="checkbox_toggle">Mot-clé</label>
                            <label class="text" for="checkbox_toggle">Date</label>
                        </label>
                    </div>
                </div>
                <button type="submit" id="boutton-rechercher"><i class="fa fa-search">&#xE8B6;</i></button>
            </form>
            <div class="nav-item">
                <a href="/here_we_go/creation_evenement" class="nav-item nav-link"><span class="black-hover">Ajouter </span>un evenement</a>
            </div>
            <div class="dropdown dropdownAvatar">
                <a href="#" data-toggle="dropdown" class="nav-item dropdown-toggle toggleAvatar"><img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="" style="width : 60px; height : 60px; object-fit : cover; border-radius : 100%;<?php if($premium) echo "border: 5px solid gold;"?>"></a>
                <div class="dropdown-menu">
                    <a href="/here_we_go/monCompte" class="dropdown-item"><span class="black-hover">Mon </span>compte</a>
                    <a href="/here_we_go/deconnexion" class="dropdown-item"><span class="black-hover">Decon</span>nexion</a>
                </div>
            </div>
            <div class="nav-item menuHidden">
                <a href="/here_we_go/monCompte" class="nav-item nav-link"><span class="black-hover">Mon </span>compte</a>
            </div>
            <div class="nav-item menuHidden">
                <a href="/here_we_go/deconnexion" class="nav-item nav-link"><span class="black-hover">Decon</span>nexion</a>
            </div>
            <div class="nav-item menuHidden">
                <a href="/here_we_go/gestion_du_site" class="nav-item nav-link"><span class="black-hover">Gestion </span>du site</a>
            </div>
        </div>
    </div>
</nav>
<script src="js/datepicker.js"></script>