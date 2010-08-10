<?php
/*
 * This file is part of the swBlogPlugin package.
 *
 * (c) 2010 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class baseSwBlogTagsDatagrid extends swDoctrineDatagrid
{
  public function getModelName()
  {
    return "swBlogTag";
  }
  
  public function setupDatagrid()
  {
    
    $this->widgetSchema['sort_by'] = new sfWidgetFormInputHidden;
    $this->widgetSchema['sort_order'] = new sfWidgetFormInputHidden;
    
    
  }

  function buildQuery(Doctrine_Query $query) {
    
    return $query;
  }
}
