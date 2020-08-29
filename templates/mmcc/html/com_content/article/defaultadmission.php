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
  
  
  
  <div class="container infrastructureWrap">
   <div class="row">
      
      <div class="infrastructurePanel">
      <div class="col-md-12">	  
		<?php echo $this->item->text; ?>
      </div>
      
      </div>
    
    </div> 
    
  </div>
  
  <div class="container-fluid serviceWrap">
  
  <div class="container">
<div class="row">
<div class="col-md-12">
<h2>International Students</h2>
</div>
</div>
<div class="row">
<?php $modadmissionInternationStudents = JModuleHelper::getModules('admissioninternationalstudents'); if(count($modadmissionInternationStudents) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('admissioninternationalstudents') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
<?php	} ?>

</div>
</div>
</div>
  
 
  <div class="container-fluid studyWrap">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <h2>Why Study @MMCC</h2>
  </div>
  </div>
  
  <div class="row benefitsMainArea">
		<?php $modwhystudayMMCC = JModuleHelper::getModules('whystudayMMCC'); if(count($modwhystudayMMCC) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('whystudayMMCC') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
		<?php	} ?>
 </div>
  
  </div>
  
  </div>
  
  <div class="container-fluid studyWrap studyWrapBorder">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <?php $modcontactAdmissioncell = JModuleHelper::getModules('contactAdmissioncell'); if(count($modcontactAdmissioncell) > 0){   ?>
	<?php foreach (JModuleHelper::getModules('contactAdmissioncell') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
	}?>
 <?php	} ?>
  
  </div>
  </div>
  </div>
  </div>
  
    <div class="container-fluid studyWrap1">
  <div class="container">
  <div class="row">
  <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
            <div class="row nubWrap">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="numberBox">
				<?php $modAdmissioncalluson = JModuleHelper::getModules('Admissioncalluson'); if(count($modAdmissioncalluson) > 0){   ?>
				<?php foreach (JModuleHelper::getModules('Admissioncalluson') as $module) {    
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
  
      <div class="container-fluid studyWrap3">
  <div class="container">
  <div class="row">
  <div class="contactFormInner validateContainer contact-form">
  <?php $modadmissionForm = JModuleHelper::getModules('admissionForm'); if(count($modadmissionForm) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('admissionForm') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
<?php	} ?>
</div>
  
  </div>
  </div>
  </div>