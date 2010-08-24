/*
 * Photo playlist
 *
 */
function getPlaylistIndex(photoId)
{
	if (photoId==undefined)
		return 0;

	var playlistIndex;
	jQuery.each(jsPlaylist.photos, function(i)
	{
		if (this.id==photoId)
			playlistIndex = i;
	});
	
	return playlistIndex;
} 

function nextPhoto(photo)
{
	var playlistIndex = 0;
	
	if (photo!=undefined)
	{
		playlistIndex = getPlaylistIndex(photo.id);		
	} else {
		playlistIndex = jsPlaylist.currentPlaylistIndex + 1;
	
		if (playlistIndex >= jsPlaylist.photos.length)
			playlistIndex = 0;
	}

	return jsPlaylist.photos[playlistIndex];
}

function prevPhoto(photo)
{
	var playlistIndex = 0;
	
	if (photo!=undefined)
	{
		playlistIndex = getPlaylistIndex(photo.id);
	} else {
		playlistIndex = jsPlaylist.currentPlaylistIndex - 1;
	
		if (playlistIndex < 0)
			playlistIndex = jsPlaylist.photos.length - 1;		
	}

	return jsPlaylist.photos[playlistIndex];
}

function currentPhoto(photo)
{
	var playlistIndex = jsPlaylist.currentPlaylistIndex;
	
	if (photo!=undefined)
	{
		playlistIndex = getPlaylistIndex(photo.id);
		urlPhotoId(photo.id);
	}
	
	if (playlistIndex==undefined)
	{
		playlistIndex = getPlaylistIndex(urlPhotoId());
	}

	jsPlaylist.currentPlaylistIndex = playlistIndex;
	
	return jsPlaylist.photos[playlistIndex];
}

function urlPhotoId(photoId)
{
	if (photoId==undefined)
	{
		var url = document.location.href;
		if (url.match('#') && url.split('#')[1].match('photoid='))
		{
			url = url.split('#')[1];
			if (url.match('&'))
				url = url.split('&')[0];
			return url.split('=')[1];
		}
	} else {
		document.location = document.location.href.split('#')[0] + '#photoid=' + photoId;
	}
}


/*
 * Photo display.
 *
 */
function initGallery()
{
	/* Fallback to older jQuery versions (should conflict arises) */
	if (typeof(jQuery.isArray)=="undefined")
	{
		jQuery.extend({
			isArray: function( obj ) {
				return obj.constructor==Array;
			}
		});
	}

	displayViewport();
	displayPhoto(currentPhoto());
}

function displayViewport()
{
	// Set up photoViewport events
	var photoViewport = jQuery('#cGallery .photoViewport');
	photoViewport.unbind();
	photoViewport.hover(
		function(){ jQuery('#cGallery .photoAction').fadeIn('fast'); },
		function(){	jQuery('#cGallery .photoAction').fadeOut('fast'); }
	);
		
	// Setting photoDisplay into 16:12 aspect ratio
	var photoDisplay = jQuery('#cGallery .photoDisplay');
	photoDisplay.css('height', Math.floor(photoDisplay.width() / 16 * 12));	

	// Position loading icons
	var photoLoad = jQuery('#cGallery .photoLoad');
	photoLoad.css({'top' : Math.floor((photoDisplay.height() / 2) - (photoLoad.height() / 2)),
		           'left': Math.floor((photoDisplay.width() / 2) - (photoLoad.width() / 2))
		          });	
	
	// photoActions
	var photoActions = jQuery('#cGallery .photoActions');
	photoActions.css({'width' : photoDisplay.width(),
		              'height': 0,
		              'top'   : 0,
		              'left'  : 0
		             });

	var photoAction_next = jQuery('#cGallery .photoAction._next');
	photoAction_next.css({'top'  : Math.floor((photoDisplay.height() / 2) - (photoAction_next.height() / 2)),
                          'right': 0
                         });

	var photoAction_prev = jQuery('#cGallery .photoAction._prev');
	photoAction_prev.css({'top' : Math.floor((photoDisplay.height() / 2) - (photoAction_prev.height() / 2)),
                          'left': 0
                         });
	
	// photoTags
	var photoTags = jQuery('#cGallery .photoTags');
	photoTags.css({'width' : photoDisplay.width(),
		           'height': 0,
		           'top'   : 0,
		           'left'  : 0
		          });
}
 
