<?php $sw_blog_comment = $form->getObject() ?>


<?php if($form->isNew()): ?>
  <h2><?php echo sw_t(__('title_new_blog_comment', null, 'swBlogCommentsAdmin')) ?></h2>
<?php else: ?>
  <h2><?php echo sw_t(__('title_edit_blog_comment', null, 'swBlogCommentsAdmin')) ?></h2>
<?php endif; ?>

<form action="<?php echo url_for('swBlogCommentsAdmin/update'.(!$form->isNew() ? '?id='.$sw_blog_comment['id'] : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php echo $form['id'] ?>
  
  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogCommentsAdmin/index') ?>">
      <span class="ui-icon ui-icon-close" ></span><?php echo __('link_cancel', null, 'swBlogCommentsAdmin') ?>
    </a>
    
    <?php if (!$form->isNew()): ?>
      <?php echo link_to(
        __('link_delete', null, 'swBlogCommentsAdmin'), 
        'swBlogCommentsAdmin/delete?id='.$sw_blog_comment['id'], 
        array('post' => true, 'confirm' => __('message_are_you_sure', null, 'swBlogCommentsAdmin'), 'class' => 'sw-ui-btn-link ui-state-default ui-corner-all') 
      ) ?>
    <?php endif; ?>
    
    <input type="submit" class="sw-ui-btn-link ui-state-default ui-corner-all" value="<?php echo __('btn_save', null, 'swBlogCommentsAdmin') ?>" />
  </div>
  
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><label for="sw_blog_comment_moderated"><?php echo __('label_moderated', null, 'swBlogCommentsAdmin') ?></label></th>
        <td>
          <?php echo $form['moderated']->renderError() ?>
          <?php echo $form['moderated'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_comment_name"><?php echo __('label_name', null, 'swBlogCommentsAdmin') ?></label></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_comment_email"><?php echo __('label_email', null, 'swBlogCommentsAdmin') ?></label></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_comment_url"><?php echo __('label_url', null, 'swBlogCommentsAdmin') ?></label></th>
        <td>
          <?php echo $form['url']->renderError() ?>
          <?php echo $form['url'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_comment_message"><?php echo __('label_message', null, 'swBlogCommentsAdmin') ?></label></th>
        <td>
          <?php echo $form['message']->renderError() ?>
          <?php echo $form['message']->render(array('style' => 'width:650px;height:450px')) ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
