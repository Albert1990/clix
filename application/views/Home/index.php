<?php
if ($devices) {
    for ($i = 0; $i < count($devices); $i++) {
        ?>
        <div class="shelf"> <!-- new shelf   NOTE: this will become 2 shelfes on small screens-->
            <div class="col-xs-2 col-sm-1 shelf-edge-container"> <!-- the left Edge of the shelf-->
                <div class="shelf-bg-left shelf-edge-bg"></div>
            </div>
            <div class="col-xs-8 col-sm-10 shelf-mid-section">
                <!-- this is the variable-Width  part of the shelf  that contains the phones--->
                <div class="row" style="width: 100%; margin: 0;">
                    <?php
                    $brandDevices = $devices[$i];;
                    if ($brandDevices) {
                        foreach ($brandDevices as $device) {
                            ?>
                            <div class="col-xs-6 col-lg-2 col-md-4 shelf-cell shelf-cell-mid">
                                <img data-price="<?=$device->price?>" data-deviceID="<?=$device->deviceID?>" data-device4SaleID="<?=$device->device4SaleID?>" src="<?= base_url($device->devicePhoto) ?>" class="mob-img center-horizontaly"
                                     rel="tooltip" data-overview=""/>

                                <div class="mobile-sticker center-horizontaly"><?= $device->deviceName ?>"</div>
                                <div class="shelf-repeatable-bg"></div>
                            </div>
                        <?php
                        }
                    }
                    ?>


                </div>
                <div class="self-shadow_mid_bg self-shadow_mid"></div>
            </div>
            <div class="col-xs-2 col-sm-1 shelf-edge-container shelf-edge-container-right">
                <!-- the right Edge of the shelf-->
                <img src="<?= base_url($device->brandPhoto) ?>" class="brand-sticker"/>

                <div class="shelf-bg-right shelf-edge-bg"></div>
            </div>
        </div>
        <!-- end of shelf-->
    <?php
    }
}
?>
