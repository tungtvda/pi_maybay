<?php
class user
{
    public $Id,$Name,$QuyDanh,$MatKhau,$Phone,$Email,$Address,$TrangThai,$Created;
    public function user($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->QuyDanh=isset($data['QuyDanh'])?$data['QuyDanh']:'';
    $this->MatKhau=isset($data['MatKhau'])?$data['MatKhau']:'';
    $this->Phone=isset($data['Phone'])?$data['Phone']:'';
    $this->Email=isset($data['Email'])?$data['Email']:'';
    $this->Address=isset($data['Address'])?$data['Address']:'';
    $this->TrangThai=isset($data['TrangThai'])?$data['TrangThai']:'';
    $this->Created=isset($data['Created'])?$data['Created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->QuyDanh=addslashes($this->QuyDanh);
            $this->MatKhau=addslashes($this->MatKhau);
            $this->Phone=addslashes($this->Phone);
            $this->Email=addslashes($this->Email);
            $this->Address=addslashes($this->Address);
            $this->TrangThai=addslashes($this->TrangThai);
            $this->Created=addslashes($this->Created);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->QuyDanh=stripslashes($this->QuyDanh);
            $this->MatKhau=stripslashes($this->MatKhau);
            $this->Phone=stripslashes($this->Phone);
            $this->Email=stripslashes($this->Email);
            $this->Address=stripslashes($this->Address);
            $this->TrangThai=stripslashes($this->TrangThai);
            $this->Created=stripslashes($this->Created);
        }
}
