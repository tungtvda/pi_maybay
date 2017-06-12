<?php
class admin_api
{
    public $Id,$Name,$Password,$Api;
    public function admin_api($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Password=isset($data['Password'])?$data['Password']:'';
    $this->Api=isset($data['Api'])?$data['Api']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->Password=addslashes($this->Password);
            $this->Api=addslashes($this->Api);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->Password=stripslashes($this->Password);
            $this->Api=stripslashes($this->Api);
        }
}
