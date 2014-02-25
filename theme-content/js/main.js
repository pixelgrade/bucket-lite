/* ====== JS PLUGINS & EXTENSIONS ====== */

/* --- $OVERTHROW --- */
/* Overthrow. An overflow:auto polyfill for responsive design. 
 * (c) 2012: Scott Jehl, Filament Group, Inc.
 */
/* Detect */
 (function(w,undefined){var doc=w.document,docElem=doc.documentElement,enabledClassName="overthrow-enabled",canBeFilledWithPoly="ontouchmove"in doc,nativeOverflow="WebkitOverflowScrolling"in docElem.style||("msOverflowStyle"in docElem.style||(!canBeFilledWithPoly&&w.screen.width>800||function(){var ua=w.navigator.userAgent,webkit=ua.match(/AppleWebKit\/([0-9]+)/),wkversion=webkit&&webkit[1],wkLte534=webkit&&wkversion>=534;return ua.match(/Android ([0-9]+)/)&&(RegExp.$1>=3&&wkLte534)||(ua.match(/ Version\/([0-9]+)/)&&
(RegExp.$1>=0&&(w.blackberry&&wkLte534))||(ua.indexOf("PlayBook")>-1&&(wkLte534&&!ua.indexOf("Android 2")===-1)||(ua.match(/Firefox\/([0-9]+)/)&&RegExp.$1>=4||(ua.match(/wOSBrowser\/([0-9]+)/)&&(RegExp.$1>=233&&wkLte534)||ua.match(/NokiaBrowser\/([0-9\.]+)/)&&(parseFloat(RegExp.$1)===7.3&&(webkit&&wkversion>=533))))))}()));w.overthrow={};w.overthrow.enabledClassName=enabledClassName;w.overthrow.addClass=function(){if(docElem.className.indexOf(w.overthrow.enabledClassName)===-1)docElem.className+=
" "+w.overthrow.enabledClassName};w.overthrow.removeClass=function(){docElem.className=docElem.className.replace(w.overthrow.enabledClassName,"")};w.overthrow.set=function(){if(nativeOverflow)w.overthrow.addClass()};w.overthrow.canBeFilledWithPoly=canBeFilledWithPoly;w.overthrow.forget=function(){w.overthrow.removeClass()};w.overthrow.support=nativeOverflow?"native":"none"})(this);

/* Polifyll */
 (function(w,o,undefined){if(o===undefined)return;o.scrollIndicatorClassName="overthrow";var doc=w.document,docElem=doc.documentElement,nativeOverflow=o.support==="native",canBeFilledWithPoly=o.canBeFilledWithPoly,configure=o.configure,set=o.set,forget=o.forget,scrollIndicatorClassName=o.scrollIndicatorClassName;o.closest=function(target,ascend){return!ascend&&(target.className&&(target.className.indexOf(scrollIndicatorClassName)>-1&&target))||o.closest(target.parentNode)};var enabled=false;o.set=
function(){set();if(enabled||(nativeOverflow||!canBeFilledWithPoly))return;w.overthrow.addClass();enabled=true;o.support="polyfilled";o.forget=function(){forget();enabled=false;if(doc.removeEventListener)doc.removeEventListener("touchstart",start,false)};var elem,lastTops=[],lastLefts=[],lastDown,lastRight,resetVertTracking=function(){lastTops=[];lastDown=null},resetHorTracking=function(){lastLefts=[];lastRight=null},inputs,setPointers=function(val){inputs=elem.querySelectorAll("textarea, input");
for(var i=0,il=inputs.length;i<il;i++)inputs[i].style.pointerEvents=val},changeScrollTarget=function(startEvent,ascend){if(doc.createEvent){var newTarget=(!ascend||ascend===undefined)&&elem.parentNode||(elem.touchchild||elem),tEnd;if(newTarget!==elem){tEnd=doc.createEvent("HTMLEvents");tEnd.initEvent("touchend",true,true);elem.dispatchEvent(tEnd);newTarget.touchchild=elem;elem=newTarget;newTarget.dispatchEvent(startEvent)}}},start=function(e){if(o.intercept)o.intercept();resetVertTracking();resetHorTracking();
elem=o.closest(e.target);if(!elem||(elem===docElem||e.touches.length>1))return;setPointers("none");var touchStartE=e,scrollT=elem.scrollTop,scrollL=elem.scrollLeft,height=elem.offsetHeight,width=elem.offsetWidth,startY=e.touches[0].pageY,startX=e.touches[0].pageX,scrollHeight=elem.scrollHeight,scrollWidth=elem.scrollWidth,move=function(e){var ty=scrollT+startY-e.touches[0].pageY,tx=scrollL+startX-e.touches[0].pageX,down=ty>=(lastTops.length?lastTops[0]:0),right=tx>=(lastLefts.length?lastLefts[0]:
0);if(ty>0&&ty<scrollHeight-height||tx>0&&tx<scrollWidth-width)e.preventDefault();else changeScrollTarget(touchStartE);if(lastDown&&down!==lastDown)resetVertTracking();if(lastRight&&right!==lastRight)resetHorTracking();lastDown=down;lastRight=right;elem.scrollTop=ty;elem.scrollLeft=tx;lastTops.unshift(ty);lastLefts.unshift(tx);if(lastTops.length>3)lastTops.pop();if(lastLefts.length>3)lastLefts.pop()},end=function(e){setPointers("auto");setTimeout(function(){setPointers("none")},450);elem.removeEventListener("touchmove",
move,false);elem.removeEventListener("touchend",end,false)};elem.addEventListener("touchmove",move,false);elem.addEventListener("touchend",end,false)};doc.addEventListener("touchstart",start,false)}})(this,this.overthrow);




/* ====== SHARED VARS ====== */
	var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;

	var ua = navigator.userAgent;
	var winLoc = window.location.toString();

	var is_webkit = ua.match(/webkit/i);
	var is_firefox = ua.match(/gecko/i);
	var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
	var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
	var is_ancient_ie = ua.match(/msie 6/i);
	var is_mobile = ua.match(/mobile/i);
	var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

	var nua = navigator.userAgent;
	var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

	var useTransform = true;
	var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
	var transform;

	// setting up transform prefixes
	var prefixes = {
		webkit: 'webkitTransform',
		firefox: 'MozTransform',
		ie: 'msTransform',
		w3c: 'transform'
	};

	if (useTransform) {
		if (is_webkit) {
			transform = prefixes.webkit;
		} else if (is_firefox) {
			transform = prefixes.firefox;
		} else if (is_newer_ie) {
			transform = prefixes.ie;
		}
	}

