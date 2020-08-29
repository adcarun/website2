<footer>
	<div class="footerContainer">
       <div class="container">
       		<div class="row">
				
            	<div class="footerLinks col-md-2 col-sm-4 col-xs-6">
					<?php if ($this->countModules('footer-menu-quick-links')) : ?>
						<jdoc:include type="modules" name="footer-menu-quick-links" style="none" />  
					<?php endif; ?>
                </div>
                <div class="footerLinks col-md-2 col-sm-4 col-xs-6">
					<?php if ($this->countModules('footer-menu-compliances')) : ?>
						<jdoc:include type="modules" name="footer-menu-compliances" style="none" />  
					<?php endif; ?>
                </div>
                <div class="footerLinks col-md-2 col-sm-4 col-xs-6">
					<?php if ($this->countModules('footer-menu-examinations')) : ?>
						<jdoc:include type="modules" name="footer-menu-examinations" style="none" />  
					<?php endif; ?>
                </div>
                
                <div class="clearfix visible-sm-block"></div>
                
               <div class="footerLinks col-md-2 col-sm-4 col-xs-6">
					<?php if ($this->countModules('footer-menu-archives')) : ?>
						<jdoc:include type="modules" name="footer-menu-archives" style="none" />  
					<?php endif; ?>
                </div>
                <div class="footerLinks col-md-2 col-sm-4 col-xs-6">
					<?php if ($this->countModules('footer-menu-downloads')) : ?>
						<jdoc:include type="modules" name="footer-menu-downloads" style="none" />  
					<?php endif; ?>                	
                </div>
                
               
                
                
                <div class="clearfix visible-sm-block"></div>
                
                
                
            </div>
       </div>
    </div>
    
    <div class="footerContainer footerSocialContainer">
       <div class="container">
       		<div class="row">
                <div class="col-md-12 text-center">
                	<p class="socialLinks">
                    	<span>Connect With Us</span>
                       <!-- <a href="#" title="mail"><i class="fa fa-envelope" aria-hidden="true"></i></i></a>
                    	<a href="#" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" title="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a href="#" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
						<?php if ($this->countModules('social-links-footer')) : ?>	
						<jdoc:include type="modules" name="social-links-footer" style="none" />
						<?php endif; ?>
                    </p>
                </div>
            </div>
       </div>
    </div>
    
    <div class="container-fluid copyrightContainer">
       <div class="container">
       		<div class="row">
            	<div class="col-md-4">
                	<p>Copyright &copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>. All Rights Reserved</p>
                </div>
                <div class="col-md-4 text-center">
                	<p class="hidden-xs">Best viewed in IE 10+, Firefox 20+, Chrome , Safari5+, Opera12+ </p>
                </div>
				<div class="col-md-4">
				<!-- hitwebcounter Code START -->
<a href="https://www.hitwebcounter.com" target="_blank">
<img src="https://hitwebcounter.com/counter/counter.php?page=7544435&style=0001&nbdigits=5&type=page&initCount=0" title="Web Counter" Alt="counter free"   border="0" >
</a>             
</div>
                <div class="col-md-12">
                	<p>:::| <a style="text-decoration: none;" href="http://dimakhconsultants.com/" target="_blank" title="Website design development, Search Engine Optimization, Internet marketing, Web hosting, company in pune India, Web-Flash based designers &amp; consultants in Pune">powered by dimakh consultants</a> |:::</p>
                </div>
            </div>    
       </div>
    </div>
</footer>    
    <div class="floting-points">
    	<ul>
    		<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="fa fa-list-alt" aria-hidden="true"></i> Enquiry</a></li>
            
            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalFeedback"><i class="fa fa-list-alt" aria-hidden="true"></i> Feedback</a></li>
			
			<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalGrievance"><i class="fa fa-list-alt" aria-hidden="true"></i> Grievance</a></li>
            <!--<li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>    
        	<li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> Feedback</a></li>-->
        </ul>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Send Enquiry</h4> </div>
            <div class="modal-body">
                
                <div class="row" id="productForm">
					
                    <p class="popp">* mark fields are compulsory</p>
					<?php if ($this->countModules('enquiry-form')) : ?>	
						<jdoc:include type="modules" name="enquiry-form" style="none" />
					<?php endif; ?>                   
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" id="back-to-top" title="Back to top">
	<span class="glyphicon glyphicon-menu-up"></span>
</a>













