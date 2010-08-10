<?php use_helper('I18N', 'Text', 'Date', 'swToolbox') ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <?php $title = sfConfig::get('app_swBlogPlugin_title') ?>
  <title><?php echo $title[$sf_user->getCulture() ? $sf_user->getCulture() : 'en'] ?></title>
  <subtitle><?php echo $sw_blog_title ?></subtitle>
  <link href="<?php echo url_for($sw_blog_uri_pager.'&sf_format=atom', true) ?>" rel="self"/>
  <link href="<?php echo url_for($sw_blog_uri_pager, true) ?>"/>
  <?php if($sw_blog_posts->getResults()->getFirst()): ?>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', strtotime($sw_blog_posts->getResults()->getFirst()->getCreatedAt())) ?></updated>
  <?php endif; ?>
  <author><name><?php echo sfConfig::get('app_swBlogPlugin_author') ?></name></author>
  <id><?php echo sha1(url_for('@sw_blog_index?sf_format=atom', true)) ?></id>

  <?php foreach($sw_blog_posts->getResults() as $sw_blog_post):?>
    <entry>
      <title><?php echo $sw_blog_post->getTitle() ?></title>
      <link href="<?php echo url_for($sw_blog_post->getUrl('sw_blog_view_post'), true) ?>" />
      <id><?php echo sha1($sw_blog_post->getId()) ?></id>
      <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', strtotime($sw_blog_post->getCreatedAt())) ?></updated>
      <summary><?php echo str_replace('&', '', truncate_text(strip_tags($sw_blog_post->getContent()), 200)) ?></summary>
      <author><name><?php echo sfConfig::get('app_swBlogPlugin_author') ?></name></author>
    </entry>
  <?php endforeach ?>
</feed>
