<h2><?php echo sw_t(__('title_list_tags', null, 'swBlogTagsAdmin')) ?></h2>

<?php /*
<div class="sw-base-filters">
  <h3><?php echo __('title_filters', null, 'swBlogTagsAdmin') ?></h3>
  <form action="<?php echo url_for('swBlogTagsAdmin/index') ?>" method="get" />
    <?php echo $sw_blog_tagList ?>
      
    <input type="submit" name="filters[filter]" value="<?php echo __('btn_filter', null, 'swBlogTagsAdmin') ?>" />
    <input type="submit" name="filters[reset]" value="<?php echo __('btn_reset', null, 'swBlogTagsAdmin') ?>" />
  </form>
</div>

*/ ?>


<div class="sw-base-admin-list">

  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogTagsAdmin/create') ?>">
      <span class="ui-icon ui-icon-create" ></span>
      <?php echo __('link_create', null, 'swBlogTagsAdmin') ?>
    </a>
  </div>
  
  <table class="sw-base-admin-table-standard">
    <thead>
      <tr>
        <th><?php echo __('th_name', null, 'swBlogTagsAdmin') ?></th>
        <th><?php echo __('th_actions', null, 'swBlogTagsAdmin') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sw_blog_tagList->getResults() as $sw_blog_tag): ?>
        <tr>
          <td><?php echo $sw_blog_tag['name'] ?></td>
          <td class='action'><a href="<?php echo url_for('swBlogTagsAdmin/edit?id='.$sw_blog_tag['id']) ?>" class='edit'><?php echo __('link_edit', null, 'swBlogTagsAdmin') ?></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2" class="sw-base-admin-table-pager">
          <?php echo sw_pager_navigation($sw_blog_tagList, 'swBlogTagsAdmin/index') ?>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
