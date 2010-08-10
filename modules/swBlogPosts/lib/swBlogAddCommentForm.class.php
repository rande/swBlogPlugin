<?php

class swBlogAddCommentForm extends swBlogCommentForm
{
  public function configure()
  {
    unset($this['moderated']);
    unset($this['post_id']);
    unset($this['moderated']);
    unset($this['created_at']);
    unset($this['updated_at']);
    
    if(!sfAutoload::getInstance()->loadClass('sfWidgetFormReCaptcha'))
    {
      throw new LogicException('Please install sfFormExtra : http://svn.symfony-project.com/plugins/sfFormExtraPlugin/');
    }
    
    $config = sfConfig::get('app_recaptcha_'.sfContext::getInstance()->getRequest()->getHost());
    
    $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
      'public_key' => $config['public_key'],
      'use_ssl'    => true
    ));
    
    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => $config['private_key'],
    ));
    
    $this->validatorSchema['url'] = new sfValidatorUrl(array('required' => false));
    $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => false));
    $this->validatorSchema['name'] = new swValidatorText(array('required' => true));
    $this->validatorSchema['message'] = new swValidatorText(array('required' => true));
  }
  
  
  public function updateObject($values = null)
  {
    $this->getObject()->setModerated(swBlogComment::MODERATED_NONE);
    parent::updateObject($values = null);
    
  }
}