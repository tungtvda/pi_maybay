<?php
class mangxahoi
{
    public $Id,$Face,$Feed,$Twitter,$Google,$Youtube;
    public function mangxahoi($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Face=isset($data['Face'])?$data['Face']:'';
    $this->Feed=isset($data['Feed'])?$data['Feed']:'';
    $this->Twitter=isset($data['Twitter'])?$data['Twitter']:'';
    $this->Google=isset($data['Google'])?$data['Google']:'';
    $this->Youtube=isset($data['Youtube'])?$data['Youtube']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Face=addslashes($this->Face);
            $this->Feed=addslashes($this->Feed);
            $this->Twitter=addslashes($this->Twitter);
            $this->Google=addslashes($this->Google);
            $this->Youtube=addslashes($this->Youtube);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Face=stripslashes($this->Face);
            $this->Feed=stripslashes($this->Feed);
            $this->Twitter=stripslashes($this->Twitter);
            $this->Google=stripslashes($this->Google);
            $this->Youtube=stripslashes($this->Youtube);
        }
}
