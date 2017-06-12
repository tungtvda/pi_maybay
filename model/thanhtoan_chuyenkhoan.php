<?php
class thanhtoan_chuyenkhoan
{
    public $Id,$Name,$HuongDanThanhToan,$HuongDanThanhToan_en,$ThongTinChuyenKhoan,$ThongTinChuyenKhoan_en;
    public function thanhtoan_chuyenkhoan($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->HuongDanThanhToan=isset($data['HuongDanThanhToan'])?$data['HuongDanThanhToan']:'';
    $this->HuongDanThanhToan_en=isset($data['HuongDanThanhToan_en'])?$data['HuongDanThanhToan_en']:'';
    $this->ThongTinChuyenKhoan=isset($data['ThongTinChuyenKhoan'])?$data['ThongTinChuyenKhoan']:'';
    $this->ThongTinChuyenKhoan_en=isset($data['ThongTinChuyenKhoan_en'])?$data['ThongTinChuyenKhoan_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->HuongDanThanhToan=addslashes($this->HuongDanThanhToan);
            $this->HuongDanThanhToan_en=addslashes($this->HuongDanThanhToan_en);
            $this->ThongTinChuyenKhoan=addslashes($this->ThongTinChuyenKhoan);
            $this->ThongTinChuyenKhoan_en=addslashes($this->ThongTinChuyenKhoan_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->HuongDanThanhToan=stripslashes($this->HuongDanThanhToan);
            $this->HuongDanThanhToan_en=stripslashes($this->HuongDanThanhToan_en);
            $this->ThongTinChuyenKhoan=stripslashes($this->ThongTinChuyenKhoan);
            $this->ThongTinChuyenKhoan_en=stripslashes($this->ThongTinChuyenKhoan_en);
        }
}
