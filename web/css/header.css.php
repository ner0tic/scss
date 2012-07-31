<?php
    header("Content-Type: text/css");
    require_once('scheme.css.php');
?>
header {
    height: 60px;
    background: <?php echo $fadedGold ?> url('/images/header.png') repeat-x 0 0;
    width: 100%;
}
/*******************************************************************************
logo
*******************************************************************************/
#logo {
    height: 37px;
    font-family: "gill sans mt", veranda, arial;
    font-size: 24pt;
    font-weight: bold;
    letter-spacing: -3px;
    text-align: left;
    width: auto;
    max-width: 550px;
    position: relative;
    index: 999;
}
#logo > a {
    text-decoration: none;
    font-style: normal;
    font-weight: bold;
    color: <?php echo $logoDark ?>;    
}
#logo > a:hover { 
    color: <?php echo $logoLt ?>;
}
#logo > a > span {
    color: <?php echo $gold ?>;
    font-weight: normal;
}
#logo > sup {
    font-style: italic;
    color: <?php echo $logoLt ?>;
    letter-spacing: -1px;
    font-size: 16pt;
    vertical-align:baseline;
    position: relative;
    left: -40px;
    top:-12px;
    font-variant: small-caps;
    font-family: Alexa;
    font-weight: bold;
}
img.logo { display: none;}
/*******************************************************************************
nav-bar
*******************************************************************************/
ul#top-links { 
    float: right;
    margin: 15px 0 0;
    padding: 0;
}
ul#top-links li {
    color: #474747;
    float: left;
    font-size: 12px;
    font-weight: bold;
    list-style: none;
    margin: 0;
    padding-right: 7px;
}
#top-links li a,
#top-links li input {
    border-left: 1px solid #ccc;
    padding-left: 7px;
    text-decoration: none;
}
#top-links li:first-child a {border: none;}
#top-links li#active-enrollment {position: relative;}
#top-links li#active-enrollment a { 
    color: #474747;
    text-decoration: none;
    padding-left: 1px;
}
#top-links li#active-enrollment a:hover {text-decoration: underline;}
#top-links li#active-enrollment em { 
    color: #777;
    font-style: normal;
    font-weight: normal;
}
#top-links li#active-enrollment input[type=text] {
    background: #fff;
    border: 1px solid #d9d9d9;
    color: #555;
    font: inherit;
    font-size: 12px;
    font-weight: bold;
    margin: -6px 0 0 7px;
    padding: 5px;
    width: 100px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
