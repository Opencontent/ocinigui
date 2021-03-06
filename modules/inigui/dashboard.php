<?php
$module = $Params['Module'];
$tpl = eZTemplate::factory();
$siteAccessList = eZINI::instance()->variable( 'SiteAccessSettings', 'RelatedSiteAccessList' );
$selectedBlock = $Params['Block'] ? $Params['Block'] : false;

$settingFile = $Params['INIFile'] ? $Params['INIFile'] : 'openpa.ini';
$currentSiteAccess = $Params['SiteAccess'] ? $Params['SiteAccess'] : str_replace('_backend', '_frontend', $GLOBALS['eZCurrentAccess']['name'] );

if ( !in_array( $settingFile, eZINI::instance( 'inigui.ini' )->variable( 'Settings', 'AvailableIni' ) ) )
{
    return $Module->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$iniTool = new OCIniGuiTools( $settingFile, $currentSiteAccess, $selectedBlock );
$iniTool->load();

$tpl->setVariable( 'settings', $iniTool->settings );
$tpl->setVariable( 'block_count', $iniTool->blockCount );
$tpl->setVariable( 'setting_count', $iniTool->totalSettingCount );
$tpl->setVariable( 'ini_file', $iniTool->settingFile );
$tpl->setVariable( 'current_siteaccess', $iniTool->currentSiteAccess );
$tpl->setVariable( 'siteaccess_list', $siteAccessList );

$tpl->setVariable( 'selected_block', $iniTool->selectedBlock );
$tpl->setVariable( 'blocks', $iniTool->blocks );

$path = array();
$path[] =  array( 'text' => $iniTool->currentSiteAccess . ' INI',  'url' => 'inigui/dashboard/' . $iniTool->currentSiteAccess );

if ( $selectedBlock )
{
	$pageTitle = $iniTool->settingFile . ' ' . $selectedBlock;
	$path[] = array( 'text' => $selectedBlock,  'url' => false );
}
else 
{
	$pageTitle = $iniTool->currentSiteAccess . ' ' . $iniTool->settingFile;
}
$tpl->setVariable( 'page_title', $pageTitle );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:inigui/dashboard.tpl' );
$Result['path'] = $path;
?>