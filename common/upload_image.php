<?php
/**
 * Created by PhpStorm.
 * User: vdbkpro
 * Date: 3/31/14
 * Time: 4:46 PM
 */
//nếu upload thành công trả về link ảnh, nếu upload thất bại trả về false
require_once 'locdautiengviet.php';
function upload($FileName)
{
    //$FileName = LocDauImg($file_name);
    $data=array();
    if(isset($_FILES[$FileName]))
    {
        if($_FILES[$FileName]['error']==0)
        {


            $newFileName = LocDauImg($_FILES[$FileName]["name"]);
            if (file_exists(DIR."/data/".$newFileName))
            {
                $auto_id=1;
                while(true)
                {
                    if(file_exists(DIR."/data/" .$auto_id.'_'.$newFileName))
                    {
                        $auto_id++;
                        continue;
                    }
                    else
                    {
                        $FinalName='/data/'.$auto_id.'_'.$newFileName;
                        $data[$FileName]=SITE_NAME.$FinalName;
                        move_uploaded_file($_FILES[$FileName]["tmp_name"],DIR.$FinalName);
                        break;
                    }
                }
            }
            else
            {
                $FinalName='/data/'.$newFileName;
                $data[$FileName]=SITE_NAME.$FinalName;
                move_uploaded_file($_FILES[$FileName]["tmp_name"],DIR.$FinalName);
            }
        }
        else
        {
            $data[$FileName]='';
        }
    }
    else
    {
        $data[$FileName]='';
    }
    return $data[$FileName];
}
//

