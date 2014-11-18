<div class="container-fluid">
    <div class="row-fluid">
        
        <?=form_open_multipart('deviceManagement/insert_step_2')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="next" class="btn btn-primary">
            <a href="<?php echo site_url('deviceManagement/create') ?>" class="btn">back to step 1</a>
            <a href="<?php echo site_url('deviceManagement/cancel_inserting') ?>" class="btn">Cancel</a>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <?php
            if(isset($message) && is_array($message)){ ?>
                <div class="alert <?=$message['css_class']?>">
                    <?=$message['msg']?>
                </div>
            <?php } ?>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
                       <?php 
                      

                       /*if the session has attributes*/
                       $attrs = null;
                       if(in_array('attributes',array_keys($stored_sess_info))){
                        $attrs = unserialize($stored_sess_info['attributes']);
                        var_dump($attrs);
                       }
                        
                       var_dump($attributes);

                       if(isset($attributes) && is_array($attributes)){                         
                            foreach($attributes as $attr){
                                /*checking the value of the attr*/
                                $field_array = deviceManagement::_check_value($attrs,$attr->id);

                                echo '<label>'.$attr->enName.'</label>';
                                deviceManagement::_generate_field($attr->id,$attr->attributeType,deviceManagement::_check_value($field_array,'value')); 
                                echo " ".$attr->name;
                           } 
                           
                       }
                       
                           
                       ?>

                </div>
            </div>

        </div>
<?=form_close()?>