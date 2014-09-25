<div class="container-fluid">
    <div class="row-fluid">
        <?php if(!$unit)
                die('your not allowed to do this action'); 
        ?>
            
        <?=form_open_multipart('attributeUnitManagement/update')?>
        
        <div class="btn-toolbar">
            <input type="submit" name="deviceTypeSubmit" value="Save" class="btn btn-primary">
            <?=anchor('attributeUnitManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                     <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <label>Name</label>
                    <input type="text" name="name" value="<?=$unit->name?>">
                    <input type="hidden" name="id" value="<?=$unit->id?>">
                    
                </div>
            </div>

        </div>
<?=form_close()?>