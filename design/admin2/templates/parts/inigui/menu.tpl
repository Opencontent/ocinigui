{if and(is_set($module_result.ui_context), $module_result.ui_context|eq('navigation'))}
<div id="content-tree">
<div class="box-header"><div class="box-ml">

</div></div>

<div class="box-bc"><div class="box-ml"><div class="box-content">

<div id="contentstructure">
{if ezini_hasvariable( 'Settings', 'Tools', 'inigui.ini' )}
    {def $tools = ezini( 'Settings', 'Tools', 'inigui.ini' )}
    {if count( $tools )|gt(0)}
    <h4>Tools</h4>
    <ul>
    {foreach $tools as $tool}
        <li>
        {if ezini_hasvariable( $tool, 'Url', 'inigui.ini' )}
            <a href={ezini( $tool, 'Url', 'inigui.ini' )}>
                {ezini( $tool, 'Name', 'inigui.ini' )}
            </a>
        {else}
            <a href={concat('inigui/tools/', $tool)|ezurl()}>
                {ezini( $tool, 'Name', 'inigui.ini' )}
            </a>
        {/if}
        </li>
    {/foreach}
    </ul>
    {/if}
{/if}

{if and( is_set( $current_siteaccess ), is_set( $ini_file ) )}
<h4>INI File</h4>
{def $available_ini = ezini( 'Settings', 'AvailableIni', 'inigui.ini' )}

<ul>
{foreach $available_ini as $ini}
    <li>
        <a href={concat('inigui/dashboard/',$current_siteaccess, '/', $ini)|ezurl()}>
        {if eq( $ini_file, $ini )}
            <strong>{$ini|wash()}</strong>
        {else}
            {$ini|wash()}
        {/if}
        </a>
    </li>
{/foreach}
</ul>
    
<h4>SiteAccess</h4>
	<ul>
        {foreach $siteaccess_list as $siteaccess}
        <li>
        	<a href={concat('inigui/dashboard/',$siteaccess, '/', $ini_file)|ezurl()}>
        	{if eq( $current_siteaccess, $siteaccess )}
        		<strong>{$siteaccess|wash()}</strong>
        	{else}
        		{$siteaccess|wash()}
        	{/if}
        	</a>
        </li>
        {/foreach}
    </ul>
<h4>{$ini_file} Blocks</h4>
	<ul>
        {foreach $blocks as $block => $key}
        <li>
        	<a href={concat('inigui/dashboard/',$current_siteaccess,'/',$ini_file,'/',$block)|ezurl()}>
        	{if eq( $selected_block, $block )}
        		<strong>{$block|wash()}</strong>
        	{else}
        		{$block|wash()}
        	{/if}
        	</a>
        </li>
        {/foreach}
    </ul>
{/if}    
</div>

</div></div></div>
</div>

<div id="widthcontrol-links" class="widthcontrol">
<p>
{switch match=ezpreference( 'admin_left_menu_size' )}
    {case match='medium'}
    <a href={'/user/preferences/set/admin_left_menu_size/small'|ezurl} title="{'Change the left menu width to small size.'|i18n( 'design/admin/parts/user/menu' )}">{'Small'|i18n( 'design/admin/parts/user/menu' )}</a>
    <span class="current">{'Medium'|i18n( 'design/admin/parts/user/menu' )}</span>
    <a href={'/user/preferences/set/admin_left_menu_size/large'|ezurl} title="{'Change the left menu width to large size.'|i18n( 'design/admin/parts/user/menu' )}">{'Large'|i18n( 'design/admin/parts/user/menu' )}</a>
    {/case}

    {case match='large'}
    <a href={'/user/preferences/set/admin_left_menu_size/small'|ezurl} title="{'Change the left menu width to small size.'|i18n( 'design/admin/parts/user/menu' )}">{'Small'|i18n( 'design/admin/parts/user/menu' )}</a>
    <a href={'/user/preferences/set/admin_left_menu_size/medium'|ezurl} title="{'Change the left menu width to medium size.'|i18n( 'design/admin/parts/user/menu' )}">{'Medium'|i18n( 'design/admin/parts/user/menu' )}</a>
    <span class="current">{'Large'|i18n( 'design/admin/parts/user/menu' )}</span>
    {/case}

    {case in=array( 'small', '' )}
    <span class="current">{'Small'|i18n( 'design/admin/parts/user/menu' )}</span>
    <a href={'/user/preferences/set/admin_left_menu_size/medium'|ezurl} title="{'Change the left menu width to medium size.'|i18n( 'design/admin/parts/user/menu' )}">{'Medium'|i18n( 'design/admin/parts/user/menu' )}</a>
    <a href={'/user/preferences/set/admin_left_menu_size/large'|ezurl} title="{'Change the left menu width to large size.'|i18n( 'design/admin/parts/user/menu' )}">{'Large'|i18n( 'design/admin/parts/user/menu' )}</a>
    {/case}

    {case}
    <a href={'/user/preferences/set/admin_left_menu_size/small'|ezurl} title="{'Change the left menu width to small size.'|i18n( 'design/admin/parts/user/menu' )}">{'Small'|i18n( 'design/admin/parts/user/menu' )}</a>
    <a href={'/user/preferences/set/admin_left_menu_size/medium'|ezurl} title="{'Change the left menu width to medium size.'|i18n( 'design/admin/parts/user/menu' )}">{'Medium'|i18n( 'design/admin/parts/user/menu' )}</a>
    <a href={'/user/preferences/set/admin_left_menu_size/large'|ezurl} title="{'Change the left menu width to large size.'|i18n( 'design/admin/parts/user/menu' )}">{'Large'|i18n( 'design/admin/parts/user/menu' )}</a>
    {/case}
{/switch}
</p>
</div>

{* This is the border placed to the left for draging width, js will handle disabling the one above and enabling this *}
<div id="widthcontrol-handler" class="hide">
<div class="widthcontrol-grippy"></div>
</div>

<!-- script type="text/javascript" src={"javascript/leftmenu_widthcontrol.js"|ezdesign} charset="utf-8"></script -->
{/if}
