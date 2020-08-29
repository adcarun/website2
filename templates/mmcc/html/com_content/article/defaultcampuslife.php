<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');



// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
$doc     = JFactory::getDocument();
// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
JHtml::_('behavior.caption');

$app = JFactory::getApplication();

$db = JFactory::getDBO();
//$menu = & JSite::getMenu();
$menu = Jfactory::getApplication()->getMenu();

$active = Jfactory::getApplication()->getMenu()->getActive();
$menuparams = $menu->getParams($active->id);
//print_r($active);
$menutypeActive=$active->menutype;

			//echo $menuType=$active->menutype;
			//echo $Parent_id=$menu->parent_id;
			
			$queryParentMenu = $db->getQuery(true);
			$queryParentMenu->select('*')
			 ->from($db->quoteName('#__menu'))
			// ->where($db->quoteName('menutype') . ' = ' . $db->quote('mainmenu'). ' and id='.$active->tree[0].' and published=1' )
			 ->where($db->quoteName('menutype') . ' = ' . $db->quote($menutypeActive). ' and id='.$active->tree[0].' and published=1' )
			 ->order($db->quoteName('lft').'ASC');
			$db->setQuery($queryParentMenu);
			$dataParentMenu = $db->loadObjectList();

					$queryMainMenu = $db->getQuery(true);
					$queryMainMenu->select('*')
						 ->from($db->quoteName('#__menu'))
						 ->where($db->quoteName('menutype') . ' = ' . $db->quote($menutypeActive). ' and parent_id='.$active->tree[0].' and published=1' )
						 ->order($db->quoteName('lft').'ASC');
					$db->setQuery($queryMainMenu);
					$dataMainMenu = $db->loadObjectList();
					$cntMain=0;			

?>
<?php if($menuparams['menu_image'] !=""){ ?>
		<div class="fill admission-banner-fill" alt="banner" title="banner" style="background-image:url('<?php echo $menuparams['menu_image']; ?>');"></div>
<?php }else{ ?>
		<div class="fill admission-banner-fill" alt="banner" title="banner" style="background-image:url('images/admission-banner.jpg');"></div>
<?php } ?>
			
  
<div class="container admissionPageContainer">
    <div class="row">

      <div class="col-md-12 text-center">
      	<h1 class="heading headingWhite"><?php echo $page_title = $doc->getTitle(); ?></h1>
        
        <?php $modBreadcrumb = JModuleHelper::getModules('breadcrumb'); if(count($modBreadcrumb) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('breadcrumb') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
		 <?php	} ?>
      </div>
   
   </div>
  </div>
  
  
  
<div class="container">
   <div class="row">
      
      <div class="campusPanel">
      <div class="col-md-6 col-sm-12 col-xs-12">
	  
      <?php echo $this->item->text; ?>
      
      
      </div>

      <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="campusRgt">
	  <?php $modCampusImages = JModuleHelper::getModules('CampusImages'); if(count($modCampusImages) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusImages') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
		<?php	} ?>

       </div>
      </div>
      
      
      </div>
    
    </div><!--end of .row-->
    
      <div class="row">
      <div class="campusPanel2">
      <div class="row">
      <div class="col-md-12">
		<h2>Learn Beyond the Classrooms</h2>
      
      </div>
      </div>
      
         <div class="row">
	  <?php $modCampusBeyondClassroom = JModuleHelper::getModules('CampusBeyondClassroom'); if(count($modCampusBeyondClassroom) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusBeyondClassroom') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
		<?php	} ?>
      
      </div>
       
      
      </div>
      
      </div>
    
    
  </div>
  
  <div class="container-fluid campusPanel3">
  <div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
  <div class="extensionActivities">
  <h2>Extension Activities</h2>
  
  <div class="row">
  
  <?php $modCampusExtensionActivities = JModuleHelper::getModules('CampusExtensionActivities'); if(count($modCampusExtensionActivities) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusExtensionActivities') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
 <?php	} ?>
  
  </div>
  
  </div>
  </div>
  
  <div class="col-md-6 col-sm-6 col-xs-12 eventsWrap">
  <div class="eventsWrapIn">
  <h2>Intercollegiate Events</h2>
  <?php $modCampusIntercollegiateEvents = JModuleHelper::getModules('CampusIntercollegiateEvents'); if(count($modCampusIntercollegiateEvents) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusIntercollegiateEvents') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
 <?php	} ?>  
  </div>
  </div>
  
  </div>
  </div>
   
  <div class="container-fluid inhouseEvents">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <h2>Inhouse Events</h2>
  </div>
  </div>
  
  <div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12 tabList">
    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="vc_tta-icon fa fa-crosshairs"></i> Quick Links </a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="vc_tta-icon fa fa-newspaper-o"></i> Upcoming Events </a></li>
        <li role="presentation"><a href="#events" aria-controls="events" role="tab" data-toggle="tab"><i class="vc_tta-icon fa fa-hand-o-right"></i> Events Photos </a></li>

    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="vc_tta-icon fa fa-bell-o"></i> Video Gallery</a></li>
  </ul>
  </div>
  
  <div class="col-md-9 col-sm-9 col-xs-12 tabRgt">
  <div>
  <div class="tab-content">
  
    <div role="tabpanel" class="tab-pane active" id="home">
    
	<?php $modQuickLinks = JModuleHelper::getModules('CampusQuickLinks'); if(count($modQuickLinks) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusQuickLinks') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
	<?php	} ?>
    
    </div>
    
    <div role="tabpanel" class="tab-pane" id="profile">
        <h2>Upcoming Events</h2>
    <?php $modUpcomingEvents = JModuleHelper::getModules('CampusUpcomingEvents'); if(count($modUpcomingEvents) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusUpcomingEvents') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
	<?php	} ?>
    
    </div>
    

    
    <div role="tabpanel" class="tab-pane" id="events">
        <h2>Events Photos</h2>
    <?php $modCampusEventPhotos = JModuleHelper::getModules('CampusEventPhotos'); if(count($modCampusEventPhotos) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusEventPhotos') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
	<?php	} ?>
	
    </div>
    
    <div role="tabpanel" class="tab-pane" id="settings">
	<h2>Video Gallery</h2>	
	<?php $modCampusVideo = JModuleHelper::getModules('CampusVideoGallery'); if(count($modCampusVideo) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('CampusVideoGallery') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
	<?php	} ?>
    
    </div>
    
  </div>

</div>
  </div>
  </div>
  </div>
  </div>
  
  <div class="container-fluid highlightsWrap">
  <div class="container">
  <div class="row">
  <div class="col-md-12"><h2>Highlights</h2> </div>
  </div>
  
  
  <div class="row">
  <?php $modCampusHighlights = JModuleHelper::getModules('campusHighlights'); if(count($modCampusHighlights) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('campusHighlights') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
	<?php	} ?>
  
  </div>
  
  </div>
  </div>