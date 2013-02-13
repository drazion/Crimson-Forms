$(document).on('click', '#add_field', function() {
	var type = $("select[name=new_form_type]").val();
	switch (type) {
		case 'input':
			console.log('input')
			break;
		case 'select':
			console.log('select');
			break;
		case 'textarea':
			console.log('textarea');
			break;
		case 'multiselect':
			console.log('multi');
			break; 
	}
});
