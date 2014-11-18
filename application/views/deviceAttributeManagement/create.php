<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('DeviceAttributeManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <?=anchor('DeviceAttributeManagement/index','Cancel','class="btn" data-toggle="modal"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                        <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
                        <label>attribute English Name</label>
                        <input type="text" class="input-xlarge" name="enName">
                        
                        <label>attribute arabic Name</label>
                        <input type="text" class="input-xlarge" name="arName">


                        <?php if(isset($units) && is_array($units)): ?>
                            <label>attribute unit</label>
                            <?php echo form_dropdown('attributeUnitID',$units,'') ?>
                        <?php endif; ?>

                        <?php if(isset($types) && is_array($types)): ?>
                            <label>attribute type</label>
                            <?php echo form_dropdown('attributeTypeID',$types,'') ?>
                        <?php endif; ?>

                        

                </div>
            </div>

        </div>
<?=form_close()?>