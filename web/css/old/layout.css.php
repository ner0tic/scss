<?php
    include_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
/*********************************
    container
*********************************/
html {
    font-size: 12px;
    background: <?php echo $offWhite ?>;
    height: 100%;
    min-height: 100%;
}
body {
    margin: 0 auto;
    height: 100%;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    line-height: 1.5;
}
#container {
    height: 100%;
    min-height: 100%;
}
ol, ul, li {
    list-style: none;
    display: inline;
}
/************************************************
**                Header                       **
************************************************/
<?php include_once 'header.css.php' ?>
/************************************************
**                    content                  **
************************************************/
#content {
    min-width: 600px;
    width: 960px;
    margin: 0px auto;
}
.pathbar, .pathbar a {
    font-size: medium;
    color: <?php echo $olive ?>;/*#1d8597;*/
    font-weight: bold;
    font-variant: small-caps;
    text-decoration: none;
    padding: 2px;
    margin: 5px auto;
    min-width: 800px;
    width: 100%;
}
.pathbar a {
    color: <?php echo $green ?> !important;
}
.pathbar a:hover {
    color: <?php echo $olive ?> !important;
}
.alert-center {
    min-height: 250px;
    width: 90%;
    min-width: 600px;
    margin: 5px auto;
    display: none;
    background: <?php echo $alertRed?> url('/images/alert_bg.png') no-repeat -20px 80px;
    border-bottom-left-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
    border-top-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border: 1px solid <?php echo $color[2]?>;
}
.close-btn {
    background: transparent url('/images/close-btn.png') no-repeat center center;
    width: 16px;
    height: 16px;
    cursor: pointer;
    position: relative;
    float: right;
    top: -15px;
    right: 4px;
}
.data-box {
    /*border-bottom-left-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
    border-top-left-radius: 0px 0px;
    border-top-right-radius: 0px 0px;
    */border: 1px solid <?php echo $offBlack ?>;
    background: <?php echo $fadedGold ?>;/*#F0B17C;*/
    padding: 10px;
    margin: 0px auto;
    min-width: 600px;
    width: auto;
    position: relative;
    min-height: 250px;
    height: auto;
    vertical-align: top;
}
/************************************************
**                Datatable                    **
************************************************/
<?php include_once 'datatable.css.php' ?>
/************************************************
**                Footer                       **
************************************************/
<?php include_once 'footer.css.php' ?>
/************************************************
**				  Misc						   **
************************************************/
<?php include_once 'form.css.php' ?>
<?php include_once 'enrollments.css.php' ?>
.btn {
    cursor: pointer;
    border-top-left-radius: 5px 5px;
    border-bottom-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
    display: inline-block;
    line-height: 1.25em;
    font-weght: bold;
    font-size: 1.16667em;
    overflow: visible;
    padding: 7px;
    width: auto;
    zoom: 1;
}
.btn-main {
    background: <?php echo $medRed ?>;
    border: 1px solid <?php echo $dkRed ?>;
    color: <?php echo $white ?>;
    text-shadow: <?php echo $medRed ?> 0px -1px 0px;
}
.clear-btn {
    border: none;
    background: transparent;
    color: <?php echo $black ?>;
    font-family: veranda, tahoma;
    font-size: 11px;
}