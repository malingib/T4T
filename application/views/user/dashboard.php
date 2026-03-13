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
								<h4 class="mt0"><?php echo $this->lang->line('welcome'); ?>, <?php echo $studentsession_username; ?></h4>
								<div class="wallet-box" style="background: #f4f4f4; padding: 15px; border-radius: 5px; border-left: 5px solid #00a65a; margin-top: 10px;">
									<h5 style="margin: 0; color: #555;">Wallet Balance</h5>
									<h2 style="margin: 5px 0; color: #00a65a;"><?php echo $this->customlib->getSchoolCurrencyFormat() . number_format($wallet_balance, 2); ?></h2>
									<a href="<?php echo base_url('user/user/fees'); ?>" class="btn btn-xs btn-success">Top Up Balance</a>
								</div>
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
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info borderwhite">
					<div class="box-header with-border">
						<h3 class="box-title">Active Bereavement Cases</h3>
					</div>
					<div class="box-body">
						<?php if(!empty($active_cases)){ ?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Case Relative</th>
									<th>Relationship</th>
									<th>Target</th>
									<th>Collected</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($active_cases as $case){ ?>
								<tr>
									<td><?php echo $case['relative_name']; ?></td>
									<td><?php echo $case['relationship']; ?></td>
									<td><?php echo $this->customlib->getSchoolCurrencyFormat() . number_format($case['target_amount'], 2); ?></td>
									<td><?php echo $this->customlib->getSchoolCurrencyFormat() . number_format($case['collected_amount'], 2); ?></td>
									<td><a href="#" class="btn btn-xs btn-primary">Contribute</a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php } else { ?>
						<p>No active cases at the moment.</p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>		