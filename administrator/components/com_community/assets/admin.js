function AzrulCommunity()
{
	this.redirect		= function( url ){
		window.location.href = url;
	}
	
	this.removeOption	= function(){
		$('options').getElements('option').each(function(element, count){
			if(element.selected){
				element.remove();
				
				// Remove this value's from the hidden form so that when the user saves,
				// this element which is removed will not be saved.
				var childrens	= $('childrens').value.split(',');
				
				childrens.splice(childrens.indexOf(element.value), 1);
				
				$('childrens').value	= childrens.join();
				
				//console.log(chil);
				//console.log(childrens.splice(childrens.indexOf(element.value), 1).join());
				
				
			}
		});
		
		//console.log(childrens);
	}
	
	this.showAddOption	= function(){
		
		if($('showOption').getStyle('display') == 'none'){
			$('showOption').setStyle('display','inline');	
			$('hideOption').setStyle('display','none');
			$('addOption').setStyle('display','none');
		} else {
			$('showOption').setStyle('display','none');
			$('hideOption').setStyle('display','inline');
			$('addOption').setStyle('display','inline');
		}
		//alert($('addOption').getStyle('display'));
		//$('addOption').setStyle('display','block');
	}
	
	this.saveGroupCategory	= function(){
		var values	= jax.getFormValues('editGroupCategory');
		
		jax.call('community','admin,groupcategories,ajaxSaveCategory', values);
	}
	
	this.editGroupCategory	= function(isEdit , windowTitle){
		var ajaxCall	= 'jax.call("community","admin,groupcategories,ajaxEditCategory" , ' + isEdit + ');';

		cWindowShow(ajaxCall , windowTitle , 430 , 280);
	}
	
	this.saveVideosCategory	= function(){
		var values	= jax.getFormValues('editVideosCategory');

		jax.call('community','admin,videoscategories,ajaxSaveCategory', values);
	}

	this.editVideosCategory	= function(isEdit , windowTitle){
		var ajaxCall	= 'jax.call("community","admin,videoscategories,ajaxEditCategory" , ' + isEdit + ');';

		cWindowShow(ajaxCall , windowTitle , 430 , 280);
	}
	
	this.newField = function(){

		cWindowShow('jax.call("community","admin,profiles,ajaxEditField","0");', 'New Custom Profile' , 650 ,420 );
	
		return false;
	}

	this.newFieldGroup = function(){

		cWindowShow('jax.call("community","admin,profiles,ajaxEditGroup","0");', 'New Group' , 450 ,200 );
	
		return false;
	}
	
	this.editField = function( id , title )
	{
		cWindowShow( 'jax.call("community", "admin,profiles,ajaxEditField", "' + id + '");' , title , 650 , 420 );
		return false;
	}

	this.editFieldGroup = function( id , title )
	{
		cWindowShow( 'jax.call("community", "admin,profiles,ajaxEditGroup", "' + id + '");' , title , 450 , 200 );
		return false;
	}

	this.addOption = function(parent){
	
		var addable = $('options').getElements('option').every( function(element, count){
			if(element.value == $('newoption').value){
				return false
			}
			return true;
		});
	
		if(addable){
			var el = new Element('option', {'value': $('newoption').value});
			
			el.setHTML($('newoption').value);
			el.setProperty('value', '0');
			
			// Clone element to the 'defaults' select list
			var defaultEl	= el.clone();
			
			el.injectInside($('options'));
			defaultEl.injectInside($('default'));
			// If parent is 0 we know this is a new record, so we dont add the options 
			// in the database yet. We should only add the options once a user hit the 'save' button.
	// 		if(parent != 0 || parent != '0'){
	// 			// Call ajax function to add the options for this parent item.
	// 			jax.call('community','cxAddOption', $('newoption').value, parent);
	// 		}
		} else {
			$('ajaxResponse').setHTML('Option exists');
		}
	
	}
	
	this.togglePublish	= function( ajaxTask , id , type ){
		jax.call( 'community' , 'admin,' + ajaxTask , id , type );
	}
	
	this.changeType = function(type){

// 		if( type == 'group' )
// 		{
// 			$$('.fieldGroups').setStyle('display', 'none');
// 		}
// 		else
// 		{
			$$('.fieldGroups').setStyle('display', 'table-row');
// 		}
		
		if( type == 'select' || type == 'singleselect' || type == 'radio' || type == 'list' || type == 'checkbox' )
// 		if(type == 'text' || type == 'group' || type == 'textarea' || type =='date' )
		{
			$$('.fieldSizes').setStyle('display', 'none');
			$$('.fieldOptions').setStyle('display', 'table-row');
		}
		else
		{
			$$('.fieldOptions').setStyle('display', 'none');
			if( type == 'text' || type == 'textarea' )
			{
				$$('.fieldSizes').setStyle('display', 'table-row');
			}
			else
			{
				$$('.fieldSizes').setStyle('display', 'none');
			}
		}
	
	}
	
	this.saveField = function(id){
		var values = jax.getFormValues('editField');

		jax.call('community','admin,profiles,ajaxSaveField', id , values);
	}

	this.saveFieldGroup = function(id){
		var values = jax.getFormValues('editField');

		jax.call('community','admin,profiles,ajaxSaveGroup', id , values);
	}
		
	this.showRemoveOption = function(){
		if($('addOption').getStyle('display') == 'inline'){
			// Hide the add option and show the remove option
			$('removeOption').setStyle('display','inline');
			$('addOption').setStyle('display','none');
		}
	}
	
	this.updateAttribute = function(id, type){
		jax.call('community','cxUpdateAttribute', id, type, $(type + id).value);
	}

	this.changeTemplate = function( templateName ){
		jax.call( 'community' , 'admin,templates,ajaxChangeTemplate' , templateName );
	}
	
	this.editTemplate = function( templateName , fileName ){
		jax.call( 'community' , 'admin,templates,ajaxLoadTemplateFile', templateName, fileName )
	}
	
	this.resetTemplateForm = function(){
		jQuery('#data').val('');
		jQuery('#filePath').html('');
	}
	
	this.resetTemplateFiles = function(){
		jQuery('#templates-files-container').html('');
	}
	
	this.saveTemplateFile = function(){
		var fileData		= jQuery( '#data' ).val();
		var fileName		= jQuery( '#fileName' ).val();
		var templateName	= jQuery( '#templateName' ).val();

		jax.call('community', 'admin,templates,ajaxSaveTemplateFile', templateName , fileName, fileData );
	}

	this.assignGroup = function( memberId ){
		cWindowShow('jax.call("community","admin,groups,ajaxAssignGroup", ' + memberId + ');', '' , 550 , 170 );
	}

	this.saveAssignGroup = function( memberId ){
		var group	= jQuery('#groupid').val();
		
		if( group == '-1' )
		{
			jQuery('#group-error-message').html('Please select a group');
			return false;
		}
		jQuery('#assignGroup').submit();
	}
	
	this.editGroup = function( groupId ){
		cWindowShow('jax.call("community","admin,groups,ajaxEditGroup", ' + groupId + ');', 'Editing Group' , 550 , 450 );
	}
	
	this.changeGroupOwner = function( groupId ){
		cWindowShow('jax.call("community","admin,groups,ajaxChangeGroupOwner",' + groupId + ');', 'Change Group Owner' , 480 , 250 );
	}
	
	this.saveGroup = function(){
		jQuery('#editgroup').submit();
	}

	this.saveGroupOwner = function(){
		document.forms['editgroup'].submit();
	}
	
	this.checkVersion = function(){	
		cWindowShow('jax.call("community","admin,about,ajaxCheckVersion");', 'Jom Social' , 450 , 200 );
	}
	
	this.reportAction = function( actionId ){
		cWindowShow( 'jax.call("community","admin,reports,ajaxPerformAction", "' + actionId + '");' , 'Report' , 450 , 200 );
	}
	
	this.ruleScan = function(){
		cWindowShow('jax.call("community","admin,userpoints,ajaxRuleScan");', 'User Rule Scan' , 450 ,400 );
		return false;
	}
		
	this.editRule = function( ruleId ){
		cWindowShow( 'jax.call("community","admin,userpoints,ajaxEditRule","' + ruleId + '");' , 'Edit Rule' , 450 , 300 );
		return false;
	}
	
	this.saveRule = function( ruleId ){				
		var values = jax.getFormValues('editRule');
		jax.call('community','admin,userpoints,ajaxSaveRule', ruleId , values);
	}
	
	this.updateField = function (sourceId, targetId){
		jQuery('#' + targetId).val( jQuery('#' + sourceId).val() );
	}
		 
}

var azcommunity = new AzrulCommunity();