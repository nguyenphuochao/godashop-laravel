function checkAll(check_all) {
	$(check_all).change(function() {
	    var checkboxes = $(this).closest('table').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));

        if($(this).is(':checked')) {
            $('input[name=delete]').removeAttr("disabled");
            $("#selectedExport").removeClass("disabled");
        } else {
            $('input[name=delete]').attr("disabled", "disabled");
            $("#selectedExport").addClass("disabled");
        }
	});
}
