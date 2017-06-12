<?php
class dichvu_sub
{
    public $Id,$DanhMucId,$BanChay,$NoiBat,$Name,$Name_en,$Img,$HangSao,$Address,$Address_en,$GiaCu,$GiaCu_en,$GiaMoi,$GiaMoi_en;
    public function dichvu_sub($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->DanhMucId=isset($data['DanhMucId'])?$data['DanhMucId']:'';
    $this->BanChay=isset($data['BanChay'])?$data['BanChay']:'';
    $this->NoiBat=isset($data['NoiBat'])?$data['NoiBat']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Name_en=isset($data['Name_en'])?$data['Name_en']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->HangSao=isset($data['HangSao'])?$data['HangSao']:'';
    $this->Address=isset($data['Address'])?$data['Address']:'';
    $this->Address_en=isset($data['Address_en'])?$data['Address_en']:'';
    $this->GiaCu=isset($data['GiaCu'])?$data['GiaCu']:'';
    $this->GiaCu_en=isset($data['GiaCu_en'])?$data['GiaCu_en']:'';
    $this->GiaMoi=isset($data['GiaMoi'])?$data['GiaMoi']:'';
    $this->GiaMoi_en=isset($data['GiaMoi_en'])?$data['GiaMoi_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->DanhMucId=addslashes($this->DanhMucId);
            $this->BanChay=addslashes($this->BanChay);
            $this->NoiBat=addslashes($this->NoiBat);
            $this->Name=addslashes($this->Name);
            $this->Name_en=addslashes($this->Name_en);
            $this->Img=addslashes($this->Img);
            $this->HangSao=addslashes($this->HangSao);
            $this->Address=addslashes($this->Address);
            $this->Address_en=addslashes($this->Address_en);
            $this->GiaCu=addslashes($this->GiaCu);
            $this->GiaCu_en=addslashes($this->GiaCu_en);
            $this->GiaMoi=addslashes($this->GiaMoi);
            $this->GiaMoi_en=addslashes($this->GiaMoi_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->DanhMucId=stripslashes($this->DanhMucId);
            $this->BanChay=stripslashes($this->BanChay);
            $this->NoiBat=stripslashes($this->NoiBat);
            $this->Name=stripslashes($this->Name);
            $this->Name_en=stripslashes($this->Name_en);
            $this->Img=stripslashes($this->Img);
            $this->HangSao=stripslashes($this->HangSao);
            $this->Address=stripslashes($this->Address);
            $this->Address_en=stripslashes($this->Address_en);
            $this->GiaCu=stripslashes($this->GiaCu);
            $this->GiaCu_en=stripslashes($this->GiaCu_en);
            $this->GiaMoi=stripslashes($this->GiaMoi);
            $this->GiaMoi_en=stripslashes($this->GiaMoi_en);
        }
}
