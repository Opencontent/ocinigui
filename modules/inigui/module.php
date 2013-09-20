<?php

$Module = array( 'name' => 'INI Gui',
                 'variable_params' => true );

$ViewList = array();

$ViewList['dashboard'] = array(
    'functions' => array( 'dashboard' ),
    'script' => 'dashboard.php',
    'default_navigation_part' => 'ociniguinavigationpart',
    'params' => array( 'SiteAccess', 'INIFile', 'Block', 'Setting', 'Placement' ),
    'unordered_params' => array()
);

/*
$ViewList['edit'] = array(
    'functions' => array( 'edit' ),
    'script' => 'edit.php',
    'default_navigation_part' => 'ociniguinavigationpart',
    'params' => array( 'SiteAccess', 'INIFile', 'Block', 'Setting', 'Placement' ),
    'unordered_params' => array()
);
*/

$FunctionList = array();
$FunctionList['dashboard'] = array();
//$FunctionList['edit'] = array();
?>
