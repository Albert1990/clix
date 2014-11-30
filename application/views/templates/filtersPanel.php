<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <div class="sidebar-header">
        Filter Devices
    </div>
    <div class="h-separator">
        <div></div>
    </div>

    <div class="filter-form-container">
        <div class="btn-group drop-list">
            <button type="button" class="btn btn-success">Brand</button>
            <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle"><span
                    class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a class="btnBrand" data-id="" href="#">All</a></li>
                <?php
                if ($brands) {
                    foreach ($brands as $brand) {
                        ?>
                        <li><a class="btnBrand" data-id="<?= $brand->id ?>" href="#"><?= $brand->name ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="sidebar-header">
        MyCart
    </div>
    <div class="h-separator">
        <div></div>
    </div>

</div>
<!--/.sidebar-offcanvas-->