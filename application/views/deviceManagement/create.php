<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('deviceManagement/insert')?>
        <div class="btn-toolbar">
            <input type="submit" name="deviceSubmit" value="Save" class="btn btn-primary">
            <?=anchor('deviceManagement/index','Cancel','class="btn" data-toggle="modal"')?>
<!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">

                        <label>Brand Name</label>
                        <input type="text" class="input-xlarge" name="name">
                        <label>Photo</label>
                        <input type="file" name="userfile" class="input-xlarge">

                </div>
            </div>

        </div>
<?=form_close()?>