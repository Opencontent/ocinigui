<?php
$module = $Params['Module'];
$ToolID = $Params['ToolID'] ? $Params['ToolID'] : false;
if( !$ToolID || !eZINI::instance( 'inigui.ini' )->hasVariable( $ToolID, 'PHPClass', 'inigui.ini' ) )
{
    return $Module->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$class = eZINI::instance( 'inigui.ini' )->variable( $ToolID, 'PHPClass', 'inigui.ini' );

if ( class_exists( $class ) )
{
    $object = new $class();    
    $object->run();
    if ( $object->useTemplate() !== false )
    {
        $Result = $object->template();
        return;
    }
    else
    {
        eZExecution::cleanExit();
    }
}
else
{
    return $Module->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}