<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 12/09/2019
 * Time: 13:06
 */

include_once 'includes/connextionBD.php';
// instantiate product object
include_once 'api/objects/Deputie.php';

$db = connextionBD::getInstance();
$dep = new Deputie($db);

