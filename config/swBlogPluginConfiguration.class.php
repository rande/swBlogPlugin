<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swBlogPluginConfiguration extends sfPluginConfiguration
{
  
  public function initialize()
  {
    
    if($this->configuration instanceof sfApplicationConfiguration)
    {
      $this->configuration->loadHelpers(array('swToolbox', 'swBlog', 'I18N'));
      
      if($this->configuration->getApplication() == sfConfig::get('app_swBlog_backend_app', 'backend'))
      {
        // register menu handler
        $this->dispatcher->notify(new sfEvent('swBlogMenuHandler', 'sw_menu_manager.register_listener'));
        $this->dispatcher->notify(new sfEvent('swBlogPostsAdminMenuHandler', 'sw_menu_manager.register_listener'));
        $this->dispatcher->notify(new sfEvent('swBlogCommentsAdminMenuHandler', 'sw_menu_manager.register_listener'));
//        $this->dispatcher->notify(new sfEvent('swBlogTagsAdminMenuHandler', 'sw_menu_manager.register_listener'));
      }
    }
    
    if (sfConfig::get('app_swBlog_routes_register', true) && in_array('swBlogPosts', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('swBlogRouting', 'listenToRoutingLoadConfigurationEvent'));
    }
    
  }
}