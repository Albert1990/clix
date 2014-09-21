<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <a href="<?=site_url('NewsManagement/create')?>" class="btn btn-primary"><i class="icon-plus"></i>New News</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <table class="table myDataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Device Name</th>
                    <th>Device Photo</th>
                    <th>Brand Photo</th>
                    <th>Date</th>
                    <th>Commands</th>
                    <th style="width: 26px;"></th>
                </tr>
                </thead>
                <tbody>
                <?
                if($userCarts)
                {
                $counter=1;
                foreach( $userCarts as $userCart)
                {
                    ?>
                    <tr>
                        <td><?=$counter?></td>
                        <td><?=$userCart->userName?></td>
                        <td><?=$userCart->mobileNumber?></td>
                        <td><?=$userCart->DeviceName?></td>
                        <td class="photoCol"><?=img($userCart->devicePhoto)?></td>
                        <td class="photoCol"><?=img($this->generateThumbPhoto($userCart->brandPhoto))?></td>
                        <td>
                            <a href="#" class="btnIsSeen" data-user-cart-id="<?=$userCart->id?>"><i class="icon-pencil">seen</i></a>
                        </td>
                    </tr>
                    <?
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

        <!--        <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
        <!--            <div class="modal-header">-->
        <!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
        <!--                <h3 id="myModalLabel">Delete Confirmation</h3>-->
        <!--            </div>-->
        <!--            <div class="modal-body">-->
        <!--                <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>-->
        <!--            </div>-->
        <!--            <div class="modal-footer">-->
        <!--                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>-->
        <!--                <button class="btn btn-danger deleteBrand" data-dismiss="modal">Delete</button>-->
        <!--            </div>-->
        <!--        </div>-->