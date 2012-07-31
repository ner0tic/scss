<?php
    include_once 'scheme.css.php';
    header("Content-Type: text/css");
?>
/***********************
    wrappers
***********************/
.data-table-wrapper {
    min-height: 100%;
    margin: 0px auto;
    padding: 5px;
    border-bottom-left-radius: 5px 5px;
    border-bottom-right-radius: 5px 5px;
    border-top-left-radius: 5px 5px;
    border-top-right-radius: 5px 5px;
    border: 1px solid <?php echo $black ?>;
    background: <?php echo $white ?>;
    max-width: 930px;
}
/***********************
    data tables
***********************/
table.data-table {
    vertical-align: top;
    width: 100%;
    text-align: left;
}
/***********************
    table rows
***********************/
.data-table tbody {
}
.data-table tr {
    min-height: 30px;
    height: 30px;
    vertical-align: middle;
}
tr.even-row {
    background-color: <?=$color[19]?>;
}
tr.odd-row {
    background-color: <?=$white?>;/*#efefef;*/
}
tr.even-row:hover,
tr.odd-row:hover {
    background-color: <?=$color[20]?>;
    cursor: hand;
}
.data-table thead {
    width: 100%;
}
.data-table th{
    text-align: left;
}
.data-table tbody th {
    width: auto;
    padding-right: 10px;
}
th.sort {
    position: relative;
    float: right;
}
.data-table tr {
    border-bottom: 1px dotted #999;
}
/*.data-table tbody > tr:last-child {
    border-bottom: none;
}*/
.data-table td,
.data-table tbody th {
    min-width: 25px;
    padding: 15px 15px 15px 15px;
}
.data-table td {
    width: auto;
}
.table-controls {
	position: relative;
	float: right;
}
.table-controls a {
    text-decoration: none;
}
.table-controls div > img {
    vertical-align: bottom;
    padding: 0px;
    height: 16px;
    width: 16px;
}
.control-txt {
    display: inline;
    display: none;
    font-size: small;
    color: <?=$black?>;
    vertical-align: middle;
}
/***********************
    pager
***********************/
.data-table tfoot {
    font-size: 14px;
    font-weight: bold;
    color: <?php echo $green ?>;
    text-align: center;
    letter-spacing: 2px;
}
.data-table tfoot a {
    color: <?php echo $olive ?>;
    text-decoration: none;
}
.data-table tfoot:last-child {
    border-bottom: none;
}