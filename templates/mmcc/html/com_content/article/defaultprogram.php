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
      
			<div class="admissionPanel">

		<div class="col-md-3 leftPanel">
      	
        <div class="admissionLinkPanel">
        <a class="btn btn-primary admissionPanelCollapseBtn" role="button" data-toggle="collapse" href="#admissionPanelCollapse" aria-expanded="false" aria-controls="collapseExample">
          <?php echo $dataParentMenu[0]->title; ?> Details
          <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
        </a>
        <div class="collapse" id="admissionPanelCollapse">
          <div class="panel-group" id="courseAccordion" role="tablist" aria-multiselectable="true">
                  
                  <h2><?php echo $dataParentMenu[0]->title; ?> Details</h2>
				  
				  <?php 
					$queryMainMenu = $db->getQuery(true);
					$queryMainMenu->select('*')
						 ->from($db->quoteName('#__menu'))
						 ->where($db->quoteName('menutype') . ' = ' . $db->quote($menutypeActive). ' and parent_id='.$active->tree[0].' and published=1' )
						 ->order($db->quoteName('lft').'ASC');
					$db->setQuery($queryMainMenu);
					$dataMainMenu = $db->loadObjectList();
					$cntMain=0;
					foreach($dataMainMenu as $MainMenudata){
						$menusitem   = $app->getMenu()->getItem($MainMenudata->id);
						$paramsMainmenu = $menusitem->params;

						$queryMainMenusub = $db->getQuery(true);
						$queryMainMenusub->select('*')
							->from($db->quoteName('#__menu'))
							->where($db->quoteName('menutype') . ' = ' . $db->quote($menutypeActive). ' and parent_id='.$MainMenudata->id.' and published=1' )
							->order($db->quoteName('lft').'ASC');
						$db->setQuery($queryMainMenusub);
						$dataMainMenusub = $db->loadObjectList();
						
				  ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?php echo $MainMenudata->id; ?>">
                      <h4 class="panel-title">
					  <?php if(count($dataMainMenusub) > 0){ ?>
					  <?php if($active->parent_id==$MainMenudata->id){ ?>
                        <a role="button" class="active" data-toggle="collapse" data-parent="#courseAccordion" href="#courseAccordionTab<?php echo $MainMenudata->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $MainMenudata->id; ?>">
                          <?php echo $MainMenudata->title; ?>
                        </a>
						<?php }else{ ?>
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#courseAccordion" href="#courseAccordionTab<?php echo $MainMenudata->id; ?>" aria-expanded="false" aria-controls="collaps<?php echo $MainMenudata->id; ?>">
                          <?php echo $MainMenudata->title; ?>
                        </a>
						<?php } ?>
						<?php }else{ ?>
							<a class="<?php if($active->id==$MainMenudata->id){ ?>active<?php }else{ ?>collapsed<?php } ?>" href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
								$queryaliasMenu = $db->getQuery(true);	 
								$queryaliasMenu->select(array('*'))
											   ->from($db->quoteName('#__menu'))
											   ->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
								$db->setQuery($queryaliasMenu);
								$dataalias = $db->loadObjectList();
								foreach($dataalias as $valalias){
									echo $this->baseurl."/index.php/".$valalias->path;
								}
								}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>">
							<?php echo $MainMenudata->title; ?>
							</a>
						<?php } ?>
                      </h4>
                    </div>
					<?php if(count($dataMainMenusub) > 0){ ?>
                    <div id="courseAccordionTab<?php echo $MainMenudata->id; ?>" class="panel-collapse collapse<?php if($active->parent_id==$MainMenudata->id){ ?> in<?php } ?>" role="tabpanel" aria-labelledby="heading<?php echo $MainMenudata->id; ?>">
                      <div class="panel-body">					  
                        <ul class="tabNav">
						<?php
							$cnt=0;
							foreach($dataMainMenusub as $MainMenudatasub){
								$menusitemsub   = $app->getMenu()->getItem($MainMenudatasub->id);
								$paramsMainmenusub = $menusitemsub->params;
						?>		
                          <li <?php if($active->id==$MainMenudatasub->id){ ?>class="active"<?php } ?>><a href="<?php if($MainMenudatasub->type=="url"){ echo $MainMenudatasub->link; }elseif($MainMenudatasub->type=="alias"){ 
								$queryaliasMenu = $db->getQuery(true);	 
								$queryaliasMenu->select(array('*'))
											   ->from($db->quoteName('#__menu'))
											   ->where($db->quoteName('id') . ' = ' . $paramsMainmenusub->get('aliasoptions'));
								$db->setQuery($queryaliasMenu);
								$dataalias = $db->loadObjectList();
								foreach($dataalias as $valalias){
									echo $this->baseurl."/index.php/".$valalias->path;
								}
								}else{ echo $this->baseurl."/index.php/".$MainMenudatasub->path; } ?>"><?php echo $MainMenudatasub->title; ?></a></li>
						 <?php $cnt++; } ?>
                        </ul>
                      </div>
                    </div>
					<?php } ?>
                  </div>
				  <?php $cntMain++; } ?>
				  
                </div>
           
        </div>
        
        
        <div class="news-container" style="padding-top: 0;">
        
        
        
        
        <div class="newsletter">
			<?php $modLeftSideMailingList = JModuleHelper::getModules('leftsidemailinglist'); if(count($modLeftSideMailingList) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('leftsidemailinglist') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
			<?php	} ?>	        
    	</div>
        
		<?php $modLeftSideTestimonial = JModuleHelper::getModules('leftsidetestimonial'); if(count($modLeftSideTestimonial) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('leftsidetestimonial') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
		 <?php	} ?>
        
            
    <div class="newsletter">
        <h4>SUBSCRIBE TO E-BROCHURE</h4>
        <p>By subscribing to our mailing list you will always be update with the latest news from us.</p>
        <style type="text/css">
            <!--div.modns tr,
            div.modns td {
                border: none;
                padding: 3px;
            }
            
            -->
        </style>
        <div class="modns">
		<?php $modLeftSideNewsletter = JModuleHelper::getModules('leftsidenewsletter'); if(count($modLeftSideNewsletter) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('leftsidenewsletter') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
		 <?php	} ?>
		
           <!-- <form action="http://www.dypcoeakurdi.ac.in/index.php/courses/departments/post-graduation-computer-engineering-colleges-india" method="post" class="form-inline subscription-form">
                <div class="modnsintro"></div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="modns inputbox form-control" type="text" name="m_name" size="12" placeholder="Name:">
                                        <div class="input-group-addon"><img class="img-responsive" alt="msg" src="images/icons/name-icon.png"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="modns inputbox form-control" type="text" name="m_email" size="12" placeholder="Email:">
                                        <div class="input-group-addon"><img class="img-responsive" alt="msg" src="images/icons/newsletterMsg.png"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <input class="modns button " type="submit" value="Subscribe to E-Brochure" style="width: 100%">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>-->
        </div>

    </div>
	
	<?php $modLeftSideNews = JModuleHelper::getModules('leftsidenews'); if(count($modLeftSideNews) > 0){   ?>
			<?php foreach (JModuleHelper::getModules('leftsidenews') as $module) {    
				echo JModuleHelper::renderModule($module, array('style' => 'none'));            
			}?>
		 <?php	} ?>	
    

