<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_venoidia($data)
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
    $ft->assign('TABLE-NAME','venoidia');
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
    return '<th>Id</th><th>DanhMucId</th><th>Tên</th><th>Name_en</th><th>Img</th><th>Img_hang</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->DanhMucId."</td>";
        $TableBody.="<td>".$obj->Name."</td>";
        $TableBody.="<td>".$obj->Name_en."</td>";
        $TableBody.="<td><img src=\"".$obj->Img."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td><img src=\"".$obj->Img_hang."\" width=\"50px\" height=\"50px\"/> </td>";
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
    $str_from.='<p><label>DanhMucId</label>';
    $str_from.='<select name="DanhMucId">';
    if(isset($ListKey['DanhMucId']))
    {
        foreach($ListKey['DanhMucId'] as $key)
        {
            $str_from.='<option value="'.$key->Id.'" '.(($form!=false)?(($form->DanhMucId==$key->Id)?'selected':''):'').'>'.$key->Name.'</option>';
        }
    }
    $str_from.='</select></p>';
    $str_from.='<p><label>Tên</label><input class="text-input small-input" type="text"  name="Name" value="'.(($form!=false)?$form->Name:'').'" /></p>';
    $str_from.='<p><label>Name_en</label><input class="text-input small-input" type="text"  name="Name_en" value="'.(($form!=false)?$form->Name_en:'').'" /></p>';
    $str_from.='<p><label>MaChuyenBay</label><input class="text-input small-input" type="text"  name="MaChuyenBay" value="'.(($form!=false)?$form->MaChuyenBay:'').'" /></p>';
    $str_from.='<p><label>DiemDi</label><input class="text-input small-input" type="text"  name="DiemDi" value="'.(($form!=false)?$form->DiemDi:'').'" /></p>';
    $str_from.='<p><label>DiemDi_en</label><input class="text-input small-input" type="text"  name="DiemDi_en" value="'.(($form!=false)?$form->DiemDi_en:'').'" /></p>';
    $str_from.='<p><label>DiemDen</label><input class="text-input small-input" type="text"  name="DiemDen" value="'.(($form!=false)?$form->DiemDen:'').'" /></p>';
    $str_from.='<p><label>DiemDen_en</label><input class="text-input small-input" type="text"  name="DiemDen_en" value="'.(($form!=false)?$form->DiemDen_en:'').'" /></p>';
    $str_from.='<p><label>NgayDi</label><input class="text-input small-input" type="text"  name="NgayDi" value="'.(($form!=false)?$form->NgayDi:'').'" /></p>';
    $str_from.='<p><label>Gia</label><input class="text-input small-input" type="text"  name="Gia" value="'.(($form!=false)?$form->Gia:'').'" /></p>';
    $str_from.='<p><label>Gia_en</label><input class="text-input small-input" type="text"  name="Gia_en" value="'.(($form!=false)?$form->Gia_en:'').'" /></p>';
    $str_from.='<p><label>Img</label><input class="text-input small-input" type="text"  name="Img" value="'.(($form!=false)?$form->Img:'').'"/><a class="button" onclick="openKcEditor(\'Img\');">Upload ảnh</a></p>';
    $str_from.='<p><label>Img_hang</label><input class="text-input small-input" type="text"  name="Img_hang" value="'.(($form!=false)?$form->Img_hang:'').'"/><a class="button" onclick="openKcEditor(\'Img_hang\');">Upload ảnh</a></p>';
    $str_from.='<p><label>Nội dung</label><textarea name="NoiDung">'.(($form!=false)?$form->NoiDung:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'NoiDung\'); </script></p>';
    $str_from.='<p><label>NoiDung_en</label><textarea name="NoiDung_en">'.(($form!=false)?$form->NoiDung_en:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'NoiDung_en\'); </script></p>';
    $str_from.='<p><label>Tiêu đề</label><input class="text-input small-input" type="text"  name="Title" value="'.(($form!=false)?$form->Title:'').'" /></p>';
    $str_from.='<p><label>Title_en</label><input class="text-input small-input" type="text"  name="Title_en" value="'.(($form!=false)?$form->Title_en:'').'" /></p>';
    $str_from.='<p><label>Keyword</label><input class="text-input small-input" type="text"  name="Keyword" value="'.(($form!=false)?$form->Keyword:'').'" /></p>';
    $str_from.='<p><label>Mô tả</label><input class="text-input small-input" type="text"  name="Description" value="'.(($form!=false)?$form->Description:'').'" /></p>';
    $str_from.='<p><label>Created</label><input class="text-input small-input" type="text"  name="Created" value="'.(($form!=false)?$form->Created:'').'" /></p>';
    return $str_from;
}
