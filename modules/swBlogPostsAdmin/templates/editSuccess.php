<?php $sw_blog_post = $form->getObject() ?>

<?php use_helper('sfAsset') ?>
<?php echo init_asset_library() ?>

<?php if($form->isNew()): ?>
  <h2><?php echo sw_t(__('title_new_blog_post', null, 'swBlogPostsAdmin')) ?></h2>
<?php else: ?>
  <h2><?php echo sw_t(__('title_edit_blog_post', null, 'swBlogPostsAdmin')) ?></h2>
<?php endif; ?>

<form action="<?php echo url_for('swBlogPostsAdmin/update'.(!$form->isNew() ? '?id='.$sw_blog_post['id'] : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php echo $form->renderHiddenFields() ?>
  
  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogPostsAdmin/index') ?>">
      <span class="ui-icon ui-icon-close" ></span><?php echo __('link_cancel', null, 'swBlogPostsAdmin') ?>
    </a>
    
    <?php if (!$form->isNew()): ?>
      <?php echo link_to(
        __('link_delete', null, 'swBlogPostsAdmin'), 
        'swBlogPostsAdmin/delete?id='.$sw_blog_post['id'], 
        array('post' => true, 'confirm' => __('message_are_you_sure', null, 'swBlogPostsAdmin'), 'class' => 'sw-ui-btn-link ui-state-default ui-corner-all') 
      ) ?>
    <?php endif; ?>
    
    <input type="submit" class="sw-ui-btn-link ui-state-default ui-corner-all" value="<?php echo __('btn_save', null, 'swBlogPostsAdmin') ?>" />
  </div>
  
  <h3><?php echo __('h3_general_options', null, 'swBlogPostsAdmin') ?></h3>
  
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><label for="sw_blog_post_published"><?php echo __('label_published', null, 'swBlogPostsAdmin') ?></label></th>
        <td>
          <?php echo $form['published']->renderError() ?>
          <?php echo $form['published'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_post_comment_is_enabled"><?php echo __('label_comment_is_enabled', null, 'swBlogPostsAdmin') ?></label></th>
        <td>
          <?php echo $form['comment_is_enabled']->renderError() ?>
          <?php echo $form['comment_is_enabled'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_post_comment_close_at"><?php echo __('label_comment_close_at', null, 'swBlogPostsAdmin') ?></label></th>
        <td>
          <?php echo $form['comment_close_at']->renderError() ?>
          <?php echo $form['comment_close_at'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sw_blog_post_format_content"><?php echo __('label_format_content', null, 'swBlogPostsAdmin') ?></label></th>
        <td>
          <?php echo $form['format_content']->renderError() ?>
          <?php echo $form['format_content'] ?>
        </td>
      </tr>
      
    </tbody>
  </table>

  <h3><?php echo __('h3_tags', null, 'swBlogPostsAdmin') ?></h3>
  <table>
    <tbody>
      <tr>
        <th><label for="sw_blog_post_sw_blog_post_tags_list"><?php echo __('label_tags_list', null, 'swBlogPostsAdmin') ?></label></th>
        <td>
          <?php echo $form['sw_blog_post_tags_list']->renderError() ?>
          <?php echo $form['sw_blog_post_tags_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  
  <h3><?php echo __('h3_translations', null, 'swBlogPostsAdmin') ?></h3>
  <div  class='ui-auto-tabs'>
    <ul>
      <?php foreach($form->getCulturesAvailable() as $lang => $name): ?>
        <li class="ui-tabs-nav-item"><a href="#tab_<?php echo $lang ?>"><span><?php echo __('title_traduction_langue', array('_lang_' => $lang, '_name_' => $name), 'swBlogPostsAdmin') ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  
    <?php foreach($form->getCulturesAvailable() as $lang => $name): ?>
      <div id="tab_<?php echo $lang ?>" class="ui-tabs-panel">
        <div>
          <?php echo $form[$lang]['title']->renderLabel() ?>
          <?php echo $form[$lang]['title']->renderError() ?>
          <?php echo $form[$lang]['title']->render(array('style' => 'width:250px')) ?>
        </div>
        <div>
          <?php echo $form[$lang]['raw_content']->renderLabel() ?>
          <?php echo $form[$lang]['raw_content']->renderError() ?>
          <?php echo $form[$lang]['raw_content']->render(array('class' => 'sw-blog-content content_'.$lang)) ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  
</form>