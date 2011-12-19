<?php

/**
 * week actions.
 *
 * @package    scss
 * @subpackage week
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class weekActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $curr_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->route = $this->getContext()->getRouting()->getCurrentInternalUri();
    $this->pager = new sfDoctrinePager('ScssWeek', $max_pg);
    $q = Doctrine::getTable('ScssWeek')->createQuery('w');
    if($request->hasParameter('country_slug') &&
       $request->hasParameter('zone_slug') &&
       $request->hasParameter('district_slug') &&
       $request->hasParameter('camp_slug'))
       $q->leftJoin('w.Camp c')
         ->leftJoin('c.District d')
         ->leftJoin('d.Zone z')
         ->leftJoin('z.Country y')
         ->where('z.slug    = ?', $request->getParameter('zone_slug'))
         ->andWhere('y.slug = ?', $request->getParameter('country_slug'))
         ->andWhere('d.slug = ?', $request->getParameter('district_slug'))
         ->andWhere('c.slug = ?', $request->getParameter('camp_slug'));
    $q->orderBy('d.name ASC');
    $this->pager->setQuery($q);
    $this->pager->setPage($curr_pg);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_week = Doctrine_Core::getTable('ScssWeek')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_week);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssWeekForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssWeekForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_week = Doctrine_Core::getTable('ScssWeek')->find(array($request->getParameter('id'))), sprintf('Object scss_week does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssWeekForm($scss_week);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_week = Doctrine_Core::getTable('ScssWeek')->find(array($request->getParameter('id'))), sprintf('Object scss_week does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssWeekForm($scss_week);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_week = Doctrine_Core::getTable('ScssWeek')->find(array($request->getParameter('id'))), sprintf('Object scss_week does not exist (%s).', $request->getParameter('id')));
    $scss_week->delete();

    $this->redirect('week/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_week = $form->save();

      $this->redirect('week/edit?id='.$scss_week->getId());
    }
  }
}
