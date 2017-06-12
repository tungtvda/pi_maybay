<?php
class admin
{
    public $Id,$TenDangNhap,$Full_name,$MatKhau;
    public function admin($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->TenDangNhap=isset($data['TenDangNhap'])?$data['TenDangNhap']:'';
    $this->Full_name=isset($data['Full_name'])?$data['Full_name']:'';
    $this->MatKhau=isset($data['MatKhau'])?$data['MatKhau']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->TenDangNhap=addslashes($this->TenDangNhap);
            $this->Full_name=addslashes($this->Full_name);
            $this->MatKhau=addslashes($this->MatKhau);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->TenDangNhap=stripslashes($this->TenDangNhap);
            $this->Full_name=stripslashes($this->Full_name);
            $this->MatKhau=stripslashes($this->MatKhau);
        }
}
