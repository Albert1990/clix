<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('DeviceAttributeManagement/update')?>
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
                        <input type="text" class="input-xlarge" name="enName" value="<?php echo $attribute->enName ?>" />
                        
                        <label>attribute arabic Name</label>
                        <input type="text" class="input-xlarge" name="arName" value="<?php echo $attribute->arName ?>">


                        <?php if(isset($units) && is_array($units)): ?>
                            <label>attribute unit</label>
                            <?php echo form_dropdown('attributeUnitID',$units,$attribute->deviceAttributeUnitID) ?>
                        <?php endif; ?>

                        <?php if(isset($types) && is_array($types)): ?>
                            <label>attribute type</label>
                            <?php echo form_dropdown('attributeTypeID',$types, $attribute->attributeTypeID) ?>
                        <?php endif; ?>

                        <input type="hidden" name="id" value=<?php echo $attribute->id ?> />

                </div>
            </div>

        </div>
<?=form_close()?>