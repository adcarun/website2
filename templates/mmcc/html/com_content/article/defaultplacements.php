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
  



<div class="container placementWrap">
   <div class="row">
      
      <div class="placementPanel">
      <div class="col-md-12">
		<?php echo $this->item->text; ?>
      </div>
      
      </div>
	</div> 
    

    <div class="placementPanel2">
    
    
          <div class="row aboutInfo">
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="innerMiddleWrap">
            <h2>Corporate Relations Division </h2>
          </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="innerMiddleWrap">
		<?php
				$id = 165;					
				$query = $db->getQuery(true);
				$query->select($db->quoteName(array('id','title','alias','introtext')))
					      ->from($db->quoteName('#__content'))
						  ->where($db->quoteName('id')." = ".$db->quote($id));
				$db->setQuery($query);
				$itemList = $db->loadObjectList();
				$cnt=0;
				if(count($itemList) > 0) {
				foreach ($itemList as $item){
			 		echo $item->introtext;
			
			}
			}	
		?>
        
        </div>
        </div>
        </div>
        
      <!--  <div class="row vissionWrapMain">
        <div class="col-md-6 col-sm-6 col-xs-12 vissionWrap">
        <div class="vissionBg">
        <img src="images/icons/vission-icon.png">
        <h3>Vision</h3>
        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
        </div>
        </div>
        
        
        <div class="col-md-6 col-sm-6 col-xs-12 vissionWrap">
        <div class="vissionBg">
        <img src="images/icons/mission-icon.png">
        <h3>Mission</h3>
There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
        </div>
        </div>
        
        </div>-->
      
    
    </div>

    

    <div class="placementPanel3">
    <div class="row">
		<?php
				$id = 76;					
				$query = $db->getQuery(true);
				$query->select($db->quoteName(array('id','title','alias','introtext')))
					      ->from($db->quoteName('#__content'))
						  ->where($db->quoteName('id')." = ".$db->quote($id));
				$db->setQuery($query);
				$itemList = $db->loadObjectList();
				$cnt=0;
				if(count($itemList) > 0) {
				foreach ($itemList as $item){
			 		echo substr($item->introtext,0,2000);
			
			}
			}	
		?>
<div class="col-md-3 col-sm-3 col-xs-12">
</div>
<div class="col-md-9 col-sm-9 col-xs-12">
<div class="aboutDetail">
<div class="readMore">
<a href="<?php echo JURI::root().'index.php/placements/corporate-relations-division/director-crd'; ?>">Read More</a>
</div>
</div>
</div>
</div>
    </div>
    
    
    

    <div class="placementPanel4">
    <div class="row">
      
       <?php
				$id = 77;					
				$query = $db->getQuery(true);
				$query->select($db->quoteName(array('id','title','alias','introtext')))
					      ->from($db->quoteName('#__content'))
						  ->where($db->quoteName('id')." = ".$db->quote($id));
				$db->setQuery($query);
				$itemList = $db->loadObjectList();
				$cnt=0;
				if(count($itemList) > 0) {
				foreach ($itemList as $item){
			 		echo substr($item->introtext,0,2000);
			
			}
			}	
		?>
		<div class="col-md-3 col-sm-3 col-xs-12">
</div>
<div class="col-md-9 col-sm-9 col-xs-12">
<div class="aboutDetail">
<div class="readMore">
<a href="<?php echo JURI::root().'index.php/placements/corporate-relations-division/training-placements-officer'; ?>">Read More</a>
</div>
</div>
</div>
		
      </div>
    </div>
    
    
    
    

    <div class="placementPanel5">
    <div class="row"> 
    <div class="col-md-12">
    <h2> Employability Enhancement Initiatives  </h2>
    </div>
    </div>
    
    <div class="row">    
	<?php $modEmployabilityEnhancementInitiatives = JModuleHelper::getModules('EmployabilityEnhancementInitiatives'); if(count($modEmployabilityEnhancementInitiatives) > 0){   ?>
	<?php foreach (JModuleHelper::getModules('EmployabilityEnhancementInitiatives') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
	}?>
	<?php } ?>

    </div>
    
    </div>
    
  </div>
  
  
  
  
  
  <div class="container-fluid initiativesWrap">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  <h2>Industry Connect Initiatives</h2>
  </div>
  </div>
  
  <div class="row">
        <?php $modIndustryConnectInitiatives = JModuleHelper::getModules('IndustryConnectInitiatives'); if(count($modIndustryConnectInitiatives) > 0){   ?>
		<?php foreach (JModuleHelper::getModules('IndustryConnectInitiatives') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
		}?>
		<?php } ?>
      </div>
  
  </div>
  </div>
  
 <?/* 
  <div class="container-fluid placementWrap alumniWrap">
  <div class="container">
  <div class="row alumniWrapIn">
  <div class="col-md-12">
  <h2>Alumni Connect for Placements</h2>
  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
  </div>
  
  <div class="col-md-12">
  <div id="carousel-example-generic-alumni" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
 
       <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">
       <div class="media">
  <div class="media-left">
      <img class="media-object" src="images/dummy-profile-pic.jpg" alt="...">
  </div>
  <div class="media-body">
 <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
 <h4>Name</h4>
 <span>Dummy Text</span>
  </div>
</div>
       </div>
       
       <div class="col-md-6 col-sm-6 col-xs-12">
       <div class="media">
  <div class="media-left">
      <img class="media-object" src="images/dummy-profile-pic.jpg" alt="...">
  </div>
  <div class="media-body">
 <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
 <h4>Name</h4>
 <span>Dummy Text</span>
  </div>
</div>
       </div>
       
       </div>

    </div>
    
<div class="item">
 
       <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">
       <div class="media">
  <div class="media-left">
      <img class="media-object" src="images/dummy-profile-pic.jpg" alt="...">
  </div>
  <div class="media-body">
 <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
 <h4>Name</h4>
 <span>Dummy Text</span>
  </div>
</div>
       </div>
       
       <div class="col-md-6 col-sm-6 col-xs-12">
       <div class="media">
  <div class="media-left">
      <img class="media-object" src="images/dummy-profile-pic.jpg" alt="...">
  </div>
  <div class="media-body">
 <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
 <h4>Name</h4>
 <span>Dummy Text</span>
  </div>
</div>
       </div>
       
       </div>

    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic-alumni" role="button" data-slide="prev">
<i class="fa fa-angle-left" aria-hidden="true"></i>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic-alumni" role="button" data-slide="next">
<i class="fa fa-angle-right" aria-hidden="true"></i>
  </a>
</div>
  
  </div>
  
  </div>
  </div>
  </div>
  */?>
    <div class="container placementWrap">

    <div class="placementPanel6">
    <div class="row">
    <div class="col-md-12">
	<?php $modContactPlacementCell = JModuleHelper::getModules('ContactPlacementCell'); if(count($modContactPlacementCell) > 0){   ?>
	<?php foreach (JModuleHelper::getModules('ContactPlacementCell') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
	}?>
<?php	} ?>
    
    
    </div>
    </div>
    
    
    <div class="row addressWrap">
	<?php $modContactPlacementAddressBox = JModuleHelper::getModules('ContactPlacementAddressBox'); if(count($modContactPlacementAddressBox) > 0){   ?>
	<?php foreach (JModuleHelper::getModules('ContactPlacementAddressBox') as $module) {    
			echo JModuleHelper::renderModule($module, array('style' => 'none'));
	}?>
	<?php } ?>    
    </div>
    
    </div>
	
</div>