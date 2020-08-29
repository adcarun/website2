<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

$db = JFactory::getDBO();
$params = $app->getTemplate(true)->params;
$page_title = $doc->getTitle();

$menu = Jfactory::getApplication()->getMenu();
//$menu = & JSite::getMenu();

$active = Jfactory::getApplication()->getMenu()->getActive();

//if(strstr($_SERVER['REQUEST_URI'], "jsn")) {
  // echo "JSN found";
//}
//print_r($menu);
//print_r($active->component);
//print_r($active->tree[0]);
$input = JFactory::getApplication()->input;

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
/*JHtml::_('bootstrap.framework');

$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Use of Google Font
if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}*/

// Load optional RTL Bootstrap CSS
//JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" class="logo img-responsive" width="65" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}

require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- Bootstrap -->
    <link href="<?php echo $this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css'; ?>" rel="stylesheet">
    <link href="<?php echo $this->baseurl . '/templates/' . $this->template . '/css/custom.css'; ?>" rel="stylesheet">
	<link href="<?php echo $this->baseurl . '/templates/' . $this->template . '/css/jquery.mCustomScrollbar.css'; ?>" rel="stylesheet">    
    <link href="<?php echo $this->baseurl . '/templates/' . $this->template . '/css/campus.css'; ?>" rel="stylesheet">
    <!-- validation -->
    <link href="<?php echo $this->baseurl . '/templates/' . $this->template . '/css/validation/validation.css'; ?>" rel="stylesheet" />
    
    
    
    
    <!-- fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	
	<jdoc:include type="head" />
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134260251-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134260251-1');
</script>
    
</head>
<body>

