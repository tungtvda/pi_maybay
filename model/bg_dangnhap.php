<?php
class bg_dangnhap
{
    public $Id,$Img,$Img_en;
    public function bg_dangnhap($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->Img_en=isset($data['Img_en'])?$data['Img_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Img=addslashes($this->Img);
            $this->Img_en=addslashes($this->Img_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Img=stripslashes($this->Img);
            $this->Img_en=stripslashes($this->Img_en);
        }
}
