<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('accessoireManagement/update')?>
        <input type="hidden" name="id" value="<?=$device->id?>">
        <input type="hidden" name="oldPicPath" value="<?=$device->photo?>">
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <?=anchor('accessoireManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
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
                    <br/><br/><br/>
                    <p>Labels</p>
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
                
            </div>

        </div>
<?=form_close()?>