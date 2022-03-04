/**********************************************************
 Very minorly modified from the example by Tim Taylor
 http://tool-man.org/examples/sorting.html
 
 Added Coordinate.prototype.inside( northwest, southeast );
 
 **********************************************************/

var Coordinates = {
	ORIGIN : new Coordinate(0, 0),

	northwestPosition : function(element) {
		var x = parseInt(element.style.left);
		var y = parseInt(element.style.top);

		return new Coordinate(isNaN(x) ? 0 : x, isNaN(y) ? 0 : y);
	},

	southeastPosition : function(element) {
		return Coordinates.northwestPosition(element).plus(
				new Coordinate(element.offsetWidth, element.offsetHeight));
	},

	northwestOffset : function(element, isRecursive) {
		var offset = new Coordinate(element.offsetLeft, element.offsetTop);

		if (!isRecursive) return offset;

		var parent = element.offsetParent;
		while (parent) {
			offset = offset.plus(
					new Coordinate(parent.offsetLeft, parent.offsetTop));
			parent = parent.offsetParent;
		}
		return offset;
	},

	southeastOffset : function(element, isRecursive) {
		return Coordinates.northwestOffset(element, isRecursive).plus(
				new Coordinate(element.offsetWidth, element.offsetHeight));
	},

	fixEvent : function(event) {
		event.windowCoordinate = new Coordinate(event.clientX, event.clientY);
	}
};

function Coordinate(x, y) {
	this.x = x;
	this.y = y;
}

Coordinate.prototype.toString = function() {
	return "(" + this.x + "," + this.y + ")";
}

Coordinate.prototype.plus = function(that) {
	return new Coordinate(this.x + that.x, this.y + that.y);
}

Coordinate.prototype.minus = function(that) {
	return new Coordinate(this.x - that.x, this.y - that.y);
}

Coordinate.prototype.distance = function(that) {
	var deltaX = this.x - that.x;
	var deltaY = this.y - that.y;

	return Math.sqrt(Math.pow(deltaX, 2) + Math.pow(deltaY, 2));
}

Coordinate.prototype.max = function(that) {
	var x = Math.max(this.x, that.x);
	var y = Math.max(this.y, that.y);
	return new Coordinate(x, y);
}

Coordinate.prototype.constrain = function(min, max) {
	if (min.x > max.x || min.y > max.y) return this;

	var x = this.x;
	var y = this.y;

	if (min.x != null) x = Math.max(x, min.x);
	if (max.x != null) x = Math.min(x, max.x);
	if (min.y != null) y = Math.max(y, min.y);
	if (max.y != null) y = Math.min(y, max.y);

	return new Coordinate(x, y);
}

Coordinate.prototype.reposition = function(element) {
	element.style["top"] = this.y + "px";
	element.style["left"] = this.x + "px";
}

Coordinate.prototype.equals = function(that) {
	if (this == that) return true;
	if (!that || that == null) return false;

	return this.x == that.x && this.y == that.y;
}

// returns true of this point is inside specified box
Coordinate.prototype.inside = function(northwest, southeast) {
	if ((this.x >= northwest.x) && (this.x <= southeast.x) &&
		(this.y >= northwest.y) && (this.y <= southeast.y)) {
		
		return true;
	}
	return false;
}



/*
 * drag.js - click & drag DOM elements
 *
 * originally based on Youngpup's dom-drag.js, www.youngpup.net
 */

/**********************************************************
 Further modified from the example by Tim Taylor
 http://tool-man.org/examples/sorting.html
 
 Changed onMouseMove where it calls group.onDrag and then
 adjusts the offset for changes to the DOM.  If the item
 being moved changed parents it would be off so changed to
 get the absolute offset (recursive northwestOffset).
 
 **********************************************************/

