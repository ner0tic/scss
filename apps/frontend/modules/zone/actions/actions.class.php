<?php

/**
 * zone actions.
 *
 * @package    scss
 * @subpackage zone
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class zoneActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $cur_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->route = $this->getContext()->getRouting()->getCurrentInternalUri(true);
    $this->pager = new sfDoctrinePager('ScssZone',$max_pg);
    $q = Doctrine::getTable('ScssZone')->createQuery('z');
    if($request->hasParameter('country_slug'))
      $q->leftJoin('z.Country c')->where('c.slug = ?', $request->getParameter('country_slug'));
    $q->orderBy('z.name ASC');
    $this->pager->setQuery($q);
    $this->pager->setPage($cur_pg);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_zone = Doctrine_Core::getTable('ScssZone')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_zone);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssZoneForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssZoneForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_zone = Doctrine_Core::getTable('ScssZone')->find(array($request->getParameter('id'))), sprintf('Object scss_zone does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssZoneForm($scss_zone);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_zone = Doctrine_Core::getTable('ScssZone')->find(array($request->getParameter('id'))), sprintf('Object scss_zone does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssZoneForm($scss_zone);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_zone = Doctrine_Core::getTable('ScssZone')->find(array($request->getParameter('id'))), sprintf('Object scss_zone does not exist (%s).', $request->getParameter('id')));
    $scss_zone->delete();

    $this->redirect('zone/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_zone = $form->save();

      $this->redirect('zone/edit?id='.$scss_zone->getId());
    }
  }
}
