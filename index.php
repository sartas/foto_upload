<?php
if (!defined('DEBUG'))
  die;



Plugin::setInfos(array(
    'id' => 'foto_upload',
    'title' => __('foto_upload'),
    'description' => __('foto_upload'),
    'version' => '1.1.0',
    'license' => 'GPL',
    'author' => 'sartas',
    'website' => 'http://www.wolfcms.org/',
    'update_url' => 'http://www.wolfcms.org/plugin-versions.xml',
    'require_wolf_version' => '0.5.5'
));
if (FROG_BACKEND) /* BACKEND */ {
  Plugin::addController('foto_upload', __('foto_upload'), 'administrator', false);


  Observer::observe('view_page_edit_plugins', 'display_upload');
}

function display_upload(&$page) {
  if (!isset($page->id))
    return;
  if (!isset($page->foto_count))
    $page->foto_count = 0;
  ?>
  <p id="foto" title=""><label for="foto_count">Фото: <small><a onclick="remove_foto(this);return false;" href="/<?= ADMIN_DIR; ?>/plugin/foto_upload/remove/<?= $page->id; ?>">удалить</a></small></label>
    <input id="foto_count"  maxlength="100" name="page[foto_count]" size="10" type="text"  value="<?= (int) $page->foto_count; ?>" /></p>

  <p><label for="foto_count"><div style="padding-top:15px;display:inline-block;line-height:20px;width:40px;"><span id="uploadify"></span></div></label></p>

  <script type="text/javascript" src="<?= PLUGINS_URL; ?>foto_upload/uploadify/jquery.uploadify.js"></script>

  <script type="text/javascript" src="<?= PLUGINS_URL; ?>foto_upload/uploadify/swfobject.js"></script>
  <script type="text/javascript">
    var page_id =<?= $page->id; ?>;
              
    function remove_foto(obj){
      if(!confirm('Удалить все фото?')) return false;
      var url = obj.href;
      $.post(url, function(data){
        if(data=='success'){
          $('#foto_count').attr('value',0);
        }
        else {alert('Ошибка')}
      });
    }
              
  </script>
  <script type="text/javascript" src="<?= PLUGINS_URL; ?>foto_upload/up.js"></script>
  <link href="<?= PLUGINS_URL; ?>foto_upload/uploadify/uploadify.css" rel="stylesheet" type="text/css" media="screen" />

<? } ?>