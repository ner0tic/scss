<?php
    header("Content-Type: text/css");
    require('scheme.css.php');
?>
/************************************************
**                top                          **
************************************************/
#top-links a.active-troop { background:<?php echo $popoutBeige ?>; padding:4px 6px 6px; text-decoration:none; font-weight:bold; color:#fff; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; *background:transparent url("/images/themes/freezetag/active-bg-ie.png") no-repeat 0 0; padding:4px 12px 6px;}
#top-links a.active-troop:hover { background: <?php echo $ltGold ?>; *background: transparent url("/images/themes/freezetag/active-bg-hover-ie.png") no-repeat 0 0; *padding: 4px 12px 6px; }
#top-links a.active-troop,
#top-links a.active-troop:hover { *background-position:0 3px!important; }
a.active-troop { postion: relative; margin-left: 3px; }
a.active-troop span { background-image:url("/images/themes/freezetag/toggle_down_light.png"); background-repeat:no-repeat; background-position:100% 50%; padding:4px 16px 6px 0;}
#top-links a.menu-open { background:<?php echo $ltGold ?> !important; color:#666!important; outline:none; }
a.active-troop.menu-open span { background-image:url("/images/themes/freezetag/toggle_up_dark.png"); color:#789; }
#active-enrollment-menu { -moz-border-radius-topleft:5px; -moz-border-radius-bottomleft:5px; -moz-border-radius-bottomright:5px; -webkit-border-top-left-radius:5px; -webkit-border-bottom-left-radius:5px; -webkit-border-bottom-right-radius:5px; display:none; background-color:<?php echo $ltGold ?>; position:absolute; width:250px; z-index:1000; border:1px transparent; text-align:left; padding:12px; top: 14px; right: 7px; margin-top:5px; margin-right: 0px; *margin-right: -1px; color:#789; font-size:11px; }
#active-enrollment-menu h3 { font-size: small; color: <?php echo $green; ?>; font-variant: small-caps; }
/************************************************
**              tipsy                          **
************************************************/
.tipsy-inner { padding:10px 15px; line-height:1.5em; font-weight:bold; }
.tipsy { opacity:.8; filter:alpha(opacity=80); background-repeat:no-repeat; padding:5px; }
.tipsy-inner { padding:8px 8px; max-width:200px; font:11px 'Lucida Grande', sans-serif; font-weight:bold; -moz-border-radius:4px; -khtml-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; background-color:#000; color:white; text-align:left; }
.tipsy-north { background-image:url(/images/themes/freezetag/tipsy/tipsy-north.gif); background-position:top center; }
.tipsy-south { background-image:url(/images/themes/freezetag/tipsy/tipsy-south.gif); background-position:bottom center; }
.tipsy-east { background-image:url(/images/themes/freezetag/tipsy/tipsy-east.gif); background-position:right center; }
.tipsy-west { background-image:url(/images/themes/freezetag/tipsy/tipsy-west.gif); background-position:left center; }