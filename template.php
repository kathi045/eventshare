<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">
        <?php echo $meta; ?>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDyHhVHte59a5sA5_SBRfI3vvE_crUR12A&sensor=false"></script>
        <?php echo $js; ?>
    </head>
    <body>
        <div id="main">
            <div id="headbar">
                <div id="headbarbuttons">
                    <div>
                        <a class="button" href="?url=newevent">Neues Event</a>
                        <a class="button" href="?url=changelog">Changelog lesen</a>
                    </div>
                </div>
                <div id="logo">
                    <a href="?url=home">
                        <img src="img/logo_1.png" width="450">
                    </a>
                </div>
            </div>
            <div id="page">
                <div id="sidemenu">
                    <ul>
                        <li><a>Archiv</a></li>
                        <ul>
                            <li><a>Dezember 2013</a></li>
                            <li><a>November 2013</a></li>
                            <li><a>Oktober 2013</a></li>
                            <li><a>September 2013</a></li>
                            <li><a>August 2013</a></li>
                            <li><a>Juli 2013</a></li>
                        </ul>
                        <li><a>Noch ein Link</a></li>
                        <li><a>Noch etwas</a></li>
                    </ul>
                </div>
                <div id="content">

                    <?php echo $content;?>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>
