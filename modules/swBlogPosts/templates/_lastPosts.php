<?php foreach($last_posts->getResults() as $sw_blog_post): ?>

  <?php echo sprintf($decorator, link_to(
    $sw_blog_post->getTitle(), 
    $sw_blog_post->getUrl('sw_blog_view_post')
  )) ?>

<?php endforeach ?>
