<?php

/**
 * class actions.
 *
 * @package    scss
 * @subpackage class
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class classActions extends sfActions
{
    public function executeSearchAjax(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        $classes = Doctrine::getTable('ScssClass')->retrieveForSelect($request->getParameter('p'),$request->getParameter('q'), $request->getParameter('limit'));
        return $this->renderText(json_encode($classes));
    }
  public function executeIndex(sfWebRequest $request)
  {
    $this->courses = Doctrine::getTable('ScssCourse')->createQuery('a')->filterByCamp($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp())->execute();
    $this->periods = Doctrine::getTable('ScssPeriod')->createQuery('a')->filterByWeek($this->getUser()->getProfile()->getActiveEnrollment()->getWeek())->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_class = Doctrine_Core::getTable('ScssClass')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_class);
  }

  public function executeNew(sfWebRequest $request)
  {
    if($this->getUser()->getProfile()->getAccessLevel()<Scss::CAMP_ADMIN) {
      $this->getUser()->setFlash('notice','You do not have access to this section.');
      $this->form = '';
    }    
    else {
      $this->form = new ScssClassForm();
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssClassForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($class = Doctrine_Core::getTable('ScssClass')->find(array($request->getParameter('id'))), sprintf('Object scss_class does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssClassForm($class);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($class = Doctrine_Core::getTable('ScssClass')->find(array($request->getParameter('id'))), sprintf('Object scss_class does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssClassForm($class);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($class = Doctrine_Core::getTable('ScssClass')->find(array($request->getParameter('id'))), sprintf('Object scss_class does not exist (%s).', $request->getParameter('id')));
    $class->delete();

    $this->redirect('class/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $class = $form->save();

      $this->redirect('class/edit?id='.$class->getId());
    }
  }
}