function displayPhoto(photo)
{
	var photoLoad = jQuery('#cGallery .photoLoad');
	photoLoad.show();

	// Before display photo
	currentPhoto(photo);

	// Update thumbnail
	jQuery('#cGallery .photoAction._next img').attr('src', nextPhoto().thumbnail);
	jQuery('#cGallery .photoAction._prev img').attr('src', prevPhoto().thumbnail);
	
	displayPhotoCaption(photo.caption);
	
	var newPhotoImage = createPhotoImage(photo, function()
	{
		var photoDisplay  = jQuery('#cGallery .photoDisplay');
		var photoImage    = jQuery('#cGallery .photoImage');
		
		photoImage.fadeOut('fast', function()
		{
			photoDisplay.empty();
			
			newPhotoImage.appendTo(photoDisplay);

			// The new photo need to be made visible first before we can get the correct size, (IE!)
			// So, we take it out of the screen first (unless u have super wide screen!)
			newPhotoImage.css({'top': '3000px','left': '4000px', 'visibility':'visible', 'position':'absolute'});
			
			// If newPhoto height/width is larger than the viewport, we need to do a html resize
			var photoHeight = newPhotoImage[0].height;
			var photoWidth  = newPhotoImage[0].width; 
			if( newPhotoImage[0].height > photoDisplay.height() ){
				photoWidth  = photoWidth * (photoDisplay.height() / photoHeight);
				photoHeight = photoDisplay.height(); 
			}
			if( photoWidth > photoDisplay.width() ){
				photoHeight  = photoHeight * (photoDisplay.width() / photoWidth);
				photoWidth 	 = photoDisplay.width(); 
			}
			
			// Now that we have the correct size, reposition the image
			newPhotoImage.css({'width'      : photoWidth,
			                   'height'     : photoHeight,
			                   'top'        : Math.floor((photoDisplay.height() - photoHeight) / 2),
			                   'left'       : Math.floor((photoDisplay.width()  - photoWidth)  / 2),
			                   'visibility' : 'visible',
			                   'display'    : 'none'        
			                  })
			             .fadeIn('fast', function()
			              {
			              	displayCreator(photo.id);
							displayPhotoWalls(photo.id);
							displayPhotoTags(photo.tags);
						  });

			var photoLoad = jQuery('#cGallery .photoLoad');
			photoLoad.hide();		
		});

	});

	// Prefetch images
	prefetchPhoto([prevPhoto(), nextPhoto()]);
}

function createPhotoImage(photo, callback)
{
	if (typeof(callback)!="function")
		callback = function(){};

	var photoImage = jQuery(new Image()).load(callback)
	                                    .attr({
											'id'    : 'photo-' + photo.id,
											'class' : 'photoImage',
											'alt'   :   photo.caption,
											'title' : '',
											'src'   : getPhotoUrl(photo)
										});

	return photoImage;
}

function prefetchPhoto(photos)
{
	if (!jQuery.isArray(photos))
		photos = [photos];

	jQuery.each(photos, function(i, photo)
	{
		if (!photo.loaded)
		{
			createPhotoImage(photo, function(){
				photo.loaded=true;
			});
		}
	});
}

function getPhotoUrl(photo)
{
	var photoDisplay = jQuery('#cGallery .photoDisplay');
	var photoUrl = '';
	
	// If it's from remote storage
	if(photo.url.indexOf('option=com_community')==-1)
	{
		photoUrl = photo.url;
	} else {
		photoUrl = photo.url + '&' + jQuery.param({'maxW': photoDisplay.width(), 'maxH': photoDisplay.height()});
	}
	return photoUrl;
}


/*
 * Photo caption.
 *
 */
function displayPhotoCaption(photoCaption)
{
	var photoCaptionText = jQuery('#cGallery .photoCaptionText');
	photoCaptionText.text((photoCaption!='') ? photoCaption : jsPlaylist.language.CC_NO_PHOTO_CAPTION_YET);	
}

function editPhotoCaption()
{
	var photoCaption = jQuery('#cGallery .photoCaption');
	photoCaption.addClass('editMode');

	var photoCaptionText  = jQuery('#cGallery .photoCaptionText');
	var photoCaptionInput = jQuery('#cGallery .photoCaptionInput');
	photoCaptionInput.val(jQuery.trim(photoCaptionText.text()));
}

