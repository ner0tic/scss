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
input[type=text], input[type=password], textarea, select { border-radius: 5px; width: 400px !important;}
select { width: 410px !important; }
input[type=submit] {}
.date-select-input { width: 123px !important; display: inline-block; padding-left: 4px; padding-right: 4px; }

#scout-form-wrapper form { /*background: <?php echo $ltGreen ?>; border-top: 1px solid #cccccc;*/ display: block; margin: 0 auto; padding: 20px; width: 450px; overflow: hidden; }
#scout-form-wrapper h2 { color: #444; font-size: 62px; font-weight: bold; left: 5px; margin: 0 auto; margin-bottom: 25px; position: relative; font-family: Alexa, Veranda; }
#scout-form label { font-weight: normal !important; color: <?php echo $black ?>; position: absolute; top: 16px !important; left: 14px !important; }
#scout-form .greenButton, #scout-form-wrapper .orangeButton, #scout-form-wrapper input[type=submit] { float: right; }

/*******************************************************************************
    login
*******************************************************************************/
#login { height: 300px; }
.main-column { width: 800px; overflow: hidden; margin: 0 auto; }
.column-left { width: 49%; height: 206px; }
.column-right { height: 206px; width: 49%; right: -49%; position: relative; top: -190px; }
#login form { /*background: #f9f8f7; border: 1px solid #cccccc; */display: block; margin: 0 auto; padding: 20px; width: 309px; overflow: hidden; margin-top: 30px; border-right: 1px solid white; }
/*#login h2 { color: #444; font-size: 22px; font-weight: bold; left: 5px; margin-bottom: 25px; position: relative; }
*/div.section { margin: 0 0 20px 0; }
#login label { display: inline-block; margin-right: 10px; float: left; position: relative; text-align: right; top: 8px; width: 73px; }
#login .section input[type=text], #login .section input[type=password] { margin-left: 15px; padding: 5px; width: 172px; font-size: 12px; background: white url('/images/comment,png') repeat-x scroll 0 0; }
#login .section a { display: block; font-weight: normal; left: 160px; position: relative; top: 5px; }
#login .greenButton, #login .orangeButton { float: right; width: auto !important; padding: 0 !important; }
a.fb_connect, a.tw_connect { height: 21px; width: 169px; text-indent: -9999px; display: block; margin-bottom: 4px; }
a.fb_connect { background: transparent url('/images/buttons/fb_connect.png') no-repeat 0 0 }
a.tw_connect { background: transparent url('/images/buttons/tw_connect.png') no-repeat 0 0 }
/*******************************************************************************
    signup
*******************************************************************************/

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
