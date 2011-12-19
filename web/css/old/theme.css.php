<?php
    header("Content-Type: text/css");
    require('scheme.css.php');
?>
/************************************************
**                Dom                          **
************************************************/
a:link, a:visited, a:active { color : <?php echo $dkGreen ?>; text-decoration: none; font-weight : bold;}
a:hover { color : <?php echo $olive ?>; text-decoration: none; font-weight : bold;}
h1 { font-size : 24px; color : #0066cc; font-weight : bold; margin: 0;}
h2 { font-size : 24px; color : #0066cc; font-weight : normal; margin: 0;}
h3 { font-size : 18px; color : #888888; font-weight : normal; line-height: 20pt; margin: 0;}
/************************************************
**                Container                    **
************************************************/
div#container { margin-left: auto; margin-right: auto; width: 948px; position: relative; }
.container { margin-left: auto; margin-right: auto; max-width: 865px; position: relative;}
div.ul { margin: 0 0 3px 0;}
/************************************************
**                Header                       **
************************************************/
#header { background-color: <?php echo $fadedGold ?>; height: 75px; width: 100%;}
#header ul#top-links { float: right; margin: 30px 0 0; padding: 0;}
#header ul#top-links li { color: #474747; float: left; font-size: 12px; font-weight: bold; list-style: none; margin: 0; padding-right: 7px;}
#header #top-links li a,
#header #top-links li input { border-left: 1px solid #ccc; padding-left: 7px;}
#header #top-links li:first-child a {border: none;}
#header #top-links li#active-enrollment {position: relative;}
#header #top-links li#active-enrollment a { color: #474747; text-decoration: none; padding-left: 1px;}
#header #top-links li#active-enrollment a:hover {text-decoration: underline;}
#header #top-links li#active-enrollment em { color: #777; font-style: normal; font-weight: normal;}
#header #top-links li#active-enrollment input[type=text] { background: #fff; border: 1px solid #d9d9d9; color: #555; font: inherit; font-size: 12px; font-weight: bold; margin: -6px 0 0 7px; padding: 5px; width: 100px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;}
#active-enrollment { text-align: right; }
<?php include_once('top.css.php'); ?>
/****************Navbar*************************/
#nav { /*background: <?php echo $olive ?>; border-bottom:1px solid <?php echo $dkOlive ?>;*/ font-weight: bold; height:38px; -webkit-text-stroke: 1px transparent;}
<?php include_once('menu.css.php'); ?>
/*****************Logo**************************/
div.logo { height: 65px; font-family: "gill sans mt", verdana, arial; font-size: 24pt; font-weight: bold; letter-spacing: -3px; text-align: left; width: auto; max-width: 550px; position: relative; top: 0px; z-index: 999;}
div.logo > a { text-decoration: none; font-style: normal; font-weight: bold; color: #ad983b; letter-spacing: -2px;}
div.logo > a:hover { color: #76ad3b;}
div.logo > a > span { color: #d4ba48;font-weight: normal;}
div.logo > sup { font-weight: bold; color: black; letter-spacing: -1px; font-size: 12pt; vertical-align:baseline;position: relative;left: -40px;top:12px;}
img.logo { display: none;}
/************************************************
**                Content                      **
************************************************/
.page-wide { float: left;}
.page-wide li { list-style: none; }
.page-wide ul { padding: 0px; margin: 0px; }
.page-wide .wide-container { position: relative;}
.page-wide .wrapper-box { background-color: #f9f9f9; border: 1px solid #cccccc; margin-bottom:13px; overflow:hidden; padding: 10px; position: relative;  -moz-border-radius:5px; -webkit-border-radius:5px; border-radius: 5px;}
.page-wide .wrapper-box.top-flat { -moz-border-radius-topright:0px; -moz-border-radius-topleft:0px; -webkit-border-top-right-radius:0px; -webkit-border-top-left-radius:0px; border-radius: 0px 0px 5px 5px; }
.page-wide .wrapper-box.top-flat img.thumbnail { height:50px; width:50px; }
.page-wide h2 { color: #444; font-size: 20px; font-weight: bold;}
/************************************************
**                Left Column                  **
************************************************/
.page-wide .column-left { width: 285px; float: left; overflow:hidden;}
/*****************Sidebar Widgets***************/
.sidebar-widget-container .header { background: <?php echo $ltOlive ?>; border-bottom:1px solid <?php echo $ltOlive ?>; font-weight: bold; height:27px; margin-bottom: -1px !important; z-index: 40; position: relative; -moz-border-radius-topright:5px; -moz-border-radius-topleft:5px; -webkit-border-top-right-radius:5px; -webkit-border-top-left-radius:5px; border-radius: 5px 5px 0px 0px; -webkit-text-stroke: 1px transparent;}
.sidebar-widget-container .header p,
.sidebar-widget-container .header p a { margin-left: 4px; padding: 0px; color: #fff; font-size: 15px;max-height: 16px;}
.sidebar-widget-container .header ul,
.sidebar-widget-container .header em { position:absolute; right:0; top:9px;}
.sidebar-widget-container .header em { margin: 0px; padding: 0px; color: #fff; font-size:12px; right: 10px; }
.sidebar-widget-container .header em a { border-bottom:1px dotted #ffffff; color:#FFFFFF; font-style:normal; }
.sidebar-widget-container .header em a:hover { text-decoration: none; border-bottom: 1px solid #ffffff; }
.sidebar-widget-container .header ul { margin-right:5px; margin-top:-1px;}
.sidebar-widget-container .header li { float:left; padding:0; }
.sidebar-widget-container .header li a { color:#FFFFFF; font-size:11px; font-weight:normal; font-weight:bold; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px;}
.sidebar-widget-container .header li a.selected { background: rgba(0, 0, 0, 0.1); text-decoration: none; }
.sidebar-widget-container .header li a:hover { text-decoration: underline; }
/*************Quick Report Widget***************/
#quick-reports wrapper-box {background-color: <?php echo $ltFadedGold ?>;border: 1px solid <?php echo $ltOlive ?>;}
.get-report p { float: right; position: relative; max-width: 70px;}
.get-report { width: 124px; height: 54px; /*background-color: #fff; border: 1px solid #fff; border-radius: 5px 5px;*/ float: left; margin: 0 auto; padding-left: 2px; padding-right: 2px;}
/*************Alerts Module*********************/
/*#alerts-module { border: 1px solid <?php echo $ltOlive ?>; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px 5px;}
#alerts-module a { /*border-bottom: 1px solid <?php echo $ltOlive ?>;*/ border-top: 1px solid #fff; color: #555; display: block; font-weight: normal; padding: 20px; padding-left: 80px;}
#alerts-module a strong { color: red; display: block; font-size: 15px;}
#alerts-module a.alert-warning { background: <?php echo $warningYellow ?> url('/images/themes/freezetag/alertWarning.png') 10px 7px no-repeat; border-top: none;}
#alerts-module a.alert-question { background: <?php echo $questionBlue ?> url('/images/themes/freezetag/alertQuestion.png') 10px 7px no-repeat; border-top: none;}
#alerts-module a.alert-error { background: <?php echo $errorRed ?> url('/images/themes/freezetag/alertError.png') 10px 7px no-repeat; border-top: none;}*/
span.date { font-weight: bold; font-size: medium;}
#overdue-widget { position: relative; left: -10px;}
#overdue-widget .header {background: <?php echo $dkOrange ?>; border-bottom:1px solid <?php echo $dkOrange ?>; font-weight: bold; max-height:16px !important; margin-bottom: -1px !important; z-index: 40; position: relative; -moz-border-radius-topright:5px; -webkit-border-top-right-radius:5px; border-radius: 0px 5px 0px 0px; -webkit-text-stroke: 1px transparent;}
#overdue-widget .header p { text-align: right; }
#overdue-widget .header p,
#overdue-widget .header p a { margin: 0px; padding: 0px; color: #fff; font-size: 15px;margin-right: 4px;}
#overdue-widget .wrapper-box {background: <?php echo $white ?>;border-left: 0;border-top:none;-moz-border-radius:none;-webkit-border-radius:0px;border-right: 1px solid <?php echo $ltGray ?>;border-bottom: 1px solid <?php echo $ltGray ?>;-moz-border-radius-bottomright: 5px;-webkit-border-bottom-right-radius:5px;}
span.alert-late {}
#soon-widget { position: relative; left: -10px;}
#soon-widget .header {background: <?php echo $dkOrange ?>; border-bottom:1px solid <?php echo $dkOrange ?>; font-weight: bold; max-height:16px !important; margin-bottom: -1px !important; z-index: 40; position: relative; -moz-border-radius-topright:5px; -webkit-border-top-right-radius:5px; border-radius: 0px 5px 0px 0px; -webkit-text-stroke: 1px transparent;}
#soon-widget .header p { text-align: right; vertical-align: middle; }
#soon-widget .header p,
#soon-widget .header p a { margin: 0px; padding: 0px; color: #fff; font-size: 15px; margin-right: 4px;}
#soon-widget .wrapper-box {background: <?php echo $white ?>;border-left: 0;border-top:none;-moz-border-radius:none;-webkit-border-radius:0px;border-right: 1px solid <?php echo $ltGray ?>;border-bottom: 1px solid <?php echo $ltGray ?>;-moz-border-radius-bottomright: 5px;-webkit-border-bottom-right-radius:5px;}
#soon-widget .wrapper-box span {border-right: 1px solid <?php echo $ltGray ?>;border-bottom: 1px dotted <?php echo $ltGray ?>;width: 242px;}
#soon-widget .wrapper-box .alert-soon {}
#soon-widget div span { line-height: 16px; width: 242px !important;border-bottom: 1px dotted <?php echo $ltGray ?>; font-weight: bold; }
#soon-widget div span select { border: 1px solid <?php echo $black ?>; font-weight: normal;vertical-align: top;}
#soon-widget div span p { font-weight: normal;font-variant: small-caps;display: inline;}
#soon-widget div .wrapper-box { border: none; }
div.calendar-wrapper { height: 150px;width: 242px;background: blue url('/images/themes/freezetag/calendar.png') no-repeat top; }
.alert-soon { color: <?php echo $black ?>; font-size: x-small; margin-bottom: 10px;}
span.date { border: none !important;color:<?php echo $olive ?>; font-variant: small-caps; display: block;font-size: medium;}
#alerts-module a:hover {text-decoration: none;}
#alerts-module a:hover strong {text-decoration: underline;}
/*************Social Media**********************/
#social-media {margin: 13px 0;}
#social-media img {margin-right: 5px;}
/************************************************
**               Right Column                  **
************************************************/
.page-wide .column-right { width: 555px; float: left; overflow: hidden; margin-left: 20px;}
/***************Welcome Box*********************/
#welcome-box { background: <?php echo $fadedGold ?>; border: 1px solid <?php echo $ltOlive ?>; margin-bottom: 20px; padding: 10px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
#welcome-box .avatar { width: 53px; height: 53px; float: left;}
#welcome-box em, #welcome-box strong { color: #666; float: right; font-style: normal; margin-top: 3px; }
#welcome-box hr { background: <?php echo $ltOlive ?>; border: none; border-bottom: 1px solid #fff; height: 1px; margin: 7px 0; }
#welcome-box h2 a {color: #444;}
#welcome-box h2 a:hover {color: <?php echo $dkGreen ?>;}
#welcome-box p { margin: 5px 0 0 70px; width: 390px;}
#welcome-box strong.week { position: relative; top: -20px;}
#dashboard #welcome-box { position: relative; }
#body { position: relative; top: 0; left: 24px; padding: 20px 20px 10px; width: 860px; background-color: white; clear: both; -moz-border-radius-bottomleft: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-bottomright: 5px; -webkit-border-bottom-right-radius: 5px;}
/*****************Data Table********************/
<?php include_once('datatable.css.php'); ?>
/*****************Add Widget********************/
#add-widget { border: 1px dashed <?php echo $ltOlive ?>; margin-bottom: 20px; padding: 10px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
/************************************************
**                Footer                       **
************************************************/
<?php include_once('footer.css.php'); ?>
/************************************************
**                Misc                         **
************************************************/
fieldset#active-enrollment-menu { }/*top: 20px; display: none; background-color: green !important<?php //echo $ltGold ?>; min-height: 75px; border: 1px solid <?php echo $ltGold ?>; border-bottom-left-radius: 5px 5px; border-bottom-right-bottom: 5px 5px; position: relative; z-index: 1000;}*/
.widget { border: 1px solid <?php echo $ltOlive ?>; border-bottom-left-radius: 5px 5px; border-bottom-right-radius: 5px 5px; border-top-right-radius: 5px 5px;  padding: 5px; margin-bottom: 5px; background: <?php echo $ltFadedGold ?>;}
.clearfix:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
.clearfix { display: inline-block; }
/* start commented backslash hack */
* html .clearfix { height: 1%; }
.clearfix { display: block; }
/* close commented backslash hack */
.relContainer { position: relative;}
.clear { clear: both;}
/***************Forms***************************/
<?php     include_once('form.css.php'); ?>
/************************************************
**              Buttons                        **
************************************************/
/***************Green***************************/
.greenButton { background: #A7E300; background: -webkit-gradient(linear, left top, left bottom, from(#A7E300), to(#99D100)); background: -moz-linear-gradient(top,  #A7E300,  #99D100); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#A7E300', endColorstr='#99D100'); border: 1px solid #87b800; color: #fff; cursor: pointer; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 11px; font-weight: bold; height: 30px; line-height: 30px; padding: 0 10px; text-align: center; text-shadow: rgba(0,0,0,.1) 0 -1px 0; text-transform: uppercase; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
.greenButton:hover { background: #b2eb14; background: -webkit-gradient(linear, left top, left bottom, from(#b2eb14), to(#a4da14)); background: -moz-linear-gradient(top,  #b2eb14,  #a4da14); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b2eb14', endColorstr='#a4da14'); }
.greenButton:active { background: #99D100; background: -webkit-gradient(linear, left top, left bottom, from(#99D100), to(#A7E300)); background: -moz-linear-gradient(top,  #99D100,  #A7E300); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99D100', endColorstr='#A7E300');}
a.greenButton, .greenButton a { color: #fff; display: block; text-decoration: none; }
input.greenButton {line-height: normal !important;}
@-moz-document url-prefix() { input.greenButton {padding-bottom: 2px;} }
/***************Grey****************************/
.greyButton { background: #e6e6e8; background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f9), to(#e6e6e8)); background: -moz-linear-gradient(top,  #f8f8f9,  #e6e6e8); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8f8f9', endColorstr='#e6e6e8'); border: 1px solid #ccc; color: #999; cursor: pointer; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 11px; font-weight: bold; height: 30px; line-height: 30px; padding: 0 10px; text-align: center; text-shadow: rgba(255,255,255,1) 0 1px 0; text-transform: uppercase; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
.greyButton:hover { background: #fcfcfc; background: -webkit-gradient(linear, left top, left bottom, from(#fcfcfc), to(#f3f2f3)); background: -moz-linear-gradient(top,  #fcfcfc,  #f3f2f3); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fcfcfc', endColorstr='#f3f2f3'); }
.greyButton:active { background: #f3f2f3; background: -webkit-gradient(linear, left top, left bottom, from(#f3f2f3), to(#fcfcfc)); background: -moz-linear-gradient(top,  #f3f2f3,  #fcfcfc); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f3f2f3', endColorstr='#fcfcfc'); }
a.greyButton, .greyButton a { color: #999; display: block; text-decoration: none; }
/***************Orange**************************/
.orangeButton { background: #A7E300; background: -webkit-gradient(linear, left top, left bottom, from(#ff9900), to(#ff6200)); background: -moz-linear-gradient(top,  #ff9900,  #ff6200); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff9900', endColorstr='#ff6200'); border: 1px solid #e55800; color: #fff; cursor: pointer; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 11px; font-weight: bold; height: 30px; line-height: 30px; padding: 0 10px; text-align: center; text-shadow: rgba(0,0,0,.1) 0 -1px 0; text-transform: uppercase; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
.orangeButton:hover { background: #ffad32; background: -webkit-gradient(linear, left top, left bottom, from(#ffad32), to(#ff8132)); background: -moz-linear-gradient(top,  #ffad32,  #ff8132); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffad32', endColorstr='#ff8132'); }
.orangeButton:active { background: #ff8132; background: -webkit-gradient(linear, left top, left bottom, from(#ff8132), to(#ffad32)); background: -moz-linear-gradient(top,  #ff8132,  #ffad32); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8132', endColorstr='#ffad32'); }
a.orangeButton, .orangeButton a { color: #fff; display: block; text-decoration: none; }