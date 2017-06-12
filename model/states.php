<?php
class states
{
    public $id,$name,$country_id;
    public function states($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->country_id=isset($data['country_id'])?$data['country_id']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->name=addslashes($this->name);
            $this->country_id=addslashes($this->country_id);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->name=stripslashes($this->name);
            $this->country_id=stripslashes($this->country_id);
        }
}
