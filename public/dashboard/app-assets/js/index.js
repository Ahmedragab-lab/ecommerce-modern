$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //select all functionality
    $(document).on('change', '.record__select', function () {
        getSelectedRecords();
    });

    // used to select all records
    $(document).on('change', '#record__select-all', function () {

        $('.record__select').prop('checked', this.checked);
        getSelectedRecords();
    });

    function getSelectedRecords() {
        var recordIds = [];

        $.each($(".record__select:checked"), function () {
            recordIds.push($(this).val());
        });
        console.log(recordIds);
        $('#record-ids').val(JSON.stringify(recordIds));

        recordIds.length > 0
            ? $('#bulk-delete').attr('disabled', false)
            : $('#bulk-delete').attr('disabled', true)

    }
});//end of document ready
