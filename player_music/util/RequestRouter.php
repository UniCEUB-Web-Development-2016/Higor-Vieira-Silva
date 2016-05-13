<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 10/05/2016
 * Time: 18:53
 */

include "control/ControlManager.php";
class RequestRouter
{

    public function route()
    {
        return (new ControlManager)->getResource();
    }
}