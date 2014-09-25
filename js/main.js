/**
 * Created with JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 5:37 PM
 * To change this template use File | Settings | File Templates.
 */
var deleteLink;

$(document).ready(function(){

    //console.log('hello samer');
    //$('.btnDelete').click(btnDeleteIsClicked);
});

btnDeleteIsClicked=function(e){
    e.preventDefault();
    console.log('show dialog');
    deleteLink=$(this).attr('href');
    $('#deleteConfirmationDialog').show();
};
