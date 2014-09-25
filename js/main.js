/**
 * Created with JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 5:37 PM
 * To change this template use File | Settings | File Templates.
 */
var deleteLink;
var usersNames;

$(document).ready(function(){

    $.ajax({
        cache:false,
        dataType:'json',
        url:'<?=site_url("UserManagement/getAllUsersNames")?>',
        success:function(data){
            for(var i=0;i<data.length;i++)
            {
                usersNames[i]=data[i]['userName'];
            }
        },
        error:function(){
            console.log('error');
        }
    });

    //console.log('hello samer');
    //$('.btnDelete').click(btnDeleteIsClicked);
    $('#txtUserName').autocomplete({
        source:usersNames,
        close:function(){
            console.log('closed');
        }
    });

});

btnDeleteIsClicked=function(e){
    e.preventDefault();
    console.log('show dialog');
    deleteLink=$(this).attr('href');
    $('#deleteConfirmationDialog').show();
};
