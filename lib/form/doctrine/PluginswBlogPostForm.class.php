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
 * PluginswBlogPost form.
 *
 * @package    form
 * @subpackage swBlogPost
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class PluginswBlogPostForm extends BaseswBlogPostForm
{
  public function setup()
  {
    parent::setup();

    $fields = array(
      'id',
      'published',
      'comment_is_enabled',
      'comment_close_at',
      'published',
      'tags',
      'format_content',
      'sw_blog_post_tags_list'
    );
    
    $this->widgetSchema['format_content'] = new sfWidgetFormChoice(array(
      'choices' => swBlogPost::getFormatsList()
    ));
    
    
    $this->validatorSchema['format_content'] = new sfValidatorChoice(array(
      'choices' => array_keys(swBlogPost::getFormatsList())
    ));
    
    $this->widgetSchema['sw_blog_post_tags_list'] = new swWidgetFormDoctrineInputCheckboxGroup(array('model' => 'swBlogTag'));

    foreach($this->getCulturesAvailable() as $lang => $name)
    {
      unset($this->widgetSchema[$lang]['slug']);
    
      $this->widgetSchema[$lang]['content'] = new sfWidgetFormTextarea;
      $this->validatorSchema[$lang]['raw_content']->setOption('required', true);
      $this->validatorSchema[$lang]['title']->setOption('required', true);
      
      $fields[] = $lang;
    }
    
    
    swFormHelper::resetFormLabels($this, array(
      'prefix' => 'label_',
      'catalogue' => 'swBlogPostAdmin',
      'mandatory_format' => '%s <sup>*</sup>'
    ));
    
    swFormHelper::useOnly($this, $fields);
  }
}