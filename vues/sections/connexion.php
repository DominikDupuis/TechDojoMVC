<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type ="text/css" href="./css/styleContact.css">
    <link rel="stylesheet" type ="text/css" href="./css/styleLogin.css">
    <title>TechDojo - Connexion</title>
</head>
    <body>
        <?php
        //Si nous avons des erreurs, les afficher.
                if(isset($errorMsg)){
                    ?>
                        <section class="centre" style="padding-bottom:8vh;">
                    <?php
                }else{
                    ?>
                        <section class="centre">
                    <?php
                }
        ?>
        <section class="message-field">
        <?php
                if(isset($errorMsg)){
                    foreach($errorMsg as $error){
                    ?>
                        <div class="messages" style="display:flex;">
                            <div class="alert-danger">
                                <strong><?php echo $error; ?></strong>
                            </div>
                        </div>
                    <?php
                    }
                } 
            ?>
        </section>       
            <!-- Formulaire d'inscription et de connexion -->
            <div class="login-wrap">
                <div class="login-html">
                    <input id="tab-1" type="radio" name="button" value = "conn" class="sign-in" checked><label for="tab-1" class="tab">Connexion</label>
                    <input id="tab-2" type="radio" name="button" value = "insc" class="sign-up" ><label for="tab-2" class="tab">Inscription</label>
                    <form class="login-form" method="post" novalidate>
                        <div class="sign-in-htm">
                            <div class="group">
                                <label for="userLog" class="label">Nom d'utilisateur</label>
                                <input id="userLog" type="text" class="input" name="userLog">
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <label for="passLog" class="label">Mot de passe</label>
                                <input id="passLog" type="password" class="input" data-type="password" name="passLog">
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <input id="check" type="checkbox" class="check" checked>
                                <label for="check"><span class="icon"></span> Rester connecter</label>
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Sign In" name="log_user">
                            </div>
                            <div class="hr"></div>
                            <div class="foot-lnk">
                                <a href="#forgot">Oublier votre mot de passe?</a>
                            </div>
                        </div>
                        <div class="sign-up-htm">
                            <div class="group">
                                <label for="user" class="label">Nom d'utilisateur</label>
                                <input id="user" type="text" class="input" name="username" required>
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Mot de passe</label>
                                <input id="pass" type="password" class="input" name="password" required>
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <label for="passConf" class="label">Confirmer le mot de passe</label>
                                <input id="passConf" type="password" class="input" name="confirm_password" required> 
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <label for="email" class="label">Adresse courriel</label>
                                <input id="email" type="email" class="input" name="email" required>
                                <span class="error" aria-live="polite"></span>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="S'inscrire" name="reg_user">
                            </div>
                            <div class="hr"></div>
                            <div class="foot-lnk">
                                <label for="tab-1">Déja un membre?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
            //On ajuste les marges si nous devons afficher les messages d'erreurs pour leurs donner de l'espace.
            if(isset($errorMsg)){
                ?>
                <section class="middle-section" style="margin-top:7vh; margin-bottom:7.5vh;" data-aos="fade-in" data-aos-delay="100">
                <?php
            }else{
                ?>
                <section class="middle-section" data-aos="fade-in" data-aos-delay="100">
                <?php
            }
        ?>
            <!-- On affiche encore les avantages de notre service -->
            <div class="container-fluid">
                <div class="row-avantages">
                    <div class="box-avantage">
                        <img class="img-avantage" src="images/service.png">
                        <h5>SERVICE PERSONNALISÉ</h5>
                        <hr>
                        <p class="description-avantage">
                            <span class="techdojo-ref">Tech Dojo </span> vous offre la possibilité de personnalisable l'environnement
                            visuel de votre agenda. Que ce soit avec vos propres logos, photos ou couleurs.   
                        </p>
                    </div>
                    <div class="box-avantage">
                        <img class="img-avantage" src="images/user.png">
                        <h5>TECHNICIEN FIABLE POUR UN TRAVAIL BIEN FAIT</h5>
                        <hr>
                        <p class="description-avantage">
                            Notre équipe de spécialiste est la pour vous aider et vous permettre de vous sentir plus a l'aise avec votre nouvel appareil !
                        </p>
                    </div>
                    <div class="box-avantage">
                        <img class="img-avantage" src="images/simple.png">
                        <h5>SIMPLE COMME "BONJOURS"</h5>
                        <hr>
                        <p class="description-avantage">
                            Grâce à notre programme qui saura vous guider au cours de la plannification de votre rendez-vous, vous pourrez savoir ce qui se passe
                            avec votre ordinateur.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script type="text/javascript" src="./js/validate.js"></script> 
    </body>
</html>