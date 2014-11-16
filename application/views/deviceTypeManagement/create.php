<div class="container-fluid">
    <div class="row-fluid">
      
        <?=form_open_multipart('deviceTypeManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <?=anchor('deviceTypeManagement/index','Cancel','class="btn"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#typeName" data-toggle="tab">type Name</a></li>
<!--              <li><a href="#typeAttributes" data-toggle="tab">type attributes</a></li>-->
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="typeName">
                          <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                        <label>Type Name</label>
                        <input type="text" class="input-xlarge" name="name" value="<?php set_value('name') ?>" />

                </div>
                <div class="tab-pane fade" id="typeAttributes">
                    this is a tab
                </div>
            </div>

        </div>
<?=form_close()?>