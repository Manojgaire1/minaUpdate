function previewFile(thisObj) {
    var preview = $(thisObj).parent().find('img');
    var file    = thisObj.files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.attr('src');
        $(preview).attr('src',reader.result);
        $('#view-all-form').find('.img-thumb img').attr('src',reader.result);
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

$(document).ready(function() {
    $('img').addClass('img-fluid');


    // image upload




        removeUpload = function() {
            /*$('.file-upload-input').replaceWith($('.file-upload-input').clone());*/
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.file-upload-btn').show();

        }

        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });


// $('body').on('click','.modal-footer > .btn-secondary',function(){
//     removeUpload();
// });

$('.modal').on('hidden.bs.modal', function () {
    removeUpload();
});




        $('body').find('.upload-document input[type="file"]').each(function() {
        // get label text
        var label = 'Select a file';

        // wrap the file input
        $('body').find(this).wrap('<div class="input-file"></div>');
        // display label
        $('body').find(this).before('<span class="btn">' + label + '</span>');
        // we will display selected file here
        $('body').find(this).before('<span class="file-selected"></span>');

        // file input change listener
        $('body').find(this).change(function(e) {
            // Get this file input value
            var val = $(this).val();

            // Let's only show filename.
            // By default file input value is a fullpath, something like
            // C:\fakepath\Nuriootpa1.jpg depending on your browser.
            var filename = val.replace(/^.*[\\\/]/, '');

            // Display the filename
            $(this).siblings('.file-selected').text(filename);
        });
    });

    // Open the file browser when our custom button is clicked.
    $('body').find('.input-file .btn').click(function() {
        $(this).siblings('input[type="file"]').trigger('click');
    });

    $('body').find('.btn-advance-search').click(function() {
        $('.inner-search').slideToggle();
    });




    //show the datepicker
    $("#dropper-default").dateDropper({
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
    });

    $(".dropper-datepicker").dateDropper({
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
    });

    $('.savebtn').click(function() {
        $(this).parents('div.edit-item').find('.form-wrap').hide();
        $(this).parents('div.edit-item').find('.value').show();
        $(this).hide();
        $('span.edit').show();
    });


    $('span.edit').click(function() {
        $(this).parents('div.edit-item').find('.form-wrap').show();
        $(this).parents('div.edit-item').find('.value').hide();
        $(this).hide();
        $('.savebtn').show();
    });

    $('.delete-blocks span').click(function() {
        $(this).parents('div.parent-div').hide();
    });

    $('.mobile-menu').click(function() {
        $('.pcoded').toggleClass('pcoded-open');
    });

    $(document).on('shown.bs.tab', function(e) {
        var tab = $('#myTab');
        $(tab).find('li').each(function() {
            var tableId = $(this).find('a').attr('href');
            var tableDiv = $(tableId).find('div');
            if ($(this).find('a').hasClass('active') == false) {
                $(tableId).removeClass('active');
                $(tableId).removeClass('show');
            } else {
                return true;
            }

        });
    });
    $('.vehicles-report .sub-title').click('.vehicles-report .sub-title',function(){
        $('.vehicles-report .filter-section-wrap').slideToggle();
    });



    if($('.dataTable tr td').hasClass('dataTables_empty')){
       $(this).parents('.table-responsive').addClass('no-data');
   }




   /*horizontal scroll from mouse scroll button*/


//  jQuery(function ($) {
//     $.fn.hScroll = function (amount) {
//         amount = amount || 120;
//         $(this).bind("DOMMouseScroll mousewheel", function (event) {
//             var oEvent = event.originalEvent,
//             direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
//             position = $(this).scrollLeft();
//             position += direction > 0 ? -amount : amount;
//             $(this).scrollLeft(position);
//             event.preventDefault();
//         })
//     };
// });

//  $(document).ready(function() {
//     $('.dataTables_scrollBody').hScroll(50);
//     // You can pass (optionally) scrolling amount
// });

    // $('#selectors').change(function() {
    //     if ($(this).val() == 3 ) {
    //       $('#tickets').hide();
    //     } else {
    //       $('#tickets').show();
    //     }
    //   });



    /*scrollbar*/

    $(".main-menu").overlayScrollbars({
            scrollbars: {
            visibility:         "auto",
            dragScrolling:      true,
            clickScrolling:     false,
            touchSupport:       true,
        },

    });
    // $(".main-menu").slimScroll({
    //     width: '100%',
    //     height: 'calc(100% - 40px)',
    //     size: '4px',
    //     railColor: '#222',
    //     wheelStep: 5,
    //     allowPageScroll: true
    // });


});
