<?php
require 'seguridad.php';
//require 'control.php';

session_unset(); 
// destroy the session 
session_destroy();

function salir(){
   session_unset(); 
   // destroy the session 
   session_destroy(); 
   header('Location: index.php');
}

salir();