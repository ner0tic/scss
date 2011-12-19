<?php

/**
 * staff actions.
 *
 * @package    scss
 * @subpackage staff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class staffActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->scss_staffs = Doctrine_Core::getTable('ScssStaff')
      ->createQuery('a')
      ->execute();
  }
  public function executeClassMgmtSelect(sfWebRequest $request) {
    $this->staff = array();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_staff);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssStaffForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssStaffForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id'))), sprintf('Object scss_staff does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssStaffForm($scss_staff);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id'))), sprintf('Object scss_staff does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssStaffForm($scss_staff);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id'))), sprintf('Object scss_staff does not exist (%s).', $request->getParameter('id')));
    $scss_staff->delete();

    $this->redirect('staff/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_staff = $form->save();

      $this->redirect('staff/edit?id='.$scss_staff->getId());
    }
  }
}
