<?php use_helper('Text') ?>

<?php echo __('message_email_header', null, 'swBlogPosts')?> 

<?php echo $sw_blog_post->getTitle() ?> 

<?php echo __('label_email_name', null, 'swBlogPosts')?><?php echo $sw_blog_comment->getName() ?> 
<?php echo __('label_email_email', null, 'swBlogPosts')?><?php echo $sw_blog_comment->getEmail() ?> 
<?php echo __('label_email_url', null, 'swBlogPosts')?><?php echo $sw_blog_comment->getUrl() ?> 
<?php echo __('label_email_message', null, 'swBlogPosts')?> 

<?php echo wrap_text($sw_blog_comment->getMessage(), 65) ?>

<?php echo __('message_email_footer', null, 'swBlogPosts')?>