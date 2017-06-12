<?php
class gioithieu
{
    public $Id,$Name,$Img,$GioiThieu,$GioiThieu_en,$UuViet,$UuViet_en,$CacDichVu,$CacDicVu_en,$CamKet,$CamKet_en,$LienHe,$LienHe_en;
    public function gioithieu($data=array())
    {
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->Name=isset($data['Name'])?$data['Name']:'';
    $this->Img=isset($data['Img'])?$data['Img']:'';
    $this->GioiThieu=isset($data['GioiThieu'])?$data['GioiThieu']:'';
    $this->GioiThieu_en=isset($data['GioiThieu_en'])?$data['GioiThieu_en']:'';
    $this->UuViet=isset($data['UuViet'])?$data['UuViet']:'';
    $this->UuViet_en=isset($data['UuViet_en'])?$data['UuViet_en']:'';
    $this->CacDichVu=isset($data['CacDichVu'])?$data['CacDichVu']:'';
    $this->CacDicVu_en=isset($data['CacDicVu_en'])?$data['CacDicVu_en']:'';
    $this->CamKet=isset($data['CamKet'])?$data['CamKet']:'';
    $this->CamKet_en=isset($data['CamKet_en'])?$data['CamKet_en']:'';
    $this->LienHe=isset($data['LienHe'])?$data['LienHe']:'';
    $this->LienHe_en=isset($data['LienHe_en'])?$data['LienHe_en']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->Id=addslashes($this->Id);
            $this->Name=addslashes($this->Name);
            $this->Img=addslashes($this->Img);
            $this->GioiThieu=addslashes($this->GioiThieu);
            $this->GioiThieu_en=addslashes($this->GioiThieu_en);
            $this->UuViet=addslashes($this->UuViet);
            $this->UuViet_en=addslashes($this->UuViet_en);
            $this->CacDichVu=addslashes($this->CacDichVu);
            $this->CacDicVu_en=addslashes($this->CacDicVu_en);
            $this->CamKet=addslashes($this->CamKet);
            $this->CamKet_en=addslashes($this->CamKet_en);
            $this->LienHe=addslashes($this->LienHe);
            $this->LienHe_en=addslashes($this->LienHe_en);
        }
    public function decode()
        {
            $this->Id=stripslashes($this->Id);
            $this->Name=stripslashes($this->Name);
            $this->Img=stripslashes($this->Img);
            $this->GioiThieu=stripslashes($this->GioiThieu);
            $this->GioiThieu_en=stripslashes($this->GioiThieu_en);
            $this->UuViet=stripslashes($this->UuViet);
            $this->UuViet_en=stripslashes($this->UuViet_en);
            $this->CacDichVu=stripslashes($this->CacDichVu);
            $this->CacDicVu_en=stripslashes($this->CacDicVu_en);
            $this->CamKet=stripslashes($this->CamKet);
            $this->CamKet_en=stripslashes($this->CamKet_en);
            $this->LienHe=stripslashes($this->LienHe);
            $this->LienHe_en=stripslashes($this->LienHe_en);
        }
}
