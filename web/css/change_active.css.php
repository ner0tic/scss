<?php
    header("Content-Type: text/css");
    require('scheme.css.php');
?>
.change-active-wrapper {
  position: relative; 
  right: 0px;
  top: -24px;
  font: bold 1.22em/25px Proxima-nova, sans-serif;
}
#modal-change-active .display-user {
  text-align: right;
  display: inline;
  z-index: 4;
  right: 65px;
  position: absolute;
}
#modal-change-active .display-active-troop {
  color: <?php echo $offBlack ?>; 
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  z-index: 4;
  display: inline;
  width: 64px !important;
  position: absolute;
  right: 0px;
}
#modal-change-active input {
  width: 60px; 
  background: transparent; 
  border: none; 
  padding: 2px !important;
  font: bold 1.22em/25px Proxima-nova, sans-serif;
  box-shadow: none !important;
  z-index: 5;
  display: inline;
  position: absolute;
  right: 0px;
}