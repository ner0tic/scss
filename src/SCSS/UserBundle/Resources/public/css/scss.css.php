<?php
    header("Content-Type: text/css");
    require_once('scheme.css.php');
?>


.error { background: <?php echo $errorRed ?>; padding: 4px; border: 1px solid <?php echo $errorRed ?>; border-radius: 5px; }

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
.page-margin-offset { }
 
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

