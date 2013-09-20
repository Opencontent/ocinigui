<?php

class OCIniGuiTools
{
    public $settingFile, $currentSiteAccess, $selectedBlock;
    public $settings, $blocks, $totalSettingCount, $blockCount;
	
	function __construct( $settingFile, $currentSiteAccess, $selectedBlock )
    {
        $this->settingFile = $settingFile;
        $this->currentSiteAccess = $currentSiteAccess;
        $this->selectedBlock = $selectedBlock;
    }
    
    public function load()
    {
    	if ( $GLOBALS['eZCurrentAccess']['name'] !== $this->currentSiteAccess )
		{
		    // create a site ini instance using $useLocalOverrides
		    $siteIni = eZSiteAccess::getIni( $this->currentSiteAccess, 'site.ini' );
		
		    // load settings file with $useLocalOverrides = true & $addArrayDefinition = true
		    $ini = new eZINI( /*$fileName =*/ $this->settingFile,
		                      /*$rootDir =*/ 'settings',
		                      /*$useTextCodec =*/ null,
		                      /*$useCache =*/ false,
		                      /*$useLocalOverrides =*/ true,
		                      /*$directAccess =*/ false,
		                      /*$addArrayDefinition =*/ true,
		                      /*$load =*/ false );
		    $ini->setOverrideDirs( $siteIni->overrideDirs( false ) );
		    $ini->load();
		}
		else
		{
		    // load settings file more or less normally but with $addArrayDefinition = true
		    $ini = new eZINI( $this->settingFile,'settings', null, false, null, false, true );
		}
		
		$this->blocks = $ini->groups();
		$placements = $ini->groupPlacements();
		$this->settings = array();
		$this->blockCount = 0;
		$this->totalSettingCount = 0;
		
		foreach( $this->blocks as $block => $key )
		{
			$this->settingsCount = 0;
		    $blockRemoveable = false;
		    $blockEditable = true;
		    foreach( $key as $setting => $settingKey )
		    {
		        if ( strpos( $setting, '--') !== 0 ) // nascondo i metadati
		        {
			    	$hasSetPlacement = false;
			        $type = $ini->settingType( $settingKey );
			        $customType = $this->customSettingType( $block, $setting );
			        $removeable = false;
			
			        switch ( $type )
			        {
			            case 'array':
			                if ( count( $settingKey ) == 0 )
			                    $this->settings[$block]['content'][$setting]['content'] = array();
			
			                foreach( $settingKey as $settingElementKey => $settingElementValue )
			                {
			                    $settingPlacement = $ini->findSettingPlacement( $placements[$block][$setting][$settingElementKey] );
			                    if ( $settingElementValue != null )
			                    {
			                        // Make a space after the ';' to make it possible for
			                        // the browser to break long lines
			                        $this->settings[$block]['content'][$setting]['content'][$settingElementKey]['content'] = str_replace( ';', "; ", $settingElementValue );
			                    }
			                    else
			                    {
			                        $this->settings[$block]['content'][$setting]['content'][$settingElementKey]['content'] = "";
			                    }
			                    $this->settings[$block]['content'][$setting]['content'][$settingElementKey]['placement'] = $settingPlacement;
			                    $hasSetPlacement = true;
			                    if ( $settingPlacement != 'default' )
			                    {
			                        $removeable = true;
			                        $blockRemoveable = true;
			                    }
			                }
			                break;
			            case 'string':
			                if( strpos( $settingKey, ';' ) )
			                {
			                    // Make a space after the ';' to make it possible for
			                    // the browser to break long lines
			                    $settingArray = str_replace( ';', "; ", $settingKey );
			                    $this->settings[$block]['content'][$setting]['content'] = $settingArray;
			                }
			                else
			                {
			                    $this->settings[$block]['content'][$setting]['content'] = $settingKey;
			                }
			                break;
			            default:
			                $this->settings[$block]['content'][$setting]['content'] = $settingKey;
			        }
			        $this->settings[$block]['content'][$setting]['type'] = $type;
			        $this->settings[$block]['content'][$setting]['customtype'] = $customType;
			        $this->settings[$block]['content'][$setting]['placement'] = "";
			
			        if ( !$hasSetPlacement )
			        {
			            $placement = $ini->findSettingPlacement( $placements[$block][$setting] );
			            $this->settings[$block]['content'][$setting]['placement'] = $placement;
			            if ( $placement != 'default' )
			            {
			                $removeable = true;
			                $blockRemoveable = true;
			            }
			        }
			        $editable = $ini->isSettingReadOnly( $this->settingFile, $block, $setting );
			        $removeable = $editable === false ? false : $removeable;
			        $this->settings[$block]['content'][$setting]['editable'] = $editable;
			        $this->settings[$block]['content'][$setting]['removeable'] = $removeable;
			        ++$this->settingsCount;
			    }
			    $blockEditable = $ini->isSettingReadOnly( $this->settingFile, $block );
			    $this->settings[$block]['count'] = $this->settingsCount;
			    $this->settings[$block]['removeable'] = $blockRemoveable;
			    $this->settings[$block]['editable'] = $blockEditable;
			    $this->totalSettingCount += $this->settingsCount;
			    ++$this->blockCount;
		    }
		}
		
		ksort( $this->settings );
		
		if ( $this->selectedBlock )
		{
			$this->settings = array( $this->selectedBlock => $this->settings[$this->selectedBlock] );
		}
    }
    
    public function customSettingType( $block, $setting )
    {
    	//TODO
    	return;
    }
    
}

?>