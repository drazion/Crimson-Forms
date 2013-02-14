/************************/
/* ADD A FIELD ON CLICK */
/************************/ 
$(document).on('click', '#add-field', function() {
	var type = $("select[name=new_form_type]").val();
	switch (type) {
		case 'input':
			var output = '<li><label>Name</label><input class="form_fields" type="text" style="width: 300px" max_length="100"> ';
			break;
		case 'select':
			var output = '<li><label>Name</label><input class="form_fields" type="text" style="width: 150px;" max_length="100">'+
			'<label>Values</label><input type="text" style="width: 150px;" max_length="100" value="\'value1\':\'Text1 Here\', \'value2\':\'Text2 Here\'"> ';
			break;
		case 'textarea':
			and_new_field('textarea');
			break;
		case 'multiselect':
			and_new_field('multi');
			break; 
	}
	output += '<label>Label</label><input class="form_labels" type="text" style="width: 100px" max_length="100"> <label>Status</label><select class="form_status"><option selected="selected" value="active">Active</option><option value="hide">Hidden</option><option value="inactive">Inactive</option></select></li>';
	$("#crimson-form-wrapper ul").append(output);
});

/****************************/
/* FORM CREATION VALIDATION */
/****************************/
$(document).on('click', '#create_new_form', function() {
	var valid = true;
	//Check form fields for valid input
	valid = validity_helper($(".form_fields"));
		
	//If still valid check labels
	if(valid) {
		valid = validity_helper($(".form_labels"));
	}
});

function validity_helper(_this) {
	var valid = true;
	$(_this).each(function() {
		if($(this).val() =='') {
			$(this).addClass('error');
			alert("You are missing some required fields");
			valid = false;
			return false;
		}
	});
	return valid;
}
/*************************************/
/* REMOVE ERROR CLASS ON INPUT FOCUS */
/*************************************/
$(document).on('focus', 'input', function() {
	$(this).removeClass('error');
});
