<?php
    header("Content-Type: text/css");
    require_once('scheme.css.php');
?>

@font-face { font-family: "Alexa"; src: url('AlexaStd.otf'); }
@font-face { font-family: "Proxima-nova-lt"; src:url('ProximaNova-Light.otf'); font-style:normal; font-weight:300; }
@font-face { font-family: "Proxima-nova-lt"; src:url('ProximaNova-Light.otf'); font-style:normal; font-weight:400; }
@font-face { font-family: "Proxima-nova-b"; src:url('ProximaNovaCond-Semibold.otf');}
@font-face { font-family: "Proxima-nova"; src:url('ProximaNova.otf); font-style:normal; font-weight:300; }
@font-face { font-family: "Proxima-nova"; src:url('ProximaNova.otf); font-style:normal; font-weight:400; }
@font-face { font-family: "Proxima-nova"; src:url('ProximaNova.otf); font-style:normal; font-weight:600; }

a:link, a:visited, a:active { color : <?php echo $logoDark ?>; text-decoration: none; font-weight : bold;}
a:hover { color : <?php echo $logoLt ?>; text-decoration: none; font-weight : bold;}
h1 { font-size : 24px; color : <?php echo $logoDark ?>; font-weight : bold; margin: 0;}
h2 { font-size : 20px; color : <?php echo $offBlack ?>; font-weight : normal; margin: 0;}
h3 { font-size : 14px; color : #888888; font-weight : normal; line-height: 20pt; margin: 0;}
.error { background: <?php echo $errorRed ?>; padding: 4px; border: 1px solid <?php echo $errorRed ?>; border-radius: 5px; }
body { margin: 0px; }
.container {
    width: 920px;
    margin: 0 auto;
    font-family: Proxima-nova, sans-serif;
}
.box {
    border: 1px solid <?php echo $gold ?>;
    margin-bottom: 20px; padding: 10px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    margin: 10px;
    background: <?php echo $offWhite ?>;
}
.box-content {

}
.sidebar { margin-top: 14px; float: left; width: 230px; margin-bottom: 5px; background-color: <?php echo $offWhite ?>; -moz-border-radius: 4px; -webkit-border-radius: 4px;}
.sidebar.multiple { background: none !important; float: none !important; margin-bottom: 0 !important; }
.sidebar .sidebar .module:last-child { -moz-border-radius-bottomleft: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-bottomright: 5px; -webkit-border-bottom-right-radius: 5px; border-bottom-left-radius: 5px 5px; border-bottom-right-radius: 5px 5px; }
.sidebar .sidebar .module:first-child { -moz-border-radius-topleft: 5px; -webkit-border-top-left-radius: 5px; -moz-border-radius-topright: 5px; -webkit-border-top-right-radius: 5px; border-top-left-radius: 5px 5px; border-top-right-radius: 5px 5px; }
.sidebar .module:last-child { border-bottom: none; }
.sidebar .sidebar .module { background-color: <?php echo $offWhite ?>; }
.custom-ui-stats.module { padding: 0; height: min-76px; }
.custom-ui-stats.module a span { font-size: 15px; display: block; text-align: center; color: black; text-shadow: 0 1px 0 white; }
.custom-ui-stats.module a { float: left; margin-right: 0; display: block; width: 76px; padding: 12px 0 15px; border-left: 1px solid white; background-color: <?php echo $offWhite ?>; background: -webkit-gradient(linear,left top,left bottom,color-stop(0,#F4F4F4),color-stop(1,#D9D9D9)); background: -moz-linear-gradient(center top,#F4F4F4 25%,#D9D9D9 100%); }
.custom-ui-stats.module a.first { border: none; -moz-border-radius-topleft: 4px; -webkit-border-top-left-radius: 4px; -moz-border-radius-bottomleft: 4px; -webkit-border-bottom-left-radius: 4px; border-top-left-radius: 4px 4px; border-bottom-left-radius: 4px 4px; }
.custom-ui-stats.module a.last { -moz-border-radius-topright: 4px; -webkit-border-top-right-radius: 4px; -moz-border-radius-bottomright: 4px; -webkit-border-bottom-right-radius: 4px; border-top-right-radius: 4px 4px; border-bottom-right-radius: 4px 4px; }
.custom-ui-stats.module span a { font-size: 12px; display: block; text-align: center; color: <?php echo $dkGreen ?>; text-shadow: 0 1px 0 white; font-weight: normal !-important; }
.custom-ui-stats.module span.count a { font-size: 18px; font-weight: bold; }

/************************************************
**              Welcome Page                   **
************************************************/

#focus-wrapper { height: 300px; background: <?php echo $offWhite ?>; }

#blurp-box { position: relative; z-index: 400; top: -250px; width: 250px; margin-left: 64%;}

#details { width: 100%; height: 100%;}
table#detail-items { display: inline; margin: 0 auto; background: <?php echo $dkOlive ?>; } 
td.detail-item { background: <?php echo $dkBrown ?>; color: #474747; font-size: 12px; font-weight: bold; padding: 0 10px 10px 10px; width: 30%;}
td.detail-item h2, li.detail-item p { max-width: 300px; color: <?php echo $fadedGold ?>; vertical-align: middle;  }
td.detail-item h2 {  display: inline-block; position: relative; margin-top: -40px; font-family: "gill sans mt", veranda, arial; font-size: 2em; font-weight: bold; letter-spacing: -3px; text-align: left; width: 100%; }
td.detail-item p { color: <?php echo $beige ?> !important; margin-left: 60px; display: inline-block; float: right;}
td.detail-item img { padding: 10px; top: 65px; position: relative; }
td#mobile { width: 40% !important; }
td#mobile img { margin-left: 0 !important; padding-top: 150px !important; position: relative; }
td#mobile h2 { top: 10px; }
td#mobile p { margin-left: 160px !important;
td#mobile span { display: none; }

.main-content { float: left; width: 100%; max-width: 898px; margin: 0 !important; margin-top: 10px !important; }
/************************************************
**                Info Box                     **
************************************************/
.info-box-wrapper { width: 670px !important; float: left; overflow: hidden; margin-left: 20px; }
#info-box { background: <?php echo $fadedGold ?>; border: 1px solid <?php echo $gold ?>; padding: 10px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; margin:5px !important; }
#info-box .avatar { width: 53px; height: 53px; float: left;}
#info-box em, #info-box strong, #info-box h2 { color: <?php echo $offBlack ?>; font-style: normal; }
#info-box hr { background: <?php echo $gold ?>; border: none; border-bottom: 1px solid #ltGold; height: 1px; margin: 2px 0; line-height: 12px; }
#info-box h2 a {color: #444; font-weight: normal;}
#info-box h2 a:hover {color: <?php echo $dkGreen ?>;}
#info-box p { margin: 5px 0 0 70px; width: 390px; font-variant: small-caps; font-size: small;}
#info-box strong.week { position: relative; top: -20px;}
#dashboard #info-box { position: relative; }
.page-margin-offset {
 
.datagrid table { width: 100%; }
.datagrid table th { font-weight: bold; }
.datagrid table td { width: 10%; margin: 0 auto; }
#alert-box {
    max-width: 650px;
    min-width: 650px;
    float: left;

}
#msg-box {
    max-width: 350px;
    float: left;
}

div.pagination a.page { height: 37px; width: 37px; background: url('/images/pagination/page.png') no-repeat 0 0; text-align: center; font-size: 13px; color: <?php echo $black ?>; }
div.pagination a.active { background: url('/images/pagination/page.png') no-repeat 0 0 !important; color: <?php echo $white ?> !important; }

/************************************************
**              Buttons                        **
************************************************/
/***************Green***************************/
.greenButton { background: #A7E300; background: -webkit-gradient(linear, left top, left bottom, from(#A7E300), to(#99D100)); background: -moz-linear-gradient(top,  #A7E300,  #99D100); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#A7E300', endColorstr='#99D100'); border: 1px solid #87b800; color: #fff; cursor: pointer; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 11px; font-weight: bold; height: 30px; line-height: 30px; padding: 0 10px; text-align: center; text-shadow: rgba(0,0,0,.1) 0 -1px 0; text-transform: uppercase; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; }
.greenButton:hover { background: #b2eb14; background: -webkit-gradient(linear, left top, left bottom, from(#b2eb14), to(#a4da14)); background: -moz-linear-gradient(top,  #b2eb14,  #a4da14); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b2eb14', endColorstr='#a4da14'); }
.greenButton:active { background: #99D100; background: -webkit-gradient(linear, left top, left bottom, from(#99D100), to(#A7E300)); background: -moz-linear-gradient(top,  #99D100,  #A7E300); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99D100', endColorstr='#A7E300');}
a.greenButton, .greenButton a { color: #fff; display: block; text-decoration: none; }
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