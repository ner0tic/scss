<?php
    require_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
#footer {
    clear: both;
    margin: 0px auto;
    text-align: center;
    border-top: 1px solid #AAA;
    bottom: 0px;
    color: #333;
    font-size: 0.833333em;
    padding: 5px 0px;
    position: fixed;
    left: 0px;
    width: 100%;
    height: 12px;
    background: <?php echo $fadedGold ?>;
}
#footer:after {
    clear:both;
    content:".";
    display:block;
    height:0;
    visibility:hidden;
}
.copyright {
    float: left;
    left: 0px;
    padding-left: 10px;
}
.footer-links {
    float: right;
    right: 10px;
    position: relative;
}
/***********************
    popout windows
***********************/
.donate-tab,
.about-tab,
.privacy-tab {
    cursor: pointer;
}
.donate-tab:hover,
.about-tab:hover,
.privacy-tab:hover, {
    background: <?php echo $ltFadedGold ?>;
    border-left: 1px solid <?php echo $black ?>;
    border-right: 1px solid <?php echo $black ?>;
}
.tab-active {
    font-weight: bold;
    font-color: <?php echo $white ?>;
}
.window-close {
    background: transparent url(/images/icons/close_pop.png) no-repeat;
    height: 50px;
    width: 50px;
    position: relative;
    float: left;
    top: -25px;
    left: -25px;
    z-index: 99999;
    cursor: pointer;
}
#donate-window {
    /*display: none;*/
    background: <?php echo $fadedGold ?>;
    border-top-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border: 1px solid #AAA;
    border-bottom: 1px solid <?php echo $fadedGold?>;
    max-width: 300px;
    max-height: 500px;
    z-index: 99998;
    position: fixed;
    right: 5px;
    bottom:22px;
    width: 100%;
    height: 100%;
    font-size: 16pt;
}
#donate-window > div {
    margin: 15px;
}
#privacy-window {
    /*display: none;*/
    background: <?php echo $fadedGold ?>;
    border-top-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border: 1px solid #AAA;
    border-bottom: 1px solid <?php echo $fadedGold?>;
    max-width: 300px;
    max-height: 500px;
    z-index: 99998;
    position: fixed;
    right: 55px;
    bottom:22px;
    width: 100%;
    height: 100%;
    font-size: 0.6em;
}
#about-window {
    /*display: none;*/
    background: <?php echo $fadedGold ?>;
    border-top-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border: 1px solid #AAA;
    border-bottom: 1px solid <?php echo $fadedGold?>;
    max-width: 300px;
    max-height: 500px;
    z-index: 99998;
    position: fixed;
    right: 115px;
    bottom:22px;
    width: 100%;
    height: 100%;
}
