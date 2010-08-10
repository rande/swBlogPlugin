<?php $sw_blog_tag = $form->getObject() ?>

<h2><?php echo sw_t($form->isNew() ? __('title_new_tag', null, 'swBlogTagsAdmin') : __('title_edit_tag', null, 'swBlogTagsAdmin')) ?></h2>

<form action="<?php echo url_for('swBlogTagsAdmin/update'.(!$form->isNew() ? '?id='.$sw_blog_tag['id'] : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php echo $form->renderHiddenFields() ?>

  
  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogTagsAdmin/index') ?>">
      <span class="ui-icon ui-icon-close" ></span><?php echo __('link_cancel', null, 'swBlogTagsAdmin') ?>
    </a>
    
    <?php if (!$form->isNew()): ?>
      <?php echo link_to(
        __('link_delete', null, 'swBlogTagsAdmin'), 
        'swBlogTagsAdmin/delete?id='.$sw_blog_tag['id'], 
        array('post' => true, 'confirm' => __('message_are_you_sure', null, 'swBlogTagsAdmin'), 'class' => 'sw-ui-btn-link ui-state-default ui-corner-all') 
      ) ?>
    <?php endif; ?>
    
    <input type="submit" class="sw-ui-btn-link ui-state-default ui-corner-all" value="<?php echo __('btn_save', null, 'swBlogTagsAdmin') ?>" />
  </div>
  
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php foreach($form->getCulturesAvailable() as $lang => $name): ?>
        <tr>
          <th><label for="sw_blog_post_en"><?php echo $name ?></label></th>
          <td>
            <?php echo $form[$lang]->renderError() ?>
            <?php echo $form[$lang] ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</form>