<!-- header start -->
    <?php include('includes/header.php'); ?>
    <!-- header end -->
    
    <!-- banner start -->
	<?php if ($this->countModules('banner')) : ?>	
		<jdoc:include type="modules" name="banner" style="none" />
	<?php endif; ?>  
    <!-- banner end -->
    
    <!-- announcement start -->
   <?php if ($this->countModules('top-announcement')) : ?>	
		<jdoc:include type="modules" name="top-announcement" style="none" />
	<?php endif; ?>
    <!-- announcement end -->
    
  
	<!-- latest news start -->
	<?php if ($this->countModules('homepage-important-points') || $this->countModules('latest-news')) : ?>
    <div class="latestNewsContainer">
    	<div class="container">
        	<div class="row">
			<?php if ($this->countModules('homepage-important-points')) : ?>
            	<div class="col-md-8 col-sm-12 col-xs-12">
                	<jdoc:include type="modules" name="homepage-important-points" style="none" />   
                </div>
				<?php endif; ?>
				<?php if ($this->countModules('latest-news')) : ?>
					<jdoc:include type="modules" name="latest-news" style="none" />                
				<?php endif; ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
    <!-- latest news end -->
    
    <?php if ($this->countModules('homepage-video-display-1') || $this->countModules('global-programme-info') || $this->countModules('global-programme-info-box1') || $this->countModules('global-programme-info-box2') || $this->countModules('global-programme-info-box3')) : ?>
    <section class="global-programme-container">
  	<div class="container">
    	<div class="row">
			<?php if ($this->countModules('homepage-video-display-1')) : ?>
        	<div class="col-md-6">
			<?php else: ?>
			<div class="col-md-12">
			<?php endif; ?>
            	<?php if ($this->countModules('global-programme-info')) : ?>
					<jdoc:include type="modules" name="global-programme-info" style="none" />
				<?php endif; ?>
				
                
                <div class="row global-programme-info">
					<?php if ($this->countModules('global-programme-info-box1')) : ?>	
                	<div class="col-xs-4">					
						<jdoc:include type="modules" name="global-programme-info-box1" style="none" />
                    </div>
					<?php endif; ?>
					<?php if ($this->countModules('global-programme-info-box2')) : ?>
                    <div class="col-xs-4">						
						<jdoc:include type="modules" name="global-programme-info-box2" style="none" />
                    </div>
					<?php endif; ?>
					<?php if ($this->countModules('global-programme-info-box3')) : ?>
                    <div class="col-xs-4">						
						<jdoc:include type="modules" name="global-programme-info-box3" style="none" />					
                    </div>
					<?php endif; ?>
                </div>
            </div>
			<?php if ($this->countModules('homepage-video-display-1')) : ?>
			<?php if($this->countModules('global-programme-info') || $this->countModules('global-programme-info-box1') || $this->countModules('global-programme-info-box2') || $this->countModules('global-programme-info-box3')) : ?>
            <div class="col-md-6" id="videoDisplay">
			<?php else: ?>
			<div class="col-md-12" id="videoDisplay">
			<?php endif; ?>
            	<jdoc:include type="modules" name="homepage-video-display-1" style="none" />
            </div>
			<?php endif; ?>
        </div>
    </div>
    </section>     
   <?php endif; ?>	
    
    <?/*
    <section class="news-container" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="you-win-container">
                    <ul>
                        <li>
                            <div class="you-win-list">
                                <p><b>1983</b>34 years of excellence in education <a href="/index.php/vishwakarma-institutes">EXPLORE<i id="arrowright" class="fa fa-long-arrow-right"></i></a></p>
                            </div>

                        </li>
                        <li>
                            <div class="you-win-list">
                                <p><b>100</b> 100 plus industry professionals as advisors <a href="/index.php/placements">EXPLORE<i id="arrowright" class="fa fa-long-arrow-right"></i></a></p>
                            </div>

                        </li>
                        <li>
                            <div class="you-win-list">
                                <p><b>38</b>Academic Programmes <a href="/index.php/academics">DISCOVER THE BEST FIT<i id="arrowright" class="fa fa-long-arrow-right"></i></a></p>
                            </div>

                        </li>
                        <li>
                            <div class="you-win-list">
                                <p><b>11</b>Diverse disciplines of knowledge to explore <a href="/index.php/programs">FIND YOUR INTEREST<i id="arrowright" class="fa fa-long-arrow-right"></i></a></p>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="news-slider-container">
                    <h4>Achievements</h4>
                    <div id="news-carousel" class="news-carousel carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#news-carousel" data-slide-to="1" class=""></li>
                            <li data-target="#news-carousel" data-slide-to="2" class=""></li>
                            <li data-target="#news-carousel" data-slide-to="3" class=""></li>
                            <li data-target="#news-carousel" data-slide-to="4" class=""></li>
                            <li data-target="#news-carousel" data-slide-to="5" class=""></li>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="item">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>

                        </div>

                        <!-- Controls -->
                        <!--<a class="left carousel-control" href="#news-carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#news-carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
	</section>
    */?>
    <?php if (JFactory::getApplication()->getMenu()->getActive() == JFactory::getApplication()->getMenu()->getDefault()){  ?>
    <div class="container-fluid exploreMoreArea">
    <div class="container">
        <h2 class="text-center">EXPLORE MORE</h2>
        <div class="row">
			
			<?php
	$queryExploreMenu = $db->getQuery(true);
	$queryExploreMenu->select(array('*'))
          ->from($db->quoteName('#__menu'))
		  ->where($db->quoteName('menutype') . ' = ' . $db->quote('home-explore-more-links'))
		  ->order($db->quoteName('lft').'ASC');
	$db->setQuery($queryExploreMenu,0,5);
	$dataExploreMenu = $db->loadObjectList();
	$ot_cnt=0;
	$cnt=1;
	foreach($dataExploreMenu as $exploreData){
		$menuitem   = $app->getMenu()->getItem($exploreData->id);
		$params = $menuitem->params; // get the params
		//echo $params->get('aliasoptions');
		//print_r($params);
?>
<style>
.exploreMoreBoxIcon<?php echo $cnt; ?>{
	background: url(<?php echo $this->baseurl.'/'.$params->get('menu_image'); ?>) left top no-repeat;
  	height: 68px;
}
</style>
<div class="col-md-4 col-sm-6 paddingZero">
<div class="exploreMoreBox <?php if($ot_cnt >= 1){ ?>exploreMoreBoxBg<?php echo $ot_cnt; } ?>">	
<h3 class="exploreMoreBoxIcon<?php echo $cnt; ?>"><a href="<?php if($exploreData->type=="url"){ echo $exploreData->link; }elseif($exploreData->type=="alias"){ 
				   $queryaliasMenu = $db->getQuery(true);	 
				   $queryaliasMenu->select(array('*'))
          		    ->from($db->quoteName('#__menu'))
		  		    ->where($db->quoteName('id') . ' = ' . $params->get('aliasoptions'));
				   $db->setQuery($queryaliasMenu);
				   $dataalias = $db->loadObjectList();
			       foreach($dataalias as $valalias){
			   		 echo $this->baseurl."/index.php/".$valalias->path;
			  		}

 }else{ echo $this->baseurl."/index.php/".$exploreData->path; }  ?>" style="color:#fff"><?php $title=$exploreData->title; if(str_word_count($title) > 1){  echo $firstPart=strstr($title," ",true); ?>
<span><?php echo $secondPart=strstr($title," ");  ?></span><?php }else{  echo $title; }?></a></h3>
</div>
</div>
<?php $ot_cnt++; $cnt++; } ?>

        </div>
    </div>