(function($, window, undefined) {

	/* --- DETECT PLATFORM --- */

	function platformDetect(){
		$.support.touch = 'ontouchend' in document;
		var navUA = navigator.userAgent.toLowerCase(),
		navPlat = navigator.platform.toLowerCase();
		
		var isiPhone = navPlat.indexOf("iphone"),
		isiPod = navPlat.indexOf("ipod"),
		isAndroidPhone = navPlat.indexOf("android"),
		safari = (navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1) ? true : false,
		svgSupport = (window.SVGAngle) ? true : false,
		svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
		ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;
		
		phone = (isiPhone > -1 || isiPod > -1 || isAndroidPhone > -1) ? true : false;
		touch = $.support.touch ? true : false;
		ltie9 = $.support.leadingWhitespace ? false : true;
		lteie9 = typeof window.atob === 'undefined' ? true : false;

		var $bod = $('body');
		
		if (touch) {$bod.addClass('touch');}
		if (safari) $bod.addClass('safari');
		if (phone) $bod.addClass('phone');   
	};




	/* ====== PLUGINS & EXTENSIONS ====== */

	/* --- $MODERNIZR --- */

	/* Modernizr 2.7.0 (Custom Build) | MIT & BSD
	 * Build: http://modernizr.com/download/#-flexbox-flexboxlegacy-cssanimations-csstransforms-csstransforms3d-csstransitions-touch-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
	 */
	;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.7.0",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.flexbox=function(){return F("flexWrap")},q.flexboxlegacy=function(){return F("boxDirection")},q.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:w(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},q.cssanimations=function(){return F("animationName")},q.csstransforms=function(){return!!F("transform")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&w("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},q.csstransitions=function(){return F("transition")};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
	

	/* --- $HOVERINTENT --- */

	/* hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
	* http://cherne.net/brian/resources/jquery.hoverIntent.html
	*
	* You may use hoverIntent under the terms of the MIT license.
	* Copyright 2007, 2013 Brian Cherne
	*/
	(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery)


  
	/* --- $SALVATTORE --- */

	/*
	 * Salvattore 1.0.4 by @rnmp and @ppold
	 * https://github.com/rnmp/salvattore
	 */
	function salvattore(){(function(root, factory) {
		if(typeof exports === 'object') {
			module.exports = factory();
		}
		else if(typeof define === 'function' && define.amd) {
			define('salvattore', [], factory);
		}
		else {
			root.salvattore = factory();
		}
	}(this, function() {
		/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

		window.matchMedia || (window.matchMedia = function() {
			"use strict";

			// For browsers that support matchMedium api such as IE 9 and webkit
			var styleMedia = (window.styleMedia || window.media);

			// For those that don't support matchMedium
			if (!styleMedia) {
				var style       = document.createElement('style'),
					script      = document.getElementsByTagName('script')[0],
					info        = null;

				style.type  = 'text/css';
				style.id    = 'matchmediajs-test';

				script.parentNode.insertBefore(style, script);

				// 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
				info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

				styleMedia = {
					matchMedium: function(media) {
						var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

						// 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
						if (style.styleSheet) {
							style.styleSheet.cssText = text;
						} else {
							style.textContent = text;
						}

						// Test if media query is true or false
						return info.width === '1px';
					}
				};
			}

			return function(media) {
				return {
					matches: styleMedia.matchMedium(media || 'all'),
					media: media || 'all'
				};
			};
		}());
		;/*! matchMedia() polyfill addListener/removeListener extension. Author & copyright (c) 2012: Scott Jehl. Dual MIT/BSD license */
		(function(){
			// Bail out for browsers that have addListener support
			if (window.matchMedia && window.matchMedia('all').addListener) {
				return false;
			}

			var localMatchMedia = window.matchMedia,
				hasMediaQueries = localMatchMedia('only all').matches,
				isListening     = false,
				timeoutID       = 0,    // setTimeout for debouncing 'handleChange'
				queries         = [],   // Contains each 'mql' and associated 'listeners' if 'addListener' is used
				handleChange    = function(evt) {
					// Debounce
					clearTimeout(timeoutID);

					timeoutID = setTimeout(function() {
						for (var i = 0, il = queries.length; i < il; i++) {
							var mql         = queries[i].mql,
								listeners   = queries[i].listeners || [],
								matches     = localMatchMedia(mql.media).matches;

							// Update mql.matches value and call listeners
							// Fire listeners only if transitioning to or from matched state
							if (matches !== mql.matches) {
								mql.matches = matches;

								for (var j = 0, jl = listeners.length; j < jl; j++) {
									listeners[j].call(window, mql);
								}
							}
						}
					}, 30);
				};

			window.matchMedia = function(media) {
				var mql         = localMatchMedia(media),
					listeners   = [],
					index       = 0;

				mql.addListener = function(listener) {
					// Changes would not occur to css media type so return now (Affects IE <= 8)
					if (!hasMediaQueries) {
						return;
					}

					// Set up 'resize' listener for browsers that support CSS3 media queries (Not for IE <= 8)
					// There should only ever be 1 resize listener running for performance
					if (!isListening) {
						isListening = true;
						window.addEventListener('resize', handleChange, true);
					}

					// Push object only if it has not been pushed already
					if (index === 0) {
						index = queries.push({
							mql         : mql,
							listeners   : listeners
						});
					}

					listeners.push(listener);
				};

				mql.removeListener = function(listener) {
					for (var i = 0, il = listeners.length; i < il; i++){
						if (listeners[i] === listener){
							listeners.splice(i, 1);
						}
					}
				};

				return mql;
			};
		}());
		;// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

// MIT license

		(function() {
			var lastTime = 0;
			var vendors = ['ms', 'moz', 'webkit', 'o'];
			for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
				window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
				window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
					|| window[vendors[x]+'CancelRequestAnimationFrame'];
			}

			if (!window.requestAnimationFrame)
				window.requestAnimationFrame = function(callback, element) {
					var currTime = new Date().getTime();
					var timeToCall = Math.max(0, 16 - (currTime - lastTime));
					var id = window.setTimeout(function() { callback(currTime + timeToCall); },
						timeToCall);
					lastTime = currTime + timeToCall;
					return id;
				};

			if (!window.cancelAnimationFrame)
				window.cancelAnimationFrame = function(id) {
					clearTimeout(id);
				};
		}());
		;var salvattore = (function (global, document, undefined) {
			"use strict";

			var self = {},
				grids = [],
				add_to_dataset = function(element, key, value) {
					// uses dataset function or a fallback for <ie10
					if (element.dataset) {
						element.dataset[key] = value;
					} else {
						element.setAttribute("data-" + key, value);
					}
					return;
				};

			self.obtain_grid_settings = function obtain_grid_settings(element) {
				// returns the number of columns and the classes a column should have,
				// from computing the style of the ::before pseudo-element of the grid.

				var computedStyle = global.getComputedStyle(element, ":before")
					, content = computedStyle.getPropertyValue("content").slice(1, -1)
					, matchResult = content.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/)
					, numberOfColumns
					, columnClasses
					;

				if (matchResult) {
					numberOfColumns = matchResult[1];
					columnClasses = matchResult[2];
					columnClasses = columnClasses? columnClasses.split(".") : ["column"];
				} else {
					matchResult = content.match(/^\s*\.(.+)\s+(\d+)\s*$/);
					columnClasses = matchResult[1];
					numberOfColumns = matchResult[2];
					if (numberOfColumns) {
						numberOfColumns = numberOfColumns.split(".");
					}
				}

				return {
					numberOfColumns: numberOfColumns,
					columnClasses: columnClasses
				};
			};


			self.add_columns = function add_columns(grid, items) {
				// from the settings obtained, it creates columns with
				// the configured classes and adds to them a list of items.

				var settings = self.obtain_grid_settings(grid)
					, numberOfColumns = settings.numberOfColumns
					, columnClasses = settings.columnClasses
					, columnsItems = new Array(+numberOfColumns)
					, columnsFragment = document.createDocumentFragment()
					, i = numberOfColumns
					, selector
					;

				while (i-- !== 0) {
					selector = "[data-columns] > *:nth-child(" + numberOfColumns + "n-" + i + ")";
					columnsItems.push(items.querySelectorAll(selector));
				}

				columnsItems.forEach(function append_to_grid_fragment(rows) {
					var column = document.createElement("div")
						, rowsFragment = document.createDocumentFragment()
						;

					column.className = columnClasses.join(" ");

					Array.prototype.forEach.call(rows, function append_to_column(row) {
						rowsFragment.appendChild(row);
					});
					column.appendChild(rowsFragment);
					columnsFragment.appendChild(column);
				});

				grid.appendChild(columnsFragment);
				add_to_dataset(grid, 'columns', numberOfColumns);
			};


			self.remove_columns = function remove_columns(grid) {
				// removes all the columns from a grid, and returns a list
				// of items sorted by the ordering of columns.

				var range = document.createRange();
				range.selectNodeContents(grid);

				var columns = Array.prototype.filter.call(range.extractContents().childNodes, function filter_elements(node) {
					return node instanceof global.HTMLElement;
				});

				var numberOfColumns = columns.length
					, numberOfRowsInFirstColumn = columns[0].childNodes.length
					, sortedRows = new Array(numberOfRowsInFirstColumn * numberOfColumns)
					;

				Array.prototype.forEach.call(columns, function iterate_columns(column, columnIndex) {
					Array.prototype.forEach.call(column.children, function iterate_rows(row, rowIndex) {
						sortedRows[rowIndex * numberOfColumns + columnIndex] = row;
					});
				});

				var container = document.createElement("div");
				add_to_dataset(container, 'columns', 0);

				sortedRows.filter(function filter_non_null(child) {
					return !!child;
				}).forEach(function append_row(child) {
					container.appendChild(child);
				});

				return container;
			};


			self.recreate_columns = function recreate_columns(grid) {
				// removes all the columns from the grid, and adds them again,
				// it is used when the number of columns change.

				global.requestAnimationFrame(function render_after_css_media_query_change() {
					self.add_columns(grid, self.remove_columns(grid));
				});
			};


			self.media_query_change = function media_query_change(mql) {
				// recreates the columns when a media query matches the current state
				// of the browser.

				if (mql.matches) {
					Array.prototype.forEach.call(grids, self.recreate_columns);
				}
			};


			self.get_css_rules = function get_css_rules(stylesheet) {
				// returns a list of css rules from a stylesheet

				var cssRules;
				try {
					cssRules = stylesheet.sheet.cssRules || stylesheet.sheet.rules;
				} catch (e) {
					return [];
				}

				return cssRules || [];
			};


			self.get_stylesheets = function get_stylesheets() {
				// returns a list of all the styles in the document (that are accessible).

				return Array.prototype.concat.call(
					Array.prototype.slice.call(document.querySelectorAll("style[type='text/css']")),
					Array.prototype.slice.call(document.querySelectorAll("link[rel='stylesheet']"))
				);
			};


			self.media_rule_has_columns_selector = function media_rule_has_columns_selector(rules) {
				// checks if a media query css rule has in its contents a selector that
				// styles the grid.

				var i = rules.length
					, rule
					;

				while (i--) {
					rule = rules[i];
					if (rule.selectorText && rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
						return true;
					}
				}

				return false;
			};


			self.scan_media_queries = function scan_media_queries() {
				// scans all the stylesheets for selectors that style grids,
				// if the matchMedia API is supported.

				var mediaQueries = [];

				if (!global.matchMedia) {
					return;
				}

				self.get_stylesheets().forEach(function extract_rules(stylesheet) {
					Array.prototype.forEach.call(self.get_css_rules(stylesheet), function filter_by_column_selector(rule) {
						if (rule.media && self.media_rule_has_columns_selector(rule.cssRules)) {
							mediaQueries.push(global.matchMedia(rule.media.mediaText));
						}
					});
				});

				mediaQueries.forEach(function listen_to_changes(mql) {
					mql.addListener(self.media_query_change);
				});
			};


			self.next_element_column_index = function next_element_column_index(grid) {
				// returns the index of the column where the given element must be added.

				var children = grid.children
					, m = children.length
					, highestRowCount
					, child
					, currentRowCount
					, i = children.length - 1
					;

				for (i; i >= 0; i--) {
					child = children[i];
					currentRowCount = child.children.length;
					if (i !== 0 && highestRowCount > currentRowCount) {
						break;
					} else if (i + 1 === m) {
						i = 0;
						break;
					}

					highestRowCount = currentRowCount;
				}

				return i;
			};


			self.create_list_of_fragments = function create_list_of_fragments(quantity) {
				// returns a list of fragments

				var fragments = new Array(quantity)
					, i = 0
					;

				while (i !== quantity) {
					fragments[i] = document.createDocumentFragment();
					i++;
				}

				return fragments;
			};


			self.append_elements = function append_elements(grid, elements) {
				// adds a list of elements to the end of a grid

				var columns = grid.children
					, numberOfColumns = columns.length
					, fragments = self.create_list_of_fragments(numberOfColumns)
					, columnIndex = self.next_element_column_index(grid)
					;

				elements.forEach(function append_to_next_fragment(element) {
					fragments[columnIndex].appendChild(element);
					if (columnIndex === numberOfColumns - 1) {
						columnIndex = 0;
					} else {
						columnIndex++;
					}
				});

				Array.prototype.forEach.call(columns, function insert_column(column, index) {
					column.appendChild(fragments[index]);
				});
			};


			self.prepend_elements = function prepend_elements(grid, elements) {
				// adds a list of elements to the start of a grid

				var columns = grid.children
					, numberOfColumns = columns.length
					, fragments = self.create_list_of_fragments(numberOfColumns)
					, columnIndex = numberOfColumns - 1
					;

				elements.forEach(function append_to_next_fragment(element) {
					var fragment = fragments[columnIndex];
					fragment.insertBefore(element, fragment.firstChild);
					if (columnIndex === 0) {
						columnIndex = numberOfColumns - 1;
					} else {
						columnIndex--;
					}
				});

				Array.prototype.forEach.call(columns, function insert_column(column, index) {
					column.insertBefore(fragments[index], column.firstChild);
				});

				// populates a fragment with n columns till the right
				var fragment = document.createDocumentFragment()
					, numberOfColumnsToExtract = elements.length % numberOfColumns
					;

				while (numberOfColumnsToExtract-- !== 0) {
					fragment.appendChild(grid.lastChild);
				}

				// adds the fragment to the left
				grid.insertBefore(fragment, grid.firstChild);
			};


			self.register_grid = function register_grid (grid) {
				if (global.getComputedStyle(grid).display === "none") {
					return;
				}

				// retrieve the list of items from the grid itself
				var range = document.createRange();
				range.selectNodeContents(grid);

				var items = document.createElement("div");
				items.appendChild(range.extractContents());


				add_to_dataset(items, 'columns', 0);
				self.add_columns(grid, items);
				grids.push(grid);
			};


			self.init = function init() {
				// scans all the grids in the document and generates
				// columns from their configuration.

				var gridElements = document.querySelectorAll("[data-columns]");
				Array.prototype.forEach.call(gridElements, self.register_grid);
				self.scan_media_queries();
			};


			self.init();

			return {
				append_elements: self.append_elements,
				prepend_elements: self.prepend_elements,
				register_grid: self.register_grid
			};

		})(window, window.document);

		return salvattore;
	}));}


	/* --- $RESPOND JS --- */

	/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas. Dual MIT/BSD license */
	/*! NOTE: If you're already including a window.matchMedia polyfill via Modernizr or otherwise, you don't need this part */
	window.matchMedia=window.matchMedia||function(a){"use strict";var c,d=a.documentElement,e=d.firstElementChild||d.firstChild,f=a.createElement("body"),g=a.createElement("div");return g.id="mq-test-1",g.style.cssText="position:absolute;top:-100em",f.style.background="none",f.appendChild(g),function(a){return g.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',d.insertBefore(f,e),c=42===g.offsetWidth,d.removeChild(f),{matches:c,media:a}}}(document);

	/*! Respond.js v1.3.0: min/max-width media query polyfill. (c) Scott Jehl. MIT/GPLv2 Lic. j.mp/respondjs  */
	(function(a){"use strict";function x(){u(!0)}var b={};if(a.respond=b,b.update=function(){},b.mediaQueriesSupported=a.matchMedia&&a.matchMedia("only all").matches,!b.mediaQueriesSupported){var q,r,t,c=a.document,d=c.documentElement,e=[],f=[],g=[],h={},i=30,j=c.getElementsByTagName("head")[0]||d,k=c.getElementsByTagName("base")[0],l=j.getElementsByTagName("link"),m=[],n=function(){for(var b=0;l.length>b;b++){var c=l[b],d=c.href,e=c.media,f=c.rel&&"stylesheet"===c.rel.toLowerCase();d&&f&&!h[d]&&(c.styleSheet&&c.styleSheet.rawCssText?(p(c.styleSheet.rawCssText,d,e),h[d]=!0):(!/^([a-zA-Z:]*\/\/)/.test(d)&&!k||d.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&m.push({href:d,media:e}))}o()},o=function(){if(m.length){var b=m.shift();v(b.href,function(c){p(c,b.href,b.media),h[b.href]=!0,a.setTimeout(function(){o()},0)})}},p=function(a,b,c){var d=a.match(/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi),g=d&&d.length||0;b=b.substring(0,b.lastIndexOf("/"));var h=function(a){return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,"$1"+b+"$2$3")},i=!g&&c;b.length&&(b+="/"),i&&(g=1);for(var j=0;g>j;j++){var k,l,m,n;i?(k=c,f.push(h(a))):(k=d[j].match(/@media *([^\{]+)\{([\S\s]+?)$/)&&RegExp.$1,f.push(RegExp.$2&&h(RegExp.$2))),m=k.split(","),n=m.length;for(var o=0;n>o;o++)l=m[o],e.push({media:l.split("(")[0].match(/(only\s+)?([a-zA-Z]+)\s?/)&&RegExp.$2||"all",rules:f.length-1,hasquery:l.indexOf("(")>-1,minw:l.match(/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:l.match(/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}u()},s=function(){var a,b=c.createElement("div"),e=c.body,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",e||(e=f=c.createElement("body"),e.style.background="none"),e.appendChild(b),d.insertBefore(e,d.firstChild),a=b.offsetWidth,f?d.removeChild(e):e.removeChild(b),a=t=parseFloat(a)},u=function(b){var h="clientWidth",k=d[h],m="CSS1Compat"===c.compatMode&&k||c.body[h]||k,n={},o=l[l.length-1],p=(new Date).getTime();if(b&&q&&i>p-q)return a.clearTimeout(r),r=a.setTimeout(u,i),void 0;q=p;for(var v in e)if(e.hasOwnProperty(v)){var w=e[v],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?t||s():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?t||s():1)),w.hasquery&&(z&&A||!(z||m>=x)||!(A||y>=m))||(n[w.media]||(n[w.media]=[]),n[w.media].push(f[w.rules]))}for(var C in g)g.hasOwnProperty(C)&&g[C]&&g[C].parentNode===j&&j.removeChild(g[C]);for(var D in n)if(n.hasOwnProperty(D)){var E=c.createElement("style"),F=n[D].join("\n");E.type="text/css",E.media=D,j.insertBefore(E,o.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(c.createTextNode(F)),g.push(E)}},v=function(a,b){var c=w();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))},w=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}();n(),b.update=n,a.addEventListener?a.addEventListener("resize",x,!1):a.attachEvent&&a.attachEvent("onresize",x)}})(this);



	/* --- $EASING --- */

	/*
	 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
	*/
	// t: current time, b: begInnIng value, c: change In value, d: duration
	jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return -c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t+b;}return -c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t+b;}return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return -c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t*t+b;}return -c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t*t*t+b;}return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return -c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return -c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0){return b;}if(t==d){return b+c;}if((t/=d/2)<1){return c/2*Math.pow(2,10*(t-1))+b;}return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return -c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1){return -c/2*(Math.sqrt(1-t*t)-1)+b;}return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d)==1){return b+c;}if(!p){p=d*0.3;}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}return -(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d)==1){return b+c;}if(!p){p=d*0.3;}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0){return b;}if((t/=d/2)==2){return b+c;}if(!p){p=d*(0.3*1.5);}if(a<Math.abs(c)){a=c;var s=p/4;}else{var s=p/(2*Math.PI)*Math.asin(c/a);}if(t<1){return -0.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;}return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*0.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined){s=1.70158;}if((t/=d/2)<1){return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;}return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else{if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+0.75)+b;}else{if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+0.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+0.984375)+b;}}}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2){return jQuery.easing.easeInBounce(x,t*2,0,c,d)*0.5+b;}return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*0.5+c*0.5+b;}});


	/* --- $outerHTML Plugin --- */

	$.fn.outerHTML = function(){
	 
		// IE, Chrome & Safari will comply with the non-standard outerHTML, all others (FF) will have a fall-back for cloning
		return (!this.length) ? this : (this[0].outerHTML || (
		  function(el){
			  var div = document.createElement('div');
			  div.appendChild(el.cloneNode(true));
			  var contents = div.innerHTML;
			  div = null;
			  return contents;
		})(this[0]));
	};



	/* --- ORGANIC TABS --- */

	// --- MODIFIED
	// https://github.com/CSS-Tricks/jQuery-Organic-Tabs
	$.organicTabs = function (el, options) {
	var base = this;
	base.$el = $(el);
	base.$nav = base.$el.find(".tabs__nav");
	base.init = function () {
		base.options = $.extend({}, $.organicTabs.defaultOptions, options);
		var $allListWrap = base.$el.find(".tabs__content"),
			curList = base.$el.find("a.current").attr("href").substring(1);
		$allListWrap.height(base.$el.find("#" + curList).height());
		base.$nav.find("li > a").click(function(event) {
			
			var curList = base.$el.find("a.current").attr("href").substring(1),
				$newList = $(this),
				listID = $newList.attr("href").substring(1);
			if ((listID != curList) && (base.$el.find(":animated").length == 0)) {
				base.$el.find("#" + curList).css({
					opacity: 0,
					"z-index": 10
				});
				var newHeight = base.$el.find("#" + listID).height();
				$allListWrap.css({
					height: newHeight
				});
				setTimeout(function () {
					base.$el.find("#" + curList);
					base.$el.find("#" + listID).css({
						opacity: 1,
						"z-index": 20
					});
					base.$el.find(".tabs__nav li a").removeClass("current");
					$newList.addClass("current");
				}, 250);
			}
			event.preventDefault();
		});
	};
	base.init();
};
$.organicTabs.defaultOptions = {
	speed: 300
};
$.fn.organicTabs = function (options) {
	return this.each(function () {
		(new $.organicTabs(this, options));
	});
};
	
	/* --- FASTCLICK --- */

	/* Polyfill to remove click delays on browsers with touch UIs.
	 @version 0.6.7
	 @codingstandard ftlabs-jsv2
	 @copyright The Financial Times Limited [All Rights Reserved]
	 @license MIT License (see LICENSE.txt)
	*/
	function FastClick(a){var b,c=this;this.trackingClick=!1;this.trackingClickStart=0;this.targetElement=null;this.lastTouchIdentifier=this.touchStartY=this.touchStartX=0;this.layer=a;if(!a||!a.nodeType)throw new TypeError("Layer must be a document node");this.onClick=function(){return FastClick.prototype.onClick.apply(c,arguments)};this.onMouse=function(){return FastClick.prototype.onMouse.apply(c,arguments)};this.onTouchStart=function(){return FastClick.prototype.onTouchStart.apply(c,arguments)};this.onTouchEnd=
	function(){return FastClick.prototype.onTouchEnd.apply(c,arguments)};this.onTouchCancel=function(){return FastClick.prototype.onTouchCancel.apply(c,arguments)};FastClick.notNeeded(a)||(this.deviceIsAndroid&&(a.addEventListener("mouseover",this.onMouse,!0),a.addEventListener("mousedown",this.onMouse,!0),a.addEventListener("mouseup",this.onMouse,!0)),a.addEventListener("click",this.onClick,!0),a.addEventListener("touchstart",this.onTouchStart,!1),a.addEventListener("touchend",this.onTouchEnd,!1),a.addEventListener("touchcancel",
	this.onTouchCancel,!1),Event.prototype.stopImmediatePropagation||(a.removeEventListener=function(d,b,c){var e=Node.prototype.removeEventListener;"click"===d?e.call(a,d,b.hijacked||b,c):e.call(a,d,b,c)},a.addEventListener=function(b,c,f){var e=Node.prototype.addEventListener;"click"===b?e.call(a,b,c.hijacked||(c.hijacked=function(a){a.propagationStopped||c(a)}),f):e.call(a,b,c,f)}),"function"===typeof a.onclick&&(b=a.onclick,a.addEventListener("click",function(a){b(a)},!1),a.onclick=null))}
	FastClick.prototype.deviceIsAndroid=0<navigator.userAgent.indexOf("Android");FastClick.prototype.deviceIsIOS=/iP(ad|hone|od)/.test(navigator.userAgent);FastClick.prototype.deviceIsIOS4=FastClick.prototype.deviceIsIOS&&/OS 4_\d(_\d)?/.test(navigator.userAgent);FastClick.prototype.deviceIsIOSWithBadTarget=FastClick.prototype.deviceIsIOS&&/OS ([6-9]|\d{2})_\d/.test(navigator.userAgent);
	FastClick.prototype.needsClick=function(a){switch(a.nodeName.toLowerCase()){case "button":case "select":case "textarea":if(a.disabled)return!0;break;case "input":if(this.deviceIsIOS&&"file"===a.type||a.disabled)return!0;break;case "label":case "video":return!0}return/\bneedsclick\b/.test(a.className)};
	FastClick.prototype.needsFocus=function(a){switch(a.nodeName.toLowerCase()){case "textarea":case "select":return!0;case "input":switch(a.type){case "button":case "checkbox":case "file":case "image":case "radio":case "submit":return!1}return!a.disabled&&!a.readOnly;default:return/\bneedsfocus\b/.test(a.className)}};
	FastClick.prototype.sendClick=function(a,b){var c,d;document.activeElement&&document.activeElement!==a&&document.activeElement.blur();d=b.changedTouches[0];c=document.createEvent("MouseEvents");c.initMouseEvent("click",!0,!0,window,1,d.screenX,d.screenY,d.clientX,d.clientY,!1,!1,!1,!1,0,null);c.forwardedTouchEvent=!0;a.dispatchEvent(c)};FastClick.prototype.focus=function(a){var b;this.deviceIsIOS&&a.setSelectionRange?(b=a.value.length,a.setSelectionRange(b,b)):a.focus()};
	FastClick.prototype.updateScrollParent=function(a){var b,c;b=a.fastClickScrollParent;if(!b||!b.contains(a)){c=a;do{if(c.scrollHeight>c.offsetHeight){b=c;a.fastClickScrollParent=c;break}c=c.parentElement}while(c)}b&&(b.fastClickLastScrollTop=b.scrollTop)};FastClick.prototype.getTargetElementFromEventTarget=function(a){return a.nodeType===Node.TEXT_NODE?a.parentNode:a};
	FastClick.prototype.onTouchStart=function(a){var b,c,d;if(1<a.targetTouches.length)return!0;b=this.getTargetElementFromEventTarget(a.target);c=a.targetTouches[0];if(this.deviceIsIOS){d=window.getSelection();if(d.rangeCount&&!d.isCollapsed)return!0;if(!this.deviceIsIOS4){if(c.identifier===this.lastTouchIdentifier)return a.preventDefault(),!1;this.lastTouchIdentifier=c.identifier;this.updateScrollParent(b)}}this.trackingClick=!0;this.trackingClickStart=a.timeStamp;this.targetElement=b;this.touchStartX=
	c.pageX;this.touchStartY=c.pageY;200>a.timeStamp-this.lastClickTime&&a.preventDefault();return!0};FastClick.prototype.touchHasMoved=function(a){a=a.changedTouches[0];return 10<Math.abs(a.pageX-this.touchStartX)||10<Math.abs(a.pageY-this.touchStartY)?!0:!1};FastClick.prototype.findControl=function(a){return void 0!==a.control?a.control:a.htmlFor?document.getElementById(a.htmlFor):a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")};
	FastClick.prototype.onTouchEnd=function(a){var b,c,d;d=this.targetElement;this.touchHasMoved(a)&&(this.trackingClick=!1,this.targetElement=null);if(!this.trackingClick)return!0;if(200>a.timeStamp-this.lastClickTime)return this.cancelNextClick=!0;this.lastClickTime=a.timeStamp;b=this.trackingClickStart;this.trackingClick=!1;this.trackingClickStart=0;this.deviceIsIOSWithBadTarget&&(d=a.changedTouches[0],d=document.elementFromPoint(d.pageX-window.pageXOffset,d.pageY-window.pageYOffset));c=d.tagName.toLowerCase();
	if("label"===c){if(b=this.findControl(d)){this.focus(d);if(this.deviceIsAndroid)return!1;d=b}}else if(this.needsFocus(d)){if(100<a.timeStamp-b||this.deviceIsIOS&&window.top!==window&&"input"===c)return this.targetElement=null,!1;this.focus(d);if(!this.deviceIsIOS4||"select"!==c)this.targetElement=null,a.preventDefault();return!1}if(this.deviceIsIOS&&!this.deviceIsIOS4&&(b=d.fastClickScrollParent)&&b.fastClickLastScrollTop!==b.scrollTop)return!0;this.needsClick(d)||(a.preventDefault(),this.sendClick(d,
	a));return!1};FastClick.prototype.onTouchCancel=function(){this.trackingClick=!1;this.targetElement=null};FastClick.prototype.onMouse=function(a){return!this.targetElement||a.forwardedTouchEvent||!a.cancelable?!0:!this.needsClick(this.targetElement)||this.cancelNextClick?(a.stopImmediatePropagation?a.stopImmediatePropagation():a.propagationStopped=!0,a.stopPropagation(),a.preventDefault(),!1):!0};
	FastClick.prototype.onClick=function(a){if(this.trackingClick)return this.targetElement=null,this.trackingClick=!1,!0;if("submit"===a.target.type&&0===a.detail)return!0;a=this.onMouse(a);a||(this.targetElement=null);return a};
	FastClick.prototype.destroy=function(){var a=this.layer;this.deviceIsAndroid&&(a.removeEventListener("mouseover",this.onMouse,!0),a.removeEventListener("mousedown",this.onMouse,!0),a.removeEventListener("mouseup",this.onMouse,!0));a.removeEventListener("click",this.onClick,!0);a.removeEventListener("touchstart",this.onTouchStart,!1);a.removeEventListener("touchend",this.onTouchEnd,!1);a.removeEventListener("touchcancel",this.onTouchCancel,!1)};
	FastClick.notNeeded=function(a){var b;if("undefined"===typeof window.ontouchstart)return!0;if(/Chrome\/[0-9]+/.test(navigator.userAgent))if(FastClick.prototype.deviceIsAndroid){if((b=document.querySelector("meta[name=viewport]"))&&-1!==b.content.indexOf("user-scalable=no"))return!0}else return!0;return"none"===a.style.msTouchAction?!0:!1};FastClick.attach=function(a){return new FastClick(a)};
	"undefined"!==typeof define&&define.amd?define(function(){return FastClick}):"undefined"!==typeof module&&module.exports?(module.exports=FastClick.attach,module.exports.FastClick=FastClick):window.FastClick=FastClick;

	/* --- $MAGNIFIC POPUP --- */

	/*! Magnific Popup - v0.9.7 - 2013-10-10
	* http://dimsemenov.com/plugins/magnific-popup/
	* Copyright (c) 2013 Dmitry Semenov; */
	(function(e){var t,n,i,o,r,a,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",v="."+g,h="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,n){t.ev.on(g+e+v,n)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(n,i){t.ev.triggerHandler(g+n,i),t.st.callbacks&&(n=n.charAt(0).toLowerCase()+n.slice(1),t.st.callbacks[n]&&t.st.callbacks[n].apply(t,e.isArray(i)?i:[i]))},E=function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).focus()},S=function(n){return n===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=n),t.currTemplate.closeBtn},P=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},_=function(n){if(!e(n).hasClass(y)){var i=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(i&&o)return!0;if(!t.content||e(n).hasClass("mfp-close")||t.preloader&&n===t.preloader[0])return!0;if(n===t.content[0]||e.contains(t.content[0],n)){if(i)return!0}else if(o&&e.contains(document,n))return!0;return!1}},O=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var n=navigator.appVersion;t.isIE7=-1!==n.indexOf("MSIE 7."),t.isIE8=-1!==n.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(n),t.isIOS=/iphone|ipad|ipod/gi.test(n),t.supportsTransition=O(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),i=e(document.body),o=e(document),t.popupsCache={}},open:function(n){var i;if(n.isObj===!1){t.items=n.items.toArray(),t.index=0;var r,s=n.items;for(i=0;s.length>i;i++)if(r=s[i],r.parsed&&(r=r.el[0]),r===n.el[0]){t.index=i;break}}else t.items=e.isArray(n.items)?n.items:[n.items],t.index=n.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],a="",t.ev=n.mainEl&&n.mainEl.length?n.mainEl.eq(0):o,n.key?(t.popupsCache[n.key]||(t.popupsCache[n.key]={}),t.currTemplate=t.popupsCache[n.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,n),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+v,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+v,function(e){_(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var l=e.magnificPopup.modules;for(i=0;l.length>i;i++){var c=l[i];c=c.charAt(0).toUpperCase()+c.slice(1),t["init"+c].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,n,i){n.close_replaceWith=S(i.type)}),a+=" mfp-close-btn-in"):t.wrap.append(S())),t.st.alignTop&&(a+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+v,function(e){27===e.keyCode&&t.close()}),I.on("resize"+v,function(){t.updateSize()}),t.st.closeOnContentClick||(a+=" mfp-auto-cursor"),a&&t.wrap.addClass(a);var d=t.wH=I.height(),u={};if(t.fixedContentPos&&t._hasScrollBar(d)){var m=t._getScrollbarSize();m&&(u.paddingRight=m)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):u.overflow="hidden");var g=t.st.mainClass;return t.isIE7&&(g+=" mfp-ie7"),g&&t._addClassToMFP(g),t.updateItemHTML(),T("BuildControls"),e("html").css(u),t.bgOverlay.add(t.wrap).prependTo(document.body),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(h),E()):t.bgOverlay.addClass(h),o.on("focusin"+v,function(n){return n.target===t.wrap[0]||e.contains(t.wrap[0],n.target)?void 0:(E(),!1)})},16),t.isOpen=!0,t.updateSize(d),T(f),n},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var n=C+" "+h+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(n+=t.st.mainClass+" "),t._removeClassFromMFP(n),t.fixedContentPos){var i={paddingRight:""};t.isIE7?e("body, html").css("overflow",""):i.overflow="",e("html").css(i)}o.off("keyup"+v+" focusin"+v),t.ev.off(v),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).focus(),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var n=document.documentElement.clientWidth/window.innerWidth,i=window.innerHeight*n;t.wrap.css("height",i),t.wH=i}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var n=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),n.parsed||(n=t.parseEl(t.index));var i=n.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",i]),t.currItem=n,!t.currTemplate[i]){var o=t.st[i]?t.st[i].markup:!1;T("FirstMarkupParse",o),t.currTemplate[i]=o?e(o):!0}r&&r!==n.type&&t.container.removeClass("mfp-"+r+"-holder");var a=t["get"+i.charAt(0).toUpperCase()+i.slice(1)](n,t.currTemplate[i]);t.appendContent(a,i),n.preloaded=!0,T(m,n),r=n.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,n){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[n]===!0?t.content.find(".mfp-close").length||t.content.append(S()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+n+"-holder"),t.contentContainer.append(t.content)},parseEl:function(n){var i=t.items[n],o=i.type;if(i=i.tagName?{el:e(i)}:{data:i,src:i.src},i.el){for(var r=t.types,a=0;r.length>a;a++)if(i.el.hasClass("mfp-"+r[a])){o=r[a];break}i.src=i.el.attr("data-mfp-src"),i.src||(i.src=i.el.attr("href"))}return i.type=o||t.st.type||"inline",i.index=n,i.parsed=!0,t.items[n]=i,T("ElementParse",i),t.items[n]},addGroup:function(e,n){var i=function(i){i.mfpEl=this,t._openClick(i,e,n)};n||(n={});var o="click.magnificPopup";n.mainEl=e,n.items?(n.isObj=!0,e.off(o).on(o,i)):(n.isObj=!1,n.delegate?e.off(o).on(o,n.delegate,i):(n.items=e,e.off(o).on(o,i)))},_openClick:function(n,i,o){var r=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(r||2!==n.which&&!n.ctrlKey&&!n.metaKey){var a=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(a)if(e.isFunction(a)){if(!a.call(t))return!0}else if(a>I.width())return!0;n.type&&(n.preventDefault(),t.isOpen&&n.stopPropagation()),o.el=e(n.mfpEl),o.delegate&&(o.items=i.find(o.delegate)),t.open(o)}},updateStatus:function(e,i){if(t.preloader){n!==e&&t.container.removeClass("mfp-s-"+n),i||"loading"!==e||(i=t.st.tLoading);var o={status:e,text:i};T("UpdateStatus",o),e=o.status,i=o.text,t.preloader.html(i),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),n=e}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(p,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(v+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(v+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.id="mfp-sbm",e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(t,n){return P(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(n){P();var i=e(this);if("string"==typeof n)if("open"===n){var o,r=b?i.data("magnificPopup"):i[0].magnificPopup,a=parseInt(arguments[1],10)||0;r.items?o=r.items[a]:(o=i,r.delegate&&(o=o.find(r.delegate)),o=o.eq(a)),t._openClick({mfpEl:o},i,r)}else t.isOpen&&t[n].apply(t,Array.prototype.slice.call(arguments,1));else n=e.extend(!0,{},n),b?i.data("magnificPopup",n):i[0].magnificPopup=n,t.addGroup(i,n);return i};var z,M,B,H="inline",L=function(){B&&(M.after(B.addClass(z)).detach(),B=null)};e.magnificPopup.registerModule(H,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(H),x(l+"."+H,function(){L()})},getInline:function(n,i){if(L(),n.src){var o=t.st.inline,r=e(n.src);if(r.length){var a=r[0].parentNode;a&&a.tagName&&(M||(z=o.hiddenClass,M=k(z),z="mfp-"+z),B=r.after(M).detach().removeClass(z)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),r=e("<div>");return n.inlineElement=r,r}return t.updateStatus("ready"),t._parseMarkup(i,{},n),i}}});var A,F="ajax",j=function(){A&&i.removeClass(A)},N=function(){j(),t.req&&t.req.abort()};e.magnificPopup.registerModule(F,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(F),A=t.st.ajax.cursor,x(l+"."+F,N),x("BeforeChange."+F,N)},getAjax:function(n){A&&i.addClass(A),t.updateStatus("loading");var o=e.extend({url:n.src,success:function(i,o,r){var a={data:i,xhr:r};T("ParseAjax",a),t.appendContent(e(a.data),F),n.finished=!0,j(),E(),setTimeout(function(){t.wrap.addClass(h)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){j(),n.finished=n.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",n.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var W,R=function(n){if(n.data&&void 0!==n.data.title)return n.data.title;var i=t.st.image.titleSrc;if(i){if(e.isFunction(i))return i.call(t,n);if(n.el)return n.el.attr(i)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,n=".image";t.types.push("image"),x(f+n,function(){"image"===t.currItem.type&&e.cursor&&i.addClass(e.cursor)}),x(l+n,function(){e.cursor&&i.removeClass(e.cursor),I.off("resize"+v)}),x("Resize"+n,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e&&e.img&&t.st.image.verticalFit){var n=0;t.isLowIE&&(n=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-n)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,W&&clearInterval(W),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var n=0,i=e.img[0],o=function(r){W&&clearInterval(W),W=setInterval(function(){return i.naturalWidth>0?(t._onImageHasSize(e),void 0):(n>200&&clearInterval(W),n++,3===n?o(10):40===n?o(50):100===n&&o(500),void 0)},r)};o(1)},getImage:function(n,i){var o=0,r=function(){n&&(n.img[0].complete?(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("ready")),n.hasSize=!0,n.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(r,100):a()))},a=function(){n&&(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("error",s.tError.replace("%url%",n.src))),n.hasSize=!0,n.loaded=!0,n.loadError=!0)},s=t.st.image,l=i.find(".mfp-img");if(l.length){var c=document.createElement("img");c.className="mfp-img",n.img=e(c).on("load.mfploader",r).on("error.mfploader",a),c.src=n.src,l.is("img")&&(n.img=n.img.clone()),n.img[0].naturalWidth>0&&(n.hasSize=!0)}return t._parseMarkup(i,{title:R(n),img_replaceWith:n.img},n),t.resizeImage(),n.hasSize?(W&&clearInterval(W),n.loadError?(i.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",n.src))):(i.removeClass("mfp-loading"),t.updateStatus("ready")),i):(t.updateStatus("loading"),n.loading=!0,n.hasSize||(n.imgHidden=!0,i.addClass("mfp-loading"),t.findImageSize(n)),i)}}});var Z,q=function(){return void 0===Z&&(Z=void 0!==document.createElement("p").style.MozTransform),Z};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,n=t.st.zoom,i=".zoom";if(n.enabled&&t.supportsTransition){var o,r,a=n.duration,s=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+n.duration/1e3+"s "+n.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,t.css(o),t},d=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.content.css("visibility","hidden"),e=t._getItemToZoom(),!e)return d(),void 0;r=s(e),r.css(t._getOffset()),t.wrap.append(r),o=setTimeout(function(){r.css(t._getOffset(!0)),o=setTimeout(function(){d(),setTimeout(function(){r.remove(),e=r=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.st.removalDelay=a,!e){if(e=t._getItemToZoom(),!e)return;r=s(e)}r.css(t._getOffset(!0)),t.wrap.append(r),t.content.css("visibility","hidden"),setTimeout(function(){r.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(d(),r&&r.remove(),e=null)})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(n){var i;i=n?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=i.offset(),r=parseInt(i.css("padding-top"),10),a=parseInt(i.css("padding-bottom"),10);o.top-=e(window).scrollTop()-r;var s={width:i.width(),height:(b?i.innerHeight():i[0].offsetHeight)-a-r};return q()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var D="iframe",K="//about:blank",Y=function(e){if(t.currTemplate[D]){var n=t.currTemplate[D].find("iframe");n.length&&(e||(n[0].src=K),t.isIE8&&n.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(D,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(D),x("BeforeChange",function(e,t,n){t!==n&&(t===D?Y():n===D&&Y(!0))}),x(l+"."+D,function(){Y()})},getIframe:function(n,i){var o=n.src,r=t.st.iframe;e.each(r.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var a={};return r.srcAction&&(a[r.srcAction]=o),t._parseMarkup(i,a,n),t.updateStatus("ready"),i}}});var U=function(e){var n=t.items.length;return e>n-1?e-n:0>e?n+e:e},G=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=t.st.gallery,i=".mfp-gallery",r=Boolean(e.fn.mfpFastClick);return t.direction=!0,n&&n.enabled?(a+=" mfp-gallery",x(f+i,function(){n.navigateByImgClick&&t.wrap.on("click"+i,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+i,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+i,function(e,n){n.text&&(n.text=G(n.text,t.currItem.index,t.items.length))}),x(p+i,function(e,i,o,r){var a=t.items.length;o.counter=a>1?G(n.tCounter,r.index,a):""}),x("BuildControls"+i,function(){if(t.items.length>1&&n.arrows&&!t.arrowLeft){var i=n.arrowMarkup,o=t.arrowLeft=e(i.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(y),a=t.arrowRight=e(i.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(y),s=r?"mfpFastClick":"click";o[s](function(){t.prev()}),a[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",a[0],!1,!0),k("a",a[0],!1,!0)),t.container.append(o.add(a))}}),x(m+i,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+i,function(){o.off(i),t.wrap.off("click"+i),t.arrowLeft&&r&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=U(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=U(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,n=t.st.gallery.preload,i=Math.min(n[0],t.items.length),o=Math.min(n[1],t.items.length);for(e=1;(t.direction?o:i)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?i:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(n){if(n=U(n),!t.items[n].preloaded){var i=t.items[n];i.parsed||(i=t.parseEl(n)),T("LazyLoad",i),"image"===i.type&&(i.img=e('<img class="mfp-img" />').on("load.mfploader",function(){i.hasSize=!0}).on("error.mfploader",function(){i.hasSize=!0,i.loadError=!0,T("LazyLoadError",i)}).attr("src",i.src)),i.preloaded=!0}}}});var X="retina";e.magnificPopup.registerModule(X,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,n=e.ratio;n=isNaN(n)?n():n,n>1&&(x("ImageHasSize."+X,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/n,width:"100%"})}),x("ElementParse."+X,function(t,i){i.src=e.replaceSrc(i,n)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){I.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a,s=e(this);if(n){var l,c,d,u,p,f;s.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(a=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){a=!1},t),o())})})}s.on("click"+r,function(){a||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&I.off("touchmove"+r+" touchend"+r)}}()})(window.jQuery||window.Zepto);



	/* --- ROYALSLIDER --- */

	// jQuery RoyalSlider plugin. Custom build. Copyright 2011-2013 Dmitry Semenov http://dimsemenov.com 
// http://dimsemenov.com/private/home.php?build=bullets_thumbnails_tabs_fullscreen_autoplay_video_animated-blocks_auto-height_global-caption_active-class_deeplinking_visible-nearby 
// jquery.royalslider v9.5.1
(function(n){function u(b,f){var c,a=this,e=window.navigator,g=e.userAgent.toLowerCase();a.uid=n.rsModules.uid++;a.ns=".rs"+a.uid;var d=document.createElement("div").style,h=["webkit","Moz","ms","O"],k="",l=0,r;for(c=0;c<h.length;c++)r=h[c],!k&&r+"Transform"in d&&(k=r),r=r.toLowerCase(),window.requestAnimationFrame||(window.requestAnimationFrame=window[r+"RequestAnimationFrame"],window.cancelAnimationFrame=window[r+"CancelAnimationFrame"]||window[r+"CancelRequestAnimationFrame"]);window.requestAnimationFrame||
(window.requestAnimationFrame=function(a,b){var c=(new Date).getTime(),d=Math.max(0,16-(c-l)),e=window.setTimeout(function(){a(c+d)},d);l=c+d;return e});window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)});a.isIPAD=g.match(/(ipad)/);a.isIOS=a.isIPAD||g.match(/(iphone|ipod)/);c=function(a){a=/(chrome)[ \/]([\w.]+)/.exec(a)||/(webkit)[ \/]([\w.]+)/.exec(a)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(a)||/(msie) ([\w.]+)/.exec(a)||0>a.indexOf("compatible")&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(a)||
[];return{browser:a[1]||"",version:a[2]||"0"}}(g);h={};c.browser&&(h[c.browser]=!0,h.version=c.version);h.chrome&&(h.webkit=!0);a._a=h;a.isAndroid=-1<g.indexOf("android");a.slider=n(b);a.ev=n(a);a._b=n(document);a.st=n.extend({},n.fn.royalSlider.defaults,f);a._c=a.st.transitionSpeed;a._d=0;!a.st.allowCSS3||h.webkit&&!a.st.allowCSS3OnWebkit||(c=k+(k?"T":"t"),a._e=c+"ransform"in d&&c+"ransition"in d,a._e&&(a._f=k+(k?"P":"p")+"erspective"in d));k=k.toLowerCase();a._g="-"+k+"-";a._h="vertical"===a.st.slidesOrientation?
!1:!0;a._i=a._h?"left":"top";a._j=a._h?"width":"height";a._k=-1;a._l="fade"===a.st.transitionType?!1:!0;a._l||(a.st.sliderDrag=!1,a._m=10);a._n="z-index:0; display:none; opacity:0;";a._o=0;a._p=0;a._q=0;n.each(n.rsModules,function(b,c){"uid"!==b&&c.call(a)});a.slides=[];a._r=0;(a.st.slides?n(a.st.slides):a.slider.children().detach()).each(function(){a._s(this,!0)});a.st.randomizeSlides&&a.slides.sort(function(){return 0.5-Math.random()});a.numSlides=a.slides.length;a._t();a.st.startSlideId?a.st.startSlideId>
a.numSlides-1&&(a.st.startSlideId=a.numSlides-1):a.st.startSlideId=0;a._o=a.staticSlideId=a.currSlideId=a._u=a.st.startSlideId;a.currSlide=a.slides[a.currSlideId];a._v=0;a.pointerMultitouch=!1;a.slider.addClass((a._h?"rsHor":"rsVer")+(a._l?"":" rsFade"));d='<div class="rsOverflow"><div class="rsContainer">';a.slidesSpacing=a.st.slidesSpacing;a._w=(a._h?a.slider.width():a.slider.height())+a.st.slidesSpacing;a._x=Boolean(0<a._y);1>=a.numSlides&&(a._z=!1);a._a1=a._z&&a._l?2===a.numSlides?1:2:0;a._b1=
6>a.numSlides?a.numSlides:6;a._c1=0;a._d1=0;a.slidesJQ=[];for(c=0;c<a.numSlides;c++)a.slidesJQ.push(n('<div style="'+(a._l?"":c!==a.currSlideId?a._n:"z-index:0;")+'" class="rsSlide "></div>'));a._e1=d=n(d+"</div></div>");var m=a.ns,k=function(b,c,d,e,f){a._j1=b+c+m;a._k1=b+d+m;a._l1=b+e+m;f&&(a._m1=b+f+m)};c=e.pointerEnabled;a.pointerEnabled=c||e.msPointerEnabled;a.pointerEnabled?(a.hasTouch=!1,a._n1=0.2,a.pointerMultitouch=Boolean(1<e[(c?"m":"msM")+"axTouchPoints"]),c?k("pointer","down","move","up",
"cancel"):k("MSPointer","Down","Move","Up","Cancel")):(a.isIOS?a._j1=a._k1=a._l1=a._m1="":k("mouse","down","move","up"),"ontouchstart"in window||"createTouch"in document?(a.hasTouch=!0,a._j1+=" touchstart"+m,a._k1+=" touchmove"+m,a._l1+=" touchend"+m,a._m1+=" touchcancel"+m,a._n1=0.5,a.st.sliderTouch&&(a._f1=!0)):(a.hasTouch=!1,a._n1=0.2));a.st.sliderDrag&&(a._f1=!0,h.msie||h.opera?a._g1=a._h1="move":h.mozilla?(a._g1="-moz-grab",a._h1="-moz-grabbing"):h.webkit&&-1!=e.platform.indexOf("Mac")&&(a._g1=
"-webkit-grab",a._h1="-webkit-grabbing"),a._i1());a.slider.html(d);a._o1=a.st.controlsInside?a._e1:a.slider;a._p1=a._e1.children(".rsContainer");a.pointerEnabled&&a._p1.css((c?"":"-ms-")+"touch-action",a._h?"pan-y":"pan-x");a._q1=n('<div class="rsPreloader"></div>');e=a._p1.children(".rsSlide");a._r1=a.slidesJQ[a.currSlideId];a._s1=0;a._e?(a._t1="transition-property",a._u1="transition-duration",a._v1="transition-timing-function",a._w1=a._x1=a._g+"transform",a._f?(h.webkit&&!h.chrome&&a.slider.addClass("rsWebkit3d"),
a._y1="translate3d(",a._z1="px, ",a._a2="px, 0px)"):(a._y1="translate(",a._z1="px, ",a._a2="px)"),a._l?a._p1[a._g+a._t1]=a._g+"transform":(h={},h[a._g+a._t1]="opacity",h[a._g+a._u1]=a.st.transitionSpeed+"ms",h[a._g+a._v1]=a.st.css3easeInOut,e.css(h))):(a._x1="left",a._w1="top");var p;n(window).on("resize"+a.ns,function(){p&&clearTimeout(p);p=setTimeout(function(){a.updateSliderSize()},50)});a.ev.trigger("rsAfterPropsSetup");a.updateSliderSize();a.st.keyboardNavEnabled&&a._b2();a.st.arrowsNavHideOnTouch&&
(a.hasTouch||a.pointerMultitouch)&&(a.st.arrowsNav=!1);a.st.arrowsNav&&(e=a._o1,n('<div class="rsArrow rsArrowLeft"><div class="rsArrowIcn"></div></div><div class="rsArrow rsArrowRight"><div class="rsArrowIcn"></div></div>').appendTo(e),a._c2=e.children(".rsArrowLeft").click(function(b){b.preventDefault();a.prev()}),a._d2=e.children(".rsArrowRight").click(function(b){b.preventDefault();a.next()}),a.st.arrowsNavAutoHide&&!a.hasTouch&&(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"),e.one("mousemove.arrowshover",
function(){a._c2.removeClass("rsHidden");a._d2.removeClass("rsHidden")}),e.hover(function(){a._e2||(a._c2.removeClass("rsHidden"),a._d2.removeClass("rsHidden"))},function(){a._e2||(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"))})),a.ev.on("rsOnUpdateNav",function(){a._f2()}),a._f2());if(a._f1)a._p1.on(a._j1,function(b){a._g2(b)});else a.dragSuccess=!1;var q=["rsPlayBtnIcon","rsPlayBtn","rsCloseVideoBtn","rsCloseVideoIcn"];a._p1.click(function(b){if(!a.dragSuccess){var c=n(b.target).attr("class");
if(-1!==n.inArray(c,q)&&a.toggleVideo())return!1;if(a.st.navigateByClick&&!a._h2){if(n(b.target).closest(".rsNoDrag",a._r1).length)return!0;a._i2(b)}a.ev.trigger("rsSlideClick",b)}}).on("click.rs","a",function(b){if(a.dragSuccess)return!1;a._h2=!0;setTimeout(function(){a._h2=!1},3)});a.ev.trigger("rsAfterInit")}n.rsModules||(n.rsModules={uid:0});u.prototype={constructor:u,_i2:function(b){b=b[this._h?"pageX":"pageY"]-this._j2;b>=this._q?this.next():0>b&&this.prev()},_t:function(){var b;b=this.st.numImagesToPreload;
if(this._z=this.st.loop)2===this.numSlides?(this._z=!1,this.st.loopRewind=!0):2>this.numSlides&&(this.st.loopRewind=this._z=!1);this._z&&0<b&&(4>=this.numSlides?b=1:this.st.numImagesToPreload>(this.numSlides-1)/2&&(b=Math.floor((this.numSlides-1)/2)));this._y=b},_s:function(b,f){function c(b,c){c?g.images.push(b.attr(c)):g.images.push(b.text());if(h){h=!1;g.caption="src"===c?b.attr("alt"):b.contents();g.image=g.images[0];g.videoURL=b.attr("data-rsVideo");var d=b.attr("data-rsw"),e=b.attr("data-rsh");
"undefined"!==typeof d&&!1!==d&&"undefined"!==typeof e&&!1!==e?(g.iW=parseInt(d,10),g.iH=parseInt(e,10)):a.st.imgWidth&&a.st.imgHeight&&(g.iW=a.st.imgWidth,g.iH=a.st.imgHeight)}}var a=this,e,g={},d,h=!0;b=n(b);a._k2=b;a.ev.trigger("rsBeforeParseNode",[b,g]);if(!g.stopParsing)return b=a._k2,g.id=a._r,g.contentAdded=!1,a._r++,g.images=[],g.isBig=!1,g.hasCover||(b.hasClass("rsImg")?(d=b,e=!0):(d=b.find(".rsImg"),d.length&&(e=!0)),e?(g.bigImage=d.eq(0).attr("data-rsBigImg"),d.each(function(){var a=n(this);
a.is("a")?c(a,"href"):a.is("img")?c(a,"src"):c(a)})):b.is("img")&&(b.addClass("rsImg rsMainSlideImage"),c(b,"src"))),d=b.find(".rsCaption"),d.length&&(g.caption=d.remove()),g.content=b,a.ev.trigger("rsAfterParseNode",[b,g]),f&&a.slides.push(g),0===g.images.length&&(g.isLoaded=!0,g.isRendered=!1,g.isLoading=!1,g.images=null),g},_b2:function(){var b=this,f,c,a=function(a){37===a?b.prev():39===a&&b.next()};b._b.on("keydown"+b.ns,function(e){b._l2||(c=e.keyCode,37!==c&&39!==c||f||(a(c),f=setInterval(function(){a(c)},
700)))}).on("keyup"+b.ns,function(a){f&&(clearInterval(f),f=null)})},goTo:function(b,f){b!==this.currSlideId&&this._m2(b,this.st.transitionSpeed,!0,!f)},destroy:function(b){this.ev.trigger("rsBeforeDestroy");this._b.off("keydown"+this.ns+" keyup"+this.ns+" "+this._k1+" "+this._l1);this._p1.off(this._j1+" click");this.slider.data("royalSlider",null);n.removeData(this.slider,"royalSlider");n(window).off("resize"+this.ns);this.loadingTimeout&&clearTimeout(this.loadingTimeout);b&&this.slider.remove();
this.ev=this.slider=this.slides=null},_n2:function(b,f){function c(c,f,g){c.isAdded?(a(f,c),e(f,c)):(g||(g=d.slidesJQ[f]),c.holder?g=c.holder:(g=d.slidesJQ[f]=n(g),c.holder=g),c.appendOnLoaded=!1,e(f,c,g),a(f,c),d._p2(c,g,b),c.isAdded=!0)}function a(a,c){c.contentAdded||(d.setItemHtml(c,b),b||(c.contentAdded=!0))}function e(a,b,c){d._l&&(c||(c=d.slidesJQ[a]),c.css(d._i,(a+d._d1+p)*d._w))}function g(a){if(l){if(a>r-1)return g(a-r);if(0>a)return g(r+a)}return a}var d=this,h,k,l=d._z,r=d.numSlides;if(!isNaN(f))return g(f);
var m=d.currSlideId,p,q=b?Math.abs(d._o2-d.currSlideId)>=d.numSlides-1?0:1:d._y,s=Math.min(2,q),v=!1,u=!1,t;for(k=m;k<m+1+s;k++)if(t=g(k),(h=d.slides[t])&&(!h.isAdded||!h.positionSet)){v=!0;break}for(k=m-1;k>m-1-s;k--)if(t=g(k),(h=d.slides[t])&&(!h.isAdded||!h.positionSet)){u=!0;break}if(v)for(k=m;k<m+q+1;k++)t=g(k),p=Math.floor((d._u-(m-k))/d.numSlides)*d.numSlides,(h=d.slides[t])&&c(h,t);if(u)for(k=m-1;k>m-1-q;k--)t=g(k),p=Math.floor((d._u-(m-k))/r)*r,(h=d.slides[t])&&c(h,t);if(!b)for(s=g(m-q),
m=g(m+q),q=s>m?0:s,k=0;k<r;k++)s>m&&k>s-1||!(k<q||k>m)||(h=d.slides[k])&&h.holder&&(h.holder.detach(),h.isAdded=!1)},setItemHtml:function(b,f){var c=this,a=function(){if(!b.images)b.isRendered=!0,b.isLoaded=!0,b.isLoading=!1,d(!0);else if(!b.isLoading){var a,f;b.content.hasClass("rsImg")?(a=b.content,f=!0):a=b.content.find(".rsImg:not(img)");a&&!a.is("img")&&a.each(function(){var a=n(this),c='<img class="rsImg" src="'+(a.is("a")?a.attr("href"):a.text())+'" />';f?b.content=n(c):a.replaceWith(c)});
a=f?b.content:b.content.find("img.rsImg");k();a.eq(0).addClass("rsMainSlideImage");b.iW&&b.iH&&(b.isLoaded||c._q2(b),d());b.isLoading=!0;if(b.isBig)n("<img />").on("load.rs error.rs",function(a){n(this).off("load.rs error.rs");e([this],!0)}).attr("src",b.image);else{b.loaded=[];b.numStartedLoad=0;a=function(a){n(this).off("load.rs error.rs");b.loaded.push(this);b.loaded.length===b.numStartedLoad&&e(b.loaded,!1)};for(var g=0;g<b.images.length;g++){var h=n("<img />");b.numStartedLoad++;h.on("load.rs error.rs",
a).attr("src",b.images[g])}}}},e=function(a,c){if(a.length){var d=a[0];if(c!==b.isBig)(d=b.holder.children())&&1<d.length&&l();else if(b.iW&&b.iH)g();else if(b.iW=d.width,b.iH=d.height,b.iW&&b.iH)g();else{var e=new Image;e.onload=function(){e.width?(b.iW=e.width,b.iH=e.height,g()):setTimeout(function(){e.width&&(b.iW=e.width,b.iH=e.height);g()},1E3)};e.src=d.src}}else g()},g=function(){b.isLoaded=!0;b.isLoading=!1;d();l();h()},d=function(){if(!b.isAppended&&c.ev){var a=c.st.visibleNearby,d=b.id-c._o;
f||b.appendOnLoaded||!c.st.fadeinLoadedSlide||0!==d&&(!(a||c._r2||c._l2)||-1!==d&&1!==d)||(a={visibility:"visible",opacity:0},a[c._g+"transition"]="opacity 400ms ease-in-out",b.content.css(a),setTimeout(function(){b.content.css("opacity",1)},16));b.holder.find(".rsPreloader").length?b.holder.append(b.content):b.holder.html(b.content);b.isAppended=!0;b.isLoaded&&(c._q2(b),h());b.sizeReady||(b.sizeReady=!0,setTimeout(function(){c.ev.trigger("rsMaybeSizeReady",b)},100))}},h=function(){!b.loadedTriggered&&
c.ev&&(b.isLoaded=b.loadedTriggered=!0,b.holder.trigger("rsAfterContentSet"),c.ev.trigger("rsAfterContentSet",b))},k=function(){c.st.usePreloader&&b.holder.html(c._q1.clone())},l=function(a){c.st.usePreloader&&(a=b.holder.find(".rsPreloader"),a.length&&a.remove())};b.isLoaded?d():f?!c._l&&b.images&&b.iW&&b.iH?a():(b.holder.isWaiting=!0,k(),b.holder.slideId=-99):a()},_p2:function(b,f,c){this._p1.append(b.holder);b.appendOnLoaded=!1},_g2:function(b,f){var c=this,a,e="touchstart"===b.type;c._s2=e;c.ev.trigger("rsDragStart");
if(n(b.target).closest(".rsNoDrag",c._r1).length)return c.dragSuccess=!1,!0;!f&&c._r2&&(c._t2=!0,c._u2());c.dragSuccess=!1;if(c._l2)e&&(c._v2=!0);else{e&&(c._v2=!1);c._w2();if(e){var g=b.originalEvent.touches;if(g&&0<g.length)a=g[0],1<g.length&&(c._v2=!0);else return}else b.preventDefault(),a=b,c.pointerEnabled&&(a=a.originalEvent);c._l2=!0;c._b.on(c._k1,function(a){c._x2(a,f)}).on(c._l1,function(a){c._y2(a,f)});c._z2="";c._a3=!1;c._b3=a.pageX;c._c3=a.pageY;c._d3=c._v=(f?c._e3:c._h)?a.pageX:a.pageY;
c._f3=0;c._g3=0;c._h3=f?c._i3:c._p;c._j3=(new Date).getTime();if(e)c._e1.on(c._m1,function(a){c._y2(a,f)})}},_k3:function(b,f){if(this._l3){var c=this._m3,a=b.pageX-this._b3,e=b.pageY-this._c3,g=this._h3+a,d=this._h3+e,h=f?this._e3:this._h,g=h?g:d,d=this._z2;this._a3=!0;this._b3=b.pageX;this._c3=b.pageY;"x"===d&&0!==a?this._f3=0<a?1:-1:"y"===d&&0!==e&&(this._g3=0<e?1:-1);d=h?this._b3:this._c3;a=h?a:e;f?g>this._n3?g=this._h3+a*this._n1:g<this._o3&&(g=this._h3+a*this._n1):this._z||(0>=this.currSlideId&&
0<d-this._d3&&(g=this._h3+a*this._n1),this.currSlideId>=this.numSlides-1&&0>d-this._d3&&(g=this._h3+a*this._n1));this._h3=g;200<c-this._j3&&(this._j3=c,this._v=d);f?this._q3(this._h3):this._l&&this._p3(this._h3)}},_x2:function(b,f){var c=this,a,e="touchmove"===b.type;if(!c._s2||e){if(e){if(c._r3)return;var g=b.originalEvent.touches;if(g){if(1<g.length)return;a=g[0]}else return}else a=b,c.pointerEnabled&&(a=a.originalEvent);c._a3||(c._e&&(f?c._s3:c._p1).css(c._g+c._u1,"0s"),function h(){c._l2&&(c._t3=
requestAnimationFrame(h),c._u3&&c._k3(c._u3,f))}());if(c._l3)b.preventDefault(),c._m3=(new Date).getTime(),c._u3=a;else if(g=f?c._e3:c._h,a=Math.abs(a.pageX-c._b3)-Math.abs(a.pageY-c._c3)-(g?-7:7),7<a){if(g)b.preventDefault(),c._z2="x";else if(e){c._v3(b);return}c._l3=!0}else if(-7>a){if(!g)b.preventDefault(),c._z2="y";else if(e){c._v3(b);return}c._l3=!0}}},_v3:function(b,f){this._r3=!0;this._a3=this._l2=!1;this._y2(b)},_y2:function(b,f){function c(a){return 100>a?100:500<a?500:a}function a(a,b){if(e._l||
f)h=(-e._u-e._d1)*e._w,k=Math.abs(e._p-h),e._c=k/b,a&&(e._c+=250),e._c=c(e._c),e._x3(h,!1)}var e=this,g,d,h,k;g=-1<b.type.indexOf("touch");if(!e._s2||g)if(e._s2=!1,e.ev.trigger("rsDragRelease"),e._u3=null,e._l2=!1,e._r3=!1,e._l3=!1,e._m3=0,cancelAnimationFrame(e._t3),e._a3&&(f?e._q3(e._h3):e._l&&e._p3(e._h3)),e._b.off(e._k1).off(e._l1),g&&e._e1.off(e._m1),e._i1(),!e._a3&&!e._v2&&f&&e._w3){var l=n(b.target).closest(".rsNavItem");l.length&&e.goTo(l.index())}else{d=f?e._e3:e._h;if(!e._a3||"y"===e._z2&&
d||"x"===e._z2&&!d)if(!f&&e._t2){e._t2=!1;if(e.st.navigateByClick){e._i2(e.pointerEnabled?b.originalEvent:b);e.dragSuccess=!0;return}e.dragSuccess=!0}else{e._t2=!1;e.dragSuccess=!1;return}else e.dragSuccess=!0;e._t2=!1;e._z2="";var r=e.st.minSlideOffset;g=g?b.originalEvent.changedTouches[0]:e.pointerEnabled?b.originalEvent:b;var m=d?g.pageX:g.pageY,p=e._d3;g=e._v;var q=e.currSlideId,s=e.numSlides,v=d?e._f3:e._g3,u=e._z;Math.abs(m-p);g=m-g;d=(new Date).getTime()-e._j3;d=Math.abs(g)/d;if(0===v||1>=
s)a(!0,d);else{if(!u&&!f)if(0>=q){if(0<v){a(!0,d);return}}else if(q>=s-1&&0>v){a(!0,d);return}if(f){h=e._i3;if(h>e._n3)h=e._n3;else if(h<e._o3)h=e._o3;else{m=d*d/0.006;l=-e._i3;p=e._y3-e._z3+e._i3;0<g&&m>l?(l+=e._z3/(15/(m/d*0.003)),d=d*l/m,m=l):0>g&&m>p&&(p+=e._z3/(15/(m/d*0.003)),d=d*p/m,m=p);l=Math.max(Math.round(d/0.003),50);h+=m*(0>g?-1:1);if(h>e._n3){e._a4(h,l,!0,e._n3,200);return}if(h<e._o3){e._a4(h,l,!0,e._o3,200);return}}e._a4(h,l,!0)}else l=function(a){var b=Math.floor(a/e._w);a-b*e._w>
r&&b++;return b},p+r<m?0>v?a(!1,d):(l=l(m-p),e._m2(e.currSlideId-l,c(Math.abs(e._p-(-e._u-e._d1+l)*e._w)/d),!1,!0,!0)):p-r>m?0<v?a(!1,d):(l=l(p-m),e._m2(e.currSlideId+l,c(Math.abs(e._p-(-e._u-e._d1-l)*e._w)/d),!1,!0,!0)):a(!1,d)}}},_p3:function(b){b=this._p=b;this._e?this._p1.css(this._x1,this._y1+(this._h?b+this._z1+0:0+this._z1+b)+this._a2):this._p1.css(this._h?this._x1:this._w1,b)},updateSliderSize:function(b){var f,c;if(this.st.autoScaleSlider){var a=this.st.autoScaleSliderWidth,e=this.st.autoScaleSliderHeight;
this.st.autoScaleHeight?(f=this.slider.width(),f!=this.width&&(this.slider.css("height",e/a*f),f=this.slider.width()),c=this.slider.height()):(c=this.slider.height(),c!=this.height&&(this.slider.css("width",a/e*c),c=this.slider.height()),f=this.slider.width())}else f=this.slider.width(),c=this.slider.height();if(b||f!=this.width||c!=this.height){this.width=f;this.height=c;this._b4=f;this._c4=c;this.ev.trigger("rsBeforeSizeSet");this.ev.trigger("rsAfterSizePropSet");this._e1.css({width:this._b4,height:this._c4});
this._w=(this._h?this._b4:this._c4)+this.st.slidesSpacing;this._d4=this.st.imageScalePadding;for(f=0;f<this.slides.length;f++)b=this.slides[f],b.positionSet=!1,b&&b.images&&b.isLoaded&&(b.isRendered=!1,this._q2(b));if(this._e4)for(f=0;f<this._e4.length;f++)b=this._e4[f],b.holder.css(this._i,(b.id+this._d1)*this._w);this._n2();this._l&&(this._e&&this._p1.css(this._g+"transition-duration","0s"),this._p3((-this._u-this._d1)*this._w));this.ev.trigger("rsOnUpdateNav")}this._j2=this._e1.offset();this._j2=
this._j2[this._i]},appendSlide:function(b,f){var c=this._s(b);if(isNaN(f)||f>this.numSlides)f=this.numSlides;this.slides.splice(f,0,c);this.slidesJQ.splice(f,0,n('<div style="'+(this._l?"position:absolute;":this._n)+'" class="rsSlide"></div>'));f<this.currSlideId&&this.currSlideId++;this.ev.trigger("rsOnAppendSlide",[c,f]);this._f4(f);f===this.currSlideId&&this.ev.trigger("rsAfterSlideChange")},removeSlide:function(b){var f=this.slides[b];f&&(f.holder&&f.holder.remove(),b<this.currSlideId&&this.currSlideId--,
this.slides.splice(b,1),this.slidesJQ.splice(b,1),this.ev.trigger("rsOnRemoveSlide",[b]),this._f4(b),b===this.currSlideId&&this.ev.trigger("rsAfterSlideChange"))},_f4:function(b){var f=this;b=f.numSlides;b=0>=f._u?0:Math.floor(f._u/b);f.numSlides=f.slides.length;0===f.numSlides?(f.currSlideId=f._d1=f._u=0,f.currSlide=f._g4=null):f._u=b*f.numSlides+f.currSlideId;for(b=0;b<f.numSlides;b++)f.slides[b].id=b;f.currSlide=f.slides[f.currSlideId];f._r1=f.slidesJQ[f.currSlideId];f.currSlideId>=f.numSlides?
f.goTo(f.numSlides-1):0>f.currSlideId&&f.goTo(0);f._t();f._l&&f._z&&f._p1.css(f._g+f._u1,"0ms");f._h4&&clearTimeout(f._h4);f._h4=setTimeout(function(){f._l&&f._p3((-f._u-f._d1)*f._w);f._n2();f._l||f._r1.css({display:"block",opacity:1})},14);f.ev.trigger("rsOnUpdateNav")},_i1:function(){this._f1&&this._l&&(this._g1?this._e1.css("cursor",this._g1):(this._e1.removeClass("grabbing-cursor"),this._e1.addClass("grab-cursor")))},_w2:function(){this._f1&&this._l&&(this._h1?this._e1.css("cursor",this._h1):
(this._e1.removeClass("grab-cursor"),this._e1.addClass("grabbing-cursor")))},next:function(b){this._m2("next",this.st.transitionSpeed,!0,!b)},prev:function(b){this._m2("prev",this.st.transitionSpeed,!0,!b)},_m2:function(b,f,c,a,e){var g=this,d,h,k;g.ev.trigger("rsBeforeMove",[b,a]);k="next"===b?g.currSlideId+1:"prev"===b?g.currSlideId-1:b=parseInt(b,10);if(!g._z){if(0>k){g._i4("left",!a);return}if(k>=g.numSlides){g._i4("right",!a);return}}g._r2&&(g._u2(!0),c=!1);h=k-g.currSlideId;k=g._o2=g.currSlideId;
var l=g.currSlideId+h;a=g._u;var n;g._z?(l=g._n2(!1,l),a+=h):a=l;g._o=l;g._g4=g.slidesJQ[g.currSlideId];g._u=a;g.currSlideId=g._o;g.currSlide=g.slides[g.currSlideId];g._r1=g.slidesJQ[g.currSlideId];var l=g.st.slidesDiff,m=Boolean(0<h);h=Math.abs(h);var p=Math.floor(k/g._y),q=Math.floor((k+(m?l:-l))/g._y),p=(m?Math.max(p,q):Math.min(p,q))*g._y+(m?g._y-1:0);p>g.numSlides-1?p=g.numSlides-1:0>p&&(p=0);k=m?p-k:k-p;k>g._y&&(k=g._y);if(h>k+l)for(g._d1+=(h-(k+l))*(m?-1:1),f*=1.4,k=0;k<g.numSlides;k++)g.slides[k].positionSet=
!1;g._c=f;g._n2(!0);e||(n=!0);d=(-a-g._d1)*g._w;n?setTimeout(function(){g._j4=!1;g._x3(d,b,!1,c);g.ev.trigger("rsOnUpdateNav")},0):(g._x3(d,b,!1,c),g.ev.trigger("rsOnUpdateNav"))},_f2:function(){this.st.arrowsNav&&(1>=this.numSlides?(this._c2.css("display","none"),this._d2.css("display","none")):(this._c2.css("display","block"),this._d2.css("display","block"),this._z||this.st.loopRewind||(0===this.currSlideId?this._c2.addClass("rsArrowDisabled"):this._c2.removeClass("rsArrowDisabled"),this.currSlideId===
this.numSlides-1?this._d2.addClass("rsArrowDisabled"):this._d2.removeClass("rsArrowDisabled"))))},_x3:function(b,f,c,a,e){function g(){var a;h&&(a=h.data("rsTimeout"))&&(h!==k&&h.css({opacity:0,display:"none",zIndex:0}),clearTimeout(a),h.data("rsTimeout",""));if(a=k.data("rsTimeout"))clearTimeout(a),k.data("rsTimeout","")}var d=this,h,k,l={};isNaN(d._c)&&(d._c=400);d._p=d._h3=b;d.ev.trigger("rsBeforeAnimStart");d._e?d._l?(d._c=parseInt(d._c,10),c=d._g+d._v1,l[d._g+d._u1]=d._c+"ms",l[c]=a?n.rsCSS3Easing[d.st.easeInOut]:
n.rsCSS3Easing[d.st.easeOut],d._p1.css(l),a||!d.hasTouch?setTimeout(function(){d._p3(b)},5):d._p3(b)):(d._c=d.st.transitionSpeed,h=d._g4,k=d._r1,k.data("rsTimeout")&&k.css("opacity",0),g(),h&&h.data("rsTimeout",setTimeout(function(){l[d._g+d._u1]="0ms";l.zIndex=0;l.display="none";h.data("rsTimeout","");h.css(l);setTimeout(function(){h.css("opacity",0)},16)},d._c+60)),l.display="block",l.zIndex=d._m,l.opacity=0,l[d._g+d._u1]="0ms",l[d._g+d._v1]=n.rsCSS3Easing[d.st.easeInOut],k.css(l),k.data("rsTimeout",
setTimeout(function(){k.css(d._g+d._u1,d._c+"ms");k.data("rsTimeout",setTimeout(function(){k.css("opacity",1);k.data("rsTimeout","")},20))},20))):d._l?(l[d._h?d._x1:d._w1]=b+"px",d._p1.animate(l,d._c,a?d.st.easeInOut:d.st.easeOut)):(h=d._g4,k=d._r1,k.stop(!0,!0).css({opacity:0,display:"block",zIndex:d._m}),d._c=d.st.transitionSpeed,k.animate({opacity:1},d._c,d.st.easeInOut),g(),h&&h.data("rsTimeout",setTimeout(function(){h.stop(!0,!0).css({opacity:0,display:"none",zIndex:0})},d._c+60)));d._r2=!0;
d.loadingTimeout&&clearTimeout(d.loadingTimeout);d.loadingTimeout=e?setTimeout(function(){d.loadingTimeout=null;e.call()},d._c+60):setTimeout(function(){d.loadingTimeout=null;d._k4(f)},d._c+60)},_u2:function(b){this._r2=!1;clearTimeout(this.loadingTimeout);if(this._l)if(!this._e)this._p1.stop(!0),this._p=parseInt(this._p1.css(this._x1),10);else{if(!b){b=this._p;var f=this._h3=this._l4();this._p1.css(this._g+this._u1,"0ms");b!==f&&this._p3(f)}}else 20<this._m?this._m=10:this._m++},_l4:function(){var b=
window.getComputedStyle(this._p1.get(0),null).getPropertyValue(this._g+"transform").replace(/^matrix\(/i,"").split(/, |\)$/g),f=0===b[0].indexOf("matrix3d");return parseInt(b[this._h?f?12:4:f?13:5],10)},_m4:function(b,f){return this._e?this._y1+(f?b+this._z1+0:0+this._z1+b)+this._a2:b},_k4:function(b){this._l||(this._r1.css("z-index",0),this._m=10);this._r2=!1;this.staticSlideId=this.currSlideId;this._n2();this._n4=!1;this.ev.trigger("rsAfterSlideChange")},_i4:function(b,f){var c=this,a=(-c._u-c._d1)*
c._w;if(0!==c.numSlides&&!c._r2)if(c.st.loopRewind)c.goTo("left"===b?c.numSlides-1:0,f);else if(c._l){c._c=200;var e=function(){c._r2=!1};c._x3(a+("left"===b?30:-30),"",!1,!0,function(){c._r2=!1;c._x3(a,"",!1,!0,e)})}},_q2:function(b,f){if(!b.isRendered){var c=b.content,a="rsMainSlideImage",e,g=this.st.imageAlignCenter,d=this.st.imageScaleMode,h;b.videoURL&&(a="rsVideoContainer","fill"!==d?e=!0:(h=c,h.hasClass(a)||(h=h.find("."+a)),h.css({width:"100%",height:"100%"}),a="rsMainSlideImage"));c.hasClass(a)||
(c=c.find("."+a));if(c){var k=b.iW,l=b.iH;b.isRendered=!0;if("none"!==d||g){a="fill"!==d?this._d4:0;h=this._b4-2*a;var n=this._c4-2*a,m,p,q={};"fit-if-smaller"===d&&(k>h||l>n)&&(d="fit");if("fill"===d||"fit"===d)m=h/k,p=n/l,m="fill"==d?m>p?m:p:"fit"==d?m<p?m:p:1,k=Math.ceil(k*m,10),l=Math.ceil(l*m,10);"none"!==d&&(q.width=k,q.height=l,e&&c.find(".rsImg").css({width:"100%",height:"100%"}));g&&(q.marginLeft=Math.floor((h-k)/2)+a,q.marginTop=Math.floor((n-l)/2)+a);c.css(q)}}}}};n.rsProto=u.prototype;
n.fn.royalSlider=function(b){var f=arguments;return this.each(function(){var c=n(this);if("object"!==typeof b&&b){if((c=c.data("royalSlider"))&&c[b])return c[b].apply(c,Array.prototype.slice.call(f,1))}else c.data("royalSlider")||c.data("royalSlider",new u(c,b))})};n.fn.royalSlider.defaults={slidesSpacing:8,startSlideId:0,loop:!1,loopRewind:!1,numImagesToPreload:4,fadeinLoadedSlide:!0,slidesOrientation:"horizontal",transitionType:"move",transitionSpeed:600,controlNavigation:"bullets",controlsInside:!0,
arrowsNav:!0,arrowsNavAutoHide:!0,navigateByClick:!0,randomizeSlides:!1,sliderDrag:!0,sliderTouch:!0,keyboardNavEnabled:!1,fadeInAfterLoaded:!0,allowCSS3:!0,allowCSS3OnWebkit:!0,addActiveClass:!1,autoHeight:!1,easeOut:"easeOutSine",easeInOut:"easeInOutSine",minSlideOffset:10,imageScaleMode:"fit-if-smaller",imageAlignCenter:!0,imageScalePadding:4,usePreloader:!0,autoScaleSlider:!1,autoScaleSliderWidth:800,autoScaleSliderHeight:400,autoScaleHeight:!0,arrowsNavHideOnTouch:!1,globalCaption:!1,slidesDiff:2};
n.rsCSS3Easing={easeOutSine:"cubic-bezier(0.390, 0.575, 0.565, 1.000)",easeInOutSine:"cubic-bezier(0.445, 0.050, 0.550, 0.950)"};n.extend(jQuery.easing,{easeInOutSine:function(b,f,c,a,e){return-a/2*(Math.cos(Math.PI*f/e)-1)+c},easeOutSine:function(b,f,c,a,e){return a*Math.sin(f/e*(Math.PI/2))+c},easeOutCubic:function(b,f,c,a,e){return a*((f=f/e-1)*f*f+1)+c}})})(jQuery,window);
// jquery.rs.bullets v1.0.1
(function(c){c.extend(c.rsProto,{_i5:function(){var a=this;"bullets"===a.st.controlNavigation&&(a.ev.one("rsAfterPropsSetup",function(){a._j5=!0;a.slider.addClass("rsWithBullets");for(var b='<div class="rsNav rsBullets">',e=0;e<a.numSlides;e++)b+='<div class="rsNavItem rsBullet"><span></span></div>';a._k5=b=c(b+"</div>");a._l5=b.appendTo(a.slider).children();a._k5.on("click.rs",".rsNavItem",function(b){a._m5||a.goTo(c(this).index())})}),a.ev.on("rsOnAppendSlide",function(b,c,d){d>=a.numSlides?a._k5.append('<div class="rsNavItem rsBullet"><span></span></div>'):
a._l5.eq(d).before('<div class="rsNavItem rsBullet"><span></span></div>');a._l5=a._k5.children()}),a.ev.on("rsOnRemoveSlide",function(b,c){var d=a._l5.eq(c);d&&d.length&&(d.remove(),a._l5=a._k5.children())}),a.ev.on("rsOnUpdateNav",function(){var b=a.currSlideId;a._n5&&a._n5.removeClass("rsNavSelected");b=a._l5.eq(b);b.addClass("rsNavSelected");a._n5=b}))}});c.rsModules.bullets=c.rsProto._i5})(jQuery);
// jquery.rs.thumbnails v1.0.6
(function(g){g.extend(g.rsProto,{_h6:function(){var a=this;"thumbnails"===a.st.controlNavigation&&(a._i6={drag:!0,touch:!0,orientation:"horizontal",navigation:!0,arrows:!0,arrowLeft:null,arrowRight:null,spacing:4,arrowsAutoHide:!1,appendSpan:!1,transitionSpeed:600,autoCenter:!0,fitInViewport:!0,firstMargin:!0,paddingTop:0,paddingBottom:0},a.st.thumbs=g.extend({},a._i6,a.st.thumbs),a._j6=!0,!1===a.st.thumbs.firstMargin?a.st.thumbs.firstMargin=0:!0===a.st.thumbs.firstMargin&&(a.st.thumbs.firstMargin=
a.st.thumbs.spacing),a.ev.on("rsBeforeParseNode",function(a,b,c){b=g(b);c.thumbnail=b.find(".rsTmb").remove();c.thumbnail.length?c.thumbnail=g(document.createElement("div")).append(c.thumbnail).html():(c.thumbnail=b.attr("data-rsTmb"),c.thumbnail||(c.thumbnail=b.find(".rsImg").attr("data-rsTmb")),c.thumbnail=c.thumbnail?'<img src="'+c.thumbnail+'"/>':"")}),a.ev.one("rsAfterPropsSetup",function(){a._k6()}),a._n5=null,a.ev.on("rsOnUpdateNav",function(){var e=g(a._l5[a.currSlideId]);e!==a._n5&&(a._n5&&
(a._n5.removeClass("rsNavSelected"),a._n5=null),a._l6&&a._m6(a.currSlideId),a._n5=e.addClass("rsNavSelected"))}),a.ev.on("rsOnAppendSlide",function(e,b,c){e="<div"+a._n6+' class="rsNavItem rsThumb">'+a._o6+b.thumbnail+"</div>";c>=a.numSlides?a._s3.append(e):a._l5.eq(c).before(e);a._l5=a._s3.children();a.updateThumbsSize()}),a.ev.on("rsOnRemoveSlide",function(e,b){var c=a._l5.eq(b);c&&(c.remove(),a._l5=a._s3.children(),a.updateThumbsSize())}))},_k6:function(){var a=this,e="rsThumbs",b=a.st.thumbs,
c="",f,d,h=b.spacing;a._j5=!0;a._e3="vertical"===b.orientation?!1:!0;a._n6=f=h?' style="margin-'+(a._e3?"right":"bottom")+":"+h+'px;"':"";a._i3=0;a._p6=!1;a._m5=!1;a._l6=!1;a._q6=b.arrows&&b.navigation;d=a._e3?"Hor":"Ver";a.slider.addClass("rsWithThumbs rsWithThumbs"+d);c+='<div class="rsNav rsThumbs rsThumbs'+d+'"><div class="'+e+'Container">';a._o6=b.appendSpan?'<span class="thumbIco"></span>':"";for(var k=0;k<a.numSlides;k++)d=a.slides[k],c+="<div"+f+' class="rsNavItem rsThumb">'+d.thumbnail+a._o6+
"</div>";c=g(c+"</div></div>");f={};b.paddingTop&&(f[a._e3?"paddingTop":"paddingLeft"]=b.paddingTop);b.paddingBottom&&(f[a._e3?"paddingBottom":"paddingRight"]=b.paddingBottom);c.css(f);a._s3=g(c).find("."+e+"Container");a._q6&&(e+="Arrow",b.arrowLeft?a._r6=b.arrowLeft:(a._r6=g('<div class="'+e+" "+e+'Left"><div class="'+e+'Icn"></div></div>'),c.append(a._r6)),b.arrowRight?a._s6=b.arrowRight:(a._s6=g('<div class="'+e+" "+e+'Right"><div class="'+e+'Icn"></div></div>'),c.append(a._s6)),a._r6.click(function(){var b=
(Math.floor(a._i3/a._t6)+a._u6)*a._t6+a._v6;a._a4(b>a._n3?a._n3:b)}),a._s6.click(function(){var b=(Math.floor(a._i3/a._t6)-a._u6)*a._t6+a._v6;a._a4(b<a._o3?a._o3:b)}),b.arrowsAutoHide&&!a.hasTouch&&(a._r6.css("opacity",0),a._s6.css("opacity",0),c.one("mousemove.rsarrowshover",function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))}),c.hover(function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))},function(){a._l6&&(a._r6.css("opacity",0),a._s6.css("opacity",0))})));a._k5=c;a._l5=
a._s3.children();a.msEnabled&&a.st.thumbs.navigation&&a._s3.css("-ms-touch-action",a._e3?"pan-y":"pan-x");a.slider.append(c);a._w3=!0;a._v6=h;b.navigation&&a._e&&a._s3.css(a._g+"transition-property",a._g+"transform");a._k5.on("click.rs",".rsNavItem",function(b){a._m5||a.goTo(g(this).index())});a.ev.off("rsBeforeSizeSet.thumbs").on("rsBeforeSizeSet.thumbs",function(){a._w6=a._e3?a._c4:a._b4;a.updateThumbsSize(!0)});a.ev.off("rsAutoHeightChange.thumbs").on("rsAutoHeightChange.thumbs",function(b,c){a.updateThumbsSize(!0,
c)})},updateThumbsSize:function(a,e){var b=this,c=b._l5.first(),f={},d=b._l5.length;b._t6=(b._e3?c.outerWidth():c.outerHeight())+b._v6;b._y3=d*b._t6-b._v6;f[b._e3?"width":"height"]=b._y3+b._v6;b._z3=b._e3?b._k5.width():void 0!==e?e:b._k5.height();b._w3&&(b.isFullscreen||b.st.thumbs.fitInViewport)&&(b._e3?b._c4=b._w6-b._k5.outerHeight():b._b4=b._w6-b._k5.outerWidth());b._z3&&(b._o3=-(b._y3-b._z3)-b.st.thumbs.firstMargin,b._n3=b.st.thumbs.firstMargin,b._u6=Math.floor(b._z3/b._t6),b._y3<b._z3?(b.st.thumbs.autoCenter&&
b._q3((b._z3-b._y3)/2),b.st.thumbs.arrows&&b._r6&&(b._r6.addClass("rsThumbsArrowDisabled"),b._s6.addClass("rsThumbsArrowDisabled")),b._l6=!1,b._m5=!1,b._k5.off(b._j1)):b.st.thumbs.navigation&&!b._l6&&(b._l6=!0,!b.hasTouch&&b.st.thumbs.drag||b.hasTouch&&b.st.thumbs.touch)&&(b._m5=!0,b._k5.on(b._j1,function(a){b._g2(a,!0)})),b._s3.css(f),a&&e&&b._m6(b.currSlideId),b._e&&(f[b._g+"transition-duration"]="0ms"))},setThumbsOrientation:function(a,e){this._w3&&(this.st.thumbs.orientation=a,this._k5.remove(),
this.slider.removeClass("rsWithThumbsHor rsWithThumbsVer"),this._k6(),this._k5.off(this._j1),e||this.updateSliderSize(!0))},_q3:function(a){this._i3=a;this._e?this._s3.css(this._x1,this._y1+(this._e3?a+this._z1+0:0+this._z1+a)+this._a2):this._s3.css(this._e3?this._x1:this._w1,a)},_a4:function(a,e,b,c,f){var d=this;if(d._l6){e||(e=d.st.thumbs.transitionSpeed);d._i3=a;d._x6&&clearTimeout(d._x6);d._p6&&(d._e||d._s3.stop(),b=!0);var h={};d._p6=!0;d._e?(h[d._g+"transition-duration"]=e+"ms",h[d._g+"transition-timing-function"]=
b?g.rsCSS3Easing[d.st.easeOut]:g.rsCSS3Easing[d.st.easeInOut],d._s3.css(h),d._q3(a)):(h[d._e3?d._x1:d._w1]=a+"px",d._s3.animate(h,e,b?"easeOutCubic":d.st.easeInOut));c&&(d._i3=c);d._y6();d._x6=setTimeout(function(){d._p6=!1;f&&(d._a4(c,f,!0),f=null)},e)}},_y6:function(){this._q6&&(this._i3===this._n3?this._r6.addClass("rsThumbsArrowDisabled"):this._r6.removeClass("rsThumbsArrowDisabled"),this._i3===this._o3?this._s6.addClass("rsThumbsArrowDisabled"):this._s6.removeClass("rsThumbsArrowDisabled"))},
_m6:function(a,e){var b=0,c,f=a*this._t6+2*this._t6-this._v6+this._n3,d=Math.floor(this._i3/this._t6);this._l6&&(this._j6&&(e=!0,this._j6=!1),f+this._i3>this._z3?(a===this.numSlides-1&&(b=1),d=-a+this._u6-2+b,c=d*this._t6+this._z3%this._t6+this._v6-this._n3):0!==a?(a-1)*this._t6<=-this._i3+this._n3&&a-1<=this.numSlides-this._u6&&(c=(-a+1)*this._t6+this._n3):c=this._n3,c!==this._i3&&(b=void 0===c?this._i3:c,b>this._n3?this._q3(this._n3):b<this._o3?this._q3(this._o3):void 0!==c&&(e?this._q3(c):this._a4(c))),
this._y6())}});g.rsModules.thumbnails=g.rsProto._h6})(jQuery);
// jquery.rs.tabs v1.0.2
(function(e){e.extend(e.rsProto,{_f6:function(){var a=this;"tabs"===a.st.controlNavigation&&(a.ev.on("rsBeforeParseNode",function(a,d,b){d=e(d);b.thumbnail=d.find(".rsTmb").remove();b.thumbnail.length?b.thumbnail=e(document.createElement("div")).append(b.thumbnail).html():(b.thumbnail=d.attr("data-rsTmb"),b.thumbnail||(b.thumbnail=d.find(".rsImg").attr("data-rsTmb")),b.thumbnail=b.thumbnail?'<img src="'+b.thumbnail+'"/>':"")}),a.ev.one("rsAfterPropsSetup",function(){a._g6()}),a.ev.on("rsOnAppendSlide",
function(c,d,b){b>=a.numSlides?a._k5.append('<div class="rsNavItem rsTab">'+d.thumbnail+"</div>"):a._l5.eq(b).before('<div class="rsNavItem rsTab">'+item.thumbnail+"</div>");a._l5=a._k5.children()}),a.ev.on("rsOnRemoveSlide",function(c,d){var b=a._l5.eq(d);b&&(b.remove(),a._l5=a._k5.children())}),a.ev.on("rsOnUpdateNav",function(){var c=a.currSlideId;a._n5&&a._n5.removeClass("rsNavSelected");c=a._l5.eq(c);c.addClass("rsNavSelected");a._n5=c}))},_g6:function(){var a=this,c;a._j5=!0;c='<div class="rsNav rsTabs">';
for(var d=0;d<a.numSlides;d++)c+='<div class="rsNavItem rsTab">'+a.slides[d].thumbnail+"</div>";c=e(c+"</div>");a._k5=c;a._l5=c.children(".rsNavItem");a.slider.append(c);a._k5.click(function(b){b=e(b.target).closest(".rsNavItem");b.length&&a.goTo(b.index())})}});e.rsModules.tabs=e.rsProto._f6})(jQuery);
// jquery.rs.fullscreen v1.0.5
(function(c){c.extend(c.rsProto,{_q5:function(){var a=this;a._r5={enabled:!1,keyboardNav:!0,buttonFS:!0,nativeFS:!1,doubleTap:!0};a.st.fullscreen=c.extend({},a._r5,a.st.fullscreen);if(a.st.fullscreen.enabled)a.ev.one("rsBeforeSizeSet",function(){a._s5()})},_s5:function(){var a=this;a._t5=!a.st.keyboardNavEnabled&&a.st.fullscreen.keyboardNav;if(a.st.fullscreen.nativeFS){a._u5={supportsFullScreen:!1,isFullScreen:function(){return!1},requestFullScreen:function(){},cancelFullScreen:function(){},fullScreenEventName:"",
prefix:""};var b=["webkit","moz","o","ms","khtml"];if(!a.isAndroid)if("undefined"!=typeof document.cancelFullScreen)a._u5.supportsFullScreen=!0;else for(var d=0;d<b.length;d++)if(a._u5.prefix=b[d],"undefined"!=typeof document[a._u5.prefix+"CancelFullScreen"]){a._u5.supportsFullScreen=!0;break}a._u5.supportsFullScreen?(a.nativeFS=!0,a._u5.fullScreenEventName=a._u5.prefix+"fullscreenchange"+a.ns,a._u5.isFullScreen=function(){switch(this.prefix){case "":return document.fullScreen;case "webkit":return document.webkitIsFullScreen;
default:return document[this.prefix+"FullScreen"]}},a._u5.requestFullScreen=function(a){return""===this.prefix?a.requestFullScreen():a[this.prefix+"RequestFullScreen"]()},a._u5.cancelFullScreen=function(a){return""===this.prefix?document.cancelFullScreen():document[this.prefix+"CancelFullScreen"]()}):a._u5=!1}a.st.fullscreen.buttonFS&&(a._v5=c('<div class="rsFullscreenBtn"><div class="rsFullscreenIcn"></div></div>').appendTo(a._o1).on("click.rs",function(){a.isFullscreen?a.exitFullscreen():a.enterFullscreen()}))},
enterFullscreen:function(a){var b=this;if(b._u5)if(a)b._u5.requestFullScreen(c("html")[0]);else{b._b.on(b._u5.fullScreenEventName,function(a){b._u5.isFullScreen()?b.enterFullscreen(!0):b.exitFullscreen(!0)});b._u5.requestFullScreen(c("html")[0]);return}if(!b._w5){b._w5=!0;b._b.on("keyup"+b.ns+"fullscreen",function(a){27===a.keyCode&&b.exitFullscreen()});b._t5&&b._b2();a=c(window);b._x5=a.scrollTop();b._y5=a.scrollLeft();b._z5=c("html").attr("style");b._a6=c("body").attr("style");b._b6=b.slider.attr("style");
c("body, html").css({overflow:"hidden",height:"100%",width:"100%",margin:"0",padding:"0"});b.slider.addClass("rsFullscreen");var d;for(d=0;d<b.numSlides;d++)a=b.slides[d],a.isRendered=!1,a.bigImage&&(a.isBig=!0,a.isMedLoaded=a.isLoaded,a.isMedLoading=a.isLoading,a.medImage=a.image,a.medIW=a.iW,a.medIH=a.iH,a.slideId=-99,a.bigImage!==a.medImage&&(a.sizeType="big"),a.isLoaded=a.isBigLoaded,a.isLoading=!1,a.image=a.bigImage,a.images[0]=a.bigImage,a.iW=a.bigIW,a.iH=a.bigIH,a.isAppended=a.contentAdded=
!1,b._c6(a));b.isFullscreen=!0;b._w5=!1;b.updateSliderSize();b.ev.trigger("rsEnterFullscreen")}},exitFullscreen:function(a){var b=this;if(b._u5){if(!a){b._u5.cancelFullScreen(c("html")[0]);return}b._b.off(b._u5.fullScreenEventName)}if(!b._w5){b._w5=!0;b._b.off("keyup"+b.ns+"fullscreen");b._t5&&b._b.off("keydown"+b.ns);c("html").attr("style",b._z5||"");c("body").attr("style",b._a6||"");var d;for(d=0;d<b.numSlides;d++)a=b.slides[d],a.isRendered=!1,a.bigImage&&(a.isBig=!1,a.slideId=-99,a.isBigLoaded=
a.isLoaded,a.isBigLoading=a.isLoading,a.bigImage=a.image,a.bigIW=a.iW,a.bigIH=a.iH,a.isLoaded=a.isMedLoaded,a.isLoading=!1,a.image=a.medImage,a.images[0]=a.medImage,a.iW=a.medIW,a.iH=a.medIH,a.isAppended=a.contentAdded=!1,b._c6(a,!0),a.bigImage!==a.medImage&&(a.sizeType="med"));b.isFullscreen=!1;a=c(window);a.scrollTop(b._x5);a.scrollLeft(b._y5);b._w5=!1;b.slider.removeClass("rsFullscreen");b.updateSliderSize();setTimeout(function(){b.updateSliderSize()},1);b.ev.trigger("rsExitFullscreen")}},_c6:function(a,
b){var d=a.isLoaded||a.isLoading?'<img class="rsImg rsMainSlideImage" src="'+a.image+'"/>':'<a class="rsImg rsMainSlideImage" href="'+a.image+'"></a>';a.content.hasClass("rsImg")?a.content=c(d):a.content.find(".rsImg").eq(0).replaceWith(d);a.isLoaded||a.isLoading||!a.holder||a.holder.html(a.content)}});c.rsModules.fullscreen=c.rsProto._q5})(jQuery);
// jquery.rs.autoplay v1.0.5
(function(b){b.extend(b.rsProto,{_x4:function(){var a=this,d;a._y4={enabled:!1,stopAtAction:!0,pauseOnHover:!0,delay:2E3};!a.st.autoPlay&&a.st.autoplay&&(a.st.autoPlay=a.st.autoplay);a.st.autoPlay=b.extend({},a._y4,a.st.autoPlay);a.st.autoPlay.enabled&&(a.ev.on("rsBeforeParseNode",function(a,c,f){c=b(c);if(d=c.attr("data-rsDelay"))f.customDelay=parseInt(d,10)}),a.ev.one("rsAfterInit",function(){a._z4()}),a.ev.on("rsBeforeDestroy",function(){a.stopAutoPlay();a.slider.off("mouseenter mouseleave");b(window).off("blur"+
a.ns+" focus"+a.ns)}))},_z4:function(){var a=this;a.startAutoPlay();a.ev.on("rsAfterContentSet",function(b,e){a._l2||a._r2||!a._a5||e!==a.currSlide||a._b5()});a.ev.on("rsDragRelease",function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.ev.on("rsAfterSlideChange",function(){a._a5&&a._c5&&(a._c5=!1,a.currSlide.isLoaded&&a._b5())});a.ev.on("rsDragStart",function(){a._a5&&(a.st.autoPlay.stopAtAction?a.stopAutoPlay():(a._c5=!0,a._d5()))});a.ev.on("rsBeforeMove",function(b,e,c){a._a5&&(c&&a.st.autoPlay.stopAtAction?
a.stopAutoPlay():(a._c5=!0,a._d5()))});a._e5=!1;a.ev.on("rsVideoStop",function(){a._a5&&(a._e5=!1,a._b5())});a.ev.on("rsVideoPlay",function(){a._a5&&(a._c5=!1,a._d5(),a._e5=!0)});b(window).on("blur"+a.ns,function(){a._a5&&(a._c5=!0,a._d5())}).on("focus"+a.ns,function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.st.autoPlay.pauseOnHover&&(a._f5=!1,a.slider.hover(function(){a._a5&&(a._c5=!1,a._d5(),a._f5=!0)},function(){a._a5&&(a._f5=!1,a._b5())}))},toggleAutoPlay:function(){this._a5?this.stopAutoPlay():
this.startAutoPlay()},startAutoPlay:function(){this._a5=!0;this.currSlide.isLoaded&&this._b5()},stopAutoPlay:function(){this._e5=this._f5=this._c5=this._a5=!1;this._d5()},_b5:function(){var a=this;a._f5||a._e5||(a._g5=!0,a._h5&&clearTimeout(a._h5),a._h5=setTimeout(function(){var b;a._z||a.st.loopRewind||(b=!0,a.st.loopRewind=!0);a.next(!0);b&&(a.st.loopRewind=!1)},a.currSlide.customDelay?a.currSlide.customDelay:a.st.autoPlay.delay))},_d5:function(){this._f5||this._e5||(this._g5=!1,this._h5&&(clearTimeout(this._h5),
this._h5=null))}});b.rsModules.autoplay=b.rsProto._x4})(jQuery);
// jquery.rs.video v1.1.3
(function(f){f.extend(f.rsProto,{_z6:function(){var a=this;a._a7={autoHideArrows:!0,autoHideControlNav:!1,autoHideBlocks:!1,autoHideCaption:!1,disableCSS3inFF:!0,youTubeCode:'<iframe src="http://www.youtube.com/embed/%id%?rel=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',vimeoCode:'<iframe src="http://player.vimeo.com/video/%id%?byline=0&portrait=0&autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'};a.st.video=f.extend({},a._a7,
a.st.video);a.ev.on("rsBeforeSizeSet",function(){a._b7&&setTimeout(function(){var b=a._r1,b=b.hasClass("rsVideoContainer")?b:b.find(".rsVideoContainer");a._c7&&a._c7.css({width:b.width(),height:b.height()})},32)});var d=a._a.mozilla;a.ev.on("rsAfterParseNode",function(b,c,e){b=f(c);if(e.videoURL){a.st.video.disableCSS3inFF&&d&&(a._e=a._f=!1);c=f('<div class="rsVideoContainer"></div>');var g=f('<div class="rsBtnCenterer"><div class="rsPlayBtn"><div class="rsPlayBtnIcon"></div></div></div>');b.hasClass("rsImg")?
e.content=c.append(b).append(g):e.content.find(".rsImg").wrap(c).after(g)}});a.ev.on("rsAfterSlideChange",function(){a.stopVideo()})},toggleVideo:function(){return this._b7?this.stopVideo():this.playVideo()},playVideo:function(){var a=this;if(!a._b7){var d=a.currSlide;if(!d.videoURL)return!1;a._d7=d;var b=a._e7=d.content,d=d.videoURL,c,e;d.match(/youtu\.be/i)||d.match(/youtube\.com/i)?(e=/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,(e=d.match(e))&&11==e[7].length&&
(c=e[7]),void 0!==c&&(a._c7=a.st.video.youTubeCode.replace("%id%",c))):d.match(/vimeo\.com/i)&&(e=/(www\.)?vimeo.com\/(\d+)($|\/)/,(e=d.match(e))&&(c=e[2]),void 0!==c&&(a._c7=a.st.video.vimeoCode.replace("%id%",c)));a.videoObj=f(a._c7);a.ev.trigger("rsOnCreateVideoElement",[d]);a.videoObj.length&&(a._c7=f('<div class="rsVideoFrameHolder"><div class="rsPreloader"></div><div class="rsCloseVideoBtn"><div class="rsCloseVideoIcn"></div></div></div>'),a._c7.find(".rsPreloader").after(a.videoObj),b=b.hasClass("rsVideoContainer")?
b:b.find(".rsVideoContainer"),a._c7.css({width:b.width(),height:b.height()}).find(".rsCloseVideoBtn").off("click.rsv").on("click.rsv",function(b){a.stopVideo();b.preventDefault();b.stopPropagation();return!1}),b.append(a._c7),a.isIPAD&&b.addClass("rsIOSVideo"),a._f7(!1),setTimeout(function(){a._c7.addClass("rsVideoActive")},10),a.ev.trigger("rsVideoPlay"),a._b7=!0);return!0}return!1},stopVideo:function(){var a=this;return a._b7?(a.isIPAD&&a.slider.find(".rsCloseVideoBtn").remove(),a._f7(!0),setTimeout(function(){a.ev.trigger("rsOnDestroyVideoElement",
[a.videoObj]);var d=a._c7.find("iframe");if(d.length)try{d.attr("src","")}catch(b){}a._c7.remove();a._c7=null},16),a.ev.trigger("rsVideoStop"),a._b7=!1,!0):!1},_f7:function(a,d){var b=[],c=this.st.video;c.autoHideArrows&&(this._c2&&(b.push(this._c2,this._d2),this._e2=!a),this._v5&&b.push(this._v5));c.autoHideControlNav&&this._k5&&b.push(this._k5);c.autoHideBlocks&&this._d7.animBlocks&&b.push(this._d7.animBlocks);c.autoHideCaption&&this.globalCaption&&b.push(this.globalCaption);this.slider[a?"removeClass":
"addClass"]("rsVideoPlaying");if(b.length)for(c=0;c<b.length;c++)a?b[c].removeClass("rsHidden"):b[c].addClass("rsHidden")}});f.rsModules.video=f.rsProto._z6})(jQuery);
// jquery.rs.animated-blocks v1.0.7
(function(l){l.extend(l.rsProto,{_p4:function(){function m(){var g=a.currSlide;if(a.currSlide&&a.currSlide.isLoaded&&a._t4!==g){if(0<a._s4.length){for(b=0;b<a._s4.length;b++)clearTimeout(a._s4[b]);a._s4=[]}if(0<a._r4.length){var f;for(b=0;b<a._r4.length;b++)if(f=a._r4[b])a._e?(f.block.css(a._g+a._u1,"0s"),f.block.css(f.css)):f.block.stop(!0).css(f.css),a._t4=null,g.animBlocksDisplayed=!1;a._r4=[]}g.animBlocks&&(g.animBlocksDisplayed=!0,a._t4=g,a._u4(g.animBlocks))}}var a=this,b;a._q4={fadeEffect:!0,
moveEffect:"top",moveOffset:20,speed:400,easing:"easeOutSine",delay:200};a.st.block=l.extend({},a._q4,a.st.block);a._r4=[];a._s4=[];a.ev.on("rsAfterInit",function(){m()});a.ev.on("rsBeforeParseNode",function(a,b,d){b=l(b);d.animBlocks=b.find(".rsABlock").css("display","none");d.animBlocks.length||(b.hasClass("rsABlock")?d.animBlocks=b.css("display","none"):d.animBlocks=!1)});a.ev.on("rsAfterContentSet",function(b,f){f.id===a.slides[a.currSlideId].id&&setTimeout(function(){m()},a.st.fadeinLoadedSlide?
300:0)});a.ev.on("rsAfterSlideChange",function(){m()})},_v4:function(l,a){setTimeout(function(){l.css(a)},6)},_u4:function(m){var a=this,b,g,f,d,h,e,n;a._s4=[];m.each(function(m){b=l(this);g={};f={};d=null;var c=b.attr("data-move-offset"),c=c?parseInt(c,10):a.st.block.moveOffset;if(0<c&&((e=b.data("move-effect"))?(e=e.toLowerCase(),"none"===e?e=!1:"left"!==e&&"top"!==e&&"bottom"!==e&&"right"!==e&&(e=a.st.block.moveEffect,"none"===e&&(e=!1))):e=a.st.block.moveEffect,e&&"none"!==e)){var p;p="right"===
e||"left"===e?!0:!1;var k;n=!1;a._e?(k=0,h=a._x1):(p?isNaN(parseInt(b.css("right"),10))?h="left":(h="right",n=!0):isNaN(parseInt(b.css("bottom"),10))?h="top":(h="bottom",n=!0),h="margin-"+h,n&&(c=-c),a._e?k=parseInt(b.css(h),10):(k=b.data("rs-start-move-prop"),void 0===k&&(k=parseInt(b.css(h),10),isNaN(k)&&(k=0),b.data("rs-start-move-prop",k))));f[h]=a._m4("top"===e||"left"===e?k-c:k+c,p);g[h]=a._m4(k,p)}c=b.attr("data-fade-effect");if(!c)c=a.st.block.fadeEffect;else if("none"===c.toLowerCase()||
"false"===c.toLowerCase())c=!1;c&&(f.opacity=0,g.opacity=1);if(c||e)d={},d.hasFade=Boolean(c),Boolean(e)&&(d.moveProp=h,d.hasMove=!0),d.speed=b.data("speed"),isNaN(d.speed)&&(d.speed=a.st.block.speed),d.easing=b.data("easing"),d.easing||(d.easing=a.st.block.easing),d.css3Easing=l.rsCSS3Easing[d.easing],d.delay=b.data("delay"),isNaN(d.delay)&&(d.delay=a.st.block.delay*m);c={};a._e&&(c[a._g+a._u1]="0ms");c.moveProp=g.moveProp;c.opacity=g.opacity;c.display="none";a._r4.push({block:b,css:c});a._v4(b,
f);a._s4.push(setTimeout(function(b,d,c,e){return function(){b.css("display","block");if(c){var g={};if(a._e){var f="";c.hasMove&&(f+=c.moveProp);c.hasFade&&(c.hasMove&&(f+=", "),f+="opacity");g[a._g+a._t1]=f;g[a._g+a._u1]=c.speed+"ms";g[a._g+a._v1]=c.css3Easing;b.css(g);setTimeout(function(){b.css(d)},24)}else setTimeout(function(){b.animate(d,c.speed,c.easing)},16)}delete a._s4[e]}}(b,g,d,m),6>=d.delay?12:d.delay))})}});l.rsModules.animatedBlocks=l.rsProto._p4})(jQuery);
// jquery.rs.auto-height v1.0.3
(function(b){b.extend(b.rsProto,{_w4:function(){var a=this;if(a.st.autoHeight){var b,c,e,f=!0,d=function(d){e=a.slides[a.currSlideId];(b=e.holder)&&(c=b.height())&&void 0!==c&&c>(a.st.minAutoHeight||30)&&(a._c4=c,a._e||!d?a._e1.css("height",c):a._e1.stop(!0,!0).animate({height:c},a.st.transitionSpeed),a.ev.trigger("rsAutoHeightChange",c),f&&(a._e&&setTimeout(function(){a._e1.css(a._g+"transition","height "+a.st.transitionSpeed+"ms ease-in-out")},16),f=!1))};a.ev.on("rsMaybeSizeReady.rsAutoHeight",
function(a,b){e===b&&d()});a.ev.on("rsAfterContentSet.rsAutoHeight",function(a,b){e===b&&d()});a.slider.addClass("rsAutoHeight");a.ev.one("rsAfterInit",function(){setTimeout(function(){d(!1);setTimeout(function(){a.slider.append('<div style="clear:both; float: none;"></div>')},16)},16)});a.ev.on("rsBeforeAnimStart",function(){d(!0)});a.ev.on("rsBeforeSizeSet",function(){setTimeout(function(){d(!1)},16)})}}});b.rsModules.autoHeight=b.rsProto._w4})(jQuery);
// jquery.rs.global-caption v1.0
(function(b){b.extend(b.rsProto,{_d6:function(){var a=this;a.st.globalCaption&&(a.ev.on("rsAfterInit",function(){a.globalCaption=b('<div class="rsGCaption"></div>').appendTo(a.st.globalCaptionInside?a._e1:a.slider);a.globalCaption.html(a.currSlide.caption)}),a.ev.on("rsBeforeAnimStart",function(){a.globalCaption.html(a.currSlide.caption)}))}});b.rsModules.globalCaption=b.rsProto._d6})(jQuery);
// jquery.rs.active-class v1.0.1
(function(c){c.rsProto._o4=function(){var b,a=this;if(a.st.addActiveClass)a.ev.on("rsOnUpdateNav",function(){b&&clearTimeout(b);b=setTimeout(function(){a._g4&&a._g4.removeClass("rsActiveSlide");a._r1&&a._r1.addClass("rsActiveSlide");b=null},50)})};c.rsModules.activeClass=c.rsProto._o4})(jQuery);
// jquery.rs.deeplinking v1.0.6 + jQuery hashchange plugin v1.3 Copyright (c) 2010 Ben Alman
(function(d){d.extend(d.rsProto,{_o5:function(){var a=this,l,g,f;a._p5={enabled:!1,change:!1,prefix:""};a.st.deeplinking=d.extend({},a._p5,a.st.deeplinking);if(a.st.deeplinking.enabled){var k=a.st.deeplinking.change,c=a.st.deeplinking.prefix,e="#"+c,h=function(){var b=window.location.hash;return b&&0<b.indexOf(c)&&(b=parseInt(b.substring(e.length),10),0<=b)?b-1:-1},m=h();-1!==m&&(a.st.startSlideId=m);k&&(d(window).on("hashchange"+a.ns,function(b){l||(b=h(),0>b||(b>a.numSlides-1&&(b=a.numSlides-1),
a.goTo(b)))}),a.ev.on("rsBeforeAnimStart",function(){g&&clearTimeout(g);f&&clearTimeout(f)}),a.ev.on("rsAfterSlideChange",function(){g&&clearTimeout(g);f&&clearTimeout(f);f=setTimeout(function(){l=!0;window.location.replace((""+window.location).split("#")[0]+e+(a.currSlideId+1));g=setTimeout(function(){l=!1;g=null},60)},400)}));a.ev.on("rsBeforeDestroy",function(){g=f=null;k&&d(window).off("hashchange"+a.ns)})}}});d.rsModules.deeplinking=d.rsProto._o5})(jQuery);
(function(d,a,l){function g(b){b=b||location.href;return"#"+b.replace(/^[^#]*#?(.*)$/,"$1")}"$:nomunge";var f="hashchange",k=document,c,e=d.event.special,h=k.documentMode,m="on"+f in a&&(h===l||7<h);d.fn[f]=function(b){return b?this.bind(f,b):this.trigger(f)};d.fn[f].delay=50;e[f]=d.extend(e[f],{setup:function(){if(m)return!1;d(c.start)},teardown:function(){if(m)return!1;d(c.stop)}});c=function(){function b(){var c=g(),n=r(h);c!==h?(p(h=c,n),d(a).trigger(f)):n!==h&&(location.href=location.href.replace(/#.*/,
"")+n);e=setTimeout(b,d.fn[f].delay)}var c={},e,h=g(),q=function(b){return b},p=q,r=q;c.start=function(){e||b()};c.stop=function(){e&&clearTimeout(e);e=l};a.attachEvent&&!a.addEventListener&&!m&&function(){var a,e;c.start=function(){a||(e=(e=d.fn[f].src)&&e+g(),a=d('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){e||p(g());b()}).attr("src",e||"javascript:0").insertAfter("body")[0].contentWindow,k.onpropertychange=function(){try{"title"===event.propertyName&&(a.document.title=
k.title)}catch(b){}})};c.stop=q;r=function(){return g(a.location.href)};p=function(b,e){var c=a.document,g=d.fn[f].domain;b!==e&&(c.title=k.title,c.open(),g&&c.write('<script>document.domain="'+g+'"\x3c/script>'),c.close(),a.location.hash=b)}}();return c}()})(jQuery,this);
// jquery.rs.visible-nearby v1.0.2
(function(d){d.rsProto._g7=function(){var a=this;a.st.visibleNearby&&a.st.visibleNearby.enabled&&(a._h7={enabled:!0,centerArea:0.6,center:!0,breakpoint:0,breakpointCenterArea:0.8,hiddenOverflow:!0,navigateByCenterClick:!1},a.st.visibleNearby=d.extend({},a._h7,a.st.visibleNearby),a.ev.one("rsAfterPropsSetup",function(){a._i7=a._e1.css("overflow","visible").wrap('<div class="rsVisibleNearbyWrap"></div>').parent();a.st.visibleNearby.hiddenOverflow||a._i7.css("overflow","visible");a._o1=a.st.controlsInside?
a._i7:a.slider}),a.ev.on("rsAfterSizePropSet",function(){var b,c=a.st.visibleNearby;b=c.breakpoint&&a.width<c.breakpoint?c.breakpointCenterArea:c.centerArea;a._h?(a._b4*=b,a._i7.css({height:a._c4,width:a._b4/b}),a._d=a._b4*(1-b)/2/b):(a._c4*=b,a._i7.css({height:a._c4/b,width:a._b4}),a._d=a._c4*(1-b)/2/b);c.navigateByCenterClick||(a._q=a._h?a._b4:a._c4);c.center&&a._e1.css("margin-"+(a._h?"left":"top"),a._d)}))};d.rsModules.visibleNearby=d.rsProto._g7})(jQuery);

