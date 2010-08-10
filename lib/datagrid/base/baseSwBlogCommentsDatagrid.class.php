<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class baseSwBlogCommentsDatagrid extends swDoctrineDatagrid
{
  public function getModelName()
  {
    return "swBlogComment";
  }
  
  public function setupDatagrid()
  {
    $this->widgetSchema['sort_by'] = new sfWidgetFormInputHidden;
    $this->widgetSchema['sort_order'] = new sfWidgetFormInputHidden;
    
    
    $this->addFilter(
      'moderated',
      -1,
      new sfWidgetFormSelect(array(
        'choices' => array(
          '' => __('status_all', null, 'swBlogCommentsAdmin'), 
          -2 => __('status_visible_and_not_moderated', null, 'swBlogCommentsAdmin'), 
          -1 => __('status_not_moderated', null, 'swBlogCommentsAdmin'), 
          -3 => __('status_moderated', null, 'swBlogCommentsAdmin'), 
          1 => __('status_validated', null, 'swBlogCommentsAdmin'), 
          0 => __('status_removed', null, 'swBlogCommentsAdmin')
      ))),
      new sfValidatorNumber(array('required' => false)),
      __('label_moderated', null, 'swBlogCommentsAdmin')
    );
    
    $this->addFilter(
      'post_id', 
      null, 
      new sfWidgetFormInput, 
      new sfValidatorNumber(array('required' => false)),
      __('label_post_id', null, 'swBlogCommentsAdmin')
    );
    
  }

  function buildQuery(Doctrine_Query $query) {
    
    $query->orderBy('swBlogComment.created_at ASC');
    
    $query->leftJoin('swBlogComment.swBlogPost');
    
    if($this->getValue('moderated') == -2)
    {
      $query->whereIn('swBlogComment.moderated', array(swBlogComment::MODERATED_NONE, swBlogComment::MODERATED_OK));
    }
    
    if($this->getValue('moderated') == -1)
    {
      $query->whereIn('swBlogComment.moderated', array(swBlogComment::MODERATED_NONE));
    }
    
    if($this->getValue('moderated') == -3)
    {
      $query->whereIn('swBlogComment.moderated', array(swBlogComment::MODERATED_KO, swBlogComment::MODERATED_OK));
    }
    
    if($this->getValue('moderated') == 1)
    {
      $query->whereIn('swBlogComment.moderated', array(swBlogComment::MODERATED_OK));
    }
    
    if($this->getValue('moderated') === 0)
    {
      $query->whereIn('swBlogComment.moderated', array(swBlogComment::MODERATED_KO));
    }
    
    if(is_numeric($this->getValue('post_id')))
    {
      $query->addWhere('swBlogComment.post_id = ?', $this->getValue('post_id'));
    }
    
    return $query;
  }
}
