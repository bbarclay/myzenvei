/**
 * Javascript file
 *
 * @package     AdminBar Docker
 * @version     1.1.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

var AdminBarDocker = new Class( {
	texts : {},
	icons : {},
	docks : {},
	spacers : {},
	scrollFx : new Fx.Scroll( window, { duration: 200 } ),
	dock_state : 'docked',
	dock_pos : 'top',
	autohide : 0,
	count : 0,

	initialize: function( template, texts )
	{
		if ( !$defined( abd_top ) || !$defined( abd_bottom ) ) {
			return;
		}

		var self = this;
		this.bodyElement = $( document.body );

		this.initElements();

		/* Set Texts */
		this.texts.undock =				texts[0];
		this.texts.dock =				texts[1];
		this.texts.reload =				texts[2];
		this.texts.top =				texts[3];
		this.texts.bottom =				texts[4];
		this.texts.dock_pos_top =		texts[5];
		this.texts.dock_pos_bottom =	texts[6];
		this.texts.autohide =			texts[7];
		this.texts.noautohide =			texts[8];

		/* Set Template */
		this.template = template;

		/* Set Iconset */
		this.iconset = new Element( 'div', { 'id': 'abd_icons' } )
			.addClass( 'abd_icons' )
			.addEvent( 'mouseenter', function() {
				self.openDockSlide( 'top' );
			} )
			.addEvent( 'mouseleave', function() {
				self.closeDockSlide( 'top' );
			} )
			.injectInside( this.bodyElement );
		
		/* Set Icons */
		this.icons.undocked = new Element( 'div' ).setStyle( 'display', 'none' ).injectInside( this.iconset );

		this.icons.reload =				this.createIcon( 'reload', this.texts.reload, this.icons.undocked ).addEvent( 'click', function() {
			self.reload();
		} );
		this.icons.top =				this.createIcon( 'top', this.texts.top, this.icons.undocked ).addEvent( 'click', function() {
			self.scroll( 'top' );
		} );
		this.icons.bottom =				this.createIcon( 'bottom', this.texts.bottom, this.icons.undocked ).addEvent( 'click', function() {
			self.scroll( 'bottom' );
		} );
		if ( this.elements.bottom.length ) {
			this.icons.toggle_dock_pos =	this.createIcon( 'dock_pos_bottom', this.texts.dock_pos_bottom, this.icons.undocked ).addEvent( 'click', function() {
				self.toggleDockPos();
			} );
		}
		if ( this.elements.top.length > 1 ) {
			this.icons.toggle_autohide =				this.createIcon( 'autohide', this.texts.autohide, this.icons.undocked ).addEvent( 'click', function() {
				self.toggleAutoHide();
			} );
		}
		this.icons.toggle_dock_state =		this.createIcon( 'undock', this.texts.undock, this.iconset ).addEvent( 'click', function() {
			self.toggleDockState();
		} );

		/* Set Docks */
		this.docks.top = new Element( 'div', { 'id': 'abd_dock_top' } )
			.addClass( 'abd_dock' )
			.addClass( 'abd_hidden' )
			.addEvent( 'mouseenter', function() {
				self.openDockSlide( 'top' );
			} )
			.addEvent( 'mouseleave', function() {
				self.closeDockSlide( 'top' );
			} )
			.injectInside( this.bodyElement );
		this.docks.top_inner = new Element( 'div' )
			.addClass( 'abd_dock_inner' )
			.injectInside( this.docks.top );
		this.docks.top_top = new Element( 'div' ).injectInside( this.docks.top_inner );
		this.docks.top_slide = new Element( 'div' ).injectInside( this.docks.top_inner );
		this.docks.top_slide.fx = new Fx.Slide( this.docks.top_slide, { duration: 200 } );

		this.docks.bottom = new Element( 'div', { 'id': 'abd_dock_bottom' } )
			.addClass( 'abd_dock' )
			.addClass( 'abd_hidden' )
			.addEvent( 'mouseenter', function() {
				self.openDockSlide( 'bottom' );
			} )
			.addEvent( 'mouseleave', function() {
				self.closeDockSlide( 'bottom' );
			} )
			.injectInside( this.bodyElement );
		this.docks.bottom_bar = new Element( 'div' ).setStyle( 'height', '10px' ).injectInside( this.docks.bottom );
		this.docks.bottom_bar.fx = new Fx.Slide( this.docks.bottom_bar, { duration: 200 } );
		this.docks.bottom_inner = new Element( 'div' )
			.addClass( 'abd_dock_inner' )
			.injectInside( this.docks.bottom );
		this.docks.bottom_slide = new Element( 'div' ).injectInside( this.docks.bottom_inner );
		this.docks.bottom_slide.fx = new Fx.Slide( this.docks.bottom_slide, { duration: 200 } );

		/* Set Spacers */
		this.spacers.top = new Element( 'div', { 'id': 'abd_spacer_top' } )
			.addClass( 'abd_spacer' )
			.addClass( 'abd_hidden' )
			.injectTop( this.bodyElement );
		this.spacers.top_top = new Element( 'div' ).injectInside( this.spacers.top );
		this.spacers.top_slide = new Element( 'div' ).injectInside( this.spacers.top );
		this.spacers.top_slide.fx = new Fx.Slide( this.spacers.top_slide, { duration: 200 } );
		
		this.spacers.bottom = new Element( 'div', { 'id': 'abd_spacer_bottom' } )
			.addClass( 'abd_spacer' )
			.addClass( 'abd_hidden' )
			.injectInside( this.bodyElement );
		this.spacers.bottom_bar = new Element( 'div' ).setStyle( 'height', '10px' ).injectInside( this.spacers.bottom );
		this.spacers.bottom_slide = new Element( 'div' ).injectInside( this.spacers.bottom );
		this.spacers.bottom_slide.fx = new Fx.Slide( this.spacers.bottom_slide, { duration: 200 } );

		if ( $('header-box') ) {
			home_icon = new Element( 'div', { 'id': 'abd_home_icon' } )
				.addEvent( 'click', function() { window.location.href = 'index.php' } )
				.injectTop( $('header-box') );
		}

		this.initState();

		this.correctPosComboBox();
	},

	initState: function()
	{
		/* Set cookies to opposite, correct settings by calling toggle functions */
		if ( Cookie.get( 'abd_dock_state' ) == 'undocked' ) {
			this.setDockState( 'docked' );
		} else {
			this.setDockState( 'undocked' );
		}
		if ( Cookie.get( 'abd_dock_pos' ) == 'bottom' ) {
			this.setDockPos( 'top' );
		} else {
			this.setDockPos( 'bottom' );
		}
		if ( Cookie.get( 'abd_autohide' ) == 1 ) {
			this.setAutoHide( 0 );
		} else {
			this.setAutoHide( 1 );
		}
		this.toggleDockState();
		this.toggleDockPos();
		this.toggleAutoHide( 1 );
	},

	setDockState: function( state )
	{
		this.dock_state = state;
		Cookie.set( 'abd_dock_state', state );
	},
	setDockPos: function( pos )
	{
		this.dock_pos = pos;
		Cookie.set( 'abd_dock_pos', pos );
	},
	setAutoHide: function( autohide )
	{
		this.autohide = autohide;
		Cookie.set( 'abd_autohide', autohide );
	},

	initElements: function()
	{
		var self = this;
		
		this.elements = { all: new Array(), top: new Array(), bottom: new Array() };


		abd_top.each ( function( el ) {
			if ( el != null ) {
				self.elements.all.include( el );
				self.elements.top.include( el );
			}
		} );
		abd_bottom.each ( function( el ) {
			if ( el != null ) {
				self.elements.all.include( el );
				self.elements.bottom.include( el );
			}
		} );
		this.elements.all.each ( function( el ) {
			var rel = ++self.count;
			el.setProperty( 'rel', 'abd_rel_'+rel );
			dummy = new Element( 'div', { 'id': 'abd_rel_'+rel } ).setStyle( 'margin-right',el.getStyle( 'margin-right' ) ).injectBefore( el );
		} );

	},
	
	createIcon: function( alias, title, parent )
	{
		var icon = new Element( 'div' )
		.setProperty( 'title',title )
		.addClass( 'abd_icon' ).addClass( 'abd_icon_'+alias ).setHTML( '<div></div>' )
		.injectInside( parent )
		icon.fx = new Fx.Style( icon, 'opacity', { duration: 200 } ).set( 0.6 );
		icon.addEvent( 'mouseenter', function(){ this.addClass( 'abd_icon_hover' ); this.fx.stop().start( 0.6, 1 ) } )
			.addEvent( 'mouseleave', function(){ this.removeClass( 'abd_icon_hover' ); this.fx.stop().start( 1, 0.6 ) } );
		return icon;
	},
	toggleDockState: function() {
		if ( this.dock_state == 'docked' ) {
			this.setDockState( 'undocked' );
			this.icons.undocked.setStyle( 'display', 'inline' );
			this.icons.toggle_dock_state.setProperty( 'title', this.texts.dock ).addClass( 'abd_icon_dock' ).removeClass( 'abd_icon_undock' );
		} else {
			this.setDockState( 'docked' );
			this.icons.undocked.setStyle( 'display', 'none' );
			this.icons.toggle_dock_state.setProperty( 'title', this.texts.undock ).addClass( 'abd_icon_undock' ).removeClass( 'abd_icon_dock' );
		}
		this.setElementsPositions();
	},
	toggleDockPos: function() {
		if ( this.dock_pos == 'top' ) {
			this.setDockPos( 'bottom' );
			if ( $defined( this.icons.toggle_dock_pos ) ) {
				this.icons.toggle_dock_pos.setProperty( 'title', this.texts.dock_pos_top ).addClass( 'abd_icon_dock_pos_top' ).removeClass( 'abd_icon_dock_pos_bottom' );
			}
		} else {
			this.setDockPos( 'top' );
			if ( $defined( this.icons.toggle_dock_pos ) ) {
				this.icons.toggle_dock_pos.setProperty( 'title', this.texts.dock_pos_bottom ).addClass( 'abd_icon_dock_pos_bottom' ).removeClass( 'abd_icon_dock_pos_top' );
			}
		}
		this.setElementsPositions();
		this.setDockSlides();
	},
	toggleAutoHide : function( init ) {
		if ( this.autohide != 1 ) {
			this.setAutoHide( 1 );
			if ( $defined( this.icons.toggle_autohide ) ) {
				this.icons.toggle_autohide.setProperty( 'title', this.texts.noautohide ).addClass( 'abd_icon_noautohide' ).removeClass( 'abd_icon_autohide' );
			}
			if ( init ) {
				this.setDockSlides( 1 );
			} else {
				this.spacers.top_slide.fx.stop().slideOut();
				this.closeDockSlide( 'bottom' );
			}
		} else {
			this.setAutoHide( 0 );
			if ( $defined( this.icons.toggle_autohide ) ) {
				this.icons.toggle_autohide.setProperty( 'title', this.texts.autohide ).addClass( 'abd_icon_autohide' ).removeClass( 'abd_icon_noautohide' );
			}
			if ( init ) {
				this.setDockSlides( 1 );
			} else {
				this.openDockSlide( 'top' );
				this.openDockSlide( 'bottom' );
			}
		}
	},
	setDockSlides : function( init ) {
		if ( this.autohide == 1 ) {
			this.docks.top_slide.fx.hide();
			this.spacers.top_slide.fx.hide();
			this.docks.bottom_slide.fx.hide();
			this.docks.bottom_bar.fx.show();
			//this.spacers.bottom_slide.fx.hide();
			if ( !init ) {
				this.docks.top_slide.fx.show();
				this.spacers.top_slide.fx.show();
			}
		} else {
			this.docks.top_slide.fx.show();
			this.spacers.top_slide.fx.show();
			this.docks.bottom_slide.fx.show();
			this.docks.bottom_bar.fx.hide();
			this.spacers.bottom_slide.fx.show();
		}
	},
	openDockSlide : function( pos ) {
		if ( pos == 'bottom' ) {
			this.docks.bottom_slide.fx.stop().slideIn();
			this.docks.bottom_bar.fx.stop().slideOut();
			//this.spacers.bottom_slide.fx.stop().slideIn();
			if ( this.autohide != 1 ) {
				this.spacers.bottom_slide.fx.stop().slideIn();
			}
		} else {
			this.docks.top_slide.fx.stop().slideIn();
			//this.spacers.top_slide.fx.stop().slideIn();
			if ( this.autohide != 1 ) {
				this.spacers.top_slide.fx.stop().slideIn();
			}
		}
	},
	closeDockSlide : function( pos ) {
		if( !this.autohide ) { return; }
		if ( pos == 'bottom' ) {
			this.docks.bottom_slide.fx.stop().slideOut();
			this.docks.bottom_bar.fx.stop().slideIn();
			this.spacers.bottom_slide.fx.stop().slideOut();
		} else {
			this.docks.top_slide.fx.stop().slideOut();
			this.spacers.top_slide.fx.stop().slideOut();
		}
	},
	reload : function() {
		window.location.reload( true );
	},
	scroll : function( to ) {
		if ( to == 'bottom' ) {
			this.scrollFx.toBottom();
		} else {
			this.scrollFx.toTop();
		}
	},
	setElementsPositions : function() {
		var self = this;
		this.elements.all.each ( function( el, i ){
			dummy = $( el.getProperty( 'rel' ) );
			if ( i == 0 ) {
				el.setStyle( 'margin-right', dummy.getStyle( 'margin-right' ) );
			}
			el.injectAfter( dummy );
		} );
		if ( this.dock_state == 'undocked' ) {
			this.elements.top.each ( function( el, i ){
				if ( i == 0 ) {
					el.setStyle( 'margin-right', '' );
					el.injectInside( self.docks.top_top );
					w = el.getStyle( 'margin-right' ).toInt() + self.iconset.getCoordinates().width - 1;
					el.setStyle( 'margin-right', w+'px' );
				} else {
					el.injectInside( self.docks.top_slide );
				}
			} );

			this.docks.bottom.addClass( 'abd_hidden' );
			this.spacers.bottom.addClass( 'abd_hidden' );

			if ( this.dock_pos == 'bottom' ) {
				this.elements.bottom.each ( function( el ){
					el.injectInside( self.docks.bottom_slide );
				} );
				this.docks.bottom.removeClass( 'abd_hidden' );
				this.spacers.bottom.removeClass( 'abd_hidden' );
			}
			this.docks.top.removeClass( 'abd_hidden' );
			this.spacers.top.removeClass( 'abd_hidden' );

			this.spacers.top_top.setStyle( 'height', this.docks.top_top.getCoordinates().height+'px' );
			this.spacers.top_slide.setStyle( 'height', this.docks.top_slide.getCoordinates().height+'px' );
			this.spacers.bottom_slide.setStyle( 'height', this.docks.bottom_slide.getCoordinates().height+'px' );

			this.docks.top_slide.fx.show();
			this.docks.bottom_slide.fx.hide();
			this.spacers.top_slide.fx.hide();
			this.spacers.bottom_slide.fx.hide();
			if ( this.autohide != 1 ) {
				this.spacers.top_slide.fx.show();
				this.docks.bottom_slide.fx.show();
				this.spacers.bottom_slide.fx.show();
			}
		} else {
			this.docks.top.addClass( 'abd_hidden' );
			this.docks.bottom.addClass( 'abd_hidden' );
			this.spacers.top.addClass( 'abd_hidden' );
			this.spacers.bottom.addClass( 'abd_hidden' );
		}
	},
	correctPosComboBox : function()
	{
		if ( document.combobox ) {
			$$('input.combobox').each( function( el ) {
				el.setStyle( 'top', '3px' ).setStyle( 'left', '3px' );
				el.getParent().setStyle( 'position', 'absolute' );
			});
		}
	}
} );