<div class="context-block overview-dashboard">
	<div class="box-header">
		<h1 class="context-title">{$page_title}</h1>
		<div class="header-mainline"></div>
	</div>

	<div class="box-content">
	
	<table class="list" width="100%" cellspacing="0" cellpadding="0" border="0">
	{section var=Blocks loop=$settings}
        <tr>
            <th width="50%">
	            {$Blocks.key} ({$Blocks.item.count})
	            </th>
	        <th class="tight">
	            {'Placement'|i18n( 'design/admin/settings' )}
	        </th>
	            <th width="50%">
	                {'Value'|i18n( 'design/admin/settings' )}
	            </th>
	    </tr>
	    {section var=Settings loop=$Blocks.item.content sequence=array( 'bgdark', 'bglight' )}
	        <tr valign="top" class="{$Settings.sequence}">
	            <td width="50%">
	                {$Settings.key|wash}
	            </td>
	            <td width="1">
	            {section show=eq( $Settings.item.placement, '' )}
	                {section var=Placements loop=$Settings.item.content}
	                    {$Placements.item.placement}<br/>
	                {/section}
	            {section-else}
	                {$Settings.item.placement}
	            {/section}
	            </td>
	            <td width="50%">
	                {switch match=$Settings.item.type}
	                {case match='array'}
	                    {section show=ne($Settings.item.placement,'undefined')}
	                    {section var=Placements loop=$Settings.item.content}
	                        <div class="array">[{$Placements.key}] {$Placements.item.content|wash}</div>
	                    {/section}
	                    {/section}
	                {/case}
	
	                {case in=array( 'enable/disable', 'true/false' )}
	                    {if or( eq( $Settings.item.content, 'true' ), eq( $Settings.item.content, 'enabled' ) )}
	                        <div class="enabled">{$Settings.item.content}</div>
	                    {else}
	                        <div class="disabled">{$Settings.item.content}</div>
	                    {/if}
	                {/case}
	                {case match='string'}
	                    <div class="string">"{$Settings.item.content|wash}"</div>
	                {/case}
	                {case match='numeric'}
	                    <div class="numeric">{$Settings.item.content|wash}</div>
	                {/case}
	                {case}
	                    <div class="{$Settings.item.type}">{$Settings.item.content|wash}</div>
	                {/case}
	                {/switch}
	            </td>
	        </tr>
	    {/section}
	{/section}
	</table>
	
	</div>
</div>