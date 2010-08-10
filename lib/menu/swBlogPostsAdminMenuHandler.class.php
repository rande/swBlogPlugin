<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swBlogPostsAdminMenuHandler extends swMenuHandler
{
  
  public function canBuild(array $menus, sfActionStackEntry $action_entry)
  {
    if($action_entry->getModuleName() == 'swBlogPostsAdmin')
    {
      
      return true;
    }
    
    return false;
  }
  
  public function buildMenu(array $menus, sfActionStackEntry $action_entry)
  {

    $main_element = new swMenuElement(array(
      'name'  => __('index', null, 'swBlogPostsAdmin'),
      'route' => 'swBlogPostsAdmin/index',
      'id'    => 'swBlogPostsAdmin.index'
    ));
    
    $main_element->addChild(new swMenuElement(array(
      'name' => __('link_create', null, 'swBlogPostAdmin'),
      'route' => 'swBlogPostsAdmin/create'
    )))
    ;
    
    
    if(isset($action_entry->getActionInstance()->form) && !$action_entry->getActionInstance()->form->isNew())
    {
      $sw_blog_post = $action_entry->getActionInstance()->form->getObject();
      
      $element = new swMenuElement;
      $element->setName(__('show_comments', null, 'swBlogCommentsAdmin'));
      $element->setRoute('swBlogCommentsAdmin/index', array(
        'query_string' => http_build_query(array('filters' => array('post_id' => $sw_blog_post->getId(), 'moderated' => '')))
      ));
      $main_element->addChild($element);
      
      $element = new swMenuElement;
      $element->setName(__('show', null, 'swBlogPostsAdmin'));
      $element->setRoute('swBlogPostsAdmin/edit?id='.$sw_blog_post->getId());
      
      $main_element->addChild($element);
    }
    $menus['sidebar']->addChild($main_element);
  }
}