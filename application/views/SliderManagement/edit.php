<div class="container-fluid">
    <div class="row-fluid">

        <?=form_open_multipart('SliderManagement/update')?>
        <input type="hidden" name="id" value="<?=$slide->id?>">
        <input type="hidden" name="oldPicPath" value="<?=$slide->photo?>">
        <div class="btn-toolbar">
            <input type="submit" name="brandSubmit" value="Save" class="btn btn-primary">
            <?=anchor('SliderManagement/index','Cancel','class="btn"')?>
            <!--            <a href="#myModal" data-toggle="modal" class="btn">Cancel</a>-->
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <label>Language</label>
                    <select name="languageID">
                        <?
                        if($languages)
                        {
                            foreach($languages as $lang)
                            {
                                ?>
                                <option <?= $lang->id==$slide->languageID ? 'selected':'' ?> value="<?=$lang->id?>"><?=$lang->name?></option>
                            <?
                            }
                        }
                        ?>
                    </select>
                    <label>Title</label>
                    <input type="text" class="input-xlarge" name="title" value="<?=$slide->title?>">
                    <label>Text</label>
                    <textarea name="text" class="input-xlarge"><?=$slide->text?></textarea>
                    <label>Previous Photo</label>
                    <?=img($slide->photo)?>
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