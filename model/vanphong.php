<?php
class vanphong
{
    public $Id,$Address,$Address_en,$Phone,$BanDo;
    public function vanphong($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Address=isset($data['Address'])?$data['Address']:'';
    $this->Address_en=isset($data['Address_en'])?$data['Address_en']:'';
    $this->Phone=isset($data['Phone'])?$data['Phone']:'';
    $this->BanDo=isset($data['BanDo'])?$data['BanDo']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Address=addslashes($this->Address);
            $this->Address_en=addslashes($this->Address_en);
            $this->Phone=addslashes($this->Phone);
            $this->BanDo=addslashes($this->BanDo);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Address=stripslashes($this->Address);
            $this->Address_en=stripslashes($this->Address_en);
            $this->Phone=stripslashes($this->Phone);
            $this->BanDo=stripslashes($this->BanDo);
        }
}
