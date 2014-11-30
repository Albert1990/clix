var debugMode = true;
var hostName = 'http://localhost/clix/index.php/';

$(document).ready(function () {
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
    $('.btnBrand').click(function (e) {
        e.preventDefault();
        var brandID = $(this).attr('data-id');
        window.location = hostName + "Home/index/" + brandID;
    });
});


var getDeviceSummarySuccess = function (target, data) {
    var template = _.template($('#devicePropertiesOverviewTemplate').html());
    var deviceProperties = data.deviceProps;
    if (deviceProperties) {
        var devicePropsHtml = template({props: deviceProperties});
        $('#tooltip').html(devicePropsHtml);
        init
    }
    else
        showLog('the device props is empty');
};

var getDeviceSummaryFailed = function () {
    showLog('error in getting device props');
};

$(function () {
    var targets = $('[rel~=tooltip]'),
        target = false,
        tooltip = false,
        title = false;

    targets.bind('mouseenter', function () {
        target = $(this);
        tooltip = $('<div id="tooltip"></div>');
        var deviceID = $(this).attr('data-deviceID');
        tip = 'wait ...';// target.attr('title');
        $.ajax({
            url: hostName + 'Home/getDeviceOverview',
            dataType: 'json',
            type: 'post',
            cache: true,
            success: function (data) {
                //target.removeAttr('title');
                tooltip.css('opacity', 0)
                    .html(tip)
                    .appendTo('body');
                //var target=$(this);
                //getDeviceSummarySuccess(target,data);
                var template = _.template($('#devicePropertiesOverviewTemplate').html());
                var deviceProperties = data.deviceProps;
                if (deviceProperties) {
                    var devicePropsHtml = template({props: deviceProperties});
                    //target.attr('title',devicePropsHtml);
                    $('#tooltip').html(devicePropsHtml);
                    $('#deviceOverview').append('<td>price</td><td>' + target.attr('data-price') + '</td>');
                    init_tooltip();
                    $(window).resize(init_tooltip);
                }
                else
                    showLog('the device props is empty');
            },
            error: getDeviceSummaryFailed,
            data: {deviceID: deviceID}
        });

        var init_tooltip = function () {
            if ($(window).width() < tooltip.outerWidth() * 1.5)
                tooltip.css('max-width', $(window).width() / 2);
            else
                tooltip.css('max-width', 340);

            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top = target.offset().top - tooltip.outerHeight() - 20;

            if (pos_left < 0) {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass('left');
            }
            else
                tooltip.removeClass('left');

            if (pos_left + tooltip.outerWidth() > $(window).width()) {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass('right');
            }
            else
                tooltip.removeClass('right');

            if (pos_top < 0) {
                var pos_top = target.offset().top + target.outerHeight();
                tooltip.addClass('top');
            }
            else
                tooltip.removeClass('top');

            tooltip.css({ left: pos_left, top: pos_top })
                .animate({ top: '+=10', opacity: 1 }, 300);
        };

        //init_tooltip();
        //$(window).resize(init_tooltip);

        var remove_tooltip = function () {
            tooltip.animate({ top: '-=10', opacity: 0 }, 300, function () {
                $(this).remove();
            });

            //target.attr( 'title', tip );
        };

        target.bind('mouseleave', remove_tooltip);
        //tooltip.bind('click', remove_tooltip);
    });
});

var showLog = function (msg) {
    if (debugMode) {
        console.log(msg);
    }
};