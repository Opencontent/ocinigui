<?php
$module = $Params['Module'];
$tpl = eZTemplate::factory();
$http = eZHTTPTool::instance();

if ( !file_exists( eZINI::instance()->variable( 'FileSettings','VarDir' ) . '/import_log' ) )
{
    return $module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$tempLogs = ezcBaseFile::findRecursive(
        eZINI::instance()->variable( 'FileSettings','VarDir' ) . '/import_log',
        array('@.*.[log|log\.<digit>\d+|mail|csv]$@')
);

$logs = array();

foreach( $tempLogs as $tempLog )
{
    $tempLog = str_replace( eZINI::instance()->variable( 'FileSettings','VarDir' ) . '/import_log/', '', $tempLog );
    $tempLogParts = explode( '_', $tempLog );
    $date = str_replace( '.csv', '', $tempLogParts[1] );
    list( $d, $m, $y ) = explode( '-', $date );
    $logs[$tempLogParts[0]][] = mktime( 0, 0, 0, $m, $d, $y );
    sort( $logs[$tempLogParts[0]] );
}

$log = false;
$logData = false;

if ( $Params['Log'] )
{    
    $tempLog = explode( '-', $Params['Log'] );    
    $date = date( 'j-m-Y', $tempLog[1] );
    if ( in_array( $tempLog[1], $logs[$tempLog[0]] ) )
    {
        $log  = eZINI::instance()->variable( 'FileSettings','VarDir' ) . '/import_log/' . $tempLog[0] . '_' . $date . '.csv';
        $f = fopen( $log, "r");
        if ( $f )
        {
            $logData = "<table class=\"list\">\n\n";
            $count = 0;
            while ( ($line = fgetcsv($f)) !== false ) {
                $logData .= "<tr>";
                foreach ($line as $cell) {
                    if ( $count == 0 )
                        $logData .= "<th>" . htmlspecialchars($cell) . "</th>";
                    else
                        $logData .= "<td>" . htmlspecialchars($cell) . "</td>";
                }
                $logData .= "<tr>\n";
                $count++;
            }
            fclose($f);
            $logData .= "\n</table>";
        }
    }
}


$tpl->setVariable( 'log', $log );
$tpl->setVariable( 'data', $logData );
$tpl->setVariable( 'logs', $logs );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:inigui/viewlog.tpl' );
$Result['path'] = array( array( 'text' => 'Logs list',
                                'url' => $log ? 'inigui/viewlog' : false ) );