var ZDrag = {
	BIG_Z_INDEX : 10000,
	group : null,
	isZDragging : false,

	makeZDraggable : function(group) {
		group.handle = group;
		group.handle.group = group;

		group.minX = null;
		group.minY = null;
		group.maxX = null;
		group.maxY = null;
		group.threshold = 0;
		group.thresholdY = 0;
		group.thresholdX = 0;

		group.onZDragStart = new Function();
		group.onZDragEnd = new Function();
		group.onZDrag = new Function();
		
		// TODO: use element.prototype.myFunc
		group.setZDragHandle = ZDrag.setZDragHandle;
		group.setZDragThreshold = ZDrag.setZDragThreshold;
		group.setZDragThresholdX = ZDrag.setZDragThresholdX;
		group.setZDragThresholdY = ZDrag.setZDragThresholdY;
		group.constrain = ZDrag.constrain;
		group.constrainVertical = ZDrag.constrainVertical;
		group.constrainHorizontal = ZDrag.constrainHorizontal;

		group.onmousedown = ZDrag.onMouseDown;
	},

	constrainVertical : function() {
		var nwOffset = Coordinates.northwestOffset(this, true);
		this.minX = nwOffset.x;
		this.maxX = nwOffset.x;
	},

	constrainHorizontal : function() {
		var nwOffset = Coordinates.northwestOffset(this, true);
		this.minY = nwOffset.y;
		this.maxY = nwOffset.y;
	},

	constrain : function(nwPosition, sePosition) {
		this.minX = nwPosition.x;
		this.minY = nwPosition.y;
		this.maxX = sePosition.x;
		this.maxY = sePosition.y;
	},

	setZDragHandle : function(handle) {
		if (handle && handle != null) 
			this.handle = handle;
		else
			this.handle = this;

		this.handle.group = this;
		this.onmousedown = null;
		this.handle.onmousedown = ZDrag.onMouseDown;
	},

	setZDragThreshold : function(threshold) {
		if (isNaN(parseInt(threshold))) return;

		this.threshold = threshold;
	},

	setZDragThresholdX : function(threshold) {
		if (isNaN(parseInt(threshold))) return;

		this.thresholdX = threshold;
	},

	setZDragThresholdY : function(threshold) {
		if (isNaN(parseInt(threshold))) return;

		this.thresholdY = threshold;
	},

	onMouseDown : function(event) {
		event = ZDrag.fixEvent(event);

		target=event.target || event.srcElement;
		if(target.nodeName=="SELECT" || target.nodeName=="INPUT" || target.nodeName=="TEXTAREA" || target.nodeName=="SPAN" || jQuery(target).getParent('.ze_fieldtype_alias_div')) return;
		ZDrag.group = this.group;

		var group = this.group;
		var mouse = event.windowCoordinate;
		var nwOffset = Coordinates.northwestOffset(group, true);
		var nwPosition = Coordinates.northwestPosition(group);
		var sePosition = Coordinates.southeastPosition(group);
		var seOffset = Coordinates.southeastOffset(group, true);

		group.originalOpacity = group.style.opacity;
		group.originalZIndex = group.style.zIndex;
		group.initialWindowCoordinate = mouse;
		// TODO: need a better name, but don't yet understand how it
		// participates in the magic while ZDragging 
		group.dragCoordinate = mouse;

		ZDrag.showStatus(mouse, nwPosition, sePosition, nwOffset, seOffset);

		group.onZDragStart(nwPosition, sePosition, nwOffset, seOffset);

		// TODO: need better constraint API
		if (group.minX != null)
			group.minMouseX = mouse.x - nwPosition.x + 
					group.minX - nwOffset.x;
		if (group.maxX != null) 
			group.maxMouseX = group.minMouseX + group.maxX - group.minX;

		if (group.minY != null)
			group.minMouseY = mouse.y - nwPosition.y + 
					group.minY - nwOffset.y;
		if (group.maxY != null) 
			group.maxMouseY = group.minMouseY + group.maxY - group.minY;

		group.mouseMin = new Coordinate(group.minMouseX, group.minMouseY);
		group.mouseMax = new Coordinate(group.maxMouseX, group.maxMouseY);

		document.onmousemove = ZDrag.onMouseMove;
		document.onmouseup = ZDrag.onMouseUp;

		return false;
	},

	showStatus : function(mouse, nwPosition, sePosition, nwOffset, seOffset) {
		window.status = 
				"mouse: " + mouse.toString() + "    " + 
				"NW pos: " + nwPosition.toString() + "    " + 
				"SE pos: " + sePosition.toString() + "    " + 
				"NW offset: " + nwOffset.toString() + "    " +
				"SE offset: " + seOffset.toString();
	},

	onMouseMove : function(event) {
		event = ZDrag.fixEvent(event);
		var group = ZDrag.group;
		var mouse = event.windowCoordinate;
		var nwOffset = Coordinates.northwestOffset(group, true);
		var nwPosition = Coordinates.northwestPosition(group);
		var sePosition = Coordinates.southeastPosition(group);
		var seOffset = Coordinates.southeastOffset(group, true);

		ZDrag.showStatus(mouse, nwPosition, sePosition, nwOffset, seOffset);

		if (!ZDrag.isZDragging) {
			if (group.threshold > 0) {
				var distance = group.initialWindowCoordinate.distance(
						mouse);
				if (distance < group.threshold) return true;
			} else if (group.thresholdY > 0) {
				var deltaY = Math.abs(group.initialWindowCoordinate.y - mouse.y);
				if (deltaY < group.thresholdY) return true;
			} else if (group.thresholdX > 0) {
				var deltaX = Math.abs(group.initialWindowCoordinate.x - mouse.x);
				if (deltaX < group.thresholdX) return true;
			}

			ZDrag.isZDragging = true;
			group.style["zIndex"] = ZDrag.BIG_Z_INDEX;
			group.style["opacity"] = 0.75;
		}

		// TODO: need better constraint API
		var adjusted = mouse.constrain(group.mouseMin, group.mouseMax);
		nwPosition = nwPosition.plus(adjusted.minus(group.dragCoordinate));
		nwPosition.reposition(group);
		group.dragCoordinate = adjusted;

		// once dragging has started, the position of the group
		// relative to the mouse should stay fixed.  They can get out
		// of sync if the DOM is manipulated while dragging, so we
		// correct the error here
		//
		// TODO: what we really want to do is find the offset from
		// our corner to the mouse coordinate and adjust to keep it
		// the same
		
		// changed to be recursive/use absolute offset for corrections
		var offsetBefore = Coordinates.northwestOffset(group, true);
		group.onZDrag(nwPosition, sePosition, nwOffset, seOffset);
		var offsetAfter = Coordinates.northwestOffset(group, true);

		if (!offsetBefore.equals(offsetAfter)) {
			var errorDelta = offsetBefore.minus(offsetAfter);
			nwPosition = Coordinates.northwestPosition(group).plus(errorDelta);
			nwPosition.reposition(group);
		}

		return false;
	},

	onMouseUp : function(event) {
		event = ZDrag.fixEvent(event);
		var group = ZDrag.group;

		var mouse = event.windowCoordinate;
		var nwOffset = Coordinates.northwestOffset(group, true);
		var nwPosition = Coordinates.northwestPosition(group);
		var sePosition = Coordinates.southeastPosition(group);
		var seOffset = Coordinates.southeastOffset(group, true);

		document.onmousemove = null;
		document.onmouseup   = null;
		group.onZDragEnd(nwPosition, sePosition, nwOffset, seOffset);

		if (ZDrag.isZDragging) {
			// restoring zIndex before opacity avoids visual flicker in Firefox
			group.style["zIndex"] = group.originalZIndex;
			group.style["opacity"] = group.originalOpacity;
		}

		ZDrag.group = null;
		ZDrag.isZDragging = false;

		return false;
	},

	fixEvent : function(event) {
		if (typeof event == 'undefined') event = window.event;
		Coordinates.fixEvent(event);

		return event;
	}
};