#active-enrollment { text-align: right; }
#top-links a.active-troop { 
    padding:4px 6px 6px;
    text-decoration:none;
    font-weight:bold;
    color:#fff;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    *background:transparent url("/images/active-bg-ie.png") no-repeat 0 0; padding:4px 12px 6px;
}
#top-links a.active-troop:hover { 
    background: <?php echo $gold ?>;
    *background: transparent url("/images/active-bg-hover-ie.png") no-repeat 0 0;
    *padding: 4px 12px 6px;
}
#top-links a.active-troop,
#top-links a.active-troop:hover { *background-position:0 3px!important; }
a.active-troop { postion: relative; margin-left: 3px; }
a.active-troop span { background-image:url("/images/toggle_down_light.png"); background-repeat:no-repeat; background-position:100% 50%; padding:4px 16px 6px 4px;}
#top-links a.menu-open { background:<?php echo $fadedGold ?> !important; color:#666!important; outline:none; }
a.active-troop.menu-open span { background-image:url("/images/toggle_up_dark.png"); color:#789; }
#active-enrollment-menu { -moz-border-radius-topleft:5px; -moz-border-radius-bottomleft:5px; -moz-border-radius-bottomright:5px; -webkit-border-top-left-radius:5px; -webkit-border-bottom-left-radius:5px; -webkit-border-bottom-right-radius:5px; display:none; background-color:<?php echo $activeBtn ?>; position:absolute; width:250px; z-index:1000; border:1px transparent; text-align:left; padding:12px; top: 14px; right: 7px; margin-top:5px; margin-right: 0px; *margin-right: -1px; color:#789; font-size:11px; min-height: 400px; }
#active-enrollment-menu h3 { font-size: small; color: <?php echo $green; ?>; font-variant: small-caps; }

/* change active troop */
a.dropdown { color: <?php echo $logoLt ?> !important; position: relative; margin-left: 3px; background: <?php echo $activeBtn ?> url('/images/toggle_down_light.png') auto right no-repeat; padding: 4px 16px 6px; text-decoration: none; font-weight: bold; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; }
a.dropdown:hover { color: <?php echo $offBlack ?> !important; background: <?php echo $gold ?>; }
a.dropdown span { background: transparent url(../images/toggle_down_light.png) 100% 50% no-repeat; padding: 4px 16px 6px 0; }
a.dropdown.dropdown-active { color: <?php echo $white ?>; background-color: <?php echo $green ?>; }
a.dropdown.dropdown-active span { background:url(../images/toggle_up_dark.png) 100% 50% no-repeat; }
.dropdown-content  { background: <?php echo $green ?>; padding:7px 12px; position:absolute; top:16px; right:0; display:none; z-index:5000; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; -moz-border-radius-bottomright: 5px; -webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -webkit-border-bottom-right-radius: 5px; }
.dropdown-content p { font-size:11px; }
.dropdown-content a:link, .dropdown-content a:visited  { font-weight:bold; color: <?php echo $gold ?>; text-decoration:none; line-height:1.7em; }
.dropdown-content a:active, .dropdown-content a:hover { color: <?php echo $gold ?>; }
* html .dropdown-content { top:28px; }
*+ html .dropdown-content { top:28px; }
#change-active-troop { float:left; margin-right:20px; }
#change-active-troop-content  { width:150px; }
#change-active-troop-content a  { display:block; }
.relative    { position:relative; }


/* Navigation */
.menu, .menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu {
  font-family: Proxima-nova-lt, sans-serif;
  z-index: 100;
  position: relative;
  top: -4px;
    list-style: none;
    padding: 0 20px;
    margin: 0;
    float: left;
    background: <?php echo $gold ?>;
}
.menu li {
  float: left;
  margin: 0;
  padding: 0;
  position: relative;
}
.menu li a, .menu li a:link, .menu li a:active, .menu li a:visited {
  font: bold 1.22em/25px Proxima-nova, sans-serif;
  color: <?php echo $offWhite ?>;
  display: block;
  padding: 0 9px;
  text-transform: lowercase;
  text-decoration: none;
      font-size: 12pt;
    font-weight: bold;
    list-style: none;
    margin: 0;
    padding-right: 7px;
    font-variant: small-caps;
    text-align: center;
    margin-right: 5px;
    padding-left: 5px;
}

.menu li a:hover {
  color: rgba(173,152,59,0.99);
    -webkit-transition-duration: .40s;
    -webkit-transition-property: color, background, box-shadow;
    -moz-transition-duration: .40s;
    -moz-transition-duration: color, background, box-shadow;
    transition-duration: .40s;
    transition-property: color, background, box-shadow;

}
#menu-one li:hover a,
#menu-one li.sfHover a {

}
#menu-one li:hover ul a,
#menu-one li.sfHover ul a {

}
#menu-one li:hover ul a:hover,
#menu-one li.sfHover ul a:hover {

}
.has-sub-menu {
    background: transparent url(/images/toggle_down_light.png) no-repeat left 7px;
    padding-left: 10px !important;
}
.has-sub-menu:hover {
    background: transparent url(/images/toggle_up_dark.png) no-repeat left 7px;
}
.menu ul {
  background: <?php echo $gold ?>;
  border-radius: 0 0 5px 5px;
  list-style: none;
  margin: 0;
  position: absolute;
  top: -999em;
  left: -1px;
}
.menu li:hover ul,
.menu li.sfHover ul {
  top: 25px;
}
.menu ul li {
  border: 0;
  float: none;
  padding: 10px 5px;
}
.menu ul a {
  border-bottom: 0;
  padding-right: 20px;
  white-space: no-wrap;
  width: auto;
  display: block;
}
.menu ul a:hover {
  background: <?php echo $gold ?>;
  color: #000;
}



/***
.nav-bar {
    font-weight: bold;
    min-height:38px;
    -webkit-text-stroke: 1px transparent;
}
.nav-bar li {
    list-style: none;
    display: inline;
    text-align: center;
    margin-right: 5px;
}
.nav-bar a, .nav-bar a:visited {
    font-family: "Proxima-nova-b, Proxima-nova-lt, sans-serif";
    color: rgba(255,255,255,0.99);
    font-size: 14px;
    font-weight: 600;
}
.nav-bar a:hover {
    color: rgba(173,152,59,0.99);
    -webkit-transition-duration: .40s;
    -webkit-transition-property: color, background, box-shadow;
    -moz-transition-duration: .40s;
    -moz-transition-duration: color, background, box-shadow;
    transition-duration: .40s;
    transition-property: color, background, box-shadow;
}
.nav-bar ul, .nav-bar ul li {
    
}
li.menu-item {
    padding-right: 14px !important;
}
.has-sub-menu {
    background: transparent url(/images/toggle_down_light.png) no-repeat right 5px;
}
ul.sub-menu {
    display: none;
    width: 169px;
    background-color: <?php echo $gold ?>;
    padding: 0 0 12px 0;
    height: 100%;
}
.sub-menu li {
    display:block;
    margin:5px 20px;
    padding: 5px 0px;
    border-top: dotted 1px #606060;
    list-style-type:none;

}
.nav-bar ul li {
    color: #474747;
    float: left;
    font-size: 12pt;
    font-weight: bold;
    list-style: none;
    margin: 0;
    padding-right: 7px;
    font-variant: small-caps;
    text-align: center;
    margin-right: 5px;
    height: 99%;
    padding-left: 5px;
}
*/
