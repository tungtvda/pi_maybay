<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_vanphong($data)
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
    $ft->assign('TABLE-NAME','vanphong');
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
    return '<th>Id</th><th>Địa chỉ</th><th>Address_en</th><th>Điện Thoại</th><th>BanDo</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->Address."</td>";
        $TableBody.="<td>".$obj->Address_en."</td>";
        $TableBody.="<td>".$obj->Phone."</td>";
        $TableBody.="<td><img src=\"".$obj->BanDo."\" width=\"50px\" height=\"50px\"/> </td>";
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
    $str_from.='<p><label>Địa chỉ</label><input class="text-input small-input" type="text"  name="Address" value="'.(($form!=false)?$form->Address:'').'" /></p>';
    $str_from.='<p><label>Address_en</label><input class="text-input small-input" type="text"  name="Address_en" value="'.(($form!=false)?$form->Address_en:'').'" /></p>';
    $str_from.='<p><label>Điện Thoại</label><input class="text-input small-input" type="text"  name="Phone" value="'.(($form!=false)?$form->Phone:'').'" /></p>';
    $str_from.='<p><label>BanDo</label><input class="text-input small-input" type="text"  name="BanDo" value="'.(($form!=false)?$form->BanDo:'').'"/><a class="button" onclick="openKcEditor(\'BanDo\');">Upload ảnh</a></p>';
    return $str_from;
}
