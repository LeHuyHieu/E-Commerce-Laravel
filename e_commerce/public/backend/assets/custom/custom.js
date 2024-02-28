function confirm_delete(event, class_name, title, content) {
    $(document).on(event, class_name, function (e) {
        e.preventDefault();
        let form = $(this).closest('form');
        $.confirm({
            title: title,
            content: content,
            buttons: {
                delete: {
                    text: 'Delete',
                    btnClass: 'btn-danger',
                    action: function () {
                        delete_ajax(form)
                    }
                },
                cancel: function () {
                }
            }
        });
    })
}

function delete_ajax(form) {
    let link = form.attr('action');
    let data = {
        '_method': form.find('input[name="_method"]').val(),
        '_token': form.find('input[name="_token"]').val()
    }
    $.ajax({
        url: link,
        method: 'POST',
        data: data,
        success: (function (response) {
            var new_table = $(response).find('#table')
            var new_pagination = $(response).find('.pagination-foot');
            $('#table').html(new_table)
            $('.pagination-foot').html(new_pagination)
        })
    })
}

//replace slug
function replaceTextToLowerCase(string) {
    let lowerCase = string.toLowerCase()
    return lowerCase.replace(/\s+/g, '-');
}

//find and replace id and for, ..vv
function findAndReplace(attr, element, count) {
    element.find('[' + attr + ']').each(function () {
        let oldFor = $(this).attr(attr);
        let newFor = oldFor + count;
        $(this).attr(attr, newFor);
    });
}

//format currency
function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);
        // if (blur === "blur") {
        //     right_side += "00";
        // }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side  + " VND";
    } else {
        input_val = formatNumber(input_val);
        input_val = input_val + " VND";
        // if (blur === "blur") {
        //     input_val += ".00";
        // }
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}


$(function () {
    confirm_delete('click', '.btn-delete-item', 'Confirm', 'Confirm delete!')

    //replace slug
    if ($('.get-slug').length) {
        $('.get-slug').on('input', function () {
            $('#slug').val(replaceTextToLowerCase($('.get-slug').val()))
        })
    }

    if ($('.text-editor').length) {
        tinymce.init({
            selector: '.text-editor'
        });
    }

    //show image input change
    $(document).on('change', '.img_inp',function (e) {
        const file = e.target.files[0];
        if (file) {
            $(this).siblings('.show_image').attr('src', URL.createObjectURL(file));
        }
    });

    //add item image
    if ($('.list-image').length) {
        let count = 0;
        $('.btn-add-image-item').on('click', function () {
            count++
            let html = $('.clone-item').clone().removeClass('clone-item')
            findAndReplace('for', html, count)
            findAndReplace('id', html, count)
            $('.list-image').append(html)
        })
    }
    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.form-group').remove()
    })

    $("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });

    if ($('#inputDiscount').length) {
        $('#inputDiscount').on('change', function() {
            switch ($('#inputDiscount').val()) {
                case 'percent':
                    $('.show-discount-percent').removeClass('d-none')
                    break;
                case 'sale':
                    $('.show-discount-percent').removeClass('d-none')
                    $('.show-sale-product').removeClass('d-none')
                    break;
                default:
                    $('.show-discount-percent').addClass('d-none')
                    $('.show-sale-product').addClass('d-none')
                    break;
            }
        })
    }

});
