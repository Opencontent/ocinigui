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

$ViewList['tools'] = array(
    'functions' => array( 'dashboard' ),
    'script' => 'tools.php',
    'default_navigation_part' => 'ociniguinavigationpart',
    'params' => array( 'ToolID' ),
    'unordered_params' => array()
);

$ViewList['generalink'] = array(
    'functions' => array( 'generalink' ),
    'script' => 'generalink.php',
    'params' => array(),
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
$FunctionList['generalink'] = array();
//$FunctionList['edit'] = array();
?>
