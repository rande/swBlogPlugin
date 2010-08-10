<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function sw_blog_include_feed_links()
{
  
  $title = sfConfig::get('app_swBlogPlugin_title');
  $title = $title[sfContext::getInstance()->getUser()->getCulture()];
  
  $feeds = array();
  $feeds[] = array(
    'title' => $title . ' - ' .__('latest_posts', null, 'swBlogPosts'),
    'href'  => '@sw_blog_index?sf_format=atom'
  );
  
  foreach(Doctrine::getTable('swBlogTag')->findAll() as $tag)
  {
    $feeds[] = array(
      'title' => $title . ' - ' .__('posts_by_tag', array('_tag_' => $tag->getName()), 'swBlogPosts'),
      'href'  => '@sw_blog_tag_index?tag='.$tag->getName().'&sf_format=atom'
    );
  }
  
  foreach($feeds as $feed)
  {
    echo sprintf('<link rel="alternate" type="application/atom+xml" title="%s" href="%s" />'."\n",
      $feed['title']. ' (Atom)',
      url_for($feed['href'], true)
    );
  }
}

