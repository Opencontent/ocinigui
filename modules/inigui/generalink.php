<?php
$module = $Params['Module'];
$tpl = eZTemplate::factory();
$http = eZHTTPTool::instance();

$links = array();
$generaUrl = '';
if( $http->hasPostVariable( 'url' ) )
{
    $generaUrl = $http->postVariable( 'url' );
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
    $links[$sa] = rtrim( $siteini->variable( 'SiteSettings', 'SiteURL' ), '/' ) . $generaUrl;
}

ksort( $links );

$tpl->setVariable( 'links', $links );
$tpl->setVariable( 'url', $generaUrl );
$Result = array();
$Result['content'] = $tpl->fetch( 'design:inigui/generalink.tpl' );
$Result['path'] = false;