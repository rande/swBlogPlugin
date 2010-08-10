<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class baseSwBlogPostsDatagrid extends swDoctrineDatagrid
{
  public function getModelName()
  {
    return "swBlogPost";
  }
  
  public function setupDatagrid()
  {
    $this->widgetSchema['sort_by'] = new sfWidgetFormInputHidden;
    $this->widgetSchema['sort_order'] = new sfWidgetFormInputHidden;

    $this->addFilter('tag', null, 
      new sfWidgetFormDoctrineSelect(array(
        'add_empty' => true,
        'model' => 'swBlogTag'
      )),
      new swValidatorText(array('required' => false))
    );
    
    $this->addFilter('published', true, 
      new swWidgetFormTrilean, 
      new swValidatorTrilean(array('required' => false))
    );
  }

  function buildQuery(Doctrine_Query $query) {
  
    $query->leftJoin('swBlogPost.Translation');
    $query->leftJoin('swBlogPost.swBlogPostTags t');
    $query->leftJoin('t.Translation tt');
    
    if(strlen($this->getValue('tag')) > 0)
    {      
      $query->addWhere('tt.name = ? and tt.lang = ?', array($this->getValue('tag'), sfContext::getInstance()->getUser()->getCulture()));
    }
    
    if(!is_null($this->getValue('published')))
    {
      $query->addWhere('swBlogPost.published = ?', $this->getValue('published'));
    }
    
    $query->orderBy('created_at DESC');
    
    return $query;
  }
}
