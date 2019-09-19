<?php 
$edit_data		=	$this->db->get_where('book' , array('book_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_book');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/book/do_update/'.$row['book_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="author" value="<?php echo $row['author'];?>"/>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                        </div>
                    </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="price" value="<?php echo $row['price'];?>"/>
                        </div>
                    </div>
                                  <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        <div class="col-sm-5">
                            <select name="class_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $class = $this->db->get('class')->result_array();
                                foreach($class as $row2):
                                ?>
                                    <option value="<?php echo $row2['class_id'];?>"
                                        <?php if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                                </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>  
                         <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="status" value="<?php echo $row['status'];?>"/>
                        </div>
                    </div>       
                            
             
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_book');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


