<?php

/**
 * ScssPatrol form.
 *
 * @package    scss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScssPatrolForm extends BaseScssPatrolForm
{
  public function configure()
  {
	unset(
        	$this['created_at'], $this['updated_at'], $this['slug'], $this['troop_id']
	);
	$this->setWidget('img', new sfWidgetFormInputFileEditable(
		array(
  		    'edit_mode'=>false,
		    'with_delete' => false,
		    'file_src' => '')
	));
	$this->widgetSchema['color']->setAttribute('class','color-picker');

        // set the validator for this file. 
        // This is where we will specify the class that
        // will handle the file upload. Make sure you set it to 
        // whatever you name your class
	$this->setValidator('filename', new sfValidatorFile(
	    array(
	        'max_size' => 500000,
		'mime_types' => 'web_images', //you can set your own of course
		'path' => '/userfiles/logos/patrols',
		'required' => true,
		'validated_file_class' => 'sfValidatedFileCustom')
	    ));	
  }
}
