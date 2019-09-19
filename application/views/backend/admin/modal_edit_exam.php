<?php 
$edit_data		=	$this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_exam');?>
            	</div>
               </div>
                    
                    	<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/exam/do_update/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('exam_name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                             <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" name="date" value="<?php echo $row['date'];?>"/>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="<?php echo $row['comment'];?>"/>
                        </div>
                    </div>  
                     
                            
                            <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_exam');?></button>
						</div>
					</div>
                
                    </div>
        </div>
</div>
</div>

<?php
endforeach;
?>


