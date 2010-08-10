<div class="sw-base-filters sw-filters-top-auto">
  <form action="<?php echo url_for('swBlogCommentsAdmin/index') ?>" method="get" class="sw-base-filter-form" >
    <div class="sw-base-filter-definition">
      <h3><?php echo __('filters_title', null, 'swBlogCommentsAdmin') ?></h3>
      <dl>
        <?php echo $sw_blog_commentList['moderated']->renderRow() ?>
      </dl>
      <dl>
        <?php echo $sw_blog_commentList['post_id']->renderRow() ?>
      </dl>
    </div>

    <div class="sw-base-filter-actions">
      <input type="submit" name="filters[filter]" class='sw-filter-action sw-filter-filter' value="<?php echo __('submit_filter_btn', null, 'swBlogCommentsAdmin') ?>" />
      <input type="submit" name="filters[reset]" class='sw-filter-action sw-filter-reset' value="<?php echo __('reset_filter_btn', null, 'swBlogCommentsAdmin') ?>" />
    </div>
  </form>
</div>