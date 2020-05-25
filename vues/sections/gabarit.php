<!DOCTYPE html>
<html>
    <head>
        <meta charset= "UTF-8">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type ="text/css" href="./css/style.css">
        <script src = "https://code.jquery.com/jquery-1.10.2.js"></script> 
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    </head>

    <body>
        <?php
        include("navbar.php");
        ?>
        <div>
            <?php echo $contenu; ?>
        </div>
    </body>
    <footer>
        <?php
            include("footer.php");
        ?>
    </footer>
</html>