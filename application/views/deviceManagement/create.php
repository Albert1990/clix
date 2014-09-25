<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('deviceManagement/insert_1')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="next" class="btn btn-primary">
            <?=anchor('deviceManagement/index','Cancel','class="btn" data-toggle="modal"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <?php echo validation_errors() ?>
                        <label>device Name</label>
                        <input type="text" class="input-xlarge" name="deviceName">

                        <label>device Type</label>
                        <?php echo form_dropdown('deviceType',$devices,'') ?>

                        <label>device brand</label>
                        <?php echo form_dropdown('deviceBrand',$brands,'') ?>

                        <label>Photo</label>
                        <input type="file" name="userfile" class="input-xlarge">

                </div>
            </div>

        </div>
<?=form_close()?>