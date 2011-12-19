<?php

/**
 * district actions.
 *
 * @package    scss
 * @subpackage district
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class districtActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $curr_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->route = $this->getContext()->getRouting()->getCurrentInternalUri();
    $this->pager = new sfDoctrinePager('ScssDistrict', $max_pg);
    $q = Doctrine::getTable('ScssDistrict')->createQuery('d');
    if($request->hasParameter('country_slug') &&
       $request->hasParameter('zone_slug'))
      $q->leftJoin('d.Zone z')->leftJoin('z.Country c')->where('z.slug = ?',$request->getParameter('zone_slug'))->andWhere('c.slug= ?', $request->getParameter('country_slug'));
    $q->orderBy('d.name ASC');
    $this->pager->setQuery($q);
    $this->pager->setPage($curr_pg);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_district = Doctrine_Core::getTable('ScssDistrict')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_district);
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssDistrictForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssDistrictForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_district = Doctrine_Core::getTable('ScssDistrict')->find(array($request->getParameter('id'))), sprintf('Object scss_district does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssDistrictForm($scss_district);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_district = Doctrine_Core::getTable('ScssDistrict')->find(array($request->getParameter('id'))), sprintf('Object scss_district does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssDistrictForm($scss_district);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_district = Doctrine_Core::getTable('ScssDistrict')->find(array($request->getParameter('id'))), sprintf('Object scss_district does not exist (%s).', $request->getParameter('id')));
    $scss_district->delete();

    $this->redirect('district/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_district = $form->save();

      $this->redirect('district/edit?id='.$scss_district->getId());
    }
  }
}
