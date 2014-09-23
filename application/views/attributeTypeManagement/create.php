<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('attributeTypeManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="brandSubmit" value="Save" class="btn btn-primary">
            <?=anchor('attributeTypeManagement/index','Cancel','class="btn" data-toggle="modal"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <label>attribute Name</label>
                        <?php
                            $options = array(
                              'none'   => 'none',
                              'int'  => 'integer',
                              'float'    => 'number with a comma 0.0',
                              'string'   => 'plain text',
                            );
                            echo form_dropdown('type',$options,'int');
                        ?>
                        

                </div>
            </div>

        </div>
<?=form_close()?>