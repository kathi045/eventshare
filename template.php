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

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#222222">


        <!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
        <!--
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="">
        -->

        <!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
        <!--
        <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
        -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <?php echo $js; ?>
    </head>
    <body>
        <div id="main">
            <div id="headbar">
                <div id="headbarbuttons">
                    <div>
                        <a href="?url=newevent">
                            <input type="submit" value="Neues Event">
                        </a>
                        <a href="/changelog">
                            <input type="submit" value="Changelog lesen">
                        </a>
                    </div>
                </div>
                <div id="logo">
                    <a href="/">
                        <img src="img/eventshare_logo_2.png" width="350">
                    </a>
                </div>
            </div>
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

            <script src="js/vendor/zepto.min.js"></script>
            <script src="js/helper.js"></script>

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
                var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
                (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
                g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
                s.parentNode.insertBefore(g,s)}(document,"script"));
            </script>
        </div>
    </body>
</html>
