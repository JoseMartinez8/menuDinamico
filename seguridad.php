<?php
session_start();
/**
 * Si el usuario a sido autenticado lo deja en la app de lo contrario cerrara 
 * la sesion y mandara al index.php
 */

if($_SESSION['auntenticado'] != "SI"){
    // remove all session variables
    header("Location: index.php");
    session_unset(); 
    // destroy the session 
    session_destroy();
}


