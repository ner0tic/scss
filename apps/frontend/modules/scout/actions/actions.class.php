<?php

/**
 * scout actions.
 *
 * @package    scss
 * @subpackage scout
 * @author     David Durost
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class scoutActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $cur_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->pager = new sfDoctrinePager('ScssScout',$max_pg);
    $this->pager->setQuery(Doctrine::getTable('ScssScout')->createQuery('a')->leftJoin('a.Patrol p')->where('p.troop_id = ?', $this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getId())->orderBy('a.last_name, a.first_name ASC'));
    $this->pager->setPage($cur_pg);
    $this->pager->init();
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scout = Doctrine_Core::getTable('ScssScout')->find(array($request->getParameter('scout_slug')));
    $this->forward404Unless($this->scout);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssScoutForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssScoutForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scout = Doctrine_Core::getTable('ScssScout')->findOneBySlug($request->getParameter('scout_slug')));
    $this->form = new ScssScoutForm($scout);
    $this->scout = ucwords($scout->getName());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scout = Doctrine_Core::getTable('ScssScout')->find(array($request->getParameter('scout_slug'))), sprintf('Object scout does not exist (%s).', $request->getParameter('scout_slug')));
    $this->form = new ScssScoutForm($scout);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scout = Doctrine_Core::getTable('ScssScout')->find(array($request->getParameter('scout_slug'))), sprintf('Object scss_scout does not exist (%s).', $request->getParameter('scout_slug')));
    $scout->delete();

    $this->redirect('scout/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scout = $form->save();

      $this->redirect('scout/edit?id='.$scout->getId());
    }
  }
}
