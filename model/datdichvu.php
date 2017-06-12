<?php
class datdichvu
{
    public $Id,$LoaiDichVu,$TrangThai,$Name,$Email,$Phone,$Address,$NoiDung,$Created;
    public function datdichvu($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->LoaiDichVu=isset($data['LoaiDichVu'])?$data['LoaiDichVu']:'';
    $this->TrangThai=isset($data['TrangThai'])?$data['TrangThai']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Email=isset($data['Email'])?$data['Email']:'';
    $this->Phone=isset($data['Phone'])?$data['Phone']:'';
    $this->Address=isset($data['Address'])?$data['Address']:'';
    $this->NoiDung=isset($data['NoiDung'])?$data['NoiDung']:'';
    $this->Created=isset($data['Created'])?$data['Created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->LoaiDichVu=addslashes($this->LoaiDichVu);
            $this->TrangThai=addslashes($this->TrangThai);
            $this->Name=addslashes($this->Name);
            $this->Email=addslashes($this->Email);
            $this->Phone=addslashes($this->Phone);
            $this->Address=addslashes($this->Address);
            $this->NoiDung=addslashes($this->NoiDung);
            $this->Created=addslashes($this->Created);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->LoaiDichVu=stripslashes($this->LoaiDichVu);
            $this->TrangThai=stripslashes($this->TrangThai);
            $this->Name=stripslashes($this->Name);
            $this->Email=stripslashes($this->Email);
            $this->Phone=stripslashes($this->Phone);
            $this->Address=stripslashes($this->Address);
            $this->NoiDung=stripslashes($this->NoiDung);
            $this->Created=stripslashes($this->Created);
        }
}
