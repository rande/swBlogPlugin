<h2><?php echo sw_t($sw_blog_post->getTitle()) ?></h2>

<?php if($sw_blog_post->swBlogPostTags->count() > 0): ?>
  <?php include_partial('blog_tags', array('sw_blog_post' => $sw_blog_post)) ?>
<?php endif; ?>

<div class="sw_blog_post_content">
  <?php echo $sw_blog_post->getContent() ?>
</div>


<?php if($sw_blog_post_comments->count() > 0): ?>
  <div class="sw_blog_comments">
    <h2><a name="comments"><?php echo __('h2_comments', null, 'swBlogPosts') ?></a></h2>

    <?php foreach($sw_blog_post_comments->getResults() as $sw_blog_comment): ?>
      <div class="sw_blog_comment">
        <div class="sw_blog_comment_name"><?php echo $sw_blog_comment->getName() ?></div>
        <div class="sw_blog_comment_date">
          <?php echo __('text_time_comment', array('__time__' => distance_of_time_in_words(strtotime($sw_blog_comment->getCreatedAt()), strtotime($sw_blog_post->getCreatedAt()), false)),'swBlogPosts'); ?>
        </div>

        <div class="sw_blog_comment_message">
          <?php echo nl2br($sw_blog_comment->getMessage()) ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php if($sw_blog_post->isCommentable()): ?>
  <h2><a name="add-comment"><?php echo __('h2_add_comments', null, 'swBlogPosts') ?></a></h2>
  <div >
    <table>
      <?php echo $sw_blog_comment_form->renderGlobalErrors() ?>
    </table>

    <form action="<?php echo url_for('@sw_blog_add_comment?id='.$sw_blog_post->getId().'#add-comment') ?>" method="post">
      <?php echo $sw_blog_comment_form['name']->renderLabel() ?> <br />
      <?php echo $sw_blog_comment_form['name'] ?> <br />
      <?php echo $sw_blog_comment_form['email']->renderLabel() ?> <br />
      <?php echo $sw_blog_comment_form['email'] ?> <br />
      <?php echo $sw_blog_comment_form['url']->renderLabel() ?><br />
      <?php echo $sw_blog_comment_form['url'] ?> <br />
      <?php echo $sw_blog_comment_form['message']->renderLabel() ?><br />
      <?php echo $sw_blog_comment_form['message'] ?> <br />

      <?php echo $sw_blog_comment_form['captcha']->renderLabel() ?><br />
      <?php echo $sw_blog_comment_form['captcha'] ?> <br />


      <input type="submit" value="<?php echo __('btn_add_comment', null, 'swBlogPosts') ?>" />
    </form>
  </div>
<?php endif ?>