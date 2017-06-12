<?php
class sao
{
    public $Id,$Name;
    public function sao($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
        }
}
