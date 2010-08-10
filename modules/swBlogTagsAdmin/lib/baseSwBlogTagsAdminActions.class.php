<?php


/**
 * swPagesAdmin actions.
 *
 * @package    soleoweb
 * @subpackage swPagesAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class baseSwBlogTagsAdminActions extends sfActions
{
  public function executeIndex($request)
  {

    $this->sw_blog_tagList = new swBlogTagsDatagrid(
      $request->getParameter('filters', array()), 
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => 10,
      )
    );
  }

  public function executeCreate()
  {
    $this->form = new swBlogTagForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = $this->getswBlogTagForm($request->getParameter('id'));
   
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = $this->getswBlogTagForm($request->getParameter('id'));

    $this->form->bind($request->getParameter('sw_blog_tag'));
    if ($this->form->isValid())
    {
      $sw_blog_tag = $this->form->save();
      
      $this->getUser()->setFlash('notice-ok', __('notice_your_change_has_been_saved', null, 'swToolbox'));
      
      $this->redirect('swBlogTagsAdmin/edit?id='.$sw_blog_tag['id']);
    }

    $this->getUser()->setFlash('notice-error', __('notice_an_error_occurred_while_saving', null, 'swToolbox'));

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($sw_blog_tag = $this->getswBlogTagById($request->getParameter('id')));

    $sw_blog_tag->delete();
    $this->getUser()->setFlash('notice-ok', __('notice_element_deleted', null, 'swToolbox'));

    $this->redirect('swBlogTagsAdmin/index');
  }

  private function getswBlogTagTable()
  {
    return Doctrine::getTable('swBlogTag');
  }

  private function getswBlogTagById($id)
  {
    return $this->getswBlogTagTable()->find($id);
  }

  private function getswBlogTagForm($id)
  {
    $sw_blog_tag = $this->getswBlogTagById($id);

    if ($sw_blog_tag instanceof swBlogTag)
    {
      return new swBlogTagForm($sw_blog_tag);
    }
    else
    {
      return new swBlogTagForm();
    }
  }

}
