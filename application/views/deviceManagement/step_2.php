<div class="container-fluid">
    <div class="row-fluid">
        
        <?=form_open_multipart('deviceManagement/insert_final')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="next" class="btn btn-primary">
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
                    <input type="hidden" name="deviceID" value="<?php echo $deviceID ?>" />
                        <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
                       <?php 
                       if(isset($attributes) && is_array($attributes)){
                            foreach ($attributes as $attr){
                                echo '<label>'.$attr->enName.'</label>';
                                deviceManagement::_generate_field($attr->id,$attr->attributeType); 
                                echo " ".$attr->name;
                           } 
                       }
                       
                           
                       ?>

                </div>
            </div>

        </div>
<?=form_close()?>