<div class="sidebar-nav">
    <form class="search form-inline">
        <input type="text" placeholder="Search...">
    </form>
    <?php
    $controllerName=$this->uri->segment(1);
    $dashboardControllers=["HomeManagement","BrandManagement","AdvertisementManagement","NewsManagement","SliderManagement","UserCartManagement"];
    $deviceControllers
    ?>
    <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
    <ul id="dashboard-menu" class="nav nav-list collapse in">
        <li <?=$controllerName=="HomeManagement" ? "class='active'":""?>><a href="<?=site_url('HomeManagement/index')?>">Home</a></li>
        <li <?=$controllerName=="BrandManagement" ? "class='active'":""?> ><a href="<?=site_url('BrandManagement/index')?>">Brands</a></li>
        <li <?=$controllerName=="AdvertisementManagement" ? "class='active'":""?>><a href="<?=site_url('AdvertisementManagement/index')?>">Advertisement</a></li>
        <li <?=$controllerName=="NewsManagement" ? "class='active'":""?>><a href="<?=site_url('NewsManagement/index')?>">News</a></li>
        <!--<li <?=$controllerName=="SliderManagement" ? "class='active'":""?>><a href="<?=site_url("SliderManagement/index")?>">Slider</a></li>-->
        <li <?=$controllerName=="UserCartManagement" ? "class='active'":""?>><a href="<?=site_url("UserCartManagement/showUnprocessed")?>">Unprocessed User Cart</a></li>
        <li <?=$controllerName=="UserCartManagement" ? "class='active'":""?>><a href="<?=site_url("UserCartManagement/showProcessed")?>">processed User Cart</a></li>

        <!--start devices tab here-->
        <li  <?=$controllerName=="deviceManagement" ? "class='active'":""?>><a href="<?=site_url('deviceManagement/index')?>">devices</a></li>
        <li <?=$controllerName=="accessoireManagement" ? "class='active'":""?>><a href="<?=site_url('accessoireManagement/index')?>">accessories</a></li>
        <li <?=$controllerName=="deviceTypeManagement" ? "class='active'":""?>><a href="<?=site_url('deviceTypeManagement/index')?>">device Types</a></li>
        <li <?=$controllerName=="deviceAttributeManagement" ? "class='active'":""?>><a href="<?=site_url('deviceAttributeManagement/index')?>">devices attributes</a></li>
        <li <?=$controllerName=="DeviceAttributeTypeManagement" ? "class='active'":""?>><a href="<?=site_url('DeviceAttributeTypeManagement/index')?>">assign attributes to devices</a></li>
        <li <?=$controllerName=="BrandManagement" ? "class='active'":""?>><a href="<?=site_url('BrandManagement/index')?>">Brands</a></li>
        <li <?=$controllerName=="attributeTypeManagement" ? "class='active'":""?>><a href="<?=site_url('attributeTypeManagement/index')?>">attribute Types</a></li>
        <li <?=$controllerName=="attributeUnitManagement" ? "class='active'":""?>><a href="<?=site_url('attributeUnitManagement/index')?>">attribute Types unit</a></li>
    </ul>


    <!--
    <a href="#device-menu" class="nav-header" data-toggle="collapse"><i class="icon-mobile"></i>Devices</a>
    <ul id="device-menu" class="nav nav-list collapse">


    </ul>

    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Account<span class="label label-info">+3</span></a>
    <ul id="accounts-menu" class="nav nav-list collapse">
        <li ><a href="sign-in.html">Sign In</a></li>
        <li ><a href="sign-up.html">Sign Up</a></li>
        <li ><a href="reset-password.html">Reset Password</a></li>
    </ul>

    <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error Pages <i class="icon-chevron-up"></i></a>
    <ul id="error-menu" class="nav nav-list collapse">
        <li ><a href="403.html">403 page</a></li>
        <li ><a href="404.html">404 page</a></li>
        <li ><a href="500.html">500 page</a></li>
        <li ><a href="503.html">503 page</a></li>
    </ul>

    <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Legal</a>
    <ul id="legal-menu" class="nav nav-list collapse">
        <li ><a href="privacy-policy.html">Privacy Policy</a></li>
        <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
    </ul>


    <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
    <a href="faq.html" class="nav-header" ><i class="icon-comment"></i>Faq</a>
    -->
</div>