</div>
<?php } ?>
    <?php if ($this->countModules('student-says')) : ?>	
		<jdoc:include type="modules" name="student-says" style="none" />
	<?php endif; ?>	
    
  <?php if (JFactory::getApplication()->getMenu()->getActive() == JFactory::getApplication()->getMenu()->getDefault()){  ?>  
    <!-- information panel start -->
    <div class="informationContainer">
    	<div class="container-fluid">
        	<div class="row info-boxes-row">
			
				<?php if ($this->countModules('home-video-display')) : ?>
					<jdoc:include type="modules" name="home-video-display" style="none" />                
				<?php endif; ?>
                
				<?php if ($this->countModules('home-experience-viit')) : ?>
					<jdoc:include type="modules" name="home-experience-viit" style="none" />                
				<?php endif; ?>
				<?php if ($this->countModules('home-sports')) : ?>
					<jdoc:include type="modules" name="home-sports" style="none" />                
				<?php endif; ?>
                <?php if ($this->countModules('home-links')) : ?>
					<jdoc:include type="modules" name="home-links" style="none" />                
				<?php endif; ?>
				<?php if ($this->countModules('home-industry-interaction')) : ?>
					<jdoc:include type="modules" name="home-industry-interaction" style="none" />                
				<?php endif; ?>
				
                <?php if ($this->countModules('home-administrator-content')) : ?>
					<jdoc:include type="modules" name="home-administrator-content" style="none" />                
				<?php endif; ?>                
				<?php if ($this->countModules('home-research-development')) : ?>
					<jdoc:include type="modules" name="home-research-development" style="none" />                
				<?php endif; ?> 
			
            </div>
            
        </div>
    </div>
    <!-- information panel end -->
   <?php } ?> 
	<!-- gallery start -->
	<?php if ($this->countModules('home-gallery-content')) : ?>
		<jdoc:include type="modules" name="home-gallery-content" style="none" />    
	<?php endif; ?>
    <!-- gallery end -->
    
   <!-- quick link start -->
	<?php if ($this->countModules('quick-links')) : ?>
		<jdoc:include type="modules" name="quick-links" style="none" />
	<?php endif; ?>
    
    <!-- quick link end -->
    
    <?php if ($this->countModules('homepage-placement-logos')){ ?>
		<jdoc:include type="modules" name="homepage-placement-logos" style="none" /> 
	<?php } ?>
    
    
    
    <!-- google map and contact start -->
    
    <?php if ($this->countModules('homepage-map') || $this->countModules('homepage-map-contact')) : ?>
		<div class="container-fluid" id="mapArea">
        <div class="row">
			<?php if ($this->countModules('homepage-map')){ ?>
			<div class="col-md-12 col-sm-12 col-xs-12 mapInnerArea holder">
    
                <div class="custom">
                    	<jdoc:include type="modules" name="homepage-map" style="none" />                    
                </div>
    
                <div class="bar"></div>
            </div>
			<?php } ?>
			<?php /*if ($this->countModules('homepage-map-contact')){ ?>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<jdoc:include type="modules" name="homepage-map-contact" style="none" />               
				</div>
			<?php } */ ?>
			</div>
        <!--row-->
    </div>
    <!-- google map and contact end -->
	<?php endif; ?>
	
	<?php if (JFactory::getApplication()->getMenu()->getActive() != JFactory::getApplication()->getMenu()->getDefault()){  ?>
		 <!-- admissions banner start -->
		 <?php
			//print_r($active);
			if($active->component=='com_k2' || $active->component=='com_phocagallery'){
			$menuparams = $menu->getParams($active->id);
			$menutypeActive=$active->menutype;
			$queryParentMenu = $db->getQuery(true);
			$queryParentMenu->select('*')
			 ->from($db->quoteName('#__menu'))
			 ->where($db->quoteName('menutype') . ' = ' . $db->quote($menutypeActive). ' and id='.$active->tree[0].' and published=1' )
			 ->order($db->quoteName('lft').'ASC');
			$db->setQuery($queryParentMenu);
			$dataParentMenu = $db->loadObjectList();
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
        			</div>
				</div>
			</div>			
		<!-- admissions banner end -->
		<div class="container">
		<div class="row">
      
			<div class="internalPage">
				<?php
					 
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
				<div class="col-md-12 breadcrumbSubMenuContainer">
      	<?php $modBreadcrumb = JModuleHelper::getModules('breadcrumb'); if(count($modBreadcrumb) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('breadcrumb') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
		 <?php	} ?>	
      
		<?php if(count($dataMainMenu) > 0){ ?>
      	<ul class="nav nav-tabs navbar-right subMenuNavbar" role="tablist">
              <li role="presentation" class="dropdown active ActiveMenu">
               <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false"><?php echo $dataParentMenu[0]->title; ?> Submenu <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
				<?php foreach($dataMainMenu as $MainMenudata){ 
						$menusitem   = $app->getMenu()->getItem($MainMenudata->id);
						$paramsMainmenu = $menusitem->params;
				?>
                  <li <?php if($active->id==$MainMenudata->id){ ?>class="active"<?php } ?> role="presentation"><a href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
								$queryaliasMenu = $db->getQuery(true);	 
								$queryaliasMenu->select(array('*'))
											   ->from($db->quoteName('#__menu'))
											   ->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
								$db->setQuery($queryaliasMenu);
								$dataalias = $db->loadObjectList();
								foreach($dataalias as $valalias){
									echo $this->baseurl."/index.php/".$valalias->path;
								}
								}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>"><?php echo $MainMenudata->title; ?></a></li>
				 <?php } ?>                  
                </ul>
              </li>
        </ul>
		<?php } ?>
      </div> 
			
				<jdoc:include type="component" />
			</div>
    
		</div><!--end of .row-->
		</div>	<?php }else{ ?>
			<jdoc:include type="component" />
		<?php } ?>	
	<?php } ?>  
        
    
    <!-- footer start -->
    <?php include('includes/footer.php'); ?>
    <!-- footer end -->
    
    
    
    <!-- Button trigger modal -->
    <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#videoModal">
      Launch demo modal
    </button>-->
    
    <!-- Modal -->
    <!--<div class="videoModal modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
          	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/yAoLSRbwxL8?rel=0" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>-->
    
    <!-- Modal -->
	<?php if ($this->countModules('disclaimerModal')){ ?>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<jdoc:include type="modules" name="disclaimerModal" style="none" />               
				</div>
	<?php } ?>

