<!DOCTYPE html>
<html lang="en">
<?php
$this->view('templates/header1');
?>
<body>


<div class="clx-container">


    <div class="row header">

        <div class="col-sm-3 main-logo-container">
            <img src="<?=base_url('imgs/logo.png')?>" class="center-horizontaly hidden-xs"/>
        </div>

        <div class="col-sm-7">
            <nav class="navbar navbar-default" role="navigation"> <!-- Static navbar -->
                <div class="container-fluid" style="padding-left:0;">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <img src="<?=base_url('imgs/icon_nav_list.png')?>"/>
                        </button>
                        <button type="button" class=" btn-xs visible-xs btn-side-duck-toggle" data-toggle="offcanvas">
                            <img src="<?=base_url('imgs/icon_nav_filter.png')?>"/></button>
                        <a class="navbar-brand hidden-lg visible-xs-block" href="#"><img src="<?=base_url('imgs/logo.png')?>"
                                                                                         width="100px"/></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Devices</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sell Your phone</a></li>
                            <li class=" visible-xs "><a href="#">MyCart - 0</a></li>
                            <!-- NOTE  there is another link to MyCart here , it will be used only on small screens-->
                        </ul>
                        <div class="nav navbar-nav navbar-right">
                            <div class="col-sm-12 col-md-12 pull-right">
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control glowing-border nav-searchbox"
                                               placeholder="Search" name="q">

                                        <div class="input-group-btn ">
                                            <button class="btn btn-success nav-searchbox " type="submit"><i
                                                    class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!--/.container-fluid -->

                <!--				<p class="pull-right visible-xs">
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">إظهار الفلاتر</button>
                                </p>-->
            </nav>
        </div>

        <div class="col-sm-2"> <!-- cart btn container     in the right-most of the header-->
            <div class=" hidden-xs">
                <img src="<?=base_url('imgs/ic_delivery.png')?>" class="center-horizontaly"/>

                <div class="cart-data center-horizontaly">My Delivery Cart - 0</div>
                <div style="height:70px" class="v-separator">
                    <div></div>
                </div>
            </div>
        </div>

        <div class="col-sm-9 col-lg-9 slogan-container hidden-xs">
            Your mobile Delivered to you
            <div class="h-separator" style="width: 70%; margin-top: 10px;">
                <div></div>
            </div>
        </div>
    </div>
    <!-- header  row -->

    <div class="row row-offcanvas row-offcanvas-right">


        <div id="selfs-container" class="col-xs-12 col-sm-9">
            <?=$this->view($viewName)?>
        </div>
        <?php
        $this->view('templates/filtersPanel');
        ?>
    </div>
    <!--/row-->


    <footer>
        <div class="h-separator">
            <div></div>
        </div>
        <p>&copy; Brain-socket.com</p>
    </footer>


</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?= base_url('js/jquery.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?= base_url('../../assets/js/ie10-viewport-bug-workaround.js') ?>"></script>
<script src="<?= base_url('js/script.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('js/underscore-min.js')?>"></script>
</body>
</html>