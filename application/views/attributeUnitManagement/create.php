<div class="container-fluid">
    <div class="row-fluid">
      
        <?=form_open_multipart('attributeUnitManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <?=anchor('attributeUnitManagement/index','Cancel','class="btn"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                          <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                        <label>unit Name</label>
                        <input type="text" class="input-xlarge" name="name" value="<?php set_value('name') ?>" />

                </div>
            </div>

        </div>
<?=form_close()?>