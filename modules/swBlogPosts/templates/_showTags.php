<?php foreach($sw_tags as $sw_tag): ?>

  <?php echo sprintf($decorator, link_to(
    $sw_tag->getName(), 
    '@sw_blog_tag_index?tag='.$sw_tag->getName()) ."  (".$sw_tag['num_post'].")") 
  ?>

<?php endforeach ?>
