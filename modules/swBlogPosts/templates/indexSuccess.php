<?php use_helper('I18N', 'Text', 'Date', 'swToolbox') ?>

<h1><?php echo link_to(sw_t(__('h1_blog_index', null, 'swBlogPosts')), '@sw_blog_index') ?></h1>

<?php slot('tags', get_component('swBlogPosts', 'showTags')) ?>

<?php foreach($sw_blog_posts->getResults() as $sw_blog_post):?>
  <div class='sw_blog_post'>
    
    <h2>
      <?php echo link_to( $sw_blog_post->getTitle(), $sw_blog_post->getUrl('sw_blog_view_post')) ?>
      <span class="sw_blog_post_date"><?php echo time_ago_in_words(strtotime($sw_blog_post->getCreatedAt())) ?></span>
    </h2>
    
    <div class='sw_blog_post_header'>
      
    </div>
    
    <div class='sw_blog_post_abstract'>
      <?php echo truncate_text(strip_tags($sw_blog_post->getContent()), 200) ?>
      <?php echo link_to(__('link_read_more', null, 'swBlogPosts'), $sw_blog_post->getUrl('sw_blog_view_post')) ?>
    </div>
    
    <div class='sw_blog_post_options'>
      <?php echo link_to(__("text_comments", array('__comments__' => $sw_blog_post->getswBlogComments()->count()), 'swBlogPosts'), $sw_blog_post->getUrl('sw_blog_view_post').'#comments') ?>

      <?php if($sw_blog_post->swBlogPostTags->count() > 0): ?>
        -
        <?php include_partial('blog_tags', array('sw_blog_post' => $sw_blog_post)) ?>
      <?php endif; ?>
    </div>

  </div>
<?php endforeach ?>

<div class="sw_blog_post_pager_navigation">
  <?php echo sw_pager_navigation($sw_blog_posts, $sw_blog_uri_pager) ?>
</div>