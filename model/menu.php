<?php
class menu
{
    public $Id,$Name,$Name_en,$Title,$Title_en,$Keyword,$Description;
    public function menu($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Name_en=isset($data['Name_en'])?$data['Name_en']:'';
    $this->Title=isset($data['Title'])?$data['Title']:'';
    $this->Title_en=isset($data['Title_en'])?$data['Title_en']:'';
    $this->Keyword=isset($data['Keyword'])?$data['Keyword']:'';
    $this->Description=isset($data['Description'])?$data['Description']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->Name_en=addslashes($this->Name_en);
            $this->Title=addslashes($this->Title);
            $this->Title_en=addslashes($this->Title_en);
            $this->Keyword=addslashes($this->Keyword);
            $this->Description=addslashes($this->Description);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->Name_en=stripslashes($this->Name_en);
            $this->Title=stripslashes($this->Title);
            $this->Title_en=stripslashes($this->Title_en);
            $this->Keyword=stripslashes($this->Keyword);
            $this->Description=stripslashes($this->Description);
        }
}