/**********************************************************
 Adapted from the sortable lists example by Tim Taylor
 http://tool-man.org/examples/sorting.html
 
 **********************************************************/

var ZDragDrop = {
	firstContainer : null,
	lastContainer : null,
	
	makeListContainer : function(list) {
		// each container becomes a linked list node
		if (this.firstContainer == null) {
			this.firstContainer = this.lastContainer = list;
			list.previousContainer = null;
			list.nextContainer = null;
		} else {
			list.previousContainer = this.lastContainer;
			list.nextContainer = null;
			this.lastContainer.nextContainer = list;
			this.lastContainer = list;
		}
		
		// these functions are called when an item is draged over
		// a container or out of a container bounds.  onZDragOut
		// is also called when the drag ends with an item having
		// been added to the container
		list.onZDragOver = new Function();
		list.onZDragOut = new Function();
		
    	var items = list.getElementsByTagName( "li" );
    	
		for (var i = 0; i < items.length; i++) {
			ZDragDrop.makeItemZDragable(items[i]);
		}
	},

	makeItemZDragable : function(item) {
		ZDrag.makeZDraggable(item);
		item.setZDragThreshold(5);
		
		// tracks if the item is currently outside all containers
		item.isOutside = false;
		
		item.onZDragStart = ZDragDrop.onZDragStart;
		item.onZDrag = ZDragDrop.onZDrag;
		item.onZDragEnd = ZDragDrop.onZDragEnd;
	},

	onZDragStart : function(nwPosition, sePosition, nwOffset, seOffset) {
		// update all container bounds, since they may have changed
		// on a previous drag
		//
		// could be more smart about when to do this
		var container = ZDragDrop.firstContainer;
		while (container != null) {
			container.northwest = Coordinates.northwestOffset( container, true );
			container.southeast = Coordinates.southeastOffset( container, true );
			container = container.nextContainer;
		}
		
		// item starts out over current parent
		this.parentNode.onZDragOver();
	},

	onZDrag : function(nwPosition, sePosition, nwOffset, seOffset) {
		// check if we were nowhere
		if (this.isOutside) {
			// check each container to see if in its bounds
			var container = ZDragDrop.firstContainer;
			while (container != null) {
				if (nwOffset.inside( container.northwest, container.southeast ) ||
					seOffset.inside( container.northwest, container.southeast )) {
					// we're inside this one
					container.onZDragOver();
					this.isOutside = false;
					
					// since isOutside was true, the current parent is a
					// temporary clone of some previous container node and
					// it needs to be removed from the document

					//SHERZA: закомментировала нижние строки
					/*var tempParent = this.parentNode;
					tempParent.removeChild( this );
					container.appendChild( this );
					tempParent.parentNode.removeChild( tempParent );*/
					break;
				}
				container = container.nextContainer;
			}
			// we're still not inside the bounds of any container
			if (this.isOutside)
				return;
		
		// check if we're outside our parent's bounds
		} else if (!(nwOffset.inside( this.parentNode.northwest, this.parentNode.southeast ) ||
			seOffset.inside( this.parentNode.northwest, this.parentNode.southeast ))) {
			
			this.parentNode.onZDragOut();
			this.isOutside = true;
			
			// check if we're inside a new container's bounds
			var container = ZDragDrop.firstContainer;
			while (container != null) {
				if (nwOffset.inside( container.northwest, container.southeast ) ||
					seOffset.inside( container.northwest, container.southeast )) {
					// we're inside this one
					container.onZDragOver();
					this.isOutside = false;
					this.parentNode.removeChild( this );
					container.appendChild( this );
					break;
				}
				container = container.nextContainer;
			}
			// if we're not in any container now, make a temporary clone of
			// the previous container node and add it to the document
			if (this.isOutside) {
				//SHERZA: закомментировала нижние строки
				/*var tempParent = this.parentNode.cloneNode( false );
				this.parentNode.removeChild( this );
				tempParent.appendChild( this );
				document.getElementsByTagName( "body" ).item(0).appendChild( tempParent );*/
				return;
			}
		}
		
		// if we get here, we're inside some container bounds, so we do
		// everything the original dragsort script did to swap us into the
		// correct position
		
		var parent = this.parentNode;
				
		var item = this;
		var next = ZDragUtils.nextItem(item);
		while (next != null && this.offsetTop >= next.offsetTop - 2) {
			var item = next;
			var next = ZDragUtils.nextItem(item);
		}
		if (this != item) {
			ZDragUtils.swap(this, next);
			return;
		}

		var item = this;
		var previous = ZDragUtils.previousItem(item);
		while (previous != null && this.offsetTop <= previous.offsetTop + 2) {
			var item = previous;
			var previous = ZDragUtils.previousItem(item);
		}
		if (this != item) {
			ZDragUtils.swap(this, item);
			return;
		}
	},

	onZDragEnd : function(nwPosition, sePosition, nwOffset, seOffset) {
		// if the drag ends and we're still outside all containers
		// it's time to remove ourselves from the document
		if (this.isOutside) {
			//SHERZA: закомментировала нижние строки

			/*var tempParent = this.parentNode;
			this.parentNode.removeChild( this );
			tempParent.parentNode.removeChild( tempParent );
			return;*/
			this.isOutside=false; //SHERZA
		}
		this.parentNode.onZDragOut();
		this.style["top"] = "0px";
		this.style["left"] = "0px";

		onZDragEndFunction(this);
	}
};

var ZDragUtils = {
	swap : function(item1, item2) {
		var parent = item1.parentNode;
		parent.removeChild(item1);
		parent.insertBefore(item1, item2);

		item1.style["top"] = "0px";
		item1.style["left"] = "0px";
	},

	nextItem : function(item) {
		var sibling = item.nextSibling;
		while (sibling != null) {
			if (sibling.nodeName == item.nodeName) return sibling;
			sibling = sibling.nextSibling;
		}
		return null;
	},

	previousItem : function(item) {
		var sibling = item.previousSibling;
		while (sibling != null) {
			if (sibling.nodeName == item.nodeName) return sibling;
			sibling = sibling.previousSibling;
		}
		return null;
	}		
};


function onZDragEndFunction(li){
	//var fid = li.getAttribute('fid');
	var lis=[];
	jQuery('#userinfo_tab_ul_userinfo .jform_params_userinfofieldName').each(function(el, i){
		if(i)lis[i-1]=el.value;
	});
	jQuery('jform_params_userinfoordering').value=lis.join('|');
}
