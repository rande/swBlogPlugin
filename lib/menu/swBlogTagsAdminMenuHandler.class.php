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
    if($action_entry->getModuleName() == 'swBlogTagsAdmin')
    {
      
      return true;
    }
    
    return false;
  }
  
  public function buildMenu(array $menus, sfActionStackEntry $action_entry)
  {

    $element = new swMenuElement(array(
      'name'  => __('index', null, 'swBlogTagsAdmin'),
      'route' => 'swBlogTagsAdmin/index',
      'id'    => 'swBlogTagsAdmin.index'
    ));
    
    $element->addChild(new swMenuElement(array(
      'name' => __('link_create', null, 'swBlogTagsAdmin'),
      'route' => 'swBlogTagsAdmin/create'
    )));
    
    $menus['sidebar']->addChild($element);
  }
}