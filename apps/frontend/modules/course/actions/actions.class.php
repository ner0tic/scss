<?php

/**
 * course actions.
 *
 * @package    scss
 * @subpackage course
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class courseActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->courses = Doctrine_Core::getTable('ScssCourse')
      ->createQuery('c')->leftJoin('c.MeritBadge m')->orderBy('m.name ASC')
      ->execute();
  }

  public function executeGrid(sfWebRequest $request) {
    $this->badges = Doctrine::getTable('ScssMeritBadge')->createQuery('m')->execute();
    $this->camps = Doctrine::getTable('ScssCamp')->createQuery('c')/*->limitByAccess($this->getUser()->getProfile()->getAccessLevel())*/->execute();
  }

  public function executeAjaxToggle(sfWebRequest $request) {
    $tmp = $request->getParameter('chkbox');
    $this->debug = '$tmp : '.$tmp.'<br />';
    $tmp = explode('_',$tmp);
    // $tmp == 'campid_mbid'
    // $tmp[0] == campid
    // $tmp[1] == mbid
    	
    $camp = Doctrine_Core::getTable('ScssCamp')->find($tmp[0]);
    $this->debug .= 'camp : '.$camp->getName().'<br />hasCourse : '.$camp->hasCourse($tmp[1]).'<br />';
    if($camp->hasCourse($tmp[1])) {
	$course = $camp->getCourse((int)$tmp[1]);
	$course = $course[0];	
        $course->delete();
        $this->debug .= 'course removed.<br />';
        //$this->redirect('course/index');
	//return true;
	
    }
    else {
        $course = new ScssCourse();
        $course->setMeritbadgeId($tmp[1]);
        $course->setCampId($camp->getId());
        $course->save();
        $this->debug .= 'course created.<br />';
    }
  }
  public function executeShow(sfWebRequest $request)
  {
    $this->scss_course = Doctrine_Core::getTable('ScssCourse')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_course);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssCourseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssCourseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_course = Doctrine_Core::getTable('ScssCourse')->find(array($request->getParameter('id'))), sprintf('Object scss_course does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssCourseForm($scss_course);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_course = Doctrine_Core::getTable('ScssCourse')->find(array($request->getParameter('id'))), sprintf('Object scss_course does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssCourseForm($scss_course);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_course = Doctrine_Core::getTable('ScssCourse')->find(array($request->getParameter('id'))), sprintf('Object scss_course does not exist (%s).', $request->getParameter('id')));
    $scss_course->delete();

    $this->redirect('course/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_course = $form->save();

      $this->redirect('course/edit?id='.$scss_course->getId());
    }
  }
}
