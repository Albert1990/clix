/**
 * js/main.jd/ Java script main
 * Copyright (C) 2008-2014 Brain Socker <berainsocket.com>
 *
 * LICENSE: this program isn't open source
 * you don't have the right to copy it,use it, download it or use some part of it without
 * permission
 *
 * @package Clix
 * @version 0.1
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.jawsaqLabs.com
 */
var deleteLink;
var usersNames;

$(document).ready(function(){
	delete_disable();

	$('.bs-addnew').live('click',function(e){
		
			var $parent = $(this).parent();
			var $newcol = $(this).parent().clone();
			
			$parent.after($newcol);
			e.preventDefault();
			delete_disable();
	});
	

	$('.bs-delete').live('click',function(e){
		
			var $parent = $(this).parent();
			var $parent_class = $parent.attr('class');

			if($('.'+$parent_class).length > 1){
				$parent.remove();			
			}

			e.preventDefault();
			delete_disable();

	});


	$('.btnDelete').click(function(e){
		$ask = confirm('are you sure you want to delete?');
		if(!$ask){
			e.preventDefault();
		}

	});

	

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

var btnDeleteIsClicked = function(e){
    console.log('show dialog');
    deleteLink=$(this).attr('href');
    $('#deleteConfirmationDialog').show();
	e.preventDefault();
};

function delete_disable(){
	if($('.bs-repeatable').length == 1){
		$('.bs-delete').addClass('disabled');
	}else{
		$('.bs-delete').removeClass('disabled');
	}
}
