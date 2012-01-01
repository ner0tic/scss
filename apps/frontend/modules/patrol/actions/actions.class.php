<?php

/**
 * patrol actions.
 *
 * @package    scss
 * @subpackage patrol
 * @author     David Durost
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class patrolActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $cur_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->pager = new sfDoctrinePager('ScssPatrol',$max_pg);
    $this->pager->setQuery(Doctrine_Core::getTable('ScssPatrol')->createQuery('a')->where('a.troop_id = ?',$this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getId())->orderBy('a.name ASC'));
    $this->pager->setPage($cur_pg);
    $this->pager->init();
   
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->patrol = Doctrine_Core::getTable('ScssPatrol')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->patrol);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssPatrolForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssPatrolForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($patrol = Doctrine_Core::getTable('ScssPatrol')->find(array($request->getParameter('id'))), sprintf('Object patrol does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssPatrolForm($patrol);
    $this->patrol = ucwords($patrol->getName());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_patrol = Doctrine_Core::getTable('ScssPatrol')->find(array($request->getParameter('id'))), sprintf('Object patrol does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssPatrolForm($scss_patrol);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($patrol = Doctrine_Core::getTable('ScssPatrol')->find(array($request->getParameter('id'))), sprintf('Object patrol does not exist (%s).', $request->getParameter('id')));
    $patrol->delete();

    $this->redirect('patrol/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $patrol = $form->save();

      $this->redirect('patrol/edit?id='.$patrol->getId());
    }
  }
}
