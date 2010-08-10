<h2><?php echo sw_t(__('title_comments_list', null, 'swBlogCommentsAdmin')) ?></h2>

<?php include_partial('swBlogCommentsAdmin/datagrid_filters', array('sw_blog_commentList' => $sw_blog_commentList)) ?>

<div class="sw-base-admin-list">
  <div class="sw-form-actions">
    <a class="sw-ui-btn-link ui-state-default ui-corner-all" href="<?php echo url_for('swBlogCommentsAdmin/create') ?>">
      <span class="ui-icon ui-icon-create" ></span>
      <?php echo __('link_create', null, 'swBlogCommentsAdmin') ?>
    </a>
  </div>
  
  <table class="sw-base-admin-table-standard">
    <thead>
      <tr>
        <th><?php echo __('th_comment', null, 'swBlogCommentsAdmin') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sw_blog_commentList->getResults() as $sw_blog_comment): ?>
      <tr>
        <td colspan="1">
          <?php if($sw_blog_comment['moderated'] == '1'): ?>
            <?php echo image_tag('/sf/sf_admin/images/tick.png'); ?>
          <?php elseif($sw_blog_comment['moderated'] == '0'): ?>
            <?php echo image_tag('/sf/sf_admin/images/cancel.png'); ?>
          <?php else: ?>
            <?php echo image_tag('/sf/sf_admin/images/error.png'); ?>
          <?php endif;?>
          -
          <a href="<?php echo url_for('swBlogCommentsAdmin/edit?id='.$sw_blog_comment['id']) ?>"><?php echo __('link_edit', null, 'swBlogCommentsAdmin') ?></a>
          <br />
          
          <strong><?php echo $sw_blog_comment['name'] ?></strong> (<?php echo $sw_blog_comment['email'] ?>) - 
          <em><?php echo $sw_blog_comment['swBlogPost'] ?></em>
          <br />
          --
          <br />
          <a href="<?php echo $sw_blog_comment['url'] ?>"><?php echo $sw_blog_comment['url'] ?></a>
          <div>
            <?php echo nl2br($sw_blog_comment['message']) ?>
          </div>
        
      </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="7" class="sw-base-admin-table-pager">
          <?php echo sw_pager_navigation($sw_blog_commentList, 'swBlogCommentsAdmin/index') ?>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
