<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_mangxahoi($data)
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
    $ft->assign('TABLE-NAME','mangxahoi');
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
    return '<th>Id</th><th>Face</th><th>Feed</th><th>Twitter</th><th>Google</th><th>Youtube</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->Face."</td>";
        $TableBody.="<td>".$obj->Feed."</td>";
        $TableBody.="<td>".$obj->Twitter."</td>";
        $TableBody.="<td>".$obj->Google."</td>";
        $TableBody.="<td>".$obj->Youtube."</td>";
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
    $str_from.='<p><label>Face</label><input class="text-input small-input" type="text"  name="Face" value="'.(($form!=false)?$form->Face:'').'" /></p>';
    $str_from.='<p><label>Feed</label><input class="text-input small-input" type="text"  name="Feed" value="'.(($form!=false)?$form->Feed:'').'" /></p>';
    $str_from.='<p><label>Twitter</label><input class="text-input small-input" type="text"  name="Twitter" value="'.(($form!=false)?$form->Twitter:'').'" /></p>';
    $str_from.='<p><label>Google</label><input class="text-input small-input" type="text"  name="Google" value="'.(($form!=false)?$form->Google:'').'" /></p>';
    $str_from.='<p><label>Youtube</label><input class="text-input small-input" type="text"  name="Youtube" value="'.(($form!=false)?$form->Youtube:'').'" /></p>';
    return $str_from;
}
