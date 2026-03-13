<div class="content-wrapper">
    <section class="content pb0">
    	<div class="row">
    		<div class="col-lg-6 col-md-6 col-sm-12">
	    		<div class="box box-primary borderwhite">
	                <div class="box-body direct-top-equal-scroll-22">
	                	<div class="row">
	                		<div class="col-lg-3 col-md-3 col-sm-3">
								<?php 
									if (!empty($student_data["image"])) {
                                        $file = base_url() . $student_data["image"].img_time();
                                    } else {                            
                                        if ($student_data['gender'] == 'Female') {
                                            $file = base_url() . "uploads/student_images/default_female.jpg".img_time();
                                        } else {
                                            $file = base_url() . "uploads/student_images/default_male.jpg".img_time();
                                        }
                                    }
								?>
							
	                			<img src="<?php echo $file.''.img_time(); ?>" class="img-rounded img-responsive img-h-150 mb-xs-1">						
								
	                		</div><!--./col-lg-3-->
	                		<div class="col-lg-9 col-md-9 col-sm-9">
								
								<?php 								
								if($attendence_percentage == '-1' ){ ?>
								
									<h4 class="mt0"><?php echo $this->lang->line('welcome'); ?>, <?php echo $studentsession_username; ?></h4>
									
								<?php } elseif($attendence_percentage > 0 && $attendence_percentage < $low_attendance_limit && $low_attendance_limit != '0.00' ){ ?>
								
									<h4 class="mt0"><?php echo $this->lang->line('welcome'); ?>, <?php echo $studentsession_username; ?>! <?php echo $this->lang->line('need_improvement'); ?>.</h4>
									<p class="text-danger"><?php echo $this->lang->line('your_current_attendance_is'); ?> <?php echo $attendence_percentage ; ?>% <?php echo $this->lang->line('which_is_lower_than');?> <?php echo $low_attendance_limit; ?>% <?php echo $this->lang->line('of_minimum_attendance_mark'); ?>. </p>				
								
								<?php } elseif($attendence_percentage > 0 && $attendence_percentage >= $low_attendance_limit && $low_attendance_limit != '0.00'){ ?>
								
									<h4 class="mt0"><?php echo $this->lang->line('welcome'); ?>, <?php echo $studentsession_username; ?>! <?php echo $this->lang->line('keep_going'); ?>.</h4>
									<p class="text-success  "><?php echo $this->lang->line('your_current_attendance_is'); ?> <?php echo $attendence_percentage ; ?>% <?php echo $this->lang->line('which_is_above'); ?> <?php echo $low_attendance_limit; ?>% <?php echo $this->lang->line('of_minimum_attendance_mark'); ?>.</p>	
									
								<?php }else{ ?>	
									
									<h4 class="mt0"><?php echo $this->lang->line('welcome'); ?>, <?php echo $studentsession_username; ?></h4>
								<?php } ?>
	                		 
	                		</div><!--./col-lg-10-->
	                	</div><!--./row-->
	                </div>
	            </div>   
	        </div><!--./col-lg-6-->
			<div class="col-lg-6 col-md-6 col-sm-12">	    		 
				<div class="box box-primary borderwhite">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('notice_board'); ?></h3>      
                    </div>
                    <div class="box-body pb0">
						<?php if(!empty($notificationlist)){ ?>
                    	<ul class="user-progress ps mb0">
                    		<?php for($i=0;$i<4;$i++){
                    			$notification = array();
                    			if(!empty($notificationlist[$i])){
	                    			$notification=$notificationlist[$i];
                                }
	                    	?>
	                    <?php if(!empty($notification)){ ?>
			                <li class="doc-file-type">			                   
				                <div class="set-flex">
					                <div class="media-title"><?php if(!empty($notification)){ ?>
									<a href="<?php echo base_url(); ?>user/notification" class="displayinline text-muted" target="_blank">
									
					                	<?php if ($notification['notification_id'] == "read") { ?>
                                            <img src="<?php echo base_url() ?>/backend/images/read_one.png">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>backend/images/unread_two.png">
                                        <?php }?>
										
										&nbsp;<?php  echo $notification['title']; ?> (<?php if(!empty($notification)){ echo "<i class='fa fa-clock-o text-aqua'></i>". ' '. date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['date']));} ?>)
					                </a><?php } ?>
									</div>                

			            		</div>   
				               
			                </li><!-- /.item -->
			            <?php } } ?>
			                
			            </ul>  
						<?php }else{ ?>
							<img src="https://smart-school.in/ssappresource/images/addnewitem.svg"  width="150" class="center-block mt20">
						<?php } ?>
                    </div>                   
                </div>	 
	        </div><!--./col-lg-6-->  
    	</div><!--./row-->	
		 
		
	</section>
</div>		