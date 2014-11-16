$(document).ready(function(){
    $('#lstBrands').change(getDevicesRelated2Brand);
});
getDevicesRelated2Brand=function(e){
    $brandId=$(this).val();
    var url='http://localhost/clix/';
    $.ajax({
        url: url,
        dataType: 'json',
        success: getDevicesSuccess,
        error: getDevicesError,
        timeout: ajaxCallTimeOut,
        cache: false,
        type: 'post',
        data: {tagsIds: searchTags}
    });
};
getDevicesSuccess=function(data){
    for(i=0;i<data.length;i++)
    {
        var deviceTemplate=$('#deviceTemplate').html();
        var deviceTemplateHtml=deviceTemplate({device:data[i]});
        $('#rrr').append(deviceTemplateHtml);
    }
};
getDevicesError=function(){
    console.log('error in getting devices');
};