function cancelPhotoCaption()
{
	var photoCaption = jQuery('#cGallery .photoCaption');
	photoCaption.removeClass('editMode');
	
	var photoCaptionInput = jQuery('#cGallery .photoCaptionInput');
	photoCaptionInput.val('');
}

function savePhotoCaption()
{
	var photoCaptionText  = jQuery('#cGallery .photoCaptionText');
	var photoCaptionInput = jQuery('#cGallery .photoCaptionInput');
	
	var oldPhotoCaption = jQuery.trim(photoCaptionText.text());
	var newPhotoCaption = jQuery.trim(photoCaptionInput.val());
	
	if (newPhotoCaption=='' || newPhotoCaption==oldPhotoCaption)
	{
		cancelPhotoCaption();
	} else {
		jax.call('community', 'photos,ajaxSaveCaption', currentPhoto().id, newPhotoCaption);
	}
}

function updatePhotoCaption(photoId, photoCaption)
{
	// Update photo caption
	var photoCaptionText  = jQuery('#cGallery .photoCaptionText');
	photoCaptionText.text(photoCaption);
	
	// Update playlist caption
	jsPlaylist.photos[getPlaylistIndex(photoId)].caption = photoCaption;

	cancelPhotoCaption();
}


/*
 * Photo walls.
 *
 */
function displayPhotoWalls(photoId)
{
	jax.call('community', 'photos,ajaxSwitchPhotoTrigger', photoId);
}


/*
 * Photo album.
 *
 */
function setPhotoAsDefault()
{
	if(confirm(jsPlaylist.language.CC_SET_PHOTO_AS_DEFAULT_DIALOG))
	{
		jax.call('community', 'photos,ajaxSetDefaultPhoto', jsPlaylist.album, currentPhoto().id);
	}
}

function removePhoto()
{
	if(confirm(jsPlaylist.language.CC_REMOVE_PHOTO_DIALOG))
	{
		var photos = jsPlaylist.photos;
		var photo = currentPhoto();
		
		// Remove in JSON
		photos.splice(getPlaylistIndex(photo.id), 1);
		
		var lastEntry = (jsPlaylist.photos.length<1) ? 1 : 0;
		jax.call('community', 'photos,ajaxRemovePhoto', photo.id, lastEntry);	

		if (!lastEntry) displayPhoto(nextPhoto());
	}
}

function downloadPhoto()
{
	window.open(jsPlaylist.photos[jsPlaylist.currentPlaylistIndex].originalUrl);
}

/*
 * Photo report.
 *
 */
function updatePhotoReport(html)
{
	jQuery('.page-action#report-this').remove();
	jQuery('.page-actions').prepend(html);
}

/*
 * Photo tagging.
 *
 */
function newPhotoTag(properties)
{
	var tag = {'id': null,
	           'userId': null,
	           'photoId': null,
	           'displayName': null,
	           'profileUrl': null,
	           'top': null,
	           'left':null,
	           'width': null,
	           'height': null,
   		 	   'displayTop': null,
		 	   'displayLeft': null,
		 	   'displayWidth': null,
		 	   'displayHeight': null,
		 	   'canRemove:': null
	   	      };

	jQuery.extend(tag, properties);
	
	return tag;
}

function createPhotoTag(tag)
{
	var photo     = jQuery('#cGallery .photoImage');
	var photoTags = jQuery('#cGallery .photoTags');

	if (typeof(tag)=='string')
		tag = eval('(' + tag + ')');

	// If it's a single tag, put it into an array anyway.
	var singleTag = false;
	if (!jQuery.isArray(tag))
	{
		tag = [tag];
		singleTag = true;
	}

	// Create photo tag
	var newPhotoTags = new Array();
	jQuery.each(tag, function(i, tag)
	{
		var photoTag = drawPhotoTag(tag, photo);
		photoTag.data('tag', tag)
				.attr('id', 'photoTag-' + tag.id)
				.hover(
					function(){ showPhotoTag(tag.id, 'Label'); },
					function(){ hidePhotoTag(tag.id); }
				)
		        .appendTo(photoTags);

		var photoTagLabel = jQuery('<div class="photoTagLabel">');

		photoTagLabel.html(tag.displayName);
		photoTagLabel.wrapInner('<span></span>')
		             .appendTo(photoTag);
		
		newPhotoTags.push(photoTag);
	});
	
	// Return value
	if (singleTag)
		return newPhotoTags[0];
	else
		return newPhotoTags;
}

