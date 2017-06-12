<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_gioithieu($data)
{
    $ft=new FastTemplate(DIR.'/view/admin/templates');
    $ft->define('header','header.tpl');
    $ft->define('body','body.tpl');
    $ft->define('footer','footer.tpl');
    //
    $ft->assign('TAB1-CLASS',isset($data['tab1_class'])?$data['tab1_class']:'');
    $ft->assign('TAB2-CLASS',isset($data['tab2_class'])?$data['tab2_class']:'');
    $ft->assign('USER-NAME',isset($data['username'])?$data['username']:'');
    $ft->assign('NOTIFICATION-CONTENT',isset($data['notififation_content'])?$data['notififation_content']:'');
    $ft->assign('TABLE-HEADER',showTableHeader());
    $ft->assign('PAGING',showPaging($data['count_paging'],20,$data['page']));
    $ft->assign('TABLE-BODY',showTableBody($data['table_body']));
    $ft->assign('TABLE-NAME','gioithieu');
    $ft->assign('CONTENT-BOX-LEFT',isset($data['content_box_left'])?$data['content_box_left']:'');
    $ft->assign('CONTENT-BOX-RIGHT',isset($data['content_box_right'])?$data['content_box_right']:' ');
    $ft->assign('NOTIFICATION',isset($data['notification'])?$data['notification']:' ');
    $ft->assign('SITE-NAME',isset($data['sitename'])?$data['sitename']:SITE_NAME);
    $ft->assign('FORM',showFrom(isset($data['form'])?$data['form']:'',isset($data['listfkey'])?$data['listfkey']:array()));
    //
    print $ft->parse_and_return('header');
    print $ft->parse_and_return('body');
    print $ft->parse_and_return('footer');
}
//
function showTableHeader()
{
    return '<th>Id</th><th>Tên</th><th>Img</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->Name."</td>";
        $TableBody.="<td><img src=\"".$obj->Img."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td><a href=\"?action=edit&Id=".$obj->Id."\" title=\"Edit\"><img src=\"".SITE_NAME."/view/admin/Themes/images/pencil.png\" alt=\"Edit\"></a>";
        $TableBody.="<a href=\"?action=delete&Id=".$obj->Id."\" title=\"Delete\" onClick=\"return confirm('Bạn có chắc chắc muốn xóa?')\"><img src=\"".SITE_NAME."/view/admin/Themes/images/cross.png\" alt=\"Delete\"></a> ";
        $TableBody.="</td>";
        $TableBody.="</tr>";
    }
    return $TableBody;
}
//
function showFrom($form,$ListKey=array())
{
    $str_from='';
    $str_from.='<p><label>Tên</label><input class="text-input small-input" type="text"  name="Name" value="'.(($form!=false)?$form->Name:'').'" /></p>';
    $str_from.='<p><label>Img</label><input class="text-input small-input" type="text"  name="Img" value="'.(($form!=false)?$form->Img:'').'"/><a class="button" onclick="openKcEditor(\'Img\');">Upload ảnh</a></p>';
    $str_from.='<p><label>Giới thiệu</label><textarea name="GioiThieu">'.(($form!=false)?$form->GioiThieu:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'GioiThieu\'); </script></p>';
    $str_from.='<p><label>GioiThieu_en</label><textarea name="GioiThieu_en">'.(($form!=false)?$form->GioiThieu_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'GioiThieu_en\'); </script></p>';
    $str_from.='<p><label>UuViet</label><textarea name="UuViet">'.(($form!=false)?$form->UuViet:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'UuViet\'); </script></p>';
    $str_from.='<p><label>UuViet_en</label><textarea name="UuViet_en">'.(($form!=false)?$form->UuViet_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'UuViet_en\'); </script></p>';
    $str_from.='<p><label>CacDichVu</label><textarea name="CacDichVu">'.(($form!=false)?$form->CacDichVu:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'CacDichVu\'); </script></p>';
    $str_from.='<p><label>CacDicVu_en</label><textarea name="CacDicVu_en">'.(($form!=false)?$form->CacDicVu_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'CacDicVu_en\'); </script></p>';
    $str_from.='<p><label>CamKet</label><textarea name="CamKet">'.(($form!=false)?$form->CamKet:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'CamKet\'); </script></p>';
    $str_from.='<p><label>CamKet_en</label><textarea name="CamKet_en">'.(($form!=false)?$form->CamKet_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'CamKet_en\'); </script></p>';
    $str_from.='<p><label>LienHe</label><textarea name="LienHe">'.(($form!=false)?$form->LienHe:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'LienHe\'); </script></p>';
    $str_from.='<p><label>LienHe_en</label><textarea name="LienHe_en">'.(($form!=false)?$form->LienHe_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'LienHe_en\'); </script></p>';
    return $str_from;
}
