<?php

require_once '../../config.php';
require_once '../../common/redict.php';

    if(isset($_SESSION['user_id']))
    {
       unset($_SESSION['user_id']);

        redict(SITE_NAME);
    }




?>