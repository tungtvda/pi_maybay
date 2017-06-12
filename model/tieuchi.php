<?php
class tieuchi
{
    public $Id,$Name,$Name_en,$Img,$MoTaNgan,$MoTaNgan_en;
    public function tieuchi($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Name_en=isset($data['Name_en'])?$data['Name_en']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->MoTaNgan=isset($data['MoTaNgan'])?$data['MoTaNgan']:'';
    $this->MoTaNgan_en=isset($data['MoTaNgan_en'])?$data['MoTaNgan_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->Name_en=addslashes($this->Name_en);
            $this->Img=addslashes($this->Img);
            $this->MoTaNgan=addslashes($this->MoTaNgan);
            $this->MoTaNgan_en=addslashes($this->MoTaNgan_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->Name_en=stripslashes($this->Name_en);
            $this->Img=stripslashes($this->Img);
            $this->MoTaNgan=stripslashes($this->MoTaNgan);
            $this->MoTaNgan_en=stripslashes($this->MoTaNgan_en);
        }
}
