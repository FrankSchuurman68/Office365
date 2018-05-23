<?php

require_once(__DIR__ .'/incl/config.php');  

if(!$mimksite->CheckLogin())
{
    $mimksite->RedirectToURL("index.php");
    exit;
}

$mimksite->Export();

?>