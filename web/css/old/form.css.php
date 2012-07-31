<?php
    include_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
/***********************
    quick-form
***********************/
div.quick-form,
div.enroll-form {
    font-family: helvetica, arial, sans-serif;
    font-size: 12px;
    line-height: 12px;
    width: 360px;
    display: block;
    border: 1px solid <?php echo $ltGray ?>;
    border-top-left-radius: 5px 5px;
    border-bottom-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
    padding: 10px 4px 4px 4px;
    margin-right: 15px;
}
form div.quick-form-row,
form div.enroll-form-row {
    margin-bottom: 7px;
    display: inline;
}
div.quick-form-row span,
div.enroll-form-row span {
    display: block;
    position: relative;
}
span.quick-form-row-wrapper label,
span.enroll-form-row-wrapper label {
    cursor: text;
    display: block;
    font-size: 1.16667em;
    height: 100%;
    width: 100%;
    line-height: 15px;
    padding-left: 8ps;
    position: absolute;
    color: <?php echo $medTeal ?>;
}
div.quick-form .text-input,
div.enroll-form .text-input {
    width: 232px;
}
.text-input, .select-input {
    -webkit-box-shadow: #D0D0D0 0px 1px 2px;
    background: <?php echo $white ?>;
    border: 1px solid <?php echo $medTeal ?>;
    color: <?php echo $medTeal ?>;
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
.quick-form-header,
.enroll-form-header {
    font-size: 3em;
    margin-bottom: 20px;
    font-weight: bold;
    letter-spacing: -0.03em;
    color: <?php echo $offBlack ?>;
    border-bottom: 1px dotted <?php echo $black ?>;
}
.quick-form-header span,
.enroll-form-header span {
    font-weight: normal;
    color: <?php echo $medTeal ?>;
}
.quick-form-submit {
	background: transparent url(/images/icons/add.png) no-repeat center;
        height: 16px;
        display: block;
}
.quick-form label,
.enroll-form label {
	font-size: .75em;
}

form.mini-form .select-input,
form.mini-form .text-input {
    display: inline;
}
tfoot > tr {
    border: none;
}
