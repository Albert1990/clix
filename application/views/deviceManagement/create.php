<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('deviceManagement/insert_step_1')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="next" class="btn btn-primary">
            <a href="<?php echo site_url('deviceManagement/cancel_inserting') ?>" class="btn">Cancel</a>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <?php echo validation_errors() ?>
                        <label>device Name</label>
                        <input type="text" class="input-xlarge" name="deviceName" value="<?php echo deviceManagement::_check_value($stored_sess_info,'deviceName'); ?>">

                        <label>device Type</label>
                        <?php echo form_dropdown('deviceType',$devices,deviceManagement::_check_value($stored_sess_info,'deviceTypeID')) ?>

                        <label>device brand</label>
                        <?php echo form_dropdown('deviceBrand',$brands,deviceManagement::_check_value($stored_sess_info,'brandID')) ?>
                        
                        <?php img(deviceManagement::_check_value($stored_sess_info,'devicePhoto')); ?>
                        <label>Photo</label>
                        <input type="file" name="userfile" class="input-xlarge">

                </div>
            </div>

        </div>
<?=form_close()?>