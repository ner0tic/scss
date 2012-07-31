<?php
    include_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
@font-face { font-family: Alexa; src: url('AlexaStd.otf'); }
.text-input, .select-input {
    -webkit-box-shadow: #D0D0D0 0px 1px 2px;
    background: <?php echo $white ?>;
    border: 1px solid <?php echo $black ?>;
    color: <?php echo $black ?>;
    font-size: 1.16667em;
    padding: 3px 4px 3px;
    display: block;
}
.select-input {
    color: <?php echo $black ?>;
}
.radio-input {
    padding: 3px 4px 3px;
    font-size: 1.16667em;
    -webkit-box-shadow: #D0D0D0 0px 1px 2px;
}
.radio-input:after,
.radio-input:before {
    display: block;
}
.radio-input < label {
    display: block;
}
.form-wrapper { max-width: 990px; margin: 0 auto; display: block !-important; }
.form-wrapper > div { border-top: 1px solid <?php echo $ltGray ?>; }
.form-wrapper div h1 { vertical-align: baseline; position: relative; left: 0px; top: -1px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; color: <?php echo $ltGray ?>; text-shadow: <?php echo $offWhite ?> 1px 1px 1px; }
.form-wrapper > div > p { padding-left: 15px; padding-right: 15px; }

.contact-item { width: 280px; height: /*280*/60px; float: left; display: inline-block; }
.contact-button { margin: 20px; background: #914f53; background: -webkit-gradient(linear, left top, left bottom, from(#914f53), to(#a6484e)); background: -moz-linear-gradient(top,  #914f53,  #a6484e); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#914f53', endColorstr='#a6484e'); border: 1px solid #6a2e32; color: #fff; cursor: pointer; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 11px; font-weight: bold; height: 30px; line-height: 30px; padding: 0 10px; text-align: center; text-shadow: rgba(0,0,0,.1) 0 -1px 0; text-transform: uppercase; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; max-width: 200px; }
.contact-button:hover { background: #914f53; background: -webkit-gradient(linear, left top, left bottom, from(#914f53), to(#a6484e)); background: -moz-linear-gradient(top,  #914f53,  #a6484e); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#914f53', endColorstr='#a6484e'); }
.contact-button:active { background: #a6484e; background: -webkit-gradient(linear, left top, left bottom, from(#a6484e), to(#914f53)); background: -moz-linear-gradient(top,  #a6484e,  #914f53); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6484e', endColorstr='#914f53');}
a.contact-button, .contact-button a { color: #fff; display: block; text-decoration: none; }
input.contact-button {line-height: normal !important;}
@-moz-document url-prefix() { input.contact-button {padding-bottom: 2px;} }

.contact-form-wrapper { /*max-width: 195px;*/ float: left; display: none; }
textarea#message { width: 185px; }
label { font-weight: bold; color: <?php echo $offBlack ?> }

/***************************************************************
    contact form
***************************************************************/
div.contact-social-wrapper.form-wrapper { min-height: 500px; border-right: 1px solid <?php echo $ltGray ?>; }
#contact form { /*background: <?php echo $ltGreen ?>; border-top: 1px solid #cccccc;*/ display: block; margin: 0 auto; padding: 20px; width: 450px; overflow: hidden; }
#contact h2 { color: #444; font-size: 62px; font-weight: bold; left: 5px; margin: 0 auto; margin-bottom: 25px; position: relative; font-family: Alexa, Veranda; }
#contact-form label { font-weight: normal !important; color: <?php echo $black ?>; position: absolute; top: 16px !important; left: 14px !important; }
#contact-form .greenButton, #contact .orangeButton, #contact input[type=submit] { float: right; }

.no-label { display: none; }
form p { position:relative; padding: 10px; }
