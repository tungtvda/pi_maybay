<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_dichvu_sub($data)
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
    $ft->assign('TABLE-NAME','dichvu_sub');
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
    return '<th>Id</th><th>DanhMucId</th><th>BanChay</th><th>NoiBat</th><th>Tên</th><th>Name_en</th><th>Img</th><th>HangSao</th>';
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
        $TableBody.="<td>".$obj->BanChay."</td>";
        $TableBody.="<td>".$obj->NoiBat."</td>";
        $TableBody.="<td>".$obj->Name."</td>";
        $TableBody.="<td>".$obj->Name_en."</td>";
        $TableBody.="<td><img src=\"".$obj->Img."\" width=\"50px\" height=\"50px\"/> </td>";
        $TableBody.="<td>".$obj->HangSao."</td>";
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
    $str_from.='<p><label>BanChay</label><input  type="checkbox"  name="BanChay" value="1" '.(($form!=false)?(($form->BanChay=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>NoiBat</label><input  type="checkbox"  name="NoiBat" value="1" '.(($form!=false)?(($form->NoiBat=='1')?'checked':''):'').' /></p>';
    $str_from.='<p><label>Tên</label><input class="text-input small-input" type="text"  name="Name" value="'.(($form!=false)?$form->Name:'').'" /></p>';
    $str_from.='<p><label>Name_en</label><input class="text-input small-input" type="text"  name="Name_en" value="'.(($form!=false)?$form->Name_en:'').'" /></p>';
    $str_from.='<p><label>Img</label><input class="text-input small-input" type="text"  name="Img" value="'.(($form!=false)?$form->Img:'').'"/><a class="button" onclick="openKcEditor(\'Img\');">Upload ảnh</a></p>';
    $str_from.='<p><label>HangSao</label>';
    $str_from.='<select name="HangSao">';
    if(isset($ListKey['HangSao']))
    {
        foreach($ListKey['HangSao'] as $key)
        {
            $str_from.='<option value="'.$key->Id.'" '.(($form!=false)?(($form->HangSao==$key->Id)?'selected':''):'').'>'.$key->Name.'</option>';
        }
    }
    $str_from.='</select></p>';
    $str_from.='<p><label>Địa chỉ</label><input class="text-input small-input" type="text"  name="Address" value="'.(($form!=false)?$form->Address:'').'" /></p>';
    $str_from.='<p><label>Address_en</label><input class="text-input small-input" type="text"  name="Address_en" value="'.(($form!=false)?$form->Address_en:'').'" /></p>';
    $str_from.='<p><label>GiaCu</label><input class="text-input small-input" type="text"  name="GiaCu" value="'.(($form!=false)?$form->GiaCu:'').'" /></p>';
    $str_from.='<p><label>GiaCu_en</label><input class="text-input small-input" type="text"  name="GiaCu_en" value="'.(($form!=false)?$form->GiaCu_en:'').'" /></p>';
    $str_from.='<p><label>GiaMoi</label><input class="text-input small-input" type="text"  name="GiaMoi" value="'.(($form!=false)?$form->GiaMoi:'').'" /></p>';
    $str_from.='<p><label>GiaMoi_en</label><input class="text-input small-input" type="text"  name="GiaMoi_en" value="'.(($form!=false)?$form->GiaMoi_en:'').'" /></p>';
    return $str_from;
}
