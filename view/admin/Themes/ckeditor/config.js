/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
   config.filebrowserBrowseUrl = sitename+'/view/admin/Themes/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = sitename+'/view/admin/Themes/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = sitename+'/view/admin/Themes/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl =sitename+ '/view/admin/Themes/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = sitename+'/view/admin/Themes/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl =sitename+ '/view/admin/Themes/kcfinder/upload.php?type=flash';
};
