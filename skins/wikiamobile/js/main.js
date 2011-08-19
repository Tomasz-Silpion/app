var WikiaMobile = {
	
	hideURLBar: function() {
		if ( $.os.android || $.os.ios || $.os.webos ) {
				//slide up the addressbar on webkit mobile browsers for maximum reading area
				//setTimeout is necessary to make it work on ios...
				  setTimeout( function() { 
				  	if (!pageYOffset) window.scrollTo( 0, 1 );
				  	}, 100 );
		}
	},
	
	moveAd: function() {
		$( '#adWrapper' ).addClass( 'hidden' );
		setTimeout( function() {
			$( '#adWrapper' ).removeClass( 'hidden up' );
		}, 600);
	},
	
	handleAds: function() {
		var hideOnTimeout = setTimeout( function() {
			$( window ).unbind( 'touchend' );
			WikiaMobile.moveAd();
		}, 15000 );
		
		$( document.body ).one( 'touchend', function() {
			if( hideOnTimeout ) clearTimeout( hideOnTimeout );
			WikiaMobile.moveAd();
		});
	},
	
	wrapArticles: function() {
		var content = $( '#WikiaMainContent' ).contents(),
		mainContent = '',
		firstH2 = true;
		for( var i = 0; i < content.length; i++ ) {
			var element = content[i];
			if ( element.nodeName === 'H2' ) {
				if( firstH2 ) {
					mainContent += '<button id="showAll" class="collapsed">Show All</button>' + element.outerHTML + '<section class=\"articleSection\">';
				} else {
					mainContent += '</section>' + element.outerHTML + '<section class=\"articleSection\">';
				}
				firstH2 = false;
			} else {
				mainContent += (!element.outerHTML)?element.textContent:element.outerHTML;
			}
		};
		mainContent += '</section>';
		document.getElementById('WikiaMainContent').innerHTML = mainContent;

	},

	init: function() {
		$( document.body ).delegate( '#openToggle', 'tap', function() {
			$( '#navigation').toggleClass( 'open' );
		});

		$( document.body ).delegate( '#navigationMenu > li', 'tap', function() {
			if ( !( $( this ).hasClass( 'openMenu' ) ) ) {
				
				$( '#navigationMenu > li' ).removeClass( 'openMenu' );
				$( this ).addClass( 'openMenu' );
				
				tab = "#" + $( this ).text().toLowerCase() + "Tab";
				$( '#openNavigationContent > div.navigationTab' ).removeClass( 'openTab' );
				$( tab ).addClass( 'openTab' );
			}
		});
		
		$( '#WikiaMainContent > h2' ).append( '<span class=\"arrow\"></span>' );
		
		$( document.body ).delegate( '#WikiaMainContent > h2', 'tap', function() {
			$(this).toggleClass('open').next().toggleClass('open');
			
		});
		
		$( document.body ).delegate( '#showAll', 'click', function() {
			var showAll = $( '#showAll' ),
				articleSection = $( '.articleSection' );
				
			if ( showAll.hasClass( 'collapsed' ) ) {
				articleSection.addClass( 'open' );
				showAll.text( 'Hide All' );
			} else {
				articleSection.removeClass( 'open' );
				showAll.text( 'Show All' );
			};
			showAll.toggleClass( 'collapsed' );
		});
		
		$( '#WikiaPage' ).bind( 'swipeLeft', function() {
			$( '#wikiaFooter, #navigation, #WikiaPage' ).css( 'display', 'none' );
			$( '#leftPane' ).css( { 'display': 'block', 'opacity': '1' } );
		});
		
		$( '#leftPane' ).bind( 'swipeRight', function() {
			$( '#wikiaFooter, #navigation, #WikiaPage' ).css( 'display', 'block'  );
			$( '#leftPane' ).css( { 'display': 'none', 'opacity': '0' } );
		});
	}
}

$( document ).ready( function() {
	WikiaMobile.hideURLBar();
	WikiaMobile.wrapArticles();
	WikiaMobile.handleAds();
	WikiaMobile.init();
});