// alert(base_url)

$(function() {
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

bsCustomFileInput.init();

$(".admin-toastr").trigger('click');


function toastr_success(msg) {
    toastr.success(msg)
}

function toastr_danger(msg) {
    toastr.error(msg)
}

function confirm_box_status(status, userid, url, _this, msg) {
    if (confirm("Do you really want to change status ?")) {
        let curr_status = $(_this).children().text()
        $(_this).children().text('Waiting...')
        $.ajax({
            url: base_url + url,
            type: "POST",
            data: { status: status, userid: userid },
            success: $.proxy(function(res) {
                if (res == 'success') {
                    if (status == 'active') {
                        $(_this).parent().html('<a class="text-success" onclick="confirm_box_status(\'inactive\',' + userid + ',\'' + url + '\',this,\'' + msg + '\')"><strong>Block</strong></a>');
                    }
                    if (status == 'inactive') {
                        $(_this).parent().html('<a class="text-danger" onclick="confirm_box_status(\'active\',' + userid + ',\'' + url + '\',this,\'' + msg + '\')"><strong>Unblock</strong></a>');
                    }
                    toastr_success(msg + ' status has changed successfully')
                } else if (res == 'error') {
                    toastr_danger('Error occured in changing status')
                    $(_this).children().text(curr_status)
                }
            }, this)
        });
    }
}

function confirm_box_delete(userid, url) {
    if (confirm("Do you really want to delete this data ?")) {
        window.location.href = base_url + url + '/' + userid;
    }
}

$('.select2').select2()

$('.select2bs4').select2({
    theme: 'bootstrap4'
})

$(function() {
    $('.textarea').summernote()
})

$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});