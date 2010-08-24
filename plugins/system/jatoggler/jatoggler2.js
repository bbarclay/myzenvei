function tableOrdering( order, dir, task ) {
	var form = document.adminForm;
	form.filter_order.value 	= order;
	form.filter_order_Dir.value	= dir;

	var sel = document.getElementById('cb0');
	JAToggler.insertDiv(sel);
	JAToggler.insertHiddens();
	JAToggler.overlay(sel);
	document.body.style.cursor = 'wait';
	
	var ajax = new Ajax('index.php', { method: 'post', data: document.adminForm, onComplete: function(text, xml) { JAToggler.completeOrder(text, xml, sel) } } ).request();
}

function saveorder( n,  task ) {
	var form = document.adminForm;
	form.task.value = task;

	var sel = document.getElementById('cb0');
	JAToggler.insertDiv(sel);
	JAToggler.insertHiddens();
	JAToggler.overlay(sel);
	document.body.style.cursor = 'wait';

	// check cids
	var tmp = document.adminForm.elements;
	var i = 0;
	for (i=0; i<tmp.length; i++) {
		if (tmp[i].name == 'cid[]') {
			tmp[i].checked = true;
		}
	}
	
	var ajax = new Ajax('index.php', { method: 'post', data: document.adminForm, onComplete: function(text, xml) { JAToggler.completeOrder(text, xml, sel) } } ).request();
}
