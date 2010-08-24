var JAToggler_loaded = 0;
var JAToggler = {

	init: function(){
		this.old_task = null;
		this.x = '<img src="images/publish_x.png" border="0" alt="Toggle state" />';
		this.tick = '<img src="images/tick.png" border="0" alt="Toggle state" />';
		
		if (JAToggler_loaded == 0) {
			this.script2 = new Asset.javascript(jatogglerData.Base+'plugins/system/jatoggler/jatoggler2.js');
			this.spinner = new Asset.image(jatogglerData.Base+'plugins/system/jatoggler/spinner.gif', {border: '0', alt: 'Loading...'});
			this.spinner2 = new Asset.image(jatogglerData.Base+'plugins/system/jatoggler/spinner2.gif', {'alt': 'Loading...', 'align': 'top', 'styles': {'margin': '50px auto 0 auto', 'border' : '1px solid silver'}});
			jatoggler_script2 = 1;
		}

		// save form default task
		if (document.adminForm != null && document.adminForm.task && document.adminForm.boxchecked) {
			this.form 		= document.adminForm;
			this.old_task 	= this.form.task.value;
		}
		else {
			return;
		}

		document.body.style.cursor = 'wait';

		for (i=0; i<document.links.length; i++) {
			var el = document.links[i];
			
			if (el.href == 'javascript:void(0);') {
				var tmp = el.parentNode.innerHTML;
				var tmp2 = '';
				if (tmp.indexOf(' listItemTask(') != -1) {
					
					if (tmp.indexOf('\'unpublish\'') != -1) 		tmp2 = 'unpublish';
					if (tmp.indexOf('\'publish\'') != -1) 			tmp2 = 'publish';
					if (tmp.indexOf('\'toggle_frontpage\'') != -1) 	tmp2 = 'toggle_frontpage';
					if (tmp.indexOf('\'block\'') != -1) 			tmp2 = 'block';
					if (tmp.indexOf('\'unblock\'') != -1) 			tmp2 = 'unblock';
					
					if (tmp.indexOf('\'accessregistered\'') != -1) 	tmp2 = 'accessregistered';
					if (tmp.indexOf('\'accessspecial\'') != -1) 	tmp2 = 'accessspecial';
					if (tmp.indexOf('\'accesspublic\'') != -1) 		tmp2 = 'accesspublic';

					if (tmp2 != '') {
						el.rel = tmp2;
						el.title = 'Toggle state';
						el.onclick = this.click.pass(el, this);
					}
					
				}
			}
			
			if (el.href.indexOf('#reorder') != -1) {
				var tmp = el.parentNode.innerHTML;
				var tmp2 = '';
				
				if (tmp.indexOf('\'orderup\'') != -1) 	tmp2 = 'orderup';
				if (tmp.indexOf('\'orderdown\'') != -1) tmp2 = 'orderdown';
				
				if (tmp2 != '') {
					el.rel = tmp2;
					el.onclick = this.clickOrder.pass(el, this);
				}
			}

			if (el.href == '') {
				var tmp = el.parentNode.innerHTML;
				var tmp2 = '';
				
				if (tmp.indexOf('javascript: document.adminForm.limitstart.value=') != -1) {
					el.rel = this.old_task;
					el.onclick = this.clickOrder.pass(el, this);
				}
			}
		}
		
		// limit box
		if (this.form) {
			if (this.form.limit && this.form.boxchecked && $('cb0')) {
				this.form.limit.onchange = this.clickLimit.pass(this.form.limit, this);
			}
		}
				
		document.body.style.cursor = 'default';
	},

	clickLimit: function(sel){
		this.insertDiv(sel);
		this.startLimit(sel);
		new Ajax('index.php', { method: 'post', data: this.form, onComplete: function(text, xml) { this.completeOrder(text, xml, sel) }.bind(this) } ).request();
		return false;
	},

	clickOrder: function(link){
		this.insertDiv(link);
		this.start(link);
		new Ajax('index.php', { method: 'post', data: this.form, onComplete: function(text, xml) { this.completeOrder(text, xml, link) }.bind(this) } ).request();
		return false;
	},
	
	completeOrder: function(text, xml, link){
		var tbl = this.getTable(link);
		tbl.remove();
		document.getElementById('jattoggle_div').innerHTML = text;
		this.endOrder(link);
	},
	
	endOrder: function(link) {
		document.getElementById('jattoggle_overlay').remove();
		this.form.jatoggler.value = '';
		this.form.task.value = this.old_task;
		document.body.style.cursor = 'default';
		//JAToggler.init();
		window.fireEvent('domready');
	},
	
	insertDiv: function(el) {
		if (document.getElementById('jattoggle_div') == null ) {
			var tbl = this.getTable(el);
			this.jattoggle_div = new Element('div', {id: 'jattoggle_div'}).injectBefore(tbl);
		}
	},

	click: function(link){
		var old = link.innerHTML;
		this.start(link);
		new Ajax('index.php', { method: 'post', data: this.form, onComplete: function(text, xml) { this.complete(text, xml, link, old) }.bind(this) } ).request();
		return false;
	},

	complete: function(text, xml, link, old){
		// unpublished
		if (link.rel == 'unpublish') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'publish';
				link.innerHTML = this.x;
				this.end(link);
			}
			return;
		}
		// published
		if (link.rel == 'publish') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'unpublish';
				link.innerHTML = this.tick;
				// com_content
				if (this.form.option.value == 'com_content') {
					link.innerHTML = '<img src="images/publish_g.png" border="0" alt="Published" />';
				}
				this.end(link);
			}
			return;
		}
		// frontpage toggled
		if (link.rel == 'toggle_frontpage') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				if (old.indexOf('publish_x') != -1) link.innerHTML = this.tick;
				else link.innerHTML = this.x;
				this.end(link);
			}
			return;
		}
		// unblock
		if (link.rel == 'unblock') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'block';
				link.innerHTML = this.tick;
				this.end(link);
			}
			return;
		}
		// block
		if (link.rel == 'block') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'unblock';
				link.innerHTML = this.x;
				this.end(link);
			}
			return;
		}
		
		
		// registered
		if (link.rel == 'accessregistered') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'accessspecial';
				link.innerHTML = jatogglerData.Registered;
				link.style.color = 'red';
				this.end(link);
			}
			return;
		}
		// special
		if (link.rel == 'accessspecial') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'accesspublic';
				link.innerHTML = jatogglerData.Special;
				link.style.color = 'black';
				this.end(link);
			}
			return;
		}
		// public
		if (link.rel == 'accesspublic') {
			if (text != 'JAT OK') {
				this.error(link);
			}
			else {
				link.rel = 'accessregistered';
				link.innerHTML = jatogglerData.Public;
				link.style.color = 'green';
				this.end(link);
			}
			return;
		}
		
	},

	
	start: function(link){
		// insert spinner
		if (link.rel.indexOf('order') != -1) {
			this.overlay(link);
		}
		else {
			link.innerHTML = '';
			this.spinner.injectInside(link);
		}
		
		this.insertHiddens();

		// set task
		this.form.task.value = link.rel;

		// get tr
		var tr = link.getParent();
		while (tr.nodeName != 'TR') {
			tr = tr.getParent();
		}
		
		// uncheck all cids/check 1 cid
		var tmp = this.form.elements;
		for (i=0; i<tmp.length; i++) {
			if (tmp[i].name == 'cid[]') {
				tmp[i].checked = tr.hasChild(tmp[i]);
			}
		}
		this.form.boxchecked.value = '1';

		// setup cursor
		document.body.style.cursor = 'wait';
	}, 
	
	end: function(link){
		// uncheck cid
		var tmp = this.form.elements;
		var i = 0;
		for (i=0; i<tmp.length; i++) {
			if (tmp[i].name == 'cid[]') {
				tmp[i].checked = false;
			}
		}
		this.form.boxchecked.value = '0';
		document.body.style.cursor = 'default';
		this.form.jatoggler.value = '';
		this.form.task.value = this.old_task;
	},
	
	error: function(link){
		document.body.style.cursor = 'default';
		link.parentNode.innerHTML = '<span style="color:red">Error</span>';
		this.form.task.value = this.old_task;
	},
	
	getTable: function(link){
		el = link.parentNode;
		while(el.nodeName != 'TABLE') {
			el = el.parentNode;
		}
		return el;
	},
	
	startLimit: function(sel){
		// insert spinner
		this.overlay(sel)
		this.insertHiddens();
		document.body.style.cursor = 'wait';
	},
	
	insertHiddens: function() {
		if (this.form['jatoggler'] == undefined) {
			this.input = new Element('input', {'type': 'hidden', 'name': 'jatoggler', 'value': '1'}).injectInside(this.form);
		}
		else this.form.jatoggler.value = '1';
	},
	
	overlay: function(el) {
		var tbl = this.getTable(el);
		this.overlayDiv = new Element('div', {'id': 'jattoggle_overlay', 'styles': {'padding-top':'30px', 'background':'transparent','position': 'absolute', 'z-index':'99999', 'left':'0', 'top':tbl.offsetTop+'px', 'width':'100%', 'height':tbl.offsetHeight+'px', 'text-align':'center', 'overflow':'hidden'}}).injectInside(document.body);
		this.spinner2.injectInside(this.overlayDiv);
		var fx = new Fx.Styles(tbl, {duration:200, wait:false}).start({'opacity':0.5});
	}
	


};

window.addEvent('domready', JAToggler.init.bind(JAToggler));
