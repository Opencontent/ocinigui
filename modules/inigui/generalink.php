<?php
$module = $Params['Module'];
$tpl = eZTemplate::factory();
$http = eZHTTPTool::instance();

$links = array();
$generaUrl = '';
if( $http->hasPostVariable( 'url' ) )
{
    $generaUrl = '/' . ltrim( $http->postVariable( 'url' ), '/' );
}

$fileList = array();
eZDir::recursiveList( 'settings/siteaccess', 'settings/siteaccess', $fileList );
$siteaccess = array();
foreach( $fileList as $file )
{
    if ( $file['type'] == 'dir' && strpos( $file['name'], '_backend' ) !== false )
    {
        $siteaccess[] = $file['name'];
    }
}

foreach( $siteaccess as $sa )
{
    $siteini = new eZINI( 'site.ini.append.php', 'settings/siteaccess/' . $sa, null, false );    
    //$links[$sa] = rtrim( $siteini->variable( 'SiteSettings', 'SiteURL' ), '/' ) . $generaUrl;
    $links[$sa] = rtrim( str_replace( '_backend', '', $sa ), '/' ) . '.opencontent.it' . $generaUrl;
}

ksort( $links );

$tpl->setVariable( 'links', $links );
$tpl->setVariable( 'url', $generaUrl );
$Result = array();
$Result['content'] = $tpl->fetch( 'design:inigui/generalink.tpl' );
$Result['path'] = false;