<?php
class dangky
{
    public $Id,$Email,$Created;
    public function dangky($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Email=isset($data['Email'])?$data['Email']:'';
    $this->Created=isset($data['Created'])?$data['Created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Email=addslashes($this->Email);
            $this->Created=addslashes($this->Created);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Email=stripslashes($this->Email);
            $this->Created=stripslashes($this->Created);
        }
}
