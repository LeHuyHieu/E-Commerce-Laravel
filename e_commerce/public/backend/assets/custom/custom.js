function confirm_delete (event, class_name, title, content) {
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
                    action: function(){
                        delete_ajax(form)
                    }
                },
                cancel: function () {
                }
            }
        });
    })
}
function delete_ajax (form) {
    let link = form.attr('action');
    let data= {
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
$(function() {
    confirm_delete('click', '.btn-delete-item', 'Confirm', 'Confirm delete!')
});
