<div class="container-fluid">
    <div class="row-fluid">
        <?php if(!$item)
                die('your not allowed to do this action'); 
        ?>
            
        <?=form_open_multipart('DeviceAttributeTypeManagement/update')?>
        
        <div class="btn-toolbar">
            <input type="submit" name="deviceTypeSubmit" value="Save" class="btn btn-primary">
            <?=anchor('DeviceAttributeTypeManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                     <label>Device</label>
                        <?php
                            echo form_dropdown('device',$devices,$item->deviceTypeID);
                        ?>

                        <label>atributes</label>
                        <div class="bs-repeatable">
                            <?php
                              echo form_dropdown('attributes',$attributes,$item->deviceAttributeID);
                            ?>
                        </div><!-- end of bs-repeatable -->

                        <input type="hidden" name="id" value="<?php echo $item->id ?>" />
                    
                </div>
            </div>

        </div>
<?=form_close()?>