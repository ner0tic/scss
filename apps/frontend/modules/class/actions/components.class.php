<?php
  class classComponents extends sfComponents {
    public function executeMiniform(sfWebRequest $request) {
      $this->class = Doctrine::getTable('ScssClass')->createQuery('a')->filterByCourse($this->course)->filterByPeriod($this->period)->fetchOne();
      // TEMP
      $staff = Doctrine::getTable('ScssStaff')->createQuery('a')->filterByCamp($this->course->getCamp())->fetchOne();
      $area = Doctrine::getTable('ScssArea')->createQuery('a')->filterByCamp($this->course->getCamp())->fetchOne();
      // TEMP
      $this->id = $this->course->getID().'_'.$this->period->getID().'_'.$staff->getID().'_'.$area->getID();
      //$url = (bool)$this->class ? url_for('class_delete',$this->class) : url_for('class_new',$this->period);
      $data = array('course_id' => $this->course->getID(),
                    'period_id' => $this->period->getID(),
                    'area_id'   => $area->getID(),
                    'staff_id'  => $staff->getID());
      //$js = jq_remote_function(array('url'=>url_for(@class_delete,$this->class),'data'=>$data));                      
      $this->onChange = '';
      //$this->widget = new sfWidgetFormInputCheckbox(array(),array('id'=>$this->id,'checked'=>(bool)$this->class,'onChange'  => ($js)));
      //$widget = new sfWidgetFormInputCheckbox();
      $this->widget = '<input type="checkbox" name="'.$this->id.' '.((bool)$this->class ? 'checked="true"' : '').' />';
    }
  }
?>
