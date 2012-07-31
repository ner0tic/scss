<?php
    header("Content-Type: text/css");
    require('scheme.css.php');
?>
#contact-4sq-pane { position: relative; float: right; top: -565px; }
h2 { color: <?php echo $red ?>; font-weight: bold; font-size: 2em !important; font-variant: small-caps; font-family: Alexa, arial; }
h2 span { position: relative; top: -16px; display: block; text-align: right; width: 50%; font-size: 0.7em !important; color: <?php echo $gray ?>;}
h2 span img { height: 0.7 em; }
div.gmap { height: 300px; width: 400px; }
div.checkin-wrapper {}
.recent-checkin {}
.recent-checkin a { }
.recent-checkin span { font-size: x-small; }
div.checkin-details {}
.checkin-details h3 {}
.checkin-details span {}
.checkin-details span a { display: inline; }

/*******************
DEBUG
********************
div.gmap { background: url('/images/gmap_tmp.png') no-repeat 0 0 ; }
/*******************
END DEBUG
********************/