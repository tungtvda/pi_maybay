<?php
class dieukhoan_chinhsach
{
    public $Id,$Name,$DieuKhoan,$DieuKhoan_en,$ChinhSach,$ChinhSach_en;
    public function dieukhoan_chinhsach($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->DieuKhoan=isset($data['DieuKhoan'])?$data['DieuKhoan']:'';
    $this->DieuKhoan_en=isset($data['DieuKhoan_en'])?$data['DieuKhoan_en']:'';
    $this->ChinhSach=isset($data['ChinhSach'])?$data['ChinhSach']:'';
    $this->ChinhSach_en=isset($data['ChinhSach_en'])?$data['ChinhSach_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->DieuKhoan=addslashes($this->DieuKhoan);
            $this->DieuKhoan_en=addslashes($this->DieuKhoan_en);
            $this->ChinhSach=addslashes($this->ChinhSach);
            $this->ChinhSach_en=addslashes($this->ChinhSach_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->DieuKhoan=stripslashes($this->DieuKhoan);
            $this->DieuKhoan_en=stripslashes($this->DieuKhoan_en);
            $this->ChinhSach=stripslashes($this->ChinhSach);
            $this->ChinhSach_en=stripslashes($this->ChinhSach_en);
        }
}
