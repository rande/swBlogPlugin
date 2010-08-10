<div class="sw-base-filters sw-filters-top-auto">
  <form action="<?php echo url_for('swBlogPostsAdmin/index') ?>" method="get" class="sw-base-filter-form" >
    <div class="sw-base-filter-definition">
      <h3><?php echo __('filters_title', null, 'swBlogPostsAdmin') ?></h3>
      <dl>
        <?php echo $sw_blog_postList['tag']->renderRow() ?>
      </dl>
      <dl>
        <?php echo $sw_blog_postList['published']->renderRow() ?>
      </dl>
    </div>

    <div class="sw-base-filter-actions">
      <input type="submit" name="filters[filter]" class='sw-filter-action sw-filter-filter' value="<?php echo __('submit_filter_btn', null, 'swBlogPostsAdmin') ?>" />
      <input type="submit" name="filters[reset]" class='sw-filter-action sw-filter-reset' value="<?php echo __('reset_filter_btn', null, 'swBlogPostsAdmin') ?>" />
    </div>
  </form>
</div>