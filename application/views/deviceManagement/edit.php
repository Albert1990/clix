<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('deviceManagement/update')?>
        <input type="hidden" name="id" value="<?=$device->id?>">
        <input type="hidden" name="oldPicPath" value="<?=$device->photo?>">
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <a href="<?php echo site_url('deviceManagement/index') ?>" class="btn">Cancel</a>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#deviceInfo" data-toggle="tab">device info</a></li>
              <li><a href="#deviceAttributes" data-toggle="tab">device attributes</a></li>
              <li><a href="#deviceStatus" data-toggle="tab">device status</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="deviceInfo">
                    <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
                    <label>device Name</label>
                    <input type="text" class="input-xlarge" name="deviceName" value="<?php echo $device->name ?>" />

                    <label>device Type</label>
                    <?php echo form_dropdown('deviceType',$devices,$device->deviceTypeID) ?>

                    <label>device brand</label>
                    <?php echo form_dropdown('deviceBrand',$brands,$device->brandID) ?>

                    <label>Previous Photo</label>
                    <?=img($device->photo)?>
                    <label>Photo</label>
                    <input type="file" name="userfile" class="input-xlarge">
                    
                    
                </div>
                <div class="tab-pane in" id="deviceAttributes">
                     <?php 
                       if(isset($attributes) && is_array($attributes)){
                            foreach ($attributes as $attr){
                                echo '<label>'.$attr->enName.'</label>';
                                deviceManagement::_generate_field($attr->id,$attr->attributeType,$attr->value,$attr->property_id); 
                                echo " ".$attr->name;
                           } 
                       }
                    ?>
                </div>

                <div class="tab-pane in" id="deviceStatus">
                    <label>Price</label>
                    <input type="number" class="input-xlarge" name="price" value="<?php echo $status->price ?>">

                    <label>is New</label>
                    <?php 
                    $checked = '';
                    if($status->isNew == 1)
                        $checked = 'checked';
                    ?>
                    <input type="checkbox" name="isNew" value="1"  <?=$checked?> />

                    <label>state</label>
                    <input type="number" name="state" value="<?php echo $status->state ?>" />%

                    <!-- the id of the record status -->
                    <input type="hidden" name="recoed_id" value="<?php echo $status->id ?>" />%
                </div>
                
            </div>

        </div>
<?=form_close()?>