function drawPhotoTag(tag, photo)
{	
	// Test if display dimensions has to be redrawn by
	// setting a simple text case. As long as one value
	// is missing or incorrect, redraw tag.
	var redrawTag = (tag.displayWidth != tag.width * photo.width());
	
	if (redrawTag)
	{
		// Calculate displayWidth
		tag.displayWidth = tag.width * photo.width();
		
		// Calculate displayHeight
		tag.displayHeight = tag.height * photo.height();
		
		// Calculate displayTop
		tag.displayTop = (tag.top * photo.height()) - (tag.displayHeight / 2);

		if (tag.displayTop < 0)
			tag.displayTop = 0;
		
		maxTop = photo.height() - tag.displayHeight;
		if (tag.displayTop > maxTop)
			tag.displayTop = maxTop;
		
		// Calculate displayLeft
		tag.displayLeft = (tag.left * photo.width()) - (tag.displayWidth / 2);
		
		if (tag.displayLeft < 0)
			tag.displayLeft = 0;
	
		maxLeft = photo.width() - tag.displayWidth;
		if (tag.displayLeft > maxLeft)
			tag.displayLeft = maxLeft;
	}

	// Create photoTag
	var photoTag = jQuery('<div class="photoTag">');
	photoTag.css({'width' : tag.displayWidth,
	              'height': tag.displayHeight,
	              'top'   : tag.displayTop,
	              'left'  : tag.displayLeft
	             })

	// Create photoTagBorder
	// - For dark/light photo where tag's border color
	//   might blend and dissappear within the photo.
	var photoTagBorder = jQuery('<div class="photoTagBorder">');
	photoTagBorder.css({'width' : tag.displayWidth - 4,
	                    'height': tag.displayHeight - 4,
	                    /* Override border styling with !important in CSS */   
	                    'border': '2px solid #222'
		               })
		          .appendTo(photoTag);

	// Update display dimensions into playlist tag except for unsubmitted tags
	if (tag.id!=null)
		updatePlaylistTag(tag);

	return photoTag;
}

function updatePlaylistTag(tag)
{	
	var playlistTag;
	
	// If tag exists, use it.
	var tags = jsPlaylist.photos[getPlaylistIndex(tag.photoId)].tags;
	jQuery.each(tags, function()
	{
		if (this.id==tag.id)
			playlistTag=this;
	})

	// If tag does not exist, create it.
	if (playlistTag==undefined)
		playlistTag = tags[tags.push(newPhotoTag())-1];
	
	// Merge tag's properties
	jQuery.extend(playlistTag, tag);
}

function displayPhotoTags(tags)
{
	// Before display photo Tag
	clearPhotoTag();
	clearPhotoTextTag();
	
	var photoImage = jQuery("#cGallery .photoImage");

	// photoTags container to follow photo position & dimension.
	var photoTags = jQuery("#cGallery .photoTags");
	photoTags.css({'width' : photoImage.width(),
		           'height': photoImage.height(),
		           'top'   : photoImage.position().top,
		           'left'  : photoImage.position().left
		          });

	createPhotoTag(tags);
	createPhotoTextTag(tags);
}

function addPhotoTag(userId)
{	
	var tag = jQuery("#cGallery .photoTag.new").data('tag');
	jax.call('community' , 'photos,ajaxAddPhotoTag', tag.photoId, userId, tag.top, tag.left, tag.width, tag.height);
	
	cancelNewPhotoTag();
}

function removePhotoTag(tag)
{
	jax.call('community', 'photos,ajaxRemovePhotoTag', tag.photoId, tag.userId);
	
	clearPhotoTag(tag);
	clearPhotoTextTag(tag);
		
	var tags = jsPlaylist.photos[getPlaylistIndex(tag.photoId)].tags;
	
	jQuery.each(tags, function(i)
	{
		if (this.id==tag.id)
			tags.splice(i, 1);
	});	
}

