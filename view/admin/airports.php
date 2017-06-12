<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_airports($data)
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
    $ft->assign('TABLE-NAME','airports');
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
    return '<th>code</th><th>Id</th><th>name</th><th>cityCode</th><th>cityName</th><th>countryName</th><th>countryCode</th><th>timezone</th><th>lat</th><th>lon</th><th>numAirports</th><th>city</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->code."</td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->name."</td>";
        $TableBody.="<td>".$obj->cityCode."</td>";
        $TableBody.="<td>".$obj->cityName."</td>";
        $TableBody.="<td>".$obj->countryName."</td>";
        $TableBody.="<td>".$obj->countryCode."</td>";
        $TableBody.="<td>".$obj->timezone."</td>";
        $TableBody.="<td>".$obj->lat."</td>";
        $TableBody.="<td>".$obj->lon."</td>";
        $TableBody.="<td>".$obj->numAirports."</td>";
        $TableBody.="<td>".$obj->city."</td>";
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
    $str_from.='<p><label>code</label><input class="text-input small-input" type="text"  name="code" value="'.(($form!=false)?$form->code:'').'" /></p>';
    $str_from.='<p><label>name</label><input class="text-input small-input" type="text"  name="name" value="'.(($form!=false)?$form->name:'').'" /></p>';
    $str_from.='<p><label>cityCode</label><input class="text-input small-input" type="text"  name="cityCode" value="'.(($form!=false)?$form->cityCode:'').'" /></p>';
    $str_from.='<p><label>cityName</label><input class="text-input small-input" type="text"  name="cityName" value="'.(($form!=false)?$form->cityName:'').'" /></p>';
    $str_from.='<p><label>countryName</label><input class="text-input small-input" type="text"  name="countryName" value="'.(($form!=false)?$form->countryName:'').'" /></p>';
    $str_from.='<p><label>countryCode</label><input class="text-input small-input" type="text"  name="countryCode" value="'.(($form!=false)?$form->countryCode:'').'" /></p>';
    $str_from.='<p><label>timezone</label><input class="text-input small-input" type="text"  name="timezone" value="'.(($form!=false)?$form->timezone:'').'" /></p>';
    $str_from.='<p><label>lat</label><input class="text-input small-input" type="text"  name="lat" value="'.(($form!=false)?$form->lat:'').'" /></p>';
    $str_from.='<p><label>lon</label><input class="text-input small-input" type="text"  name="lon" value="'.(($form!=false)?$form->lon:'').'" /></p>';
    $str_from.='<p><label>numAirports</label><input class="text-input small-input" type="text"  name="numAirports" value="'.(($form!=false)?$form->numAirports:'').'" /></p>';
    $str_from.='<p><label>city</label><input class="text-input small-input" type="text"  name="city" value="'.(($form!=false)?$form->city:'').'" /></p>';
    return $str_from;
}
