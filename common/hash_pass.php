<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nguyenvietdinh
 * Date: 2/5/14
 * Time: 10:24 AM
 * To change this template use File | Settings | File Templates.
 */
function hash_pass($pass)
{
    return hash_hmac('sha512',$pass,PRIVATE_KEY);
}