function clearPhotoTag(tag)
{	
	if (tag==undefined)
	{
		jQuery('#cGallery .photoTag').remove();
	} else {
		jQuery('#photoTag-' + tag.id).remove();
	}	
}

function showPhotoTag(id, classSuffix)
{
	jQuery('#photoTag-' + id).addClass('show' + classSuffix);
}

function hidePhotoTag(id)
{
	jQuery('#photoTag-' + id).removeClass('show showLabel showForce');
}

function createPhotoTextTag(tags)
{
	var photoTextTags = jQuery('#cGallery .photoTextTags');

	if (typeof(tags)=='string')
		tags = eval('(' + tags + ')');
	
	// If it's a single tag, put it into an array anyway.
	var singleTag = false;
	if (!jQuery.isArray(tags))
	{
		tags = [tags];
		singleTag = true;
	}

	// Create photo tag
	var newPhotoTextTags = new Array();
	jQuery.each(tags, function(i, tag)
	{		
		if (tag.id==undefined)
			return;

		// photoTextTag
		var photoTextTag = jQuery('<span class="photoTextTag"></span>');
		
		photoTextTag.data('tag', tag)
					.attr('id', 'photoTextTag-' + tag.id)
					.hover(
						function(){ showPhotoTag(tag.id, 'Force'); },
						function(){ hidePhotoTag(tag.id); }
					 )
					.appendTo(photoTextTags);			

		// photoTextTagLink
		var photoTextTagLink = jQuery('<a>');
		photoTextTagLink.attr('href', tag.profileUrl)
		                .html(tag.displayName)
						.prependTo(photoTextTag);
		
		// photoTextTagActions
		if (tag.canRemove) {
			/* Temporarily belong inside this if condition */
			var photoTextTagActions = jQuery('<span class="photoTextTagActions"></span>');
			photoTextTagActions.appendTo(photoTextTag);

			var photoTextTagAction_remove = jQuery('<a class="photoTextTagAction" href="javascript: void(0);"></a>');
			photoTextTagAction_remove.addClass('_remove')
									 .html(jsPlaylist.language.CC_REMOVE)
									 .click( function(){ removePhotoTag(tag); } )
									 .appendTo(photoTextTagActions);

			photoTextTagActions.before(' ').prepend('(').append(')');
		}

		newPhotoTextTags.push(photoTextTag);
	});
	
	commifyTextTags();

	return newPhotoTextTags;
}

function commifyTextTags()
{
	// Remove all comma	
	jQuery('#cGallery .photoTextTags .comma').remove();
	
	// Rebuild comma
	photoTextTag = jQuery('#cGallery .photoTextTag');
	photoTextTag.each(function(i)
	{
		if (i==0) return;
		
		var comma = jQuery('<span class="comma"></span>');
		comma.html(', ')
		     .prependTo(this);
	});
}

function clearPhotoTextTag(tag)
{
	if (tag==undefined)
	{
		jQuery('#cGallery .photoTextTag').remove();
	} else {
		jQuery('#photoTextTag-' + tag.id).remove();
		commifyTextTags();
	}
}

function startTagMode()
{
	jQuery('#cGallery .photoTagInstructions').slideDown('fast');
	jQuery('#startTagMode').hide();

	var photoViewport = jQuery('#cGallery .photoViewport');
	photoViewport.addClass('tagMode');

	var photo = jQuery('#cGallery .photoImage');
	var photoImage = photo;
	var photoTags = jQuery('#cGallery .photoTags');
	
	photoTags.click(function(e){

		// Remove any unsubmitted photo tags
		jQuery('.photoTag.new').remove();

		// Create new photo tag
		var photoTag = createPhotoTag(newPhotoTag({'photoId': currentPhoto().id,
												   'top'    : (e.pageY - jQuery(this).offset().top) / photo.height(),
			                                       'left'   : (e.pageX - jQuery(this).offset().left) / photo.width(),
		                                           'width'  : jsPlaylist.config.defaultTagWidth / photo.width(),
		                                           'height' : jsPlaylist.config.defaultTagHeight / photo.height()
			                                      }));
		photoTag.addClass('new');

		// Attach photoTagActions to photoTag
		var photoTagActions = jQuery('#cGallery .photoTagActions');
		photoTagActions.css({'top' : photoTag.position().top + photoTag.outerHeight(true),
			                 'left': photoTag.position().left
			                })
					   .show();

		photoTagActions.children('*').click(function(event){
			event.stopPropagation();
		});

	});
}

