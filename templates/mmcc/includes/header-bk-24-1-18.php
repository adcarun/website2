<nav class="navbar navbar-default header">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $this->baseurl; ?>" title="Marathwada Mitramandal's College of Commerce">
          	<!--<img src="images/logo.png" class="logo img-responsive" width="65">-->
			<?php echo $logo; ?>
            <span>
				<?php $siteTitle=explode("#",htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8')); ?>
            	<b><?php foreach ($siteTitle as $key => $valueTitle){ ?>
				<?php echo $valueTitle; ?><br/>
				<?php } ?>
				</b>
                <span class="tagline">
				<?php $siteDescription=explode("#",htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8')); ?>
				<?php foreach ($siteDescription as $key => $valueDesc){ ?>
				<?php echo $valueDesc; ?><br/>
				<?php } ?></span>
            </span>
          </a>
        </div>
		
        <div class="text-right top-social-container">
        <!--<p class="socialLinks">
            <a href="#" title="mail"><i class="fa fa-envelope" aria-hidden="true"></i></i></a>
            <a href="#" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#" title="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            <a href="#" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
       	</p>-->
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php
			$queryMainMenu = $db->getQuery(true);
			$queryMainMenu->select('*')
						 ->from($db->quoteName('#__menu'))
						 ->where($db->quoteName('menutype') . ' = ' . $db->quote('mainmenu'). ' and parent_id=1 and published=1' )
						 ->order($db->quoteName('lft').'ASC');
			$db->setQuery($queryMainMenu);
			$dataMainMenu = $db->loadObjectList();
		?>	
          <ul class="top_section nav navbar-nav navbar-right top-menu2">
			<?php foreach($dataMainMenu as $MainMenudata){ 
						$menusitem   = $app->getMenu()->getItem($MainMenudata->id);
						$paramsMainmenu = $menusitem->params; // get the params
		
						$queryMainMenuSub = $db->getQuery(true);
						$queryMainMenuSub->select('*')
						->from($db->quoteName('#__menu'))
						->where($db->quoteName('menutype') . ' = ' . $db->quote('mainmenu'). ' and parent_id='.$MainMenudata->id.' and published=1' )
						->order($db->quoteName('lft').'ASC');
						$db->setQuery($queryMainMenuSub);
						$dataMainMenusub = $db->loadObjectList(); 
						if(count($dataMainMenusub) > 0) {
				?>
				 <li class="dropdown">
					<a href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
								$queryaliasMenu = $db->getQuery(true);	 
								$queryaliasMenu->select(array('*'))
											   ->from($db->quoteName('#__menu'))
											   ->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
								$db->setQuery($queryaliasMenu);
								$dataalias = $db->loadObjectList();
								foreach($dataalias as $valalias){
									echo $this->baseurl."/index.php/".$valalias->path;
								}
								}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>" data-toggle="dropdown" title="<?php echo $MainMenudata->title; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MainMenudata->title; ?> </a>
					<ul class="dropdown-menu">
					<?php foreach($dataMainMenusub as $MainMenudatasub){
							$menusitemsub   = $app->getMenu()->getItem($MainMenudatasub->id);
							$paramsMainmenusub = $menusitemsub->params; // get the params
					?>
						<li><a href="<?php if($MainMenudatasub->type=="url"){ echo $MainMenudatasub->link; }elseif($MainMenudatasub->type=="alias"){ 
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
					<?php } ?>	
					</ul>
				</li>
			<?php }else{ ?>
				<li><a href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
							$queryaliasMenu = $db->getQuery(true);	 
							$queryaliasMenu->select(array('*'))
											->from($db->quoteName('#__menu'))
											->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
							$db->setQuery($queryaliasMenu);
							$dataalias = $db->loadObjectList();
							foreach($dataalias as $valalias){
								echo $this->baseurl."/index.php/".$valalias->path;
								}
							}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>" title="<?php echo $MainMenudata->title; ?>"><?php echo $MainMenudata->title; ?></a> </li>
			<?php } } ?>
		  
		  
          	<?/*<li><a href="#">Home</a></li>
            <li><a href="#">Enquiry</a></li>
            <!--<li><a href="#">IQAC</a></li>-->
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">IQAC</a>
              <ul class="dropdown-menu">
         
                	<li><a href="#">Objectives</a></li>
                    <li><a href="#">Current Composition</a></li>
                    <li><a href="#">Minutes of IQAC meetings</a></li>
                    <li><a href="#">Accreditation Details</a></li>
                    <li><a href="#">AQAR</a></li>
               
              </ul>
            </li>
            
            <li><a href="#">Feedback</a></li>
            <li><a href="#">Alumni</a></li>
            <li><a href="#">E Campus</a></li>
            <li><a href="#">Contact Us</a></li>   */?>       
          </ul>
        
          
        </div><!-- /.navbar-collapse -->
        
        <div class="header-btn-group">
			<?php if ($this->countModules('snap-menu')) : ?>	
				<jdoc:include type="modules" name="snap-menu" style="none" />
			<?php endif; ?>    	  	
          </div>
        
        </div>
            
        
      </div><!-- /.container-fluid -->
    </nav>
    
    <nav class="navbar navbar-default main-menu">
      <div class="container">
      	<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <!--<div class="navbar-brand menu-text">
          	Menu
          </div>-->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
		<?php	
			$queryMainMenu = $db->getQuery(true);
			$queryMainMenu->select('*')
						 ->from($db->quoteName('#__menu'))
						 ->where($db->quoteName('menutype') . ' = ' . $db->quote('top-menu'). ' and parent_id=1 and published=1' )
						 ->order($db->quoteName('lft').'ASC');
			$db->setQuery($queryMainMenu);
			$dataMainMenu = $db->loadObjectList();	
		?>	
          <ul class="nav navbar-nav">
		  <?php $cntMain=0; foreach($dataMainMenu as $MainMenudata){ 
						$menusitem   = $app->getMenu()->getItem($MainMenudata->id);
						$paramsMainmenu = $menusitem->params; // get the params
		
						$queryMainMenuSub = $db->getQuery(true);
						$queryMainMenuSub->select('*')
						->from($db->quoteName('#__menu'))
						->where($db->quoteName('menutype') . ' = ' . $db->quote('top-menu'). ' and parent_id='.$MainMenudata->id.' and published=1' )
						->order($db->quoteName('lft').'ASC');
						$db->setQuery($queryMainMenuSub);
						$dataMainMenusub = $db->loadObjectList();
											
						if(count($dataMainMenusub) > 0) {
			?>
          	<li class="dropdown <?php if($active->parent_id==$MainMenudata->id){?>active<?php } ?>">
              <a href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
								$queryaliasMenu = $db->getQuery(true);	 
								$queryaliasMenu->select(array('*'))
											   ->from($db->quoteName('#__menu'))
											   ->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
								$db->setQuery($queryaliasMenu);
								$dataalias = $db->loadObjectList();
								foreach($dataalias as $valalias){
									echo $this->baseurl."/index.php/".$valalias->path;
								}
								}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MainMenudata->title; ?> </a>
              <div class="dropdown-menu <?php if($cntMain >=6){ ?>dropdown-menu-right<?php } ?>">
                <div class="row">
				<div <?php if(count($dataMainMenusub) > 4){ ?>class="col col-sm-6"<?php }else{ ?>class="col col-sm-12"<?php } ?>><ul>
					<?php $cntinner=1; foreach($dataMainMenusub as $MainMenudatasub){
							$menusitemsub   = $app->getMenu()->getItem($MainMenudatasub->id);
							$paramsMainmenusub = $menusitemsub->params; // get the params
					?>  
                            <li>
							<a href="<?php if($MainMenudatasub->type=="url"){ echo $MainMenudatasub->link; }elseif($MainMenudatasub->type=="alias"){ 
						$queryaliasMenu = $db->getQuery(true);	 
						$queryaliasMenu->select(array('*'))
									   ->from($db->quoteName('#__menu'))
									   ->where($db->quoteName('id') . ' = ' . $paramsMainmenusub->get('aliasoptions'));
						$db->setQuery($queryaliasMenu);
						$dataalias = $db->loadObjectList();
						foreach($dataalias as $valalias){
							echo $this->baseurl."/index.php/".$valalias->path;
						}
						}else{ echo $this->baseurl."/index.php/".$MainMenudatasub->path; } ?>"><?php echo $MainMenudatasub->title; ?></a>
						
						<?php
							$queryMainMenuSubSub = $db->getQuery(true);
							$queryMainMenuSubSub->select('*')
							->from($db->quoteName('#__menu'))
							->where($db->quoteName('menutype') . ' = ' . $db->quote('top-menu'). ' and parent_id='.$MainMenudatasub->id.' and published=1' )
							->order($db->quoteName('lft').'ASC');
							$db->setQuery($queryMainMenuSubSub);
							$dataMainMenusubsub = $db->loadObjectList();
							if(count($dataMainMenusubsub) > 0){
						?>
						<ul class="subsubmenu">
						<?php foreach($dataMainMenusubsub as $subsubMenudata){
								$menusitemsubsub   = $app->getMenu()->getItem($subsubMenudata->id);
								$paramsMainmenusubsub = $menusitemsubsub->params; // get the params
						?>	
							<li><a href="<?php if($subsubMenudata->type=="url"){ echo $subsubMenudata->link; }elseif($subsubMenudata->type=="alias"){ 
						$queryaliasMenu = $db->getQuery(true);	 
						$queryaliasMenu->select(array('*'))
									   ->from($db->quoteName('#__menu'))
									   ->where($db->quoteName('id') . ' = ' . $paramsMainmenusubsub->get('aliasoptions'));
						$db->setQuery($queryaliasMenu);
						$dataalias = $db->loadObjectList();
						foreach($dataalias as $valalias){
							echo $this->baseurl."/index.php/".$valalias->path;
						}
						}else{ echo $this->baseurl."/index.php/".$subsubMenudata->path; } ?>"><?php echo $subsubMenudata->title; ?></a></li>
						<?php } ?>	
						</ul>
						<?php } ?>
						</li>
                       <?php if($cntinner%4==0){ ?>     
						</ul>
						</div>
						<div class="col col-sm-6"><ul>
                       <?php } ?>
                    
				<?php  $cntinner++; }  ?>	
                     </ul></div>
                </div>
              </div>
            </li>
			<?php }else{ ?>
				<li <?php if($active->id==$MainMenudata->id){?>class="active"<?php } ?>><a href="<?php if($MainMenudata->type=="url"){ echo $MainMenudata->link; }elseif($MainMenudata->type=="alias"){ 
							$queryaliasMenu = $db->getQuery(true);	 
							$queryaliasMenu->select(array('*'))
											->from($db->quoteName('#__menu'))
											->where($db->quoteName('id') . ' = ' . $paramsMainmenu->get('aliasoptions'));
							$db->setQuery($queryaliasMenu);
							$dataalias = $db->loadObjectList();
							foreach($dataalias as $valalias){
								echo $this->baseurl."/index.php/".$valalias->path;
								}
							}else{ echo $this->baseurl."/index.php/".$MainMenudata->path; } ?>" title="<?php echo $MainMenudata->title; ?>"><?php echo $MainMenudata->title; ?></a> </li>
			<?php } $cntMain++; } ?>
          	<?/*<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <!--<span class="caret"></span>--></a>
              <div class="dropdown-menu">
                <div class="row">
                	<div class="col col-sm-6">
                        <ul>
                            <li><a href="#">About Mandal</a></li>
                            <li><a href="#">About MMCC</a></li>
                            <li><a href="#">Vision Mission Values</a></li>
                            <li><a href="#">Foreword by Executive Principal</a></li>
                        </ul>
                    </div>
                    <div class="col col-sm-6">
                        <ul>
                            <li><a href="#">Foreword by Principal</a></li>
                            <li><a href="#">Vice Principal</a></li>
                            <li><a href="#">Organogram</a></li>
                        </ul>
                    </div>
                </div>
              </div>
            </li>
            <li><a href="#">Governance</a></li>
            <li><a href="#">Awards & Achievements</a></li>
            <li><a href="#">Admissions</a></li>
            <li><a href="#">Academics</a></li>
            <li><a href="#">Faculty & Staff</a></li>
            <li><a href="#">Research & Publications</a></li>
            <li><a href="#">Placements</a></li>
            <li><a href="#">MoUs</a></li>
            <li><a href="#">Campus Life</a></li>
            <li><a href="#">Infrastructure</a></li>
			*/?>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
              <div class="dropdown-menu dropdown-menu-right menu-search-form">
                <form class="form-inline">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Choose Program">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Choose Course">
                  </div>
                  <button type="submit" class="btn btn-default">Search</button>
                </form>
              </div>
            </li>-->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>