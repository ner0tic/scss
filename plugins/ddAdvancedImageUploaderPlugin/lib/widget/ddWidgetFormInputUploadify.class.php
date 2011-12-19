<?php

/**
 * ddWidgetFormInputUploadify class
 * 
 * This provides file upload widget for file uploads with the Uploadify
 * javascript library.  
 * Based on plUploadifyPlugin by Chris LeBlanc <chris@webpragmatist.com>
 *
 * @package ddAdvancedImageUploaderPlugin
 * @author ner0tic <david.durost@gmail.com>
 * @see 
 */
class ddWidgetFormInputFile extends sfWidgetFormInputFile
{
  /**
   * Instance counter
   *
   * @var integer
   */
  protected static $INSTANCE_COUNT = 0;

  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormInput
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    
    $this->addOption('uploadify_path', '/ddAdvancedImageUploader/vendor/jquery-uploadify');
    $this->addOption('include_jquery', false);
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavaScripts()
  {
    $js = array(
      $this->getOption('uploadify_path') . '/swfobject.js',
      $this->getOption('uploadify_path') . '/jquery.uploadify.v2.1.0.min.js'
    );

    if($this->getOption('include_jquery'))
      $js[] = "http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js";
      
    return $js;
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    
    self::$INSTANCE_COUNT++;

    $output = parent::render($name, $value, $attributes, $errors);

    $widget_id  = $this->getAttribute('id') ? $this->getAttribute('id') : $this->generateId($name);
    $session_name = ini_get('session.name');
    $session_id = session_id();
    $uploader = $this->getOption('uploadify_path') . '/uploadify.swf';
    $cancel_img = $this->getOption('uploadify_path') . '/cancel.png';
    
    $form = new BaseForm();
    $csrf_token = $form->getCSRFToken();
    
    $output .= <<<EOF
      <div class="swfupload-buttontarget">
        <noscript>
          We're sorry.  SWFUpload could not load.  You must have JavaScript enabled to enjoy SWFUpload.
        </noscript>
      </div>
      <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
          $('#$widget_id').uploadify({
            'scriptData': {'$session_name':'$session_id', '_csrf_token':'$csrf_token'},
            'uploader': '$uploader',
            'cancelImg': '$cancel_img',
            'auto'      : true,
            'script': $('#$widget_id').closest('form').attr('action')+'/upload',
            'folder': '/',
            'multi': false,
            'displayData': 'speed',
            'fileDataName': '$widget_id',
            'simUploadLimit': 2
          });
        });
        //]]>
      </script>
EOF;
    return $output;
  }
}