<?php
require_once DIR.'/common/paging.php';
require_once DIR.'/common/cls_fast_template.php';
function view_datve($data)
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
    $ft->assign('TABLE-NAME','datve');
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
    return '<th>Id</th><th>TrangThaiThanhToan</th><th>MaDatVe</th><th>HangBay</th><th>LoaiVe</th><th>ChieuDi</th><th>ChieuVe</th><th>NgayDi</th><th>NgayVe</th><th>SoNguoiLon</th><th>SoTreEm</th><th>TreSoSinh</th><th>ThanhTien</th><th>NguoiDaiDien</th><th>NgayDat</th>';
}
//
function showTableBody($data)
{
    $TableBody='';
    if(count($data)>0) foreach($data as $obj)
    {
        $TableBody.="<tr><td><input type=\"checkbox\" name=\"check_".$obj->Id."\"/></td>";
        $TableBody.="<td>".$obj->Id."</td>";
        $TableBody.="<td>".$obj->TrangThaiThanhToan."</td>";
        $TableBody.="<td>".$obj->MaDatVe."</td>";
        $TableBody.="<td>".$obj->HangBay."</td>";
        $TableBody.="<td>".$obj->LoaiVe."</td>";
        $TableBody.="<td>".$obj->ChieuDi."</td>";
        $TableBody.="<td>".$obj->ChieuVe."</td>";
        $TableBody.="<td>".$obj->NgayDi."</td>";
        $TableBody.="<td>".$obj->NgayVe."</td>";
        $TableBody.="<td>".$obj->SoNguoiLon."</td>";
        $TableBody.="<td>".$obj->SoTreEm."</td>";
        $TableBody.="<td>".$obj->TreSoSinh."</td>";
        $TableBody.="<td>".$obj->ThanhTien."</td>";
        $TableBody.="<td>".$obj->NguoiDaiDien."</td>";
        $TableBody.="<td>".$obj->NgayDat."</td>";
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
    $str_from.='<p><label>TrangThaiThanhToan</label>';
    $str_from.='<select name="TrangThaiThanhToan">';
    if(isset($ListKey['TrangThaiThanhToan']))
    {
        foreach($ListKey['TrangThaiThanhToan'] as $key)
        {
            $str_from.='<option value="'.$key->Id.'" '.(($form!=false)?(($form->TrangThaiThanhToan==$key->Id)?'selected':''):'').'>'.$key->Name.'</option>';
        }
    }
    $str_from.='</select></p>';
    $str_from.='<p><label>MaDatVe</label><input class="text-input small-input" type="text"  name="MaDatVe" value="'.(($form!=false)?$form->MaDatVe:'').'" /></p>';
    $str_from.='<p><label>HangBay</label><input class="text-input small-input" type="text"  name="HangBay" value="'.(($form!=false)?$form->HangBay:'').'" /></p>';
    $str_from.='<p><label>LoaiVe</label><input class="text-input small-input" type="text"  name="LoaiVe" value="'.(($form!=false)?$form->LoaiVe:'').'" /></p>';
    $str_from.='<p><label>ChieuDi</label><input class="text-input small-input" type="text"  name="ChieuDi" value="'.(($form!=false)?$form->ChieuDi:'').'" /></p>';
    $str_from.='<p><label>ChieuVe</label><input class="text-input small-input" type="text"  name="ChieuVe" value="'.(($form!=false)?$form->ChieuVe:'').'" /></p>';
    $str_from.='<p><label>NgayDi</label><input class="text-input small-input" type="text"  name="NgayDi" value="'.(($form!=false)?$form->NgayDi:'').'" /></p>';
    $str_from.='<p><label>NgayVe</label><input class="text-input small-input" type="text"  name="NgayVe" value="'.(($form!=false)?$form->NgayVe:'').'" /></p>';
    $str_from.='<p><label>SoNguoiLon</label><input class="text-input small-input" type="text"  name="SoNguoiLon" value="'.(($form!=false)?$form->SoNguoiLon:'').'" /></p>';
    $str_from.='<p><label>SoTreEm</label><input class="text-input small-input" type="text"  name="SoTreEm" value="'.(($form!=false)?$form->SoTreEm:'').'" /></p>';
    $str_from.='<p><label>TreSoSinh</label><input class="text-input small-input" type="text"  name="TreSoSinh" value="'.(($form!=false)?$form->TreSoSinh:'').'" /></p>';
    $str_from.='<p><label>ThanhTien</label><input class="text-input small-input" type="text"  name="ThanhTien" value="'.(($form!=false)?$form->ThanhTien:'').'" /></p>';
    $str_from.='<p><label>NguoiDaiDien</label><input class="text-input small-input" type="text"  name="NguoiDaiDien" value="'.(($form!=false)?$form->NguoiDaiDien:'').'" /></p>';
    $str_from.='<p><label>Điện Thoại</label><input class="text-input small-input" type="text"  name="Phone" value="'.(($form!=false)?$form->Phone:'').'" /></p>';
    $str_from.='<p><label>Email</label><input class="text-input small-input" type="text"  name="Email" value="'.(($form!=false)?$form->Email:'').'" /></p>';
    $str_from.='<p><label>Địa chỉ</label><input class="text-input small-input" type="text"  name="Address" value="'.(($form!=false)?$form->Address:'').'" /></p>';
    $str_from.='<p><label>YeuCau</label><textarea name="YeuCau">'.(($form!=false)?$form->YeuCau:'').'</textarea><script type="text/javascript">CKEDITOR.replace(\'YeuCau\'); </script></p>';
    $str_from.='<p><label>MaSoThue</label><input class="text-input small-input" type="text"  name="MaSoThue" value="'.(($form!=false)?$form->MaSoThue:'').'" /></p>';
    $str_from.='<p><label>TenCongTy</label><input class="text-input small-input" type="text"  name="TenCongTy" value="'.(($form!=false)?$form->TenCongTy:'').'" /></p>';
    $str_from.='<p><label>DiaChiCongTy</label><input class="text-input small-input" type="text"  name="DiaChiCongTy" value="'.(($form!=false)?$form->DiaChiCongTy:'').'" /></p>';
    $str_from.='<p><label>DiaChiNhanHoaDon</label><input class="text-input small-input" type="text"  name="DiaChiNhanHoaDon" value="'.(($form!=false)?$form->DiaChiNhanHoaDon:'').'" /></p>';
    $str_from.='<p><label>HTTT</label><input class="text-input small-input" type="text"  name="HTTT" value="'.(($form!=false)?$form->HTTT:'').'" /></p>';
    $str_from.='<p><label>NgayDat</label><input class="text-input small-input" type="text"  name="NgayDat" value="'.(($form!=false)?$form->NgayDat:'').'" /></p>';
    return $str_from;
}
