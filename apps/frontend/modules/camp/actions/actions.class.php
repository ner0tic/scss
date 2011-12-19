<?php

/**
 * camp actions.
 *
 * @package    scss
 * @subpackage camp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class campActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $curr_pg = $request->getParameter('page',1);
      $max_pg = sfConfig::get('app_max_items_on_index');
      $this->route = $this->getContext()->getRouting()->getCurrentInternalUri();
      $this->pager = new sfDoctrinePager('ScssCamp', $max_pg);
      $q = Doctrine::getTable('ScssCamp')->createQuery('c');
      if($request->hasParameter('country_slug') &&
        $request->hasParameter('zone_slug'))
      $q->leftJoin('c.District d')->leftJoin('d.Zone z')->leftJoin('z.Country y')->where('z.slug = ?',$request->getParameter('zone_slug'))->andWhere('y.slug= ?', $request->getParameter('country_slug'))->andWhere('d.slug = ?',$request->getParameter('district_slug'));
      $q->orderBy('d.name ASC');
      $this->pager->setQuery($q);
      $this->pager->setPage($curr_pg);
      $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_camp = Doctrine_Core::getTable('ScssCamp')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_camp);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssCampForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssCampForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_camp = Doctrine_Core::getTable('ScssCamp')->find(array($request->getParameter('id'))), sprintf('Object scss_camp does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssCampForm($scss_camp);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_camp = Doctrine_Core::getTable('ScssCamp')->find(array($request->getParameter('id'))), sprintf('Object scss_camp does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssCampForm($scss_camp);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_camp = Doctrine_Core::getTable('ScssCamp')->find(array($request->getParameter('id'))), sprintf('Object scss_camp does not exist (%s).', $request->getParameter('id')));
    $scss_camp->delete();

    $this->redirect('camp/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_camp = $form->save();

      $this->redirect('camp/edit?id='.$scss_camp->getId());
    }
  }
}
