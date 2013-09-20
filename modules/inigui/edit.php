<?php

$tpl = eZTemplate::factory();

$selectedBlock = $Params['Block'] ? $Params['Block'] : false;

$settingFile = 'openpa.ini';
$currentSiteAccess = 'ezflow_site';

$iniTool = new OCIniGuiTools( $settingFile, $currentSiteAccess, $selectedBlock );
$iniTool->load();

$tpl->setVariable( 'settings', $iniTool->settings );
$tpl->setVariable( 'block_count', $iniTool->blockCount );
$tpl->setVariable( 'setting_count', $iniTool->totalSettingCount );
$tpl->setVariable( 'ini_file', $iniTool->settingFile );
$tpl->setVariable( 'current_siteaccess', $iniTool->currentSiteAccess );

$tpl->setVariable( 'selected_block', $iniTool->selectedBlock );
$tpl->setVariable( 'blocks', $iniTool->blocks );

$path = array();
$path[] =  array( 'text' => 'INI Gui Dashboard',  'url' => 'inigui/dashboard' );

if ( $selectedBlock )
{
	$pageTitle = $iniTool->settingFile . '/' . $selectedBlock  . ' Gui Dashboard';
	$path[] = array( 'text' => $selectedBlock,  'url' => false );
}
else 
{
	$pageTitle = $iniTool->settingFile . ' Gui Dashboard';
}
$tpl->setVariable( 'page_title', $pageTitle );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:inigui/dashboard.tpl' );
$Result['path'] = $path;

?>