<!-- feedback popup -->
<div class="modal fade bs-example-modal-lg" id="myModalFeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Feedback</h4> </div>
            <div class="modal-body">
                
                <div class="row" id="productForm">
                    
                    
                    <form>
                    <div class="col-md-12 selectForm" style="margin-bottom:20px;">
                    <label class="radio-inline">
<input name="inlineRadioOptions" id="employer" value="Students" checked="checked" novalidate="novalidate" type="radio">
Students    </label>
                    <label class="radio-inline">
<input name="inlineRadioOptions" id="employer" value="Parents" novalidate="novalidate" type="radio">
Parents         </label>

                    <label class="radio-inline">
<input name="inlineRadioOptions" id="employer" value="Recruiters" novalidate="novalidate" type="radio">
Recruiters         </label>

                    <label class="radio-inline">
<input name="inlineRadioOptions" id="employer" value="Faculty" novalidate="novalidate" type="radio">
Faculty          </label>

                    <label class="radio-inline">
<input name="inlineRadioOptions" id="employer" value="Alumni" novalidate="novalidate" type="radio">
Alumni     </label>

                    </div>
                   	</form>
                    <br />
                    
                     <div class="clearfix"></div>
                    
                    <div class="formContainer frmStudentContainer">
                    <form name="frmStudent" class="form-inline" action="<?php echo $this->baseurl?>/student-action.php" onreset="this.StudentName.focus();" method="post">
                    <div class="validateContainer">
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" name="StudentName" id="StudentName" maxlength="30" class="form-control validateRequired validateAlphaonly" placeholder="Name"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" name="StudentEmail" id="StudentEmail" maxlength="60" class="form-control validateRequired validateEmail" placeholder="Email"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" maxlength="10" name="StudentContact" id="StudentContact" class="form-control validateRequired validateNumber validateMobileNoLimit" placeholder="Cell No."> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="validateField">
                            <select name="SelectType" id="SelectType" class="form-control validateRequired">
                                <option value="">Select Type</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Appreciation">Appreciation</option>
                                <option value="Observation">Observation</option>
                                <option value="Grievance">Grievance</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="StudentProgramName" id="StudentProgramName" class="form-control" placeholder="Program Name"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="StudentDivision" id="StudentDivision" class="form-control" placeholder="Division"> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <textarea name="StudentFeedback" id="StudentFeedback" class="form-control" placeholder="Your Feedback"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" value="Send" class="btn btn-default checkValidationBtn">Submit</button>
                        <button type="reset" value="Reset" class="btn btn-default">Reset</button>
                    </div>
                    
                    </div>
                    </form>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="formContainer frmParentContainer" style="display: none;">
                <form name="frmParent" class="form-inline" action="<?php echo $this->baseurl?>/parent-action.php" onreset="this.ParentName.focus();" method="post">
                    <div class="validateContainer">
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" name="ParentName" id="ParentName" maxlength="30" class="form-control validateRequired validateAlphaonly" placeholder="Name"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" name="ParentEmail" id="ParentEmail" maxlength="60" class="form-control validateRequired validateEmail" placeholder="Email"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        	<div class="validateField">
                            <input type="text" maxlength="10" name="ParentContact" id="ParentContact" class="form-control validateRequired validateNumber validateMobileNoLimit" placeholder="Cell No."> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="validateField">
                            <select name="SelectType" class="form-control validateRequired">
                               <option value="">Select Type</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Appreciation">Appreciation</option>
                                <option value="Observation">Observation</option>
                                <option value="Grievance">Grievance</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="ChildrenProgram" id="ChildrenProgram" class="form-control" placeholder="Children Program"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="ChildrenBranch" id="ChildrenBranch" class="form-control" placeholder="Branch"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <textarea name="ParentFeedback" id="ParentFeedback" class="form-control" placeholder="Your Feedback"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" value="Send" class="btn btn-default checkValidationBtn">Submit</button>
                        <button type="reset" value="Reset" class="btn btn-default">Reset</button>
                    </div>
                    
                    </div>
                </form><!-- parent-form-end -->
                </div>
                
                <div class="clearfix"></div>

				<div class="formContainer frmRecruitersContainer" style="display: none;">
                <form name="frmRecruiters" class="form-inline" action="<?php echo $this->baseurl?>/recruiters-action.php" onreset="this.RecruitersName.focus();" method="post">
                    <div class="validateContainer">
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="RecruitersName" id="RecruitersName" maxlength="30" class="form-control validateRequired validateAlphaonly" placeholder="Name"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="RecruitersEmail" id="RecruitersEmail" maxlength="60" class="form-control validateRequired validateEmail" placeholder="Email"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="10" name="RecruitersContact" id="RecruitersContact" class="form-control validateRequired validateNumber validateMobileNoLimit" placeholder="Cell No."> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="validateField">
                            <select name="SelectType" id="SelectType" class="form-control validateRequired">
                                <option value="">Select Type</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Appreciation">Appreciation</option>
                                <option value="Observation">Observation</option>
                                <option value="Grievance">Grievance</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="RecruitersOrganisation" id="RecruitersOrganisation" class="form-control" placeholder="Organisation"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="DesignationOrganisation" id="DesignationOrganisation" class="form-control" placeholder="Designation"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <textarea name="RecruitersFeedback" id="RecruitersFeedback" class="form-control" placeholder="Your Feedback"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" value="Send" class="btn btn-default checkValidationBtn">Submit</button>
                        <button type="reset" value="Reset" class="btn btn-default">Reset</button>
                    </div>
                    
                    </div>
                </form><!-- parent-form-end -->
                </div>
                
                <div class="clearfix"></div>
                
                <div class="formContainer frmFacultyContainer" style="display: none;">
                <form name="frmFaculty" class="form-inline" action="<?php echo $this->baseurl?>/faculty-action.php" onreset="this.FacultyName.focus();" method="post">
                    <div class="validateContainer">
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="FacultyName" id="FacultyName" maxlength="30" class="form-control validateRequired validateAlphaonly" placeholder="Name"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="FacultyEmail" id="FacultyEmail" maxlength="60" class="form-control validateRequired validateEmail" placeholder="Email"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="10" name="FacultyContact" id="FacultyContact" class="form-control validateRequired validateNumber validateMobileNoLimit" placeholder="Contact"> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="validateField">
                            <select name="SelectType" id="SelectType" class="form-control validateRequired">
                                <option value="">Select Type</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Appreciation">Appreciation</option>
                                <option value="Observation">Observation</option>
                                <option value="Grievance">Grievance</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <textarea name="FacultyFeedback" id="FacultyFeedback" class="form-control" placeholder="Your Feedback"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" value="Send" class="btn btn-default checkValidationBtn">Submit</button>
                        <button type="reset" value="Reset" class="btn btn-default">Reset</button>
                    </div>
                    
                    </div>
                </form><!-- parent-form-end -->
                </div>
                
                <div class="clearfix"></div>
                
                <div class="formContainer frmAlumniContainer" style="display: none;">
                <form name="frmAlumni" class="form-inline" action="<?php echo $this->baseurl?>/alumni-action.php" onreset="this.AlumniName.focus();" method="post">
                    <div class="validateContainer">
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="AlumniName" id="AlumniName" maxlength="30" class="form-control validateRequired validateAlphaonly" placeholder="Name"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" name="AlumniEmail" id="AlumniEmail" maxlength="60" class="form-control validateRequired validateEmail" placeholder="Email"> </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="10" name="AlumniContact" id="AlumniContact" class="form-control validateRequired validateNumber validateMobileNoLimit" placeholder="Contact"> </div>
                            </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="validateField">
                            <select name="SelectType" id="SelectType" class="form-control validateRequired">
                                <option value="">Select Type</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Appreciation">Appreciation</option>
                                <option value="Observation">Observation</option>
                                <option value="Grievance">Grievance</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="AlumniProgramName" id="AlumniProgramName" class="form-control" placeholder="Program Name"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <input type="text" maxlength="20" name="AlumniBatch" id="AlumniBatch" class="form-control" placeholder="Batch"> </div>
                            </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="validateField">
                            <textarea name="AlumniFeedback" id="AlumniFeedback" class="form-control" placeholder="Your Feedback"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" value="Send" class="btn btn-default checkValidationBtn">Submit</button>
                        <button type="reset" value="Reset" class="btn btn-default">Reset</button>
                    </div>
                    
                    </div>
                </form><!-- parent-form-end -->  
                </div>
                  
                    <div class="clearfix"></div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="myModalGrievance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Send Grievance</h4> </div>
            <div class="modal-body">
                
                <div class="row" id="productForm">
					
                    <p class="popp">* mark fields are compulsory</p>
					<?php if ($this->countModules('grevience_form')) : ?>	
						<jdoc:include type="modules" name="grevience_form" style="none" />
					<?php endif; ?>                   
                </div>
            </div>
        </div>
    </div>
</div>




