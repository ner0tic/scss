<?php

/**
 * troopEnrollment actions.
 *
 * @package    scss
 * @subpackage troopEnrollment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class troopEnrollmentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->scss_troop_enrollments = Doctrine_Core::getTable('ScssTroopEnrollment')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssTroopEnrollmentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssTroopEnrollmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_troop_enrollment = Doctrine_Core::getTable('ScssTroopEnrollment')->find(array($request->getParameter('id'))), sprintf('Object scss_troop_enrollment does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssTroopEnrollmentForm($scss_troop_enrollment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_troop_enrollment = Doctrine_Core::getTable('ScssTroopEnrollment')->find(array($request->getParameter('id'))), sprintf('Object scss_troop_enrollment does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssTroopEnrollmentForm($scss_troop_enrollment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_troop_enrollment = Doctrine_Core::getTable('ScssTroopEnrollment')->find(array($request->getParameter('id'))), sprintf('Object scss_troop_enrollment does not exist (%s).', $request->getParameter('id')));
    $scss_troop_enrollment->delete();

    $this->redirect('troopEnrollment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_troop_enrollment = $form->save();

      $this->redirect('troopEnrollment/edit?id='.$scss_troop_enrollment->getId());
    }
  }
}
