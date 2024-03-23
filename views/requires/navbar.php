<nav class="navbar navbar-expand-xxl navbar-light bg-light sticky-top">
    <a href="/here_we_go/accueil" class="navbar-brand">HERE <b>WE GO</b></a>  		
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
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
        <div class="navbar-nav ms-auto action-buttons">
            <div class="nav-item dropdown">
                <a href="?controller=pages&action=connexion" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Connexion</a>
                <div class="dropdown-menu action-form">
                    <form action="?controller=utilisateurs&action=login" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre mail" required="required" name="mail">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mot de  passe" required="required" name="pwd">
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
                <input type="text" name="mail" class="form-control" placeholder="Votre E-mail" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="confirmMail" class="form-control" placeholder="Confirmation E-mail" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="nom" class="form-control" placeholder="Votre nom" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="ville" class="form-control" placeholder="Votre ville" required="required">
            </div>
            <div class="form-group">
                <input type="number" name="telephone" class="form-control" placeholder="Votre téléphone" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="confirmPwd" class="form-control" placeholder="Confirmation mot de passe" required="required">
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
<script src="js/datepicker.js"></script>