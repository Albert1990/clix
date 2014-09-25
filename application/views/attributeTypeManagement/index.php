<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <a href="<?=site_url('attributeTypeManagement/create')?>" class="btn btn-primary"><i class="icon-plus"></i>New attribute type</a>
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
            <table class="table myDataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>attribute type</th>
                    <th style="width: 26px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($types)
                {
                    $counter=1;
                    foreach( $types as $type)
                    {
                        ?>
                        <tr>
                            <td><?=$counter?></td>
                            <td><?=$type->type?></td>
                            <td>
                                <a href="<?=site_url('attributeTypeManagement/edit/'.$type->id)?>"><i class="icon-pencil"></i></a>

                                <a href="<?=site_url('attributeTypeManagement/delete/'.$type->id)?>" role="button" class="btnDelete"><i class="icon-remove"></i></a>
                            </td>
                        </tr>
                        <?php
                        $counter++;
                    }
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