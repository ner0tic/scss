<?php

/**
 * staff actions.
 *
 * @package    scss
 * @subpackage staff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class staffActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $cur_pg = $request->getParameter('page',1);
    $max_pg = sfConfig::get('app_max_items_on_index');
    $this->pager = new sfDoctrinePager('ScssStaff',$max_pg);
    $this->pager->setQuery(Doctrine::getTable('ScssStaff')->createQuery('a')->addAgeSelect()->filterByCamp($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp())->orderBy('a.last_name, a.first_name ASC'));
    $this->pager->setPage($cur_pg);
    $this->pager->init();    
  }
  public function executeClassMgmtSelect(sfWebRequest $request) {
    $this->staff = array();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->staff);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssStaffForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssStaffForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('slug'))), sprintf('Object staff does not exist (%s).', $request->getParameter('slug')));
    $this->form = new ScssStaffForm($staff);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('slug'))), sprintf('Object staff does not exist (%s).', $request->getParameter('slug')));
    $this->form = new ScssStaffForm($staff);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($staff = Doctrine_Core::getTable('ScssStaff')->find(array($request->getParameter('id'))), sprintf('Object staff does not exist (%s).', $request->getParameter('id')));
    $staff->delete();

    $this->redirect('staff/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $staff = $form->save();

      $this->redirect('staff/edit?id='.$staff->getId());
    }
  }
}
