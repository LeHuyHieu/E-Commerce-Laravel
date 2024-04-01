<!-- jquery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- jquery confirm -->
<script src="{{ asset('backend/assets/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
<!-- tinymce -->
<script src="{{ asset('backend/assets/plugins/tinymce/tinymce.min.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('backend/assets/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        if ($('.knob').length) {
            $(".knob").knob();
        }
        if ($('.single-select').length) {
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        }
    });
</script>
<!--app JS-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<!-- custom -->
<script src="{{ asset('backend/assets/custom/custom.js') . '?time=' . time() }}"></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
        }
    @endif

    // using  $notification = array(
    //     'message' => 'Successfully Done',
    //     'alert-type' => 'success'
    // );
</script>
