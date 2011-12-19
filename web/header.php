<html>
    <head>
        <title>header</title>
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/scss.css.php">
        <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="/js/mylibs/jquery.js"%3E%3C/script%3E'))</script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="/js/mylibs/jquery-ui.js"%3E%3C/script%3E'))</script>
        <script src="/js/scss.js"></script>
    </head>
    <body>
        <div id="header">
            <div class="container">
                <div id="logo">
                    <a href="#">summercamp<span>schedulingsystem</span></a><sup>BETA</sup>
                </div>
                <ul class="nav-bar menu">
                    <li id="menu-item-home" class="menu-item"><a href="#">home</a></li>
                    <li id="menu-item-scout_mgmt" class="menu-item has-sub-menu">
                        <a href="#">scout management</a>
                        <ul class="sub-menu">
                            <li class="menu-item" id="menu-item-scout_add"><a href="#">add a scout</a></li>
                            <li class="menu-item" id="menu-item-scout_enroll"><a href="#">enroll scouts</a></li>
                        </ul>
                    </li>
                    <li id="menu-item-troop_mgmt" class="menu-item has-sub-menu">
                        <a href="#">troop management</a>
                        <ul class="sub-menu">
                            <li class="menu-item" id="menu-item-troop_photos"><a href="#">troop photos</a></li>
<!--                            <li class="menu-item" id="menu-item-troop_patrol_add"><a href="#">add a patrol</a></li>-->
                            <li class="menu-item" id="menu-item-troop_patrol_mgmt"><a href="#">patrol management</a></li>
                        </ul>
                    </li>
                    <li id="menu-item-reports" class="menu-item has-sub-menu">
                        <a href="#">reports</a>
                        <ul class="sub-menu">
                            <li class="menu-item" id="menu-item-report_alpha"><a href="#">Alphabetical List</li>
                            <li class="menu-item" id="menu-item-report_scout_patrol"><a href="#">Scouts By Patrol List</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>