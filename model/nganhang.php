<?php
class nganhang
{
    public $Id,$NganHang,$NganHang_en,$Img,$TenTaiKhoan,$TenTaiKhoan_en,$SoTaiKhoan,$ChiNhanh,$ChiNhanh_en;
    public function nganhang($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->NganHang=isset($data['NganHang'])?$data['NganHang']:'';
    $this->NganHang_en=isset($data['NganHang_en'])?$data['NganHang_en']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->TenTaiKhoan=isset($data['TenTaiKhoan'])?$data['TenTaiKhoan']:'';
    $this->TenTaiKhoan_en=isset($data['TenTaiKhoan_en'])?$data['TenTaiKhoan_en']:'';
    $this->SoTaiKhoan=isset($data['SoTaiKhoan'])?$data['SoTaiKhoan']:'';
    $this->ChiNhanh=isset($data['ChiNhanh'])?$data['ChiNhanh']:'';
    $this->ChiNhanh_en=isset($data['ChiNhanh_en'])?$data['ChiNhanh_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->NganHang=addslashes($this->NganHang);
            $this->NganHang_en=addslashes($this->NganHang_en);
            $this->Img=addslashes($this->Img);
            $this->TenTaiKhoan=addslashes($this->TenTaiKhoan);
            $this->TenTaiKhoan_en=addslashes($this->TenTaiKhoan_en);
            $this->SoTaiKhoan=addslashes($this->SoTaiKhoan);
            $this->ChiNhanh=addslashes($this->ChiNhanh);
            $this->ChiNhanh_en=addslashes($this->ChiNhanh_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->NganHang=stripslashes($this->NganHang);
            $this->NganHang_en=stripslashes($this->NganHang_en);
            $this->Img=stripslashes($this->Img);
            $this->TenTaiKhoan=stripslashes($this->TenTaiKhoan);
            $this->TenTaiKhoan_en=stripslashes($this->TenTaiKhoan_en);
            $this->SoTaiKhoan=stripslashes($this->SoTaiKhoan);
            $this->ChiNhanh=stripslashes($this->ChiNhanh);
            $this->ChiNhanh_en=stripslashes($this->ChiNhanh_en);
        }
}
