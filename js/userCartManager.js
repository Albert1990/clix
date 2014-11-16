var projectUrl="http://localhost/clix/index.php/UserCartManagement/";
var selectedUserCartID=-1;

$(document).ready(function(){
    $('.btnIsProcessed').click(btnIsProcessedClicked);
});

btnIsProcessedClicked=function(e){
    e.preventDefault();
    var userCartID=$(this).attr('data-user-cart-id');
    selectedUserCartID=userCartID;
    processedPointer=this;
    $.ajax({
        url:projectUrl+'markAsProcessed',
        cache:false,
        dataType:'json',
        success:processedRequestCompleted,
        error:processedRequestError,
        data:{userCartID:userCartID},
        type:'post'
    });
};

processedRequestCompleted=function(data){
    if(data.flag)
    {
        //var parent=$(processedPointer).parent();
        //$(parent).html('done');
        $('#userCart'+selectedUserCartID).remove();
    }
};
processedRequestError=function(){
    console.log('processedRequestError...');
};