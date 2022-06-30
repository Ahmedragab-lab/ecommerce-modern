    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script> --}}
    <!-- BEGIN Vendor JS-->
    @yield('fileinputjs')
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/data/jvector/visitor-data.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
      <!-- BEGIN: Page Vendor JS-->
      {{-- <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
      <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
      <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
      <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
      <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
      <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script> --}}
      <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboard/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/scripts/forms/switch.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <!-- END: Theme JS-->
    {{-- <script src="{{ asset('dashboard/app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script> --}}
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('dashboard/app-assets/js/scripts/pages/dashboard-sales.js') }}"></script>

    <script src="{{ asset('dashboard/summernote/summernote-bs4.min.js') }}"></script>

    {{-- <script src="{{ asset('dashboard/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script> --}}

    <script src="{{ asset('vendor/pickdate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickdate/picker.date.js') }}"></script>

    @yield('js')

    <!-- END: Page JS-->
    <script>
        $(".img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".img-preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('#btn_delete_all').click(function() {
                var selected = [];
                $("input:checkbox[name=delete_select]:checked").each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $('#bulkdeleteall').modal('show');
                    $('input[id="delete_all"]').val(selected);
                }
                else{
                    swal({
                        title: "Oops!",
                        text: "Please select at least one record",
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        });
    </script>
    <script>
        $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            })
    </script>


