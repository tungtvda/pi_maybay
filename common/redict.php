<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nguyenvietdinh
 * Date: 9/9/13
 * Time: 7:03 AM
 * To change this template use File | Settings | File Templates.
 */
function redict($url)
{
    header('location: '.$url);
}
//
function redict_javascript($url)
{
    echo "<script>window.location='".$url."'</script>";
}