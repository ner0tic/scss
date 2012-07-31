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
input[type=text], textarea, select { border-radius: 5px; width: 400px !important;}
select { width: 410px !important; }
input[type=submit] {}
.date-select-input { width: 113px !important; display: inline-block; padding-left: 4px; padding-right: 4px; }

.form-content-wrapper { width: 420px; float: left; display: inline-block; }
.form-content-wrapper > div { margin-top: 10px; margin-bottom: 10px; }
.form-content-wrapper .date-select-input { margin-left: 10px; margin-right: 10px; }
.form-content-wrapper .date-select-input:first { margin-left: 0px !important; }
.form-content-wrapper .date-select-input:last { margin-right: 0px !important; }
.form-content-wrapper hr { width: 80%; margin: 0 auto; margin-top: 10px; margin-bottom: 10px;}
.form-msg-wrapper { width: 460px; display: inline-block;  }
.form-msg-content { border-radius: 5px; background: <?php echo $fadedGold ?>; min-height: 260px !important; padding: 10px; border: 1px solid <?php echo $gold ?>; }
li.help-item { display: none; }
li.help-item.active { display: block; }
li.help-item img { z-index: 1000; }
li#first_name-help img { margin-top: 8px; margin-left: -141px; }
li#last_name-help img { margin-top: 48px; margin-left: -141px; }
li#dob-help img { margin-top: 88px; margin-left: -100px; }
li#rank_id-help img { margin-top: 128px; margin-left: -110px; }
li#patrol_id-help img { margin-top: 168px; margin-left: -112px; }

#scout-form-wrapper form { /*background: <?php echo $ltGreen ?>; border-top: 1px solid #cccccc;*/ display: block; margin: 0 auto;overflow: hidden; }
#scout-form-wrapper h2 { color: #444; font-size: 62px; font-weight: bold; left: 5px; margin: 0 auto; margin-bottom: 25px; position: relative; font-family: Alexa, Veranda; }
#scout-form .form-input-wrapper label { font-weight: normal !important; color: <?php echo $black ?>; position: absolute; top: 18px !important; left: 10px !important; }
#scout-form .greenButton, #scout-form-wrapper .orangeButton, #scout-form-wrapper input[type=submit] { float: right; margin-right: 10px; }


/*******************************************************************************
    buttons
*******************************************************************************/
.greenButton {
  background: #A7E300;
  background: -webkit-gradient(linear, left top, left bottom, from(#A7E300), to(#99D100));
  background: -moz-linear-gradient(top,  #A7E300,  #99D100);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#A7E300', endColorstr='#99D100');
  border: 1px solid #87b800;
  color: #fff;
  cursor: pointer;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 11px;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  text-align: center;
  text-shadow: rgba(0,0,0,.1) 0 -1px 0;
  text-transform: uppercase;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
.greenButton:hover {
  background: #b2eb14;
  background: -webkit-gradient(linear, left top, left bottom, from(#b2eb14), to(#a4da14));
  background: -moz-linear-gradient(top,  #b2eb14,  #a4da14);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b2eb14', endColorstr='#a4da14');
  color: #76ad3b;
}
.greenButton:active {
  background: #99D100;
  background: -webkit-gradient(linear, left top, left bottom, from(#99D100), to(#A7E300));
  background: -moz-linear-gradient(top,  #99D100,  #A7E300);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99D100', endColorstr='#A7E300');
}
a.greenButton, .greenButton a {
  color: #fff;
  display: block;
  text-decoration: none;
}
input.greenButton {
line-height: normal !important;}
@-moz-document url-prefix() { input.greenButton {padding-bottom: 2px;} }
.orangeButton {
  background: #A7E300;
  background: -webkit-gradient(linear, left top, left bottom, from(#ff9900), to(#ff6200));
  background: -moz-linear-gradient(top,  #ff9900,  #ff6200);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff9900', endColorstr='#ff6200');
  border: 1px solid #e55800;
  color: #fff;
  cursor: pointer;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 11px;
  font-weight: bold;
  height: 30px;
  line-height: 30px;
  padding: 0 10px;
  text-align: center;
  text-shadow: rgba(0,0,0,.1) 0 -1px 0;
  text-transform: uppercase;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
.orangeButton:hover {
  background: #ffad32;
  background: -webkit-gradient(linear, left top, left bottom, from(#ffad32), to(#ff8132));
  background: -moz-linear-gradient(top,  #ffad32,  #ff8132);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffad32', endColorstr='#ff8132');
}
.orangeButton:active {
  background: #ff8132;
  background: -webkit-gradient(linear, left top, left bottom, from(#ff8132), to(#ffad32));
  background: -moz-linear-gradient(top,  #ff8132,  #ffad32);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff8132', endColorstr='#ffad32');
}
a.orangeButton, .orangeButton a {
  color: #fff;
  display: block;
  text-decoration: none;
}
