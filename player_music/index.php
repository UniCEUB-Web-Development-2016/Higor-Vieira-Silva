<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 10/05/2016
 * Time: 18:34
 */

include "util/RequestRouter.php";


echo json_encode((new RequestRouter)->route());