<?php

/**
 * swPagesAdmin actions.
 *
 * @package    soleoweb
 * @subpackage swPagesAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class baseSwBlogPostsComponents extends sfComponents
{
  
  public function executeShowTags($request)
  {
    
    $q = Doctrine::getTable('swBlogTag')->createQuery('t');
    $q->select('t.*, pt.*, tt.*, COUNT(pt.blog_tag_id) as num_post');
    
    $q->leftJoin('t.Translation tt');
    $q->leftJoin('t.swBlogPostTags pt');
    $q->leftJoin('pt.swBlogPost p');
    
    $q->addWhere('p.published = ?', true);
    $q->addWhere('tt.lang = ?', $this->getUser()->getCulture());
    
    $q->groupBy('pt.blog_tag_id');
    
    if(!isset($this->decorator))
    {
      $this->decorator = "%s <br />";
    }
    $sw_tags = $q->execute();
    
    $this->sw_tags = $sw_tags;
  }
  
  public function executeLastPosts($request)
  {
    
    $this->last_posts = new swBlogPostsDatagrid(
      array(
        'published' => true,
      ),
      array(
        'per_page' => isset($this->per_page) ? $this->limit : 5
      )
    );
    
    if(!isset($this->decorator))
    {
      $this->decorator = "%s <br />";
    }
    
  }
}
