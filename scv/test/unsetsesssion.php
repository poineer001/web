<?php
session_start();
$_SESSION['opcode'] = 42;
$_SESSION = array();

if (isset($_SESSION['opcode']))
{

}