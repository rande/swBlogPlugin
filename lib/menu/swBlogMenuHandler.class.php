<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swBlogMenuHandler extends swMenuHandler
{
  
  public function buildMenu(array $menus, sfActionStackEntry $action_entry)
  {
    
    $menus['main']->addChild(new swMenuElement(array(
      'route' => 'swBlogPostsAdmin/index',
      'name'  => 'blog'
    )));
    
    if(preg_match('/swBlog*/', $action_entry->getModuleName()))
    {
      $menus['sidebar']->addChild(new swMenuElement(array(
        'route' => 'swBlogPostsAdmin/index',
        'name'  => 'post',
        'id'    => 'swBlogPostsAdmin.index'
      )));
      
      $menus['sidebar']->addChild(new swMenuElement(array(
        'route' => 'swBlogCommentsAdmin/index',
        'name'  => 'comments',
        'id'    => 'swBlogCommentsAdmin.index'
      )));
      
      $menus['sidebar']->addChild(new swMenuElement(array(
        'route' => 'swBlogTagsAdmin/index',
        'name'  => 'tags',
        'id'    => 'swBlogTagsAdmin.index'
      )));
      
    }
  }
}