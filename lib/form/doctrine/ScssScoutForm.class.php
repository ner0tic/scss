<?php

/**
 * ScssScout form.
 *
 * @package    scss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScssScoutForm extends BaseScssScoutForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['slug']);
    for($x=10;$x<18 && $x>=10;$x++)  $years[] = date('Y') - $x;
    $current_user = sfContext::getInstance()->getUser();
    $culture = substr($current_user->getCulture(), 0,2);
    $this->setWidgets(array(
/*            'dob'               => new sfWidgetFormInputText(
                                        array(),
                                        array(
                                            'class' =>  'scout-form text-input'
                                        )),
 */
        
            'dob'               => new sfWidgetFormInputText(
                                        array(),
                                        array(
                                            'class' => 'scout-form text-input',
                                        )),
                                   /*new sfWidgetFormJQueryDate(
                                        array(
                                          'image'=>'/images/forms/calendar.png',
                                          'config' => '{}',
                                          'culture' => $culture,
                                          //'date_widget' =>  new sfWidgetFormInput()
                                        ),
                                        array(
                                            'class' =>  'scout-form select-input date-select-input'
                                        )),*/
            'first_name'        => new sfWidgetFormInputText(
                                        array(),
                                        array(
                                            'class' => 'scout-form text-input'
                                        )),
            'last_name'         => new sfWidgetFormInputText(
                                        array(),
                                        array(
                                            'class' =>  'scout-form text-input'
                                        )),
            'patrol_id'         => new sfWidgetFormDoctrineChoice(
                                        array(
                                            'model' => $this->getRelatedModelName('Patrol'), 
                                            'add_empty' => false
                                        ),
                                        array(
                                            'class'     => 'scout-form select-input'
                                        )),
            'rank_id'           => new sfWidgetFormDoctrineChoice(
                                        array(
                                            'model' => $this->getRelatedModelName('Rank'), 
                                            'add_empty' => false
                                        ),
                                        array(
                                            'class'     => 'scout-form select-input'
                                        )),
            ));
    $this->widgetSchema->setLabel('patrol_id', ' ');
    $this->widgetSchema->setLabel('rank_id', ' ');
    $this->widgetSchema->setLabel('dob', 'Date Of Birth (YYYY-MM-DD)');
    $this->widgetSchema->setNameFormat('form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
