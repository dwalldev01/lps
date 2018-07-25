    
		<div class="col-sm-3 col-md-3">
		<ul class="list-group">
		<li class="list-group-item <?php if($post->ID==get_option('cm_account_page_id')) { ?>active <?php } ?>"><a class="btn-lg"  href="<?php if(get_option('cm_account_page_id')) { _e(get_page_link(get_option('cm_account_page_id'))); }else { _e('javascript:void();'); } ?>" ><?php _e("Edit Account"); ?></a>   </li>
		
		<li class="list-group-item"><a class="btn-lg"  href="<?php if(get_option('cm_account_page_id')) { _e(get_page_link(get_option('cm_account_page_id'))."#wppb-form-element-7"); }else { _e('javascript:void();'); } ?>"><?php _e("Change Password"); ?></a>   </li>
		
		<li class="list-group-item <?php if($post->ID==get_option('cm_history_page_id')) { ?>active <?php } ?>"><a class="btn-lg"  href="<?php if(get_option('cm_history_page_id')) { _e(get_page_link(get_option('cm_history_page_id'))); }else { _e('javascript:void();'); } ?>"><?php _e("User history"); ?></a>   </li>
		
		<li class="list-group-item">		
		<a class="btn-lg" href="<?php echo wp_logout_url(get_option('siteurl')); ?>"><?php _e("Logout"); ?></a> </li>
                          
                        </ul>
		</div>
		