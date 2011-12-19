<?php

/**
 * period actions.
 *
 * @package    scss
 * @subpackage period
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class periodActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $curr_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->route = $this->getContext()->getRouting()->getCurrentInternalUri();
    $this->pager = new sfDoctrinePager('ScssPeriod', $max_pg);
    $q = Doctrine::getTable('ScssPeriod')->createQuery('p');
    if($request->hasParameter('country_slug') &&
       $request->hasParameter('zone_slug')    &&
       $request->hasParameter('district_slug')&&
       $request->hasParameter('camp_slug')    &&
       $request->hasParameter('week_slug'))
       $q->leftJoin('p.Week w')
        ->leftJoin('w.Camp c')
        ->leftJoin('c.District d')
        ->leftJoin('d.Zone z')
        ->leftJoin('z.Country y')
        ->where('z.slug     = ?', $request->getParameter('zone_slug'))
        ->andWhere('y.slug  = ?', $request->getParameter('country_slug'))
        ->andWhere('d.slug  = ?', $request->getParameter('district_slug'))
        ->andWhere('c.slug  = ?', $request->getParameter('camp_slug'))
        ->andWhere('w.slug  = ?', $request->getParameter('week_slug'));
    $q->orderBy('p.label ASC');
    $this->pager->setQuery($q);
    $this->pager->setPage($curr_pg);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_period = Doctrine_Core::getTable('ScssPeriod')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_period);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssPeriodForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssPeriodForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_period = Doctrine_Core::getTable('ScssPeriod')->find(array($request->getParameter('id'))), sprintf('Object scss_period does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssPeriodForm($scss_period);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_period = Doctrine_Core::getTable('ScssPeriod')->find(array($request->getParameter('id'))), sprintf('Object scss_period does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssPeriodForm($scss_period);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_period = Doctrine_Core::getTable('ScssPeriod')->find(array($request->getParameter('id'))), sprintf('Object scss_period does not exist (%s).', $request->getParameter('id')));
    $scss_period->delete();

    $this->redirect('period/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_period = $form->save();

      $this->redirect('period/edit?id='.$scss_period->getId());
    }
  }
}
