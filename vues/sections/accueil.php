<!DOCTYPE html>
<html>
    <head>
        <title> TechDojo - Accueil </title>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>
    <body>
        <!-- Image de présentation du site -->
        <section class="top-section" data-aos="fade-in" data-aos-duration="1000">
            <section class="sommaire">
                <div class="sommaire-accueil">
                    <h1>VISER LE SOMMET</h1>
                    <hr>
                    <p >
                    <h3><span style="color: #13293D">TechDojo </span>vous permettera de recevoir
                        du soutien informatique professionnel aux <br> entreprises ou particulier grâce à un système de rendez-vous<span style="color: #13293D">.</span></h3>
                    </p>
                </div>            
            </section>
        </section>

        <!-- Section expliquant les avantages de nos services -->
        <section class="middle-section" data-aos="fade-in" data-aos-delay="100">
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

        <!-- Carousel des rabais de la semaine -->
        <section class="bottom-section" data-aos="fade-in" data-aos-delay="100">
            <!-- Slideshow container -->
            <div class="slideshow-container">
            <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                        <img src="./images/50off.png" style="width:100%">
                        <div class="text">50% de rabais sur votre premier mois!</div>
                </div>

                <div class="mySlides fade">
                        <img src="./images/handshake.jpg" style="width:100%">
                        <div class="text">Recevez 5$ pour chaque personne que vous invitez!</div>
                </div>

                <div class="mySlides fade">
                        <img src="./images/2p1.png" style="width:100%">
                        <div class="text">Obtenez deux mois pour le prix d'un!</div>
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>

                <!-- The dots/circles -->
                <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </section>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script src="./js/index.js"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>
