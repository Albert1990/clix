<div class="container-fluid">
    <div class="row-fluid">
        <?php if(!$type)
                die('your not allowed to do this action'); 
        ?>
            
        <?=form_open_multipart('attributeTypeManagement/update')?>
        
        <div class="btn-toolbar">
            <input type="submit" name="deviceTypeSubmit" value="Save" class="btn btn-primary">
            <?=anchor('attributeTypeManagement/index','Cancel','class="btn"')?>
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
                            'int'  => 'integer',
                            'float'    => 'number with a comma 0.0',
                            'string'   => 'plain text',
                        );
                        echo form_dropdown('type',$options,$type->type);
                    ?>
                    <input type="hidden" name="id" value="<?=$type->id?>">
                    
                </div>
            </div>

        </div>
<?=form_close()?>