</div>
        
        
        </div>
        
        
      </div>
	  <div class="col-md-9 coursePanelText">
		<div class="internalPage" style="margin-top:20px">
		<?php echo $this->item->text; ?>
		</div>
	  </div>
	  
	</div>
</div>
</div>	

	 

      <?/*  <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="bulletStyle1">
                        <h4>Study With Us</h4>
                        <p>IIT-P provides a Program which is truly complete. The classroom program includes Teaching, Doubts & Difficulties, Testing, Assignments & Counselling from time to time.</p>
                    </div><!-- bulletStyle -->
                </div><!-- col-md-4 -->
                <div class="col-md-4 col-sm-4">
                    <div class="bulletStyle1 yellowBullet">
                        <h4>Study With Us</h4>
                        <p>IIT-P provides a Program which is truly complete. The classroom program includes Teaching, Doubts & Difficulties, Testing, Assignments & Counselling from time to time.</p>
                    </div><!-- bulletStyle -->
                </div><!-- col-md-4 -->
                <div class="col-md-4 col-sm-4">
                    <div class="bulletStyle1 blueBullet">
                        <h4>Study With Us</h4>
                        <p>IIT-P provides a Program which is truly complete. The classroom program includes Teaching, Doubts & Difficulties, Testing, Assignments & Counselling from time to time.</p>
                    </div><!-- bulletStyle -->
                </div><!-- col-md-4 -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <h3><span>1</span>Study With Us</h3>
                    <ul>
                        <li>Ph.D. in the area of Customer Relationship Management (CRM)</li>
                        <li>Masters in Business Administration (M.B.A.) with specialization in Marketing</li>
                        <li>Bachelor in Engineering (B.E.) with specialization in Mechanical Engineering</li>
                        <li>Postgraduates Diploma in Total Quality Management (P.G.D.T.Q.M.)</li>
                        <li>Sun Certified Programmer for Java 2 Platform (S.C.J.P.) – International Certification.</li>
                        <li>Advance Diploma Course in Enterprise Java Computing (A.D.E.J.C.)</li>
                        <li>Hands-on-experience of SPSS.</li>
                    </ul>
                </div><!-- col-md-9 -->
                <div class="col-md-3 col-sm-4">
                    <div class="rightPannelList">
                        <ul>
                            <li class="active"><a href="#">How to Apply</a></li>
                            <li><a href="#">Apply Online</a></li>
                            <li><a href="#">Student Service</a></li>
                            <li><a href="#">Download Information</a></li>       
                        </ul>
                        <div class="announcementArea">
                             <h4>Admission Announcement will appear here</h4>
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                        </div><!-- announcementArea -->
                    </div>
                </div>
            </div>
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tabOne" aria-expanded="true">Faculty Pool</a></li>

                        <li><a data-toggle="tab" href="#tabTwo" aria-expanded="false">Research & Publications</a></li>
                        
                        <li><a data-toggle="tab" href="#tabThree" aria-expanded="false">Faculty Pool</a></li>

                        <li><a data-toggle="tab" href="#tabFour" aria-expanded="false">Research &amp; Publications</a></li>

                        <li><a data-toggle="tab" href="#tabFive" aria-expanded="false">Research & Publications</a></li>

                        <li><a data-toggle="tab" href="#tabSix" aria-expanded="false">Explore Learning Resources</a></li>

                    </ul>
                </div><!-- col-md-3 -->
                <div class="col-md-6 col-sm-5">
                    <div class="tab-content">
                        <div id="tabOne" class="tab-pane fade active in">
                            <p>At Present, the University is offering 91 academic programmes, which include 36 Post Graduate Degree programmes, 24 Under Graduate Degree programmes, 17 Post Graduate Diploma programmes,13 Diploma programmes and 01 Doctoral programmes. </p>
                            <p>At Present, the University is offering 91 academic programmes, which include 36 Post Graduate Degree programmes, 24 Under Graduate Degree programmes, 17 Post Graduate Diploma programmes,13 Diploma programmes and 01 Doctoral programmes At Present, the University is offering 91 academic programmes, which include 36 Post Graduate Degree programmes, 24 Under Graduate Degree programmes, 17 Post Graduate Diploma programmes,13 Diploma programmes and 01 Doctoral programmes</p>
                        </div>
                        <div id="tabTwo" class="tab-pane fade">
                            2
                        </div>
                        <div id="tabThree" class="tab-pane fade">
                            3
                        </div>
                        <div id="tabFour" class="tab-pane fade">
                            4
                        </div>
                        <div id="tabFive" class="tab-pane fade">
                            5
                        </div>
                        <div id="tabSix" class="tab-pane fade">
                            6
                        </div>
                    </div>
                </div><!-- col-md-6 -->
                <div class="col-md-3 col-sm-3">
                    <div id="internalPageSilder" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#internalPageSilder" data-slide-to="0" class="active"></li>
                            <li data-target="#internalPageSilder" data-slide-to="1"></li>
                            <li data-target="#internalPageSilder" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="carouselCaption">
                                    <h6>At a Glance</h6>
                                    <h3>98.4%</h3>
                                    <p>of Ross grads are career switchers </p>
                                </div>
                            </div><!-- item -->
                            <div class="item">
                                <div class="carouselCaption">
                                    <h6>At a Glance</h6>
                                    <h3>98.4%</h3>
                                    <p>of Ross grads are career switchers </p>
                                </div>
                            </div><!-- item -->
                            <div class="item">
                                <div class="carouselCaption">
                                    <h6>At a Glance</h6>
                                    <h3>98.4%</h3>
                                    <p>of Ross grads are career switchers </p>
                                </div>
                            </div><!-- item -->
                        </div><!-- carousel-inner -->
                    </div><!-- carousel -->
                </div><!-- col-md-3 -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".interPageModal">Pop up style</button>
                </div><!-- col-md-9 -->
                <div class="col-md-3 col-sm-3">
                    <div class="rightPanelVideoArea">
                        <h4>Meet Sanjana Deshpande</h4>
                        <a class="videoPlay" href="https://www.youtube.com/watch?v=yAoLSRbwxL8">
                            <div class="videoImg">
                                <img src="images/video-dummy-image.jpg" class="img-responsive" title="video" alt="">
                                <div class="videoIconOuter">
                                    <div class="videoIconInner">
                                        <div class="videoIcon">
                                            <img src="images/icons/video-icon.png" alt="">
                                        </div><!-- videoIcon -->
                                    </div><!-- videoIconInner -->
                                </div><!-- videoIconOuter -->
                            </div><!-- videoImg -->
                        </a>
                        <p>Dayna Moser, a private wealth advisor and 2008 alum of the Ross School of Business MBA program, discusses how her experience at Ross was crucial in helping her discover and follow a passion for finance.</p>
                    </div><!-- rightPanelVideoArea -->
                </div><!-- col-md-3 -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn bigButton">Admission Process</a><br><br>
                    <a href="#" class="btn goToNextBtn">Go To Next</a><br><br>
                    <button type="reset" class="btn resetBtn">Reset</button><br><br>
                    <button type="submit" class="btn submitBtn">Submit</button><br><br>
                </div><!-- col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->

        <section class="faculty-propesion">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="customeaccordion">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="more-less glyphicon glyphicon-minus"></i>
                                          Teaching Philosophy
                                        </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                          <h5>Title</h5>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="more-less glyphicon glyphicon-plus"></i>
                                          Research Interests & Publications
                                        </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="panel-body">
                                        <h5>Title</h5>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- faculty-propesion -->
        

        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="well well-lg">
                        <p><span class="firstQuote">“</span>India can learn from the entrepreneurship spirit of Israel as well as employ Israel’s cyber sec tech for the larger  good of the India cyber space.<span class="lastQuote">”</span></p>
                    </div><!-- well -->
                </div><!-- col-md-10 -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Title</th>
                                    <th>Title</th>
                                    <th>Title</th>
                                    <th>Title</th>
                                    <th>Title</th>
                                    <th>Title</th>
                                </tr>
                            </thead><!-- thead -->
                            <tbody>
                                <tr>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                </tr>
                                <tr>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                </tr>
                                <tr>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                </tr>
                                <tr>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                    <td>There are many</td>
                                </tr>
                            </tbody>
                        </table><!-- table -->
                    </div><!-- table-responsive -->
                </div><!-- col-md-10 -->
            </div><!-- row -->
        </div><!-- container -->


        <section class="enquiryFormArea">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="enquiryHeading">
                            <h3>enquiry</h3>
                            <p>Please fill in the following information for our immediate action:</p>
                        </div><!-- enquiryHeading -->
                    </div><!-- col-md-12 -->
                </div><!-- row -->
                <div class="row ">
                    <div class="col-md-12 col-sm-12">
                        <div class="enquiryFormFieldArea">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6 col-md-offset-1">
                                        <div class="form-group">
                                            <label for="name">Name<span class="imp"> *</span></label>
                                            <input type="text" required class="form-control" id="fullname" name="fullname">
                                        </div><!-- form-group -->

                                        <div class="form-group">
                                            <label for="emailId">Email ID<span class="imp"> *</span></label>
                                            <input type="email" required class="form-control" id="emailId" name="emailId">
                                        </div><!-- form-group -->

                                        <div class="form-group">
                                            <label for="contact">Contact No<span class="imp"> *</span></label>
                                            <input type="text" required class="form-control" id="contact" name="contact">
                                        </div><!-- form-group -->
                                    </div><!-- col-md-5 -->


                                    <div class="col-md-5 col-sm-6">
                                        <div class="form-group">
                                            <label for="contact">Message<span class="imp"> *</span></label>
                                            <textarea class="form-control" required rows="5" id="message" name="message"></textarea>
                                        </div><!-- form-group -->
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <label for="exampleInputName2">Spam Check</label>
                                                <img src="images/spam-check.jpg" class="spanCheck" alt="">
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Enter Code</label>
                                                <input type="email" class="form-control" id="code" name="code">
                                            </div>
                                            <a href="#" class="btn">Refresh</a>
                                        </div><!-- form-inline -->
                                    </div><!-- col-md-5 -->
                                    <div class="col-md-10 col-md-offset-1 col-sm-12">
                                        <div class="indicateLine">
                                            <p><span class="imp">* </span>indicates a required field</p>
                                        </div><!-- indicateLine -->
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="enquiryFormButton">
                                            <button type="reset" class="btn resetBtn">Reset</button>
                                            <button type="submit" class="btn submitBtn">Submit</button>
                                        </div>    
                                    </div><!-- col-md-12 -->

                                </div><!-- row -->
                            </form><!-- form -->  
                        </div><!-- enquiryFormFieldArea -->
                    </div><!-- col-md-12 -->
                </div><!-- enquiryFormFieldArea -->
            </div><!-- container -->
        </section><!-- enquiryFormArea -->

        <section class="interviewStyle">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="media">
                            <div class="media-left">
                                <div class="interViewPerson  fill" style="background: url(images/interview-image.jpg);">
                                    
                                </div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Mr. Vishal Dharmadhikari</h4>
                                <p class="interviewerDesignation">Founder and CEO, India Cyber Connect</p>
                                <div class="interviewBy">
                                    <h6>Interview By :-</h6>
                                    <ul>
                                        <li>Samruddha Rathod, MBA I (Student)</li>
                                        <li>Gaurav Nikam, MBA I (Student)</li>
                                        <li>Sourabh Joshi, MBA II (Student)</li>
                                        <li>Prof Amol Randive, Assistant Professor (Faculty)</li>
                                    </ul>
                                </div><!-- interviewBy -->
                                <h5 class="interviewDate">Date: <span>13.09.2014</span></h5>
                            </div><!-- media-body -->
                        </div>
                    </div><!-- col-md-8 -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- interviewStyle -->

        <section class="horizontalTab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">TAbber  Heading</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">TAbber  Heading</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">TAbber  Heading</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div><!-- tabpanel -->
                            <div role="tabpanel" class="tab-pane" id="profile">2</div><!-- tabpanel -->
                            <div role="tabpanel" class="tab-pane" id="messages">3</div><!-- tabpanel -->
                        </div> 
                    </div><!-- col-md-12 -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- horizontalTab -->
        
        <section class="galleryStyle">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#galleryOne" aria-expanded="true">2016</a></li>

                            <li><a data-toggle="tab" href="#galleryTwo" aria-expanded="false">2015</a></li>
                            
                            <li><a data-toggle="tab" href="#galleryThree" aria-expanded="false">2014</a></li>

                            <li><a data-toggle="tab" href="#galleryFour" aria-expanded="false">2013</a></li>

                            <li><a data-toggle="tab" href="#galleryFive" aria-expanded="false">2012</a></li>

                        </ul>
                    </div><!-- col-md-3 -->
                    <div class="col-md-9 col-sm-8">
                        <div class="tab-content">
                            <div id="galleryOne" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-4 col-sm-6 col-xs-4">
                                        <div class="galleryImg">
                                            <a href="images/gallery/gallery-image.jpg" data-lightbox="image-1" >
                                                <img src="images/gallery/gallery-image.jpg" alt="sample-1" class="img-responsive">
                                            </a>
                                            <div class="galleryCaption">
                                                <h6>Cultural & Fun Events</h6>
                                            </div><!-- galleryCaption -->
                                        </div><!-- galleryImg -->
                                    </div><!-- col-md-4 -->
                                </div><!-- row -->
                            </div>
                            <div id="galleryTwo" class="tab-pane fade">
                                2
                            </div>
                            <div id="galleryThree" class="tab-pane fade">
                                3
                            </div>
                            <div id="galleryFour" class="tab-pane fade">
                                4
                            </div>
                            <div id="galleryFive" class="tab-pane fade">
                                5
                            </div>
                        </div>
                    </div><!-- col-md-6 -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- galleryStyle -->
        <section class="otherLinks">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="otherLinksHeading">Other Links</h4>
                    </div><!-- col-md-12 -->
                </div><!-- row -->
                <div class="otherLinksContentArea">
                    <div class="otherLinksBorder">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Mission and Vission</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder active">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Mission and Vission</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Leadership</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Leadership Leadership Leadership Leadership</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Leadership Leadership</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">  
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Leadership Leadership </p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">  
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Mission and Vission</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->
                    <div class="otherLinksBorder">
                        <a href="#">
                            <div class="otherLinksOuter">
                                <div class="otherLinksInner">
                                    <p>Mission and Vission</p>
                                </div>
                            </div><!-- otherLinksOuter -->
                        </a>
                    </div><!-- col-md-3 -->

                </div><!-- otherLinksContentArea -->
            </div><!-- container -->
        </section><!-- otherLinks -->

        */?>

    </div><!-- commonPageStyle -->
	
<?/*<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
	{
		echo $this->item->pagination;
	}
	?>

	<?php // Todo Not that elegant would be nice to group the params ?>
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<?php if ($params->get('show_title')) : ?>
			<h2 itemprop="headline">
				<?php echo $this->escape($this->item->title); ?>
			</h2>
		<?php endif; ?>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn hidden-print">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	endif;
	?>
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	<div itemprop="articleBody">
		<?php echo $this->item->text; ?>
	</div>

	<?php if ($info == 1 || $info == 2) : ?>
		<?php if ($useDefList) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
		<?php endif; ?>
		<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	<?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
	<?php // Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
	<?php $menu = JFactory::getApplication()->getMenu(); ?>
	<?php $active = $menu->getActive(); ?>
	<?php $itemId = $active->id; ?>
	<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
	<?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
	<p class="readmore">
		<a href="<?php echo $link; ?>" class="register">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $attribs->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
	<?php echo $this->item->event->afterDisplayContent; ?>
</div>*/?>