<?php
    header("Content-Type: text/css");
    require_once('scheme.css.php');
?>
div#signin-form input[type=submit] { float: right; }
#signin-form  { display: inline-block; }
#signin-quicklinks-wrapper { width: 40%; display: inline-block; position: relative; vertical-align: top; margin-left: 20px; }
ul#quicklinks li { list-style: none; }
h2, li p { max-width: 300px; color: <?php echo $logoDark ?>; vertical-align: middle;  }
h2 { padding-bottom: 10px; display: inline-block; position: relative; font-family: "gill sans mt", veranda, arial; font-size: 2em; font-weight: bold; letter-spacing: -3px; text-align: left; width: 100%; }

.form-wrapper { max-width: 50%; margin-left: 0px; border-right: 1px solid <?php echo $white ?>;  padding-right: 40px; }

#facebook a { background: url('/iamges/social/connect/facebook.png'); height: 29px; width: 162px; }