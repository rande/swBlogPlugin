<?php

/**
 * swBlogCommentsAdmin actions.
 *
 * @package    soleoweb
 * @subpackage swBlogCommentsAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class baseSwBlogCommentsAdminActions extends sfActions
{
  public function executeIndex($request)
  {
    $this->sw_blog_commentList = new swBlogCommentsDatagrid(
      $request->getParameter('filters', array()), 
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => 10,
        
      )
    );
  }

  public function executeCreate()
  {
    $this->form = new swBlogCommentForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = $this->getswBlogCommentForm($request->getParameter('id'));
    
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = $this->getswBlogCommentForm($request->getParameter('id'));

    $this->form->bind($request->getParameter('sw_blog_comment'));
    if ($this->form->isValid())
    {
      $sw_blog_comment = $this->form->save();
      
      $this->getUser()->setFlash('notice-ok', __('notice_your_change_has_been_saved', null, 'swToolbox'));

      $this->redirect('swBlogCommentsAdmin/index');
    }

    $this->getUser()->setFlash('notice-error', __('notice_an_error_occurred_while_saving', null, 'swToolbox'));

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($sw_blog_comment = $this->getswBlogCommentById($request->getParameter('id')));

    $sw_blog_comment->delete();
    $this->getUser()->setFlash('notice-ok', __('notice_element_deleted', null, 'swToolbox'));

    $this->redirect('swBlogCommentsAdmin/index');
  }
  
  private function getswBlogCommentTable()
  {
    return Doctrine::getTable('swBlogComment');
  }
  
  private function getswBlogCommentById($id)
  {
    return $this->getswBlogCommentTable()->find($id);
  }
  
  private function getswBlogCommentForm($id)
  {
    $sw_blog_comment = $this->getswBlogCommentById($id);
    
    if ($sw_blog_comment instanceof swBlogComment)
    {
      return new swBlogCommentForm($sw_blog_comment);
    }
    else
    {
      return new swBlogCommentForm();
    }
  }
}