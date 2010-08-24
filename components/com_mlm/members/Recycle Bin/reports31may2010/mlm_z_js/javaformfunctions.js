// JavaScript Document

	
$(document).ready(function(){

	$(".btn-slide").click(function(){
		$("#panel").slideToggle("slow");
		$(this).toggleClass("active"); return false;
	});
	
	 
});
$(document).ready(function() {
				$('input:checkbox:not([safari])').checkbox();
				$('input[safari]:checkbox').checkbox({cls:'jquery-safari-checkbox'});
				$('input:radio').checkbox();
			});

			displayForm = function (elementId)
			{
				var content = [];
				$('#' + elementId + ' input').each(function(){
					var el = $(this);
					if ( (el.attr('type').toLowerCase() == 'radio'))
					{
						if ( this.checked )
							content.push([
								'"', el.attr('name'), '": ',
								'value="', ( this.value ), '"',
								( this.disabled ? ', disabled' : '' )
							].join(''));
					}
					else
						content.push([
							'"', el.attr('name'), '": ',
							( this.checked ? 'checked' : 'not checked' ), 
							( this.disabled ? ', disabled' : '' )
						].join(''));
				});
				alert(content.join('\n'));
			}
			
			changeStyle = function(skin)
			{
				jQuery('#myform :checkbox').checkbox((skin ? {cls: skin} : {}));
			}
			$(function() {
	$('#popupDatepicker').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}


		$( function() {
			$( '.checkAll' ).live( 'change', function() {
				$( '.top5' ).attr( 'checked', $( this ).is( ':checked' ) ? 'checked' : '' );
				$( this ).next().text( $( this ).is( ':checked' ) ? 'Uncheck All' : 'Check All' );
			});
			$( '.invertSelection' ).live( 'click', function() {
				$( '.top5' ).each( function() {
					$( this ).attr( 'checked', $( this ).is( ':checked' ) ? '' : 'checked' );
				}).trigger( 'change' );
 
			});
			$( '.top5' ).live( 'change', function() {
				$( '.top5' ).length == $( '.top5:checked' ).length ? $( '.checkAll' ).attr( 'checked', 'checked' ).next().text( 'Uncheck All' ) : $( '.checkAll' ).attr( 'checked', '' ).next().text( 'Check All' );
 
			});
		});
