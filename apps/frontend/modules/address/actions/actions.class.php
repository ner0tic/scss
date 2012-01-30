<?php

/**
 * address actions.
 *
 * @package    scss
 * @subpackage address
 * @author     David Durost
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class addressActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->scss_address_books = Doctrine_Core::getTable('ScssAddressBook')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->scss_address_book = Doctrine_Core::getTable('ScssAddressBook')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->scss_address_book);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ScssAddressBookForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ScssAddressBookForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($scss_address_book = Doctrine_Core::getTable('ScssAddressBook')->find(array($request->getParameter('id'))), sprintf('Object scss_address_book does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssAddressBookForm($scss_address_book);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($scss_address_book = Doctrine_Core::getTable('ScssAddressBook')->find(array($request->getParameter('id'))), sprintf('Object scss_address_book does not exist (%s).', $request->getParameter('id')));
    $this->form = new ScssAddressBookForm($scss_address_book);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($scss_address_book = Doctrine_Core::getTable('ScssAddressBook')->find(array($request->getParameter('id'))), sprintf('Object scss_address_book does not exist (%s).', $request->getParameter('id')));
    $scss_address_book->delete();

    $this->redirect('address/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $scss_address_book = $form->save();

      $this->redirect('address/edit?id='.$scss_address_book->getId());
    }
  }
}
