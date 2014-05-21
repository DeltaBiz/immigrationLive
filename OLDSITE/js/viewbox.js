var Viewbox = Class.create();

Viewbox.prototype = {
	initialize: function() {	
		
		this.overlayOpacity = 0.7;
		this.overlayFadeTime = 0.3;
		this.viewboxSizeTime = 0.6;
		this.viewboxTopOffset = 50;
		this.viewboxBottomOffset = 0;
		this.viewboxMinHeight = 375;

		this.borderSize = 0;
		this.ajaxErrorMessage = "<p>Sorry, this page could not be found</p>";
		this.running = false;

		var objBody = document.getElementsByTagName("body").item(0);
		var objOverlay = document.createElement("div");
		objOverlay.setAttribute('id','vbOverlay');
		objOverlay.style.display = 'none';
		objOverlay.onclick = function() { myViewbox.end(); }
		objBody.appendChild(objOverlay);

		var objViewboxHolder = document.createElement("div");
		objViewboxHolder.setAttribute('id','viewboxHolder');
		objViewboxHolder.style.display = 'none';
		objBody.appendChild(objViewboxHolder);

		var objViewboxStaticCloseArea = document.createElement("div");
		objViewboxStaticCloseArea.setAttribute('id','vbhCloseArea');
		objViewboxHolder.appendChild(objViewboxStaticCloseArea);

		var objViewboxStaticCloseButton = document.createElement("a");
		objViewboxStaticCloseButton.setAttribute('id','vbhCloseButton');
		objViewboxStaticCloseButton.href = "#";
		objViewboxStaticCloseButton.onclick = function() { myViewbox.end(); return false; }
		objViewboxStaticCloseArea.appendChild(objViewboxStaticCloseButton);

		var viewboxBottom = document.createElement("div");
		viewboxBottom.setAttribute('id','viewboxBottom');
		viewboxBottom.style.display = 'none';
		objBody.appendChild(viewboxBottom);

		var objViewbox = document.createElement("div");
		objViewbox.setAttribute('id','viewbox');
		objViewbox.style.display = 'none';
		objBody.appendChild(objViewbox);

		var objViewboxCloseArea = document.createElement("div");
		objViewboxCloseArea.setAttribute('id','vbCloseArea');
		objViewbox.appendChild(objViewboxCloseArea);

		var objViewboxCloseButton = document.createElement("a");
		objViewboxCloseButton.setAttribute('id','vbCloseButton');
		objViewboxCloseButton.href = "#";
		objViewboxCloseButton.onclick = function() { myViewbox.end(); return false; }
		objViewboxCloseArea.appendChild(objViewboxCloseButton);

		var objViewboxMain = document.createElement("div");
		objViewboxMain.setAttribute('id','vbMain');
		objViewbox.appendChild(objViewboxMain);
		
		this.initializeTags(document);
	},

	changebox: function(event){ 
		if ( !$("viewbox").hasClassName("viewboxLoading") )
		{
			$("viewboxHolder").setStyle({
				height: ( $("viewbox").getHeight() - 14 ) + "px",
				width: $("viewbox").getWidth() + "px",
				top: $("viewbox").getStyle("top"),
				left: $("viewbox").getStyle("left"),
				display: $("viewbox").getStyle("display")
			});
			$("viewboxBottom").setStyle({
				height: $("viewbox").getHeight() + "px",
				width: $("viewbox").getWidth() + "px",
				top: $("viewbox").getStyle("top"),
				left: $("viewbox").getStyle("left"),
				display: $("viewbox").getStyle("display")
			});
		}
		else
		{
			$("viewboxHolder").hide();
			$("viewboxBottom").hide();
		}
	},
	
	initializeTags: function(el) {
		if (el.getElementsByTagName) { 
			var anchors = el.getElementsByTagName('a');
			// loop through all anchor tags
			for (var i=0; i<anchors.length; i++){
				var anchor = anchors[i];
				
				var relAttribute = String(anchor.getAttribute('rel'));
				
				// use the string.match() method to catch 'lightbox' references in the rel attribute
				if (anchor.getAttribute('href') && (relAttribute.toLowerCase().match('viewbox'))){
						
						
					anchor.onclick = function () {
						var revAttribute = String(this.getAttribute('rev'));
						if ( !revAttribute.blank() ) {
							var options = revAttribute.toQueryParams();
						} else {
							var options = {};
						}
						options.ajaxpage = this.getAttribute('href');
						
						myViewbox.start("", options); 
						return false;
					}
				}
			}
		}		
	},
	
	start: function(content) {	
		
		$('viewbox').hide();
		$("viewboxHolder").hide();
		$("viewboxBottom").hide();

		this.running = true;
		
		this.options = Object.extend({
			width: 763,
			height: 0.8,
			ajaxpage: ""
		}, arguments[1] || { });
		
		_this = this;
		new Effect.Appear('vbOverlay', { duration: this.overlayFadeTime, from: 0.0, to: this.overlayOpacity, afterFinish: _this.box(content) });
	},
	
	box: function(content)
	{
		$('vbMain').innerHTML = "";
		this.placeBox();
		
		_this = this;
		
		if ( content.empty() && !this.options.ajaxpage.empty() ) {
			maxHeight = $('viewbox').getHeight();
			$('viewbox').setStyle( { height: "auto" } );
			$('viewbox').addClassName("viewboxLoading");
			if ( maxHeight > $('viewbox').getHeight() )
			{
				newHeight = $('viewbox').getHeight();
				$('viewbox').setStyle( { top: ( document.viewport.getScrollOffsets().top + ( ( document.viewport.getDimensions().height - newHeight )/2 - _this.borderSize ) ) + "px" } );
			}
			else
				$('viewbox').setStyle( { height: maxHeight + "px" } );
			
			startHeight = $('viewbox').getHeight();
			
			$('viewbox').setStyle({overflow: "hidden"});

			new Ajax.Request( this.options.ajaxpage+"?new="+Math.random(), {
				method: 'get',
				parameters: { ajax: true },
				onSuccess: function(transport) {
					$('vbMain').innerHTML = transport.responseText;
					transport.responseText.evalScripts();
					_this.initializeTags($('vbMain'));
				},
				onFailure: function(transport) {
					$('vbMain').innerHTML = _this.ajaxErrorMessage;
				},
				onComplete: function(transport) {
					
					$('viewbox').removeClassName("viewboxLoading");
					$('viewbox').addClassName("viewboxShow");

					$('viewbox').setStyle( { height: "auto" } );

					if ( maxHeight > $('viewbox').getHeight() )
					{
						var newHeight = $('viewbox').getHeight();
					}
					else								
					{
						var newHeight = maxHeight;
					}
					
					if ( _this.viewboxMinHeight > $('viewbox').getHeight() )
						newHeight = _this.viewboxMinHeight;
					
					$('viewbox').setStyle( { height: startHeight + "px" } );


					new Effect.Morph( $('viewbox'), { 
						style: {
							height: newHeight + "px",
							top: ( document.viewport.getScrollOffsets().top + ( ( document.viewport.getDimensions().height - newHeight )/2 - _this.borderSize + _this.viewboxTopOffset/2 + _this.viewboxBottomOffset/2 ) ) + "px"
						},
						duration: _this.viewboxSizeTime,
						beforeStart: _this.changebox,
						beforeSetup: _this.changebox,
						afterSetup: _this.changebox,
						beforeUpdate: _this.changebox,
						afterUpdate: _this.changebox,
						afterFinish: function() { _this.changebox(); $('viewbox').setStyle({overflow: "auto"});}
					});
				}
			});
		}
		else
		{
			$('vbMain').innerHTML = content;
			$('viewbox').removeClassName("viewboxLoading");
			$('viewbox').addClassName("viewboxShow");
			maxHeight = $('viewbox').getHeight();
			$('viewbox').setStyle( { height: "auto" } );
			if ( maxHeight > $('viewbox').getHeight() )
			{
				newHeight = $('viewbox').getHeight();
				$('viewbox').setStyle( { top: ( document.viewport.getScrollOffsets().top + ( ( document.viewport.getDimensions().height - newHeight )/2 - _this.borderSize + _this.viewboxTopOffset/2 + _this.viewboxBottomOffset/2 ) ) + "px" } );
			}
			else
				$('viewbox').setStyle( { height: maxHeight + "px" } );

			this.changebox();
		}
		
		new Effect.Appear('viewbox', { duration: this.viewboxSizeTime, from: 0.0, to: 1.0 });
	},
	
	placeBox: function(type) {
		if ( this.running )
		{
			var settings = {};
			
			if ( !$('vbMain').innerHTML.empty() )
			{
				settings.width = $('viewbox').getWidth() - 2*this.borderSize;
				settings.height = $('viewbox').getHeight() - 2*this.borderSize;
			}
			else
			{
				if ( this.options.width <= 1 ) {
					settings.width = this.options.width * document.viewport.getDimensions().width;
				} else {
					settings.width = this.options.width;
				}
		
				if ( this.options.height <= 1 ) {
					settings.height = this.options.height * document.viewport.getDimensions().height;
				} else {
					settings.height = this.options.height;
				}
				
				settings.height -= this.viewboxTopOffset - this.viewboxBottomOffset;
		
				settings.width -= 2*this.borderSize;
				settings.height -= 2*this.borderSize;
			}
			
			if ( this.viewboxMinHeight > settings.height )
				settings.height = this.viewboxMinHeight;
			
			settings.left = ( document.viewport.getDimensions().width - settings.width )/2 - this.borderSize;
			settings.top = ( document.viewport.getDimensions().height - settings.height )/2 - this.borderSize + this.viewboxTopOffset/2 + this.viewboxBottomOffset/2 ;
	
			$('viewbox').setStyle({
				width: settings.width + "px",
				height: settings.height + "px",
				top: ( document.viewport.getScrollOffsets().top + settings.top ) + "px",
				left: ( document.viewport.getScrollOffsets().left + settings.left ) + "px"
			});
		}
		
		this.changebox();
	},
	
	end: function() {
		$('viewbox').hide();
		$("vbMain").innerHTML = "";
		$("viewboxHolder").hide();
		$("viewboxBottom").hide();
		new Effect.Fade('vbOverlay', { duration: this.overlayFadeTime });
		this.running = false;
	}
}

Event.observe(window, 'load', function(){ 
	if ( typeof(myViewbox) == "undefined" ) {
		myViewbox = new Viewbox;
	}
});
Event.observe(window, 'scroll', function(){ handleChange("scroll") } );
Event.observe(window, 'resize', function(){ handleChange("resize") } );

function handleChange() {
	if ( typeof(myViewbox) != "undefined" ) {
		myViewbox.placeBox();
	}
}
