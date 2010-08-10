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
 * PluginswBlogTag form.
 *
 * @package    form
 * @subpackage swBlogTag
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginswBlogTagForm extends BaseswBlogTagForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['sw_blog_posts_list']);
  }
}