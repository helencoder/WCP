<?php
/**
 * Author: helen
 * CreateTime: 2016/4/15 11:44
 * description: xdebugตฤสนำร
 */
testXdebug();
debug_backtrace();
function testXdebug()
{
    requireFile();
}

function requireFile()
{
    require_once('abc.php');
}