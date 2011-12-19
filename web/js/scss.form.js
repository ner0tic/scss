$(document).ready(function() {
    $('#scss_patrol_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
	    $(el).val(hex);
	    $(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
    }).bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
    });
});
