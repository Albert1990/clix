<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <a href="<?=site_url('DeviceAttributeManagement/create')?>" class="btn btn-primary"><i class="icon-plus"></i>New assignment</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <table class="table myDataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>attribute english Name</th>
                    <th>attribute arabic Name</th>
                    <th>attribute Type</th>
                    <th>attribute unit</th>
                    <th style="width: 26px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($attrs){
                    $counter=1;
                    foreach( $attrs as $attr){
                ?>
                        <tr>
                            <td><?=$counter?></td>
                            <td><?=$attr->enName?></td>
                            <td><?=$attr->arName?></td>
                            <td><?=DeviceAttributeManagement::_generate_type($attr->attributeType)?></td>
                            <td><?=$attr->name?></td>
                            <td>
                                <a href="<?=site_url('DeviceAttributeManagement/edit/'.$attr->id)?>"><i class="icon-pencil"></i></a>

                                <a href="<?=site_url('DeviceAttributeManagement/delete/'.$attr->id)?>" role="button" class="btnDelete"><i class="icon-remove"></i></a>
                            </td>
                        </tr>
                        <?php
                        $counter++;
                    }
                }else{
                ?>
                    <tr>
                        <td>no attributes has been added yet <a href="<?=site_url('DeviceAttributeManagement/create')?>">add new</a></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <ul>
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
            </ul>
        </div>

<!--        <div class="modal small hide fade" id="deleteConfirmationDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
<!--                <h3 id="btnDelete">Delete Confirmation</h3>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>-->
<!--                <button class="btn btn-danger deleteBrand" data-dismiss="modal">Delete</button>-->
<!--            </div>-->
<!--        </div>-->