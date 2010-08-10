<span class="sw_blog_post_tags">
  <?php echo __('label_tags', null, 'swBlogPosts') ?> 
  <?php foreach($sw_blog_post->swBlogPostTags as $sw_blog_tags): ?>
    <?php echo link_to($sw_blog_tags->getName(), '@sw_blog_tag_index?tag='.$sw_blog_tags->getName()) ?>
  <?php endforeach; ?>
</span>