jQuery(document).ready(function() {
  
  tinyMCE.settings = {
    mode: 'none',
    theme: 'advanced',
    width: 690,
    height: 450,
    file_browser_callback: "sfAssetsLibrary.fileBrowserCallBack", 
    relative_urls: false,
    theme_advanced_toolbar_location:   "top",
    theme_advanced_toolbar_align:      "left",
    theme_advanced_statusbar_location: "bottom",
    theme_advanced_resizing:           true
  };
  
  jQuery('#sw_blog_post_format_content').change(function() {
    var elms = jQuery('textarea.sw-blog-content');
    elms.markItUpRemove();
    
    elms.each(function(index) {
      tinyMCE.execCommand('mceRemoveControl', true, jQuery(this).attr('id'));
    });
    
    var format = jQuery(this).val();
    
    switch(format) 
    {
      case 'textile':
        elms.markItUp(markitup_textileSettings);
        break;
      case 'markdown':
        elms.markItUp(markitup_markdownSettings);
        break;
      case 'html':
        elms.markItUp(markitup_defaultSettings);
        break;
      case 'richhtml':
        elms.each(function(index) {
          tinyMCE.execCommand('mceAddControl', true, jQuery(this).attr('id'));
        });
    }
  });
  
  jQuery('#sw_blog_post_format_content').trigger('change');
});