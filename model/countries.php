<?php
class countries
{
    public $id,$sortname,$name;
    public function countries($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->sortname=isset($data['sortname'])?$data['sortname']:'';
    $this->name=isset($data['name'])?$data['name']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->sortname=addslashes($this->sortname);
            $this->name=addslashes($this->name);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->sortname=stripslashes($this->sortname);
            $this->name=stripslashes($this->name);
        }
}
