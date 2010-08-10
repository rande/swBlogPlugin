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
 * PluginswBlogComment form.
 *
 * @package    form
 * @subpackage swBlogComment
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginswBlogCommentForm extends BaseswBlogCommentForm
{
  public function setup()
  {
    parent::setup();
    
    $this->widgetSchema['moderated'] = new sfWidgetFormSelect(array(
      'choices' => swBlogComment::getModeratedList()
    ));
    
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['post_id']);
  }
}