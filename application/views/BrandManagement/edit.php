<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('BrandManagement/update')?>
        <input type="hidden" name="id" value="<?=$brand->id?>">
        <input type="hidden" name="oldPicPath" value="<?=$brand->photo?>">
        <div class="btn-toolbar">
            <input type="submit" name="brandSubmit" value="Save" class="btn btn-primary">
            <?=anchor('BrandManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <label>Name</label>
                    <input type="text" name="name" value="<?=$brand->name?>">
                    <label>Previous Photo</label>
                    <?=img($brand->photo)?>
                    <label>Photo</label>
                    <input type="file" name="userfile" class="input-xlarge">

                </div>
                <div class="tab-pane fade" id="profile">
                    <form id="tab2">
                        <label>New Password</label>
                        <input type="password" class="input-xlarge">
                        <div>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
<?=form_close()?>