
#wrap {
	margin-left: auto;
	margin-right: auto;
	width: 900px;
	position: relative;
	min-height: 40px;
}
#body-image {
	margin-top: 60px;
}
#main-nav {
	margin: 0px 0px 0px 2px;
	text-align: left;
	min-height: 25px;
	padding-top: 10px;
	padding-left: 0px;
}
#main-handle {
	width: 605px;
	float: right;
	margin-top: -1px;
}
#main-nav li {
	display: inline;
	list-style: none;
        height: 38px;

}
#main-nav li a {
	margin-right: 5px;
	font-size: 15px;
	text-decoration: none;
	color: #f2f2f2;
	font-family: Arial, Helvetica, sans-serif;
	text-transform: uppercase;
	font-weight: bold;
	padding: 10px;
	outline: 0;
	position: relative;
	top: -2px;
}
#main-nav li a:hover, #main-nav li a.active {
    background: <?php echo $ltOlive ?>;
    border-bottom-left-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
}
#sub-link-bar {
	background: <?php echo $ltOlive ?>;
	min-height: 10px;
	border-bottom: <?php echo $olive ?> 1px solid;
}
.sub-links {
	display: none;
	position: absolute;
	width: 100%;
	top: -30px;
	text-align: left;
	left: 0px;
}
#main-nav li .sub-links li a:hover{
	background: <?php echo $dkGreen ?>;
}
#main-nav li a.close{
	display: none;
	position: absolute;
}
#main-nav li a.close:hover{

}
.round{display:block}
.round *{
  display:block;
  height:1px;
  overflow:hidden;
  font-size:.01em;
  background:#5c872e}
.round1{
  margin-left:3px;
  margin-right:3px;
  padding-left:1px;
  padding-right:1px;
  border-left:1px solid #b8cba5;
  border-right:1px solid #b8cba5;
  background:#84a562}
.round2{
  margin-left:1px;
  margin-right:1px;
  padding-right:1px;
  padding-left:1px;
  border-left:1px solid #eef3ea;
  border-right:1px solid #eef3ea;
  background:#7a9d55}
.round3{
  margin-left:1px;
  margin-right:1px;
  border-left:1px solid #7a9d55;
  border-right:1px solid #7a9d55;}
.round4{
  border-left:1px solid #b8cba5;
  border-right:1px solid #b8cba5}
.round5{
  border-left:1px solid #84a562;
  border-right:1px solid #84a562}
.roundfg{
  background:#5c872e}
