<?php

/**
 * troop actions.
 *
 * @package    scss
 * @subpackage troop
 * @author     David Durost
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class troopActions extends sfActions
{
  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request) {
    $this->troops = Doctrine_Core::getTable('ScssTroop')
      ->createQuery('t')
      ->execute();
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeSettings(sfWebRequest $request) {
    $this->troop = Doctrine_Core::getTable('ScssTroop')->find($this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getId());
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request) {
    $this->scss_troop = Doctrine_Core::getTable('ScssTroop')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_troop);
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request) {
    $this->form = new ScssTroopForm();
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new ScssTroopForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request) {
    $this->forward404Unless($troop = Doctrine_Core::getTable('ScssTroop')->find(array($request->getParameter('id'))), sprintf('Object scss_troop does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssTroopForm($troop);
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_troop = Doctrine_Core::getTable('ScssTroop')->find(array($request->getParameter('id'))), sprintf('Object scss_troop does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssTroopForm($scss_troop);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();
    $this->forward404Unless($scss_troop = Doctrine_Core::getTable('ScssTroop')->find(array($request->getParameter('id'))), sprintf('Object scss_troop does not exist (%s).', $request->getParameter('id')));
    $scss_troop->delete();
    $this->redirect('troop/index');
  }

  /**
   *
   * @param sfWebRequest $request
   * @param sfForm $form 
   */
  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $scss_troop = $form->save();
      $this->redirect('troop/edit?id='.$scss_troop->getId());
    }
  }
}