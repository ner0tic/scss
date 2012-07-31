<?php
    include_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
.tzCheckBox{
	background:url('/images/forms/toggle-switch/background.png') no-repeat right bottom;
	display:inline-block;
	min-width:60px;
	height:33px;
	white-space:nowrap;
	position:relative;
	cursor:pointer;
	margin-left:14px;
}

.tzCheckBox.checked{
	background-position:top left;
	margin:0 14px 0 0;
}

.tzCheckBox .tzCBContent{
	color: <?php echo $white ?>;
	line-height: 31px;
	padding-right: 38px;
	text-align: right;
}

.tzCheckBox.checked .tzCBContent{
	text-align:left;
	padding:0 0 0 38px;
}

.tzCBPart{
	background:url('/images/forms/toggle-switch/background.png') no-repeat left bottom;
	width:14px;
	position:absolute;
	top:0;
	left:-14px;
	height:33px;
	overflow: hidden;
}

.tzCheckBox.checked .tzCBPart{
	background-position:top right;
	left:auto;
	right:-14px;
}
