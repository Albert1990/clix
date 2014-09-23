<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('DeviceAttributeTypeManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="brandSubmit" value="Save" class="btn btn-primary">
            <?=anchor('DeviceAttributeTypeManagement/index','Cancel','class="btn" data-toggle="modal"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <label>Device</label>
                        <?php
                            echo form_dropdown('device',$devices,'');
                        ?>

                        <label>atributes</label>
                        <div class="bs-repeatable">
                            <?php
                              echo form_dropdown('attributes[]',$attributes,'');
                            ?>
                            <a href="#" class="bs-addnew btn">add new</a>
                            <a href="#" class="bs-delete btn">delete</a>
                        </div><!-- end of bs-repeatable -->
                        

                        

                </div>
            </div>

        </div>
<?=form_close()?>