<div class="container-fluid">
    <div class="row-fluid">
        <?php if(!$type)
                die('your not allowed to do this action'); 
        ?>
            
        <?=form_open_multipart('deviceTypeManagement/update')?>
        
        <div class="btn-toolbar">
            <input type="submit" name="deviceTypeSubmit" value="Save" class="btn btn-primary">
            <?=anchor('deviceTypeManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#typeName" data-toggle="tab">type Name</a></li>
              <li><a href="#typeAttributes" data-toggle="tab">type attributes</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="typeName">
                     <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <label>Name</label>
                    <input type="text" name="name" value="<?=$type->name?>">
                    <input type="hidden" name="id" value="<?=$type->id?>">
                    
                </div>
                <div class="tab-pane fade" id="typeAttributes">
                    this is a tab
                </div>
            </div>

        </div>
<?=form_close()?>