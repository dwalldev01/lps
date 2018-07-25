<?php 
/* 
Template Name: Registration Page
*/
get_header();?>     <!-- Header Area End Here --> 
      <!-- Inner Page Banner Area Start Here -->
      <div class="inner-page-banner-area1">
    <div class="container">
          <div class="pagination-area">
        <h1><?php the_title(); ?></h1>
                    <ul>
                       <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>				  
						
						<li><?php the_title(); ?></li>
                    </ul>
      </div>
        </div>
  </div>
      <!-- Inner Page Banner Area End Here -->
      <div class="clr" style="clear:both"></div>
      <p>&nbsp;</p>
      <div class="enrol-section">
    <div class="container">
          <div class="col-md-12">
        <?php 
		if ( is_wp_error( $reg_errors ) )
			{ 			 
				foreach ( $reg_errors->get_error_messages() as $error ) {
						
					_e('<div class="alert alert-danger alert-dismissible">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong> ERROR :</strong>'.$error.'
				</div>'); 					 
				}			 
			}elseif ($_REQUEST['response']=='checkmailregistration')
			{
				global $registrationsuccessmessage;
					_e($registrationsuccessmessage);				
			}
		?>
              <label for="chkYes">
            <input type="radio" id="chkYes" name="chkPassPort" checked/>
            &nbsp; Member </label>
              <label for="chkNo" >
            <input type="radio" id="chkNo" name="chkPassPort" />
            &nbsp; Trainer </label>
              <hr />
              <div id="dvPassport" style="display: none">
                     <form method="post" action="" id="member"> 
						<input type="hidden" name="referer" value="<?php _e(get_page_link(get_option('cm_register_page_id'))); ?>" >
					   <?php wp_nonce_field( 'member_registration', 'member_register' ); ?>
					   <input type="hidden" name="action" value="member_registration" >
                        <div class="col-md-12"> 
                              <div class="col-md-3 no-padding"> 
                              <div class="form-group"> 
                                 <select class="form-control" required name="title">
                                        <option value="" selected="">Title</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Miss.">Miss.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Mdm.">Mdm.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Other">Other</option>
                                 </select>
                             </div>
                          </div>
                              <div class="col-md-1 no-padding"> </div>
                              <div class="col-md-7 no-padding">
                                   <div class="form-group">
                                  <input name="full_name" placeholder="Full Name" class="form-control" id="full_name" type="text" required >
                                </div>
                              </div>
                       </div>
					    <div class="col-md-12">
                                    <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                          <label>&nbsp;</label>
                                    </div>
                              </div>
                                    <div class="col-md-7 no-padding">
                                <div class="form-group">
                                    <label for="user_login"></label>
                                      <input name="user_login" placeholder="Login ID" class="form-control" id="user_login" type="text" required >
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-12">
                                    <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                          <label>&nbsp;</label>
                                    </div>
                              </div>
                                    <div class="col-md-7 no-padding">
                                <div class="form-group">
                                    <label for="email"></label>
                                      <input name="user_email" placeholder="E Mail" class="form-control" id="email" type="email" required >
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                                   <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="confirm_email"></label>
                                         <input name="confirm_email" placeholder="Confirmation E mail" class="form-control"  id="confirm_email" type="email" required >
                                       </div>
                                  </div>
                        </div>
						 <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                                   <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="organization"></label>
                                         <input name="organization" placeholder="Organization" class="form-control"  id="organization" type="text" required >
                                       </div>
                                  </div>
                        </div>
						 
						  <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                                   <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="working_place"></label>
                                         <input name="working_place" placeholder="Working place" class="form-control"  id="working_place" type="text" required >
                                       </div>
                                  </div>
                        </div>
						  <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                                   <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="destination"></label>
                                         <input name="destination" placeholder="Destination" class="form-control"  id="destination" type="text" required >
                                       </div>
                                  </div>
                        </div>
							 <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
								  
 <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="country_name"></label>
                                       <select class="form-control" name="user_type" required >
									   <option value="">User Type</option>
									   <option value="Individual">Individual</option>
									    <option value="Cooperate">Cooperate</option>
									   </select>
                                       </div>
                                  </div>
                        </div>	  
						
						
						 <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
								  
                                   <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                           <label for="country_name"></label>
                                       <select class="form-control" name="country_name" required >
									   <option value="">Select Country</option>
									   <?php
global $countries;
foreach($countries as $key => $value) { 
?>
<option value="<?php _e($key); ?>" title="<?php _e(htmlspecialchars($value)); ?>"><?php _e(htmlspecialchars($value)); ?></option>
<?php

}

?>
									   </select>
                                       </div>
                                  </div>
                        </div>
                        <div class="col-md-12">
                                   <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                        <div class="col-md-7 no-padding">
                                   <div class="form-group">
                 <div class="g-recaptcha" data-sitekey="<?php _e(GOOGLE_CAPTCHA_PUBLIC_KEY);?>"></div>
                        </div>
                        </div>
                        </div>
                     
                         <div class="col-md-12">
                             <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
								   <div class="col-md-3">
                                   <div class="form-group">
                                       <button class="default-big-btn2 res" type="submit" name="sub" id="sub" value="">Register & Submit</button>
                                   </div>
                              </div>
                             <div class="col-md-3">
                                   <div class="form-group">
                                   <button class="default-big-btn2 res" type="reset" value="">Reset</button>
                                   </div>
                            </div>
                       
                         </div>
                        
                    </form> 
                     
              </div>
              <div id="dvPassport1" style="display: none">
                    <form method="post"action="" id="trainer" enctype="multipart/form-data">
                        <div class="col-md-12">
                              <div class="col-md-3 no-padding">
                              <div class="form-group">
                               <select class="form-control" name="title">
                                <option value="0" selected="">Title</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Mdm.">Mdm.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Other">Other</option>
                              </select>
                                </div>
                          </div>
                              <div class="col-md-1 no-padding"> </div>
                              <div class="col-md-8 no-padding">
                            <div class="form-group">
                                  <input name="trainername" placeholder="Full Name" class="form-control" type="text" id="trainername" required >
                                </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4 no-padding">
                            <div class="form-group">
                                  <label>&nbsp;</label>
                                </div>
                          </div>
                            <div class="col-md-8 no-padding">
                            <div class="form-group">
                                  <input name="traineremail" id="traineremail" placeholder="E Mail" class="form-control" type="email" required>
                                </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <div class="form-group">
                                  <label>&nbsp;</label>
                                </div>
                          </div>
                              <div class="col-md-8 no-padding">
                            <div class="form-group">
                                  <input name="confirm_email" placeholder="Confirmation E mail" class="form-control" type="text" type="email" required="required">
                                </div>
                          </div>
                            </div>
                        <div class="col-md-12">
                              <div class="col-md-3 no-padding">
                            <div class="form-group">
                                  <input name="trainingyear" placeholder="Number of years in training" class="form-control" type="text" required>
                                </div>
                          </div>
                              <div class="col-md-1 no-padding"> </div>
                              <div class="col-md-8 no-padding">
                            <div class="form-group">
                                  <input name="qualification" placeholder="Qualification" class="form-control" type="text" required>
                                </div>
                          </div>
                            </div>
                        <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <label>List of Courses intent to Conduct</label>
                          </div>
                              <div class="col-md-6 no-padding">
                            <div class="form-group">
                                  <textarea rows="4" cols="80" name="address"></textarea>
                                </div>
                          </div>
                            </div>
                        <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <div class="form-group">
                                  <label>Photo Upload</label>
                                </div>
                          </div>
                              <div class="col-md-8 no-padding">
                            <div class="imageupload panel panel-default">
                                  <div class="panel-heading clearfix">
                                <h3 class="panel-title pull-left">Upload Photo</h3>
                                <div class="btn-group pull-right">
                                      <button type="button" class="btn btn-default active">File</button>
                                      <button type="button" class="btn btn-default">URL</button>
                                    </div>
                              </div>
                                  <div class="file-tab panel-body">
                                <label class="btn btn-default btn-file"> <span>Browse</span> 
                                      <!-- The file is stored here. -->
                                      <input type="file" name="imagefile">
                                    </label>
                                <button type="button" class="btn btn-default">Remove</button>
                              </div>
                                  <div class="url-tab panel-body">
                                <div class="input-group">
                                      <input type="text" class="form-control hasclear" placeholder="Image URL">
                                      <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">Submit</button>
                                  </div>
                                    </div>
                                <button type="button" class="btn btn-default">Remove</button>
                                <!-- The URL is stored here. -->
                                <input type="hidden" name="image-url">
                              </div>
                                </div>
                            <!-- bootstrap-imageupload method buttons. --> 
                            
                          </div>
                            </div>
                        <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <div class="form-group">
                                  <label>Resume Upload</label>
                                </div>
                          </div>
                              <div class="col-md-8 no-padding">
                            <div class="imageupload panel panel-default doccontainer">
                                  <div class="panel-heading clearfix">
                                <h3 class="panel-title pull-left">Multi Document Upload</h3>
                                   <div class="btn-group pull-right">
                                      <button type="button" class="btn btn-default active">File</button>
                                      <button type="button" class="btn btn-default">URL</button>
                                    </div>
                              </div>
                                  <div class="file-tab panel-body">
                                <label class="btn btn-default btn-file"> <span>Browse</span> 
                                      <!-- The file is stored here. -->
                                      <input type="file" name="doc-file" id="doc-file" >
                                    </label>
                                <button type="button" class="btn btn-default">Remove</button>
                              </div>
                                  <div class="url-tab panel-body">
                                <div class="input-group">
                                      <input type="text" class="form-control hasclear" placeholder="Image URL">
                                      <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">Submit</button>
                                  </div>
                                    </div>
                                <button type="button" class="btn btn-default">Remove</button>
                                <!-- The URL is stored here. -->
                                <input type="hidden" name="image-url">
                              </div>
                                </div>
                            <!-- bootstrap-imageupload method buttons. --> 
                            
                          </div>
                            </div>
                            
                            <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <div class="form-group">
                                 
                                </div>
                          </div>
                              
                        <div class="col-md-8 no-padding">
                              <div class="form-group acta">
                            <label>
                                  <input type="checkbox">
                                  I have completed "WSQ Advanced Certificate in Training and Assessment (ACTA)</label>
                          </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                              <div class="col-md-4 no-padding">
                            <div class="form-group">
                                 
                                </div>
                          </div>
                             
                              
                        <div class="col-md-8 no-padding">
                              <div class="form-group acta">
                            <label>
                                  <input type="checkbox">
                                  I have completed "Diploma in Adult and Continuing Education (DACE)</label>
                          </div>
                            </div>
                            </div>
                            
                           <div class="col-md-12">
                              <div class="col-md-3 no-padding">
                            <div class="form-group">
                                 
                                </div>
                          </div>
                              <div class="col-md-1 no-padding"> </div>
                              <div class="col-md-8 no-padding">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="<?php _e(GOOGLE_CAPTCHA_PUBLIC_KEY);?>"></div>
                                </div>
                          </div>
                            </div> 
                            
                            
                            
                            
                        <div class="col-md-12">
                            
                             <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                                  <div class="col-md-7 no-padding">
                                       <div class="form-group">
                                        <button class="default-big-btn2 reg" type="submit" name="submit" id="submit" value="">Register & Submit</button>
                                       </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                             <div class="col-md-4 no-padding">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                     </div>
                                  </div>
                             <div class="col-md-3">
                                   <div class="form-group">
                                   <button class="default-big-btn2 res" type="reset" value="">Reset</button>
                                   </div>
                            </div>
                            <div class="col-md-3">
                                   <div class="form-group">
                                        <a href="index.php" class="default-big-btn2 res"  type="submit" value="">Cancel</a>
                                 
                                   </div>
                              </div>
                         </div>
                     </form>   
                    
                     
           
   
             </div>
           
          </div>
     </div>
  </div>
      
      <!-- Footer Area Start Here -->
   <?php get_footer();?>
   <script>
$('.purchase-items-fieldset').each(function () {
    var $wrapper = $('.purchase-items-wrapper', this);
    $(".add-field", $(this)).click(function (e) {
        $('.purchase-items:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
    $('.purchase-items .remove-line', $wrapper).click(function () {
        if ($('.purchase-items', $wrapper).length > 1) $(this).parent('.purchase-items').remove();
    });
});
	</script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript">

function myFunction12() {
   if ($("#chkYes").is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
			 if ($("#chkNo").is(":checked")) {
                $("#dvPassport1").show();
            } else {
                $("#dvPassport1").hide();
            }
}
myFunction12();
    $(function () {
        $("input[name='chkPassPort']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
			 if ($("#chkNo").is(":checked")) {
                $("#dvPassport1").show();
            } else {
                $("#dvPassport1").hide();
            }
        });
    });
</script> 
<script>
      var filename = document.getElementById('doc-file'); 
            var namestt =  filename.files.item(0).name;
      
</script>
<script src="<?php bloginfo('template_url');?>/js/bootstrap-imageupload.js"></script> 

<script>
            var $imageupload = $('.imageupload');
          
            $imageupload.imageupload();

            $('#imageupload-disable').on('click', function() {
                $imageupload.imageupload('disable');
              
                $(this).blur();
            })

            $('#imageupload-enable').on('click', function() {
                $imageupload.imageupload('enable');
                $(this).blur();
            })

            $('#imageupload-reset').on('click', function() {
                $imageupload.imageupload('reset');
                $(this).blur();
            });
            
            /////////// Code Start for Doc Upload Function ///////////
        /* 
             var $imageuploaddoc = $('.doccontainer');
            $imageupload.$imageuploaddoc();

            $('#imageupload-disablenew').on('click', function() {
                $imageupload.$imageuploaddoc('disable');
              
                $(this).blur();
            })

            $('#imageupload-enablenew').on('click', function() {
                $imageupload.$imageuploaddoc('enable');
                $(this).blur();
            })

            $('#imageupload-resetnew').on('click', function() {
                $imageupload.$imageuploaddoc('reset');
                $(this).blur();
            }); */
            
        </script> 
<script>

  handleFileSelect = (evt) ->
    files = evt.target.files
    file = files[0]

    if files and file
      reader = new FileReader
      reader.trigger = this.id
      reader.filename = file.name
alert('2');
      reader.onload = (readerEvt) ->
        binaryString = readerEvt.target.result

        if this.trigger == "cover-letter"
          $('.js-cover-letter__textarea').val(this.filename + ":" + btoa(binaryString))
        else if this.trigger == "cv"
          $('.js-cv__textarea').val(this.filename + ":" + btoa(binaryString))

        swapIcon(this.trigger)

        return
      if file.size > 1000000
        alert("<p>File too large. Please select a file under 2MB.</p>")
        $(this).val(null)
        
      else if (!(/\.(doc|docx|pdf)$/i).test(file.name))
      
        alert("<p>Filetype not allowed. Please use .doc, .docx, .pdf only.</p>")
        $(this).val(null)
        
      else
        reader.readAsBinaryString file
    return

  if window.File and window.FileReader and window.FileList and window.Blob
    document.getElementById('cover-letter').addEventListener 'change', handleFileSelect, false
    document.getElementById('cv').addEventListener 'change', handleFileSelect, false
  else
    alert 'The File APIs are not fully supported in this browser.'
    
  swapIcon = (id) ->

    $('label[for=' + id + ']').css({"background-color" : "#006699"}).children('i.fa').removeClass('fa-upload').addClass('fa-check-square-o')
    
   
</script>