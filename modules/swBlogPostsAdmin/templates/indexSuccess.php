<div class="sw-base-admin-list">
  <h2><?php echo sw_t(__('title_list_posts', null, 'swBlogPostsAdmin')) ?></h2>

  <?php include_partial('swBlogPostsAdmin/datagrid_filters', array('sw_blog_postList' => $sw_blog_postList)) ?>
  
  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogPostsAdmin/create') ?>">
      <span class="ui-icon ui-icon-create" ></span>
      <?php echo __('link_create', null, 'swBlogPostsAdmin') ?>
    </a>
  </div>
  
  <table class="sw-base-admin-table-standard">
    <thead>
      <tr>
        <th><?php echo __('th_published', null, 'swBlogPostsAdmin') ?></th>
        <th><?php echo __('th_title', null, 'swBlogPostsAdmin') ?></th>
        <th><?php echo __('th_created_at', null, 'swBlogPostsAdmin') ?></th>
        <th><?php echo __('th_actions', null, 'swBlogPostsAdmin') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sw_blog_postList->getResults() as $sw_blog_post): ?>
        <tr>
          <td>
            <?php if($sw_blog_post['published'] == '1'): ?>
              <?php echo image_tag('/sf/sf_admin/images/tick.png'); ?>
            <?php else: ?>
              <?php echo image_tag('/sf/sf_admin/images/error.png'); ?>
            <?php endif;?>
          </td>
          <td><?php echo $sw_blog_post['title'] ?></td>
          <td><?php echo $sw_blog_post['created_at'] ?></td>
          <td class="action"><a href="<?php echo url_for('swBlogPostsAdmin/edit?id='.$sw_blog_post['id']) ?>" class="edit"><?php echo __('link_edit', null, 'swBlogPostsAdmin') ?></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" class="sw-base-admin-table-pager">
          <?php echo sw_pager_navigation($sw_blog_postList, 'swBlogPostsAdmin/index') ?>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

