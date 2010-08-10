<?php

/**
 * swPagesAdmin actions.
 *
 * @package    soleoweb
 * @subpackage swPagesAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class baseSwBlogPostsAdminActions extends sfActions
{
  public function executeIndex($request)
  {
    $this->sw_blog_postList = new swBlogPostsDatagrid(
      $request->getParameter('filters', array()), 
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => 10,
      )
    );
    
    $this->sw_blog_postList->useOnly(array(
      'published',
      'title',
      'created_at',
      'tag'
    ));

  }

  public function executeCreate()
  {
    $this->form = new swBlogPostForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    $this->form = $this->getswBlogPostForm($request->getParameter('id'));
  }

  public function executeUpdate($request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = $this->getswBlogPostForm($request->getParameter('id'));

    $this->form->bind($request->getParameter('sw_blog_post'));
    if ($this->form->isValid())
    {
      $sw_blog_post = $this->form->save();

      $this->getUser()->setFlash('notice-ok', __('notice_your_change_has_been_saved', null, 'swToolbox'));

      $this->redirect('swBlogPostsAdmin/edit?id='.$sw_blog_post['id']);
    }
    
    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {
    $this->forward404Unless($sw_blog_post = $this->getswBlogPostById($request->getParameter('id')));

    $sw_blog_post->delete();
    $this->getUser()->setFlash('notice-ok', __('notice_element_deleted', null, 'swToolbox'));

    $this->redirect('swBlogPostsAdmin/index');
  }

  private function getswBlogPostTable()
  {
    return Doctrine::getTable('swBlogPost');
  }

  private function getswBlogPostById($id)
  {
    return $this->getswBlogPostTable()->find($id);
  }

  private function getswBlogPostForm($id)
  {
    $sw_blog_post = $this->getswBlogPostById($id);

    if ($sw_blog_post instanceof swBlogPost)
    {
      return new swBlogPostForm($sw_blog_post);
    }
    else
    {
      return new swBlogPostForm();
    }
  }

}
