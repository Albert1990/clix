<div class="container-fluid">
    <div class="row-fluid">
        
        <?=form_open_multipart('deviceManagement/insert_final')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="next" class="btn btn-primary">
            <a href="<?php echo site_url('deviceManagement/move_to_step_2') ?>" class="btn">back to step 2</a>
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
                    <?php echo validation_errors() ?>
                    <label>Price</label>
                    <input type="number" class="input-xlarge" name="price" value="<?php echo set_value('price') ?>">

                    <label>is New</label>
                    <input type="checkbox" name="isNew" value="1" />

                    <label>state</label>
                    <input type="number" name="state" value="<?php echo set_value('state') ?>" />%

                    

                </div>
            </div>

        </div>
<?=form_close()?>