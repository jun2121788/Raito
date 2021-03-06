<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */


    // meta tag robots
    if( osc_item_is_spam() || osc_premium_is_spam() ) {
        osc_add_hook('header','raito_teema_nofollow_construct');
    } else {
        osc_add_hook('header','raito_teema_follow_construct');
    }
	
	if(raito_teema_show_as() == 'gallery'){
        $loop_template	=	'loop-search-grid.php';
		$buttonClass = 'active';
    }else{
		$loop_template	=	'loop-search-list.php';
		$buttonClass = '';
	}

    $location = array();
	if( osc_item_address() !== '' ) {
        $location[] = osc_item_address();
    }	

    if( osc_item_city() !== '' ) {
        $location[] = osc_item_city();
    }
    if( osc_item_region() !== '' ) {
        $location[] = osc_item_region();
    }
    if( osc_item_country() !== '' ) {
        $location[] = osc_item_country();
    }	
	
    raito_teema_add_body_class('item');
	
    osc_current_web_theme_path('header.php') ;	
	
?>

<div class="row">

  <div class="col-sm-7 col-md-8">
  
    <div id="item-content">
	
      <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
	  
      <p id="edit_item_view"> <strong> <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow">
        <?php _e('Edit item', raito_teema_THEME_FOLDER); ?>
        </a> </strong> </p>
		
      <?php } ?>
	  
      <h1 class="title title_code"> <strong><?php echo osc_item_title(); ?></strong> </h1>
	  
      <ul class="item-header">
	  
	    <div class="madhouse_avaibility-custom"><?php osc_run_hook('item_detail', osc_item() ); ?></div>
		
        <li>
          <?php if( osc_price_enabled_at_items() ) { ?>
          <i class="fa fa-money"></i><?php echo osc_item_formated_price(); ?>
          <?php } ?>
        </li>
		
        <li>
          <?php if ( osc_item_pub_date() !== '' ) { printf( __('<i class="fa fa-calendar-o"></i> Published date: %1$s', raito_teema_THEME_FOLDER), osc_format_date( osc_item_pub_date() ) ); } ?>
        </li>
        <li>
          <?php if ( osc_item_mod_date() !== '' ) { printf( __('<span class="update"><i class="fa fa-calendar"></i> Modified date:</span> %1$s', raito_teema_THEME_FOLDER), osc_format_date( osc_item_mod_date() ) ); } ?>
        </li>
		
        <?php if (count($location) > 0) { ?>
        <li>
          <ul id="item_location">
            <li><i class="fa fa-map-marker"></i> <?php echo implode(' &#8226 ', $location); ?></li>
          </ul>
        </li>
			
        <?php }; ?>
		
		 <div id="custom_fields">
				  <?php if( osc_count_item_meta() >= 1 ) { ?>
				  <br />
				  <div class="meta_list">
					<?php while ( osc_has_item_meta() ) { ?>
					<?php if(osc_item_meta_value()!='') { ?>
					<div class="meta"> <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?> </div>
					<?php } ?>
					<?php } ?>
				  </div>
				  <?php } ?>
				</div>			
				
      </ul> 
	 	
	  
      <?php if( osc_images_enabled_at_items() ) { ?>
	  
      <div class="item-photos">
	  
        <div class="row">        
           
            <div class="col-md-10">
		  
				   <p><?php echo osc_item_description(); ?></p>
				   
					 <div class="main-image">					 
						
						<?php if( osc_count_item_resources() > 0 ) { ?>
						
							 <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php echo osc_esc_html(__('Image', raito_teema_THEME_FOLDER)); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>"> <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="95%" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-responsive"/> </a>
						<?php } ?>						
						
					</div>

				<?php osc_reset_resources(); ?>
		
		    </div>	
			
		<?php		  
		  
        if( osc_count_item_resources() > 0 ) {
            $i = 0;
        ?>			
		  
          <div class="col-md-2">
            <div class="thumbs">
              <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { 
			  if ($i != 0) {?>
              <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php echo osc_esc_html(__('Image', raito_teema_THEME_FOLDER)); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>"> <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="95%" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-responsive"/> </a>
              <?php }} ?>
            </div>
          </div>			

          <?php }  ?>
		  
        </div>
      </div>
      <?php } ?>	  

	 

		  <!-- SHARE BUTTONS -->
		  <ul class="contact_button">

		  <!-- Email
		  <a href="mailto:?Subject=EDIT THIS PART&Body=EDIT THIS PART #<?php echo osc_item_url() ; ?>" target="_blank"><img src="/oc-content/themes/repurpose/images/email.png" alt="Share by email" title="Share by email" /></a>-->
		  <!-- Facebook -->
		  

		  <!-- SHARE BUTTONS -->	
		  <li><a href="http://www.facebook.com/sharer.php?u=<?php echo osc_item_url() ; ?>" target="_blank"><i id="fa-custom" class="fa fa-facebook"></i></a></li>
		  <li><a href="https://plus.google.com/share?url=<?php echo osc_item_url() ; ?>" target="_blank"><i id="fa-custom" class="fa fa-google"></i></a></li>
		  <li><a href="http://twitter.com/share?url=<?php echo osc_item_url() ; ?>" target="_blank"><i id="fa-custom" class="fa fa-twitter"></i></a></li>	
		
		  <li>
		  <a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow">
			<i id="fa-custom" class="fa fa-envelope"></i>
		  </a>
		  </li>
		  
		</ul>
		
    </div>
   
    <?php if( osc_comments_enabled() ) { ?>
	
    <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
    <div id="comments">
      <?php if( osc_count_item_comments() >= 1 ) { ?>
      <h2 class="title">
        <?php _e('Comments', raito_teema_THEME_FOLDER); ?>
      </h2>
      <?php }
	  
	  ?>
      <ul id="comment_error_list">
      </ul>
      <?php CommentForm::js_validation(); ?>
      <?php if( osc_count_item_comments() >= 1 ) { ?>
      <div class="comments_list">
        <?php while ( osc_has_item_comments() ) { ?>
		
        <div class="comment">

		<div class="comment_author"><?php echo osc_comment_pub_date(); ?>
		
		
        <h4><?php echo osc_comment_author_name(); ?></h4>
		</div>
		<div class="comment_title"><?php echo osc_comment_title(); ?> </div>
		<div class="comment_content">
         
          <p><?php echo nl2br( osc_comment_body() ); ?> </p>
		  
		</div>
          <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
          <p> <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php echo osc_esc_html(__('Delete your comment', raito_teema_THEME_FOLDER)); ?>">
            <?php _e('Delete', raito_teema_THEME_FOLDER); ?>
            </a> </p>
          <?php } ?>
        </div>
        <?php } ?>
        <div class="pagination"> <?php echo osc_comments_pagination(); ?> </div>
      </div>
      <?php } ?>
      <div class="comment_form">
        <div class="title">
          <h1>
            <?php _e('Leave your comment (spam and offensive messages will be removed)', raito_teema_THEME_FOLDER); ?>
          </h1>
        </div>
        <div class="resp-wrapper">
          <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
            <fieldset>
              <input type="hidden" name="action" value="add_comment" />
              <input type="hidden" name="page" value="item" />
              <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
              <?php if(osc_is_web_user_logged_in()) { ?>
              <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
              <?php } else { ?>
              <div class="form-group">
                <label class="control-label" for="authorName">
                  <?php _e('Your name', raito_teema_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::author_input_text(); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="authorEmail">
                  <?php _e('Your e-mail', raito_teema_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::email_input_text(); ?>
                </div>
              </div>
              <?php }; ?>
              <div class="form-group">
                <label class="control-label" for="title">
                  <?php _e('Title', raito_teema_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::title_input_text(); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="body">
                  <?php _e('Comment', raito_teema_THEME_FOLDER); ?>
                </label>
                <div class="controls textarea">
                  <?php CommentForm::body_input_textarea(); ?>
                </div>
              </div>
              <div class="actions">
                <button type="submit" class="btn btn-success">
                <?php _e('Send', raito_teema_THEME_FOLDER); ?>
                </button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
  <div class="col-sm-5 col-md-4">
    <?php
		if(function_exists('show_qrcode')){
			echo '<div class="block_list block_listed">';
			show_qrcode();
			echo ' </div>';

		}
	?>
	
    <!-- <div class="alert_block">
      <?php if(!osc_is_web_user_logged_in() || osc_logged_user_id()!=osc_item_user_id()) { ?>
      <form action="<?php echo osc_base_url(true); ?>" method="post" name="mask_as_form" id="mask_as_form">
        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
        <input type="hidden" name="as" value="spam" />
        <input type="hidden" name="action" value="mark" />
        <input type="hidden" name="page" value="item" />
        <select name="as" id="as" class="mark_as">
          <option>
          <?php _e("Mark as...", raito_teema_THEME_FOLDER); ?>
          </option>
          <option value="spam">
          <?php _e("Mark as spam", raito_teema_THEME_FOLDER); ?>
          </option>
          <option value="badcat">
          <?php _e("Mark as misclassified", raito_teema_THEME_FOLDER); ?>
          </option>
          <option value="repeated">
          <?php _e("Mark as duplicated", raito_teema_THEME_FOLDER); ?>
          </option>
          <option value="expired">
          <?php _e("Mark as expired", raito_teema_THEME_FOLDER); ?>
          </option>
          <option value="offensive">
          <?php _e("Mark as offensive", raito_teema_THEME_FOLDER); ?>
          </option>
        </select>
      </form>
      <?php } ?>
    </div> -->	
	
    <?php osc_current_web_theme_path('item-sidebar.php'); ?>
  </div>
</div>

<?php related_listings(); ?>
<?php if( osc_count_items() > 0 ) { ?>

<div class="similar_ads">
  <h2 class="title">
    <?php _e('Related listings', raito_teema_THEME_FOLDER); ?>
  </h2>
  <?php
		View::newInstance()->_exportVariableToView("listType", 'items');
		osc_current_web_theme_path($loop_template);
    ?>
</div>

<?php } ?>

<?php osc_current_web_theme_path('footer.php') ; ?>