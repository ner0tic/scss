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
    max-width: 920px;
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
    height: 68px;
    vertical-align: middle;
}
.data-table tr:first-child {
    border-radius: 5px;
}
tr.even-row {
    background-color: <?php echo $offWhite ?>;
    border: 1px solid <?php echo $offWhite ?>;
}
tr.odd-row {
    background-color: <?php echo $white ?>;/*#efefef;*/
    border: 1px solid <?php echo $white ?>;
}
tr.even-row:hover,
tr.odd-row:hover {
    background-color: <?php echo $fadedGold ?>;
    border: 1px solid <?php echo $fadedGold ?>;
    cursor: default;
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
.data-table tfoot tr {
    border-bottom: none;
    height: auto !important;
}
.data-table td,
.data-table tbody th {
  min-width: 25px;
  padding: 7px 7px 7px 7px;
}
.data-table td {
    width: auto;
}
td.table-controls {
  width: 45px;
}
div.table-controls {
  position: relative;
  float: right;
  width: 45px;
}
div.table-controls a {
    text-decoration: none;
}
div.table-controls div > img {
    vertical-align: bottom;
    padding: 0px;
    height: 16px;
    width: 16px;
}
.control-txt {
    display: inline;
    display: none;
    font-size: small;
    color: <?php echo $black?>;
    vertical-align: middle;
}
/***********************
    pager
***********************/
.data-table tfoot {
    font-size: 14px;
    font-weight: bold;
    color: <?php echo $dkGreen ?>;
    text-align: center;
    letter-spacing: 2px;
}
.data-table tfoot a {
    color: <?php echo $gold ?>;
    text-decoration: none;
}
.data-table tfoot:last-child {
    border-bottom: none;
}