<!--Limit-->
<!-- /.modal -->

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/jquery.mCustomScrollbar.js'; ?>"></script>
    <script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/allscript.js'; ?>"></script>
    
    
    
    
    
    <script>
		jQuery('a[href="#"]').click(function(e) {
           jQuery('#underConstruction').modal('show');
        });
		
		jQuery(window).load(function(){        
		   jQuery('#disclaimerModal').modal('show');
		}); 
		
		jQuery('#disclaimerModal').modal({
		  backdrop: 'static',
		  keyboard: false
		});
		
		jQuery(document).ready(function(){
			jQuery( "table" ).wrap( "<div class='table-responsive'></div>" );
			jQuery( "table" ).addClass( "table table-bordered" );
			
			jQuery( "div.jwts_tabberlive" ).wrap( "<div class='horizontalTab'></div>" );
				
				//jQuery( ".internalPage img" ).addClass( "img-responsive" );
			<?php //if(!strstr($_SERVER['REQUEST_URI'], "jsn") && ($active->component != 'com_users')) { ?>
				var windowWidth = jQuery(window).width();
				if(windowWidth > 991){
					stickySidebarAdmission();
				}
			<?php //} ?>	
			
			var bootstrapLoaded = (typeof $().carousel == 'function');
				var mootoolsLoaded = (typeof MooTools != 'undefined');
				if (bootstrapLoaded && mootoolsLoaded) {
					Element.implement({
						hide: function () {
						return this;
					},
					show: function (v) {
						return this;
					},
					slide: function (v) {
						return this;
					}
				});
        }
			
			
		})
		
	</script>	
    
    <script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/validation/jquery.min-validation.js'; ?>"></script>
    
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/validation/jquery.validate.js'; ?>"></script>
    <script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/validation/additional-methods.js'; ?>"></script>
    <script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/validation/checkvalidation.js'; ?>"></script>
    
    
    <script>
		$(document).ready(function() {
		   $('.selectForm input[type="radio"]').click(function() {
			   if($(this).val() == 'Students') {
					$('.formContainer').hide();
					$('.frmStudentContainer').show();           
			   } else if($(this).val() == 'Parents') {
					$('.formContainer').hide();
					$('.frmParentContainer').show();          
			   } else if($(this).val() == 'Recruiters') {
					$('.formContainer').hide();
					$('.frmRecruitersContainer').show();       
			   } else if($(this).val() == 'Faculty') {
					$('.formContainer').hide();
					$('.frmFacultyContainer').show();         
			   } else if($(this).val() == 'Alumni') {
					$('.formContainer').hide();
					$('.frmAlumniContainer').show();     
			   }
		   });
		});
	</script>
    
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
<?/*
	<!-- Body -->
	<div class="body" id="top">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
						<?php endif; ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<div class="navbar pull-left">
						<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="element-invisible"><?php echo JTEXT::_('TPL_PROTOSTAR_TOGGLE_MENU'); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
					<div class="nav-collapse">
						<jdoc:include type="modules" name="position-1" style="none" />
					</div>
				</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($position8ModuleCount) : ?>
					<!-- Begin Sidebar -->
					<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="position-8" style="xhtml" />
						</div>
					</div>
					<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<div class="clearfix"></div>
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($position7ModuleCount) : ?>
					<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</footer>*/?>
