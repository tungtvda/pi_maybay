<?php
class lienhe
{
    public $Id,$QuyDanh,$Name,$Address,$Email,$Phone,$NoiDung,$Created;
    public function lienhe($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->QuyDanh=isset($data['QuyDanh'])?$data['QuyDanh']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Address=isset($data['Address'])?$data['Address']:'';
    $this->Email=isset($data['Email'])?$data['Email']:'';
    $this->Phone=isset($data['Phone'])?$data['Phone']:'';
    $this->NoiDung=isset($data['NoiDung'])?$data['NoiDung']:'';
    $this->Created=isset($data['Created'])?$data['Created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->QuyDanh=addslashes($this->QuyDanh);
            $this->Name=addslashes($this->Name);
            $this->Address=addslashes($this->Address);
            $this->Email=addslashes($this->Email);
            $this->Phone=addslashes($this->Phone);
            $this->NoiDung=addslashes($this->NoiDung);
            $this->Created=addslashes($this->Created);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->QuyDanh=stripslashes($this->QuyDanh);
            $this->Name=stripslashes($this->Name);
            $this->Address=stripslashes($this->Address);
            $this->Email=stripslashes($this->Email);
            $this->Phone=stripslashes($this->Phone);
            $this->NoiDung=stripslashes($this->NoiDung);
            $this->Created=stripslashes($this->Created);
        }
}
