<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swBlogCommentsAdminMenuHandler extends swMenuHandler
{
  
  public function canBuild(array $menus, sfActionStackEntry $action_entry)
  {
    if($action_entry->getModuleName() == 'swBlogCommentsAdmin')
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
      $sw_blog_comment = $action_entry->getActionInstance()->form->getObject();
      
      $element = new swMenuElement(array(
        'name' => __('show_post', null, 'swBlogCommentsAdmin'),
        'route' => 'swBlogPostsAdmin/edit?id='.$sw_blog_comment->getPostId()
      ));
      $main_element->addChild($element);
      
    }
    
    $menus['sidebar']->addChild($element);
  }
}