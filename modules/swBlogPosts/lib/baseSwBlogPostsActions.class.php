<?php

/**
 * swPagesAdmin actions.
 *
 * @package    soleoweb
 * @subpackage swPagesAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class baseSwBlogPostsActions extends sfActions
{
  
  public function executeIndex($request)
  {
    
    $this->sw_blog_posts = new swBlogPostsDatagrid(
      array(
        'published' => true
      ), 
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => sfConfig::get('app_swBlogPlugin_post_per_page', 5),
        'store'     => false
      )
    );
    
    $this->sw_blog_uri_pager = '@sw_blog_index?';
    $this->sw_blog_title = __('latest_posts', null, 'swBlogPosts');
        
  }
  
  public function executeIndexByTag($request)
  {
    $this->sw_blog_posts = new swBlogPostsDatagrid(
      array(
        'tag' => $request->getParameter('tag'),
        'published' => true 
      ),
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => 5,
        'store'     => false
      )
    );
    

    $this->sw_blog_uri_pager = '@sw_blog_tag_index?tag='.$this->sw_blog_posts->getValue('tag');
    $this->sw_blog_title = __('posts_by_tag', array('_tag_' => $this->sw_blog_posts->getValue('tag')), 'swBlogPosts');
    
    $this->setTemplate('index');
  }

  public function executeView($request)
  {
    
    $day = $request->getParameter('day');
    $month = $request->getParameter('month');
    $year = $request->getParameter('year');
    $slug = $request->getParameter('slug');
    
    $q = Doctrine::getTable('swBlogPost')->createQuery('p');
    $q->leftJoin('p.Translation t');
    $q->addWhere('p.published = ?', true);
    $q->addWhere('created_at LIKE ? and t.slug = ? and t.lang = ?', array($year.'-'.$month.'-'.$day.'%', $slug, $this->getUser()->getCulture()));
    
    $sw_blog_post = $request->getAttribute('sw_blog_post', $q->fetchOne());
    
    $this->forward404If(!$sw_blog_post);
    
    $sw_blog_comment_form = $request->getAttribute('sw_blog_comment_form', new swBlogAddCommentForm);
    
    $filters = $request->getParameter('filters', array());
    $filters['moderated'] = -2;
    $filters['post_id'] = $sw_blog_post->getId();
    
    $sw_blog_post_comments = new swBlogCommentsDatagrid(
      $filters, 
      array(
        'page'      => $request->getParameter('page'),
        'per_page'  => 50,
        'store'     => false
      )
    );
    
    $this->sw_blog_post = $sw_blog_post;
    $this->sw_blog_comment_form = $sw_blog_comment_form;
    $this->sw_blog_post_comments = $sw_blog_post_comments;
  }
  
  public function executeEmailNewComment($request)
  {
    
    $config = sfConfig::get('app_swBlogPlugin_email');
    
    $mail = new swMail;
    $mail->setSubject(__('title_subject_new_comment', array('_title_' => $this->sw_blog_comment->swBlogPost->getTitle()), 'swBlogPosts'));
    $mail->setFrom($config['from']);
    $mail->addTo($config['to']);
    
    $this->sw_blog_post = $this->sw_blog_comment->swBlogPost;
    $this->mail = $mail;
  }
  
  public function executeAddComment($request)
  {
    $sw_blog_post = Doctrine::getTable('swBlogPost')->find($request->getParameter('id'));
    $this->forward404If(!$sw_blog_post);
    $this->forward404If(!$sw_blog_post->isCommentable());

    $sw_blog_comment = new swBlogComment;
    $sw_blog_comment->swBlogPost = $sw_blog_post;
    
    $sw_blog_comment_form = new swBlogAddCommentForm($sw_blog_comment);
    
    if($request->isMethod('post'))
    {
    
      $captcha = array(
        'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
        'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
      );
      
      $params = array_merge($request->getParameter('sw_blog_comment'), array('captcha' => $captcha));
 
      $sw_blog_comment_form->bind($params);

      if($sw_blog_comment_form->isValid())
      {
        $sw_blog_comment_form->save();
        
        $email = $this->sendEmail('swBlogPosts', 'emailNewComment', array(
          'sw_blog_comment' => $sw_blog_comment_form->getObject()
        ));

        $this->redirect($sw_blog_post->getUrl('sw_blog_view_post'));
      }
    }

    $request->setAttribute('sw_blog_comment_form', $sw_blog_comment_form);
    $request->setAttribute('sw_blog_post', $sw_blog_post);
    
    $this->forward('swBlogPosts', 'view');
    
  }
}
