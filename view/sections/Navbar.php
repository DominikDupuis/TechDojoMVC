<section class="login">
    <nav class="navbar navbar-expand-md navbar-dark justify-content-between">
        <a class="navbar-brand"></a>
        <form class="form-inline">
            <a href="?action=login" class="btn btn-primary btn-small navbar-btn">
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo 'Mon compte';
                } else {
                    echo 'Se connecter';
                }
                ?>
            </a>
        </form>

    </nav>
</section>
<section class="navigation">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?action=accueil"><img class="logo" src="./images/kendo.svg" alt='AGENDA .' /></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav ml-auto">
                    <a class="p-3 nav-item nav-link <?php if ($page == 'accueil') {
                                                        echo 'active';
                                                    } ?>" href="?action=accueil">ACCUEIL</a>
                    <a class="p-3 nav-item nav-link <?php if ($page == 'a_propos') {
                                                        echo 'active';
                                                    } ?>" href="?action=a_propos">À PROPOS</a>
                    <a class="p-3 nav-item nav-link <?php if ($page == 'contact') {
                                                        echo 'active';
                                                    } ?>" href="?action=contact">NOUS REJOINDRE</a>
                    <a class="p-3 nav-item nav-link <?php if ($page == 'calendrier') {
                                                        echo 'active';
                                                    } ?>" href="?action=calendrier">CALENDRIERS</a>
                </div>
            </div>
        </div>
    </nav>
</section>