<?php // lib/ddAdvancedImageUploaderenderer.class.php
  class ddAdvancedImageUploaderenderer implements ddAdvancedImageUploaderendererInterface {
    public function render (ddAdvancedImageUploader $uploader) {
      $_up = '<div class="container dd-img-uploader-wrapper">';
      $_up .= '<fieldset id="'.$uploader->getslug().'-fieldset" class="dd-img-uploader-fieldset">';
      $_up .= '<legend>'.$uploader->getDisplayName().'</legend>';
      $_up .= '<h2>Choose a '.$uploader->getName().':</h2>';
      $_up .= $uploader->getGallery()->render();
      $_up .= '<span>~OR~</span>';
      $_up .= '<h2>Upload an image:';
      $_up .= $uploader->getEngine()->render();
      $_up .= '</fieldset></div>';
      printf($up);
    }
  }