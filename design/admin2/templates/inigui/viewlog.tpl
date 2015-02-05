{if $log}
<h1>{$log}</h1>
{$data}
{else}
<h1>Importazioni</h1>
<ul>
    {foreach $logs.import as $log}
    <li><a href="{concat('inigui/viewlog/import-',$log)|ezurl(no)}">{$log|datetime( 'custom', '%j %m %y' )}</a></li>
    {/foreach}
</ul>
<h1>Errori</h1>
<ul>
    {foreach $logs.error as $log}
    <li><a href="{concat('inigui/viewlog/error-',$log)|ezurl(no)}">{$log|datetime( 'custom', '%j %m %y' )}</a></li>
    {/foreach}
</ul>
<h1>Cancellazioni</h1>
<ul>
    {foreach $logs.delete as $log}
    <li><a href="{concat('inigui/viewlog/delete-',$log)|ezurl(no)}">{$log|datetime( 'custom', '%j %m %y' )}</a></li>
    {/foreach}
</ul>
{/if}