<?php

/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardRouting.class.php 7636 2008-02-27 18:50:43Z fabien $
 */
class swBlogRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    $r->prependRoute('sw_blog_index', new sfRoute('/blog.:sf_format', array(
        'module'      => 'swBlogPosts', 
        'action'      => 'index',
        'sf_format'   => 'html',
      )
      ,
      array(
        'sf_format' => '(?:html|atom)'
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
    
    $r->prependRoute('sw_blog_add_comment', new sfRoute('/blog/add-comment/:id', array(
      'module' => 'swBlogPosts', 
      'action' => 'addComment',
    ),
      array(
        'id' => '\d+',
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
    
    $r->prependRoute('sw_blog_tag_index', new sfRoute('/blog/tag/:tag.:sf_format', array(
      'module' => 'swBlogPosts', 
      'action' => 'indexByTag',
      'sf_format' => 'html'
    ),
      array(
        'sf_format' => '(?:html|atom)'
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
    
    $r->prependRoute('sw_blog_view_archives_by_year', new sfRoute('/blog/:year.:sf_format', array(
        'module' => 'swBlogPosts', 
        'action' => 'archives',
        'sf_format' => 'html'
      ),
      array(
        'year' => '\d+',
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
    
    $r->prependRoute('sw_blog_view_archives_by_month', new sfRoute('/blog/:year/:month.:sf_format', array(
        'module' => 'swBlogPosts', 
        'action' => 'archives',
        'sf_format' => 'html'
      ),
      array(
        'year' => '\d+',
        'month' => '\d+',
        'sf_format' => '(?:html|atom)'
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
    
    $r->prependRoute('sw_blog_view_post', new sfRoute('/blog/:year/:month/:day/:slug.:sf_format', array(
      'module' => 'swBlogPosts', 
      'action' => 'view',
      'sf_format' => 'html'
    ),
      array(
        'year' => '\d+',
        'month' => '\d+',
        'day' => '\d+',
        'sf_format' => '(?:html|atom)'
      ),
      array(
        'extra_parameters_as_query_string' => true,
        'generate_shortest_url' => true
      )
    ));
  }
}