/*! Riloadr.js 1.5.0 (c) 2013 Tubal Martin - MIT license */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):window.Riloadr=a(jQuery)}(function(a){"use strict";function ib(b){function ib(){cb=ob(),_=jb(k,cb,K),db=_[D]&&lb(k,_[D]),eb=eb||G&&kb(k),fb=H&&mb(_,eb)}function rb(){var b,a=0;if((R||G)&&Ab(U,u,X),R&&(Ab(U,s,W),bb&&(hb=U[M],Ab(U,Q,Y)),B))for(;b=B[a];)Ab(V[O](b),s,W),a++}function sb(){var b,a=0;if(!G&&(Bb(U,u,X),R)){if(Bb(U,s,W),B)for(;b=B[a];)Bb(V[O](b),s,W),a++;bb&&Bb(U,Q,Y)}}function tb(a,b){a[y]=0,a[D]=h,a[v]=ub,a[w]=a[x]=xb,a[d]=pb(a,g,_),Z.splice(b,1)}function ub(){var c,e,a=this;"naturalWidth"in a?e=a.naturalWidth+a.naturalHeight:(c=new Image,c[d]=a[d],e=c[o]+c[q],c=j),+e>0&&(a[v]=a[w]=a[x]=j,a[C]&&(a[E]=a[E].replace(n,"$1$2")),R&&(a.style.visibility="visible"),v in b&&b[v][l](a),Eb())}function xb(){var f,a=this,c=function(b){var c=new Image;c[v]=function(){a[d]=c[d],ub[l](a)},c[w]=a[x]=function(){xb[l](a)},c[d]=b};a[v]=a[w]=a[x]=j,w in b&&b[w][l](a),a[y]<N?(a[y]++,f=pb(a,g,a[D]?db:_,e),c(f)):D in _&&!a[D]?(a[y]=0,a[D]=e,f=pb(a,g,db),c(f)):Eb()}function Eb(){$--,0===$&&(sb(),J in b&&b[J]())}var _,ab,eb,fb,c=this,g=b.base||p,k=b.breakpoints||zb('"breakpoints" not defined.'),m=b.name||"responsive",n=new RegExp("(^|\\s)"+m+"(\\s|$)"),t=b.defer&&("string"==typeof b.defer?{mode:b.defer,threshold:b.foldDistance,overflownElemsIds:[]}:b.defer),z=t&&t.mode.toLowerCase(),A=t&&t.threshold||100,B=t&&t.overflownElemsIds,F=b.watchViewportWidth,G=!!F,H="wider"==F,I="*"==F,K=b.ignoreLowBandwidth||h,N=b[y]||0,P=b.root||j,R=("invisible"==z||"belowfold"==z)&&!gb,W=vb(function(){c[L]()},i),X=wb(function(){G&&ib(),c[L](G)},i),Y=wb(function(){U[M]!==hb&&(hb=U[M],c[L]())},i),Z=[],$=0,db={};c[L]=function(b){yb(function(c,d){if(Z[r]&&b!==e||(b&&rb(),a("img."+m,P).each(function(a,b){b&&!b[C]&&((!G||G&&(!ab||H&&nb(_,ab)||I&&!mb(_,ab)))&&(Z.push(b),$++),(!G||fb)&&(b[C]=e))}),G&&(fb&&(G=h),ab=_)),Z[r])for(d=0;c=Z[d];)c&&(!R||R&&qb(c,A))&&(tb(c,d),d--),d++;c=j})},Cb(function(){S=a(U),T=V[f],P=P&&a("#"+P)||T,ib(),rb(),!z||R?c[L]():Db(c[L])})}function jb(a,b,c){for(var g,h,i,j,d=b,e=0,f={};g=a[e];)h=g[z],i=g[A],j=g[R],b>0?(h&&i&&b>=h&&i>=b||h&&!i&&b>=h||i&&!h&&i>=b)&&(!j||j&&eb>=j&&(c||!c&&!fb))&&(f=g):(0>=d||d>h||d>i)&&(d=h||i||d,f=g),e++;return f}function kb(a){for(var d,b=0,c={};d=a[b];)nb(d,c)&&(c=d),b++;return c}function lb(a,b){for(var d,c=0;d=a[c];){if(d.name==b)return d;c++}}function mb(a,b){return a.name===b.name&&a[z]===b[z]&&a[A]===b[A]&&a[R]===b[R]&&a[F]===b[F]}function nb(a,b){var c=+a[R]||1,d=+b[R]||1;return a=Math.max(+a[z]||0,+a[A]||0)*(eb>=c?c:1),b=Math.max(+b[z]||0,+b[A]||0)*(eb>=d?d:1),a>b}function ob(){for(var f,a=Math,b=[W.clientWidth,W.offsetWidth,T.clientWidth],c=a.ceil(db/eb),d=b[r],e=0;d>e;e++)isNaN(b[e])&&(b.splice(e,1),e--);return b[r]&&(f=a.max[m](a,b),isNaN(c)),f||c||0}function pb(a,b,c,d){var e=(a.getAttribute("data-base")||b)+(a.getAttribute("data-src")||a.getAttribute("data-src-"+c.name)||p);return c[F]&&(e=e.split("."),e.pop(),e=e.join(".")+"."+c[F]),d&&(e+=(_.test(e)?"&":"?")+"riloadrts="+(new Date).getTime()),e.replace(ab,c.name)}function fb(){var a=U.navigator,b=a.connection||a.mozConnection||a.webkitConnection||a.oConnection||a.msConnection||{},c=b.type||"unknown",d=+b.bandwidth||1/0;return d>0&&.1>d||/^[23]g|3|4$/.test(c+p)}function qb(b,c){var d=a(b);return!(rb(d,c)||sb(d,c)||tb(d,c)||ub(d,c))}function rb(a,b){return S[q]()+S[I]()<=a[t]()[c]-b}function sb(a,b){return S[I]()>=a[t]()[c]+b+a[q]()}function tb(a,b){return S[o]()+S[K]()<=a[t]()[g]-b}function ub(a,b){return S[K]()>=a[t]()[g]+b+a[o]()}function vb(a,b){function h(){g=new Date,f=j,a[m](e,c)}var c,d,e,f,g=0;return function(){var i=new Date,j=b-(i-g);return c=arguments,e=this,0>=j?(g=i,d=a[m](e,c)):f||(f=xb(h,j)),d}}function wb(a,b,c){function h(){g=j,c||a[m](f,d)}var d,e,f,g;return function(){var i=c&&!g;return d=arguments,f=this,clearTimeout(g),g=xb(h,b),i&&(e=a[m](f,d)),e}}function xb(a,b){var c=Array[G].slice[l](arguments,2);return U.setTimeout(function(){return a[m](j,c)},b)}function yb(a){return xb[m](j,[a,1].concat(Array[G].slice[l](arguments,1)))}function zb(a){throw new Error("Riloadr: "+a)}function Ab(a,b,c){a[Z](Y+b,c,h)}function Bb(a,b,c){a[$](Y+b,c,h)}function Cb(b){a(b)}function Db(a){if(V.readyState===B)a();else{var b=function(){Bb(U,k,b),a()};Ab(U,k,b)}}var S,T,cb,hb,b="on",c="top",d="src",e=!0,f="body",g="left",h=!1,i=250,j=null,k="load",l="call",m="apply",n="error",o="width",p="",q="height",r="length",s="scroll",t="offset",u="resize",v=b+k,w=b+n,x=b+"abort",y="retries",z="minWidth",A="maxWidth",B="complete",C="riloaded",D="fallback",E="className",F="imgFormat",G="prototype",I=s+"Top",J=b+B,K=s+"Left",L=k+"Images",M="orientation",N="EventListener",O="getElementById",P="add"+N,Q=M+"change",R="minDevicePixelRatio",U=window,V=U.document,W=V.documentElement,X=P in V,Y=X?p:b,Z=X?P:"attachEvent",$=X?"remove"+N:"detachEvent",_=/\?/,ab=/{breakpoint-name}/gi,bb=M in U&&b+Q in U,db=U.screen[o],eb=U.devicePixelRatio||1,fb=fb(),gb="[object OperaMini]"===Object[G].toString[l](U.operamini);return W[E]=W[E].replace(/(^|\s)no-js(\s|$)/,"$1$2"),ib.version="1.5.0",ib[G].riload=function(){this[L](e)},ib});

	/* --- $DEBOUNCES RESIZE --- */
	
	/* debouncedresize: special jQuery event that happens once after a window resize
	* https://github.com/louisremi/jquery-smartresize
	* Copyright 2012 @louis_remi
	*/
	(function($){var $event=$.event,$special,resizeTimeout;$special=$event.special.debouncedresize={setup:function(){$(this).on("resize",$special.handler);},teardown:function(){$(this).off("resize",$special.handler);},handler:function(event,execAsap){var context=this,args=arguments,dispatch=function(){event.type="debouncedresize";$event.dispatch.apply(context,args);};if(resizeTimeout){clearTimeout(resizeTimeout);}execAsap?dispatch():resizeTimeout=setTimeout(dispatch,$special.threshold);},threshold:150};})(jQuery);



	/* --- $AUTORESIZE TEXTAREA --- */

	/* Autosize v1.18.1 - 2013-11-05
	* Automatically adjust textarea height based on user input.
	* (c) 2013 Jack Moore - http://www.jacklmoore.com/autosize
	* license: http://www.opensource.org/licenses/mit-license.php
	*/
	(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);



	 /* --- $SHARRRE --- */

	 /*  Sharrre.com - Make your sharing widget!
	 *  Version: beta 1.3.5
	 *  Author: Julien Hany
	 *  License: MIT http://en.wikipedia.org/wiki/MIT_License or GPLv2 http://en.wikipedia.org/wiki/GNU_General_Public_License
	 */
	 (function($,window,document,undefined){var pluginName="sharrre",defaults={className:"sharrre",share:{googlePlus:false,facebook:false,twitter:false,digg:false,delicious:false,stumbleupon:false,linkedin:false,pinterest:false},shareTotal:0,template:"",title:"",url:document.location.href,text:document.title,urlCurl:sharrre_urlCurl,count:{},total:0,shorterTotal:true,enableHover:true,enableCounter:true,enableTracking:false,hover:function(){},hide:function(){},click:function(){},render:function(){},buttons:{googlePlus:{url:"",urlCount:false,size:"medium",lang:"en-US",annotation:""},facebook:{url:"",urlCount:false,action:"like",layout:"button_count",width:"",send:"false",faces:"false",colorscheme:"",font:"",lang:"en_US"},twitter:{url:"",urlCount:false,count:"horizontal",hashtags:"",via:"",related:"",lang:"en"},digg:{url:"",urlCount:false,type:"DiggCompact"},delicious:{url:"",urlCount:false,size:"medium"},stumbleupon:{url:"",urlCount:false,layout:"1"},linkedin:{url:"",urlCount:false,counter:""},pinterest:{url:"",media:"",description:"",layout:"horizontal"}}},urlJson={googlePlus:"",facebook:"https://graph.facebook.com/fql?q=SELECT%20url,%20normalized_url,%20share_count,%20like_count,%20comment_count,%20total_count,commentsbox_count,%20comments_fbid,%20click_count%20FROM%20link_stat%20WHERE%20url=%27{url}%27&callback=?",twitter:"http://cdn.api.twitter.com/1/urls/count.json?url={url}&callback=?",digg:"http://services.digg.com/2.0/story.getInfo?links={url}&type=javascript&callback=?",delicious:"http://feeds.delicious.com/v2/json/urlinfo/data?url={url}&callback=?",stumbleupon:"",linkedin:"http://www.linkedin.com/countserv/count/share?format=jsonp&url={url}&callback=?",pinterest:"http://api.pinterest.com/v1/urls/count.json?url={url}&callback=?"},loadButton={googlePlus:function(self){var sett=self.options.buttons.googlePlus;$(self.element).find(".buttons").append('<div class="button googleplus"><div class="g-plusone" data-size="'+sett.size+'" data-href="'+(sett.url!==""?sett.url:self.options.url)+'" data-annotation="'+sett.annotation+'"></div></div>');window.___gcfg={lang:self.options.buttons.googlePlus.lang};var loading=0;if(typeof gapi==="undefined"&&loading==0){loading=1;(function(){var po=document.createElement("script");po.type="text/javascript";po.async=true;po.src="//apis.google.com/js/plusone.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(po,s);})();}else{gapi.plusone.go();}},facebook:function(self){var sett=self.options.buttons.facebook;$(self.element).find(".buttons").append('<div class="button facebook"><div id="fb-root"></div><div class="fb-like" data-href="'+(sett.url!==""?sett.url:self.options.url)+'" data-send="'+sett.send+'" data-layout="'+sett.layout+'" data-width="'+sett.width+'" data-show-faces="'+sett.faces+'" data-action="'+sett.action+'" data-colorscheme="'+sett.colorscheme+'" data-font="'+sett.font+'" data-via="'+sett.via+'"></div></div>');var loading=0;if(typeof FB==="undefined"&&loading==0){loading=1;(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/"+sett.lang+"/all.js#xfbml=1";fjs.parentNode.insertBefore(js,fjs);}(document,"script","facebook-jssdk"));}else{FB.XFBML.parse();}},twitter:function(self){var sett=self.options.buttons.twitter;$(self.element).find(".buttons").append('<div class="button twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'+(sett.url!==""?sett.url:self.options.url)+'" data-count="'+sett.count+'" data-text="'+self.options.text+'" data-via="'+sett.via+'" data-hashtags="'+sett.hashtags+'" data-related="'+sett.related+'" data-lang="'+sett.lang+'">Tweet</a></div>');var loading=0;if(typeof twttr==="undefined"&&loading==0){loading=1;(function(){var twitterScriptTag=document.createElement("script");twitterScriptTag.type="text/javascript";twitterScriptTag.async=true;twitterScriptTag.src="//platform.twitter.com/widgets.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(twitterScriptTag,s);})();}else{$.ajax({url:"//platform.twitter.com/widgets.js",dataType:"script",cache:true});}},digg:function(self){var sett=self.options.buttons.digg;$(self.element).find(".buttons").append('<div class="button digg"><a class="DiggThisButton '+sett.type+'" rel="nofollow external" href="http://digg.com/submit?url='+encodeURIComponent((sett.url!==""?sett.url:self.options.url))+'"></a></div>');var loading=0;if(typeof __DBW==="undefined"&&loading==0){loading=1;(function(){var s=document.createElement("SCRIPT"),s1=document.getElementsByTagName("SCRIPT")[0];s.type="text/javascript";s.async=true;s.src="//widgets.digg.com/buttons.js";s1.parentNode.insertBefore(s,s1);})();}},delicious:function(self){if(self.options.buttons.delicious.size=="tall"){var css="width:50px;",cssCount="height:35px;width:50px;font-size:15px;line-height:35px;",cssShare="height:18px;line-height:18px;margin-top:3px;";}else{var css="width:93px;",cssCount="float:right;padding:0 3px;height:20px;width:26px;line-height:20px;",cssShare="float:left;height:20px;line-height:20px;";}var count=self.shorterTotal(self.options.count.delicious);if(typeof count==="undefined"){count=0;}$(self.element).find(".buttons").append('<div class="button delicious"><div style="'+css+'font:12px Arial,Helvetica,sans-serif;cursor:pointer;color:#666666;display:inline-block;float:none;height:20px;line-height:normal;margin:0;padding:0;text-indent:0;vertical-align:baseline;"><div style="'+cssCount+'background-color:#fff;margin-bottom:5px;overflow:hidden;text-align:center;border:1px solid #ccc;border-radius:3px;">'+count+'</div><div style="'+cssShare+'display:block;padding:0;text-align:center;text-decoration:none;width:50px;background-color:#7EACEE;border:1px solid #40679C;border-radius:3px;color:#fff;"><img src="http://www.delicious.com/static/img/delicious.small.gif" height="10" width="10" alt="Delicious" /> Add</div></div></div>');$(self.element).find(".delicious").on("click",function(){self.openPopup("delicious");});},stumbleupon:function(self){var sett=self.options.buttons.stumbleupon;$(self.element).find(".buttons").append('<div class="button stumbleupon"><su:badge layout="'+sett.layout+'" location="'+(sett.url!==""?sett.url:self.options.url)+'"></su:badge></div>');var loading=0;if(typeof STMBLPN==="undefined"&&loading==0){loading=1;(function(){var li=document.createElement("script");li.type="text/javascript";li.async=true;li.src="//platform.stumbleupon.com/1/widgets.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(li,s);})();s=window.setTimeout(function(){if(typeof STMBLPN!=="undefined"){STMBLPN.processWidgets();clearInterval(s);}},500);}else{STMBLPN.processWidgets();}},linkedin:function(self){var sett=self.options.buttons.linkedin;$(self.element).find(".buttons").append('<div class="button linkedin"><script type="in/share" data-url="'+(sett.url!==""?sett.url:self.options.url)+'" data-counter="'+sett.counter+'"><\/script></div>');var loading=0;if(typeof window.IN==="undefined"&&loading==0){loading=1;(function(){var li=document.createElement("script");li.type="text/javascript";li.async=true;li.src="//platform.linkedin.com/in.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(li,s);})();}else{window.IN.init();}},pinterest:function(self){var sett=self.options.buttons.pinterest;$(self.element).find(".buttons").append('<div class="button pinterest"><a href="http://pinterest.com/pin/create/button/?url='+(sett.url!==""?sett.url:self.options.url)+"&media="+sett.media+"&description="+sett.description+'" class="pin-it-button" count-layout="'+sett.layout+'">Pin It</a></div>');(function(){var li=document.createElement("script");li.type="text/javascript";li.async=true;li.src="//assets.pinterest.com/js/pinit.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(li,s);})();}},tracking={googlePlus:function(){},facebook:function(){fb=window.setInterval(function(){if(typeof FB!=="undefined"){FB.Event.subscribe("edge.create",function(targetUrl){_gaq.push(["_trackSocial","facebook","like",targetUrl]);});FB.Event.subscribe("edge.remove",function(targetUrl){_gaq.push(["_trackSocial","facebook","unlike",targetUrl]);});FB.Event.subscribe("message.send",function(targetUrl){_gaq.push(["_trackSocial","facebook","send",targetUrl]);});clearInterval(fb);}},1000);},twitter:function(){tw=window.setInterval(function(){if(typeof twttr!=="undefined"){twttr.events.bind("tweet",function(event){if(event){_gaq.push(["_trackSocial","twitter","tweet"]);}});clearInterval(tw);}},1000);},digg:function(){},delicious:function(){},stumbleupon:function(){},linkedin:function(){function LinkedInShare(){_gaq.push(["_trackSocial","linkedin","share"]);}},pinterest:function(){}},popup={googlePlus:function(opt){window.open("https://plus.google.com/share?hl="+opt.buttons.googlePlus.lang+"&url="+encodeURIComponent((opt.buttons.googlePlus.url!==""?opt.buttons.googlePlus.url:opt.url)),"","toolbar=0, status=0, width=900, height=500");},facebook:function(opt){window.open("http://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent((opt.buttons.facebook.url!==""?opt.buttons.facebook.url:opt.url))+"&t="+opt.text+"","","toolbar=0, status=0, width=900, height=500");},twitter:function(opt){window.open("https://twitter.com/intent/tweet?text="+encodeURIComponent(opt.text)+"&url="+encodeURIComponent((opt.buttons.twitter.url!==""?opt.buttons.twitter.url:opt.url))+(opt.buttons.twitter.via!==""?"&via="+opt.buttons.twitter.via:""),"","toolbar=0, status=0, width=650, height=360");},digg:function(opt){window.open("http://digg.com/tools/diggthis/submit?url="+encodeURIComponent((opt.buttons.digg.url!==""?opt.buttons.digg.url:opt.url))+"&title="+opt.text+"&related=true&style=true","","toolbar=0, status=0, width=650, height=360");},delicious:function(opt){window.open("http://www.delicious.com/save?v=5&noui&jump=close&url="+encodeURIComponent((opt.buttons.delicious.url!==""?opt.buttons.delicious.url:opt.url))+"&title="+opt.text,"delicious","toolbar=no,width=550,height=550");},stumbleupon:function(opt){window.open("http://www.stumbleupon.com/badge/?url="+encodeURIComponent((opt.buttons.delicious.url!==""?opt.buttons.delicious.url:opt.url)),"stumbleupon","toolbar=no,width=550,height=550");},linkedin:function(opt){window.open("https://www.linkedin.com/cws/share?url="+encodeURIComponent((opt.buttons.delicious.url!==""?opt.buttons.delicious.url:opt.url))+"&token=&isFramed=true","linkedin","toolbar=no,width=550,height=550");},pinterest:function(opt){window.open("http://pinterest.com/pin/create/button/?url="+encodeURIComponent((opt.buttons.pinterest.url!==""?opt.buttons.pinterest.url:opt.url))+"&media="+encodeURIComponent(opt.buttons.pinterest.media)+"&description="+opt.buttons.pinterest.description,"pinterest","toolbar=no,width=700,height=300");}};function Plugin(element,options){this.element=element;this.options=$.extend(true,{},defaults,options);this.options.share=options.share;this._defaults=defaults;this._name=pluginName;this.init();}Plugin.prototype.init=function(){var self=this;if(this.options.urlCurl!==""){urlJson.googlePlus=this.options.urlCurl+"?url={url}&type=googlePlus";urlJson.stumbleupon=this.options.urlCurl+"?url={url}&type=stumbleupon";}$(this.element).addClass(this.options.className);if(typeof $(this.element).data("title")!=="undefined"){this.options.title=$(this.element).attr("data-title");}if(typeof $(this.element).data("url")!=="undefined"){this.options.url=$(this.element).data("url");}if(typeof $(this.element).data("text")!=="undefined"){this.options.text=$(this.element).data("text");}$.each(this.options.share,function(name,val){if(val===true){self.options.shareTotal++;}});if(self.options.enableCounter===true){$.each(this.options.share,function(name,val){if(val===true){try{self.getSocialJson(name);}catch(e){}}});}else{if(self.options.template!==""){this.options.render(this,this.options);}else{this.loadButtons();}}$(this.element).hover(function(){if($(this).find(".buttons").length===0&&self.options.enableHover===true){self.loadButtons();}self.options.hover(self,self.options);},function(){self.options.hide(self,self.options);});$(this.element).click(function(event){self.options.click(self,self.options);event.preventDefault();});};Plugin.prototype.loadButtons=function(){var self=this;$(this.element).append('<div class="buttons"></div>');$.each(self.options.share,function(name,val){if(val==true){loadButton[name](self);if(self.options.enableTracking===true){tracking[name]();}}});};Plugin.prototype.getSocialJson=function(name){var self=this,count=0,url=urlJson[name].replace("{url}",encodeURIComponent(this.options.url));if(this.options.buttons[name].urlCount===true&&this.options.buttons[name].url!==""){url=urlJson[name].replace("{url}",this.options.buttons[name].url);}if(url!=""&&self.options.urlCurl!==""){$.getJSON(url,function(json){if(typeof json.count!=="undefined"){var temp=json.count+"";temp=temp.replace("\u00c2\u00a0","");count+=parseInt(temp,10);}else{if(json.data&&json.data.length>0&&typeof json.data[0].total_count!=="undefined"){count+=parseInt(json.data[0].total_count,10);}else{if(typeof json[0]!=="undefined"){count+=parseInt(json[0].total_posts,10);}else{if(typeof json[0]!=="undefined"){}}}}self.options.count[name]=count;self.options.total+=count;self.renderer();self.rendererPerso();}).error(function(){self.options.count[name]=0;self.rendererPerso();});}else{self.renderer();self.options.count[name]=0;self.rendererPerso();}};Plugin.prototype.rendererPerso=function(){var shareCount=0;for(e in this.options.count){shareCount++;}if(shareCount===this.options.shareTotal){this.options.render(this,this.options);}};Plugin.prototype.renderer=function(){var total=this.options.total,template=this.options.template;if(this.options.shorterTotal===true){total=this.shorterTotal(total);}if(template!==""){template=template.replace("{total}",total);$(this.element).html(template);}else{$(this.element).html('<div class="box"><a class="count" href="#">'+total+"</a>"+(this.options.title!==""?'<a class="share" href="#">'+this.options.title+"</a>":"")+"</div>");}$(document).trigger("share-box-rendered");};Plugin.prototype.shorterTotal=function(num){if(num>=1000000){num=(num/1000000).toFixed(2)+"M";}else{if(num>=1000){num=(num/1000).toFixed(1)+"k";}}return num;};Plugin.prototype.openPopup=function(site){popup[site](this.options);if(this.options.enableTracking===true){var tracking={googlePlus:{site:"Google",action:"+1"},facebook:{site:"facebook",action:"like"},twitter:{site:"twitter",action:"tweet"},digg:{site:"digg",action:"add"},delicious:{site:"delicious",action:"add"},stumbleupon:{site:"stumbleupon",action:"add"},linkedin:{site:"linkedin",action:"share"},pinterest:{site:"pinterest",action:"pin"}};_gaq.push(["_trackSocial",tracking[site].site,tracking[site].action]);}};Plugin.prototype.simulateClick=function(){var html=$(this.element).html();$(this.element).html(html.replace(this.options.total,this.options.total+1));};Plugin.prototype.update=function(url,text){if(url!==""){this.options.url=url;}if(text!==""){this.options.text=text;}};$.fn[pluginName]=function(options){var args=arguments;if(options===undefined||typeof options==="object"){return this.each(function(){if(!$.data(this,"plugin_"+pluginName)){$.data(this,"plugin_"+pluginName,new Plugin(this,options));}});}else{if(typeof options==="string"&&options[0]!=="_"&&options!=="init"){return this.each(function(){var instance=$.data(this,"plugin_"+pluginName);if(instance instanceof Plugin&&typeof instance[options]==="function"){instance[options].apply(instance,Array.prototype.slice.call(args,1));}});}}};})(jQuery,window,document);





	/* --- $SMOOTH PAGE SCROLL --- */
	/*
	 * Performs a smooth page scroll to an anchor on the same page.
	 * http://css-tricks.com/snippets/jquery/smooth-scrolling/
	 */
	$(function() {
		$('a[href*=#]:not([href=#])').click(function(event) {
			//exclude some links from smooth scrolling like tabs
			if ($(this).parents('.tabs__nav').length) {
				//do nothing
			} else if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
				  $('html,body').animate({
					scrollTop: target.offset().top
				  }, 700);
				  event.preventDefault();
				}
			}
		});
	});

	/* ====== INTERNAL FUNCTIONS ====== */

	/* --- DETECT VIEWPORT SIZE --- */

	function browserSize(){
		wh = $(window).height();
		ww = $(window).width();
		dh = $(document).height();
		ar = ww/wh;
	};


	/* --- Set Query Parameter--- */
	function setQueryParameter(uri, key, value) {
	  var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
	  separator = uri.indexOf('?') !== -1 ? "&" : "?";
	  if (uri.match(re)) {
	    return uri.replace(re, '$1' + key + "=" + value + '$2');
	  }
	  else {
	    return uri + separator + key + "=" + value;
	  }
	}


	/* --- $VIDEOS --- */

	function resizeVideos() {
	
		var videos = $('iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="vimeo.com"], video');

		videos.each(function() {
			var video = $(this),
				ratio = video.data('aspectRatio'),
				w = video.css('width', '100%').width(),
				h = w/ratio;
			video.height(h);
		});
	}

	function initVideos() {

		var videos = $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"], video');

		// Figure out and save aspect ratio for each video
		videos.each(function() {
			$(this).data('aspectRatio', this.width / this.height)
				// and remove the hard coded width/height
				.removeAttr('height')
				.removeAttr('width');
		});

		resizeVideos();

		// Firefox Opacity Video Hack
		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function(){
			var url = $(this).attr("src");

			$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
		});
	}


	/* MAGNIFIC POPUP INIT */

	function magnificPopupInit(){

	  $('.js-post-gallery').each(function() { // the containers for all your galleries should have the class gallery
		  $(this).magnificPopup({
			  delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
			  type: 'image',
			  removalDelay: 500,
			  mainClass: 'mfp-fade',
			  image: {
				  titleSrc: function (item){
					  var output = '';
					  if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					  }
					  if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					  }
					  return output;
				  }
			  },
			  gallery:{
				  enabled:true,
				  navigateByImgClick: true
			  }
		  });
	  });      
	}

	/* RILOADR INIT */
	function riloadrInit() {
		// Lazy loading for images with '.lazy' class
		var riloadrImages = new Riloadr({
                    name : 'lazy',
                    breakpoints: [
                        {name: 'whatever' , minWidth: 1}
                    ],
                    defer: {
                        mode: 'load'
                    }
		});        

		// Responsive Featured Image for single post page
		var riloadrSingle = new Riloadr({
                    name : 'riloadr-single',
                    breakpoints: [
                        {name: 'small' , maxWidth: 400},
                        {name: 'big'   , minWidth: 401}
                    ],
                    watchViewportWidth: "*"
		});
	}

	/* --- $ROYALSLIDER --- */
	var $original_billboard_slider;

	/*
	* Slider Initialization
	*/
	function sliderInit($slider){

		  $slider.find('img').removeClass('invisible');		  

		  var $children = $(this).children(),
			  rs_arrows = typeof $slider.data('arrows') !== "undefined",
			  rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
			  rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
			  rs_autoScaleSlider = false,
			  rs_autoScaleSliderWidth = $slider.data('autoscalesliderwidth'),
			  rs_autoScaleSliderHeight = $slider.data('autoscalesliderheight'),
			  rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
			  rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
			  rs_keyboardNav  = typeof $slider.data('fullscreen') !== "undefined",
			  rs_imageScale  = $slider.data('imagescale'),
			  rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined" ? true : false,
			  rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
			  rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
			  rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined" ? true : false,
			  rs_delay = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? $slider.data('sliderdelay') : '1000',
			  rs_drag = true,
			  rs_globalCaption = typeof $slider.data('showcaptions') !== "undefined" ? true : false;

		  if(rs_autoheight) { rs_autoScaleSlider = false } else { rs_autoScaleSlider = true }

		  // Single slide case
		  if ($children.length == 1){
			  rs_arrows = false;
			  rs_bullets = 'none';
			  rs_customArrows = false;
			  rs_keyboardNav = false;
			  rs_drag = false;
			  rs_transition = 'fade';
		  }
		  
		  // make sure default arrows won't appear if customArrows is set
		  if (rs_customArrows) arrows = false;
		  
		  //the main params for Royal Slider
                    var royalSliderParams = {
                            autoHeight: rs_autoheight,
                            autoScaleSlider: rs_autoScaleSlider,
                            loop: true,
                            autoScaleSliderWidth: rs_autoScaleSliderWidth,
                            autoScaleSliderHeight: rs_autoScaleSliderHeight,
                            imageScaleMode: rs_imageScale,
                            imageAlignCenter: rs_imageAlignCenter,
                            slidesSpacing: rs_slidesSpacing,
                            arrowsNav: rs_arrows,
                            controlNavigation: rs_bullets,
                            keyboardNavEnabled: rs_keyboardNav,
                            arrowsNavAutoHide: false,
                            sliderDrag: rs_drag,
                            transitionType: rs_transition,
                            autoPlay: {
                                    enabled: rs_autoPlay,
                                    stopAtAction: true,
                                    pauseOnHover: true,
                                    delay: rs_delay                    
                            },
                            globalCaption:rs_globalCaption                       
                    };

                    if (rs_visibleNearby) {
                            royalSliderParams['visibleNearby'] = {
                                    enabled: true,
                                    //centerArea: 0.8,
                                    center: true,
                                    breakpoint: 0,
                                    //breakpointCenterArea: 0.64,
                                    navigateByCenterClick: false
                            }
                    }
			
                    //lets fire it up
                    $slider.royalSlider(royalSliderParams);
                    $slider.addClass('slider--loaded');

                    var royalSlider = $slider.data('royalSlider');
                    var slidesNumber = royalSlider.numSlides;

                    // move arrows outside rsOverflow
                    $slider.find('.rsArrow').appendTo($slider);

                    royalSlider.ev.on('rsVideoPlay', function() {
                            if(rs_imageScale == 'fill'){
                                    var $frameHolder = $('.rsVideoFrameHolder');
                                    var top = Math.abs(royalSlider.height - $frameHolder.closest('.rsVideoContainer').height())/2;

                                    $frameHolder.height(royalSlider.height);
                                    $frameHolder.css('margin-top', top+'px');

                            } else {
                                    var $frameHolder = $('.rsVideoFrameHolder');
                                    var $videoContainer = $('.rsVideoFrameHolder').closest('.rsVideoContainer');
                                    var top = parseInt($frameHolder.closest('.rsVideoContainer').css('margin-top'), 10);

                                    if(top < 0){
                                            top = Math.abs(top);
                                            $frameHolder
                                                    .height(royalSlider.height)
                                                    .css('top', top + 'px');                        
                                    }
                            }
                    });

                    $slider.addClass('slider--loaded');
	}



	/*
	* Wordpress Galleries to Sliders
	* Create the markup for the slider from the gallery shortcode
	* take all the images and insert them in the .gallery <div>
	*/
	function sliderMarkupGallery($gallery){
		  var $old_gallery = $gallery,
			  gallery_data = $gallery.data(),
			  $images = $old_gallery.find('img'),
			  $new_gallery = $('<div class="pixslider js-pixslider">');

		  $images.prependTo($new_gallery).addClass('rsImg');
		  $old_gallery.replaceWith($new_gallery);

		  $new_gallery.data(gallery_data);
	}


	/*
	* Change the Slider markup from (1 big / 2 small) to (3 big)
	* ORIGINAL to MOBILE 
	*/
	function sliderMarkupMobile($slider){
		var $parent = $slider;

		// Change markup to default
		$slider.replaceWith($original_billboard_slider);
		$slider = $('.billboard.js-pixslider');

		// Change parameters
		$slider.attr('data-autoheight', true);
		$slider.attr('data-imagescale', 'none');

		$slider.find('.billboard--article-group').each(function(){
			// var $slide = $(this),
			// $slide_thumb = $slide.find('.article--billboard-small img');

			// // For each slide thumb(because there are two)
			// // we set the new image source
			// $slide_thumb.each(function(){
			//     slide_thumb_big_src = $(this).attr('data-src-big');
			//     $(this).attr('src', slide_thumb_big_src);
			// });

			// Change thumbnail for small articles
			$(this).children('.article').removeClass('rsABlock');

			$(this).before($(this).html())
			 .remove();
		});

		// Mark as mobile
		$slider.addClass('js-pixslider-mobile');

		$slider.addClass('rsAutoHeight');

		sliderInit($slider);
	}



	/*
	* Change the Slider Markup from (3 big) to (1 big / 2 small)
	* MOBILE to ORIGINAL 
	*/
	function sliderMarkupOriginal($slider){

	  // Change markup
	  $slider.replaceWith($original_billboard_slider);
	  $slider = $('.billboard.js-pixslider');

	  // Change parameters
	  $slider.removeAttr('data-autoheight');
	  $slider.removeAttr('imagescale');

	  $slider.removeClass('js-pixslider-mobile');
	  $slider.removeClass('rsAutoHeight');

	  sliderInit($slider);
	}
	


	/*
	* Billboard Slider markup changes (on resize)
	*/
	function slider_billboard() {
		var window_size = $(window).width();

		$('.js-pixslider.billboard').each(function(){
		  $slider = $(this);
		  var slider_rs = $slider.data('royalSlider');

		  if((window_size < 900) && (!$slider.hasClass('js-pixslider-mobile'))) {
			  if(slider_rs) slider_rs.destroy();
			  sliderMarkupMobile($slider); 
		  } else if((window_size > 900) && ($slider.hasClass('js-pixslider-mobile'))) {
			  if(slider_rs) slider_rs.destroy();
			  sliderMarkupOriginal($slider);
		  }
		});

		// riloadrSlider.riload();
	}



	/*
	* First Slider Initialization
	*/

	function royalSliderInit() {
		// Transform Wordpress Galleries to Sliders
		$('.wp-gallery').each(function() { sliderMarkupGallery($(this)); });

		// Find and initialize each slider
		$('.js-pixslider').each(function(){
			if(!$(this).hasClass('billboard'))
				sliderInit($(this));
		});
	};

	var royalSliderBillboardInitiated = false;
	function royalSliderBillboardInit(){
		royalSliderBillboardInitiated = true;

		$('.js-pixslider.billboard').each(function(){
			// Cache The Original Billboard Slider HTML Markup
			$original_billboard_slider = $(this).outerHTML();
			slider_billboard($(this));

			var height = $(this).find('img').first().height();

			sliderInit($(this));


		});		
	}



	function footerWidgetsTitles() {
		$('.widget--footer__title .hN, .panel__title  .hN').each(function() {
			var $title = $(this),
				text = $title.text(),
				index = text.indexOf(" ");
			if (index != -1) {
				text = '<em>' + text.slice(0, index) + '</em>' + text.slice(text.indexOf(" "), text.length);
			} else {
				text = '<em>' + text + '</em>';
			}
			$title.html(text);
		});
	}



	function popularPostsWidget() {
		$('.wpgrade_popular_posts, .pixcode--tabs').organicTabs();
	}

	//scan through the post meta tags and try to find the post image
	function getArticleImage() { 
		var metas = document.getElementsByTagName('meta'); 

		for (i=0; i<metas.length; i++) { 
		   if (metas[i].getAttribute("property") == "og:image") { 
			  return metas[i].getAttribute("content"); 
		   } else if (metas[i].getAttribute("property") == "image") { 
			  return metas[i].getAttribute("content");  
		   } else if (metas[i].getAttribute("property") == "twitter:image:src") { 
			  return metas[i].getAttribute("content");  
		   }
		}

		return "";
	}

	// Calculate total shares
	var shareTypes = 0;

	function shareBox() {
		//get the via username for twitter share
		var twitterVia = $('#twitter').data('via');
		
		$('#twitter').sharrre({
			share: {
			  twitter: true
			},
			template: '<div class="share-item__icon"><i class="pixcode pixcode--icon icon-e-twitter  circle  small"></i></div><div class="share-item__value">{total}</div>',
			enableHover: false,
			enableTracking: false,
			shorterTotal: false,
			click: function(api, options){
				api.simulateClick();
				api.openPopup('twitter');
			},
			buttons: {
				twitter: {via: twitterVia}
			}
		}).each(function() { shareTypes++; });
		
		$('#facebook').sharrre({
		  share: {
			facebook: true
		  },
		  template: '<div class="share-item__icon"><i class="pixcode pixcode--icon icon-e-facebook  circle  small"></i></div><div class="share-item__value">{total}</div>',
		  enableHover: false,
		  enableTracking: false,
		  shorterTotal: false,
		  click: function(api, options){
			api.simulateClick();
			api.openPopup('facebook');
		  }
		}).each(function() { shareTypes++; });
		
		$('#gplus').sharrre({
			share: {
				googlePlus: true
			},
			template: '<div class="share-item__icon"><i class="pixcode pixcode--icon icon-e-gplus  circle  small"></i></div><div class="share-item__value">{total}</div>',
			enableHover: false,
			enableTracking: false,
			shorterTotal: false,
			click: function(api, options){
				api.simulateClick();
				api.openPopup('googlePlus');
			}
		}).each(function() { shareTypes++; });
		
		$('#pinterest').sharrre({
			share: {
				pinterest: true
			},
			template: '<div class="share-item__icon"><i class="pixcode pixcode--icon icon-e-pinterest  circle  small"></i></div><div class="share-item__value">{total}</div>',
			enableHover: false,
			enableTracking: false,
			shorterTotal: false,
			click: function(api, options){
				api.simulateClick();
				api.openPopup('pinterest');
			},
			buttons: {
				pinterest: {
					media: getArticleImage(),
					description: $('#pinterest').data('text')
				} 
			}
		}).each(function() { shareTypes++; });
	}

	// Calculate total shares rendered
	var renders = 0;

	$(document).on('share-box-rendered', function(){
		renders++;

		//if all have been rendered it's time to do the total
		if ( renders == shareTypes ) {
			var total_shares = 0;
			$('#share-box .share-item__value').each(function(i,e){

			  var value = parseInt($(this).text());
			  if ( !isNaN(value) ) {
				total_shares = total_shares + value;
			  }
			  $(this).text(wpgrade_shorterTotal(value));
			});
			$('.share-total__value').html(wpgrade_shorterTotal(total_shares));
		}
	});

	/* format total numbers like 1.2k or 5M
	 ================================================== */
	var wpgrade_shorterTotal = function (num) {
		if (num >= 1e6){
			num = (num / 1e6).toFixed(2) + "M"
		} else if (num >= 1e3){
			num = (num / 1e3).toFixed(1) + "k"
		}
		return num;
	};

	// Mega-Menu Hover with delay
	function megaMenusHover() {
	  $('.nav--main > li').hoverIntent({
		interval: 100,
		timeout: 300,
		over: showMegaMenu,
		out: hideMegaMenu,
	  })

	  function showMegaMenu() {
		var self = $(this);
		self.removeClass('hidden');
		setTimeout(function(){
		  self.addClass('open');
		}, 50);
	  }
	  function hideMegaMenu() {
		var self = $(this);
		self.removeClass('open');
		setTimeout(function(){
		  self.addClass('hidden');
		}, 150);
	  }
	}





	/* ====== INITIALIZE ====== */

	function init() {
		
		/* GLOBAL VARS */
		touch = false;
		
		/* GET BROWSER DIMENSIONS */
		browserSize();
		
		/* DETECT PLATFORM */
		platformDetect();

		/* Overthrow Polyfill */
		overthrow.set();

		FastClick.attach(document.body);

		if (is_android) {
			$('html').addClass('android-browser');
		} else {
			$('html').addClass('no-android-browser');
		}

		/* Retina Logo */
		var is_retina = (window.retina || window.devicePixelRatio > 1);

		if (is_retina && $('.site-logo--image-2x').length) {
			var image = $('.site-logo--image-2x').find('img');

			if (image.data('logo2x') !== undefined && image.data('logo2x').length) {
				image.attr('src', image.data('logo2x'));
			}
		}

		/* Mega Menu */
		megaMenusHover();

		/* ONE TIME EVENT HANDLERS */
		eventHandlersOnce();
		
		/* INSTANTIATE EVENT HANDLERS */
		eventHandlers();

		/* SHARE BOX BUTTONS (single only) */
		//if($('body.single').length) { setTimeout(function(){shareBox();},500); }
		if($('body.single').length) { shareBox(); }

		/* INSTANTIATE RILOADR (lazy loading and responsive images) */
		riloadrInit();
		   
	};





	/* ====== CONDITIONAL LOADING ====== */

	function loadUp(){

		initVideos();
		footerWidgetsTitles();
	
		//Set textareas to autosize
		if($("textarea").length) { $("textarea").autosize(); }

		// if blog archive
		if ($('.masonry').length && !lteie9 && !is_android)
			salvattore();
                    
		//lets test first of we have some riloadr images to work on
		if ($('.riloadr-slider').length > 0) {
			var riloadrSlider = new Riloadr({
				name : 'riloadr-slider',
				breakpoints: [
					{name: 'small' /*post-medium */ , minWidth: 901},
					{name: 'big'   /*post-medium */ , maxWidth: 900}
				],
				watchViewportWidth: "*",
				oncomplete: function(){
					if(royalSliderBillboardInitiated == false)
						royalSliderBillboardInit();
				}
			});
		} else {
			//we may as well initiate the billboard slider
			if(royalSliderBillboardInitiated == false)
					royalSliderBillboardInit();
		};

		royalSliderInit();
		magnificPopupInit();           
	}




	/* ====== EVENT HANDLERS ====== */

	function eventHandlersOnce() {

		/* NAVIGATION MOBILE */
		// if (touch || ($(window).width() < 900)) {
			var windowHeigth = $(window).height();

			$('.js-nav-trigger').bind('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				if($('html').hasClass('navigation--is-visible')){
					$('#page').css('height', '');
					$('html').removeClass('navigation--is-visible');
				  
				} else {
					$('#page').height(windowHeigth);
					$('html').addClass('navigation--is-visible');
				}
			});

			$('.wrapper').bind('click', function(e) {            
				if ($('html').hasClass('navigation--is-visible')) {
					
					e.preventDefault();
					e.stopPropagation();

					$('#page').css('height', '');
					$('html').removeClass('navigation--is-visible');
				}
			});
		// }


		// Mega Menu Slider Size
		$('.nav--main  .nav__item').on('hover', function() {
			$(this).parent().find('.js-pixslider').each(function() {
				var slider = $(this).data('royalSlider');
				slider.updateSliderSize();
			});
		});

	};

	function eventHandlers(){};




	/* ====== ON DOCUMENT READY ====== */

	$(function(){

		/* --- INITIALIZE --- */
		init();

		/* --- CONDITIONAL LOADING --- */
		loadUp();

		setTimeout(function(){
		  $('html').addClass('document-ready');
		}, 300);
	});



	/* ====== ON WINDOW LOAD ====== */

	$(window).load(function(){
		popularPostsWidget();
	});




	/* ====== ON RESIZE ====== */

	$(window).on("debouncedresize", function(e){
		resizeVideos();
		slider_billboard();   
	});



	/* ====== ON SCROLL ======  */

	//$(window).scroll(function(e){});

})(jQuery, window);