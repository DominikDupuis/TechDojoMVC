<section class ="navigation">
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            beforeShowDay : function (date) {
                var dayOfWeek = date.getDay ();
                // 0 : Sunday, 1 : Monday, ...
                if (dayOfWeek == 0 || dayOfWeek == 6) return [false];
                else return [true];
            }
        });
    });
</script>
                <nav class="navigation">
                    <div class="container-fluid">
                        <a class="nav-logo" href="?action=accueil"><img class="logo" src="images/kendo2.png" alt="TechDojo" /> </a>
                        <?php
                        if (!ISSET($_SESSION)) {
                                session_start();
                                }
                            //Si on est connecter, on affiche une navbar différente.
                            if (ISSET($_SESSION['username'])){
                                ?>
                                <form method="post" class="go-to-date" action="?action=calendrier">
                                    <input type = "text" name="date_picker" class="nav-link date-picker" placeholder="Entrez une date" id = "datepicker">
                                    <input type="submit" class="date-button" name="dateButton" value=">"> </input>
                                </form>
                                <?php
                            }
                            ?>
                        <div class="navbar">
                            <?php
                            if (!ISSET($_SESSION)) {
                                session_start();
                                }
                            //Si on est connecter, on affiche une navbar différente.
                            if (ISSET($_SESSION['username'])){
                                ?>
                                
                                <a href="?action=welcome" class="nav-link"> Mon compte </a>
                                <a href="?action=calendrier" class="nav-link"> Calendrier </a>
                                <a href="?action=deconnexion" class="nav-link"> Deconnexion</a>
                            <?php    
                            } else{
                                ?>
                                <a href="?action=accueil" class="nav-link"> Accueil</a>
                                <a href="?action=aPropos" class="nav-link"> À Propos</a>                            
                                <a href="?action=connexion" class="nav-link"> Connexion</a>
                                <?php
                            }
                            ?>
                                
                        </div>
                    </div>
                </nav>
</section>