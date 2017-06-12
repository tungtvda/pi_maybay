<?php
class cauhoi
{
    public $Id,$Name,$Name_en,$NoiDung,$NoiDung_en;
    public function cauhoi($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Name_en=isset($data['Name_en'])?$data['Name_en']:'';
    $this->NoiDung=isset($data['NoiDung'])?$data['NoiDung']:'';
    $this->NoiDung_en=isset($data['NoiDung_en'])?$data['NoiDung_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->Name_en=addslashes($this->Name_en);
            $this->NoiDung=addslashes($this->NoiDung);
            $this->NoiDung_en=addslashes($this->NoiDung_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->Name_en=stripslashes($this->Name_en);
            $this->NoiDung=stripslashes($this->NoiDung);
            $this->NoiDung_en=stripslashes($this->NoiDung_en);
        }
}
