<section class="content-header">
                    <h3>Exam Room View</h3>
                </section>
<?php 
					//echo "<pre>";
					//print_r($all_exam_hall);
					if(isset($all_exam_hall) && !empty($all_exam_hall))
					{
						foreach($all_exam_hall as $val)
						{
							?>
                            		
                                    <div class="box-title">
                                    	<div class="">
                                        	<table class="staff_table">
                                            	<tr>
                                                	<td>Block</td><td class="text_bold"><?=$val['block']?></td>
                                                    <td>Floor</td><td class="text_bold"><?=$val['floor']?></td>
                                                    <td>Room No</td><td class="text_bold"><?=$val['room_no']?></td>
                                                    <td>Total Seat</td><td class="text_bold"><?=$val['total_seat']?></td>
                                                </tr>
                                            </table>
                                        	
                                        </div>
                                    </div><br>
                                    
                                    <div class="row">
                                   
                                       <?php 
									   foreach($val['column'] as $k_cols=>$v_cols)
									   {
										   ?>
                                           <div class="col-md-2 div_class">
                                           <div class="sead_layout_list">
                                           <table>
                                            <tr style="height: 25px;">
                                           		<td style="text-align:center;"><b>Column-<?=$k_cols?></b></td>
                                           </tr>
                                           <?php 
										   foreach($v_cols as $seat)
										   {
										   ?>
                                           <tr style="height: 25px;">
                                           		<td style="text-align:center;"><b><?=$seat['seat_no']?></b>-(<?=$seat['std_no']?>)</td>
                                           </tr>
                                           <?php 
										   }
										   ?>    
                                          
                                           </table>
                                           </div>
                                           </div>
                                           
                                           <?php
									   }
									   ?>
                                       </div>
                                       <br />
                                        <a href="<?=$this->config->item('base_url').'seat/seat_arrangment/'?>" style="margin-right:10px;" class="btn btn-info left print_admin_use">Back</a>
					<input type="button" value="Print" class="btn btn-primary print_btn left" >
                                       <br /><br /><br />
                            <?php
						}
					}
					else
					{
						echo 'Exam Hall not created yet...';
					}
					?>
                   <style>
                   		@media print{
							.print_admin_use{ display:none;}
							.box,.box-info,.row,.content,.box-body,.table-responsive
							{
								overflow:hidden !important;
							}
							.sead_layout_list {
								background: #F0F0F0;
								padding: 10px;
								border-radius: 5px;
								border-bottom: 8px solid #000;
							}
							html, body { overflow-x: hidden; }
							.col-md-2 {
								width: 20.666666666666664%;
								float: left;
								position: relative;
								min-height: 1px;
								padding-right: 15px;
								padding-left: 15px;
							}
						}
                   </style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.print_btn').click(function(){
			window.print();	
		});	
	});
</script>