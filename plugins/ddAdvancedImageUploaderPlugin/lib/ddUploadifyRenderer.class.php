<?php // lib/ddUploadifyRenderer.class.php
/**
 * Description of ddUploadifyRenderer
 *
 * @author ner0tic
 */
class ddUploadifyRenderer {
  public function render (ddUploadify $up) {
    $widget_id = $this->getSlug().'-input';       
    $form = new BaseForm();
    $csrf_token = $form->getCSRFToken();
    
    $output = '<div class="container dd-img-upload-wrapper">';
    $output .= '<div id="fileQueue"></div>';
    $output .= '<input type="file" name="'.$up->getSlug().'" id="'.$widget_id.'" />';
    $output .= '<p><a href="javascript:jQuery(\'#'.$widget_id.'\').uploadifyClearQueue()">Cancel All Uploads</a></p>';
    $output .= '<div class="swfupload-buttontarget">
        <noscript>
          We\'re sorry.  SWFUpload could not load.  You must have JavaScript enabled to enjoy SWFUpload.
        </noscript>
      </div>';
    $output .= '<script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
          $(\'#'.$widget_id.' \').uploadify({
            \'scriptData\': {\' '.array_key($up->getSession()).' \': \' '.array_value($up->getSession()).' \', \'_csrf_token\': \' '.$csrf_token.' \'},
            \'uploader\': \' '.$up->getUploader().' \',
            \'cancelImg\': \'cancel.png\',
            \'auto\'      : true,
            \'script\': $(\'#'.$widget_id.'\').closest(\'form\').attr(\'action\')+\'/upload\',
            \'folder\': \'\',
            \'multi\': false,
            \'displayData\': \'speed \',
            \'fileDataName\': \' '.$widget_id.' \',
            \'simUploadLimit\': 2
          });
        });
        //]]>
      </script>';
    printf($output);
  }
}

