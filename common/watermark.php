<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nguyenvietdinh
 * Date: 1/2/14
 * Time: 5:45 PM
 * To change this template use File | Settings | File Templates.
 */
function watermark($filename)
{
    $stamp = imagecreatefrompng(DIR.'/common/logo.png');
    $im = imagecreatefromjpeg($filename);
    $marge_right = 5;
    $marge_bottom = 5;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    imagejpeg($im,$filename);
    imagedestroy($stamp);
    imagedestroy($im);
}
//
function resize_image($filename)
{
    $width=500;
    $size=getimagesize($filename);
    $height=round($width*$size[1]/$size[0]);
    $images_orig = imagecreatefrompng($filename);
    $photoX = imagesx($images_orig);
    $photoY = imagesy($images_orig);
    $images_fin = imagecreatetruecolor($width, $height);
    imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
    imagejpeg($images_fin,$filename);
    imagedestroy($images_orig);
    imagedestroy($images_fin);

}