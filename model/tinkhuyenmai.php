<?php
class tinkhuyenmai
{
    public $Id,$NoiBat,$Name,$Name_en,$Img,$NoiDung,$NoiDung_en,$Title,$Title_en,$Keyword,$Description,$Created;
    public function tinkhuyenmai($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->NoiBat=isset($data['NoiBat'])?$data['NoiBat']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Name_en=isset($data['Name_en'])?$data['Name_en']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->NoiDung=isset($data['NoiDung'])?$data['NoiDung']:'';
    $this->NoiDung_en=isset($data['NoiDung_en'])?$data['NoiDung_en']:'';
    $this->Title=isset($data['Title'])?$data['Title']:'';
    $this->Title_en=isset($data['Title_en'])?$data['Title_en']:'';
    $this->Keyword=isset($data['Keyword'])?$data['Keyword']:'';
    $this->Description=isset($data['Description'])?$data['Description']:'';
    $this->Created=isset($data['Created'])?$data['Created']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->NoiBat=addslashes($this->NoiBat);
            $this->Name=addslashes($this->Name);
            $this->Name_en=addslashes($this->Name_en);
            $this->Img=addslashes($this->Img);
            $this->NoiDung=addslashes($this->NoiDung);
            $this->NoiDung_en=addslashes($this->NoiDung_en);
            $this->Title=addslashes($this->Title);
            $this->Title_en=addslashes($this->Title_en);
            $this->Keyword=addslashes($this->Keyword);
            $this->Description=addslashes($this->Description);
            $this->Created=addslashes($this->Created);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->NoiBat=stripslashes($this->NoiBat);
            $this->Name=stripslashes($this->Name);
            $this->Name_en=stripslashes($this->Name_en);
            $this->Img=stripslashes($this->Img);
            $this->NoiDung=stripslashes($this->NoiDung);
            $this->NoiDung_en=stripslashes($this->NoiDung_en);
            $this->Title=stripslashes($this->Title);
            $this->Title_en=stripslashes($this->Title_en);
            $this->Keyword=stripslashes($this->Keyword);
            $this->Description=stripslashes($this->Description);
            $this->Created=stripslashes($this->Created);
        }
}
