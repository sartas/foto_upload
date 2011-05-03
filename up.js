
var PLUGINS_URL = '/frog/plugins/';

  var getPhpsessid = function()
  {
    var start = document.cookie.indexOf('PHPSESSID=');
	
    // First ; after start
    var end = document.cookie.indexOf(';', start);
	
    // failed indexOf = -1
    if( end == -1 )
      end = document.cookie.length;
		
    return document.cookie.substring( start+10, end );
  };

  //var form_action = jQuery('#files_upload').attr('action');

  $('#uploadify').uploadify({
    // options
    'uploader'  : PLUGINS_URL + 'foto_upload/uploadify/uploadify.swf',
    'script'    :  '/admin/plugin/foto_upload/upload/',
    'expressInstall' : PLUGINS_URL + 'foto_upload/uploadify/expressInstall.swf',
    'buttonImg'   : '/frog/plugins/foto_upload/uploadify/upload.png',
    'fileExt'        : '*.jpg',
    'fileDesc'       : 'Image Files *.JPG',
    'multi'     : true,
    'method'    : 'POST',
    'auto'      : true,
    'cancelImg' : '/frog/plugins/foto_upload/uploadify/cancel.png',
    'width'       : 24,
    'height'       : 24,
    'wmode'       : 'transparent',
    'scriptData'  : {
      'page_id':page_id,
      'PHPSESSID': getPhpsessid()
    },
    'onComplete'  : function(event, ID, fileObj, response, data) {
      var x=unescape(response);
      x= x.replace(/[^0-9]/,"");
      x= parseInt(x);
      $('#foto_count').attr('value',x);
    }
    
  });