function stopTagMode()
{
	cancelNewPhotoTag();
	
	var photoViewport = jQuery('#cGallery .photoViewport');
	photoViewport.removeClass('tagMode');
			
	var photoTags = jQuery("#cGallery .photoTags");
	photoTags.unbind('click');

	jQuery('#cGallery .photoTagInstructions').hide();
	jQuery('#startTagMode').show();
	
	cWindowHide();
}

function selectNewPhotoTagFriend()
{
	var photoTagFriend = jQuery('#cGallery .photoTagFriend');
	
	// If user has no friend
	if (photoTagFriend.length<1)
	{
		cWindowShow(function()
		{
			jQuery('#cWindowContent').html(jsPlaylist.language.CC_PHOTO_TAG_NO_FRIEND);
		}, jsPlaylist.language.CC_SELECT_FRIEND, 450, 80);
		return;
	}
	
	// If user has tagged all friends
	if (currentPhoto().tags.length == photoTagFriend.length) {
		cWindowShow(function()
		{
			jQuery('#cWindowContent').html(jsPlaylist.language.CC_PHOTO_TAG_ALL_TAGGED);	
		}, jsPlaylist.language.CC_SELECT_FRIEND, 450, 80);
		return;
	}
	
	// Else, proceed as usual.
	cWindowShow(function(){
		showPhotoTagFriends();
	}, jsPlaylist.language.CC_SELECT_FRIEND, 300, 300);
	cWindowActions('<button class="button" onclick="confirmPhotoTagFriend();">' + jsPlaylist.language.CC_CONFIRM + '</button>');
	
}

function confirmPhotoTagFriend()
{
	//hide notice message if previously displayed.
	jQuery('#cWindow .js-system-message').hide();
	
	var photoTagFriendChecked = jQuery('#cWindow .photoTagFriend input:checked');
	if(photoTagFriendChecked.length > 0)
	{
		addPhotoTag(photoTagFriendChecked.val());
	} else {
		jQuery('#cWindow .js-system-message').show();
		jQuery('#cWindow .js-system-message').fadeOut(5000);
	}
}

function showPhotoTagFriends()
{		
	// Append friends master list to cWindow
	jQuery('#cWindowContent').empty();
	jQuery('#cGallery .photoTagSelectFriend').clone().appendTo('#cWindowContent');
			
	// Filter out all tagged users
	var filterOut = new Array();
	jQuery.each(currentPhoto().tags, function()
	{
		filterOut.push(this.userId);
	});

	filterPhotoTagFriend(filterOut);

	// Focus input box (after 300ms delay for the cWindow to fade in first)
	setTimeout("jQuery('#cWindowContent .photoTagFriendFilter').focus()", 300)
}

function filterPhotoTagFriend(filterOut)
{
	var photoTagFriend           = jQuery('#cWindow .photoTagFriend');
	var photoTagFriendFilter     = jQuery('#cWindow .photoTagFriendFilter');
	var photoTagFriendFilterText = jQuery.trim(photoTagFriendFilter.val());
	
	if (filterOut!=undefined)
	{
		jQuery.each(filterOut, function(i, userId)
		{			
			photoTagFriend.filter(function()
			{
				return jQuery(this).attr('id')=='photoTagFriend-' + userId;
			}).addClass('tagged');
		})
		
		return;
	}

	if (photoTagFriendFilterText=='')
	{
		photoTagFriend.not('.tagged')
		              .removeClass('hide');
		return;
	}

	photoTagFriend.not('.tagged')
	              .addClass('hide')
	              .filter(function()
	               {
	               	   return (this.textContent || this.innerText || '').toUpperCase().indexOf(photoTagFriendFilterText.toUpperCase()) >= 0
	               })
	              .removeClass('hide');
}

function cancelNewPhotoTag()
{
	var newPhotoTag = jQuery('.photoTag.new');
	newPhotoTag.remove();
	
	var photoTagActions = jQuery('#cGallery .photoTagActions');
	photoTagActions.hide();
}

function displayCreator(photoid)
{
	jax.call('community', 'photos,ajaxDisplayCreator', photoid);
}