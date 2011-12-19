<?php

/**
 * area actions.
 *
 * @package    scss
 * @subpackage area
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $curr_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->route = $this->getContext()->getRouting()->getCurrentRouteName();
    $this->pager = new sfDoctrinePager('ScssArea', $max_pg);
    $q = Doctrine::getTable('ScssArea')->createQuery('d');
    $q->orderBy('d.name ASC');
    $this->pager->setQuery($q);
    $this->pager->setPage($curr_pg);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_area = Doctrine_Core::getTable('ScssArea')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_area);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssAreaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssAreaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_area = Doctrine_Core::getTable('ScssArea')->find(array($request->getParameter('id'))), sprintf('Object scss_area does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssAreaForm($scss_area);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_area = Doctrine_Core::getTable('ScssArea')->find(array($request->getParameter('id'))), sprintf('Object scss_area does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssAreaForm($scss_area);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_area = Doctrine_Core::getTable('ScssArea')->find(array($request->getParameter('id'))), sprintf('Object scss_area does not exist (%s).', $request->getParameter('id')));
    $scss_area->delete();

    $this->redirect('area/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_area = $form->save();

      $this->redirect('area/edit?id='.$scss_area->getId());
    }
  }
}
