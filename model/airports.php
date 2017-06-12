<?php
class airports
{
    public $code,$Id,$name,$cityCode,$cityName,$countryName,$countryCode,$timezone,$lat,$lon,$numAirports,$city;
    public function airports($data=array())
    {
    $this->code=isset($data['code'])?$data['code']:'';
    $this->Id=isset($data['Id'])?$data['Id']:'';
    $this->name=isset($data['name'])?$data['name']:'';
    $this->cityCode=isset($data['cityCode'])?$data['cityCode']:'';
    $this->cityName=isset($data['cityName'])?$data['cityName']:'';
    $this->countryName=isset($data['countryName'])?$data['countryName']:'';
    $this->countryCode=isset($data['countryCode'])?$data['countryCode']:'';
    $this->timezone=isset($data['timezone'])?$data['timezone']:'';
    $this->lat=isset($data['lat'])?$data['lat']:'';
    $this->lon=isset($data['lon'])?$data['lon']:'';
    $this->numAirports=isset($data['numAirports'])?$data['numAirports']:'';
    $this->city=isset($data['city'])?$data['city']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->code=addslashes($this->code);
            $this->Id=addslashes($this->Id);
            $this->name=addslashes($this->name);
            $this->cityCode=addslashes($this->cityCode);
            $this->cityName=addslashes($this->cityName);
            $this->countryName=addslashes($this->countryName);
            $this->countryCode=addslashes($this->countryCode);
            $this->timezone=addslashes($this->timezone);
            $this->lat=addslashes($this->lat);
            $this->lon=addslashes($this->lon);
            $this->numAirports=addslashes($this->numAirports);
            $this->city=addslashes($this->city);
        }
    public function decode()
        {
            $this->code=stripslashes($this->code);
            $this->Id=stripslashes($this->Id);
            $this->name=stripslashes($this->name);
            $this->cityCode=stripslashes($this->cityCode);
            $this->cityName=stripslashes($this->cityName);
            $this->countryName=stripslashes($this->countryName);
            $this->countryCode=stripslashes($this->countryCode);
            $this->timezone=stripslashes($this->timezone);
            $this->lat=stripslashes($this->lat);
            $this->lon=stripslashes($this->lon);
            $this->numAirports=stripslashes($this->numAirports);
            $this->city=stripslashes($this->city);
        }
}
