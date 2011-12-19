<?php

/**
 * meritbadge actions.
 *
 * @package    scss
 * @subpackage meritbadge
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class meritbadgeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->scss_merit_badges = Doctrine_Core::getTable('ScssMeritBadge')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_merit_badge = Doctrine_Core::getTable('ScssMeritBadge')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_merit_badge);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssMeritBadgeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssMeritBadgeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_merit_badge = Doctrine_Core::getTable('ScssMeritBadge')->find(array($request->getParameter('id'))), sprintf('Object scss_merit_badge does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssMeritBadgeForm($scss_merit_badge);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_merit_badge = Doctrine_Core::getTable('ScssMeritBadge')->find(array($request->getParameter('id'))), sprintf('Object scss_merit_badge does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssMeritBadgeForm($scss_merit_badge);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_merit_badge = Doctrine_Core::getTable('ScssMeritBadge')->find(array($request->getParameter('id'))), sprintf('Object scss_merit_badge does not exist (%s).', $request->getParameter('id')));
    $scss_merit_badge->delete();

    $this->redirect('meritbadge/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_merit_badge = $form->save();

      $this->redirect('meritbadge/edit?id='.$scss_merit_badge->getId());
    }
  }
}
