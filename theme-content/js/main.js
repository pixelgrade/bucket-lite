(function($,window,undefined) {



/* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;

var ua = navigator.userAgent.toLowerCase();
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);
var is_safari_win = ua.indexOf("safari/") !== -1 && ua.indexOf("windows") !== -1;

var nua = navigator.userAgent;
var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

var useTransform = true;
var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
// 
// To be used like this
// 
// if (!use2DTransform) {
//     transformParam = 'translate3d(...)';
// } else {
//     transformParam = 'translateY(...)';
// }
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





/* ==== RESPOND JS ==== */

/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas. Dual MIT/BSD license */
/*! NOTE: If you're already including a window.matchMedia polyfill via Modernizr or otherwise, you don't need this part */
window.matchMedia=window.matchMedia||function(a){"use strict";var c,d=a.documentElement,e=d.firstElementChild||d.firstChild,f=a.createElement("body"),g=a.createElement("div");return g.id="mq-test-1",g.style.cssText="position:absolute;top:-100em",f.style.background="none",f.appendChild(g),function(a){return g.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',d.insertBefore(f,e),c=42===g.offsetWidth,d.removeChild(f),{matches:c,media:a}}}(document);

/*! Respond.js v1.3.0: min/max-width media query polyfill. (c) Scott Jehl. MIT/GPLv2 Lic. j.mp/respondjs  */
(function(a){"use strict";function x(){u(!0)}var b={};if(a.respond=b,b.update=function(){},b.mediaQueriesSupported=a.matchMedia&&a.matchMedia("only all").matches,!b.mediaQueriesSupported){var q,r,t,c=a.document,d=c.documentElement,e=[],f=[],g=[],h={},i=30,j=c.getElementsByTagName("head")[0]||d,k=c.getElementsByTagName("base")[0],l=j.getElementsByTagName("link"),m=[],n=function(){for(var b=0;l.length>b;b++){var c=l[b],d=c.href,e=c.media,f=c.rel&&"stylesheet"===c.rel.toLowerCase();d&&f&&!h[d]&&(c.styleSheet&&c.styleSheet.rawCssText?(p(c.styleSheet.rawCssText,d,e),h[d]=!0):(!/^([a-zA-Z:]*\/\/)/.test(d)&&!k||d.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&m.push({href:d,media:e}))}o()},o=function(){if(m.length){var b=m.shift();v(b.href,function(c){p(c,b.href,b.media),h[b.href]=!0,a.setTimeout(function(){o()},0)})}},p=function(a,b,c){var d=a.match(/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi),g=d&&d.length||0;b=b.substring(0,b.lastIndexOf("/"));var h=function(a){return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,"$1"+b+"$2$3")},i=!g&&c;b.length&&(b+="/"),i&&(g=1);for(var j=0;g>j;j++){var k,l,m,n;i?(k=c,f.push(h(a))):(k=d[j].match(/@media *([^\{]+)\{([\S\s]+?)$/)&&RegExp.$1,f.push(RegExp.$2&&h(RegExp.$2))),m=k.split(","),n=m.length;for(var o=0;n>o;o++)l=m[o],e.push({media:l.split("(")[0].match(/(only\s+)?([a-zA-Z]+)\s?/)&&RegExp.$2||"all",rules:f.length-1,hasquery:l.indexOf("(")>-1,minw:l.match(/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:l.match(/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}u()},s=function(){var a,b=c.createElement("div"),e=c.body,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",e||(e=f=c.createElement("body"),e.style.background="none"),e.appendChild(b),d.insertBefore(e,d.firstChild),a=b.offsetWidth,f?d.removeChild(e):e.removeChild(b),a=t=parseFloat(a)},u=function(b){var h="clientWidth",k=d[h],m="CSS1Compat"===c.compatMode&&k||c.body[h]||k,n={},o=l[l.length-1],p=(new Date).getTime();if(b&&q&&i>p-q)return a.clearTimeout(r),r=a.setTimeout(u,i),void 0;q=p;for(var v in e)if(e.hasOwnProperty(v)){var w=e[v],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?t||s():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?t||s():1)),w.hasquery&&(z&&A||!(z||m>=x)||!(A||y>=m))||(n[w.media]||(n[w.media]=[]),n[w.media].push(f[w.rules]))}for(var C in g)g.hasOwnProperty(C)&&g[C]&&g[C].parentNode===j&&j.removeChild(g[C]);for(var D in n)if(n.hasOwnProperty(D)){var E=c.createElement("style"),F=n[D].join("\n");E.type="text/css",E.media=D,j.insertBefore(E,o.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(c.createTextNode(F)),g.push(E)}},v=function(a,b){var c=w();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))},w=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}();n(),b.update=n,a.addEventListener?a.addEventListener("resize",x,!1):a.attachEvent&&a.attachEvent("onresize",x)}})(this);





/* ====== PLUGINS & EXTENSIONS ====== */


/* --- $MODERNIZR --- */

/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-cssanimations-csstransforms-csstransforms3d-csstransitions-touch-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:w(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},q.cssanimations=function(){return F("animationName")},q.csstransforms=function(){return!!F("transform")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&w("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},q.csstransitions=function(){return F("transition")};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};





/* --- $HOVERINTENT ---*/

(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery)





/* --- $HOVERDIR --- */
$.HoverDir = function( options, element ) {
    this.$el = $( element );
    this._init( options );
};

$.HoverDir.defaults = {
    speed : 300,
    easing : 'ease',
    hoverDelay : 0,
    inverse : false
};

$.HoverDir.prototype = {

    _init : function( options ) {

        // options
        this.options = $.extend( true, {}, $.HoverDir.defaults, options );
        // transition properties
        this.transitionProp = 'all ' + this.options.speed + 'ms ' + this.options.easing;
        // support for CSS transitions
        this.support = Modernizr.csstransitions;
        // load the events
        this._loadEvents();

    },
    _loadEvents : function() {

        var self = this;

        this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {

            var $el = $( this ),
                $hoverElem = $el.find( 'div' ),
                direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
                styleCSS = self._getStyle( direction );

            if( event.type === 'mouseenter' ) {

                $hoverElem.hide().css( styleCSS.from );
                clearTimeout( self.tmhover );

                self.tmhover = setTimeout( function() {
                    $hoverElem.show( 0, function() {
                        var $el = $( this );
                        if( self.support ) {
                            $el.css( 'transition', self.transitionProp );
                        }
                        self._applyAnimation( $el, styleCSS.to, self.options.speed );
                    } );


                }, self.options.hoverDelay );

            }
            else {

                if( self.support ) {
                    $hoverElem.css( 'transition', self.transitionProp );
                }
                clearTimeout( self.tmhover );
                self._applyAnimation( $hoverElem, styleCSS.from, self.options.speed );
            }
        } );
    },
    // credits : http://stackoverflow.com/a/3647634
    _getDir : function( $el, coordinates ) {

        // the width and height of the current div
        var w = $el.width(),
            h = $el.height(),

            // calculate the x and y to get an angle to the center of the div from that x and y.
            // gets the x value relative to the center of the DIV and "normalize" it
            x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
            y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),

            // the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
            // first calculate the angle of the point,
            // add 180 deg to get rid of the negative values
            // divide by 90 to get the quadrant
            // add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
            direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
        return direction;
    },
    _getStyle : function( direction ) {

        var fromStyle, toStyle,
            slideFromTop = {transform: "translate3d(0,-50%, 0)"},
            slideFromBottom = {transform: "translate3d(0, 50%, 0)"},
            slideFromLeft = {transform: "translate3d(-20%, 0, 0)"},
            slideFromRight = {transform: "translate3d(20%, 0, 0)"},
            slideTop = {transform: "none"},
            slideLeft = {transform: "none"};

        switch( direction ) {
            case 0:
                // from top
                fromStyle = !this.options.inverse ? slideFromTop : slideFromBottom;
                toStyle = slideTop;
                break;
            case 1:
                // from right
                fromStyle = !this.options.inverse ? slideFromRight : slideFromLeft;
                toStyle = slideLeft;
                break;
            case 2:
                // from bottom
                fromStyle = !this.options.inverse ? slideFromBottom : slideFromTop;
                toStyle = slideTop;
                break;
            case 3:
                // from left
                fromStyle = !this.options.inverse ? slideFromLeft : slideFromRight;
                toStyle = slideLeft;
                break;
        };
        return { from : fromStyle, to : toStyle };
    },
    // apply a transition or fallback to jquery animate based on ModernizrModernizr.csstransitions support
    _applyAnimation : function( el, styleCSS, speed ) {
        $.fn.applyStyle = this.support ? $.fn.css : $.fn.animate;
        el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms' } ) );
    },
};

var logError = function( message ) {

    if ( window.console ) {
        window.console.error( message );
    }
};

$.fn.hoverdir = function( options ) {

    var instance = $.data( this, 'hoverdir' );

    if ( typeof options === 'string' ) {

        var args = Array.prototype.slice.call( arguments, 1 );

        this.each(function() {

            if ( !instance ) {
                logError( "cannot call methods on hoverdir prior to initialization; " +
                "attempted to call method '" + options + "'" );
                return;
            }

            if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
                logError( "no such method '" + options + "' for hoverdir instance" );
                return;
            }
            instance[ options ].apply( instance, args );
        });
    } else {
        this.each(function() {
            if ( instance ) {
                instance._init();
            } else {
                instance = $.data( this, 'hoverdir', new $.HoverDir( options, this ) );
            }
        });
    }
    return instance;
};





/* --- $EASING --- */

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright В© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/
// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) {
        //alert(jQuery.easing.default);
        return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
    },
    easeInQuad: function (x, t, b, c, d) {
        return c*(t/=d)*t + b;
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c *(t/=d)*(t-2) + b;
    },
    easeInOutQuad: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t + b;
        return -c/2 * ((--t)*(t-2) - 1) + b;
    },
    easeInCubic: function (x, t, b, c, d) {
        return c*(t/=d)*t*t + b;
    },
    easeOutCubic: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t + 1) + b;
    },
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    },
    easeInQuart: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t + b;
    },
    easeOutQuart: function (x, t, b, c, d) {
        return -c * ((t=t/d-1)*t*t*t - 1) + b;
    },
    easeInOutQuart: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
        return -c/2 * ((t-=2)*t*t*t - 2) + b;
    },
    easeInQuint: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t*t + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t*t*t + 1) + b;
    },
    easeInOutQuint: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
        return c/2*((t-=2)*t*t*t*t + 2) + b;
    },
    easeInSine: function (x, t, b, c, d) {
        return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
    },
    easeOutSine: function (x, t, b, c, d) {
        return c * Math.sin(t/d * (Math.PI/2)) + b;
    },
    easeInOutSine: function (x, t, b, c, d) {
        return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
    },
    easeInExpo: function (x, t, b, c, d) {
        return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
    },
    easeOutExpo: function (x, t, b, c, d) {
        return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
    },
    easeInOutExpo: function (x, t, b, c, d) {
        if (t==0) return b;
        if (t==d) return b+c;
        if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
        return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
    },
    easeInCirc: function (x, t, b, c, d) {
        return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
    },
    easeOutCirc: function (x, t, b, c, d) {
        return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
    },
    easeInOutCirc: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
        return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
    },
    easeInElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    },
    easeOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    },
    easeInOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
        return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
    },
    easeInBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*(t/=d)*t*((s+1)*t - s) + b;
    },
    easeOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    },
    easeInOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158; 
        if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
        return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    },
    easeInBounce: function (x, t, b, c, d) {
        return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
    },
    easeOutBounce: function (x, t, b, c, d) {
        if ((t/=d) < (1/2.75)) {
            return c*(7.5625*t*t) + b;
        } else if (t < (2/2.75)) {
            return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
        } else if (t < (2.5/2.75)) {
            return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
        } else {
            return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
        }
    },
    easeInOutBounce: function (x, t, b, c, d) {
        if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
        return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
    }
});





/* --- $NICESCROLL --- */

(function(e){function a(){var e=document.getElementsByTagName("script");var t=e[e.length-1].src.split("?")[0];return t.split("/").length>0?t.split("/").slice(0,-1).join("/")+"/":""}function T(e,t,n){for(var r=0;r<t.length;r++)n(e,t[r])}var t=false;var n=false;var r=false;var i=5e3;var s=2e3;var o=0;var u=e;var f=a();var l=["ms","moz","webkit","o"];var c=window.requestAnimationFrame||false;var h=window.cancelAnimationFrame||false;if(!c){for(var p in l){var d=l[p];if(!c)c=window[d+"RequestAnimationFrame"];if(!h)h=window[d+"CancelAnimationFrame"]||window[d+"CancelRequestAnimationFrame"]}}var v=window.MutationObserver||window.WebKitMutationObserver||false;var m={zindex:"auto",cursoropacitymin:0,cursoropacitymax:1,cursorcolor:"#424242",cursorwidth:"5px",cursorborder:"1px solid #fff",cursorborderradius:"5px",scrollspeed:60,mousescrollstep:8*3,touchbehavior:false,hwacceleration:true,usetransition:true,boxzoom:false,dblclickzoom:true,gesturezoom:true,grabcursorenabled:true,autohidemode:true,background:"",iframeautoresize:true,cursorminheight:32,preservenativescrolling:true,railoffset:false,bouncescroll:true,spacebarenabled:true,railpadding:{top:0,right:0,left:0,bottom:0},disableoutline:true,horizrailenabled:true,railalign:"right",railvalign:"bottom",enabletranslate3d:true,enablemousewheel:true,enablekeyboard:true,smoothscroll:true,sensitiverail:true,enablemouselockapi:true,cursorfixedheight:false,directionlockdeadzone:6,hidecursordelay:400,nativeparentscrolling:true,enablescrollonselection:true,overflowx:true,overflowy:true,cursordragspeed:.3,rtlmode:false,cursordragontouch:false,oneaxismousemode:"auto"};var g=false;var y=function(){function o(){var n=["-moz-grab","-webkit-grab","grab"];if(t.ischrome&&!t.ischrome22||t.isie)n=[];for(var r=0;r<n.length;r++){var i=n[r];e.style["cursor"]=i;if(e.style["cursor"]==i)return i}return"url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur),n-resize"}if(g)return g;var e=document.createElement("DIV");var t={};t.haspointerlock="pointerLockElement"in document||"mozPointerLockElement"in document||"webkitPointerLockElement"in document;t.isopera="opera"in window;t.isopera12=t.isopera&&"getUserMedia"in navigator;t.isoperamini=Object.prototype.toString.call(window.operamini)==="[object OperaMini]";t.isie="all"in document&&"attachEvent"in e&&!t.isopera;t.isieold=t.isie&&!("msInterpolationMode"in e.style);t.isie7=t.isie&&!t.isieold&&(!("documentMode"in document)||document.documentMode==7);t.isie8=t.isie&&"documentMode"in document&&document.documentMode==8;t.isie9=t.isie&&"performance"in window&&document.documentMode>=9;t.isie10=t.isie&&"performance"in window&&document.documentMode>=10;t.isie9mobile=/iemobile.9/i.test(navigator.userAgent);if(t.isie9mobile)t.isie9=false;t.isie7mobile=!t.isie9mobile&&t.isie7&&/iemobile/i.test(navigator.userAgent);t.ismozilla="MozAppearance"in e.style;t.iswebkit="WebkitAppearance"in e.style;t.ischrome="chrome"in window;t.ischrome22=t.ischrome&&t.haspointerlock;t.ischrome26=t.ischrome&&"transition"in e.style;t.cantouch="ontouchstart"in document.documentElement||"ontouchstart"in window;t.hasmstouch=window.navigator.msPointerEnabled||false;t.ismac=/^mac$/i.test(navigator.platform);t.isios=t.cantouch&&/iphone|ipad|ipod/i.test(navigator.platform);t.isios4=t.isios&&!("seal"in Object);t.isandroid=/android/i.test(navigator.userAgent);t.trstyle=false;t.hastransform=false;t.hastranslate3d=false;t.transitionstyle=false;t.hastransition=false;t.transitionend=false;var n=["transform","msTransform","webkitTransform","MozTransform","OTransform"];for(var r=0;r<n.length;r++){if(typeof e.style[n[r]]!="undefined"){t.trstyle=n[r];break}}t.hastransform=t.trstyle!=false;if(t.hastransform){e.style[t.trstyle]="translate3d(1px,2px,3px)";t.hastranslate3d=/translate3d/.test(e.style[t.trstyle])}t.transitionstyle=false;t.prefixstyle="";t.transitionend=false;var n=["transition","webkitTransition","MozTransition","OTransition","OTransition","msTransition","KhtmlTransition"];var i=["","-webkit-","-moz-","-o-","-o","-ms-","-khtml-"];var s=["transitionend","webkitTransitionEnd","transitionend","otransitionend","oTransitionEnd","msTransitionEnd","KhtmlTransitionEnd"];for(var r=0;r<n.length;r++){if(n[r]in e.style){t.transitionstyle=n[r];t.prefixstyle=i[r];t.transitionend=s[r];break}}if(t.ischrome26){t.prefixstyle=i[1]}t.hastransition=t.transitionstyle;t.cursorgrabvalue=o();t.hasmousecapture="setCapture"in e;t.hasMutationObserver=v!==false;e=null;g=t;return t};var b=function(e,r){function b(){var e=a.win;if("zIndex"in e)return e.zIndex();while(e.length>0){if(e[0].nodeType==9)return false;var t=e.css("zIndex");if(!isNaN(t)&&t!=0)return parseInt(t);e=e.parent()}return false}function S(e,t,n){var r=e.css(t);var i=parseFloat(r);if(isNaN(i)){i=E[r]||0;var s=i==3?n?a.win.outerHeight()-a.win.innerHeight():a.win.outerWidth()-a.win.innerWidth():1;if(a.isie8&&i)i+=1;return s?i:0}return i}function x(e,t,n,r){a._bind(e,t,function(r){var r=r?r:window.event;var i={original:r,target:r.target||r.srcElement,type:"wheel",deltaMode:r.type=="MozMousePixelScroll"?0:1,deltaX:0,deltaZ:0,preventDefault:function(){r.preventDefault?r.preventDefault():r.returnValue=false;return false},stopImmediatePropagation:function(){r.stopImmediatePropagation?r.stopImmediatePropagation():r.cancelBubble=true}};if(t=="mousewheel"){i.deltaY=-1/40*r.wheelDelta;r.wheelDeltaX&&(i.deltaX=-1/40*r.wheelDeltaX)}else{i.deltaY=r.detail}return n.call(e,i)},r)}function T(e,t,n){var r,i;var s=1;if(e.deltaMode==0){r=-Math.floor(e.deltaX*(a.opt.mousescrollstep/(18*3)));i=-Math.floor(e.deltaY*(a.opt.mousescrollstep/(18*3)))}else if(e.deltaMode==1){r=-Math.floor(e.deltaX*a.opt.mousescrollstep);i=-Math.floor(e.deltaY*a.opt.mousescrollstep)}if(t&&a.opt.oneaxismousemode&&r==0&&i){r=i;i=0}if(r){if(a.scrollmom){a.scrollmom.stop()}a.lastdeltax+=r;a.debounced("mousewheelx",function(){var e=a.lastdeltax;a.lastdeltax=0;if(!a.rail.drag){a.doScrollLeftBy(e)}},120)}if(i){if(a.opt.nativeparentscrolling&&n&&!a.ispage&&!a.zoomactive){if(i<0){if(a.getScrollTop()>=a.page.maxh)return true}else{if(a.getScrollTop()<=0)return true}}if(a.scrollmom){a.scrollmom.stop()}a.lastdeltay+=i;a.debounced("mousewheely",function(){var e=a.lastdeltay;a.lastdeltay=0;if(!a.rail.drag){a.doScrollBy(e)}},120)}e.stopImmediatePropagation();return e.preventDefault()}var a=this;this.version="3.5.1 BETA1";this.name="nicescroll";this.me=r;this.opt={doc:u("body"),win:false};u.extend(this.opt,m);this.opt.snapbackspeed=80;if(e||false){for(var l in a.opt){if(typeof e[l]!="undefined")a.opt[l]=e[l]}}this.doc=a.opt.doc;this.iddoc=this.doc&&this.doc[0]?this.doc[0].id||"":"";this.ispage=/BODY|HTML/.test(a.opt.win?a.opt.win[0].nodeName:this.doc[0].nodeName);this.haswrapper=a.opt.win!==false;this.win=a.opt.win||(this.ispage?u(window):this.doc);this.docscroll=this.ispage&&!this.haswrapper?u(window):this.win;this.body=u("body");this.viewport=false;this.isfixed=false;this.iframe=false;this.isiframe=this.doc[0].nodeName=="IFRAME"&&this.win[0].nodeName=="IFRAME";this.istextarea=this.win[0].nodeName=="TEXTAREA";this.forcescreen=false;this.canshowonmouseevent=a.opt.autohidemode!="scroll";this.onmousedown=false;this.onmouseup=false;this.onmousemove=false;this.onmousewheel=false;this.onkeypress=false;this.ongesturezoom=false;this.onclick=false;this.onscrollstart=false;this.onscrollend=false;this.onscrollcancel=false;this.onzoomin=false;this.onzoomout=false;this.view=false;this.page=false;this.scroll={x:0,y:0};this.scrollratio={x:0,y:0};this.cursorheight=20;this.scrollvaluemax=0;this.checkrtlmode=false;this.scrollrunning=false;this.scrollmom=false;this.observer=false;this.observerremover=false;do{this.id="ascrail"+s++}while(document.getElementById(this.id));this.rail=false;this.cursor=false;this.cursorfreezed=false;this.selectiondrag=false;this.zoom=false;this.zoomactive=false;this.hasfocus=false;this.hasmousefocus=false;this.visibility=true;this.locked=false;this.hidden=false;this.cursoractive=true;this.overflowx=a.opt.overflowx;this.overflowy=a.opt.overflowy;this.nativescrollingarea=false;this.checkarea=0;this.events=[];this.saved={};this.delaylist={};this.synclist={};this.lastdeltax=0;this.lastdeltay=0;this.detected=y();var p=u.extend({},this.detected);this.canhwscroll=p.hastransform&&a.opt.hwacceleration;this.ishwscroll=this.canhwscroll&&a.haswrapper;this.istouchcapable=false;if(p.cantouch&&p.ischrome&&!p.isios&&!p.isandroid){this.istouchcapable=true;p.cantouch=false}if(p.cantouch&&p.ismozilla&&!p.isios&&!p.isandroid){this.istouchcapable=true;p.cantouch=false}if(!a.opt.enablemouselockapi){p.hasmousecapture=false;p.haspointerlock=false}this.delayed=function(e,t,n,r){var i=a.delaylist[e];var s=(new Date).getTime();if(!r&&i&&i.tt)return false;if(i&&i.tt)clearTimeout(i.tt);if(i&&i.last+n>s&&!i.tt){a.delaylist[e]={last:s+n,tt:setTimeout(function(){a.delaylist[e].tt=0;t.call()},n)}}else if(!i||!i.tt){a.delaylist[e]={last:s,tt:0};setTimeout(function(){t.call()},0)}};this.debounced=function(e,t,n){var r=a.delaylist[e];var i=(new Date).getTime();a.delaylist[e]=t;if(!r){setTimeout(function(){var t=a.delaylist[e];a.delaylist[e]=false;t.call()},n)}};var d=false;this.synched=function(e,t){function n(){if(d)return;c(function(){d=false;for(e in a.synclist){var t=a.synclist[e];if(t)t.call(a);a.synclist[e]=false}});d=true}a.synclist[e]=t;n();return e};this.unsynched=function(e){if(a.synclist[e])a.synclist[e]=false};this.css=function(e,t){for(var n in t){a.saved.css.push([e,n,e.css(n)]);e.css(n,t[n])}};this.scrollTop=function(e){return typeof e=="undefined"?a.getScrollTop():a.setScrollTop(e)};this.scrollLeft=function(e){return typeof e=="undefined"?a.getScrollLeft():a.setScrollLeft(e)};BezierClass=function(e,t,n,r,i,s,o){this.st=e;this.ed=t;this.spd=n;this.p1=r||0;this.p2=i||1;this.p3=s||0;this.p4=o||1;this.ts=(new Date).getTime();this.df=this.ed-this.st};BezierClass.prototype={B2:function(e){return 3*e*e*(1-e)},B3:function(e){return 3*e*(1-e)*(1-e)},B4:function(e){return(1-e)*(1-e)*(1-e)},getNow:function(){var e=(new Date).getTime();var t=1-(e-this.ts)/this.spd;var n=this.B2(t)+this.B3(t)+this.B4(t);return t<0?this.ed:this.st+Math.round(this.df*n)},update:function(e,t){this.st=this.getNow();this.ed=e;this.spd=t;this.ts=(new Date).getTime();this.df=this.ed-this.st;return this}};if(this.ishwscroll){this.doc.translate={x:0,y:0,tx:"0px",ty:"0px"};if(p.hastranslate3d&&p.isios)this.doc.css("-webkit-backface-visibility","hidden");function g(){var e=a.doc.css(p.trstyle);if(e&&e.substr(0,6)=="matrix"){return e.replace(/^.*\((.*)\)$/g,"$1").replace(/px/g,"").split(/, +/)}return false}this.getScrollTop=function(e){if(!e){var t=g();if(t)return t.length==16?-t[13]:-t[5];if(a.timerscroll&&a.timerscroll.bz)return a.timerscroll.bz.getNow()}return a.doc.translate.y};this.getScrollLeft=function(e){if(!e){var t=g();if(t)return t.length==16?-t[12]:-t[4];if(a.timerscroll&&a.timerscroll.bh)return a.timerscroll.bh.getNow()}return a.doc.translate.x};if(document.createEvent){this.notifyScrollEvent=function(e){var t=document.createEvent("UIEvents");t.initUIEvent("scroll",false,true,window,1);e.dispatchEvent(t)}}else if(document.fireEvent){this.notifyScrollEvent=function(e){var t=document.createEventObject();e.fireEvent("onscroll");t.cancelBubble=true}}else{this.notifyScrollEvent=function(e,t){}}if(p.hastranslate3d&&a.opt.enabletranslate3d){this.setScrollTop=function(e,t){a.doc.translate.y=e;a.doc.translate.ty=e*-1+"px";a.doc.css(p.trstyle,"translate3d("+a.doc.translate.tx+","+a.doc.translate.ty+",0px)");if(!t)a.notifyScrollEvent(a.win[0])};this.setScrollLeft=function(e,t){a.doc.translate.x=e;a.doc.translate.tx=e*-1+"px";a.doc.css(p.trstyle,"translate3d("+a.doc.translate.tx+","+a.doc.translate.ty+",0px)");if(!t)a.notifyScrollEvent(a.win[0])}}else{this.setScrollTop=function(e,t){a.doc.translate.y=e;a.doc.translate.ty=e*-1+"px";a.doc.css(p.trstyle,"translate("+a.doc.translate.tx+","+a.doc.translate.ty+")");if(!t)a.notifyScrollEvent(a.win[0])};this.setScrollLeft=function(e,t){a.doc.translate.x=e;a.doc.translate.tx=e*-1+"px";a.doc.css(p.trstyle,"translate("+a.doc.translate.tx+","+a.doc.translate.ty+")");if(!t)a.notifyScrollEvent(a.win[0])}}}else{this.getScrollTop=function(){return a.docscroll.scrollTop()};this.setScrollTop=function(e){return a.docscroll.scrollTop(e)};this.getScrollLeft=function(){return a.docscroll.scrollLeft()};this.setScrollLeft=function(e){return a.docscroll.scrollLeft(e)}}this.getTarget=function(e){if(!e)return false;if(e.target)return e.target;if(e.srcElement)return e.srcElement;return false};this.hasParent=function(e,t){if(!e)return false;var n=e.target||e.srcElement||e||false;while(n&&n.id!=t){n=n.parentNode||false}return n!==false};var E={thin:1,medium:3,thick:5};this.getOffset=function(){if(a.isfixed)return{top:parseFloat(a.win.css("top")),left:parseFloat(a.win.css("left"))};if(!a.viewport)return a.win.offset();var e=a.win.offset();var t=a.viewport.offset();return{top:e.top-t.top+a.viewport.scrollTop(),left:e.left-t.left+a.viewport.scrollLeft()}};this.updateScrollBar=function(e){if(a.ishwscroll){a.rail.css({height:a.win.innerHeight()});if(a.railh)a.railh.css({width:a.win.innerWidth()})}else{var t=a.getOffset();var n={top:t.top,left:t.left};n.top+=S(a.win,"border-top-width",true);var r=(a.win.outerWidth()-a.win.innerWidth())/2;n.left+=a.rail.align?a.win.outerWidth()-S(a.win,"border-right-width")-a.rail.width:S(a.win,"border-left-width");var i=a.opt.railoffset;if(i){if(i.top)n.top+=i.top;if(a.rail.align&&i.left)n.left+=i.left}if(!a.locked)a.rail.css({top:n.top,left:n.left,height:e?e.h:a.win.innerHeight()});if(a.zoom){a.zoom.css({top:n.top+1,left:a.rail.align==1?n.left-20:n.left+a.rail.width+4})}if(a.railh&&!a.locked){var n={top:t.top,left:t.left};var s=a.railh.align?n.top+S(a.win,"border-top-width",true)+a.win.innerHeight()-a.railh.height:n.top+S(a.win,"border-top-width",true);var o=n.left+S(a.win,"border-left-width");a.railh.css({top:s,left:o,width:a.railh.width})}}};this.doRailClick=function(e,t,n){var r,i,s,o;if(a.locked)return;a.cancelEvent(e);if(t){r=n?a.doScrollLeft:a.doScrollTop;s=n?(e.pageX-a.railh.offset().left-a.cursorwidth/2)*a.scrollratio.x:(e.pageY-a.rail.offset().top-a.cursorheight/2)*a.scrollratio.y;r(s)}else{r=n?a.doScrollLeftBy:a.doScrollBy;s=n?a.scroll.x:a.scroll.y;o=n?e.pageX-a.railh.offset().left:e.pageY-a.rail.offset().top;i=n?a.view.w:a.view.h;s>=o?r(i):r(-i)}};a.hasanimationframe=c;a.hascancelanimationframe=h;if(!a.hasanimationframe){c=function(e){return setTimeout(e,15-Math.floor(+(new Date)/1e3)%16)};h=clearInterval}else if(!a.hascancelanimationframe)h=function(){a.cancelAnimationFrame=true};this.init=function(){a.saved.css=[];if(p.isie7mobile)return true;if(p.isoperamini)return true;if(p.hasmstouch)a.css(a.ispage?u("html"):a.win,{"-ms-touch-action":"none"});a.zindex="auto";if(!a.ispage&&a.opt.zindex=="auto"){a.zindex=b()||"auto"}else{a.zindex=a.opt.zindex}if(!a.ispage&&a.zindex!="auto"){if(a.zindex>o)o=a.zindex}if(a.isie&&a.zindex==0&&a.opt.zindex=="auto"){a.zindex="auto"}if(!a.ispage||!p.cantouch&&!p.isieold&&!p.isie9mobile){var e=a.docscroll;if(a.ispage)e=a.haswrapper?a.win:a.doc;if(!p.isie9mobile)a.css(e,{"overflow-y":"hidden"});if(a.ispage&&p.isie7){if(a.doc[0].nodeName=="BODY")a.css(u("html"),{"overflow-y":"hidden"});else if(a.doc[0].nodeName=="HTML")a.css(u("body"),{"overflow-y":"hidden"})}if(p.isios&&!a.ispage&&!a.haswrapper)a.css(u("body"),{"-webkit-overflow-scrolling":"touch"});var r=u(document.createElement("div"));r.css({position:"relative",top:0,"float":"right",width:a.opt.cursorwidth,height:"0px","background-color":a.opt.cursorcolor,border:a.opt.cursorborder,"background-clip":"padding-box","-webkit-border-radius":a.opt.cursorborderradius,"-moz-border-radius":a.opt.cursorborderradius,"border-radius":a.opt.cursorborderradius});r.hborder=parseFloat(r.outerHeight()-r.innerHeight());a.cursor=r;var s=u(document.createElement("div"));s.attr("id",a.id);s.addClass("nicescroll-rails");var l,c,h=["left","right"];for(var d in h){c=h[d];l=a.opt.railpadding[c];l?s.css("padding-"+c,l+"px"):a.opt.railpadding[c]=0}s.append(r);s.width=Math.max(parseFloat(a.opt.cursorwidth),r.outerWidth())+a.opt.railpadding["left"]+a.opt.railpadding["right"];s.css({width:s.width+"px",zIndex:a.zindex,background:a.opt.background,cursor:"default"});s.visibility=true;s.scrollable=true;s.align=a.opt.railalign=="left"?0:1;a.rail=s;a.rail.drag=false;var m=false;if(a.opt.boxzoom&&!a.ispage&&!p.isieold){m=document.createElement("div");a.bind(m,"click",a.doZoom);a.zoom=u(m);a.zoom.css({cursor:"pointer","z-index":a.zindex,backgroundImage:"url("+f+"zoomico.png)",height:18,width:18,backgroundPosition:"0px 0px"});if(a.opt.dblclickzoom)a.bind(a.win,"dblclick",a.doZoom);if(p.cantouch&&a.opt.gesturezoom){a.ongesturezoom=function(e){if(e.scale>1.5)a.doZoomIn(e);if(e.scale<.8)a.doZoomOut(e);return a.cancelEvent(e)};a.bind(a.win,"gestureend",a.ongesturezoom)}}a.railh=false;if(a.opt.horizrailenabled){a.css(e,{"overflow-x":"hidden"});var r=u(document.createElement("div"));r.css({position:"relative",top:0,height:a.opt.cursorwidth,width:"0px","background-color":a.opt.cursorcolor,border:a.opt.cursorborder,"background-clip":"padding-box","-webkit-border-radius":a.opt.cursorborderradius,"-moz-border-radius":a.opt.cursorborderradius,"border-radius":a.opt.cursorborderradius});r.wborder=parseFloat(r.outerWidth()-r.innerWidth());a.cursorh=r;var g=u(document.createElement("div"));g.attr("id",a.id+"-hr");g.addClass("nicescroll-rails");g.height=Math.max(parseFloat(a.opt.cursorwidth),r.outerHeight());g.css({height:g.height+"px",zIndex:a.zindex,background:a.opt.background});g.append(r);g.visibility=true;g.scrollable=true;g.align=a.opt.railvalign=="top"?0:1;a.railh=g;a.railh.drag=false}if(a.ispage){s.css({position:"fixed",top:"0px",height:"100%"});s.align?s.css({right:"0px"}):s.css({left:"0px"});a.body.append(s);if(a.railh){g.css({position:"fixed",left:"0px",width:"100%"});g.align?g.css({bottom:"0px"}):g.css({top:"0px"});a.body.append(g)}}else{if(a.ishwscroll){if(a.win.css("position")=="static")a.css(a.win,{position:"relative"});var y=a.win[0].nodeName=="HTML"?a.body:a.win;if(a.zoom){a.zoom.css({position:"absolute",top:1,right:0,"margin-right":s.width+4});y.append(a.zoom)}s.css({position:"absolute",top:0});s.align?s.css({right:0}):s.css({left:0});y.append(s);if(g){g.css({position:"absolute",left:0,bottom:0});g.align?g.css({bottom:0}):g.css({top:0});y.append(g)}}else{a.isfixed=a.win.css("position")=="fixed";var E=a.isfixed?"fixed":"absolute";if(!a.isfixed)a.viewport=a.getViewport(a.win[0]);if(a.viewport){a.body=a.viewport;if(/fixed|relative|absolute/.test(a.viewport.css("position"))==false)a.css(a.viewport,{position:"relative"})}s.css({position:E});if(a.zoom)a.zoom.css({position:E});a.updateScrollBar();a.body.append(s);if(a.zoom)a.body.append(a.zoom);if(a.railh){g.css({position:E});a.body.append(g)}}if(p.isios)a.css(a.win,{"-webkit-tap-highlight-color":"rgba(0,0,0,0)","-webkit-touch-callout":"none"});if(p.isie&&a.opt.disableoutline)a.win.attr("hideFocus","true");if(p.iswebkit&&a.opt.disableoutline)a.win.css({outline:"none"})}if(a.opt.autohidemode===false){a.autohidedom=false;a.rail.css({opacity:a.opt.cursoropacitymax});if(a.railh)a.railh.css({opacity:a.opt.cursoropacitymax})}else if(a.opt.autohidemode===true||a.opt.autohidemode==="leave"){a.autohidedom=u().add(a.rail);if(p.isie8)a.autohidedom=a.autohidedom.add(a.cursor);if(a.railh)a.autohidedom=a.autohidedom.add(a.railh);if(a.railh&&p.isie8)a.autohidedom=a.autohidedom.add(a.cursorh)}else if(a.opt.autohidemode=="scroll"){a.autohidedom=u().add(a.rail);if(a.railh)a.autohidedom=a.autohidedom.add(a.railh)}else if(a.opt.autohidemode=="cursor"){a.autohidedom=u().add(a.cursor);if(a.railh)a.autohidedom=a.autohidedom.add(a.cursorh)}else if(a.opt.autohidemode=="hidden"){a.autohidedom=false;a.hide();a.locked=false}if(p.isie9mobile){a.scrollmom=new w(a);a.onmangotouch=function(e){var t=a.getScrollTop();var n=a.getScrollLeft();if(t==a.scrollmom.lastscrolly&&n==a.scrollmom.lastscrollx)return true;var r=t-a.mangotouch.sy;var i=n-a.mangotouch.sx;var s=Math.round(Math.sqrt(Math.pow(i,2)+Math.pow(r,2)));if(s==0)return;var o=r<0?-1:1;var u=i<0?-1:1;var f=+(new Date);if(a.mangotouch.lazy)clearTimeout(a.mangotouch.lazy);if(f-a.mangotouch.tm>80||a.mangotouch.dry!=o||a.mangotouch.drx!=u){a.scrollmom.stop();a.scrollmom.reset(n,t);a.mangotouch.sy=t;a.mangotouch.ly=t;a.mangotouch.sx=n;a.mangotouch.lx=n;a.mangotouch.dry=o;a.mangotouch.drx=u;a.mangotouch.tm=f}else{a.scrollmom.stop();a.scrollmom.update(a.mangotouch.sx-i,a.mangotouch.sy-r);var l=f-a.mangotouch.tm;a.mangotouch.tm=f;var c=Math.max(Math.abs(a.mangotouch.ly-t),Math.abs(a.mangotouch.lx-n));a.mangotouch.ly=t;a.mangotouch.lx=n;if(c>2){a.mangotouch.lazy=setTimeout(function(){a.mangotouch.lazy=false;a.mangotouch.dry=0;a.mangotouch.drx=0;a.mangotouch.tm=0;a.scrollmom.doMomentum(30)},100)}}};var S=a.getScrollTop();var x=a.getScrollLeft();a.mangotouch={sy:S,ly:S,dry:0,sx:x,lx:x,drx:0,lazy:false,tm:0};a.bind(a.docscroll,"scroll",a.onmangotouch)}else{if(p.cantouch||a.istouchcapable||a.opt.touchbehavior||p.hasmstouch){a.scrollmom=new w(a);a.ontouchstart=function(e){if(e.pointerType&&e.pointerType!=2)return false;a.hasmoving=false;if(!a.locked){if(p.hasmstouch){var t=e.target?e.target:false;while(t){var n=u(t).getNiceScroll();if(n.length>0&&n[0].me==a.me)break;if(n.length>0)return false;if(t.nodeName=="DIV"&&t.id==a.id)break;t=t.parentNode?t.parentNode:false}}a.cancelScroll();var t=a.getTarget(e);if(t){var r=/INPUT/i.test(t.nodeName)&&/range/i.test(t.type);if(r)return a.stopPropagation(e)}if(!("clientX"in e)&&"changedTouches"in e){e.clientX=e.changedTouches[0].clientX;e.clientY=e.changedTouches[0].clientY}if(a.forcescreen){var i=e;var e={original:e.original?e.original:e};e.clientX=i.screenX;e.clientY=i.screenY}a.rail.drag={x:e.clientX,y:e.clientY,sx:a.scroll.x,sy:a.scroll.y,st:a.getScrollTop(),sl:a.getScrollLeft(),pt:2,dl:false};if(a.ispage||!a.opt.directionlockdeadzone){a.rail.drag.dl="f"}else{var s={w:u(window).width(),h:u(window).height()};var o={w:Math.max(document.body.scrollWidth,document.documentElement.scrollWidth),h:Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)};var f=Math.max(0,o.h-s.h);var l=Math.max(0,o.w-s.w);if(!a.rail.scrollable&&a.railh.scrollable)a.rail.drag.ck=f>0?"v":false;else if(a.rail.scrollable&&!a.railh.scrollable)a.rail.drag.ck=l>0?"h":false;else a.rail.drag.ck=false;if(!a.rail.drag.ck)a.rail.drag.dl="f"}if(a.opt.touchbehavior&&a.isiframe&&p.isie){var c=a.win.position();a.rail.drag.x+=c.left;a.rail.drag.y+=c.top}a.hasmoving=false;a.lastmouseup=false;a.scrollmom.reset(e.clientX,e.clientY);if(!p.cantouch&&!this.istouchcapable&&!p.hasmstouch){var h=t?/INPUT|SELECT|TEXTAREA/i.test(t.nodeName):false;if(!h){if(!a.ispage&&p.hasmousecapture)t.setCapture();if(a.opt.touchbehavior){if(t.onclick&&!(t._onclick||false)){t._onclick=t.onclick;t.onclick=function(e){if(a.hasmoving)return false;t._onclick.call(this,e)}}return a.cancelEvent(e)}return a.stopPropagation(e)}if(/SUBMIT|CANCEL|BUTTON/i.test(u(t).attr("type"))){pc={tg:t,click:false};a.preventclick=pc}}}};a.ontouchend=function(e){if(e.pointerType&&e.pointerType!=2)return false;if(a.rail.drag&&a.rail.drag.pt==2){a.scrollmom.doMomentum();a.rail.drag=false;if(a.hasmoving){a.lastmouseup=true;a.hideCursor();if(p.hasmousecapture)document.releaseCapture();if(!p.cantouch)return a.cancelEvent(e)}}};var T=a.opt.touchbehavior&&a.isiframe&&!p.hasmousecapture;a.ontouchmove=function(e,t){if(e.pointerType&&e.pointerType!=2)return false;if(a.rail.drag&&a.rail.drag.pt==2){if(p.cantouch&&typeof e.original=="undefined")return true;a.hasmoving=true;if(a.preventclick&&!a.preventclick.click){a.preventclick.click=a.preventclick.tg.onclick||false;a.preventclick.tg.onclick=a.onpreventclick}var n=u.extend({original:e},e);e=n;if("changedTouches"in e){e.clientX=e.changedTouches[0].clientX;e.clientY=e.changedTouches[0].clientY}if(a.forcescreen){var r=e;var e={original:e.original?e.original:e};e.clientX=r.screenX;e.clientY=r.screenY}var i=ofy=0;if(T&&!t){var s=a.win.position();i=-s.left;ofy=-s.top}var o=e.clientY+ofy;var f=o-a.rail.drag.y;var l=e.clientX+i;var c=l-a.rail.drag.x;var h=a.rail.drag.st-f;if(a.ishwscroll&&a.opt.bouncescroll){if(h<0){h=Math.round(h/2)}else if(h>a.page.maxh){h=a.page.maxh+Math.round((h-a.page.maxh)/2)}}else{if(h<0){h=0;o=0}if(h>a.page.maxh){h=a.page.maxh;o=0}}if(a.railh&&a.railh.scrollable){var d=a.rail.drag.sl-c;if(a.ishwscroll&&a.opt.bouncescroll){if(d<0){d=Math.round(d/2)}else if(d>a.page.maxw){d=a.page.maxw+Math.round((d-a.page.maxw)/2)}}else{if(d<0){d=0;l=0}if(d>a.page.maxw){d=a.page.maxw;l=0}}}var v=false;if(a.rail.drag.dl){v=true;if(a.rail.drag.dl=="v")d=a.rail.drag.sl;else if(a.rail.drag.dl=="h")h=a.rail.drag.st}else{var m=Math.abs(f);var g=Math.abs(c);var y=a.opt.directionlockdeadzone;if(a.rail.drag.ck=="v"){if(m>y&&g<=m*.3){a.rail.drag=false;return true}else if(g>y){a.rail.drag.dl="f";u("body").scrollTop(u("body").scrollTop())}}else if(a.rail.drag.ck=="h"){if(g>y&&m<=g*.3){a.rail.drag=false;return true}else if(m>y){a.rail.drag.dl="f";u("body").scrollLeft(u("body").scrollLeft())}}}a.synched("touchmove",function(){if(a.rail.drag&&a.rail.drag.pt==2){if(a.prepareTransition)a.prepareTransition(0);if(a.rail.scrollable)a.setScrollTop(h);a.scrollmom.update(l,o);if(a.railh&&a.railh.scrollable){a.setScrollLeft(d);a.showCursor(h,d)}else{a.showCursor(h)}if(p.isie10)document.selection.clear()}});if(p.ischrome&&a.istouchcapable)v=false;if(v)return a.cancelEvent(e)}}}a.onmousedown=function(e,t){if(a.rail.drag&&a.rail.drag.pt!=1)return;if(a.locked)return a.cancelEvent(e);a.cancelScroll();a.rail.drag={x:e.clientX,y:e.clientY,sx:a.scroll.x,sy:a.scroll.y,pt:1,hr:!!t};var n=a.getTarget(e);if(!a.ispage&&p.hasmousecapture)n.setCapture();if(a.isiframe&&!p.hasmousecapture){a.saved["csspointerevents"]=a.doc.css("pointer-events");a.css(a.doc,{"pointer-events":"none"})}a.hasmoving=false;return a.cancelEvent(e)};a.onmouseup=function(e){if(a.rail.drag){if(p.hasmousecapture)document.releaseCapture();if(a.isiframe&&!p.hasmousecapture)a.doc.css("pointer-events",a.saved["csspointerevents"]);if(a.rail.drag.pt!=1)return;a.rail.drag=false;if(a.hasmoving)a.triggerScrollEnd();return a.cancelEvent(e)}};a.onmousemove=function(e){if(a.rail.drag){if(a.rail.drag.pt!=1)return;if(p.ischrome&&e.which==0)return a.onmouseup(e);a.cursorfreezed=true;a.hasmoving=true;if(a.rail.drag.hr){a.scroll.x=a.rail.drag.sx+(e.clientX-a.rail.drag.x);if(a.scroll.x<0)a.scroll.x=0;var t=a.scrollvaluemaxw;if(a.scroll.x>t)a.scroll.x=t}else{a.scroll.y=a.rail.drag.sy+(e.clientY-a.rail.drag.y);if(a.scroll.y<0)a.scroll.y=0;var n=a.scrollvaluemax;if(a.scroll.y>n)a.scroll.y=n}a.synched("mousemove",function(){if(a.rail.drag&&a.rail.drag.pt==1){a.showCursor();if(a.rail.drag.hr)a.doScrollLeft(Math.round(a.scroll.x*a.scrollratio.x),a.opt.cursordragspeed);else a.doScrollTop(Math.round(a.scroll.y*a.scrollratio.y),a.opt.cursordragspeed)}});return a.cancelEvent(e)}};if(p.cantouch||a.opt.touchbehavior){a.onpreventclick=function(e){if(a.preventclick){a.preventclick.tg.onclick=a.preventclick.click;a.preventclick=false;return a.cancelEvent(e)}};a.bind(a.win,"mousedown",a.ontouchstart);a.onclick=p.isios?false:function(e){if(a.lastmouseup){a.lastmouseup=false;return a.cancelEvent(e)}else{return true}};if(a.opt.grabcursorenabled&&p.cursorgrabvalue){a.css(a.ispage?a.doc:a.win,{cursor:p.cursorgrabvalue});a.css(a.rail,{cursor:p.cursorgrabvalue})}}else{function N(e){if(!a.selectiondrag)return;if(e){var t=a.win.outerHeight();var n=e.pageY-a.selectiondrag.top;if(n>0&&n<t)n=0;if(n>=t)n-=t;a.selectiondrag.df=n}if(a.selectiondrag.df==0)return;var r=-Math.floor(a.selectiondrag.df/6)*2;a.doScrollBy(r);a.debounced("doselectionscroll",function(){N()},50)}if("getSelection"in document){a.hasTextSelected=function(){return document.getSelection().rangeCount>0}}else if("selection"in document){a.hasTextSelected=function(){return document.selection.type!="None"}}else{a.hasTextSelected=function(){return false}}a.onselectionstart=function(e){if(a.ispage)return;a.selectiondrag=a.win.offset()};a.onselectionend=function(e){a.selectiondrag=false};a.onselectiondrag=function(e){if(!a.selectiondrag)return;if(a.hasTextSelected())a.debounced("selectionscroll",function(){N(e)},250)}}if(p.hasmstouch){a.css(a.rail,{"-ms-touch-action":"none"});a.css(a.cursor,{"-ms-touch-action":"none"});a.bind(a.win,"MSPointerDown",a.ontouchstart);a.bind(document,"MSPointerUp",a.ontouchend);a.bind(document,"MSPointerMove",a.ontouchmove);a.bind(a.cursor,"MSGestureHold",function(e){e.preventDefault()});a.bind(a.cursor,"contextmenu",function(e){e.preventDefault()})}if(this.istouchcapable){a.bind(a.win,"touchstart",a.ontouchstart);a.bind(document,"touchend",a.ontouchend);a.bind(document,"touchcancel",a.ontouchend);a.bind(document,"touchmove",a.ontouchmove)}a.bind(a.cursor,"mousedown",a.onmousedown);a.bind(a.cursor,"mouseup",a.onmouseup);if(a.railh){a.bind(a.cursorh,"mousedown",function(e){a.onmousedown(e,true)});a.bind(a.cursorh,"mouseup",a.onmouseup)}if(a.opt.cursordragontouch||!p.cantouch&&!a.opt.touchbehavior){a.rail.css({cursor:"default"});a.railh&&a.railh.css({cursor:"default"});a.jqbind(a.rail,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.rail,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()});if(a.opt.sensitiverail){a.bind(a.rail,"click",function(e){a.doRailClick(e,false,false)});a.bind(a.rail,"dblclick",function(e){a.doRailClick(e,true,false)});a.bind(a.cursor,"click",function(e){a.cancelEvent(e)});a.bind(a.cursor,"dblclick",function(e){a.cancelEvent(e)})}if(a.railh){a.jqbind(a.railh,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.railh,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()});if(a.opt.sensitiverail){a.bind(a.railh,"click",function(e){a.doRailClick(e,false,true)});a.bind(a.railh,"dblclick",function(e){a.doRailClick(e,true,true)});a.bind(a.cursorh,"click",function(e){a.cancelEvent(e)});a.bind(a.cursorh,"dblclick",function(e){a.cancelEvent(e)})}}}if(!p.cantouch&&!a.opt.touchbehavior){a.bind(p.hasmousecapture?a.win:document,"mouseup",a.onmouseup);a.bind(document,"mousemove",a.onmousemove);if(a.onclick)a.bind(document,"click",a.onclick);if(!a.ispage&&a.opt.enablescrollonselection){a.bind(a.win[0],"mousedown",a.onselectionstart);a.bind(document,"mouseup",a.onselectionend);a.bind(a.cursor,"mouseup",a.onselectionend);if(a.cursorh)a.bind(a.cursorh,"mouseup",a.onselectionend);a.bind(document,"mousemove",a.onselectiondrag)}if(a.zoom){a.jqbind(a.zoom,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.zoom,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()})}}else{a.bind(p.hasmousecapture?a.win:document,"mouseup",a.ontouchend);a.bind(document,"mousemove",a.ontouchmove);if(a.onclick)a.bind(document,"click",a.onclick);if(a.opt.cursordragontouch){a.bind(a.cursor,"mousedown",a.onmousedown);a.bind(a.cursor,"mousemove",a.onmousemove);a.cursorh&&a.bind(a.cursorh,"mousedown",function(e){a.onmousedown(e,true)});a.cursorh&&a.bind(a.cursorh,"mousemove",a.onmousemove)}}if(a.opt.enablemousewheel){if(!a.isiframe)a.bind(p.isie&&a.ispage?document:a.win,"mousewheel",a.onmousewheel);a.bind(a.rail,"mousewheel",a.onmousewheel);if(a.railh)a.bind(a.railh,"mousewheel",a.onmousewheelhr)}if(!a.ispage&&!p.cantouch&&!/HTML|BODY/.test(a.win[0].nodeName)){if(!a.win.attr("tabindex"))a.win.attr({tabindex:i++});a.jqbind(a.win,"focus",function(e){t=a.getTarget(e).id||true;a.hasfocus=true;if(a.canshowonmouseevent)a.noticeCursor()});a.jqbind(a.win,"blur",function(e){t=false;a.hasfocus=false});a.jqbind(a.win,"mouseenter",function(e){n=a.getTarget(e).id||true;a.hasmousefocus=true;if(a.canshowonmouseevent)a.noticeCursor()});a.jqbind(a.win,"mouseleave",function(){n=false;a.hasmousefocus=false;if(!a.rail.drag)a.hideCursor()})}}a.onkeypress=function(e){if(a.locked&&a.page.maxh==0)return true;e=e?e:window.e;var r=a.getTarget(e);if(r&&/INPUT|TEXTAREA|SELECT|OPTION/.test(r.nodeName)){var i=r.getAttribute("type")||r.type||false;if(!i||!/submit|button|cancel/i.tp)return true}if(a.hasfocus||a.hasmousefocus&&!t||a.ispage&&!t&&!n){var s=e.keyCode;if(a.locked&&s!=27)return a.cancelEvent(e);var o=e.ctrlKey||false;var u=e.shiftKey||false;var f=false;switch(s){case 38:case 63233:a.doScrollBy(24*3);f=true;break;case 40:case 63235:a.doScrollBy(-24*3);f=true;break;case 37:case 63232:if(a.railh){o?a.doScrollLeft(0):a.doScrollLeftBy(24*3);f=true}break;case 39:case 63234:if(a.railh){o?a.doScrollLeft(a.page.maxw):a.doScrollLeftBy(-24*3);f=true}break;case 33:case 63276:a.doScrollBy(a.view.h);f=true;break;case 34:case 63277:a.doScrollBy(-a.view.h);f=true;break;case 36:case 63273:a.railh&&o?a.doScrollPos(0,0):a.doScrollTo(0);f=true;break;case 35:case 63275:a.railh&&o?a.doScrollPos(a.page.maxw,a.page.maxh):a.doScrollTo(a.page.maxh);f=true;break;case 32:if(a.opt.spacebarenabled){u?a.doScrollBy(a.view.h):a.doScrollBy(-a.view.h);f=true}break;case 27:if(a.zoomactive){a.doZoom();f=true}break}if(f)return a.cancelEvent(e)}};if(a.opt.enablekeyboard)a.bind(document,p.isopera&&!p.isopera12?"keypress":"keydown",a.onkeypress);a.bind(window,"resize",a.lazyResize);a.bind(window,"orientationchange",a.lazyResize);a.bind(window,"load",a.lazyResize);if(p.ischrome&&!a.ispage&&!a.haswrapper){var C=a.win.attr("style");var k=parseFloat(a.win.css("width"))+1;a.win.css("width",k);a.synched("chromefix",function(){a.win.attr("style",C)})}a.onAttributeChange=function(e){a.lazyResize(250)};if(!a.ispage&&!a.haswrapper){if(v!==false){a.observer=new v(function(e){e.forEach(a.onAttributeChange)});a.observer.observe(a.win[0],{childList:true,characterData:false,attributes:true,subtree:false});a.observerremover=new v(function(e){e.forEach(function(e){if(e.removedNodes.length>0){for(var t in e.removedNodes){if(e.removedNodes[t]==a.win[0])return a.remove()}}})});a.observerremover.observe(a.win[0].parentNode,{childList:true,characterData:false,attributes:false,subtree:false})}else{a.bind(a.win,p.isie&&!p.isie9?"propertychange":"DOMAttrModified",a.onAttributeChange);if(p.isie9)a.win[0].attachEvent("onpropertychange",a.onAttributeChange);a.bind(a.win,"DOMNodeRemoved",function(e){if(e.target==a.win[0])a.remove()})}}if(!a.ispage&&a.opt.boxzoom)a.bind(window,"resize",a.resizeZoom);if(a.istextarea)a.bind(a.win,"mouseup",a.lazyResize);a.checkrtlmode=true;a.lazyResize(30)}if(this.doc[0].nodeName=="IFRAME"){function L(e){a.iframexd=false;try{var t="contentDocument"in this?this.contentDocument:this.contentWindow.document;var n=t.domain}catch(e){a.iframexd=true;t=false}if(a.iframexd){if("console"in window)console.log("NiceScroll error: policy restriced iframe");return true}a.forcescreen=true;if(a.isiframe){a.iframe={doc:u(t),html:a.doc.contents().find("html")[0],body:a.doc.contents().find("body")[0]};a.getContentSize=function(){return{w:Math.max(a.iframe.html.scrollWidth,a.iframe.body.scrollWidth),h:Math.max(a.iframe.html.scrollHeight,a.iframe.body.scrollHeight)}};a.docscroll=u(a.iframe.body)}if(!p.isios&&a.opt.iframeautoresize&&!a.isiframe){a.win.scrollTop(0);a.doc.height("");var r=Math.max(t.getElementsByTagName("html")[0].scrollHeight,t.body.scrollHeight);a.doc.height(r)}a.lazyResize(30);if(p.isie7)a.css(u(a.iframe.html),{"overflow-y":"hidden"});a.css(u(a.iframe.body),{"overflow-y":"hidden"});if(p.isios&&a.haswrapper){a.css(u(t.body),{"-webkit-transform":"translate3d(0,0,0)"})}if("contentWindow"in this){a.bind(this.contentWindow,"scroll",a.onscroll)}else{a.bind(t,"scroll",a.onscroll)}if(a.opt.enablemousewheel){a.bind(t,"mousewheel",a.onmousewheel)}if(a.opt.enablekeyboard)a.bind(t,p.isopera?"keypress":"keydown",a.onkeypress);if(p.cantouch||a.opt.touchbehavior){a.bind(t,"mousedown",a.ontouchstart);a.bind(t,"mousemove",function(e){a.ontouchmove(e,true)});if(a.opt.grabcursorenabled&&p.cursorgrabvalue)a.css(u(t.body),{cursor:p.cursorgrabvalue})}a.bind(t,"mouseup",a.ontouchend);if(a.zoom){if(a.opt.dblclickzoom)a.bind(t,"dblclick",a.doZoom);if(a.ongesturezoom)a.bind(t,"gestureend",a.ongesturezoom)}}if(this.doc[0].readyState&&this.doc[0].readyState=="complete"){setTimeout(function(){L.call(a.doc[0],false)},500)}a.bind(this.doc,"load",L)}};this.showCursor=function(e,t){if(a.cursortimeout){clearTimeout(a.cursortimeout);a.cursortimeout=0}if(!a.rail)return;if(a.autohidedom){a.autohidedom.stop().css({opacity:a.opt.cursoropacitymax});a.cursoractive=true}if(!a.rail.drag||a.rail.drag.pt!=1){if(typeof e!="undefined"&&e!==false){a.scroll.y=Math.round(e*1/a.scrollratio.y)}if(typeof t!="undefined"){a.scroll.x=Math.round(t*1/a.scrollratio.x)}}a.cursor.css({height:a.cursorheight,top:a.scroll.y});if(a.cursorh){!a.rail.align&&a.rail.visibility?a.cursorh.css({width:a.cursorwidth,left:a.scroll.x+a.rail.width}):a.cursorh.css({width:a.cursorwidth,left:a.scroll.x});a.cursoractive=true}if(a.zoom)a.zoom.stop().css({opacity:a.opt.cursoropacitymax})};this.hideCursor=function(e){if(a.cursortimeout)return;if(!a.rail)return;if(!a.autohidedom)return;if(a.hasmousefocus&&a.opt.autohidemode=="leave")return;a.cursortimeout=setTimeout(function(){if(!a.rail.active||!a.showonmouseevent){a.autohidedom.stop().animate({opacity:a.opt.cursoropacitymin});if(a.zoom)a.zoom.stop().animate({opacity:a.opt.cursoropacitymin});a.cursoractive=false}a.cursortimeout=0},e||a.opt.hidecursordelay)};this.noticeCursor=function(e,t,n){a.showCursor(t,n);if(!a.rail.active)a.hideCursor(e)};this.getContentSize=a.ispage?function(){return{w:Math.max(document.body.scrollWidth,document.documentElement.scrollWidth),h:Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)}}:a.haswrapper?function(){return{w:a.doc.outerWidth()+parseInt(a.win.css("paddingLeft"))+parseInt(a.win.css("paddingRight")),h:a.doc.outerHeight()+parseInt(a.win.css("paddingTop"))+parseInt(a.win.css("paddingBottom"))}}:function(){return{w:a.docscroll[0].scrollWidth,h:a.docscroll[0].scrollHeight}};this.onResize=function(e,t){if(!a||!a.win)return false;if(!a.haswrapper&&!a.ispage){if(a.win.css("display")=="none"){if(a.visibility)a.hideRail().hideRailHr();return false}else{if(!a.hidden&&!a.visibility)a.showRail().showRailHr()}}var n=a.page.maxh;var r=a.page.maxw;var i={h:a.view.h,w:a.view.w};a.view={w:a.ispage?a.win.width():parseInt(a.win[0].clientWidth),h:a.ispage?a.win.height():parseInt(a.win[0].clientHeight)};a.page=t?t:a.getContentSize();a.page.maxh=Math.max(0,a.page.h-a.view.h);a.page.maxw=Math.max(0,a.page.w-a.view.w);if(a.page.maxh==n&&a.page.maxw==r&&a.view.w==i.w){if(!a.ispage){var s=a.win.offset();if(a.lastposition){var o=a.lastposition;if(o.top==s.top&&o.left==s.left)return a}a.lastposition=s}else{return a}}if(a.page.maxh==0){a.hideRail();a.scrollvaluemax=0;a.scroll.y=0;a.scrollratio.y=0;a.cursorheight=0;a.setScrollTop(0);a.rail.scrollable=false}else{a.rail.scrollable=true}if(a.page.maxw==0){a.hideRailHr();a.scrollvaluemaxw=0;a.scroll.x=0;a.scrollratio.x=0;a.cursorwidth=0;a.setScrollLeft(0);a.railh.scrollable=false}else{a.railh.scrollable=true}a.locked=a.page.maxh==0&&a.page.maxw==0;if(a.locked){if(!a.ispage)a.updateScrollBar(a.view);return false}if(!a.hidden&&!a.visibility){a.showRail().showRailHr()}else if(!a.hidden&&!a.railh.visibility)a.showRailHr();if(a.istextarea&&a.win.css("resize")&&a.win.css("resize")!="none")a.view.h-=20;a.cursorheight=Math.min(a.view.h,Math.round(a.view.h*(a.view.h/a.page.h)));a.cursorheight=a.opt.cursorfixedheight?a.opt.cursorfixedheight:Math.max(a.opt.cursorminheight,a.cursorheight);a.cursorwidth=Math.min(a.view.w,Math.round(a.view.w*(a.view.w/a.page.w)));a.cursorwidth=a.opt.cursorfixedheight?a.opt.cursorfixedheight:Math.max(a.opt.cursorminheight,a.cursorwidth);a.scrollvaluemax=a.view.h-a.cursorheight-a.cursor.hborder;if(a.railh){a.railh.width=a.page.maxh>0?a.view.w-a.rail.width:a.view.w;a.scrollvaluemaxw=a.railh.width-a.cursorwidth-a.cursorh.wborder}if(a.checkrtlmode&&a.railh){a.checkrtlmode=false;if(a.opt.rtlmode&&a.scroll.x==0)a.setScrollLeft(a.page.maxw)}if(!a.ispage)a.updateScrollBar(a.view);a.scrollratio={x:a.page.maxw/a.scrollvaluemaxw,y:a.page.maxh/a.scrollvaluemax};var u=a.getScrollTop();if(u>a.page.maxh){a.doScrollTop(a.page.maxh)}else{a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));a.scroll.x=Math.round(a.getScrollLeft()*(1/a.scrollratio.x));if(a.cursoractive)a.noticeCursor()}if(a.scroll.y&&a.getScrollTop()==0)a.doScrollTo(Math.floor(a.scroll.y*a.scrollratio.y));return a};this.resize=a.onResize;this.lazyResize=function(e){e=isNaN(e)?30:e;a.delayed("resize",a.resize,e);return a};this._bind=function(e,t,n,r){a.events.push({e:e,n:t,f:n,b:r,q:false});if(e.addEventListener){e.addEventListener(t,n,r||false)}else if(e.attachEvent){e.attachEvent("on"+t,n)}else{e["on"+t]=n}};this.jqbind=function(e,t,n){a.events.push({e:e,n:t,f:n,q:true});u(e).bind(t,n)};this.bind=function(e,t,n,r){var i="jquery"in e?e[0]:e;if(t=="mousewheel"){if("onwheel"in a.win){a._bind(i,"wheel",n,r||false)}else{var s=typeof document.onmousewheel!="undefined"?"mousewheel":"DOMMouseScroll";x(i,s,n,r||false);if(s=="DOMMouseScroll")x(i,"MozMousePixelScroll",n,r||false)}}else if(i.addEventListener){if(p.cantouch&&/mouseup|mousedown|mousemove/.test(t)){var o=t=="mousedown"?"touchstart":t=="mouseup"?"touchend":"touchmove";a._bind(i,o,function(e){if(e.touches){if(e.touches.length<2){var t=e.touches.length?e.touches[0]:e;t.original=e;n.call(this,t)}}else if(e.changedTouches){var t=e.changedTouches[0];t.original=e;n.call(this,t)}},r||false)}a._bind(i,t,n,r||false);if(p.cantouch&&t=="mouseup")a._bind(i,"touchcancel",n,r||false)}else{a._bind(i,t,function(e){e=e||window.event||false;if(e){if(e.srcElement)e.target=e.srcElement}if(!("pageY"in e)){e.pageX=e.clientX+document.documentElement.scrollLeft;e.pageY=e.clientY+document.documentElement.scrollTop}return n.call(i,e)===false||r===false?a.cancelEvent(e):true})}};this._unbind=function(e,t,n,r){if(e.removeEventListener){e.removeEventListener(t,n,r)}else if(e.detachEvent){e.detachEvent("on"+t,n)}else{e["on"+t]=false}};this.unbindAll=function(){for(var e=0;e<a.events.length;e++){var t=a.events[e];t.q?t.e.unbind(t.n,t.f):a._unbind(t.e,t.n,t.f,t.b)}};this.cancelEvent=function(e){var e=e.original?e.original:e?e:window.event||false;if(!e)return false;if(e.preventDefault)e.preventDefault();if(e.stopPropagation)e.stopPropagation();if(e.preventManipulation)e.preventManipulation();e.cancelBubble=true;e.cancel=true;e.returnValue=false;return false};this.stopPropagation=function(e){var e=e.original?e.original:e?e:window.event||false;if(!e)return false;if(e.stopPropagation)return e.stopPropagation();if(e.cancelBubble)e.cancelBubble=true;return false};this.showRail=function(){if(a.page.maxh!=0&&(a.ispage||a.win.css("display")!="none")){a.visibility=true;a.rail.visibility=true;a.rail.css("display","block")}return a};this.showRailHr=function(){if(!a.railh)return a;if(a.page.maxw!=0&&(a.ispage||a.win.css("display")!="none")){a.railh.visibility=true;a.railh.css("display","block")}return a};this.hideRail=function(){a.visibility=false;a.rail.visibility=false;a.rail.css("display","none");return a};this.hideRailHr=function(){if(!a.railh)return a;a.railh.visibility=false;a.railh.css("display","none");return a};this.show=function(){a.hidden=false;a.locked=false;return a.showRail().showRailHr()};this.hide=function(){a.hidden=true;a.locked=true;return a.hideRail().hideRailHr()};this.toggle=function(){return a.hidden?a.show():a.hide()};this.remove=function(){a.stop();if(a.cursortimeout)clearTimeout(a.cursortimeout);a.doZoomOut();a.unbindAll();if(p.isie9)a.win[0].detachEvent("onpropertychange",a.onAttributeChange);if(a.observer!==false)a.observer.disconnect();if(a.observerremover!==false)a.observerremover.disconnect();a.events=null;if(a.cursor){a.cursor.remove()}if(a.cursorh){a.cursorh.remove()}if(a.rail){a.rail.remove()}if(a.railh){a.railh.remove()}if(a.zoom){a.zoom.remove()}for(var e=0;e<a.saved.css.length;e++){var t=a.saved.css[e];t[0].css(t[1],typeof t[2]=="undefined"?"":t[2])}a.saved=false;a.me.data("__nicescroll","");var n=u.nicescroll;n.each(function(e){if(!this)return;if(this.id===a.id){delete n[e];for(var t=++e;t<n.length;t++,e++)n[e]=n[t];n.length--;if(n.length)delete n[n.length]}});for(var r in a){a[r]=null;delete a[r]}a=null};this.scrollstart=function(e){this.onscrollstart=e;return a};this.scrollend=function(e){this.onscrollend=e;return a};this.scrollcancel=function(e){this.onscrollcancel=e;return a};this.zoomin=function(e){this.onzoomin=e;return a};this.zoomout=function(e){this.onzoomout=e;return a};this.isScrollable=function(e){var t=e.target?e.target:e;if(t.nodeName=="OPTION")return true;while(t&&t.nodeType==1&&!/BODY|HTML/.test(t.nodeName)){var n=u(t);var r=n.css("overflowY")||n.css("overflowX")||n.css("overflow")||"";if(/scroll|auto/.test(r))return t.clientHeight!=t.scrollHeight;t=t.parentNode?t.parentNode:false}return false};this.getViewport=function(e){var t=e&&e.parentNode?e.parentNode:false;while(t&&t.nodeType==1&&!/BODY|HTML/.test(t.nodeName)){var n=u(t);if(/fixed|absolute/.test(n.css("position")))return n;var r=n.css("overflowY")||n.css("overflowX")||n.css("overflow")||"";if(/scroll|auto/.test(r)&&t.clientHeight!=t.scrollHeight)return n;if(n.getNiceScroll().length>0)return n;t=t.parentNode?t.parentNode:false}console.log(u(t).parents());return t?u(t):false};this.triggerScrollEnd=function(){if(!a.onscrollend)return;var e=a.getScrollLeft();var t=a.getScrollTop();var n={type:"scrollend",current:{x:e,y:t},end:{x:e,y:t}};a.onscrollend.call(a,n)};this.onmousewheel=function(e){if(a.locked){a.debounced("checkunlock",a.resize,250);return true}if(a.rail.drag)return a.cancelEvent(e);if(a.opt.oneaxismousemode=="auto"&&e.deltaX!=0)a.opt.oneaxismousemode=false;if(a.opt.oneaxismousemode&&e.deltaX==0){if(!a.rail.scrollable){if(a.railh&&a.railh.scrollable){return a.onmousewheelhr(e)}else{return true}}}var t=+(new Date);var n=false;if(a.opt.preservenativescrolling&&a.checkarea+600<t){a.nativescrollingarea=a.isScrollable(e);n=true}a.checkarea=t;if(a.nativescrollingarea)return true;var r=T(e,false,n);if(r)a.checkarea=0;return r};this.onmousewheelhr=function(e){if(a.locked||!a.railh.scrollable)return true;if(a.rail.drag)return a.cancelEvent(e);var t=+(new Date);var n=false;if(a.opt.preservenativescrolling&&a.checkarea+600<t){a.nativescrollingarea=a.isScrollable(e);n=true}a.checkarea=t;if(a.nativescrollingarea)return true;if(a.locked)return a.cancelEvent(e);return T(e,true,n)};this.stop=function(){a.cancelScroll();if(a.scrollmon)a.scrollmon.stop();a.cursorfreezed=false;a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));a.noticeCursor();return a};this.getTransitionSpeed=function(e){var t=Math.round(a.opt.scrollspeed*10);var n=Math.min(t,Math.round(e/20*a.opt.scrollspeed));return n>20?n:0};if(!a.opt.smoothscroll){this.doScrollLeft=function(e,t){var n=a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){var r=e>a.page.maxw?a.page.maxw:e;if(r<0)r=0;var i=t>a.page.maxh?a.page.maxh:t;if(i<0)i=0;a.synched("scroll",function(){a.setScrollTop(i);a.setScrollLeft(r)})};this.cancelScroll=function(){}}else if(a.ishwscroll&&p.hastransition&&a.opt.usetransition){this.prepareTransition=function(e,t){var n=t?e>20?e:0:a.getTransitionSpeed(e);var r=n?p.prefixstyle+"transform "+n+"ms ease-out":"";if(!a.lasttransitionstyle||a.lasttransitionstyle!=r){a.lasttransitionstyle=r;a.doc.css(p.transitionstyle,r)}return n};this.doScrollLeft=function(e,t){var n=a.scrollrunning?a.newscrolly:a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.scrollrunning?a.newscrollx:a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){var r=a.getScrollTop();var i=a.getScrollLeft();if((a.newscrolly-r)*(t-r)<0||(a.newscrollx-i)*(e-i)<0)a.cancelScroll();if(a.opt.bouncescroll==false){if(t<0)t=0;else if(t>a.page.maxh)t=a.page.maxh;if(e<0)e=0;else if(e>a.page.maxw)e=a.page.maxw}if(a.scrollrunning&&e==a.newscrollx&&t==a.newscrolly)return false;a.newscrolly=t;a.newscrollx=e;a.newscrollspeed=n||false;if(a.timer)return false;a.timer=setTimeout(function(){var n=a.getScrollTop();var r=a.getScrollLeft();var i={};i.x=e-r;i.y=t-n;i.px=r;i.py=n;var s=Math.round(Math.sqrt(Math.pow(i.x,2)+Math.pow(i.y,2)));var o=a.newscrollspeed&&a.newscrollspeed>1?a.newscrollspeed:a.getTransitionSpeed(s);if(a.newscrollspeed&&a.newscrollspeed<=1)o*=a.newscrollspeed;a.prepareTransition(o,true);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);if(o>0){if(!a.scrollrunning&&a.onscrollstart){var u={type:"scrollstart",current:{x:r,y:n},request:{x:e,y:t},end:{x:a.newscrollx,y:a.newscrolly},speed:o};a.onscrollstart.call(a,u)}if(p.transitionend){if(!a.scrollendtrapped){a.scrollendtrapped=true;a.bind(a.doc,p.transitionend,a.onScrollTransitionEnd,false)}}else{if(a.scrollendtrapped)clearTimeout(a.scrollendtrapped);a.scrollendtrapped=setTimeout(a.onScrollTransitionEnd,o)}var f=n;var l=r;a.timerscroll={bz:new BezierClass(f,a.newscrolly,o,0,0,.58,1),bh:new BezierClass(l,a.newscrollx,o,0,0,.58,1)};if(!a.cursorfreezed)a.timerscroll.tm=setInterval(function(){a.showCursor(a.getScrollTop(),a.getScrollLeft())},60)}a.synched("doScroll-set",function(){a.timer=0;if(a.scrollendtrapped)a.scrollrunning=true;a.setScrollTop(a.newscrolly);a.setScrollLeft(a.newscrollx);if(!a.scrollendtrapped)a.onScrollTransitionEnd()})},50)};this.cancelScroll=function(){if(!a.scrollendtrapped)return true;var e=a.getScrollTop();var t=a.getScrollLeft();a.scrollrunning=false;if(!p.transitionend)clearTimeout(p.transitionend);a.scrollendtrapped=false;a._unbind(a.doc,p.transitionend,a.onScrollTransitionEnd);a.prepareTransition(0);a.setScrollTop(e);if(a.railh)a.setScrollLeft(t);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);a.timerscroll=false;a.cursorfreezed=false;a.showCursor(e,t);return a};this.onScrollTransitionEnd=function(){if(a.scrollendtrapped)a._unbind(a.doc,p.transitionend,a.onScrollTransitionEnd);a.scrollendtrapped=false;a.prepareTransition(0);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);a.timerscroll=false;var e=a.getScrollTop();var t=a.getScrollLeft();a.setScrollTop(e);if(a.railh)a.setScrollLeft(t);a.noticeCursor(false,e,t);a.cursorfreezed=false;if(e<0)e=0;else if(e>a.page.maxh)e=a.page.maxh;if(t<0)t=0;else if(t>a.page.maxw)t=a.page.maxw;if(e!=a.newscrolly||t!=a.newscrollx)return a.doScrollPos(t,e,a.opt.snapbackspeed);if(a.onscrollend&&a.scrollrunning){a.triggerScrollEnd()}a.scrollrunning=false}}else{this.doScrollLeft=function(e,t){var n=a.scrollrunning?a.newscrolly:a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.scrollrunning?a.newscrollx:a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){function p(){if(a.cancelAnimationFrame)return true;a.scrollrunning=true;l=1-l;if(l)return a.timer=c(p)||1;var e=0;var t=sy=a.getScrollTop();if(a.dst.ay){t=a.bzscroll?a.dst.py+a.bzscroll.getNow()*a.dst.ay:a.newscrolly;var n=t-sy;if(n<0&&t<a.newscrolly||n>0&&t>a.newscrolly)t=a.newscrolly;a.setScrollTop(t);if(t==a.newscrolly)e=1}else{e=1}var r=sx=a.getScrollLeft();if(a.dst.ax){r=a.bzscroll?a.dst.px+a.bzscroll.getNow()*a.dst.ax:a.newscrollx;var n=r-sx;if(n<0&&r<a.newscrollx||n>0&&r>a.newscrollx)r=a.newscrollx;a.setScrollLeft(r);if(r==a.newscrollx)e+=1}else{e+=1}if(e==2){a.timer=0;a.cursorfreezed=false;a.bzscroll=false;a.scrollrunning=false;if(t<0)t=0;else if(t>a.page.maxh)t=a.page.maxh;if(r<0)r=0;else if(r>a.page.maxw)r=a.page.maxw;if(r!=a.newscrollx||t!=a.newscrolly)a.doScrollPos(r,t);else{if(a.onscrollend){a.triggerScrollEnd()}}}else{a.timer=c(p)||1}}var t=typeof t=="undefined"||t===false?a.getScrollTop(true):t;if(a.timer&&a.newscrolly==t&&a.newscrollx==e)return true;if(a.timer)h(a.timer);a.timer=0;var r=a.getScrollTop();var i=a.getScrollLeft();if((a.newscrolly-r)*(t-r)<0||(a.newscrollx-i)*(e-i)<0)a.cancelScroll();a.newscrolly=t;a.newscrollx=e;if(!a.bouncescroll||!a.rail.visibility){if(a.newscrolly<0){a.newscrolly=0}else if(a.newscrolly>a.page.maxh){a.newscrolly=a.page.maxh}}if(!a.bouncescroll||!a.railh.visibility){if(a.newscrollx<0){a.newscrollx=0}else if(a.newscrollx>a.page.maxw){a.newscrollx=a.page.maxw}}a.dst={};a.dst.x=e-i;a.dst.y=t-r;a.dst.px=i;a.dst.py=r;var s=Math.round(Math.sqrt(Math.pow(a.dst.x,2)+Math.pow(a.dst.y,2)));a.dst.ax=a.dst.x/s;a.dst.ay=a.dst.y/s;var o=0;var u=s;if(a.dst.x==0){o=r;u=t;a.dst.ay=1;a.dst.py=0}else if(a.dst.y==0){o=i;u=e;a.dst.ax=1;a.dst.px=0}var f=a.getTransitionSpeed(s);if(n&&n<=1)f*=n;if(f>0){a.bzscroll=a.bzscroll?a.bzscroll.update(u,f):new BezierClass(o,u,f,0,1,0,1)}else{a.bzscroll=false}if(a.timer)return;if(r==a.page.maxh&&t>=a.page.maxh||i==a.page.maxw&&e>=a.page.maxw)a.checkContentSize();var l=1;a.cancelAnimationFrame=false;a.timer=1;if(a.onscrollstart&&!a.scrollrunning){var d={type:"scrollstart",current:{x:i,y:r},request:{x:e,y:t},end:{x:a.newscrollx,y:a.newscrolly},speed:f};a.onscrollstart.call(a,d)}p();if(r==a.page.maxh&&t>=r||i==a.page.maxw&&e>=i)a.checkContentSize();a.noticeCursor()};this.cancelScroll=function(){if(a.timer)h(a.timer);a.timer=0;a.bzscroll=false;a.scrollrunning=false;return a}}this.doScrollBy=function(e,t){var n=0;if(t){n=Math.floor((a.scroll.y-e)*a.scrollratio.y)}else{var r=a.timer?a.newscrolly:a.getScrollTop(true);n=r-e}if(a.bouncescroll){var i=Math.round(a.view.h/2);if(n<-i)n=-i;else if(n>a.page.maxh+i)n=a.page.maxh+i}a.cursorfreezed=false;py=a.getScrollTop(true);if(n<0&&py<=0)return a.noticeCursor();else if(n>a.page.maxh&&py>=a.page.maxh){a.checkContentSize();return a.noticeCursor()}a.doScrollTop(n)};this.doScrollLeftBy=function(e,t){var n=0;if(t){n=Math.floor((a.scroll.x-e)*a.scrollratio.x)}else{var r=a.timer?a.newscrollx:a.getScrollLeft(true);n=r-e}if(a.bouncescroll){var i=Math.round(a.view.w/2);if(n<-i)n=-i;else if(n>a.page.maxw+i)n=a.page.maxw+i}a.cursorfreezed=false;px=a.getScrollLeft(true);if(n<0&&px<=0)return a.noticeCursor();else if(n>a.page.maxw&&px>=a.page.maxw)return a.noticeCursor();a.doScrollLeft(n)};this.doScrollTo=function(e,t){var n=t?Math.round(e*a.scrollratio.y):e;if(n<0)n=0;else if(n>a.page.maxh)n=a.page.maxh;a.cursorfreezed=false;a.doScrollTop(e)};this.checkContentSize=function(){var e=a.getContentSize();if(e.h!=a.page.h||e.w!=a.page.w)a.resize(false,e)};a.onscroll=function(e){if(a.rail.drag)return;if(!a.cursorfreezed){a.synched("scroll",function(){a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));if(a.railh)a.scroll.x=Math.round(a.getScrollLeft()*(1/a.scrollratio.x));a.noticeCursor()})}};a.bind(a.docscroll,"scroll",a.onscroll);this.doZoomIn=function(e){if(a.zoomactive)return;a.zoomactive=true;a.zoomrestore={style:{}};var t=["position","top","left","zIndex","backgroundColor","marginTop","marginBottom","marginLeft","marginRight"];var n=a.win[0].style;for(var r in t){var i=t[r];a.zoomrestore.style[i]=typeof n[i]!="undefined"?n[i]:""}a.zoomrestore.style.width=a.win.css("width");a.zoomrestore.style.height=a.win.css("height");a.zoomrestore.padding={w:a.win.outerWidth()-a.win.width(),h:a.win.outerHeight()-a.win.height()};if(p.isios4){a.zoomrestore.scrollTop=u(window).scrollTop();u(window).scrollTop(0)}a.win.css({position:p.isios4?"absolute":"fixed",top:0,left:0,"z-index":o+100,margin:"0px"});var s=a.win.css("backgroundColor");if(s==""||/transparent|rgba\(0, 0, 0, 0\)|rgba\(0,0,0,0\)/.test(s))a.win.css("backgroundColor","#fff");a.rail.css({"z-index":o+101});a.zoom.css({"z-index":o+102});a.zoom.css("backgroundPosition","0px -18px");a.resizeZoom();if(a.onzoomin)a.onzoomin.call(a);return a.cancelEvent(e)};this.doZoomOut=function(e){if(!a.zoomactive)return;a.zoomactive=false;a.win.css("margin","");a.win.css(a.zoomrestore.style);if(p.isios4){u(window).scrollTop(a.zoomrestore.scrollTop)}a.rail.css({"z-index":a.zindex});a.zoom.css({"z-index":a.zindex});a.zoomrestore=false;a.zoom.css("backgroundPosition","0px 0px");a.onResize();if(a.onzoomout)a.onzoomout.call(a);return a.cancelEvent(e)};this.doZoom=function(e){return a.zoomactive?a.doZoomOut(e):a.doZoomIn(e)};this.resizeZoom=function(){if(!a.zoomactive)return;var e=a.getScrollTop();a.win.css({width:u(window).width()-a.zoomrestore.padding.w+"px",height:u(window).height()-a.zoomrestore.padding.h+"px"});a.onResize();a.setScrollTop(Math.min(a.page.maxh,e))};this.init();u.nicescroll.push(this)};var w=function(e){var t=this;this.nc=e;this.lastx=0;this.lasty=0;this.speedx=0;this.speedy=0;this.lasttime=0;this.steptime=0;this.snapx=false;this.snapy=false;this.demulx=0;this.demuly=0;this.lastscrollx=-1;this.lastscrolly=-1;this.chkx=0;this.chky=0;this.timer=0;this.time=function(){return+(new Date)};this.reset=function(e,n){t.stop();var r=t.time();t.steptime=0;t.lasttime=r;t.speedx=0;t.speedy=0;t.lastx=e;t.lasty=n;t.lastscrollx=-1;t.lastscrolly=-1};this.update=function(e,n){var r=t.time();t.steptime=r-t.lasttime;t.lasttime=r;var i=n-t.lasty;var s=e-t.lastx;var o=t.nc.getScrollTop();var u=t.nc.getScrollLeft();var a=o+i;var f=u+s;t.snapx=f<0||f>t.nc.page.maxw;t.snapy=a<0||a>t.nc.page.maxh;t.speedx=s;t.speedy=i;t.lastx=e;t.lasty=n};this.stop=function(){t.nc.unsynched("domomentum2d");if(t.timer)clearTimeout(t.timer);t.timer=0;t.lastscrollx=-1;t.lastscrolly=-1};this.doSnapy=function(e,n){var r=false;if(n<0){n=0;r=true}else if(n>t.nc.page.maxh){n=t.nc.page.maxh;r=true}if(e<0){e=0;r=true}else if(e>t.nc.page.maxw){e=t.nc.page.maxw;r=true}r?t.nc.doScrollPos(e,n,t.nc.opt.snapbackspeed):t.nc.triggerScrollEnd()};this.doMomentum=function(e){var n=t.time();var r=e?n+e:t.lasttime;var i=t.nc.getScrollLeft();var s=t.nc.getScrollTop();var o=t.nc.page.maxh;var u=t.nc.page.maxw;t.speedx=u>0?Math.min(60,t.speedx):0;t.speedy=o>0?Math.min(60,t.speedy):0;var a=r&&n-r<=60;if(s<0||s>o||i<0||i>u)a=false;var f=t.speedy&&a?t.speedy:false;var l=t.speedx&&a?t.speedx:false;if(f||l){var c=Math.max(16,t.steptime);if(c>50){var h=c/50;t.speedx*=h;t.speedy*=h;c=50}t.demulxy=0;t.lastscrollx=t.nc.getScrollLeft();t.chkx=t.lastscrollx;t.lastscrolly=t.nc.getScrollTop();t.chky=t.lastscrolly;var p=t.lastscrollx;var d=t.lastscrolly;var v=function(){var e=t.time()-n>600?.04:.02;if(t.speedx){p=Math.floor(t.lastscrollx-t.speedx*(1-t.demulxy));t.lastscrollx=p;if(p<0||p>u)e=.1}if(t.speedy){d=Math.floor(t.lastscrolly-t.speedy*(1-t.demulxy));t.lastscrolly=d;if(d<0||d>o)e=.1}t.demulxy=Math.min(1,t.demulxy+e);t.nc.synched("domomentum2d",function(){if(t.speedx){var e=t.nc.getScrollLeft();if(e!=t.chkx)t.stop();t.chkx=p;t.nc.setScrollLeft(p)}if(t.speedy){var n=t.nc.getScrollTop();if(n!=t.chky)t.stop();t.chky=d;t.nc.setScrollTop(d)}if(!t.timer){t.nc.hideCursor();t.doSnapy(p,d)}});if(t.demulxy<1){t.timer=setTimeout(v,c)}else{t.stop();t.nc.hideCursor();t.doSnapy(p,d)}};v()}else{t.doSnapy(t.nc.getScrollLeft(),t.nc.getScrollTop())}}};var E=e.fn.scrollTop;e.cssHooks["pageYOffset"]={get:function(e,t,n){var r=u.data(e,"__nicescroll")||false;return r&&r.ishwscroll?r.getScrollTop():E.call(e)},set:function(e,t){var n=u.data(e,"__nicescroll")||false;n&&n.ishwscroll?n.setScrollTop(parseInt(t)):E.call(e,t);return this}};e.fn.scrollTop=function(e){if(typeof e=="undefined"){var t=this[0]?u.data(this[0],"__nicescroll")||false:false;return t&&t.ishwscroll?t.getScrollTop():E.call(this)}else{return this.each(function(){var t=u.data(this,"__nicescroll")||false;t&&t.ishwscroll?t.setScrollTop(parseInt(e)):E.call(u(this),e)})}};var S=e.fn.scrollLeft;u.cssHooks.pageXOffset={get:function(e,t,n){var r=u.data(e,"__nicescroll")||false;return r&&r.ishwscroll?r.getScrollLeft():S.call(e)},set:function(e,t){var n=u.data(e,"__nicescroll")||false;n&&n.ishwscroll?n.setScrollLeft(parseInt(t)):S.call(e,t);return this}};e.fn.scrollLeft=function(e){if(typeof e=="undefined"){var t=this[0]?u.data(this[0],"__nicescroll")||false:false;return t&&t.ishwscroll?t.getScrollLeft():S.call(this)}else{return this.each(function(){var t=u.data(this,"__nicescroll")||false;t&&t.ishwscroll?t.setScrollLeft(parseInt(e)):S.call(u(this),e)})}};var x=function(e){var t=this;this.length=0;this.name="nicescrollarray";this.each=function(e){for(var n=0,r=0;n<t.length;n++)e.call(t[n],r++);return t};this.push=function(e){t[t.length]=e;t.length++};this.eq=function(e){return t[e]};if(e){for(var n=0;n<e.length;n++){var r=u.data(e[n],"__nicescroll")||false;if(r){this[this.length]=r;this.length++}}}return this};T(x.prototype,["show","hide","toggle","onResize","resize","remove","stop","doScrollPos"],function(e,t){e[t]=function(){var e=arguments;return this.each(function(){this[t].apply(this,e)})}});e.fn.getNiceScroll=function(e){if(typeof e=="undefined"){return new x(this)}else{var t=this[e]&&u.data(this[e],"__nicescroll")||false;return t}};e.extend(e.expr[":"],{nicescroll:function(e){return u.data(e,"__nicescroll")?true:false}});u.fn.niceScroll=function(e,t){if(typeof t=="undefined"){if(typeof e=="object"&&!("jquery"in e)){t=e;e=false}}var n=new x;if(typeof t=="undefined")t={};if(e||false){t.doc=u(e);t.win=u(this)}var r=!("doc"in t);if(!r&&!("win"in t))t.win=u(this);this.each(function(){var e=u(this).data("__nicescroll")||false;if(!e){t.doc=r?u(this):t.doc;e=new b(t,u(this));u(this).data("__nicescroll",e)}n.push(e)});return n.length==1?n[0]:n};window.NiceScroll={getjQuery:function(){return e}};if(!u.nicescroll){u.nicescroll=new x;u.nicescroll.options=m}})(jQuery);


/* --- $SHORTCODES - TABS --- */

!function(a){var b=function(b){this.element=a(b)};b.prototype={constructor:b,show:function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.attr("data-target"),e,f,g;d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,""));if(b.parent("li").hasClass("active"))return;e=c.find(".active:last a")[0],g=a.Event("show",{relatedTarget:e}),b.trigger(g);if(g.isDefaultPrevented())return;f=a(d),this.activate(b.parent("li"),c),this.activate(f,f.parent(),function(){b.trigger({type:"shown",relatedTarget:e})})},activate:function(b,c,d){function g(){e.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),b.addClass("active"),f?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active"),d&&d()}var e=c.find("> .active"),f=d&&a.support.transition&&e.hasClass("fade");f?e.one(a.support.transition.end,g):g(),e.removeClass("in")}};var c=a.fn.tab;a.fn.tab=function(c){return this.each(function(){var d=a(this),e=d.data("tab");e||d.data("tab",e=new b(this)),typeof c=="string"&&e[c]()})},a.fn.tab.Constructor=b,a.fn.tab.noConflict=function(){return a.fn.tab=c,this},a(document).on("click.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(b){b.preventDefault(),a(this).tab("show")})}(window.jQuery)


/* --- $TOUCHCLICK --- */

/**
 * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
 *
 * @version 0.6.9
 * @codingstandard ftlabs-jsv2
 * @copyright The Financial Times Limited [All Rights Reserved]
 * @license MIT License (see LICENSE.txt)
 */

function FastClick(e){"use strict";var t,n=this;this.trackingClick=false;this.trackingClickStart=0;this.targetElement=null;this.touchStartX=0;this.touchStartY=0;this.lastTouchIdentifier=0;this.touchBoundary=10;this.layer=e;if(!e||!e.nodeType){throw new TypeError("Layer must be a document node")}this.onClick=function(){return FastClick.prototype.onClick.apply(n,arguments)};this.onMouse=function(){return FastClick.prototype.onMouse.apply(n,arguments)};this.onTouchStart=function(){return FastClick.prototype.onTouchStart.apply(n,arguments)};this.onTouchMove=function(){return FastClick.prototype.onTouchMove.apply(n,arguments)};this.onTouchEnd=function(){return FastClick.prototype.onTouchEnd.apply(n,arguments)};this.onTouchCancel=function(){return FastClick.prototype.onTouchCancel.apply(n,arguments)};if(FastClick.notNeeded(e)){return}if(this.deviceIsAndroid){e.addEventListener("mouseover",this.onMouse,true);e.addEventListener("mousedown",this.onMouse,true);e.addEventListener("mouseup",this.onMouse,true)}e.addEventListener("click",this.onClick,true);e.addEventListener("touchstart",this.onTouchStart,false);e.addEventListener("touchmove",this.onTouchMove,false);e.addEventListener("touchend",this.onTouchEnd,false);e.addEventListener("touchcancel",this.onTouchCancel,false);if(!Event.prototype.stopImmediatePropagation){e.removeEventListener=function(t,n,r){var i=Node.prototype.removeEventListener;if(t==="click"){i.call(e,t,n.hijacked||n,r)}else{i.call(e,t,n,r)}};e.addEventListener=function(t,n,r){var i=Node.prototype.addEventListener;if(t==="click"){i.call(e,t,n.hijacked||(n.hijacked=function(e){if(!e.propagationStopped){n(e)}}),r)}else{i.call(e,t,n,r)}}}if(typeof e.onclick==="function"){t=e.onclick;e.addEventListener("click",function(e){t(e)},false);e.onclick=null}}FastClick.prototype.deviceIsAndroid=navigator.userAgent.indexOf("Android")>0;FastClick.prototype.deviceIsIOS=/iP(ad|hone|od)/.test(navigator.userAgent);FastClick.prototype.deviceIsIOS4=FastClick.prototype.deviceIsIOS&&/OS 4_\d(_\d)?/.test(navigator.userAgent);FastClick.prototype.deviceIsIOSWithBadTarget=FastClick.prototype.deviceIsIOS&&/OS ([6-9]|\d{2})_\d/.test(navigator.userAgent);FastClick.prototype.needsClick=function(e){"use strict";switch(e.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(e.disabled){return true}break;case"input":if(this.deviceIsIOS&&e.type==="file"||e.disabled){return true}break;case"label":case"video":return true}return/\bneedsclick\b/.test(e.className)};FastClick.prototype.needsFocus=function(e){"use strict";switch(e.nodeName.toLowerCase()){case"textarea":case"select":return true;case"input":switch(e.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return false}return!e.disabled&&!e.readOnly;default:return/\bneedsfocus\b/.test(e.className)}};FastClick.prototype.sendClick=function(e,t){"use strict";var n,r;if(document.activeElement&&document.activeElement!==e){document.activeElement.blur()}r=t.changedTouches[0];n=document.createEvent("MouseEvents");n.initMouseEvent("click",true,true,window,1,r.screenX,r.screenY,r.clientX,r.clientY,false,false,false,false,0,null);n.forwardedTouchEvent=true;e.dispatchEvent(n)};FastClick.prototype.focus=function(e){"use strict";var t;if(this.deviceIsIOS&&e.setSelectionRange){t=e.value.length;e.setSelectionRange(t,t)}else{e.focus()}};FastClick.prototype.updateScrollParent=function(e){"use strict";var t,n;t=e.fastClickScrollParent;if(!t||!t.contains(e)){n=e;do{if(n.scrollHeight>n.offsetHeight){t=n;e.fastClickScrollParent=n;break}n=n.parentElement}while(n)}if(t){t.fastClickLastScrollTop=t.scrollTop}};FastClick.prototype.getTargetElementFromEventTarget=function(e){"use strict";if(e.nodeType===Node.TEXT_NODE){return e.parentNode}return e};FastClick.prototype.onTouchStart=function(e){"use strict";var t,n,r;if(e.targetTouches.length>1){return true}t=this.getTargetElementFromEventTarget(e.target);n=e.targetTouches[0];if(this.deviceIsIOS){r=window.getSelection();if(r.rangeCount&&!r.isCollapsed){return true}if(!this.deviceIsIOS4){if(n.identifier===this.lastTouchIdentifier){e.preventDefault();return false}this.lastTouchIdentifier=n.identifier;this.updateScrollParent(t)}}this.trackingClick=true;this.trackingClickStart=e.timeStamp;this.targetElement=t;this.touchStartX=n.pageX;this.touchStartY=n.pageY;if(e.timeStamp-this.lastClickTime<200){e.preventDefault()}return true};FastClick.prototype.touchHasMoved=function(e){"use strict";var t=e.changedTouches[0],n=this.touchBoundary;if(Math.abs(t.pageX-this.touchStartX)>n||Math.abs(t.pageY-this.touchStartY)>n){return true}return false};FastClick.prototype.onTouchMove=function(e){"use strict";if(!this.trackingClick){return true}if(this.targetElement!==this.getTargetElementFromEventTarget(e.target)||this.touchHasMoved(e)){this.trackingClick=false;this.targetElement=null}return true};FastClick.prototype.findControl=function(e){"use strict";if(e.control!==undefined){return e.control}if(e.htmlFor){return document.getElementById(e.htmlFor)}return e.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")};FastClick.prototype.onTouchEnd=function(e){"use strict";var t,n,r,i,s,o=this.targetElement;if(!this.trackingClick){return true}if(e.timeStamp-this.lastClickTime<200){this.cancelNextClick=true;return true}this.lastClickTime=e.timeStamp;n=this.trackingClickStart;this.trackingClick=false;this.trackingClickStart=0;if(this.deviceIsIOSWithBadTarget){s=e.changedTouches[0];o=document.elementFromPoint(s.pageX-window.pageXOffset,s.pageY-window.pageYOffset)||o;o.fastClickScrollParent=this.targetElement.fastClickScrollParent}r=o.tagName.toLowerCase();if(r==="label"){t=this.findControl(o);if(t){this.focus(o);if(this.deviceIsAndroid){return false}o=t}}else if(this.needsFocus(o)){if(e.timeStamp-n>100||this.deviceIsIOS&&window.top!==window&&r==="input"){this.targetElement=null;return false}this.focus(o);if(!this.deviceIsIOS4||r!=="select"){this.targetElement=null;e.preventDefault()}return false}if(this.deviceIsIOS&&!this.deviceIsIOS4){i=o.fastClickScrollParent;if(i&&i.fastClickLastScrollTop!==i.scrollTop){return true}}if(!this.needsClick(o)){e.preventDefault();this.sendClick(o,e)}return false};FastClick.prototype.onTouchCancel=function(){"use strict";this.trackingClick=false;this.targetElement=null};FastClick.prototype.onMouse=function(e){"use strict";if(!this.targetElement){return true}if(e.forwardedTouchEvent){return true}if(!e.cancelable){return true}if(!this.needsClick(this.targetElement)||this.cancelNextClick){if(e.stopImmediatePropagation){e.stopImmediatePropagation()}else{e.propagationStopped=true}e.stopPropagation();e.preventDefault();return false}return true};FastClick.prototype.onClick=function(e){"use strict";var t;if(this.trackingClick){this.targetElement=null;this.trackingClick=false;return true}if(e.target.type==="submit"&&e.detail===0){return true}t=this.onMouse(e);if(!t){this.targetElement=null}return t};FastClick.prototype.destroy=function(){"use strict";var e=this.layer;if(this.deviceIsAndroid){e.removeEventListener("mouseover",this.onMouse,true);e.removeEventListener("mousedown",this.onMouse,true);e.removeEventListener("mouseup",this.onMouse,true)}e.removeEventListener("click",this.onClick,true);e.removeEventListener("touchstart",this.onTouchStart,false);e.removeEventListener("touchmove",this.onTouchMove,false);e.removeEventListener("touchend",this.onTouchEnd,false);e.removeEventListener("touchcancel",this.onTouchCancel,false)};FastClick.notNeeded=function(e){"use strict";var t;if(typeof window.ontouchstart==="undefined"){return true}if(/Chrome\/[0-9]+/.test(navigator.userAgent)){if(FastClick.prototype.deviceIsAndroid){t=document.querySelector("meta[name=viewport]");if(t&&t.content.indexOf("user-scalable=no")!==-1){return true}}else{return true}}if(e.style.msTouchAction==="none"){return true}return false};FastClick.attach=function(e){"use strict";return new FastClick(e)};if(typeof define!=="undefined"&&define.amd){define(function(){"use strict";return FastClick})}else if(typeof module!=="undefined"&&module.exports){module.exports=FastClick.attach;module.exports.FastClick=FastClick}else{window.FastClick=FastClick}





/* --- $MIXITUP --- */

/*
* MIXITUP - A CSS3 and JQuery Filter & Sort Plugin
* Version: 1.5.4
* License: Creative Commons Attribution-NoDerivs 3.0 Unported - CC BY-ND 3.0
* http://creativecommons.org/licenses/by-nd/3.0/
* This software may be used freely on commercial and non-commercial projects with attribution to the author/copyright holder.
* Author: Patrick Kunka
* Copyright 2012-2013 Patrick Kunka, Barrel LLC, All Rights Reserved
* 
* http://mixitup.io
*/

(function(e){function q(c,b,g,d,a){function k(){l.unbind("webkitTransitionEnd transitionend otransitionend oTransitionEnd");b&&w(b,g,d,a);a.startOrder=[];a.newOrder=[];a.origSort=[];a.checkSort=[];r.removeStyle(a.prefix+"filter, filter, "+a.prefix+"transform, transform, opacity, display").css(a.clean).removeAttr("data-checksum");window.atob||r.css({display:"none",opacity:"0"});l.removeStyle(a.prefix+"transition, transition, "+a.prefix+"perspective, perspective, "+a.prefix+"perspective-origin, perspective-origin, "+
(a.resizeContainer?"height":""));"list"==a.layoutMode?(n.css({display:a.targetDisplayList,opacity:"1"}),a.origDisplay=a.targetDisplayList):(n.css({display:a.targetDisplayGrid,opacity:"1"}),a.origDisplay=a.targetDisplayGrid);a.origLayout=a.layoutMode;setTimeout(function(){r.removeStyle(a.prefix+"transition, transition");a.mixing=!1;if("function"==typeof a.onMixEnd){var b=a.onMixEnd.call(this,a);a=b?b:a}})}clearInterval(a.failsafe);a.mixing=!0;a.filter=c;if("function"==typeof a.onMixStart){var f=a.onMixStart.call(this,
a);a=f?f:a}for(var h=a.transitionSpeed,f=0;2>f;f++){var j=0==f?j=a.prefix:"";a.transition[j+"transition"]="all "+h+"ms linear";a.transition[j+"transform"]=j+"translate3d(0,0,0)";a.perspective[j+"perspective"]=a.perspectiveDistance+"px";a.perspective[j+"perspective-origin"]=a.perspectiveOrigin}var s=a.targetSelector,r=d.find(s);r.each(function(){this.data={}});var l=r.parent();l.css(a.perspective);a.easingFallback="ease-in-out";"smooth"==a.easing&&(a.easing="cubic-bezier(0.25, 0.46, 0.45, 0.94)");
"snap"==a.easing&&(a.easing="cubic-bezier(0.77, 0, 0.175, 1)");"windback"==a.easing&&(a.easing="cubic-bezier(0.175, 0.885, 0.320, 1.275)",a.easingFallback="cubic-bezier(0.175, 0.885, 0.320, 1)");"windup"==a.easing&&(a.easing="cubic-bezier(0.6, -0.28, 0.735, 0.045)",a.easingFallback="cubic-bezier(0.6, 0.28, 0.735, 0.045)");f="list"==a.layoutMode&&null!=a.listEffects?a.listEffects:a.effects;Array.prototype.indexOf&&(a.fade=-1<f.indexOf("fade")?"0":"",a.scale=-1<f.indexOf("scale")?"scale(.01)":"",a.rotateZ=
-1<f.indexOf("rotateZ")?"rotate(180deg)":"",a.rotateY=-1<f.indexOf("rotateY")?"rotateY(90deg)":"",a.rotateX=-1<f.indexOf("rotateX")?"rotateX(90deg)":"",a.blur=-1<f.indexOf("blur")?"blur(8px)":"",a.grayscale=-1<f.indexOf("grayscale")?"grayscale(100%)":"");var n=e(),t=e(),u=[],q=!1;"string"===typeof c?u=y(c):(q=!0,e.each(c,function(a){u[a]=y(this)}));"or"==a.filterLogic?(""==u[0]&&u.shift(),1>u.length?t=t.add(d.find(s+":visible")):r.each(function(){var a=e(this);if(q){var b=0;e.each(u,function(){this.length?
a.is("."+this.join(", ."))&&b++:0<b&&b++});b==u.length?n=n.add(a):t=t.add(a)}else a.is("."+u.join(", ."))?n=n.add(a):t=t.add(a)})):(n=n.add(l.find(s+"."+u.join("."))),t=t.add(l.find(s+":not(."+u.join(".")+"):visible")));c=n.length;var v=e(),p=e(),m=e();t.each(function(){var a=e(this);"none"!=a.css("display")&&(v=v.add(a),m=m.add(a))});if(n.filter(":visible").length==c&&!v.length&&!b){if(a.origLayout==a.layoutMode)return k(),!1;if(1==n.length)return"list"==a.layoutMode?(d.addClass(a.listClass),d.removeClass(a.gridClass),
m.css("display",a.targetDisplayList)):(d.addClass(a.gridClass),d.removeClass(a.listClass),m.css("display",a.targetDisplayGrid)),k(),!1}a.origHeight=l.height();if(n.length){d.removeClass(a.failClass);n.each(function(){var a=e(this);"none"==a.css("display")?p=p.add(a):m=m.add(a)});if(a.origLayout!=a.layoutMode&&!1==a.animateGridList)return"list"==a.layoutMode?(d.addClass(a.listClass),d.removeClass(a.gridClass),m.css("display",a.targetDisplayList)):(d.addClass(a.gridClass),d.removeClass(a.listClass),
m.css("display",a.targetDisplayGrid)),k(),!1;if(!window.atob)return k(),!1;r.css(a.clean);m.each(function(){this.data.origPos=e(this).offset()});"list"==a.layoutMode?(d.addClass(a.listClass),d.removeClass(a.gridClass),p.css("display",a.targetDisplayList)):(d.addClass(a.gridClass),d.removeClass(a.listClass),p.css("display",a.targetDisplayGrid));p.each(function(){this.data.showInterPos=e(this).offset()});v.each(function(){this.data.hideInterPos=e(this).offset()});m.each(function(){this.data.preInterPos=
e(this).offset()});"list"==a.layoutMode?m.css("display",a.targetDisplayList):m.css("display",a.targetDisplayGrid);b&&w(b,g,d,a);if(c=b)a:if(c=a.origSort,f=a.checkSort,c.length!=f.length)c=!1;else{for(j=0;j<f.length;j++)if(c[j].compare&&!c[j].compare(f[j])||c[j]!==f[j]){c=!1;break a}c=!0}if(c)return k(),!1;v.hide();p.each(function(){this.data.finalPos=e(this).offset()});m.each(function(){this.data.finalPrePos=e(this).offset()});a.newHeight=l.height();b&&w("reset",null,d,a);p.hide();m.css("display",
a.origDisplay);"block"==a.origDisplay?(d.addClass(a.listClass),p.css("display",a.targetDisplayList)):(d.removeClass(a.listClass),p.css("display",a.targetDisplayGrid));a.resizeContainer&&l.css("height",a.origHeight+"px");c={};for(f=0;2>f;f++)j=0==f?j=a.prefix:"",c[j+"transform"]=a.scale+" "+a.rotateX+" "+a.rotateY+" "+a.rotateZ,c[j+"filter"]=a.blur+" "+a.grayscale;p.css(c);m.each(function(){var b=this.data,c=e(this);c.hasClass("mix_tohide")?(b.preTX=b.origPos.left-b.hideInterPos.left,b.preTY=b.origPos.top-
b.hideInterPos.top):(b.preTX=b.origPos.left-b.preInterPos.left,b.preTY=b.origPos.top-b.preInterPos.top);for(var d={},f=0;2>f;f++){var j=0==f?j=a.prefix:"";d[j+"transform"]="translate("+b.preTX+"px,"+b.preTY+"px)"}c.css(d)});"list"==a.layoutMode?(d.addClass(a.listClass),d.removeClass(a.gridClass)):(d.addClass(a.gridClass),d.removeClass(a.listClass));setTimeout(function(){if(a.resizeContainer){for(var b={},c=0;2>c;c++){var d=0==c?d=a.prefix:"";b[d+"transition"]="all "+h+"ms ease-in-out";b.height=a.newHeight+
"px"}l.css(b)}v.css("opacity",a.fade);p.css("opacity",1);p.each(function(){var b=this.data;b.tX=b.finalPos.left-b.showInterPos.left;b.tY=b.finalPos.top-b.showInterPos.top;for(var c={},d=0;2>d;d++){var f=0==d?f=a.prefix:"";c[f+"transition-property"]=f+"transform, "+f+"filter, opacity";c[f+"transition-timing-function"]=a.easing+", linear, linear";c[f+"transition-duration"]=h+"ms";c[f+"transition-delay"]="0";c[f+"transform"]="translate("+b.tX+"px,"+b.tY+"px)";c[f+"filter"]="none"}e(this).css("-webkit-transition",
"all "+h+"ms "+a.easingFallback).css(c)});m.each(function(){var b=this.data;b.tX=0!=b.finalPrePos.left?b.finalPrePos.left-b.preInterPos.left:0;b.tY=0!=b.finalPrePos.left?b.finalPrePos.top-b.preInterPos.top:0;for(var c={},d=0;2>d;d++){var f=0==d?f=a.prefix:"";c[f+"transition"]="all "+h+"ms "+a.easing;c[f+"transform"]="translate("+b.tX+"px,"+b.tY+"px)"}e(this).css("-webkit-transition","all "+h+"ms "+a.easingFallback).css(c)});b={};for(c=0;2>c;c++)d=0==c?d=a.prefix:"",b[d+"transition"]="all "+h+"ms "+
a.easing+", "+d+"filter "+h+"ms linear, opacity "+h+"ms linear",b[d+"transform"]=a.scale+" "+a.rotateX+" "+a.rotateY+" "+a.rotateZ,b[d+"filter"]=a.blur+" "+a.grayscale,b.opacity=a.fade;v.css(b);l.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(b){if(-1<b.originalEvent.propertyName.indexOf("transform")||-1<b.originalEvent.propertyName.indexOf("opacity"))-1<s.indexOf(".")?e(b.target).hasClass(s.replace(".",""))&&k():e(b.target).is(s)&&k()})},10);a.failsafe=setTimeout(function(){a.mixing&&
k()},h+400)}else{a.resizeContainer&&l.css("height",a.origHeight+"px");if(!window.atob)return k(),!1;v=t;setTimeout(function(){l.css(a.perspective);if(a.resizeContainer){for(var b={},c=0;2>c;c++){var e=0==c?e=a.prefix:"";b[e+"transition"]="height "+h+"ms ease-in-out";b.height=a.minHeight+"px"}l.css(b)}r.css(a.transition);if(t.length){b={};for(c=0;2>c;c++)e=0==c?e=a.prefix:"",b[e+"transform"]=a.scale+" "+a.rotateX+" "+a.rotateY+" "+a.rotateZ,b[e+"filter"]=a.blur+" "+a.grayscale,b.opacity=a.fade;v.css(b);
l.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(b){if(-1<b.originalEvent.propertyName.indexOf("transform")||-1<b.originalEvent.propertyName.indexOf("opacity"))d.addClass(a.failClass),k()})}else a.mixing=!1},10)}}function w(c,b,g,d){function a(b,a){var d=isNaN(1*b.attr(c))?b.attr(c).toLowerCase():1*b.attr(c),e=isNaN(1*a.attr(c))?a.attr(c).toLowerCase():1*a.attr(c);return d<e?-1:d>e?1:0}function k(a){"asc"==b?f.prepend(a).prepend(" "):f.append(a).append(" ")}g.find(d.targetSelector).wrapAll('<div class="mix_sorter"/>');
var f=g.find(".mix_sorter");d.origSort.length||f.find(d.targetSelector+":visible").each(function(){e(this).wrap("<s/>");d.origSort.push(e(this).parent().html().replace(/\s+/g,""));e(this).unwrap()});f.empty();if("reset"==c)e.each(d.startOrder,function(){f.append(this).append(" ")});else if("default"==c)e.each(d.origOrder,function(){k(this)});else if("random"==c){if(!d.newOrder.length){for(var h=d.startOrder.slice(),j=h.length,s=j;s--;){var r=parseInt(Math.random()*j),l=h[s];h[s]=h[r];h[r]=l}d.newOrder=
h}e.each(d.newOrder,function(){f.append(this).append(" ")})}else if("custom"==c)e.each(b,function(){k(this)});else{if("undefined"===typeof d.origOrder[0].attr(c))return console.log("No such attribute found. Terminating"),!1;d.newOrder.length||(e.each(d.origOrder,function(){d.newOrder.push(e(this))}),d.newOrder.sort(a));e.each(d.newOrder,function(){k(this)})}d.checkSort=[];f.find(d.targetSelector+":visible").each(function(b){var a=e(this);0==b&&a.attr("data-checksum","1");a.wrap("<s/>");d.checkSort.push(a.parent().html().replace(/\s+/g,
""));a.unwrap()});g.find(d.targetSelector).unwrap()}function y(c){c=c.replace(/\s{2,}/g," ");var b=c.split(" ");e.each(b,function(c){"all"==this&&(b[c]="mix_all")});""==b[0]&&b.shift();return b}var x={init:function(c){return this.each(function(){var b={targetSelector:".mix",filterSelector:".filter",sortSelector:".sort",buttonEvent:"click",effects:["fade","scale"],listEffects:null,easing:"smooth",layoutMode:"grid",targetDisplayGrid:"inline-block",targetDisplayList:"block",listClass:"",gridClass:"",
transitionSpeed:600,showOnLoad:"all",sortOnLoad:!1,multiFilter:!1,filterLogic:"or",resizeContainer:!0,minHeight:0,failClass:"fail",perspectiveDistance:"3000",perspectiveOrigin:"50% 50%",animateGridList:!0,onMixLoad:null,onMixStart:null,onMixEnd:null,container:null,origOrder:[],startOrder:[],newOrder:[],origSort:[],checkSort:[],filter:"",mixing:!1,origDisplay:"",origLayout:"",origHeight:0,newHeight:0,isTouch:!1,resetDelay:0,failsafe:null,prefix:"",easingFallback:"ease-in-out",transition:{},perspective:{},
clean:{},fade:"1",scale:"",rotateX:"",rotateY:"",rotateZ:"",blur:"",grayscale:""};c&&e.extend(b,c);this.config=b;e.support.touch="ontouchend"in document;e.support.touch&&(b.isTouch=!0,b.resetDelay=350);b.container=e(this);var g=b.container,d;a:{d=g[0];for(var a=["Webkit","Moz","O","ms"],k=0;k<a.length;k++)if(a[k]+"Transition"in d.style){d=a[k];break a}d="transition"in d.style?"":!1}b.prefix=d;b.prefix=b.prefix?"-"+b.prefix.toLowerCase()+"-":"";g.find(b.targetSelector).each(function(){b.origOrder.push(e(this))});
if(b.sortOnLoad){var f;e.isArray(b.sortOnLoad)?(d=b.sortOnLoad[0],f=b.sortOnLoad[1],e(b.sortSelector+"[data-sort="+b.sortOnLoad[0]+"][data-order="+b.sortOnLoad[1]+"]").addClass("active")):(e(b.sortSelector+"[data-sort="+b.sortOnLoad+"]").addClass("active"),d=b.sortOnLoad,b.sortOnLoad="desc");w(d,f,g,b)}for(f=0;2>f;f++)d=0==f?d=b.prefix:"",b.transition[d+"transition"]="all "+b.transitionSpeed+"ms ease-in-out",b.perspective[d+"perspective"]=b.perspectiveDistance+"px",b.perspective[d+"perspective-origin"]=
b.perspectiveOrigin;for(f=0;2>f;f++)d=0==f?d=b.prefix:"",b.clean[d+"transition"]="none";"list"==b.layoutMode?(g.addClass(b.listClass),b.origDisplay=b.targetDisplayList):(g.addClass(b.gridClass),b.origDisplay=b.targetDisplayGrid);b.origLayout=b.layoutMode;f=b.showOnLoad.split(" ");e.each(f,function(){e(b.filterSelector+'[data-filter="'+this+'"]').addClass("active")});g.find(b.targetSelector).addClass("mix_all");"all"==f[0]&&(f[0]="mix_all",b.showOnLoad="mix_all");var h=e();e.each(f,function(){h=h.add(e("."+
this))});h.each(function(){var a=e(this);"list"==b.layoutMode?a.css("display",b.targetDisplayList):a.css("display",b.targetDisplayGrid);a.css(b.transition)});setTimeout(function(){b.mixing=!0;h.css("opacity","1");setTimeout(function(){"list"==b.layoutMode?h.removeStyle(b.prefix+"transition, transition").css({display:b.targetDisplayList,opacity:1}):h.removeStyle(b.prefix+"transition, transition").css({display:b.targetDisplayGrid,opacity:1});b.mixing=!1;if("function"==typeof b.onMixLoad){var a=b.onMixLoad.call(this,
b);b=a?a:b}},b.transitionSpeed)},10);b.filter=b.showOnLoad;e(b.sortSelector).bind(b.buttonEvent,function(){if(!b.mixing){var a=e(this),c=a.attr("data-sort"),d=a.attr("data-order");if(a.hasClass("active")){if("random"!=c)return!1}else e(b.sortSelector).removeClass("active"),a.addClass("active");g.find(b.targetSelector).each(function(){b.startOrder.push(e(this))});q(b.filter,c,d,g,b)}});e(b.filterSelector).bind(b.buttonEvent,function(){if(!b.mixing){var a=e(this);if(!1==b.multiFilter)e(b.filterSelector).removeClass("active"),
a.addClass("active"),b.filter=a.attr("data-filter"),e(b.filterSelector+'[data-filter="'+b.filter+'"]').addClass("active");else{var c=a.attr("data-filter");a.hasClass("active")?(a.removeClass("active"),b.filter=b.filter.replace(RegExp("(\\s|^)"+c),"")):(a.addClass("active"),b.filter=b.filter+" "+c)}q(b.filter,null,null,g,b)}})})},toGrid:function(){return this.each(function(){var c=this.config;"grid"!=c.layoutMode&&(c.layoutMode="grid",q(c.filter,null,null,e(this),c))})},toList:function(){return this.each(function(){var c=
this.config;"list"!=c.layoutMode&&(c.layoutMode="list",q(c.filter,null,null,e(this),c))})},filter:function(c){return this.each(function(){var b=this.config;b.mixing||(e(b.filterSelector).removeClass("active"),e(b.filterSelector+'[data-filter="'+c+'"]').addClass("active"),q(c,null,null,e(this),b))})},sort:function(c){return this.each(function(){var b=this.config,g=e(this);if(!b.mixing){e(b.sortSelector).removeClass("active");if(e.isArray(c)){var d=c[0],a=c[1];e(b.sortSelector+'[data-sort="'+c[0]+'"][data-order="'+
c[1]+'"]').addClass("active")}else e(b.sortSelector+'[data-sort="'+c+'"]').addClass("active"),d=c,a="desc";g.find(b.targetSelector).each(function(){b.startOrder.push(e(this))});q(b.filter,d,a,g,b)}})},multimix:function(c){return this.each(function(){var b=this.config,g=e(this);multiOut={filter:b.filter,sort:null,order:"desc",layoutMode:b.layoutMode};e.extend(multiOut,c);b.mixing||(e(b.filterSelector).add(b.sortSelector).removeClass("active"),e(b.filterSelector+'[data-filter="'+multiOut.filter+'"]').addClass("active"),
"undefined"!==typeof multiOut.sort&&(e(b.sortSelector+'[data-sort="'+multiOut.sort+'"][data-order="'+multiOut.order+'"]').addClass("active"),g.find(b.targetSelector).each(function(){b.startOrder.push(e(this))})),b.layoutMode=multiOut.layoutMode,q(multiOut.filter,multiOut.sort,multiOut.order,g,b))})},remix:function(c){return this.each(function(){var b=this.config,g=e(this);b.origOrder=[];g.find(b.targetSelector).each(function(){var c=e(this);c.addClass("mix_all");b.origOrder.push(c)});!b.mixing&&"undefined"!==
typeof c&&(e(b.filterSelector).removeClass("active"),e(b.filterSelector+'[data-filter="'+c+'"]').addClass("active"),q(c,null,null,g,b))})}};e.fn.mixitup=function(c,b){if(x[c])return x[c].apply(this,Array.prototype.slice.call(arguments,1));if("object"===typeof c||!c)return x.init.apply(this,arguments)};e.fn.removeStyle=function(c){return this.each(function(){var b=e(this);c=c.replace(/\s+/g,"");var g=c.split(",");e.each(g,function(){var c=RegExp(this.toString()+"[^;]+;?","g");b.attr("style",function(a,
b){if(b)return b.replace(c,"")})})})}})(jQuery);





/* --- $DJAX --- */

/*
* jQuery djax
* Version: 0.122
*
* https://github.com/beezee/djax
*/
(function(e,t){"use strict";e.fn.djax=function(t,n,r){if(!history.pushState){return e(this)}var i=this,s=t,o=n&&n.length?n:[],u=r?r:e.fn.replaceWith,a=false;window.history.replaceState({url:window.location.href,title:e("title").text()},e("title").text(),window.location.href);i.clearDjaxing=function(){i.djaxing=false};i.attachClick=function(t,n){var r=e(t),s=false;e.each(o,function(e,t){if(r.attr("href").indexOf(t)!==-1){s=true}if(window.location.href.indexOf(t)!==-1){s=true}});if(s){return e(t)}n.preventDefault();if(i.djaxing){setTimeout(i.clearDjaxing,1e3);return e(t)}e(window).trigger("djaxClick",[t]);i.reqUrl=r.attr("href");i.triggered=false;i.navigate(r.attr("href"),true)};i.navigate=function(t,n){var r=e(s);i.djaxing=true;e(window).trigger("djaxLoading",[{url:t}]);var o=function(o){if(t!==i.reqUrl){i.navigate(i.reqUrl,false);return true}var a=e(o),f=e(a).find(s);if(n){window.history.pushState({url:t,title:e(a).filter("title").text()},e(a).filter("title").text(),t)}e("title").text(e(a).filter("title").text());r.each(function(){var t="#"+e(this).attr("id"),n=f.filter(t),r=e(this);e("a",n).filter(function(){return this.hostname===location.hostname}).addClass("dJAX_internal").on("click",function(e){return i.attachClick(this,e)});if(n.length){if(r.html()!==n.html()){u.call(r,n)}}else{r.remove()}});e.each(f,function(){var t=e(this),n="#"+e(this).attr("id"),r;if(!e(n).length){r=e(a).find(n).prev();if(r.length){t.insertAfter("#"+r.attr("id"))}else{t.prependTo("#"+t.parent().attr("id"))}}e("a",t).filter(function(){return this.hostname===location.hostname}).addClass("dJAX_internal").on("click",function(e){return i.attachClick(this,e)})});if(!i.triggered){e(window).trigger("djaxLoad",[{url:t,title:e(a).filter("title").text(),response:o}]);i.triggered=true;i.djaxing=false}};e.get(t,function(e){o(e)}).error(function(e){console.log("error",e);o(e["responseText"])})};e(this).find("a").filter(function(){return this.hostname===location.hostname}).addClass("dJAX_internal").on("click",function(e){return i.attachClick(this,e)});e(window).bind("popstate",function(e){i.triggered=false;if(e.originalEvent.state){i.reqUrl=e.originalEvent.state.url;i.navigate(e.originalEvent.state.url,false)}})}})(jQuery,window);





/* --- ROYALSLIDER --- */

// jquery.royalslider v9.4.92
(function(l){function t(b,f){var c,g,a=this,e=navigator.userAgent.toLowerCase();a.uid=l.rsModules.uid++;a.ns=".rs"+a.uid;var d=document.createElement("div").style,j=["webkit","Moz","ms","O"],h="",k=0;for(c=0;c<j.length;c++)g=j[c],!h&&g+"Transform"in d&&(h=g),g=g.toLowerCase(),window.requestAnimationFrame||(window.requestAnimationFrame=window[g+"RequestAnimationFrame"],window.cancelAnimationFrame=window[g+"CancelAnimationFrame"]||window[g+"CancelRequestAnimationFrame"]);window.requestAnimationFrame||
(window.requestAnimationFrame=function(a){var b=(new Date).getTime(),c=Math.max(0,16-(b-k)),d=window.setTimeout(function(){a(b+c)},c);k=b+c;return d});window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)});a.isIPAD=e.match(/(ipad)/);j=/(chrome)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||0>e.indexOf("compatible")&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)||[];c=j[1]||"";g=j[2]||"0";
j={};c&&(j[c]=!0,j.version=g);j.chrome&&(j.webkit=!0);a._a=j;a.isAndroid=-1<e.indexOf("android");a.slider=l(b);a.ev=l(a);a._b=l(document);a.st=l.extend({},l.fn.royalSlider.defaults,f);a._c=a.st.transitionSpeed;a._d=0;if(a.st.allowCSS3&&(!j.webkit||a.st.allowCSS3OnWebkit))e=h+(h?"T":"t"),a._e=e+"ransform"in d&&e+"ransition"in d,a._e&&(a._f=h+(h?"P":"p")+"erspective"in d);h=h.toLowerCase();a._g="-"+h+"-";a._h="vertical"===a.st.slidesOrientation?!1:!0;a._i=a._h?"left":"top";a._j=a._h?"width":"height";
a._k=-1;a._l="fade"===a.st.transitionType?!1:!0;a._l||(a.st.sliderDrag=!1,a._m=10);a._n="z-index:0; display:none; opacity:0;";a._o=0;a._p=0;a._q=0;l.each(l.rsModules,function(b,c){"uid"!==b&&c.call(a)});a.slides=[];a._r=0;(a.st.slides?l(a.st.slides):a.slider.children().detach()).each(function(){a._s(this,!0)});a.st.randomizeSlides&&a.slides.sort(function(){return 0.5-Math.random()});a.numSlides=a.slides.length;a._t();a.st.startSlideId?a.st.startSlideId>a.numSlides-1&&(a.st.startSlideId=a.numSlides-
1):a.st.startSlideId=0;a._o=a.staticSlideId=a.currSlideId=a._u=a.st.startSlideId;a.currSlide=a.slides[a.currSlideId];a._v=0;a.msTouch=!1;a.slider.addClass((a._h?"rsHor":"rsVer")+(a._l?"":" rsFade"));d='<div class="rsOverflow"><div class="rsContainer">';a.slidesSpacing=a.st.slidesSpacing;a._w=(a._h?a.slider.width():a.slider.height())+a.st.slidesSpacing;a._x=Boolean(0<a._y);1>=a.numSlides&&(a._z=!1);a._a1=a._z&&a._l?2===a.numSlides?1:2:0;a._b1=6>a.numSlides?a.numSlides:6;a._c1=0;a._d1=0;a.slidesJQ=
[];for(c=0;c<a.numSlides;c++)a.slidesJQ.push(l('<div style="'+(a._l?"":c!==a.currSlideId?a._n:"z-index:0;")+'" class="rsSlide "></div>'));a._e1=d=l(d+"</div></div>");h=a.ns;a.msEnabled=window.navigator.msPointerEnabled;a.msEnabled?(a.msTouch=Boolean(1<window.navigator.msMaxTouchPoints),a.hasTouch=!1,a._n1=0.2,a._j1="MSPointerDown"+h,a._k1="MSPointerMove"+h,a._l1="MSPointerUp"+h,a._m1="MSPointerCancel"+h):(a._j1="mousedown"+h,a._k1="mousemove"+h,a._l1="mouseup"+h,a._m1="mouseup"+h,"ontouchstart"in
window||"createTouch"in document?(a.hasTouch=!0,a._j1+=" touchstart"+h,a._k1+=" touchmove"+h,a._l1+=" touchend"+h,a._m1+=" touchcancel"+h,a._n1=0.5,a.st.sliderTouch&&(a._f1=!0)):(a.hasTouch=!1,a._n1=0.2));a.st.sliderDrag&&(a._f1=!0,j.msie||j.opera?a._g1=a._h1="move":j.mozilla?(a._g1="-moz-grab",a._h1="-moz-grabbing"):j.webkit&&-1!=navigator.platform.indexOf("Mac")&&(a._g1="-webkit-grab",a._h1="-webkit-grabbing"),a._i1());a.slider.html(d);a._o1=a.st.controlsInside?a._e1:a.slider;a._p1=a._e1.children(".rsContainer");
a.msEnabled&&a._p1.css("-ms-touch-action",a._h?"pan-y":"pan-x");a._q1=l('<div class="rsPreloader"></div>');d=a._p1.children(".rsSlide");a._r1=a.slidesJQ[a.currSlideId];a._s1=0;a._e?(a._t1="transition-property",a._u1="transition-duration",a._v1="transition-timing-function",a._w1=a._x1=a._g+"transform",a._f?(j.webkit&&!j.chrome&&a.slider.addClass("rsWebkit3d"),/iphone|ipad|ipod/gi.test(navigator.appVersion),a._y1="translate3d(",a._z1="px, ",a._a2="px, 0px)"):(a._y1="translate(",a._z1="px, ",a._a2="px)"),
a._l?a._p1[a._g+a._t1]=a._g+"transform":(h={},h[a._g+a._t1]="opacity",h[a._g+a._u1]=a.st.transitionSpeed+"ms",h[a._g+a._v1]=a.st.css3easeInOut,d.css(h))):(a._x1="left",a._w1="top");var n;l(window).on("resize"+a.ns,function(){n&&clearTimeout(n);n=setTimeout(function(){a.updateSliderSize()},50)});a.ev.trigger("rsAfterPropsSetup");a.updateSliderSize();a.st.keyboardNavEnabled&&a._b2();if(a.st.arrowsNavHideOnTouch&&(a.hasTouch||a.msTouch))a.st.arrowsNav=!1;a.st.arrowsNav&&(d=a._o1,l('<div class="rsArrow rsArrowLeft"><div class="rsArrowIcn"></div></div><div class="rsArrow rsArrowRight"><div class="rsArrowIcn"></div></div>').appendTo(d),
a._c2=d.children(".rsArrowLeft").click(function(b){b.preventDefault();a.prev()}),a._d2=d.children(".rsArrowRight").click(function(b){b.preventDefault();a.next()}),a.st.arrowsNavAutoHide&&!a.hasTouch&&(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"),d.one("mousemove.arrowshover",function(){a._c2.removeClass("rsHidden");a._d2.removeClass("rsHidden")}),d.hover(function(){a._e2||(a._c2.removeClass("rsHidden"),a._d2.removeClass("rsHidden"))},function(){a._e2||(a._c2.addClass("rsHidden"),a._d2.addClass("rsHidden"))})),
a.ev.on("rsOnUpdateNav",function(){a._f2()}),a._f2());if(a._f1)a._p1.on(a._j1,function(b){a._g2(b)});else a.dragSuccess=!1;var m=["rsPlayBtnIcon","rsPlayBtn","rsCloseVideoBtn","rsCloseVideoIcn"];a._p1.click(function(b){if(!a.dragSuccess){var c=l(b.target).attr("class");if(-1!==l.inArray(c,m)&&a.toggleVideo())return!1;if(a.st.navigateByClick&&!a._h2){if(l(b.target).closest(".rsNoDrag",a._r1).length)return!0;a._i2(b)}a.ev.trigger("rsSlideClick")}}).on("click.rs","a",function(){if(a.dragSuccess)return!1;
a._h2=!0;setTimeout(function(){a._h2=!1},3)});a.ev.trigger("rsAfterInit")}l.rsModules||(l.rsModules={uid:0});t.prototype={constructor:t,_i2:function(b){b=b[this._h?"pageX":"pageY"]-this._j2;b>=this._q?this.next():0>b&&this.prev()},_t:function(){var b;b=this.st.numImagesToPreload;if(this._z=this.st.loop)2===this.numSlides?(this._z=!1,this.st.loopRewind=!0):2>this.numSlides&&(this.st.loopRewind=this._z=!1);this._z&&0<b&&(4>=this.numSlides?b=1:this.st.numImagesToPreload>(this.numSlides-1)/2&&(b=Math.floor((this.numSlides-
1)/2)));this._y=b},_s:function(b,f){function c(a,b){b?e.images.push(a.attr(b)):e.images.push(a.text());if(j){j=!1;e.caption="src"===b?a.attr("alt"):a.contents();e.image=e.images[0];e.videoURL=a.attr("data-rsVideo");var c=a.attr("data-rsw"),d=a.attr("data-rsh");"undefined"!==typeof c&&!1!==c&&"undefined"!==typeof d&&!1!==d?(e.iW=parseInt(c,10),e.iH=parseInt(d,10)):g.st.imgWidth&&g.st.imgHeight&&(e.iW=g.st.imgWidth,e.iH=g.st.imgHeight)}}var g=this,a,e={},d,j=!0;b=l(b);g._k2=b;g.ev.trigger("rsBeforeParseNode",
[b,e]);if(!e.stopParsing)return b=g._k2,e.id=g._r,e.contentAdded=!1,g._r++,e.images=[],e.isBig=!1,e.hasCover||(b.hasClass("rsImg")?(d=b,a=!0):(d=b.find(".rsImg"),d.length&&(a=!0)),a?(e.bigImage=d.eq(0).attr("data-rsBigImg"),d.each(function(){var a=l(this);a.is("a")?c(a,"href"):a.is("img")?c(a,"src"):c(a)})):b.is("img")&&(b.addClass("rsImg rsMainSlideImage"),c(b,"src"))),d=b.find(".rsCaption"),d.length&&(e.caption=d.remove()),e.content=b,g.ev.trigger("rsAfterParseNode",[b,e]),f&&g.slides.push(e),0===
e.images.length&&(e.isLoaded=!0,e.isRendered=!1,e.isLoading=!1,e.images=null),e},_b2:function(){var b=this,f,c,g=function(a){37===a?b.prev():39===a&&b.next()};b._b.on("keydown"+b.ns,function(a){if(!b._l2&&(c=a.keyCode,(37===c||39===c)&&!f))g(c),f=setInterval(function(){g(c)},700)}).on("keyup"+b.ns,function(){f&&(clearInterval(f),f=null)})},goTo:function(b,f){b!==this.currSlideId&&this._m2(b,this.st.transitionSpeed,!0,!f)},destroy:function(b){this.ev.trigger("rsBeforeDestroy");this._b.off("keydown"+
this.ns+" keyup"+this.ns+" "+this._k1+" "+this._l1);this._p1.off(this._j1+" click");this.slider.data("royalSlider",null);l.removeData(this.slider,"royalSlider");l(window).off("resize"+this.ns);b&&this.slider.remove();this.ev=this.slider=this.slides=null},_n2:function(b,f){function c(c,e,f){c.isAdded?(g(e,c),a(e,c)):(f||(f=d.slidesJQ[e]),c.holder?f=c.holder:(f=d.slidesJQ[e]=l(f),c.holder=f),c.appendOnLoaded=!1,a(e,c,f),g(e,c),d._p2(c,f,b),c.isAdded=!0)}function g(a,c){c.contentAdded||(d.setItemHtml(c,
b),b||(c.contentAdded=!0))}function a(a,b,c){d._l&&(c||(c=d.slidesJQ[a]),c.css(d._i,(a+d._d1+p)*d._w))}function e(a){if(k){if(a>n-1)return e(a-n);if(0>a)return e(n+a)}return a}var d=this,j,h,k=d._z,n=d.numSlides;if(!isNaN(f))return e(f);var m=d.currSlideId,p,q=b?Math.abs(d._o2-d.currSlideId)>=d.numSlides-1?0:1:d._y,r=Math.min(2,q),u=!1,t=!1,s;for(h=m;h<m+1+r;h++)if(s=e(h),(j=d.slides[s])&&(!j.isAdded||!j.positionSet)){u=!0;break}for(h=m-1;h>m-1-r;h--)if(s=e(h),(j=d.slides[s])&&(!j.isAdded||!j.positionSet)){t=
!0;break}if(u)for(h=m;h<m+q+1;h++)s=e(h),p=Math.floor((d._u-(m-h))/d.numSlides)*d.numSlides,(j=d.slides[s])&&c(j,s);if(t)for(h=m-1;h>m-1-q;h--)s=e(h),p=Math.floor((d._u-(m-h))/n)*n,(j=d.slides[s])&&c(j,s);if(!b){r=e(m-q);m=e(m+q);q=r>m?0:r;for(h=0;h<n;h++)if(!(r>m&&h>r-1)&&(h<q||h>m))if((j=d.slides[h])&&j.holder)j.holder.detach(),j.isAdded=!1}},setItemHtml:function(b,f){var c=this,g=function(){if(b.images){if(!b.isLoading){var e,f;b.content.hasClass("rsImg")?(e=b.content,f=!0):e=b.content.find(".rsImg:not(img)");
e&&!e.is("img")&&e.each(function(){var a=l(this),c='<img class="rsImg" src="'+(a.is("a")?a.attr("href"):a.text())+'" />';f?b.content=l(c):a.replaceWith(c)});e=f?b.content:b.content.find("img.rsImg");h();e.eq(0).addClass("rsMainSlideImage");b.iW&&b.iH&&(b.isLoaded||c._q2(b),d());b.isLoading=!0;if(b.isBig)l("<img />").on("load.rs error.rs",function(){l(this).off("load.rs error.rs");a([this],!0)}).attr("src",b.image);else{b.loaded=[];b.numStartedLoad=0;e=function(){l(this).off("load.rs error.rs");b.loaded.push(this);
b.loaded.length===b.numStartedLoad&&a(b.loaded,!1)};for(var g=0;g<b.images.length;g++){var j=l("<img />");b.numStartedLoad++;j.on("load.rs error.rs",e).attr("src",b.images[g])}}}}else b.isRendered=!0,b.isLoaded=!0,b.isLoading=!1,d(!0)},a=function(a,c){if(a.length){var d=a[0];if(c!==b.isBig)(d=b.holder.children())&&1<d.length&&k();else if(b.iW&&b.iH)e();else if(b.iW=d.width,b.iH=d.height,b.iW&&b.iH)e();else{var f=new Image;f.onload=function(){f.width?(b.iW=f.width,b.iH=f.height,e()):setTimeout(function(){f.width&&
(b.iW=f.width,b.iH=f.height);e()},1E3)};f.src=d.src}}else e()},e=function(){b.isLoaded=!0;b.isLoading=!1;d();k();j()},d=function(){if(!b.isAppended&&c.ev){var a=c.st.visibleNearby,d=b.id-c._o;if(!f&&!b.appendOnLoaded&&c.st.fadeinLoadedSlide&&(0===d||(a||c._r2||c._l2)&&(-1===d||1===d)))a={visibility:"visible",opacity:0},a[c._g+"transition"]="opacity 400ms ease-in-out",b.content.css(a),setTimeout(function(){b.content.css("opacity",1)},16);b.holder.find(".rsPreloader").length?b.holder.append(b.content):
b.holder.html(b.content);b.isAppended=!0;b.isLoaded&&(c._q2(b),j());b.sizeReady||(b.sizeReady=!0,setTimeout(function(){c.ev.trigger("rsMaybeSizeReady",b)},100))}},j=function(){!b.loadedTriggered&&c.ev&&(b.isLoaded=b.loadedTriggered=!0,b.holder.trigger("rsAfterContentSet"),c.ev.trigger("rsAfterContentSet",b))},h=function(){c.st.usePreloader&&b.holder.html(c._q1.clone())},k=function(){if(c.st.usePreloader){var a=b.holder.find(".rsPreloader");a.length&&a.remove()}};b.isLoaded?d():f?!c._l&&b.images&&
b.iW&&b.iH?g():(b.holder.isWaiting=!0,h(),b.holder.slideId=-99):g()},_p2:function(b){this._p1.append(b.holder);b.appendOnLoaded=!1},_g2:function(b,f){var c=this,g,a="touchstart"===b.type;c._s2=a;c.ev.trigger("rsDragStart");if(l(b.target).closest(".rsNoDrag",c._r1).length)return c.dragSuccess=!1,!0;!f&&c._r2&&(c._t2=!0,c._u2());c.dragSuccess=!1;if(c._l2)a&&(c._v2=!0);else{a&&(c._v2=!1);c._w2();if(a){var e=b.originalEvent.touches;if(e&&0<e.length)g=e[0],1<e.length&&(c._v2=!0);else return}else b.preventDefault(),
g=b,c.msEnabled&&(g=g.originalEvent);c._l2=!0;c._b.on(c._k1,function(a){c._x2(a,f)}).on(c._l1,function(a){c._y2(a,f)});c._z2="";c._a3=!1;c._b3=g.pageX;c._c3=g.pageY;c._d3=c._v=(!f?c._h:c._e3)?g.pageX:g.pageY;c._f3=0;c._g3=0;c._h3=!f?c._p:c._i3;c._j3=(new Date).getTime();if(a)c._e1.on(c._m1,function(a){c._y2(a,f)})}},_k3:function(b,f){if(this._l3){var c=this._m3,g=b.pageX-this._b3,a=b.pageY-this._c3,e=this._h3+g,d=this._h3+a,j=!f?this._h:this._e3,e=j?e:d,d=this._z2;this._a3=!0;this._b3=b.pageX;this._c3=
b.pageY;"x"===d&&0!==g?this._f3=0<g?1:-1:"y"===d&&0!==a&&(this._g3=0<a?1:-1);d=j?this._b3:this._c3;g=j?g:a;f?e>this._n3?e=this._h3+g*this._n1:e<this._o3&&(e=this._h3+g*this._n1):this._z||(0>=this.currSlideId&&0<d-this._d3&&(e=this._h3+g*this._n1),this.currSlideId>=this.numSlides-1&&0>d-this._d3&&(e=this._h3+g*this._n1));this._h3=e;200<c-this._j3&&(this._j3=c,this._v=d);f?this._q3(this._h3):this._l&&this._p3(this._h3)}},_x2:function(b,f){var c=this,g,a="touchmove"===b.type;if(!c._s2||a){if(a){if(c._r3)return;
var e=b.originalEvent.touches;if(e){if(1<e.length)return;g=e[0]}else return}else g=b,c.msEnabled&&(g=g.originalEvent);c._a3||(c._e&&(!f?c._p1:c._s3).css(c._g+c._u1,"0s"),function j(){c._l2&&(c._t3=requestAnimationFrame(j),c._u3&&c._k3(c._u3,f))}());if(c._l3)b.preventDefault(),c._m3=(new Date).getTime(),c._u3=g;else if(e=!f?c._h:c._e3,g=Math.abs(g.pageX-c._b3)-Math.abs(g.pageY-c._c3)-(e?-7:7),7<g){if(e)b.preventDefault(),c._z2="x";else if(a){c._v3();return}c._l3=!0}else if(-7>g){if(e){if(a){c._v3();
return}}else b.preventDefault(),c._z2="y";c._l3=!0}}},_v3:function(){this._r3=!0;this._a3=this._l2=!1;this._y2()},_y2:function(b,f){function c(a){return 100>a?100:500<a?500:a}function g(b,d){if(a._l||f)j=(-a._u-a._d1)*a._w,h=Math.abs(a._p-j),a._c=h/d,b&&(a._c+=250),a._c=c(a._c),a._x3(j,!1)}var a=this,e,d,j,h;d="touchend"===b.type||"touchcancel"===b.type;if(!a._s2||d)if(a._s2=!1,a.ev.trigger("rsDragRelease"),a._u3=null,a._l2=!1,a._r3=!1,a._l3=!1,a._m3=0,cancelAnimationFrame(a._t3),a._a3&&(f?a._q3(a._h3):
a._l&&a._p3(a._h3)),a._b.off(a._k1).off(a._l1),d&&a._e1.off(a._m1),a._i1(),!a._a3&&!a._v2&&f&&a._w3){var k=l(b.target).closest(".rsNavItem");k.length&&a.goTo(k.index())}else{e=!f?a._h:a._e3;if(!a._a3||"y"===a._z2&&e||"x"===a._z2&&!e)if(!f&&a._t2){a._t2=!1;if(a.st.navigateByClick){a._i2(a.msEnabled?b.originalEvent:b);a.dragSuccess=!0;return}a.dragSuccess=!0}else{a._t2=!1;a.dragSuccess=!1;return}else a.dragSuccess=!0;a._t2=!1;a._z2="";var n=a.st.minSlideOffset;d=d?b.originalEvent.changedTouches[0]:
a.msEnabled?b.originalEvent:b;var m=e?d.pageX:d.pageY,p=a._d3;d=a._v;var q=a.currSlideId,r=a.numSlides,u=e?a._f3:a._g3,t=a._z;Math.abs(m-p);e=m-d;d=(new Date).getTime()-a._j3;d=Math.abs(e)/d;if(0===u||1>=r)g(!0,d);else{if(!t&&!f)if(0>=q){if(0<u){g(!0,d);return}}else if(q>=r-1&&0>u){g(!0,d);return}if(f){j=a._i3;if(j>a._n3)j=a._n3;else if(j<a._o3)j=a._o3;else{n=d*d/0.006;k=-a._i3;m=a._y3-a._z3+a._i3;0<e&&n>k?(k+=a._z3/(15/(0.003*(n/d))),d=d*k/n,n=k):0>e&&n>m&&(m+=a._z3/(15/(0.003*(n/d))),d=d*m/n,n=
m);k=Math.max(Math.round(d/0.003),50);j+=n*(0>e?-1:1);if(j>a._n3){a._a4(j,k,!0,a._n3,200);return}if(j<a._o3){a._a4(j,k,!0,a._o3,200);return}}a._a4(j,k,!0)}else p+n<m?0>u?g(!1,d):a._m2("prev",c(Math.abs(a._p-(-a._u-a._d1+1)*a._w)/d),!1,!0,!0):p-n>m?0<u?g(!1,d):a._m2("next",c(Math.abs(a._p-(-a._u-a._d1-1)*a._w)/d),!1,!0,!0):g(!1,d)}}},_p3:function(b){b=this._p=b;this._e?this._p1.css(this._x1,this._y1+(this._h?b+this._z1+0:0+this._z1+b)+this._a2):this._p1.css(this._h?this._x1:this._w1,b)},updateSliderSize:function(b){var f,
c;if(this.st.autoScaleSlider){var g=this.st.autoScaleSliderWidth,a=this.st.autoScaleSliderHeight;this.st.autoScaleHeight?(f=this.slider.width(),f!=this.width&&(this.slider.css("height",f*(a/g)),f=this.slider.width()),c=this.slider.height()):(c=this.slider.height(),c!=this.height&&(this.slider.css("width",c*(g/a)),c=this.slider.height()),f=this.slider.width())}else f=this.slider.width(),c=this.slider.height();if(b||f!=this.width||c!=this.height){this.width=f;this.height=c;this._b4=f;this._c4=c;this.ev.trigger("rsBeforeSizeSet");
this.ev.trigger("rsAfterSizePropSet");this._e1.css({width:this._b4,height:this._c4});this._w=(this._h?this._b4:this._c4)+this.st.slidesSpacing;this._d4=this.st.imageScalePadding;for(f=0;f<this.slides.length;f++)b=this.slides[f],b.positionSet=!1,b&&(b.images&&b.isLoaded)&&(b.isRendered=!1,this._q2(b));if(this._e4)for(f=0;f<this._e4.length;f++)b=this._e4[f],b.holder.css(this._i,(b.id+this._d1)*this._w);this._n2();this._l&&(this._e&&this._p1.css(this._g+"transition-duration","0s"),this._p3((-this._u-
this._d1)*this._w));this.ev.trigger("rsOnUpdateNav")}this._j2=this._e1.offset();this._j2=this._j2[this._i]},appendSlide:function(b,f){var c=this._s(b);if(isNaN(f)||f>this.numSlides)f=this.numSlides;this.slides.splice(f,0,c);this.slidesJQ.splice(f,0,'<div style="'+(this._l?"position:absolute;":this._n)+'" class="rsSlide"></div>');f<this.currSlideId&&this.currSlideId++;this.ev.trigger("rsOnAppendSlide",[c,f]);this._f4(f);f===this.currSlideId&&this.ev.trigger("rsAfterSlideChange")},removeSlide:function(b){var f=
this.slides[b];f&&(f.holder&&f.holder.remove(),b<this.currSlideId&&this.currSlideId--,this.slides.splice(b,1),this.slidesJQ.splice(b,1),this.ev.trigger("rsOnRemoveSlide",[b]),this._f4(b),b===this.currSlideId&&this.ev.trigger("rsAfterSlideChange"))},_f4:function(){var b=this,f=b.numSlides,f=0>=b._u?0:Math.floor(b._u/f);b.numSlides=b.slides.length;0===b.numSlides?(b.currSlideId=b._d1=b._u=0,b.currSlide=b._g4=null):b._u=f*b.numSlides+b.currSlideId;for(f=0;f<b.numSlides;f++)b.slides[f].id=f;b.currSlide=
b.slides[b.currSlideId];b._r1=b.slidesJQ[b.currSlideId];b.currSlideId>=b.numSlides?b.goTo(b.numSlides-1):0>b.currSlideId&&b.goTo(0);b._t();b._l&&b._z&&b._p1.css(b._g+b._u1,"0ms");b._h4&&clearTimeout(b._h4);b._h4=setTimeout(function(){b._l&&b._p3((-b._u-b._d1)*b._w);b._n2();b._l||b._r1.css({display:"block",opacity:1})},14);b.ev.trigger("rsOnUpdateNav")},_i1:function(){this._f1&&this._l&&(this._g1?this._e1.css("cursor",this._g1):(this._e1.removeClass("grabbing-cursor"),this._e1.addClass("grab-cursor")))},
_w2:function(){this._f1&&this._l&&(this._h1?this._e1.css("cursor",this._h1):(this._e1.removeClass("grab-cursor"),this._e1.addClass("grabbing-cursor")))},next:function(b){this._m2("next",this.st.transitionSpeed,!0,!b)},prev:function(b){this._m2("prev",this.st.transitionSpeed,!0,!b)},_m2:function(b,f,c,g,a){var e=this,d,j,h;e.ev.trigger("rsBeforeMove",[b,g]);h="next"===b?e.currSlideId+1:"prev"===b?e.currSlideId-1:b=parseInt(b,10);if(!e._z){if(0>h){e._i4("left",!g);return}if(h>=e.numSlides){e._i4("right",
!g);return}}e._r2&&(e._u2(!0),c=!1);j=h-e.currSlideId;h=e._o2=e.currSlideId;var k=e.currSlideId+j;g=e._u;var l;e._z?(k=e._n2(!1,k),g+=j):g=k;e._o=k;e._g4=e.slidesJQ[e.currSlideId];e._u=g;e.currSlideId=e._o;e.currSlide=e.slides[e.currSlideId];e._r1=e.slidesJQ[e.currSlideId];var k=e.st.slidesDiff,m=Boolean(0<j);j=Math.abs(j);var p=Math.floor(h/e._y),q=Math.floor((h+(m?k:-k))/e._y),p=(m?Math.max(p,q):Math.min(p,q))*e._y+(m?e._y-1:0);p>e.numSlides-1?p=e.numSlides-1:0>p&&(p=0);h=m?p-h:h-p;h>e._y&&(h=e._y);
if(j>h+k){e._d1+=(j-(h+k))*(m?-1:1);f*=1.4;for(h=0;h<e.numSlides;h++)e.slides[h].positionSet=!1}e._c=f;e._n2(!0);a||(l=!0);d=(-g-e._d1)*e._w;l?setTimeout(function(){e._j4=!1;e._x3(d,b,!1,c);e.ev.trigger("rsOnUpdateNav")},0):(e._x3(d,b,!1,c),e.ev.trigger("rsOnUpdateNav"))},_f2:function(){this.st.arrowsNav&&(1>=this.numSlides?(this._c2.css("display","none"),this._d2.css("display","none")):(this._c2.css("display","block"),this._d2.css("display","block"),!this._z&&!this.st.loopRewind&&(0===this.currSlideId?
this._c2.addClass("rsArrowDisabled"):this._c2.removeClass("rsArrowDisabled"),this.currSlideId===this.numSlides-1?this._d2.addClass("rsArrowDisabled"):this._d2.removeClass("rsArrowDisabled"))))},_x3:function(b,f,c,g,a){function e(){var a;if(j&&(a=j.data("rsTimeout")))j!==h&&j.css({opacity:0,display:"none",zIndex:0}),clearTimeout(a),j.data("rsTimeout","");if(a=h.data("rsTimeout"))clearTimeout(a),h.data("rsTimeout","")}var d=this,j,h,k={};isNaN(d._c)&&(d._c=400);d._p=d._h3=b;d.ev.trigger("rsBeforeAnimStart");
d._e?d._l?(d._c=parseInt(d._c,10),c=d._g+d._v1,k[d._g+d._u1]=d._c+"ms",k[c]=g?l.rsCSS3Easing[d.st.easeInOut]:l.rsCSS3Easing[d.st.easeOut],d._p1.css(k),g||!d.hasTouch?setTimeout(function(){d._p3(b)},5):d._p3(b)):(d._c=d.st.transitionSpeed,j=d._g4,h=d._r1,h.data("rsTimeout")&&h.css("opacity",0),e(),j&&j.data("rsTimeout",setTimeout(function(){k[d._g+d._u1]="0ms";k.zIndex=0;k.display="none";j.data("rsTimeout","");j.css(k);setTimeout(function(){j.css("opacity",0)},16)},d._c+60)),k.display="block",k.zIndex=
d._m,k.opacity=0,k[d._g+d._u1]="0ms",k[d._g+d._v1]=l.rsCSS3Easing[d.st.easeInOut],h.css(k),h.data("rsTimeout",setTimeout(function(){h.css(d._g+d._u1,d._c+"ms");h.data("rsTimeout",setTimeout(function(){h.css("opacity",1);h.data("rsTimeout","")},20))},20))):d._l?(k[d._h?d._x1:d._w1]=b+"px",d._p1.animate(k,d._c,g?d.st.easeInOut:d.st.easeOut)):(j=d._g4,h=d._r1,h.stop(!0,!0).css({opacity:0,display:"block",zIndex:d._m}),d._c=d.st.transitionSpeed,h.animate({opacity:1},d._c,d.st.easeInOut),e(),j&&j.data("rsTimeout",
setTimeout(function(){j.stop(!0,!0).css({opacity:0,display:"none",zIndex:0})},d._c+60)));d._r2=!0;d.loadingTimeout&&clearTimeout(d.loadingTimeout);d.loadingTimeout=a?setTimeout(function(){d.loadingTimeout=null;a.call()},d._c+60):setTimeout(function(){d.loadingTimeout=null;d._k4(f)},d._c+60)},_u2:function(b){this._r2=!1;clearTimeout(this.loadingTimeout);if(this._l)if(this._e){if(!b){b=this._p;var f=this._h3=this._l4();this._p1.css(this._g+this._u1,"0ms");b!==f&&this._p3(f)}}else this._p1.stop(!0),
this._p=parseInt(this._p1.css(this._x1),10);else 20<this._m?this._m=10:this._m++},_l4:function(){var b=window.getComputedStyle(this._p1.get(0),null).getPropertyValue(this._g+"transform").replace(/^matrix\(/i,"").split(/, |\)$/g),f=0===b[0].indexOf("matrix3d");return parseInt(b[this._h?f?12:4:f?13:5],10)},_m4:function(b,f){return this._e?this._y1+(f?b+this._z1+0:0+this._z1+b)+this._a2:b},_k4:function(){this._l||(this._r1.css("z-index",0),this._m=10);this._r2=!1;this.staticSlideId=this.currSlideId;
this._n2();this._n4=!1;this.ev.trigger("rsAfterSlideChange")},_i4:function(b,f){var c=this,g=(-c._u-c._d1)*c._w;if(!(0===c.numSlides||c._r2))if(c.st.loopRewind)c.goTo("left"===b?c.numSlides-1:0,f);else if(c._l){c._c=200;var a=function(){c._r2=!1};c._x3(g+("left"===b?30:-30),"",!1,!0,function(){c._r2=!1;c._x3(g,"",!1,!0,a)})}},_q2:function(b){if(!b.isRendered){var f=b.content,c="rsMainSlideImage",g,a=this.st.imageAlignCenter,e=this.st.imageScaleMode,d;b.videoURL&&(c="rsVideoContainer","fill"!==e?g=
!0:(d=f,d.hasClass(c)||(d=d.find("."+c)),d.css({width:"100%",height:"100%"}),c="rsMainSlideImage"));f.hasClass(c)||(f=f.find("."+c));if(f){var j=b.iW,c=b.iH;b.isRendered=!0;if("none"!==e||a){b="fill"!==e?this._d4:0;d=this._b4-2*b;var h=this._c4-2*b,k,l,m={};if("fit-if-smaller"===e&&(j>d||c>h))e="fit";if("fill"===e||"fit"===e)k=d/j,l=h/c,k="fill"==e?k>l?k:l:"fit"==e?k<l?k:l:1,j=Math.ceil(j*k,10),c=Math.ceil(c*k,10);"none"!==e&&(m.width=j,m.height=c,g&&f.find(".rsImg").css({width:"100%",height:"100%"}));
a&&(m.marginLeft=Math.floor((d-j)/2)+b,m.marginTop=Math.floor((h-c)/2)+b);f.css(m)}}}}};l.rsProto=t.prototype;l.fn.royalSlider=function(b){var f=arguments;return this.each(function(){var c=l(this);if("object"===typeof b||!b)c.data("royalSlider")||c.data("royalSlider",new t(c,b));else if((c=c.data("royalSlider"))&&c[b])return c[b].apply(c,Array.prototype.slice.call(f,1))})};l.fn.royalSlider.defaults={slidesSpacing:8,startSlideId:0,loop:!1,loopRewind:!1,numImagesToPreload:4,fadeinLoadedSlide:!0,slidesOrientation:"horizontal",
transitionType:"move",transitionSpeed:600,controlNavigation:"bullets",controlsInside:!0,arrowsNav:!0,arrowsNavAutoHide:!0,navigateByClick:!0,randomizeSlides:!1,sliderDrag:!0,sliderTouch:!0,keyboardNavEnabled:!1,fadeInAfterLoaded:!0,allowCSS3:!0,allowCSS3OnWebkit:!0,addActiveClass:!1,autoHeight:!1,easeOut:"easeOutSine",easeInOut:"easeInOutSine",minSlideOffset:10,imageScaleMode:"fit-if-smaller",imageAlignCenter:!0,imageScalePadding:4,usePreloader:!0,autoScaleSlider:!1,autoScaleSliderWidth:800,autoScaleSliderHeight:400,
autoScaleHeight:!0,arrowsNavHideOnTouch:!1,globalCaption:!1,slidesDiff:2};l.rsCSS3Easing={easeOutSine:"cubic-bezier(0.390, 0.575, 0.565, 1.000)",easeInOutSine:"cubic-bezier(0.445, 0.050, 0.550, 0.950)"};l.extend(jQuery.easing,{easeInOutSine:function(b,f,c,g,a){return-g/2*(Math.cos(Math.PI*f/a)-1)+c},easeOutSine:function(b,f,c,g,a){return g*Math.sin(f/a*(Math.PI/2))+c},easeOutCubic:function(b,f,c,g,a){return g*((f=f/a-1)*f*f+1)+c}})})(jQuery,window);
// jquery.rs.active-class v1.0.1
(function(c){c.rsProto._o4=function(){var b,a=this;if(a.st.addActiveClass)a.ev.on("rsOnUpdateNav",function(){b&&clearTimeout(b);b=setTimeout(function(){a._g4&&a._g4.removeClass("rsActiveSlide");a._r1&&a._r1.addClass("rsActiveSlide");b=null},50)})};c.rsModules.activeClass=c.rsProto._o4})(jQuery);
// jquery.rs.animated-blocks v1.0.7
(function(j){j.extend(j.rsProto,{_p4:function(){function l(){var g=a.currSlide;if(a.currSlide&&a.currSlide.isLoaded&&a._t4!==g){if(0<a._s4.length){for(b=0;b<a._s4.length;b++)clearTimeout(a._s4[b]);a._s4=[]}if(0<a._r4.length){var f;for(b=0;b<a._r4.length;b++)if(f=a._r4[b])a._e?(f.block.css(a._g+a._u1,"0s"),f.block.css(f.css)):f.block.stop(!0).css(f.css),a._t4=null,g.animBlocksDisplayed=!1;a._r4=[]}g.animBlocks&&(g.animBlocksDisplayed=!0,a._t4=g,a._u4(g.animBlocks))}}var a=this,b;a._q4={fadeEffect:!0,
moveEffect:"top",moveOffset:20,speed:400,easing:"easeOutSine",delay:200};a.st.block=j.extend({},a._q4,a.st.block);a._r4=[];a._s4=[];a.ev.on("rsAfterInit",function(){l()});a.ev.on("rsBeforeParseNode",function(a,b,d){b=j(b);d.animBlocks=b.find(".rsABlock").css("display","none");d.animBlocks.length||(d.animBlocks=b.hasClass("rsABlock")?b.css("display","none"):!1)});a.ev.on("rsAfterContentSet",function(b,f){f.id===a.slides[a.currSlideId].id&&setTimeout(function(){l()},a.st.fadeinLoadedSlide?300:0)});
a.ev.on("rsAfterSlideChange",function(){l()})},_v4:function(j,a){setTimeout(function(){j.css(a)},6)},_u4:function(l){var a=this,b,g,f,d,h,e,m;a._s4=[];l.each(function(l){b=j(this);g={};f={};d=null;var c=b.attr("data-move-offset"),c=c?parseInt(c,10):a.st.block.moveOffset;if(0<c&&((e=b.data("move-effect"))?(e=e.toLowerCase(),"none"===e?e=!1:"left"!==e&&("top"!==e&&"bottom"!==e&&"right"!==e)&&(e=a.st.block.moveEffect,"none"===e&&(e=!1))):e=a.st.block.moveEffect,e&&"none"!==e)){var n;n="right"===e||"left"===
e?!0:!1;var k;m=!1;a._e?(k=0,h=a._x1):(n?isNaN(parseInt(b.css("right"),10))?h="left":(h="right",m=!0):isNaN(parseInt(b.css("bottom"),10))?h="top":(h="bottom",m=!0),h="margin-"+h,m&&(c=-c),a._e?k=parseInt(b.css(h),10):(k=b.data("rs-start-move-prop"),void 0===k&&(k=parseInt(b.css(h),10),b.data("rs-start-move-prop",k))));f[h]=a._m4("top"===e||"left"===e?k-c:k+c,n);g[h]=a._m4(k,n)}if(c=b.attr("data-fade-effect")){if("none"===c.toLowerCase()||"false"===c.toLowerCase())c=!1}else c=a.st.block.fadeEffect;
c&&(f.opacity=0,g.opacity=1);if(c||e)d={},d.hasFade=Boolean(c),Boolean(e)&&(d.moveProp=h,d.hasMove=!0),d.speed=b.data("speed"),isNaN(d.speed)&&(d.speed=a.st.block.speed),d.easing=b.data("easing"),d.easing||(d.easing=a.st.block.easing),d.css3Easing=j.rsCSS3Easing[d.easing],d.delay=b.data("delay"),isNaN(d.delay)&&(d.delay=a.st.block.delay*l);c={};a._e&&(c[a._g+a._u1]="0ms");c.moveProp=g.moveProp;c.opacity=g.opacity;c.display="none";a._r4.push({block:b,css:c});a._v4(b,f);a._s4.push(setTimeout(function(b,
d,c,e){return function(){b.css("display","block");if(c){var g={};if(a._e){var f="";c.hasMove&&(f+=c.moveProp);c.hasFade&&(c.hasMove&&(f+=", "),f+="opacity");g[a._g+a._t1]=f;g[a._g+a._u1]=c.speed+"ms";g[a._g+a._v1]=c.css3Easing;b.css(g);setTimeout(function(){b.css(d)},24)}else setTimeout(function(){b.animate(d,c.speed,c.easing)},16)}delete a._s4[e]}}(b,g,d,l),6>=d.delay?12:d.delay))})}});j.rsModules.animatedBlocks=j.rsProto._p4})(jQuery);
// jquery.rs.auto-height v1.0.2
(function(b){b.extend(b.rsProto,{_w4:function(){var a=this;if(a.st.autoHeight){var b,d,e,c=function(c){e=a.slides[a.currSlideId];if(b=e.holder)if((d=b.height())&&void 0!==d)a._c4=d,a._e||!c?a._e1.css("height",d):a._e1.stop(!0,!0).animate({height:d},a.st.transitionSpeed)};a.ev.on("rsMaybeSizeReady.rsAutoHeight",function(a,b){e===b&&c()});a.ev.on("rsAfterContentSet.rsAutoHeight",function(a,b){e===b&&c()});a.slider.addClass("rsAutoHeight");a.ev.one("rsAfterInit",function(){setTimeout(function(){c(!1);
setTimeout(function(){a.slider.append('<div style="clear:both; float: none;"></div>');a._e&&a._e1.css(a._g+"transition","height "+a.st.transitionSpeed+"ms ease-in-out")},16)},16)});a.ev.on("rsBeforeAnimStart",function(){c(!0)});a.ev.on("rsBeforeSizeSet",function(){setTimeout(function(){c(!1)},16)})}}});b.rsModules.autoHeight=b.rsProto._w4})(jQuery);
// jquery.rs.autoplay v1.0.5
(function(b){b.extend(b.rsProto,{_x4:function(){var a=this,d;a._y4={enabled:!1,stopAtAction:!0,pauseOnHover:!0,delay:2E3};!a.st.autoPlay&&a.st.autoplay&&(a.st.autoPlay=a.st.autoplay);a.st.autoPlay=b.extend({},a._y4,a.st.autoPlay);a.st.autoPlay.enabled&&(a.ev.on("rsBeforeParseNode",function(a,c,f){c=b(c);if(d=c.attr("data-rsDelay"))f.customDelay=parseInt(d,10)}),a.ev.one("rsAfterInit",function(){a._z4()}),a.ev.on("rsBeforeDestroy",function(){a.stopAutoPlay();a.slider.off("mouseenter mouseleave");b(window).off("blur"+
a.ns+" focus"+a.ns)}))},_z4:function(){var a=this;a.startAutoPlay();a.ev.on("rsAfterContentSet",function(b,e){!a._l2&&(!a._r2&&a._a5&&e===a.currSlide)&&a._b5()});a.ev.on("rsDragRelease",function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.ev.on("rsAfterSlideChange",function(){a._a5&&a._c5&&(a._c5=!1,a.currSlide.isLoaded&&a._b5())});a.ev.on("rsDragStart",function(){a._a5&&(a.st.autoPlay.stopAtAction?a.stopAutoPlay():(a._c5=!0,a._d5()))});a.ev.on("rsBeforeMove",function(b,e,c){a._a5&&(c&&a.st.autoPlay.stopAtAction?
a.stopAutoPlay():(a._c5=!0,a._d5()))});a._e5=!1;a.ev.on("rsVideoStop",function(){a._a5&&(a._e5=!1,a._b5())});a.ev.on("rsVideoPlay",function(){a._a5&&(a._c5=!1,a._d5(),a._e5=!0)});b(window).on("blur"+a.ns,function(){a._a5&&(a._c5=!0,a._d5())}).on("focus"+a.ns,function(){a._a5&&a._c5&&(a._c5=!1,a._b5())});a.st.autoPlay.pauseOnHover&&(a._f5=!1,a.slider.hover(function(){a._a5&&(a._c5=!1,a._d5(),a._f5=!0)},function(){a._a5&&(a._f5=!1,a._b5())}))},toggleAutoPlay:function(){this._a5?this.stopAutoPlay():
this.startAutoPlay()},startAutoPlay:function(){this._a5=!0;this.currSlide.isLoaded&&this._b5()},stopAutoPlay:function(){this._e5=this._f5=this._c5=this._a5=!1;this._d5()},_b5:function(){var a=this;!a._f5&&!a._e5&&(a._g5=!0,a._h5&&clearTimeout(a._h5),a._h5=setTimeout(function(){var b;!a._z&&!a.st.loopRewind&&(b=!0,a.st.loopRewind=!0);a.next(!0);b&&(a.st.loopRewind=!1)},!a.currSlide.customDelay?a.st.autoPlay.delay:a.currSlide.customDelay))},_d5:function(){!this._f5&&!this._e5&&(this._g5=!1,this._h5&&
(clearTimeout(this._h5),this._h5=null))}});b.rsModules.autoplay=b.rsProto._x4})(jQuery);
// jquery.rs.bullets v1.0.1
(function(c){c.extend(c.rsProto,{_i5:function(){var a=this;"bullets"===a.st.controlNavigation&&(a.ev.one("rsAfterPropsSetup",function(){a._j5=!0;a.slider.addClass("rsWithBullets");for(var b='<div class="rsNav rsBullets">',e=0;e<a.numSlides;e++)b+='<div class="rsNavItem rsBullet"><span></span></div>';a._k5=b=c(b+"</div>");a._l5=b.appendTo(a.slider).children();a._k5.on("click.rs",".rsNavItem",function(){a._m5||a.goTo(c(this).index())})}),a.ev.on("rsOnAppendSlide",function(b,c,d){d>=a.numSlides?a._k5.append('<div class="rsNavItem rsBullet"><span></span></div>'):
a._l5.eq(d).before('<div class="rsNavItem rsBullet"><span></span></div>');a._l5=a._k5.children()}),a.ev.on("rsOnRemoveSlide",function(b,c){var d=a._l5.eq(c);d&&d.length&&(d.remove(),a._l5=a._k5.children())}),a.ev.on("rsOnUpdateNav",function(){var b=a.currSlideId;a._n5&&a._n5.removeClass("rsNavSelected");b=a._l5.eq(b);b.addClass("rsNavSelected");a._n5=b}))}});c.rsModules.bullets=c.rsProto._i5})(jQuery);
// jquery.rs.deeplinking v1.0.6 + jQuery hashchange plugin v1.3 Copyright (c) 2010 Ben Alman
(function(b){b.extend(b.rsProto,{_o5:function(){var a=this,g,c,e;a._p5={enabled:!1,change:!1,prefix:""};a.st.deeplinking=b.extend({},a._p5,a.st.deeplinking);if(a.st.deeplinking.enabled){var h=a.st.deeplinking.change,d="#"+a.st.deeplinking.prefix,f=function(){var a=window.location.hash;return a&&(a=parseInt(a.substring(d.length),10),0<=a)?a-1:-1},j=f();-1!==j&&(a.st.startSlideId=j);h&&(b(window).on("hashchange"+a.ns,function(){if(!g){var b=f();0>b||(b>a.numSlides-1&&(b=a.numSlides-1),a.goTo(b))}}),
a.ev.on("rsBeforeAnimStart",function(){c&&clearTimeout(c);e&&clearTimeout(e)}),a.ev.on("rsAfterSlideChange",function(){c&&clearTimeout(c);e&&clearTimeout(e);e=setTimeout(function(){g=!0;window.location.replace((""+window.location).split("#")[0]+d+(a.currSlideId+1));c=setTimeout(function(){g=!1;c=null},60)},400)}));a.ev.on("rsBeforeDestroy",function(){c=e=null;h&&b(window).off("hashchange"+a.ns)})}}});b.rsModules.deeplinking=b.rsProto._o5})(jQuery);
(function(b,a,g){function c(a){a=a||location.href;return"#"+a.replace(/^[^#]*#?(.*)$/,"$1")}"$:nomunge";var e=document,h,d=b.event.special,f=e.documentMode,j="onhashchange"in a&&(f===g||7<f);b.fn.hashchange=function(a){return a?this.bind("hashchange",a):this.trigger("hashchange")};b.fn.hashchange.delay=50;d.hashchange=b.extend(d.hashchange,{setup:function(){if(j)return!1;b(h.start)},teardown:function(){if(j)return!1;b(h.stop)}});var p=function(){var e=c(),d=r(n);e!==n?(q(n=e,d),b(a).trigger("hashchange")):
d!==n&&(location.href=location.href.replace(/#.*/,"")+d);l=setTimeout(p,b.fn.hashchange.delay)},d={},l,n=c(),q=f=function(a){return a},r=f;d.start=function(){l||p()};d.stop=function(){l&&clearTimeout(l);l=g};if(a.attachEvent&&!a.addEventListener&&!j){var k,m;d.start=function(){k||(m=(m=b.fn.hashchange.src)&&m+c(),k=b('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){m||q(c());p()}).attr("src",m||"javascript:0").insertAfter("body")[0].contentWindow,e.onpropertychange=function(){try{"title"===
event.propertyName&&(k.document.title=e.title)}catch(a){}})};d.stop=f;r=function(){return c(k.location.href)};q=function(a,d){var c=k.document,f=b.fn.hashchange.domain;a!==d&&(c.title=e.title,c.open(),f&&c.write('<script>document.domain="'+f+'"\x3c/script>'),c.close(),k.location.hash=a)}}h=d})(jQuery,this);
// jquery.rs.fullscreen v1.0.5
(function(c){c.extend(c.rsProto,{_q5:function(){var a=this;a._r5={enabled:!1,keyboardNav:!0,buttonFS:!0,nativeFS:!1,doubleTap:!0};a.st.fullscreen=c.extend({},a._r5,a.st.fullscreen);if(a.st.fullscreen.enabled)a.ev.one("rsBeforeSizeSet",function(){a._s5()})},_s5:function(){var a=this;a._t5=!a.st.keyboardNavEnabled&&a.st.fullscreen.keyboardNav;if(a.st.fullscreen.nativeFS){a._u5={supportsFullScreen:!1,isFullScreen:function(){return!1},requestFullScreen:function(){},cancelFullScreen:function(){},fullScreenEventName:"",
prefix:""};var b=["webkit","moz","o","ms","khtml"];if(!a.isAndroid)if("undefined"!=typeof document.cancelFullScreen)a._u5.supportsFullScreen=!0;else for(var d=0;d<b.length;d++)if(a._u5.prefix=b[d],"undefined"!=typeof document[a._u5.prefix+"CancelFullScreen"]){a._u5.supportsFullScreen=!0;break}a._u5.supportsFullScreen?(a.nativeFS=!0,a._u5.fullScreenEventName=a._u5.prefix+"fullscreenchange"+a.ns,a._u5.isFullScreen=function(){switch(this.prefix){case "":return document.fullScreen;case "webkit":return document.webkitIsFullScreen;
default:return document[this.prefix+"FullScreen"]}},a._u5.requestFullScreen=function(a){return""===this.prefix?a.requestFullScreen():a[this.prefix+"RequestFullScreen"]()},a._u5.cancelFullScreen=function(){return""===this.prefix?document.cancelFullScreen():document[this.prefix+"CancelFullScreen"]()}):a._u5=!1}a.st.fullscreen.buttonFS&&(a._v5=c('<div class="rsFullscreenBtn"><div class="rsFullscreenIcn"></div></div>').appendTo(a._o1).on("click.rs",function(){a.isFullscreen?a.exitFullscreen():a.enterFullscreen()}))},
enterFullscreen:function(a){var b=this;if(b._u5)if(a)b._u5.requestFullScreen(c("html")[0]);else{b._b.on(b._u5.fullScreenEventName,function(){b._u5.isFullScreen()?b.enterFullscreen(!0):b.exitFullscreen(!0)});b._u5.requestFullScreen(c("html")[0]);return}if(!b._w5){b._w5=!0;b._b.on("keyup"+b.ns+"fullscreen",function(a){27===a.keyCode&&b.exitFullscreen()});b._t5&&b._b2();a=c(window);b._x5=a.scrollTop();b._y5=a.scrollLeft();b._z5=c("html").attr("style");b._a6=c("body").attr("style");b._b6=b.slider.attr("style");
c("body, html").css({overflow:"hidden",height:"100%",width:"100%",margin:"0",padding:"0"});b.slider.addClass("rsFullscreen");var d;for(d=0;d<b.numSlides;d++)a=b.slides[d],a.isRendered=!1,a.bigImage&&(a.isBig=!0,a.isMedLoaded=a.isLoaded,a.isMedLoading=a.isLoading,a.medImage=a.image,a.medIW=a.iW,a.medIH=a.iH,a.slideId=-99,a.bigImage!==a.medImage&&(a.sizeType="big"),a.isLoaded=a.isBigLoaded,a.isLoading=!1,a.image=a.bigImage,a.images[0]=a.bigImage,a.iW=a.bigIW,a.iH=a.bigIH,a.isAppended=a.contentAdded=
!1,b._c6(a));b.isFullscreen=!0;b._w5=!1;b.updateSliderSize();b.ev.trigger("rsEnterFullscreen")}},exitFullscreen:function(a){var b=this;if(b._u5){if(!a){b._u5.cancelFullScreen(c("html")[0]);return}b._b.off(b._u5.fullScreenEventName)}if(!b._w5){b._w5=!0;b._b.off("keyup"+b.ns+"fullscreen");b._t5&&b._b.off("keydown"+b.ns);c("html").attr("style",b._z5||"");c("body").attr("style",b._a6||"");var d;for(d=0;d<b.numSlides;d++)a=b.slides[d],a.isRendered=!1,a.bigImage&&(a.isBig=!1,a.slideId=-99,a.isBigLoaded=
a.isLoaded,a.isBigLoading=a.isLoading,a.bigImage=a.image,a.bigIW=a.iW,a.bigIH=a.iH,a.isLoaded=a.isMedLoaded,a.isLoading=!1,a.image=a.medImage,a.images[0]=a.medImage,a.iW=a.medIW,a.iH=a.medIH,a.isAppended=a.contentAdded=!1,b._c6(a,!0),a.bigImage!==a.medImage&&(a.sizeType="med"));b.isFullscreen=!1;a=c(window);a.scrollTop(b._x5);a.scrollLeft(b._y5);b._w5=!1;b.slider.removeClass("rsFullscreen");b.updateSliderSize();setTimeout(function(){b.updateSliderSize()},1);b.ev.trigger("rsExitFullscreen")}},_c6:function(a){var b=
!a.isLoaded&&!a.isLoading?'<a class="rsImg rsMainSlideImage" href="'+a.image+'"></a>':'<img class="rsImg rsMainSlideImage" src="'+a.image+'"/>';a.content.hasClass("rsImg")?a.content=c(b):a.content.find(".rsImg").eq(0).replaceWith(b);!a.isLoaded&&(!a.isLoading&&a.holder)&&a.holder.html(a.content)}});c.rsModules.fullscreen=c.rsProto._q5})(jQuery);
// jquery.rs.global-caption v1.0
(function(b){b.extend(b.rsProto,{_d6:function(){var a=this;a.st.globalCaption&&(a.ev.on("rsAfterInit",function(){a.globalCaption=b('<div class="rsGCaption"></div>').appendTo(!a.st.globalCaptionInside?a.slider:a._e1);a.globalCaption.html(a.currSlide.caption)}),a.ev.on("rsBeforeAnimStart",function(){a.globalCaption.html(a.currSlide.caption)}))}});b.rsModules.globalCaption=b.rsProto._d6})(jQuery);
// jquery.rs.nav-auto-hide v1.0
(function(b){b.extend(b.rsProto,{_e6:function(){var a=this;if(a.st.navAutoHide&&!a.hasTouch)a.ev.one("rsAfterInit",function(){if(a._k5){a._k5.addClass("rsHidden");var b=a.slider;b.one("mousemove.controlnav",function(){a._k5.removeClass("rsHidden")});b.hover(function(){a._k5.removeClass("rsHidden")},function(){a._k5.addClass("rsHidden")})}})}});b.rsModules.autoHideNav=b.rsProto._e6})(jQuery);
// jquery.rs.tabs v1.0.2
(function(e){e.extend(e.rsProto,{_f6:function(){var a=this;"tabs"===a.st.controlNavigation&&(a.ev.on("rsBeforeParseNode",function(a,d,b){d=e(d);b.thumbnail=d.find(".rsTmb").remove();b.thumbnail.length?b.thumbnail=e(document.createElement("div")).append(b.thumbnail).html():(b.thumbnail=d.attr("data-rsTmb"),b.thumbnail||(b.thumbnail=d.find(".rsImg").attr("data-rsTmb")),b.thumbnail=b.thumbnail?'<img src="'+b.thumbnail+'"/>':"")}),a.ev.one("rsAfterPropsSetup",function(){a._g6()}),a.ev.on("rsOnAppendSlide",
function(c,d,b){b>=a.numSlides?a._k5.append('<div class="rsNavItem rsTab">'+d.thumbnail+"</div>"):a._l5.eq(b).before('<div class="rsNavItem rsTab">'+item.thumbnail+"</div>");a._l5=a._k5.children()}),a.ev.on("rsOnRemoveSlide",function(c,d){var b=a._l5.eq(d);b&&(b.remove(),a._l5=a._k5.children())}),a.ev.on("rsOnUpdateNav",function(){var c=a.currSlideId;a._n5&&a._n5.removeClass("rsNavSelected");c=a._l5.eq(c);c.addClass("rsNavSelected");a._n5=c}))},_g6:function(){var a=this,c;a._j5=!0;c='<div class="rsNav rsTabs">';
for(var d=0;d<a.numSlides;d++)c+='<div class="rsNavItem rsTab">'+a.slides[d].thumbnail+"</div>";c=e(c+"</div>");a._k5=c;a._l5=c.children(".rsNavItem");a.slider.append(c);a._k5.click(function(b){b=e(b.target).closest(".rsNavItem");b.length&&a.goTo(b.index())})}});e.rsModules.tabs=e.rsProto._f6})(jQuery);
// jquery.rs.thumbnails v1.0.5
(function(f){f.extend(f.rsProto,{_h6:function(){var a=this;"thumbnails"===a.st.controlNavigation&&(a._i6={drag:!0,touch:!0,orientation:"horizontal",navigation:!0,arrows:!0,arrowLeft:null,arrowRight:null,spacing:4,arrowsAutoHide:!1,appendSpan:!1,transitionSpeed:600,autoCenter:!0,fitInViewport:!0,firstMargin:!0,paddingTop:0,paddingBottom:0},a.st.thumbs=f.extend({},a._i6,a.st.thumbs),a._j6=!0,!1===a.st.thumbs.firstMargin?a.st.thumbs.firstMargin=0:!0===a.st.thumbs.firstMargin&&(a.st.thumbs.firstMargin=
a.st.thumbs.spacing),a.ev.on("rsBeforeParseNode",function(a,c,b){c=f(c);b.thumbnail=c.find(".rsTmb").remove();b.thumbnail.length?b.thumbnail=f(document.createElement("div")).append(b.thumbnail).html():(b.thumbnail=c.attr("data-rsTmb"),b.thumbnail||(b.thumbnail=c.find(".rsImg").attr("data-rsTmb")),b.thumbnail=b.thumbnail?'<img src="'+b.thumbnail+'"/>':"")}),a.ev.one("rsAfterPropsSetup",function(){a._k6()}),a._n5=null,a.ev.on("rsOnUpdateNav",function(){var e=f(a._l5[a.currSlideId]);e!==a._n5&&(a._n5&&
(a._n5.removeClass("rsNavSelected"),a._n5=null),a._l6&&a._m6(a.currSlideId),a._n5=e.addClass("rsNavSelected"))}),a.ev.on("rsOnAppendSlide",function(e,c,b){e="<div"+a._n6+' class="rsNavItem rsThumb">'+a._o6+c.thumbnail+"</div>";b>=a.numSlides?a._s3.append(e):a._l5.eq(b).before(e);a._l5=a._s3.children();a.updateThumbsSize()}),a.ev.on("rsOnRemoveSlide",function(e,c){var b=a._l5.eq(c);b&&(b.remove(),a._l5=a._s3.children(),a.updateThumbsSize())}))},_k6:function(){var a=this,e="rsThumbs",c=a.st.thumbs,
b="",g,d,h=c.spacing;a._j5=!0;a._e3="vertical"===c.orientation?!1:!0;a._n6=g=h?' style="margin-'+(a._e3?"right":"bottom")+":"+h+'px;"':"";a._i3=0;a._p6=!1;a._m5=!1;a._l6=!1;a._q6=c.arrows&&c.navigation;d=a._e3?"Hor":"Ver";a.slider.addClass("rsWithThumbs rsWithThumbs"+d);b+='<div class="rsNav rsThumbs rsThumbs'+d+'"><div class="'+e+'Container">';a._o6=c.appendSpan?'<span class="thumbIco"></span>':"";for(var j=0;j<a.numSlides;j++)d=a.slides[j],b+="<div"+g+' class="rsNavItem rsThumb">'+d.thumbnail+a._o6+
"</div>";b=f(b+"</div></div>");g={};c.paddingTop&&(g[a._e3?"paddingTop":"paddingLeft"]=c.paddingTop);c.paddingBottom&&(g[a._e3?"paddingBottom":"paddingRight"]=c.paddingBottom);b.css(g);a._s3=f(b).find("."+e+"Container");a._q6&&(e+="Arrow",c.arrowLeft?a._r6=c.arrowLeft:(a._r6=f('<div class="'+e+" "+e+'Left"><div class="'+e+'Icn"></div></div>'),b.append(a._r6)),c.arrowRight?a._s6=c.arrowRight:(a._s6=f('<div class="'+e+" "+e+'Right"><div class="'+e+'Icn"></div></div>'),b.append(a._s6)),a._r6.click(function(){var b=
(Math.floor(a._i3/a._t6)+a._u6)*a._t6;a._a4(b>a._n3?a._n3:b)}),a._s6.click(function(){var b=(Math.floor(a._i3/a._t6)-a._u6)*a._t6;a._a4(b<a._o3?a._o3:b)}),c.arrowsAutoHide&&!a.hasTouch&&(a._r6.css("opacity",0),a._s6.css("opacity",0),b.one("mousemove.rsarrowshover",function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))}),b.hover(function(){a._l6&&(a._r6.css("opacity",1),a._s6.css("opacity",1))},function(){a._l6&&(a._r6.css("opacity",0),a._s6.css("opacity",0))})));a._k5=b;a._l5=a._s3.children();
a.msEnabled&&a.st.thumbs.navigation&&a._s3.css("-ms-touch-action",a._e3?"pan-y":"pan-x");a.slider.append(b);a._w3=!0;a._v6=h;c.navigation&&a._e&&a._s3.css(a._g+"transition-property",a._g+"transform");a._k5.on("click.rs",".rsNavItem",function(){a._m5||a.goTo(f(this).index())});a.ev.off("rsBeforeSizeSet.thumbs").on("rsBeforeSizeSet.thumbs",function(){a._w6=a._e3?a._c4:a._b4;a.updateThumbsSize(!0)})},updateThumbsSize:function(){var a=this,e=a._l5.first(),c={},b=a._l5.length;a._t6=(a._e3?e.outerWidth():
e.outerHeight())+a._v6;a._y3=b*a._t6-a._v6;c[a._e3?"width":"height"]=a._y3+a._v6;a._z3=a._e3?a._k5.width():a._k5.height();a._o3=-(a._y3-a._z3)-a.st.thumbs.firstMargin;a._n3=a.st.thumbs.firstMargin;a._u6=Math.floor(a._z3/a._t6);if(a._y3<a._z3)a.st.thumbs.autoCenter&&a._q3((a._z3-a._y3)/2),a.st.thumbs.arrows&&a._r6&&(a._r6.addClass("rsThumbsArrowDisabled"),a._s6.addClass("rsThumbsArrowDisabled")),a._l6=!1,a._m5=!1,a._k5.off(a._j1);else if(a.st.thumbs.navigation&&!a._l6&&(a._l6=!0,!a.hasTouch&&a.st.thumbs.drag||
a.hasTouch&&a.st.thumbs.touch))a._m5=!0,a._k5.on(a._j1,function(b){a._g2(b,!0)});a._e&&(c[a._g+"transition-duration"]="0ms");a._s3.css(c);if(a._w3&&(a.isFullscreen||a.st.thumbs.fitInViewport))a._e3?a._c4=a._w6-a._k5.outerHeight():a._b4=a._w6-a._k5.outerWidth()},setThumbsOrientation:function(a,e){this._w3&&(this.st.thumbs.orientation=a,this._k5.remove(),this.slider.removeClass("rsWithThumbsHor rsWithThumbsVer"),this._k6(),this._k5.off(this._j1),e||this.updateSliderSize(!0))},_q3:function(a){this._i3=
a;this._e?this._s3.css(this._x1,this._y1+(this._e3?a+this._z1+0:0+this._z1+a)+this._a2):this._s3.css(this._e3?this._x1:this._w1,a)},_a4:function(a,e,c,b,g){var d=this;if(d._l6){e||(e=d.st.thumbs.transitionSpeed);d._i3=a;d._x6&&clearTimeout(d._x6);d._p6&&(d._e||d._s3.stop(),c=!0);var h={};d._p6=!0;d._e?(h[d._g+"transition-duration"]=e+"ms",h[d._g+"transition-timing-function"]=c?f.rsCSS3Easing[d.st.easeOut]:f.rsCSS3Easing[d.st.easeInOut],d._s3.css(h),d._q3(a)):(h[d._e3?d._x1:d._w1]=a+"px",d._s3.animate(h,
e,c?"easeOutCubic":d.st.easeInOut));b&&(d._i3=b);d._y6();d._x6=setTimeout(function(){d._p6=!1;g&&(d._a4(b,g,!0),g=null)},e)}},_y6:function(){this._q6&&(this._i3===this._n3?this._r6.addClass("rsThumbsArrowDisabled"):this._r6.removeClass("rsThumbsArrowDisabled"),this._i3===this._o3?this._s6.addClass("rsThumbsArrowDisabled"):this._s6.removeClass("rsThumbsArrowDisabled"))},_m6:function(a,e){var c=0,b,f=a*this._t6+2*this._t6-this._v6+this._n3,d=Math.floor(this._i3/this._t6);this._l6&&(this._j6&&(e=!0,
this._j6=!1),f+this._i3>this._z3?(a===this.numSlides-1&&(c=1),d=-a+this._u6-2+c,b=d*this._t6+this._z3%this._t6+this._v6-this._n3):0!==a?(a-1)*this._t6<=-this._i3+this._n3&&a-1<=this.numSlides-this._u6&&(b=(-a+1)*this._t6+this._n3):b=this._n3,b!==this._i3&&(c=void 0===b?this._i3:b,c>this._n3?this._q3(this._n3):c<this._o3?this._q3(this._o3):void 0!==b&&(e?this._q3(b):this._a4(b))),this._y6())}});f.rsModules.thumbnails=f.rsProto._h6})(jQuery);
// jquery.rs.video v1.1.1
(function(f){f.extend(f.rsProto,{_z6:function(){var a=this;a._a7={autoHideArrows:!0,autoHideControlNav:!1,autoHideBlocks:!1,autoHideCaption:!1,disableCSS3inFF:!0,youTubeCode:'<iframe src="http://www.youtube.com/embed/%id%?rel=1&autoplay=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',vimeoCode:'<iframe src="http://player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'};a.st.video=
f.extend({},a._a7,a.st.video);a.ev.on("rsBeforeSizeSet",function(){a._b7&&setTimeout(function(){var b=a._r1,b=b.hasClass("rsVideoContainer")?b:b.find(".rsVideoContainer");a._c7&&a._c7.css({width:b.width(),height:b.height()})},32)});var c=a._a.mozilla;a.ev.on("rsAfterParseNode",function(b,e,d){b=f(e);if(d.videoURL){a.st.video.disableCSS3inFF&&c&&(a._e=a._f=!1);e=f('<div class="rsVideoContainer"></div>');var g=f('<div class="rsBtnCenterer"><div class="rsPlayBtn"><div class="rsPlayBtnIcon"></div></div></div>');
b.hasClass("rsImg")?d.content=e.append(b).append(g):d.content.find(".rsImg").wrap(e).after(g)}});a.ev.on("rsAfterSlideChange",function(){a.stopVideo()})},toggleVideo:function(){return this._b7?this.stopVideo():this.playVideo()},playVideo:function(){var a=this;if(!a._b7){var c=a.currSlide;if(!c.videoURL)return!1;var b=a._d7=c.content,c=c.videoURL,e,d;c.match(/youtu\.be/i)||c.match(/youtube\.com/i)?(d=/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,(d=c.match(d))&&11==
d[7].length&&(e=d[7]),void 0!==e&&(a._c7=a.st.video.youTubeCode.replace("%id%",e))):c.match(/vimeo\.com/i)&&(d=/(www\.)?vimeo.com\/(\d+)($|\/)/,(d=c.match(d))&&(e=d[2]),void 0!==e&&(a._c7=a.st.video.vimeoCode.replace("%id%",e)));a.videoObj=f(a._c7);a.ev.trigger("rsOnCreateVideoElement",[c]);a.videoObj.length&&(a._c7=f('<div class="rsVideoFrameHolder"><div class="rsPreloader"></div><div class="rsCloseVideoBtn"><div class="rsCloseVideoIcn"></div></div></div>'),a._c7.find(".rsPreloader").after(a.videoObj),
b=b.hasClass("rsVideoContainer")?b:b.find(".rsVideoContainer"),a._c7.css({width:b.width(),height:b.height()}).find(".rsCloseVideoBtn").off("click.rsv").on("click.rsv",function(b){a.stopVideo();b.preventDefault();b.stopPropagation();return!1}),b.append(a._c7),a.isIPAD&&b.addClass("rsIOSVideo"),a._e7(!1),setTimeout(function(){a._c7.addClass("rsVideoActive")},10),a.ev.trigger("rsVideoPlay"),a._b7=!0);return!0}return!1},stopVideo:function(){var a=this;return a._b7?(a.isIPAD&&a.slider.find(".rsCloseVideoBtn").remove(),
a._e7(!0),setTimeout(function(){a.ev.trigger("rsOnDestroyVideoElement",[a.videoObj]);var c=a._c7.find("iframe");if(c.length)try{c.attr("src","")}catch(b){}a._c7.remove();a._c7=null},16),a.ev.trigger("rsVideoStop"),a._b7=!1,!0):!1},_e7:function(a){var c=[],b=this.st.video;b.autoHideArrows&&(this._c2&&(c.push(this._c2,this._d2),this._e2=!a),this._v5&&c.push(this._v5));b.autoHideControlNav&&this._k5&&c.push(this._k5);b.autoHideBlocks&&this.currSlide.animBlocks&&c.push(this.currSlide.animBlocks);b.autoHideCaption&&
this.globalCaption&&c.push(this.globalCaption);if(c.length)for(b=0;b<c.length;b++)a?c[b].removeClass("rsHidden"):c[b].addClass("rsHidden")}});f.rsModules.video=f.rsProto._z6})(jQuery);
// jquery.rs.visible-nearby v1.0.2
(function(d){d.rsProto._f7=function(){var a=this;a.st.visibleNearby&&a.st.visibleNearby.enabled&&(a._g7={enabled:!0,centerArea:0.6,center:!0,breakpoint:0,breakpointCenterArea:0.8,hiddenOverflow:!0,navigateByCenterClick:!1},a.st.visibleNearby=d.extend({},a._g7,a.st.visibleNearby),a.ev.one("rsAfterPropsSetup",function(){a._h7=a._e1.css("overflow","visible").wrap('<div class="rsVisibleNearbyWrap"></div>').parent();a.st.visibleNearby.hiddenOverflow||a._h7.css("overflow","visible");a._o1=a.st.controlsInside?
a._h7:a.slider}),a.ev.on("rsAfterSizePropSet",function(){var b,c=a.st.visibleNearby;b=c.breakpoint&&a.width<c.breakpoint?c.breakpointCenterArea:c.centerArea;a._h?(a._b4*=b,a._h7.css({height:a._c4,width:a._b4/b}),a._d=a._b4*(1-b)/2/b):(a._c4*=b,a._h7.css({height:a._c4/b,width:a._b4}),a._d=a._c4*(1-b)/2/b);c.navigateByCenterClick||(a._q=a._h?a._b4:a._c4);c.center&&a._e1.css("margin-"+(a._h?"left":"top"),a._d)}))};d.rsModules.visibleNearby=d.rsProto._f7})(jQuery);




/* --- $MAGNIFIC POPUP --- */

/*! Magnific Popup - v0.9.5 - 2013-08-21
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
;(function($){var CLOSE_EVENT='Close',BEFORE_CLOSE_EVENT='BeforeClose',AFTER_CLOSE_EVENT='AfterClose',BEFORE_APPEND_EVENT='BeforeAppend',MARKUP_PARSE_EVENT='MarkupParse',OPEN_EVENT='Open',CHANGE_EVENT='Change',NS='mfp',EVENT_NS='.'+NS,READY_CLASS='mfp-ready',REMOVING_CLASS='mfp-removing',PREVENT_CLOSE_CLASS='mfp-prevent-close';var mfp,MagnificPopup=function(){},_isJQ=!!(window.jQuery),_prevStatus,_window=$(window),_body,_document,_prevContentType,_wrapClasses,_currPopupType;var _mfpOn=function(name,f){mfp.ev.on(NS+name+EVENT_NS,f)},_getEl=function(className,appendTo,html,raw){var el=document.createElement('div');el.className='mfp-'+className;if(html){el.innerHTML=html}if(!raw){el=$(el);if(appendTo){el.appendTo(appendTo)}}else if(appendTo){appendTo.appendChild(el)}return el},_mfpTrigger=function(e,data){mfp.ev.triggerHandler(NS+e,data);if(mfp.st.callbacks){e=e.charAt(0).toLowerCase()+e.slice(1);if(mfp.st.callbacks[e]){mfp.st.callbacks[e].apply(mfp,$.isArray(data)?data:[data])}}},_setFocus=function(){(mfp.st.focus?mfp.content.find(mfp.st.focus).eq(0):mfp.wrap).focus()},_getCloseBtn=function(type){if(type!==_currPopupType||!mfp.currTemplate.closeBtn){mfp.currTemplate.closeBtn=$(mfp.st.closeMarkup.replace('%title%',mfp.st.tClose));_currPopupType=type}return mfp.currTemplate.closeBtn},_checkInstance=function(){if(!$.magnificPopup.instance){mfp=new MagnificPopup();mfp.init();$.magnificPopup.instance=mfp}},_checkIfClose=function(target){if($(target).hasClass(PREVENT_CLOSE_CLASS)){return}var closeOnContent=mfp.st.closeOnContentClick;var closeOnBg=mfp.st.closeOnBgClick;if(closeOnContent&&closeOnBg){return true}else{if(!mfp.content||$(target).hasClass('mfp-close')||(mfp.preloader&&target===mfp.preloader[0])){return true}if((target!==mfp.content[0]&&!$.contains(mfp.content[0],target))){if(closeOnBg){if($.contains(document,target)){return true}}}else if(closeOnContent){return true}}return false},supportsTransitions=function(){var s=document.createElement('p').style,v=['ms','O','Moz','Webkit'];if(s['transition']!==undefined){return true}while(v.length){if(v.pop()+'Transition'in s){return true}}return false};MagnificPopup.prototype={constructor:MagnificPopup,init:function(){var appVersion=navigator.appVersion;mfp.isIE7=appVersion.indexOf("MSIE 7.")!==-1;mfp.isIE8=appVersion.indexOf("MSIE 8.")!==-1;mfp.isLowIE=mfp.isIE7||mfp.isIE8;mfp.isAndroid=(/android/gi).test(appVersion);mfp.isIOS=(/iphone|ipad|ipod/gi).test(appVersion);mfp.supportsTransition=supportsTransitions();mfp.probablyMobile=(mfp.isAndroid||mfp.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent));_body=$(document.body);_document=$(document);mfp.popupsCache={}},open:function(data){var i;if(data.isObj===false){mfp.items=data.items.toArray();mfp.index=0;var items=data.items,item;for(i=0;i<items.length;i++){item=items[i];if(item.parsed){item=item.el[0]}if(item===data.el[0]){mfp.index=i;break}}}else{mfp.items=$.isArray(data.items)?data.items:[data.items];mfp.index=data.index||0}if(mfp.isOpen){mfp.updateItemHTML();return}mfp.types=[];_wrapClasses='';if(data.mainEl&&data.mainEl.length){mfp.ev=data.mainEl.eq(0)}else{mfp.ev=_document}if(data.key){if(!mfp.popupsCache[data.key]){mfp.popupsCache[data.key]={}}mfp.currTemplate=mfp.popupsCache[data.key]}else{mfp.currTemplate={}}mfp.st=$.extend(true,{},$.magnificPopup.defaults,data);mfp.fixedContentPos=mfp.st.fixedContentPos==='auto'?!mfp.probablyMobile:mfp.st.fixedContentPos;if(mfp.st.modal){mfp.st.closeOnContentClick=false;mfp.st.closeOnBgClick=false;mfp.st.showCloseBtn=false;mfp.st.enableEscapeKey=false}if(!mfp.bgOverlay){mfp.bgOverlay=_getEl('bg').on('click'+EVENT_NS,function(){mfp.close()});mfp.wrap=_getEl('wrap').attr('tabindex',-1).on('click'+EVENT_NS,function(e){if(_checkIfClose(e.target)){mfp.close()}});mfp.container=_getEl('container',mfp.wrap)}mfp.contentContainer=_getEl('content');if(mfp.st.preloader){mfp.preloader=_getEl('preloader',mfp.container,mfp.st.tLoading)}var modules=$.magnificPopup.modules;for(i=0;i<modules.length;i++){var n=modules[i];n=n.charAt(0).toUpperCase()+n.slice(1);mfp['init'+n].call(mfp)}_mfpTrigger('BeforeOpen');if(mfp.st.showCloseBtn){if(!mfp.st.closeBtnInside){mfp.wrap.append(_getCloseBtn())}else{_mfpOn(MARKUP_PARSE_EVENT,function(e,template,values,item){values.close_replaceWith=_getCloseBtn(item.type)});_wrapClasses+=' mfp-close-btn-in'}}if(mfp.st.alignTop){_wrapClasses+=' mfp-align-top'}if(mfp.fixedContentPos){mfp.wrap.css({overflow:mfp.st.overflowY,overflowX:'hidden',overflowY:mfp.st.overflowY})}else{mfp.wrap.css({top:_window.scrollTop(),position:'absolute'})}if(mfp.st.fixedBgPos===false||(mfp.st.fixedBgPos==='auto'&&!mfp.fixedContentPos)){mfp.bgOverlay.css({height:_document.height(),position:'absolute'})}if(mfp.st.enableEscapeKey){_document.on('keyup'+EVENT_NS,function(e){if(e.keyCode===27){mfp.close()}})}_window.on('resize'+EVENT_NS,function(){mfp.updateSize()});if(!mfp.st.closeOnContentClick){_wrapClasses+=' mfp-auto-cursor'}if(_wrapClasses)mfp.wrap.addClass(_wrapClasses);var windowHeight=mfp.wH=_window.height();var windowStyles={};if(mfp.fixedContentPos){if(mfp._hasScrollBar(windowHeight)){var s=mfp._getScrollbarSize();if(s){windowStyles.paddingRight=s}}}if(mfp.fixedContentPos){if(!mfp.isIE7){windowStyles.overflow='hidden'}else{$('body, html').css('overflow','hidden')}}var classesToadd=mfp.st.mainClass;if(mfp.isIE7){classesToadd+=' mfp-ie7'}if(classesToadd){mfp._addClassToMFP(classesToadd)}mfp.updateItemHTML();_mfpTrigger('BuildControls');$('html').css(windowStyles);mfp.bgOverlay.add(mfp.wrap).prependTo(document.body);mfp._lastFocusedEl=document.activeElement;setTimeout(function(){if(mfp.content){mfp._addClassToMFP(READY_CLASS);_setFocus()}else{mfp.bgOverlay.addClass(READY_CLASS)}_document.on('focusin'+EVENT_NS,function(e){if(e.target!==mfp.wrap[0]&&!$.contains(mfp.wrap[0],e.target)){_setFocus();return false}})},16);mfp.isOpen=true;mfp.updateSize(windowHeight);_mfpTrigger(OPEN_EVENT)},close:function(){if(!mfp.isOpen)return;_mfpTrigger(BEFORE_CLOSE_EVENT);mfp.isOpen=false;if(mfp.st.removalDelay&&!mfp.isLowIE&&mfp.supportsTransition){mfp._addClassToMFP(REMOVING_CLASS);setTimeout(function(){mfp._close()},mfp.st.removalDelay)}else{mfp._close()}},_close:function(){_mfpTrigger(CLOSE_EVENT);var classesToRemove=REMOVING_CLASS+' '+READY_CLASS+' ';mfp.bgOverlay.detach();mfp.wrap.detach();mfp.container.empty();if(mfp.st.mainClass){classesToRemove+=mfp.st.mainClass+' '}mfp._removeClassFromMFP(classesToRemove);if(mfp.fixedContentPos){var windowStyles={paddingRight:''};if(mfp.isIE7){$('body, html').css('overflow','')}else{windowStyles.overflow=''}$('html').css(windowStyles)}_document.off('keyup'+EVENT_NS+' focusin'+EVENT_NS);mfp.ev.off(EVENT_NS);mfp.wrap.attr('class','mfp-wrap').removeAttr('style');mfp.bgOverlay.attr('class','mfp-bg');mfp.container.attr('class','mfp-container');if(mfp.st.showCloseBtn&&(!mfp.st.closeBtnInside||mfp.currTemplate[mfp.currItem.type]===true)){if(mfp.currTemplate.closeBtn)mfp.currTemplate.closeBtn.detach()}if(mfp._lastFocusedEl){$(mfp._lastFocusedEl).focus()}mfp.currItem=null;mfp.content=null;mfp.currTemplate=null;mfp.prevHeight=0;_mfpTrigger(AFTER_CLOSE_EVENT)},updateSize:function(winHeight){if(mfp.isIOS){var zoomLevel=document.documentElement.clientWidth/window.innerWidth;var height=window.innerHeight*zoomLevel;mfp.wrap.css('height',height);mfp.wH=height}else{mfp.wH=winHeight||_window.height()}if(!mfp.fixedContentPos){mfp.wrap.css('height',mfp.wH)}_mfpTrigger('Resize')},updateItemHTML:function(){var item=mfp.items[mfp.index];mfp.contentContainer.detach();if(mfp.content)mfp.content.detach();if(!item.parsed){item=mfp.parseEl(mfp.index)}var type=item.type;_mfpTrigger('BeforeChange',[mfp.currItem?mfp.currItem.type:'',type]);mfp.currItem=item;if(!mfp.currTemplate[type]){var markup=mfp.st[type]?mfp.st[type].markup:false;_mfpTrigger('FirstMarkupParse',markup);if(markup){mfp.currTemplate[type]=$(markup)}else{mfp.currTemplate[type]=true}}if(_prevContentType&&_prevContentType!==item.type){mfp.container.removeClass('mfp-'+_prevContentType+'-holder')}var newContent=mfp['get'+type.charAt(0).toUpperCase()+type.slice(1)](item,mfp.currTemplate[type]);mfp.appendContent(newContent,type);item.preloaded=true;_mfpTrigger(CHANGE_EVENT,item);_prevContentType=item.type;mfp.container.prepend(mfp.contentContainer);_mfpTrigger('AfterChange')},appendContent:function(newContent,type){mfp.content=newContent;if(newContent){if(mfp.st.showCloseBtn&&mfp.st.closeBtnInside&&mfp.currTemplate[type]===true){if(!mfp.content.find('.mfp-close').length){mfp.content.append(_getCloseBtn())}}else{mfp.content=newContent}}else{mfp.content=''}_mfpTrigger(BEFORE_APPEND_EVENT);mfp.container.addClass('mfp-'+type+'-holder');mfp.contentContainer.append(mfp.content)},parseEl:function(index){var item=mfp.items[index],type=item.type;if(item.tagName){item={el:$(item)}}else{item={data:item,src:item.src}}if(item.el){var types=mfp.types;for(var i=0;i<types.length;i++){if(item.el.hasClass('mfp-'+types[i])){type=types[i];break}}item.src=item.el.attr('data-mfp-src');if(!item.src){item.src=item.el.attr('href')}}item.type=type||mfp.st.type||'inline';item.index=index;item.parsed=true;mfp.items[index]=item;_mfpTrigger('ElementParse',item);return mfp.items[index]},addGroup:function(el,options){var eHandler=function(e){e.mfpEl=this;mfp._openClick(e,el,options)};if(!options){options={}}var eName='click.magnificPopup';options.mainEl=el;if(options.items){options.isObj=true;el.off(eName).on(eName,eHandler)}else{options.isObj=false;if(options.delegate){el.off(eName).on(eName,options.delegate,eHandler)}else{options.items=el;el.off(eName).on(eName,eHandler)}}},_openClick:function(e,el,options){var midClick=options.midClick!==undefined?options.midClick:$.magnificPopup.defaults.midClick;if(!midClick&&(e.which===2||e.ctrlKey||e.metaKey)){return}var disableOn=options.disableOn!==undefined?options.disableOn:$.magnificPopup.defaults.disableOn;if(disableOn){if($.isFunction(disableOn)){if(!disableOn.call(mfp)){return true}}else{if(_window.width()<disableOn){return true}}}if(e.type){e.preventDefault();if(mfp.isOpen){e.stopPropagation()}}options.el=$(e.mfpEl);if(options.delegate){options.items=el.find(options.delegate)}mfp.open(options)},updateStatus:function(status,text){if(mfp.preloader){if(_prevStatus!==status){mfp.container.removeClass('mfp-s-'+_prevStatus)}if(!text&&status==='loading'){text=mfp.st.tLoading}var data={status:status,text:text};_mfpTrigger('UpdateStatus',data);status=data.status;text=data.text;mfp.preloader.html(text);mfp.preloader.find('a').on('click',function(e){e.stopImmediatePropagation()});mfp.container.addClass('mfp-s-'+status);_prevStatus=status}},_addClassToMFP:function(cName){mfp.bgOverlay.addClass(cName);mfp.wrap.addClass(cName)},_removeClassFromMFP:function(cName){this.bgOverlay.removeClass(cName);mfp.wrap.removeClass(cName)},_hasScrollBar:function(winHeight){return((mfp.isIE7?_document.height():document.body.scrollHeight)>(winHeight||_window.height()))},_parseMarkup:function(template,values,item){var arr;if(item.data){values=$.extend(item.data,values)}_mfpTrigger(MARKUP_PARSE_EVENT,[template,values,item]);$.each(values,function(key,value){if(value===undefined||value===false){return true}arr=key.split('_');if(arr.length>1){var el=template.find(EVENT_NS+'-'+arr[0]);if(el.length>0){var attr=arr[1];if(attr==='replaceWith'){if(el[0]!==value[0]){el.replaceWith(value)}}else if(attr==='img'){if(el.is('img')){el.attr('src',value)}else{el.replaceWith('<img src="'+value+'" class="'+el.attr('class')+'" />')}}else{el.attr(arr[1],value)}}}else{template.find(EVENT_NS+'-'+key).html(value)}})},_getScrollbarSize:function(){if(mfp.scrollbarSize===undefined){var scrollDiv=document.createElement("div");scrollDiv.id="mfp-sbm";scrollDiv.style.cssText='width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';document.body.appendChild(scrollDiv);mfp.scrollbarSize=scrollDiv.offsetWidth-scrollDiv.clientWidth;document.body.removeChild(scrollDiv)}return mfp.scrollbarSize}};$.magnificPopup={instance:null,proto:MagnificPopup.prototype,modules:[],open:function(options,index){_checkInstance();if(!options)options={};options.isObj=true;options.index=index||0;return this.instance.open(options)},close:function(){return $.magnificPopup.instance.close()},registerModule:function(name,module){if(module.options){$.magnificPopup.defaults[name]=module.options}$.extend(this.proto,module.proto);this.modules.push(name)},defaults:{disableOn:0,key:null,midClick:false,mainClass:'',preloader:true,focus:'',closeOnContentClick:false,closeOnBgClick:true,closeBtnInside:true,showCloseBtn:true,enableEscapeKey:true,modal:false,alignTop:false,removalDelay:0,fixedContentPos:'auto',fixedBgPos:'auto',overflowY:'auto',closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:'Close (Esc)',tLoading:'Loading...'}};$.fn.magnificPopup=function(options){_checkInstance();var jqEl=$(this);if(typeof options==="string"){if(options==='open'){var items,itemOpts=_isJQ?jqEl.data('magnificPopup'):jqEl[0].magnificPopup,index=parseInt(arguments[1],10)||0;if(itemOpts.items){items=itemOpts.items[index]}else{items=jqEl;if(itemOpts.delegate){items=items.find(itemOpts.delegate)}items=items.eq(index)}mfp._openClick({mfpEl:items},jqEl,itemOpts)}else{if(mfp.isOpen)mfp[options].apply(mfp,Array.prototype.slice.call(arguments,1))}}else{if(_isJQ){jqEl.data('magnificPopup',options)}else{jqEl[0].magnificPopup=options}mfp.addGroup(jqEl,options)}return jqEl};var INLINE_NS='inline',_hiddenClass,_inlinePlaceholder,_lastInlineElement,_putInlineElementsBack=function(){if(_lastInlineElement){_inlinePlaceholder.after(_lastInlineElement.addClass(_hiddenClass)).detach();_lastInlineElement=null}};$.magnificPopup.registerModule(INLINE_NS,{options:{hiddenClass:'hide',markup:'',tNotFound:'Content not found'},proto:{initInline:function(){mfp.types.push(INLINE_NS);_mfpOn(CLOSE_EVENT+'.'+INLINE_NS,function(){_putInlineElementsBack()})},getInline:function(item,template){_putInlineElementsBack();if(item.src){var inlineSt=mfp.st.inline,el=$(item.src);if(el.length){var parent=el[0].parentNode;if(parent&&parent.tagName){if(!_inlinePlaceholder){_hiddenClass=inlineSt.hiddenClass;_inlinePlaceholder=_getEl(_hiddenClass);_hiddenClass='mfp-'+_hiddenClass}_lastInlineElement=el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass)}mfp.updateStatus('ready')}else{mfp.updateStatus('error',inlineSt.tNotFound);el=$('<div>')}item.inlineElement=el;return el}mfp.updateStatus('ready');mfp._parseMarkup(template,{},item);return template}}});var AJAX_NS='ajax',_ajaxCur,_removeAjaxCursor=function(){if(_ajaxCur){_body.removeClass(_ajaxCur)}};$.magnificPopup.registerModule(AJAX_NS,{options:{settings:null,cursor:'mfp-ajax-cur',tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){mfp.types.push(AJAX_NS);_ajaxCur=mfp.st.ajax.cursor;_mfpOn(CLOSE_EVENT+'.'+AJAX_NS,function(){_removeAjaxCursor();if(mfp.req){mfp.req.abort()}})},getAjax:function(item){if(_ajaxCur)_body.addClass(_ajaxCur);mfp.updateStatus('loading');var opts=$.extend({url:item.src,success:function(data,textStatus,jqXHR){var temp={data:data,xhr:jqXHR};_mfpTrigger('ParseAjax',temp);mfp.appendContent($(temp.data),AJAX_NS);item.finished=true;_removeAjaxCursor();_setFocus();setTimeout(function(){mfp.wrap.addClass(READY_CLASS)},16);mfp.updateStatus('ready');_mfpTrigger('AjaxContentAdded')},error:function(){_removeAjaxCursor();item.finished=item.loadError=true;mfp.updateStatus('error',mfp.st.ajax.tError.replace('%url%',item.src))}},mfp.st.ajax.settings);mfp.req=$.ajax(opts);return''}}});var _imgInterval,_getTitle=function(item){if(item.data&&item.data.title!==undefined)return item.data.title;var src=mfp.st.image.titleSrc;if(src){if($.isFunction(src)){return src.call(mfp,item)}else if(item.el){return item.el.attr(src)||''}}return''};$.magnificPopup.registerModule('image',{options:{markup:'<div class="mfp-figure">'+'<div class="mfp-close"></div>'+'<div class="mfp-img"></div>'+'<div class="mfp-bottom-bar">'+'<div class="mfp-title"></div>'+'<div class="mfp-counter"></div>'+'</div>'+'</div>',cursor:'mfp-zoom-out-cur',titleSrc:'title',verticalFit:true,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var imgSt=mfp.st.image,ns='.image';mfp.types.push('image');_mfpOn(OPEN_EVENT+ns,function(){if(mfp.currItem.type==='image'&&imgSt.cursor){_body.addClass(imgSt.cursor)}});_mfpOn(CLOSE_EVENT+ns,function(){if(imgSt.cursor){_body.removeClass(imgSt.cursor)}_window.off('resize'+EVENT_NS)});_mfpOn('Resize'+ns,mfp.resizeImage);if(mfp.isLowIE){_mfpOn('AfterChange',mfp.resizeImage)}},resizeImage:function(){var item=mfp.currItem;if(!item||!item.img)return;if(mfp.st.image.verticalFit){var decr=0;if(mfp.isLowIE){decr=parseInt(item.img.css('padding-top'),10)+parseInt(item.img.css('padding-bottom'),10)}item.img.css('max-height',mfp.wH-decr)}},_onImageHasSize:function(item){if(item.img){item.hasSize=true;if(_imgInterval){clearInterval(_imgInterval)}item.isCheckingImgSize=false;_mfpTrigger('ImageHasSize',item);if(item.imgHidden){if(mfp.content)mfp.content.removeClass('mfp-loading');item.imgHidden=false}}},findImageSize:function(item){var counter=0,img=item.img[0],mfpSetInterval=function(delay){if(_imgInterval){clearInterval(_imgInterval)}_imgInterval=setInterval(function(){if(img.naturalWidth>0){mfp._onImageHasSize(item);return}if(counter>200){clearInterval(_imgInterval)}counter++;if(counter===3){mfpSetInterval(10)}else if(counter===40){mfpSetInterval(50)}else if(counter===100){mfpSetInterval(500)}},delay)};mfpSetInterval(1)},getImage:function(item,template){var guard=0,onLoadComplete=function(){if(item){if(item.img[0].complete){item.img.off('.mfploader');if(item===mfp.currItem){mfp._onImageHasSize(item);mfp.updateStatus('ready')}item.hasSize=true;item.loaded=true;_mfpTrigger('ImageLoadComplete')}else{guard++;if(guard<200){setTimeout(onLoadComplete,100)}else{onLoadError()}}}},onLoadError=function(){if(item){item.img.off('.mfploader');if(item===mfp.currItem){mfp._onImageHasSize(item);mfp.updateStatus('error',imgSt.tError.replace('%url%',item.src))}item.hasSize=true;item.loaded=true;item.loadError=true}},imgSt=mfp.st.image;var el=template.find('.mfp-img');if(el.length){var img=document.createElement('img');img.className='mfp-img';item.img=$(img).on('load.mfploader',onLoadComplete).on('error.mfploader',onLoadError);img.src=item.src;if(el.is('img')){item.img=item.img.clone()}if(item.img[0].naturalWidth>0){item.hasSize=true}}mfp._parseMarkup(template,{title:_getTitle(item),img_replaceWith:item.img},item);mfp.resizeImage();if(item.hasSize){if(_imgInterval)clearInterval(_imgInterval);if(item.loadError){template.addClass('mfp-loading');mfp.updateStatus('error',imgSt.tError.replace('%url%',item.src))}else{template.removeClass('mfp-loading');mfp.updateStatus('ready')}return template}mfp.updateStatus('loading');item.loading=true;if(!item.hasSize){item.imgHidden=true;template.addClass('mfp-loading');mfp.findImageSize(item)}return template}}});var hasMozTransform,getHasMozTransform=function(){if(hasMozTransform===undefined){hasMozTransform=document.createElement('p').style.MozTransform!==undefined}return hasMozTransform};$.magnificPopup.registerModule('zoom',{options:{enabled:false,easing:'ease-in-out',duration:300,opener:function(element){return element.is('img')?element:element.find('img')}},proto:{initZoom:function(){var zoomSt=mfp.st.zoom,ns='.zoom';if(!zoomSt.enabled||!mfp.supportsTransition){return}var duration=zoomSt.duration,getElToAnimate=function(image){var newImg=image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),transition='all '+(zoomSt.duration/1000)+'s '+zoomSt.easing,cssObj={position:'fixed',zIndex:9999,left:0,top:0,'-webkit-backface-visibility':'hidden'},t='transition';cssObj['-webkit-'+t]=cssObj['-moz-'+t]=cssObj['-o-'+t]=cssObj[t]=transition;newImg.css(cssObj);return newImg},showMainContent=function(){mfp.content.css('visibility','visible')},openTimeout,animatedImg;_mfpOn('BuildControls'+ns,function(){if(mfp._allowZoom()){clearTimeout(openTimeout);mfp.content.css('visibility','hidden');image=mfp._getItemToZoom();if(!image){showMainContent();return}animatedImg=getElToAnimate(image);animatedImg.css(mfp._getOffset());mfp.wrap.append(animatedImg);openTimeout=setTimeout(function(){animatedImg.css(mfp._getOffset(true));openTimeout=setTimeout(function(){showMainContent();setTimeout(function(){animatedImg.remove();image=animatedImg=null;_mfpTrigger('ZoomAnimationEnded')},16)},duration)},16)}});_mfpOn(BEFORE_CLOSE_EVENT+ns,function(){if(mfp._allowZoom()){clearTimeout(openTimeout);mfp.st.removalDelay=duration;if(!image){image=mfp._getItemToZoom();if(!image){return}animatedImg=getElToAnimate(image)}animatedImg.css(mfp._getOffset(true));mfp.wrap.append(animatedImg);mfp.content.css('visibility','hidden');setTimeout(function(){animatedImg.css(mfp._getOffset())},16)}});_mfpOn(CLOSE_EVENT+ns,function(){if(mfp._allowZoom()){showMainContent();if(animatedImg){animatedImg.remove()}}})},_allowZoom:function(){return mfp.currItem.type==='image'},_getItemToZoom:function(){if(mfp.currItem.hasSize){return mfp.currItem.img}else{return false}},_getOffset:function(isLarge){var el;if(isLarge){el=mfp.currItem.img}else{el=mfp.st.zoom.opener(mfp.currItem.el||mfp.currItem)}var offset=el.offset();var paddingTop=parseInt(el.css('padding-top'),10);var paddingBottom=parseInt(el.css('padding-bottom'),10);offset.top-=($(window).scrollTop()-paddingTop);var obj={width:el.width(),height:(_isJQ?el.innerHeight():el[0].offsetHeight)-paddingBottom-paddingTop};if(getHasMozTransform()){obj['-moz-transform']=obj['transform']='translate('+offset.left+'px,'+offset.top+'px)'}else{obj.left=offset.left;obj.top=offset.top}return obj}}});var IFRAME_NS='iframe',_emptyPage='//about:blank',_fixIframeBugs=function(isShowing){if(mfp.currTemplate[IFRAME_NS]){var el=mfp.currTemplate[IFRAME_NS].find('iframe');if(el.length){if(!isShowing){el[0].src=_emptyPage}if(mfp.isIE8){el.css('display',isShowing?'block':'none')}}}};$.magnificPopup.registerModule(IFRAME_NS,{options:{markup:'<div class="mfp-iframe-scaler">'+'<div class="mfp-close"></div>'+'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+'</div>',srcAction:'iframe_src',patterns:{youtube:{index:'youtube.com',id:'v=',src:'//www.youtube.com/embed/%id%?autoplay=1'},vimeo:{index:'vimeo.com/',id:'/',src:'//player.vimeo.com/video/%id%?autoplay=1'},gmaps:{index:'//maps.google.',src:'%id%&output=embed'}}},proto:{initIframe:function(){mfp.types.push(IFRAME_NS);_mfpOn('BeforeChange',function(e,prevType,newType){if(prevType!==newType){if(prevType===IFRAME_NS){_fixIframeBugs()}else if(newType===IFRAME_NS){_fixIframeBugs(true)}}});_mfpOn(CLOSE_EVENT+'.'+IFRAME_NS,function(){_fixIframeBugs()})},getIframe:function(item,template){var embedSrc=item.src;var iframeSt=mfp.st.iframe;$.each(iframeSt.patterns,function(){if(embedSrc.indexOf(this.index)>-1){if(this.id){if(typeof this.id==='string'){embedSrc=embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length,embedSrc.length)}else{embedSrc=this.id.call(this,embedSrc)}}embedSrc=this.src.replace('%id%',embedSrc);return false}});var dataObj={};if(iframeSt.srcAction){dataObj[iframeSt.srcAction]=embedSrc}mfp._parseMarkup(template,dataObj,item);mfp.updateStatus('ready');return template}}});var _getLoopedId=function(index){var numSlides=mfp.items.length;if(index>numSlides-1){return index-numSlides}else if(index<0){return numSlides+index}return index},_replaceCurrTotal=function(text,curr,total){return text.replace('%curr%',curr+1).replace('%total%',total)};$.magnificPopup.registerModule('gallery',{options:{enabled:false,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:true,arrows:true,tPrev:objectl10n.tPrev,tNext:objectl10n.tNext,tCounter:'%curr% '+objectl10n.tCounter+' %total%'},proto:{initGallery:function(){var gSt=mfp.st.gallery,ns='.mfp-gallery',supportsFastClick=Boolean($.fn.mfpFastClick);mfp.direction=true;if(!gSt||!gSt.enabled)return false;_wrapClasses+=' mfp-gallery';_mfpOn(OPEN_EVENT+ns,function(){if(gSt.navigateByImgClick){mfp.wrap.on('click'+ns,'.mfp-img',function(){if(mfp.items.length>1){mfp.next();return false}})}_document.on('keydown'+ns,function(e){if(e.keyCode===37){mfp.prev()}else if(e.keyCode===39){mfp.next()}})});_mfpOn('UpdateStatus'+ns,function(e,data){if(data.text){data.text=_replaceCurrTotal(data.text,mfp.currItem.index,mfp.items.length)}});_mfpOn(MARKUP_PARSE_EVENT+ns,function(e,element,values,item){var l=mfp.items.length;values.counter=l>1?_replaceCurrTotal(gSt.tCounter,item.index,l):''});_mfpOn('BuildControls'+ns,function(){if(mfp.items.length>1&&gSt.arrows&&!mfp.arrowLeft){var markup=gSt.arrowMarkup,arrowLeft=mfp.arrowLeft=$(markup.replace('%title%',gSt.tPrev).replace('%dir%','left')).addClass(PREVENT_CLOSE_CLASS),arrowRight=mfp.arrowRight=$(markup.replace('%title%',gSt.tNext).replace('%dir%','right')).addClass(PREVENT_CLOSE_CLASS);var eName=supportsFastClick?'mfpFastClick':'click';arrowLeft[eName](function(){mfp.prev()});arrowRight[eName](function(){mfp.next()});if(mfp.isIE7){_getEl('b',arrowLeft[0],false,true);_getEl('a',arrowLeft[0],false,true);_getEl('b',arrowRight[0],false,true);_getEl('a',arrowRight[0],false,true)}mfp.container.append(arrowLeft.add(arrowRight))}});_mfpOn(CHANGE_EVENT+ns,function(){if(mfp._preloadTimeout)clearTimeout(mfp._preloadTimeout);mfp._preloadTimeout=setTimeout(function(){mfp.preloadNearbyImages();mfp._preloadTimeout=null},16)});_mfpOn(CLOSE_EVENT+ns,function(){_document.off(ns);mfp.wrap.off('click'+ns);if(mfp.arrowLeft&&supportsFastClick){mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick()}mfp.arrowRight=mfp.arrowLeft=null})},next:function(){mfp.direction=true;mfp.index=_getLoopedId(mfp.index+1);mfp.updateItemHTML()},prev:function(){mfp.direction=false;mfp.index=_getLoopedId(mfp.index-1);mfp.updateItemHTML()},goTo:function(newIndex){mfp.direction=(newIndex>=mfp.index);mfp.index=newIndex;mfp.updateItemHTML()},preloadNearbyImages:function(){var p=mfp.st.gallery.preload,preloadBefore=Math.min(p[0],mfp.items.length),preloadAfter=Math.min(p[1],mfp.items.length),i;for(i=1;i<=(mfp.direction?preloadAfter:preloadBefore);i++){mfp._preloadItem(mfp.index+i)}for(i=1;i<=(mfp.direction?preloadBefore:preloadAfter);i++){mfp._preloadItem(mfp.index-i)}},_preloadItem:function(index){index=_getLoopedId(index);if(mfp.items[index].preloaded){return}var item=mfp.items[index];if(!item.parsed){item=mfp.parseEl(index)}_mfpTrigger('LazyLoad',item);if(item.type==='image'){item.img=$('<img class="mfp-img" />').on('load.mfploader',function(){item.hasSize=true}).on('error.mfploader',function(){item.hasSize=true;item.loadError=true;_mfpTrigger('LazyLoadError',item)}).attr('src',item.src)}item.preloaded=true}}});var RETINA_NS='retina';$.magnificPopup.registerModule(RETINA_NS,{options:{replaceSrc:function(item){return item.src.replace(/\.\w+$/,function(m){return'@2x'+m})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var st=mfp.st.retina,ratio=st.ratio;ratio=!isNaN(ratio)?ratio:ratio();if(ratio>1){_mfpOn('ImageHasSize'+'.'+RETINA_NS,function(e,item){item.img.css({'max-width':item.img[0].naturalWidth/ratio,'width':'100%'})});_mfpOn('ElementParse'+'.'+RETINA_NS,function(e,item){item.src=st.replaceSrc(item,ratio)})}}}}});(function(){var ghostClickDelay=1000,supportsTouch='ontouchstart'in window,unbindTouchMove=function(){_window.off('touchmove'+ns+' touchend'+ns)},eName='mfpFastClick',ns='.'+eName;$.fn.mfpFastClick=function(callback){return $(this).each(function(){var elem=$(this),lock;if(supportsTouch){var timeout,startX,startY,pointerMoved,point,numPointers;elem.on('touchstart'+ns,function(e){pointerMoved=false;numPointers=1;point=e.originalEvent?e.originalEvent.touches[0]:e.touches[0];startX=point.clientX;startY=point.clientY;_window.on('touchmove'+ns,function(e){point=e.originalEvent?e.originalEvent.touches:e.touches;numPointers=point.length;point=point[0];if(Math.abs(point.clientX-startX)>10||Math.abs(point.clientY-startY)>10){pointerMoved=true;unbindTouchMove()}}).on('touchend'+ns,function(e){unbindTouchMove();if(pointerMoved||numPointers>1){return}lock=true;e.preventDefault();clearTimeout(timeout);timeout=setTimeout(function(){lock=false},ghostClickDelay);callback()})})}elem.on('click'+ns,function(){if(!lock){callback()}})})};$.fn.destroyMfpFastClick=function(){$(this).off('touchstart'+ns+' click'+ns);if(supportsTouch)_window.off('touchmove'+ns+' touchend'+ns)}})()})(window.jQuery||window.Zepto);





/* --- $SALVATTORE --- */

// Salvattore by @rnmp and @ppold
// 
// http://github.com/bandd/salvattore
function salvattore(){
      (function(root, factory) {
        if (typeof define === 'function' && define.amd) {
          return define(factory);
        } else if (typeof exports === 'object') {
          return module.exports = factory();
        } else {
          return root.salvattore = factory();
        }
      })(this, function() {
        var add_columns, add_to_dataset, append_elements, create_list_of_fragments, get_css_rules, get_stylesheets, grids, media_query_change, media_rule_has_columns_selector, next_element_column_index, obtain_grid_settings, prepend_elements, recreate_columns, register_grid, remove_columns, scan_media_queries, setup;

        grids = [];
        add_to_dataset = function(element, key, value) {
          var dataset;

          dataset = element.dataset;
          if (dataset) {
            return dataset[key] = value;
          } else {
            return element.setAttribute("data-" + key, value);
          }
        };
        obtain_grid_settings = function(element) {
          var columnClasses, computedStyle, content, matchResult, numberOfColumns, _ref, _ref1;

          computedStyle = getComputedStyle(element, ':before');
          content = computedStyle.getPropertyValue('content').slice(1, -1);
          matchResult = content.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/);
          if (matchResult) {
            numberOfColumns = matchResult[1];
            columnClasses = ((_ref = matchResult[2]) != null ? _ref.split('.') : void 0) || ['column'];
          } else {
            matchResult = content.match(/^\s*\.(.+)\s+(\d+)\s*$/);
            columnClasses = matchResult[1];
            numberOfColumns = (_ref1 = matchResult[2]) != null ? _ref1.split('.') : void 0;
          }
          return {
            numberOfColumns: numberOfColumns,
            columnClasses: columnClasses
          };
        };
        add_columns = function(grid, items) {
          var columnClasses, columnsFragment, columnsItems, i, numberOfColumns, selector, _ref;

          _ref = obtain_grid_settings(grid), numberOfColumns = _ref.numberOfColumns, columnClasses = _ref.columnClasses;
          columnsItems = new Array(+numberOfColumns);
          i = numberOfColumns;
          while (i-- !== 0) {
            selector = "[data-columns] > *:nth-child(" + numberOfColumns + "n-" + i + ")";
            columnsItems.push(items.querySelectorAll(selector));
          }
          columnsFragment = document.createDocumentFragment();
          columnsItems.forEach(function(rows) {
            var column, rowsFragment;

            column = document.createElement('div');
            column.className = columnClasses.join(' ');
            rowsFragment = document.createDocumentFragment();
            Array.prototype.forEach.call(rows, function(row) {
              return rowsFragment.appendChild(row);
            });
            column.appendChild(rowsFragment);
            return columnsFragment.appendChild(column);
          });
          grid.appendChild(columnsFragment);
          return add_to_dataset(grid, 'columns', numberOfColumns);
        };
        remove_columns = function(grid) {
          var columns, container, numberOfColumns, numberOfRowsInFirstColumn, range, sortedRows;

          range = document.createRange();
          range.selectNodeContents(grid);
          columns = Array.prototype.filter.call(range.extractContents().childNodes, function(node) {
            return node instanceof HTMLElement;
          });
          numberOfColumns = columns.length;
          numberOfRowsInFirstColumn = columns[0].childNodes.length;
          sortedRows = new Array(numberOfRowsInFirstColumn * numberOfColumns);
          Array.prototype.forEach.call(columns, function(column, columnIndex) {
            return Array.prototype.forEach.call(column.children, function(row, rowIndex) {
              return sortedRows[rowIndex * numberOfColumns + columnIndex] = row;
            });
          });
          container = document.createElement('div');
          add_to_dataset(container, 'columns', 0);
          sortedRows.filter(function(child) {
            return child != null;
          }).forEach(function(child) {
            return container.appendChild(child);
          });
          return container;
        };
        recreate_columns = function(grid) {
          return requestAnimationFrame(function() {
            var items;

            items = remove_columns(grid);
            return add_columns(grid, items);
          });
        };
        media_query_change = function(mql) {
          if (mql.matches) {
            return Array.prototype.forEach.call(grids, recreate_columns);
          }
        };
        get_css_rules = function(stylesheet) {
          var cssRules, e;

          try {
            cssRules = stylesheet.sheet.cssRules;
          } catch (_error) {
            e = _error;
            return [];
          }
          if (cssRules) {
            return cssRules;
          } else {
            return [];
          }
        };
        get_stylesheets = function() {
          return Array.prototype.concat.call(Array.prototype.slice.call(document.querySelectorAll('style[type="text/css"]')), Array.prototype.slice.call(document.querySelectorAll('link[rel="stylesheet"]')));
        };
        media_rule_has_columns_selector = function(rules) {
          var i, rule;

          i = rules.length;
          while (i--) {
            rule = rules[i];
            if (rule.selectorText !== undefined && rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
              return true;
            }
          }
          return false;
        };
        scan_media_queries = function() {
          var mediaQueries;

          if (typeof matchMedia === "undefined" || matchMedia === null) {
            return;
          }
          mediaQueries = [];
          get_stylesheets().forEach(function(stylesheet) {
            return Array.prototype.forEach.call(get_css_rules(stylesheet), function(rule) {
              if ((rule.media != null) && media_rule_has_columns_selector(rule.cssRules)) {
                return mediaQueries.push(matchMedia(rule.media.mediaText));
              }
            });
          });
          return mediaQueries.forEach(function(mql) {
            return mql.addListener(media_query_change);
          });
        };
        next_element_column_index = function(grid, element) {
          var child, children, currentRowCount, highestRowCount, i, m, _i, _len;

          children = grid.children;
          m = children.length;
          for (i = _i = 0, _len = children.length; _i < _len; i = ++_i) {
            child = children[i];
            currentRowCount = child.children.length;
            if (i !== 0 && highestRowCount > currentRowCount) {
              break;
            } else if ((i + 1) === m) {
              i = 0;
              break;
            }
            highestRowCount = currentRowCount;
          }
          return i;
        };
        create_list_of_fragments = function(quantity) {
          var fragments, i;

          fragments = new Array(quantity);
          i = 0;
          while (i !== quantity) {
            fragments[i] = document.createDocumentFragment();
            i++;
          }
          return fragments;
        };
        append_elements = function(grid, elements) {
          var columnIndex, columns, fragments, numberOfColumns;

          columns = grid.children;
          numberOfColumns = columns.length;
          fragments = create_list_of_fragments(numberOfColumns);
          columnIndex = next_element_column_index(grid, elements[0]);
          elements.forEach(function(element) {
            fragments[columnIndex].appendChild(element);
            if (columnIndex === (numberOfColumns - 1)) {
              return columnIndex = 0;
            } else {
              return columnIndex++;
            }
          });
          return Array.prototype.forEach.call(columns, function(column, columnIndex) {
            return column.appendChild(fragments[columnIndex]);
          });
        };
        prepend_elements = function(grid, elements) {
          var columnIndex, columns, fragment, fragments, numberOfColumns, numberOfColumnsToExtract;

          columns = grid.children;
          numberOfColumns = columns.length;
          fragments = create_list_of_fragments(numberOfColumns);
          columnIndex = numberOfColumns - 1;
          elements.forEach(function(element) {
            var fragment;

            fragment = fragments[columnIndex];
            fragment.insertBefore(element, fragment.firstChild);
            if (columnIndex === 0) {
              return columnIndex = numberOfColumns - 1;
            } else {
              return columnIndex--;
            }
          });
          Array.prototype.forEach.call(columns, function(column, columnIndex) {
            return column.insertBefore(fragments[columnIndex], column.firstChild);
          });
          fragment = document.createDocumentFragment();
          numberOfColumnsToExtract = elements.length % numberOfColumns;
          while (numberOfColumnsToExtract-- !== 0) {
            fragment.appendChild(grid.lastChild);
          }
          return grid.insertBefore(fragment, grid.firstChild);
        };
        register_grid = function(grid) {
          var items, range;

          if (getComputedStyle(grid).display === 'none') {
            return;
          }
          range = document.createRange();
          range.selectNodeContents(grid);
          items = document.createElement('div');
          items.appendChild(range.extractContents());
          add_to_dataset(items, 'columns', 0);
          add_columns(grid, items);
          return grids.push(grid);
        };
        setup = function() {
          Array.prototype.forEach.call(document.querySelectorAll('[data-columns]'), register_grid);
          return scan_media_queries();
        };
        setup();
        return {
          append_elements: append_elements,
          prepend_elements: prepend_elements,
          register_grid: register_grid
        };
      });

};





/* --- $GMAP3 ---*/

// GMap 3 v5.1.1 by DEMONTE Jean-Baptiste
// http://gmap3.net
(function(y,t){var z,i=0;function J(){if(!z){z={verbose:false,queryLimit:{attempt:5,delay:250,random:250},classes:{Map:google.maps.Map,Marker:google.maps.Marker,InfoWindow:google.maps.InfoWindow,Circle:google.maps.Circle,Rectangle:google.maps.Rectangle,OverlayView:google.maps.OverlayView,StreetViewPanorama:google.maps.StreetViewPanorama,KmlLayer:google.maps.KmlLayer,TrafficLayer:google.maps.TrafficLayer,BicyclingLayer:google.maps.BicyclingLayer,GroundOverlay:google.maps.GroundOverlay,StyledMapType:google.maps.StyledMapType,ImageMapType:google.maps.ImageMapType},map:{mapTypeId:google.maps.MapTypeId.ROADMAP,center:[46.578498,2.457275],zoom:2},overlay:{pane:"floatPane",content:"",offset:{x:0,y:0}},geoloc:{getCurrentPosition:{maximumAge:60000,timeout:5000}}}}}function k(M,L){return M!==t?M:"gmap3_"+(L?i+1:++i)}function d(L){var O=function(P){return parseInt(P,10)},N=google.maps.version.split(".").map(O),M;L=L.split(".").map(O);for(M=0;M<L.length;M++){if(N.hasOwnProperty(M)){if(N[M]<L[M]){return false}}else{return false}}return true}function n(P,L,N,Q,O){if(L.todo.events||L.todo.onces){var M={id:Q,data:L.todo.data,tag:L.todo.tag};if(L.todo.events){y.each(L.todo.events,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListener(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}if(L.todo.onces){y.each(L.todo.onces,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListenerOnce(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}}}function l(){var L=[];this.empty=function(){return !L.length};this.add=function(M){L.push(M)};this.get=function(){return L.length?L[0]:false};this.ack=function(){L.shift()}}function w(T,L,N){var R={},P=this,Q,S={latLng:{map:false,marker:false,infowindow:false,circle:false,overlay:false,getlatlng:false,getmaxzoom:false,getelevation:false,streetviewpanorama:false,getaddress:true},geoloc:{getgeoloc:true}};if(typeof N==="string"){N=M(N)}function M(V){var U={};U[V]={};return U}function O(){var U;for(U in N){if(U in R){continue}return U}}this.run=function(){var U,V;while(U=O()){if(typeof T[U]==="function"){Q=U;V=y.extend(true,{},z[U]||{},N[U].options||{});if(U in S.latLng){if(N[U].values){x(N[U].values,T,T[U],{todo:N[U],opts:V,session:R})}else{v(T,T[U],S.latLng[U],{todo:N[U],opts:V,session:R})}}else{if(U in S.geoloc){o(T,T[U],{todo:N[U],opts:V,session:R})}else{T[U].apply(T,[{todo:N[U],opts:V,session:R}])}}return}else{R[U]=null}}L.apply(T,[N,R])};this.ack=function(U){R[Q]=U;P.run.apply(P,[])}}function c(N){var L,M=[];for(L in N){M.push(L)}return M}function b(N,Q){var L={};if(N.todo){for(var M in N.todo){if((M!=="options")&&(M!=="values")){L[M]=N.todo[M]}}}var O,P=["data","tag","id","events","onces"];for(O=0;O<P.length;O++){A(L,P[O],Q,N.todo)}L.options=y.extend({},N.opts||{},Q.options||{});return L}function A(N,M){for(var L=2;L<arguments.length;L++){if(M in arguments[L]){N[M]=arguments[L][M];return}}}function r(){var L=[];this.get=function(S){if(L.length){var P,O,N,R,M,Q=c(S);for(P=0;P<L.length;P++){R=L[P];M=Q.length==R.keys.length;for(O=0;(O<Q.length)&&M;O++){N=Q[O];M=N in R.request;if(M){if((typeof S[N]==="object")&&("equals" in S[N])&&(typeof S[N]==="function")){M=S[N].equals(R.request[N])}else{M=S[N]===R.request[N]}}}if(M){return R.results}}}};this.store=function(N,M){L.push({request:N,keys:c(N),results:M})}}function e(Q,P,O,L){var N=this,M=[];z.classes.OverlayView.call(this);this.setMap(Q);this.onAdd=function(){var R=this.getPanes();if(P.pane in R){y(R[P.pane]).append(L)}y.each("dblclick click mouseover mousemove mouseout mouseup mousedown".split(" "),function(T,S){M.push(google.maps.event.addDomListener(L[0],S,function(U){y.Event(U).stopPropagation();google.maps.event.trigger(N,S,[U]);N.draw()}))});M.push(google.maps.event.addDomListener(L[0],"contextmenu",function(S){y.Event(S).stopPropagation();google.maps.event.trigger(N,"rightclick",[S]);N.draw()}))};this.getPosition=function(){return O};this.draw=function(){var R=this.getProjection().fromLatLngToDivPixel(O);L.css("left",(R.x+P.offset.x)+"px").css("top",(R.y+P.offset.y)+"px")};this.onRemove=function(){for(var R=0;R<M.length;R++){google.maps.event.removeListener(M[R])}L.remove()};this.hide=function(){L.hide()};this.show=function(){L.show()};this.toggle=function(){if(L){if(L.is(":visible")){this.show()}else{this.hide()}}};this.toggleDOM=function(){if(this.getMap()){this.setMap(null)}else{this.setMap(Q)}};this.getDOMElement=function(){return L[0]}}function f(O,L){function M(){this.onAdd=function(){};this.onRemove=function(){};this.draw=function(){};return z.classes.OverlayView.apply(this,[])}M.prototype=z.classes.OverlayView.prototype;var N=new M();N.setMap(O);return N}function F(ae,ao,aa){var an=false,ai=false,af=false,Z=false,W=true,V=this,N=[],T={},ad={},U={},aj=[],ah=[],O=[],ak=f(ao,aa.radius),Y,ap,am,P,Q;S();function L(aq){if(!aj[aq]){delete ah[aq].options.map;aj[aq]=new z.classes.Marker(ah[aq].options);n(ae,{todo:ah[aq]},aj[aq],ah[aq].id)}}this.getById=function(aq){if(aq in ad){L(ad[aq]);return aj[ad[aq]]}return false};this.rm=function(ar){var aq=ad[ar];if(aj[aq]){aj[aq].setMap(null)}delete aj[aq];aj[aq]=false;delete ah[aq];ah[aq]=false;delete O[aq];O[aq]=false;delete ad[ar];delete U[aq];ai=true};this.clearById=function(aq){if(aq in ad){this.rm(aq);return true}};this.clear=function(az,av,aA){var ar,ay,at,aw,au,ax=[],aq=C(aA);if(az){ar=ah.length-1;ay=-1;at=-1}else{ar=0;ay=ah.length;at=1}for(aw=ar;aw!=ay;aw+=at){if(ah[aw]){if(!aq||aq(ah[aw].tag)){ax.push(U[aw]);if(av||az){break}}}}for(au=0;au<ax.length;au++){this.rm(ax[au])}};this.add=function(aq,ar){aq.id=k(aq.id);this.clearById(aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(null);ah.push(aq);O.push(ar);ai=true};this.addMarker=function(ar,aq){aq=aq||{};aq.id=k(aq.id);this.clearById(aq.id);if(!aq.options){aq.options={}}aq.options.position=ar.getPosition();n(ae,{todo:aq},ar,aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(ar);ah.push(aq);O.push(aq.data||{});ai=true};this.todo=function(aq){return ah[aq]};this.value=function(aq){return O[aq]};this.marker=function(aq){if(aq in aj){L(aq);return aj[aq]}return false};this.markerIsSet=function(aq){return Boolean(aj[aq])};this.setMarker=function(ar,aq){aj[ar]=aq};this.store=function(aq,ar,at){T[aq.ref]={obj:ar,shadow:at}};this.free=function(){for(var aq=0;aq<N.length;aq++){google.maps.event.removeListener(N[aq])}N=[];y.each(T,function(ar){ac(ar)});T={};y.each(ah,function(ar){ah[ar]=null});ah=[];y.each(aj,function(ar){if(aj[ar]){aj[ar].setMap(null);delete aj[ar]}});aj=[];y.each(O,function(ar){delete O[ar]});O=[];ad={};U={}};this.filter=function(aq){am=aq;ag()};this.enable=function(aq){if(W!=aq){W=aq;ag()}};this.display=function(aq){P=aq};this.error=function(aq){Q=aq};this.beginUpdate=function(){an=true};this.endUpdate=function(){an=false;if(ai){ag()}};this.autofit=function(ar){for(var aq=0;aq<ah.length;aq++){if(ah[aq]){ar.extend(ah[aq].options.position)}}};function S(){ap=ak.getProjection();if(!ap){setTimeout(function(){S.apply(V,[])},25);return}Z=true;N.push(google.maps.event.addListener(ao,"zoom_changed",function(){al()}));N.push(google.maps.event.addListener(ao,"bounds_changed",function(){al()}));ag()}function ac(aq){if(typeof T[aq]==="object"){if(typeof(T[aq].obj.setMap)==="function"){T[aq].obj.setMap(null)}if(typeof(T[aq].obj.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.setMap)==="function"){T[aq].shadow.setMap(null)}delete T[aq].obj;delete T[aq].shadow}else{if(aj[aq]){aj[aq].setMap(null)}}delete T[aq]}function M(){var ay,ax,aw,au,av,at,ar,aq;if(arguments[0] instanceof google.maps.LatLng){ay=arguments[0].lat();aw=arguments[0].lng();if(arguments[1] instanceof google.maps.LatLng){ax=arguments[1].lat();au=arguments[1].lng()}else{ax=arguments[1];au=arguments[2]}}else{ay=arguments[0];aw=arguments[1];if(arguments[2] instanceof google.maps.LatLng){ax=arguments[2].lat();au=arguments[2].lng()}else{ax=arguments[2];au=arguments[3]}}av=Math.PI*ay/180;at=Math.PI*aw/180;ar=Math.PI*ax/180;aq=Math.PI*au/180;return 1000*6371*Math.acos(Math.min(Math.cos(av)*Math.cos(ar)*Math.cos(at)*Math.cos(aq)+Math.cos(av)*Math.sin(at)*Math.cos(ar)*Math.sin(aq)+Math.sin(av)*Math.sin(ar),1))}function R(){var aq=M(ao.getCenter(),ao.getBounds().getNorthEast()),ar=new google.maps.Circle({center:ao.getCenter(),radius:1.25*aq});return ar.getBounds()}function X(){var ar={},aq;for(aq in T){ar[aq]=true}return ar}function al(){clearTimeout(Y);Y=setTimeout(function(){ag()},25)}function ab(ar){var au=ap.fromLatLngToDivPixel(ar),at=ap.fromDivPixelToLatLng(new google.maps.Point(au.x+aa.radius,au.y-aa.radius)),aq=ap.fromDivPixelToLatLng(new google.maps.Point(au.x-aa.radius,au.y+aa.radius));return new google.maps.LatLngBounds(aq,at)}function ag(){if(an||af||!Z){return}var aE=[],aG={},aF=ao.getZoom(),aH=("maxZoom" in aa)&&(aF>aa.maxZoom),aw=X(),av,au,at,aA,ar=false,aq,aD,ay,az,aB,aC,ax;ai=false;if(aF>3){aq=R();ar=aq.getSouthWest().lng()<aq.getNorthEast().lng()}for(av=0;av<ah.length;av++){if(ah[av]&&(!ar||aq.contains(ah[av].options.position))&&(!am||am(O[av]))){aE.push(av)}}while(1){av=0;while(aG[av]&&(av<aE.length)){av++}if(av==aE.length){break}aA=[];if(W&&!aH){ax=10;do{az=aA;aA=[];ax--;if(az.length){ay=aq.getCenter()}else{ay=ah[aE[av]].options.position}aq=ab(ay);for(au=av;au<aE.length;au++){if(aG[au]){continue}if(aq.contains(ah[aE[au]].options.position)){aA.push(au)}}}while((az.length<aA.length)&&(aA.length>1)&&ax)}else{for(au=av;au<aE.length;au++){if(aG[au]){continue}aA.push(au);break}}aD={indexes:[],ref:[]};aB=aC=0;for(at=0;at<aA.length;at++){aG[aA[at]]=true;aD.indexes.push(aE[aA[at]]);aD.ref.push(aE[aA[at]]);aB+=ah[aE[aA[at]]].options.position.lat();aC+=ah[aE[aA[at]]].options.position.lng()}aB/=aA.length;aC/=aA.length;aD.latLng=new google.maps.LatLng(aB,aC);aD.ref=aD.ref.join("-");if(aD.ref in aw){delete aw[aD.ref]}else{if(aA.length===1){T[aD.ref]=true}P(aD)}}y.each(aw,function(aI){ac(aI)});af=false}}function a(M,L){this.id=function(){return M};this.filter=function(N){L.filter(N)};this.enable=function(){L.enable(true)};this.disable=function(){L.enable(false)};this.add=function(O,N,P){if(!P){L.beginUpdate()}L.addMarker(O,N);if(!P){L.endUpdate()}};this.getById=function(N){return L.getById(N)};this.clearById=function(P,O){var N;if(!O){L.beginUpdate()}N=L.clearById(P);if(!O){L.endUpdate()}return N};this.clear=function(P,Q,N,O){if(!O){L.beginUpdate()}L.clear(P,Q,N);if(!O){L.endUpdate()}}}function D(){var M={},N={};function L(P){return{id:P.id,name:P.name,object:P.obj,tag:P.tag,data:P.data}}this.add=function(R,Q,T,S){var P=R.todo||{},U=k(P.id);if(!M[Q]){M[Q]=[]}if(U in N){this.clearById(U)}N[U]={obj:T,sub:S,name:Q,id:U,tag:P.tag,data:P.data};M[Q].push(U);return U};this.getById=function(R,Q,P){if(R in N){if(Q){return N[R].sub}else{if(P){return L(N[R])}}return N[R].obj}return false};this.get=function(R,T,P,S){var V,U,Q=C(P);if(!M[R]||!M[R].length){return null}V=M[R].length;while(V){V--;U=M[R][T?V:M[R].length-V-1];if(U&&N[U]){if(Q&&!Q(N[U].tag)){continue}return S?L(N[U]):N[U].obj}}return null};this.all=function(S,Q,T){var P=[],R=C(Q),U=function(X){var V,W;for(V=0;V<M[X].length;V++){W=M[X][V];if(W&&N[W]){if(R&&!R(N[W].tag)){continue}P.push(T?L(N[W]):N[W].obj)}}};if(S in M){U(S)}else{if(S===t){for(S in M){U(S)}}}return P};function O(P){if(typeof(P.setMap)==="function"){P.setMap(null)}if(typeof(P.remove)==="function"){P.remove()}if(typeof(P.free)==="function"){P.free()}P=null}this.rm=function(S,Q,R){var P,T;if(!M[S]){return false}if(Q){if(R){for(P=M[S].length-1;P>=0;P--){T=M[S][P];if(Q(N[T].tag)){break}}}else{for(P=0;P<M[S].length;P++){T=M[S][P];if(Q(N[T].tag)){break}}}}else{P=R?M[S].length-1:0}if(!(P in M[S])){return false}return this.clearById(M[S][P],P)};this.clearById=function(S,P){if(S in N){var R,Q=N[S].name;for(R=0;P===t&&R<M[Q].length;R++){if(S===M[Q][R]){P=R}}O(N[S].obj);if(N[S].sub){O(N[S].sub)}delete N[S];M[Q].splice(P,1);return true}return false};this.objGetById=function(R){var Q;if(M.clusterer){for(var P in M.clusterer){if((Q=N[M.clusterer[P]].obj.getById(R))!==false){return Q}}}return false};this.objClearById=function(Q){if(M.clusterer){for(var P in M.clusterer){if(N[M.clusterer[P]].obj.clearById(Q)){return true}}}return null};this.clear=function(V,U,W,P){var R,T,S,Q=C(P);if(!V||!V.length){V=[];for(R in M){V.push(R)}}else{V=g(V)}for(T=0;T<V.length;T++){S=V[T];if(U){this.rm(S,Q,true)}else{if(W){this.rm(S,Q,false)}else{while(this.rm(S,Q,false)){}}}}};this.objClear=function(S,R,T,Q){if(M.clusterer&&(y.inArray("marker",S)>=0||!S.length)){for(var P in M.clusterer){N[M.clusterer[P]].obj.clear(R,T,Q)}}}}var m={},H=new r();function p(){if(!m.geocoder){m.geocoder=new google.maps.Geocoder()}return m.geocoder}function G(){if(!m.directionsService){m.directionsService=new google.maps.DirectionsService()}return m.directionsService}function h(){if(!m.elevationService){m.elevationService=new google.maps.ElevationService()}return m.elevationService}function q(){if(!m.maxZoomService){m.maxZoomService=new google.maps.MaxZoomService()}return m.maxZoomService}function B(){if(!m.distanceMatrixService){m.distanceMatrixService=new google.maps.DistanceMatrixService()}return m.distanceMatrixService}function u(){if(z.verbose){var L,M=[];if(window.console&&(typeof console.error==="function")){for(L=0;L<arguments.length;L++){M.push(arguments[L])}console.error.apply(console,M)}else{M="";for(L=0;L<arguments.length;L++){M+=arguments[L].toString()+" "}alert(M)}}}function E(L){return(typeof(L)==="number"||typeof(L)==="string")&&L!==""&&!isNaN(L)}function g(N){var M,L=[];if(N!==t){if(typeof(N)==="object"){if(typeof(N.length)==="number"){L=N}else{for(M in N){L.push(N[M])}}}else{L.push(N)}}return L}function C(L){if(L){if(typeof L==="function"){return L}L=g(L);return function(N){if(N===t){return false}if(typeof N==="object"){for(var M=0;M<N.length;M++){if(y.inArray(N[M],L)>=0){return true}}return false}return y.inArray(N,L)>=0}}}function I(M,O,L){var N=O?M:null;if(!M||(typeof M==="string")){return N}if(M.latLng){return I(M.latLng)}if(M instanceof google.maps.LatLng){return M}else{if(E(M.lat)){return new google.maps.LatLng(M.lat,M.lng)}else{if(!L&&y.isArray(M)){if(!E(M[0])||!E(M[1])){return N}return new google.maps.LatLng(M[0],M[1])}}}return N}function j(M){var N,L;if(!M||M instanceof google.maps.LatLngBounds){return M||null}if(y.isArray(M)){if(M.length==2){N=I(M[0]);L=I(M[1])}else{if(M.length==4){N=I([M[0],M[1]]);L=I([M[2],M[3]])}}}else{if(("ne" in M)&&("sw" in M)){N=I(M.ne);L=I(M.sw)}else{if(("n" in M)&&("e" in M)&&("s" in M)&&("w" in M)){N=I([M.n,M.e]);L=I([M.s,M.w])}}}if(N&&L){return new google.maps.LatLngBounds(L,N)}return null}function v(T,L,O,S,P){var N=O?I(S.todo,false,true):false,R=N?{latLng:N}:(S.todo.address?(typeof(S.todo.address)==="string"?{address:S.todo.address}:S.todo.address):false),M=R?H.get(R):false,Q=this;if(R){P=P||0;if(M){S.latLng=M.results[0].geometry.location;S.results=M.results;S.status=M.status;L.apply(T,[S])}else{if(R.location){R.location=I(R.location)}if(R.bounds){R.bounds=j(R.bounds)}p().geocode(R,function(V,U){if(U===google.maps.GeocoderStatus.OK){H.store(R,{results:V,status:U});S.latLng=V[0].geometry.location;S.results=V;S.status=U;L.apply(T,[S])}else{if((U===google.maps.GeocoderStatus.OVER_QUERY_LIMIT)&&(P<z.queryLimit.attempt)){setTimeout(function(){v.apply(Q,[T,L,O,S,P+1])},z.queryLimit.delay+Math.floor(Math.random()*z.queryLimit.random))}else{u("geocode failed",U,R);S.latLng=S.results=false;S.status=U;L.apply(T,[S])}}})}}else{S.latLng=I(S.todo,false,true);L.apply(T,[S])}}function x(Q,L,R,M){var O=this,N=-1;function P(){do{N++}while((N<Q.length)&&!("address" in Q[N]));if(N>=Q.length){R.apply(L,[M]);return}v(O,function(S){delete S.todo;y.extend(Q[N],S);P.apply(O,[])},true,{todo:Q[N]})}P()}function o(L,O,M){var N=false;if(navigator&&navigator.geolocation){navigator.geolocation.getCurrentPosition(function(P){if(N){return}N=true;M.latLng=new google.maps.LatLng(P.coords.latitude,P.coords.longitude);O.apply(L,[M])},function(){if(N){return}N=true;M.latLng=false;O.apply(L,[M])},M.opts.getCurrentPosition)}else{M.latLng=false;O.apply(L,[M])}}function K(T){var S=this,U=new l(),V=new D(),N=null,P;this._plan=function(Z){for(var Y=0;Y<Z.length;Y++){U.add(new w(S,R,Z[Y]))}Q()};function Q(){if(!P&&(P=U.get())){P.run()}}function R(){P=null;U.ack();Q.call(S)}function X(Y){if(Y.todo.callback){var Z=Array.prototype.slice.call(arguments,1);if(typeof Y.todo.callback==="function"){Y.todo.callback.apply(T,Z)}else{if(y.isArray(Y.todo.callback)){if(typeof Y.todo.callback[1]==="function"){Y.todo.callback[1].apply(Y.todo.callback[0],Z)}}}}}function O(Y,Z,aa){if(aa){n(T,Y,Z,aa)}X(Y,Z);P.ack(Z)}function L(aa,Y){Y=Y||{};if(N){if(Y.todo&&Y.todo.options){if(Y.todo.options.center){Y.todo.options.center=I(Y.todo.options.center)}N.setOptions(Y.todo.options)}}else{var Z=Y.opts||y.extend(true,{},z.map,Y.todo&&Y.todo.options?Y.todo.options:{});Z.center=aa||I(Z.center);N=new z.classes.Map(T.get(0),Z)}}this.map=function(Y){L(Y.latLng,Y);n(T,Y,N);O(Y,N)};this.destroy=function(Y){V.clear();T.empty();if(N){N=null}O(Y,true)};this.infowindow=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){if(Z.latLng){Z.opts.position=Z.latLng}Z.todo.values=[{options:Z.opts}]}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.position=ab.options.position?I(ab.options.position):I(ad.latLng);if(!N){L(ab.options.position)}ae=new z.classes.InfoWindow(ab.options);if(ae&&((ab.open===t)||ab.open)){if(Y){ae.open(N,ab.anchor?ab.anchor:t)}else{ae.open(N,ab.anchor?ab.anchor:(Z.latLng?t:(Z.session.marker?Z.session.marker:t)))}}aa.push(ae);af=V.add({todo:ab},"infowindow",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.circle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.opts.center=Z.latLng||I(Z.opts.center);Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.center=ab.options.center?I(ab.options.center):I(ad);if(!N){L(ab.options.center)}ab.options.map=N;ae=new z.classes.Circle(ab.options);aa.push(ae);af=V.add({todo:ab},"circle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.overlay=function(aa,Z){var ab=[],Y="values" in aa.todo;if(!Y){aa.todo.values=[{latLng:aa.latLng,options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(!e.__initialised){e.prototype=new z.classes.OverlayView();e.__initialised=true}y.each(aa.todo.values,function(ae,af){var ah,ag,ac=b(aa,af),ad=y(document.createElement("div")).css({border:"none",borderWidth:"0px",position:"absolute"});ad.append(ac.options.content);ag=new e(N,ac.options,I(ac)||I(af),ad);ab.push(ag);ad=null;if(!Z){ah=V.add(aa,"overlay",ag);n(T,{todo:ac},ag,ah)}});if(Z){return ab[0]}O(aa,Y?ab:ab[0])};this.getaddress=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getlatlng=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getmaxzoom=function(Y){q().getMaxZoomAtLatLng(Y.latLng,function(Z){X(Y,Z.status===google.maps.MaxZoomStatus.OK?Z.zoom:false,status);P.ack()})};this.getelevation=function(Z){var aa,Y=[],ab=function(ad,ac){X(Z,ac===google.maps.ElevationStatus.OK?ad:false,ac);P.ack()};if(Z.latLng){Y.push(Z.latLng)}else{Y=g(Z.todo.locations||[]);for(aa=0;aa<Y.length;aa++){Y[aa]=I(Y[aa])}}if(Y.length){h().getElevationForLocations({locations:Y},ab)}else{if(Z.todo.path&&Z.todo.path.length){for(aa=0;aa<Z.todo.path.length;aa++){Y.push(I(Z.todo.path[aa]))}}if(Y.length){h().getElevationAlongPath({path:Y,samples:Z.todo.samples},ab)}else{P.ack()}}};this.defaults=function(Y){y.each(Y.todo,function(Z,aa){if(typeof z[Z]==="object"){z[Z]=y.extend({},z[Z],aa)}else{z[Z]=aa}});P.ack(true)};this.rectangle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.bounds=ab.options.bounds?j(ab.options.bounds):j(ad);if(!N){L(ab.options.bounds.getCenter())}ab.options.map=N;ae=new z.classes.Rectangle(ab.options);aa.push(ae);af=V.add({todo:ab},"rectangle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};function M(Z,aa,ab){var ac=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}L();y.each(Z.todo.values,function(af,ah){var aj,ag,ae,ai,ad=b(Z,ah);if(ad.options[ab]){if(ad.options[ab][0][0]&&y.isArray(ad.options[ab][0][0])){for(ag=0;ag<ad.options[ab].length;ag++){for(ae=0;ae<ad.options[ab][ag].length;ae++){ad.options[ab][ag][ae]=I(ad.options[ab][ag][ae])}}}else{for(ag=0;ag<ad.options[ab].length;ag++){ad.options[ab][ag]=I(ad.options[ab][ag])}}}ad.options.map=N;ai=new google.maps[aa](ad.options);ac.push(ai);aj=V.add({todo:ad},aa.toLowerCase(),ai);n(T,{todo:ad},ai,aj)});O(Z,Y?ac:ac[0])}this.polyline=function(Y){M(Y,"Polyline","path")};this.polygon=function(Y){M(Y,"Polygon","paths")};this.trafficlayer=function(Y){L();var Z=V.get("trafficlayer");if(!Z){Z=new z.classes.TrafficLayer();Z.setMap(N);V.add(Y,"trafficlayer",Z)}O(Y,Z)};this.bicyclinglayer=function(Y){L();var Z=V.get("bicyclinglayer");if(!Z){Z=new z.classes.BicyclingLayer();Z.setMap(N);V.add(Y,"bicyclinglayer",Z)}O(Y,Z)};this.groundoverlay=function(Y){Y.opts.bounds=j(Y.opts.bounds);if(Y.opts.bounds){L(Y.opts.bounds.getCenter())}var aa,Z=new z.classes.GroundOverlay(Y.opts.url,Y.opts.bounds,Y.opts.opts);Z.setMap(N);aa=V.add(Y,"groundoverlay",Z);O(Y,Z,aa)};this.streetviewpanorama=function(Y){if(!Y.opts.opts){Y.opts.opts={}}if(Y.latLng){Y.opts.opts.position=Y.latLng}else{if(Y.opts.opts.position){Y.opts.opts.position=I(Y.opts.opts.position)}}if(Y.todo.divId){Y.opts.container=document.getElementById(Y.todo.divId)}else{if(Y.opts.container){Y.opts.container=y(Y.opts.container).get(0)}}var aa,Z=new z.classes.StreetViewPanorama(Y.opts.container,Y.opts.opts);if(Z){N.setStreetView(Z)}aa=V.add(Y,"streetviewpanorama",Z);O(Y,Z,aa)};this.kmllayer=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ad,ae){var ag,af,ac,ab=b(Z,ae);if(!N){L()}ac=ab.options;if(ab.options.opts){ac=ab.options.opts;if(ab.options.url){ac.url=ab.options.url}}ac.map=N;if(d("3.10")){af=new z.classes.KmlLayer(ac)}else{af=new z.classes.KmlLayer(ac.url,ac)}aa.push(af);ag=V.add({todo:ab},"kmllayer",af);n(T,{todo:ab},af,ag)});O(Z,Y?aa:aa[0])};this.panel=function(ab){L();var ad,Y=0,ac=0,aa,Z=y(document.createElement("div"));Z.css({position:"absolute",zIndex:1000,visibility:"hidden"});if(ab.opts.content){aa=y(ab.opts.content);Z.append(aa);T.first().prepend(Z);if(ab.opts.left!==t){Y=ab.opts.left}else{if(ab.opts.right!==t){Y=T.width()-aa.width()-ab.opts.right}else{if(ab.opts.center){Y=(T.width()-aa.width())/2}}}if(ab.opts.top!==t){ac=ab.opts.top}else{if(ab.opts.bottom!==t){ac=T.height()-aa.height()-ab.opts.bottom}else{if(ab.opts.middle){ac=(T.height()-aa.height())/2}}}Z.css({top:ac,left:Y,visibility:"visible"})}ad=V.add(ab,"panel",Z);O(ab,Z,ad);Z=null};function W(aa){var af=new F(T,N,aa),Y={},ab={},ae=[],ad=/^[0-9]+$/,ac,Z;for(Z in aa){if(ad.test(Z)){ae.push(1*Z);ab[Z]=aa[Z];ab[Z].width=ab[Z].width||0;ab[Z].height=ab[Z].height||0}else{Y[Z]=aa[Z]}}ae.sort(function(ah,ag){return ah>ag});if(Y.calculator){ac=function(ag){var ah=[];y.each(ag,function(aj,ai){ah.push(af.value(ai))});return Y.calculator.apply(T,[ah])}}else{ac=function(ag){return ag.length}}af.error(function(){u.apply(S,arguments)});af.display(function(ag){var ai,aj,am,ak,al,ah=ac(ag.indexes);if(aa.force||ah>1){for(ai=0;ai<ae.length;ai++){if(ae[ai]<=ah){aj=ab[ae[ai]]}}}if(aj){al=aj.offset||[-aj.width/2,-aj.height/2];am=y.extend({},Y);am.options=y.extend({pane:"overlayLayer",content:aj.content?aj.content.replace("CLUSTER_COUNT",ah):"",offset:{x:("x" in al?al.x:al[0])||0,y:("y" in al?al.y:al[1])||0}},Y.options||{});ak=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);am.options.pane="floatShadow";am.options.content=y(document.createElement("div")).width(aj.width+"px").height(aj.height+"px").css({cursor:"pointer"});shadow=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);Y.data={latLng:I(ag),markers:[]};y.each(ag.indexes,function(ao,an){Y.data.markers.push(af.value(an));if(af.markerIsSet(an)){af.marker(an).setMap(null)}});n(T,{todo:Y},shadow,t,{main:ak,shadow:shadow});af.store(ag,ak,shadow)}else{y.each(ag.indexes,function(ao,an){af.marker(an).setMap(N)})}});return af}this.marker=function(aa){var Y="values" in aa.todo,ad=!N;if(!Y){aa.opts.position=aa.latLng||I(aa.opts.position);aa.todo.values=[{options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(ad){L()}if(aa.todo.cluster&&!N.getBounds()){google.maps.event.addListenerOnce(N,"bounds_changed",function(){S.marker.apply(S,[aa])});return}if(aa.todo.cluster){var Z,ab;if(aa.todo.cluster instanceof a){Z=aa.todo.cluster;ab=V.getById(Z.id(),true)}else{ab=W(aa.todo.cluster);Z=new a(k(aa.todo.id,true),ab);V.add(aa,"clusterer",Z,ab)}ab.beginUpdate();y.each(aa.todo.values,function(af,ag){var ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ab.add(ae,ag)});ab.endUpdate();O(aa,Z)}else{var ac=[];y.each(aa.todo.values,function(af,ag){var ai,ah,ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ah=new z.classes.Marker(ae.options);ac.push(ah);ai=V.add({todo:ae},"marker",ah);n(T,{todo:ae},ah,ai)});O(aa,Y?ac:ac[0])}};this.getroute=function(Y){Y.opts.origin=I(Y.opts.origin,true);Y.opts.destination=I(Y.opts.destination,true);G().route(Y.opts,function(aa,Z){X(Y,Z==google.maps.DirectionsStatus.OK?aa:false,Z);P.ack()})};this.directionsrenderer=function(Y){Y.opts.map=N;var aa,Z=new google.maps.DirectionsRenderer(Y.opts);if(Y.todo.divId){Z.setPanel(document.getElementById(Y.todo.divId))}else{if(Y.todo.container){Z.setPanel(y(Y.todo.container).get(0))}}aa=V.add(Y,"directionsrenderer",Z);O(Y,Z,aa)};this.getgeoloc=function(Y){O(Y,Y.latLng)};this.styledmaptype=function(Y){L();var Z=new z.classes.StyledMapType(Y.todo.styles,Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.imagemaptype=function(Y){L();var Z=new z.classes.ImageMapType(Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.autofit=function(Y){var Z=new google.maps.LatLngBounds();y.each(V.all(),function(aa,ab){if(ab.getPosition){Z.extend(ab.getPosition())}else{if(ab.getBounds){Z.extend(ab.getBounds().getNorthEast());Z.extend(ab.getBounds().getSouthWest())}else{if(ab.getPaths){ab.getPaths().forEach(function(ac){ac.forEach(function(ad){Z.extend(ad)})})}else{if(ab.getPath){ab.getPath().forEach(function(ac){Z.extend(ac);""})}else{if(ab.getCenter){Z.extend(ab.getCenter())}else{if(ab instanceof a){ab=V.getById(ab.id(),true);if(ab){ab.autofit(Z)}}}}}}}});if(!Z.isEmpty()&&(!N.getBounds()||!N.getBounds().equals(Z))){if("maxZoom" in Y.todo){google.maps.event.addListenerOnce(N,"bounds_changed",function(){if(this.getZoom()>Y.todo.maxZoom){this.setZoom(Y.todo.maxZoom)}})}N.fitBounds(Z)}O(Y,true)};this.clear=function(Y){if(typeof Y.todo==="string"){if(V.clearById(Y.todo)||V.objClearById(Y.todo)){O(Y,true);return}Y.todo={name:Y.todo}}if(Y.todo.id){y.each(g(Y.todo.id),function(Z,aa){V.clearById(aa)||V.objClearById(aa)})}else{V.clear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag);V.objClear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag)}O(Y,true)};this.exec=function(Y){var Z=this;y.each(g(Y.todo.func),function(aa,ab){y.each(Z.get(Y.todo,true,Y.todo.hasOwnProperty("full")?Y.todo.full:true),function(ac,ad){ab.call(T,ad)})});O(Y,true)};this.get=function(aa,ad,ac){var Z,ab,Y=ad?aa:aa.todo;if(!ad){ac=Y.full}if(typeof Y==="string"){ab=V.getById(Y,false,ac)||V.objGetById(Y);if(ab===false){Z=Y;Y={}}}else{Z=Y.name}if(Z==="map"){ab=N}if(!ab){ab=[];if(Y.id){y.each(g(Y.id),function(ae,af){ab.push(V.getById(af,false,ac)||V.objGetById(af))});if(!y.isArray(Y.id)){ab=ab[0]}}else{y.each(Z?g(Z):[t],function(af,ag){var ae;if(Y.first){ae=V.get(ag,false,Y.tag,ac);if(ae){ab.push(ae)}}else{if(Y.all){y.each(V.all(ag,Y.tag,ac),function(ai,ah){ab.push(ah)})}else{ae=V.get(ag,true,Y.tag,ac);if(ae){ab.push(ae)}}}});if(!Y.all&&!y.isArray(Z)){ab=ab[0]}}}ab=y.isArray(ab)||!Y.all?ab:[ab];if(ad){return ab}else{O(aa,ab)}};this.getdistance=function(Y){var Z;Y.opts.origins=g(Y.opts.origins);for(Z=0;Z<Y.opts.origins.length;Z++){Y.opts.origins[Z]=I(Y.opts.origins[Z],true)}Y.opts.destinations=g(Y.opts.destinations);for(Z=0;Z<Y.opts.destinations.length;Z++){Y.opts.destinations[Z]=I(Y.opts.destinations[Z],true)}B().getDistanceMatrix(Y.opts,function(ab,aa){X(Y,aa===google.maps.DistanceMatrixStatus.OK?ab:false,aa);P.ack()})};this.trigger=function(Z){if(typeof Z.todo==="string"){google.maps.event.trigger(N,Z.todo)}else{var Y=[N,Z.todo.eventName];if(Z.todo.var_args){y.each(Z.todo.var_args,function(ab,aa){Y.push(aa)})}google.maps.event.trigger.apply(google.maps.event,Y)}X(Z);P.ack()}}function s(M){var L;if(!typeof M==="object"||!M.hasOwnProperty("get")){return false}for(L in M){if(L!=="get"){return false}}return !M.get.hasOwnProperty("callback")}y.fn.gmap3=function(){var M,O=[],N=true,L=[];J();for(M=0;M<arguments.length;M++){if(arguments[M]){O.push(arguments[M])}}if(!O.length){O.push("map")}y.each(this,function(){var P=y(this),Q=P.data("gmap3");N=false;if(!Q){Q=new K(P);P.data("gmap3",Q)}if(O.length===1&&(O[0]==="get"||s(O[0]))){if(O[0]==="get"){L.push(Q.get("map",true))}else{L.push(Q.get(O[0].get,true,O[0].get.full))}}else{Q._plan(O)}});if(L.length){if(L.length===1){return L[0]}else{return L}}return this}})(jQuery);





/* ====== INTERNAL FUNCTIONS ====== */


/* --- DETECT VIEWPORT SIZE --- */

function browserSize(){
    wh = $(window).height();
    ww = $(window).width();
    dh = $(document).height();
    ar = ww/wh;
};





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





/* --- NICESCROLL --- */

function niceScrollInit() {

    var smoothScroll = $('body').data('smoothscrolling') !== undefined;
    
    if ($('.site-navigation').length) {
        var offset = $('.site-navigation').offset();
        mobile = offset.left > ww;
    }

    if (smoothScroll && ww > 899 && !touch && !is_OSX) {
        $('html').addClass('nicescroll');
        $('[data-smoothscrolling]').niceScroll({
            zindex: 9999,
            cursoropacitymin: 0.3,
            cursorwidth: 7,
            cursorborder: 0,
            mousescrollstep: 40,
            scrollspeed: 100,
            cursorcolor: '#000000'
        });
    }
}





/* --- ROYALSLIDER --- */

function royalSliderInit() {

    // Helper function
    // examples
    // console.log(padLeft(23,5));       //=> '00023'
    // console.log(padLeft(23,5,'>>'));  //=> '>>>>>>23'
    function padLeft(nr, n, str){
        return Array(n-String(nr).length+1).join(str||'0')+nr;
    }

    // create the markup for the slider from the gallery shortcode
    // take all the images and insert them in the .gallery <div>
    $('.wp-gallery').each(function() {
        var $old_gallery = $(this),
        $images = $old_gallery.find('img'),
        $new_gallery = $('<div class="pixslider js-pixslider">');
        $images.prependTo($new_gallery).addClass('rsImg');
        $old_gallery.replaceWith($new_gallery);

        var gallery_data = $(this).data();
        $new_gallery.data(gallery_data);
    });

    $('.js-pixslider').each(function(){

        var $slider = $(this),
            rs_arrows = typeof $slider.data('arrows') !== "undefined",
            rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
            rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
            rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
            rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
            rs_keyboardNav  = typeof $slider.data('fullscreen') !== "undefined";
            rs_imageScale  = typeof $slider.data('imagescale') !== "undefined" && $slider.data('imagescale') != '' ? $slider.data('imagescale') : 'fill';
            rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
            rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
            rs_drag = true;


        var $children = $(this).children();

        if($children.length == 1){
            rs_arrows = false;
            rs_bullets = 'none';
            rs_customArrows = false;
            rs_keyboardNav = false;
            rs_drag = false;
            rs_transition = 'fade';
        }
        
        // make sure default arrows won't appear if customArrows is set
        if (rs_customArrows) arrows = false;

        if (rs_autoheight) {
            $slider.royalSlider({
                autoHeight: true,
                autoScaleSlider: false,
                loop: true,
                imageScaleMode: 'none',
                imageAlignCenter: rs_imageAlignCenter,
                slidesSpacing: rs_slidesSpacing,
                arrowsNav: rs_arrows,
                controlNavigation: rs_bullets,
                keyboardNavEnabled: rs_keyboardNav,
                arrowsNavAutoHide: false,
                sliderDrag: rs_drag,
                transitionType: rs_transition
            });
        } else {
            $slider.royalSlider({
                autoScaleSlider: true,
                autoHeight: false,
                loop: true,
                imageScaleMode: rs_imageScale,
                imageAlignCenter: rs_imageAlignCenter,
                slidesSpacing: rs_slidesSpacing,
                arrowsNav: rs_arrows,
                controlNavigation: rs_bullets,
                keyboardNavEnabled: rs_keyboardNav,
                arrowsNavAutoHide: false,
                sliderDrag: rs_drag,
                transitionType: rs_transition
            });     
        }

        var royalSlider = $slider.data('royalSlider');
        var slidesNumber = royalSlider.numSlides;

        // create the markup for the customArrows
        if(slidesNumber > 1)
        if (royalSlider && rs_customArrows) {
                var $gallery_control = $(
                    '<div class="gallery-control">' +
                        '<a href="#" class="control-item arrow-button arrow-button--left js-slider-arrow-prev"></a>' +
                        '<div class="control-item count js-gallery-current-slide">' +
                            '<span class="highlighted js-decimal">0</span><span class="js-unit">1</span>' +
                            '<sup class="js-gallery-slides-total">0</sup>' +
                        '</div>' +
                        '<a href="#" class="control-item arrow-button arrow-button--right js-slider-arrow-next"></a>'+
                    '</div>'
                );

            if ($slider.data('customarrows') == "left") {
                $gallery_control.addClass('gallery-control--left');
            }

            $gallery_control.insertAfter($slider);

            // write the total number of slides inside the markup created above
            // make sure it is left padded with 0 in case it is lower than 10
            slidesNumber = (slidesNumber < 10) ? padLeft(slidesNumber, 2) : slidesNumber;
            $gallery_control.find('.js-gallery-slides-total').html(slidesNumber);
            
            // add event listener to change the current slide number on slide change
            royalSlider.ev.on('rsBeforeAnimStart', function(event) {
                var currentSlide = royalSlider.currSlideId + 1;
                if(currentSlide < 10){
                    $gallery_control.find('.js-gallery-current-slide .js-decimal').html('0');
                    $gallery_control.find('.js-gallery-current-slide .js-unit').html(currentSlide);
                } else {
                    $gallery_control.find('.js-gallery-current-slide .js-decimal').html(Math.floor(currentSlide / 10));
                    $gallery_control.find('.js-gallery-current-slide .js-unit').html(currentSlide % 10);
                }
            });

            $gallery_control.on('click', '.js-slider-arrow-prev', function(event){
                event.preventDefault();
                royalSlider.prev();
            });

            $gallery_control.on('click', '.js-slider-arrow-next', function(event){
                event.preventDefault();
                royalSlider.next();
            });    
        }
    });
};





/* --- MAGNIFIC POPUP --- */

function magnificPopupInit() {

    $('.js-gallery').each(function() { // the containers for all your galleries should have the class gallery
        $(this).magnificPopup({
            delegate: '.mosaic__item a', // the container for each your gallery items
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
            iframe: {
                markup:
                    '<div class="mfp-figure mfp-figure--video">'+
                        '<div class="mfp-img">'+
                            '<div class="mfp-iframe-scaler">'+
                                '<div class="mfp-close"></div>'+
                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                            '</div>'+
                        '</div>'+
                        '<div class="mfp-bottom-bar">'+
                            '<div class="mfp-counter"></div>'+
                        '</div>'+
                    '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                        id: 'v=', // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }
                        src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                // you may add here more sources
                },
                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                // arrowMarkup: '<a href="#" class="mfp-arrow mfp-arrow-%dir% control-item arrow-button arrow-button--%dir%"></a>',
                tPrev: 'Previous (Left arrow key)', // title for left button
                tNext: 'Next (Right arrow key)', // title for right button
                // tCounter: '<div class="gallery-control gallery-control--popup"><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div></div>'
                tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
            },
            callbacks:{
                elementParse: function(item) {
                    $(item).find('iframe').each(function(){
                        var url = $(this).attr("src");
                        $(this).attr("src", url+"?wmode=transparent");
                    });
                },
                change: function() {
                    $(this.content).find('iframe').each(function(){
                        var url = $(this).attr("src");
                        $(this).attr("src", url+"?wmode=transparent");
                    });
                }                
            }
        });
    });
	
	// hide title on hover over images so we don't have that ugly tooltip
	// replace when hover leaves
	var tempGalleryTitle = '';
	$('.js-gallery a').hover(
		function () {			
			tempGalleryTitle = $(this).attr('title');
			$(this).attr({'title':''});
		}, 
		function () {
			$(this).attr({'title':tempGalleryTitle});
		}
	);

    $('.js-project-gallery').each(function() { // the containers for all your galleries should have the class gallery
        $(this).magnificPopup({
            delegate: 'a[href$=".jpg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
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
	        iframe: {
		        markup:
			        '<div class="mfp-figure mfp-figure--video">'+
				        '<div class="mfp-img">'+
				        '<div class="mfp-iframe-scaler">'+
				        '<div class="mfp-close"></div>'+
				        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
				        '</div>'+
				        '</div>'+
				        '<div class="mfp-bottom-bar">'+
				        '<div class="mfp-counter"></div>'+
				        '</div>'+
				        '</div>',
		        patterns: {
			        youtube: {
				        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
				        id: 'v=', // String that splits URL in a two parts, second part should be %id%
				        // Or null - full URL will be returned
				        // Or a function that should return %id%, for example:
				        // id: function(url) { return 'parsed id'; }
				        src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
			        },
			        vimeo: {
				        index: 'vimeo.com/',
				        id: '/',
				        src: '//player.vimeo.com/video/%id%'
			        },
			        gmaps: {
				        index: '//maps.google.',
				        src: '%id%&output=embed'
			        }
			        // you may add here more sources
		        },
		        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
	        },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                tPrev: 'Previous (Left arrow key)', // title for left button
                tNext: 'Next (Right arrow key)', // title for right button
                tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
            },
	        callbacks:{
		        elementParse: function(item) {
			        $(item).find('iframe').each(function(){
				        var url = $(this).attr("src");
				        $(this).attr("src", url+"?wmode=transparent");
			        });
		        },
		        change: function() {
			        $(this.content).find('iframe').each(function(){
				        var url = $(this).attr("src");
				        $(this).attr("src", url+"?wmode=transparent");
			        });
		        }
	        }
        });
    });
	
	// hide title on hover over images so we don't have that ugly tooltip
	// replace when hover leaves
	var tempProjectTitle = '';
	$('.js-project-gallery a').hover(
		function () {			
			tempProjectTitle = $(this).attr('title');
			$(this).attr({'title':''});
		}, 
		function () {
			$(this).attr({'title':tempProjectTitle});
		}
	);
}





/* --- MOSAIC INIT --- */

function mosaicInit() {
    $('.mosaic').mixitup({
        targetSelector: '.mosaic__item',
        easing: 'snap'
    });

    $('.mosaic__item .image_item-meta--portfolio .image_item-table').each(function() {
        $(this).hoverdir();
    });
}





/* --- GMAP --- */

function gmapInit() {
    if ($('#gmap').length) {

        var gmap_link, gmap_variables, gmap_zoom, gmap_style;
            gmap_link = $('#gmap').data('url');
            gmap_style = typeof $('#gmap').data('customstyle') !== "undefined" ? "style1" : google.maps.MapTypeId.ROADMAP;

        // Overwrite Math.log to accept a second optional parameter as base for logarhitm
        Math.log = (function() {
            var log = Math.log;
            return function(n, base) {
            return log(n)/(base ? log(base) : 1);
            };
        })();

        function get_url_parameter(needed_param, gmap_url) {
            var sURLVariables = (gmap_url.split('?'))[1];
            if (typeof sURLVariables === "undefined") {
                return sURLVariables;
            }
            sURLVariables = sURLVariables.split('&');
            for (var i = 0; i < sURLVariables.length; i++)  {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == needed_param) {
                    return sParameterName[1];
                }
            }
        }

        if (gmap_link) {
            //Parse the URL and load variables (ll = latitude/longitude; z = zoom)
            var gmap_variables = get_url_parameter('ll', gmap_link);
            if (typeof gmap_variables === "undefined") {
                gmap_variables = get_url_parameter('sll', gmap_link);
            }
            // if gmap_variables is still undefined that means the url was pasted from the new version of google maps
            if (typeof gmap_variables === "undefined") {
                var splis, lt, ln, dist, z;
                split = gmap_link.split('!3d');
                lt = split[1];
                split = split[0].split('!2d');
                ln = split[1];
                split = split[0].split('!1d');
                dist = split[1];
                var gmap_zoom = 21 - Math.round(Math.log(Math.round(dist/218), 2));
                var gmap_coordinates = [lt, ln];
            } else {
                var gmap_zoom = get_url_parameter('z', gmap_link);
                if (typeof gmap_zoom === "undefined") {
                    gmap_zoom = 10;
                }
                var gmap_coordinates = gmap_variables.split(',');
            }
        }

        $("#gmap").gmap3({
            map:{
                options:{
                    center: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
                    zoom: parseInt(gmap_zoom),
                    mapTypeId: gmap_style,
                    mapTypeControlOptions: {mapTypeIds: []},
                    scrollwheel: false
                }
            },
            overlay:{
                latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
                options:{
                    content:  '<div class="pin_ring pin_ring--outer">' +
                        '<div class="pin_ring pin_ring--inner"></div>' +
                        '</div>',
                }
            },
            styledmaptype:{
                id: "style1",
                options:{
                    name: "Style 1"
                },
                styles: [
                    {
                        stylers: [
                            { saturation: -100 }
                        ]
                    }
                ]
            }
        });
    }
}





/* --- $VIDEOS --- */

function initVideos() {

    var videos = $('.video-wrap iframe, video');

    // Figure out and save aspect ratio for each video
    videos.each(function() {
        $(this).data('aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    // Firefox Opacity Video Hack
    $('iframe').each(function(){
        var url = $(this).attr("src"); console.log(url);
        $(this).attr("src", url+"?wmode=transparent");
    });
}


function resizeVideos() {
    
    var videos = $('.video-wrap iframe, video');

    videos.each(function() {
        var video = $(this),
            ratio = video.data('aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w/ratio;
        video.height(h);
    });
}


function placeFooter() {

    var sh = $('.sidebar--header').outerHeight(true),
        hh = $('.site-header').outerHeight(true),
        fh = $('.site-footer').outerHeight(true);

    if (wh < hh + fh + sh) {
        $('.site-footer').css({ 
            "position": "static",
            "margin-left": 0,
            "padding-right": "24px"
        });
    } else {
        $('.site-footer').css({ 
            "position": "",
            "margin-left": "",
            "padding-right": ""
        });
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
    
    /* INSTANTIATE DJAX */
    if ($('body').data('ajaxloading') !== undefined) {

        var djax_transition = function($newEl) {
            var $oldEl = this;
            $oldEl.replaceWith($newEl);
            // we should make sure initial transition ended
            setTimeout(function() {
                $('html').removeClass('loading');
            });
        }

        $('body').djax('.djax-updatable', ['pdf','doc','eps','png','zip','admin','wp-','feed','#'], djax_transition);

    }

    if (is_android) {
        $('html').addClass('android-browser');
    } else {
        $('html').addClass('no-android-browser');
    }    

    var is_retina = (window.retina || window.devicePixelRatio > 1);

    if (is_retina && $('.site-logo--image-2x').length) {
        var image = $('.site-logo--image-2x').find('img');

        if (image.data('logo2x') !== undefined) {
            image.attr('src', image.data('logo2x'));
        }
    }

    $('html').addClass('loaded');
    
    var h = $(window).height(),
        sh = $('.site-header__branding').outerHeight(true),
        hh = $('.site-header').outerHeight(true),
        fh = $('.site-footer').outerHeight(true);

    if (h < hh + sh + fh) {
        $('.site-footer').css({
            "position": "static",
            "margin-left": 0,
            "padding-right": "24px"
        });
    }

    // $(function() {
    //     FastClick.attach(document.body);
    // });
    
    /* ONE TIME EVENT HANDLERS */
    eventHandlersOnce();
    
    /* INSTANTIATE EVENT HANDLERS */
    eventHandlers();
};





/* --- PROGRESSBAR --- */

function progressbarInit() {
    var progressbar_shc = $('.progressbar');
        progressbar_shc.addClass('is-visible');
    if (progressbar_shc.length) {
        progressbar_shc.each(function() {
            var self = $(this).find('.progressbar__progress');
            self.css({'width': self.data('value')});
        });;
    }
}





/* ====== CONDITIONAL LOADING ====== */

function loadUp(){

    // always
    niceScrollInit();
    initVideos();
    resizeVideos();
    progressbarInit();

    if (is_safari_win) {
        $('html').removeClass('cssanimations').addClass('no-cssanimations');
    }    

    // 
    lazyLoad();
    
    // if blog archive
    if ($('.masonry').length && !lteie9 && !is_android) {
        salvattore();
    }

    // royal slider must initialize after salavottre
    // for the layout to show up properly
    royalSliderInit();

    // if gallery
    magnificPopupInit();

    // if gallery grid or portfolio
    mosaicInit();

    // if contact
    gmapInit();

    $(".pixcode-tabs").tab();


    /* --- ANIMATE STUFF IN --- */
    animateGallery('in');
    animateBlog('in');
}






/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {


    $('.js-nav-trigger').on('click', function(e) {
        var hh = $('.header').height(),
            ch = $('.content').height(),
            max = Math.max(wh,ch,hh);
            console.log(max);
        if ($('html').hasClass('navigation--is-visible')) {
            $('#page').css({'height': ''});
        } else {
            $('#page').css({'height': max});
        }

        $('html').toggleClass('navigation--is-visible');
    }); 
};


function likeBoxAnimation(){
    $(document).on('click', '.can_like .like-link', function(e){
        e.preventDefault();
        var $iElem = $(this).find('i');
        $iElem.addClass('animate-like').delay(1000).queue(function(){$(this).addClass('like-complete');});
        // $(this).addClass('animate-like');
    });
}


/* --- GLOBAL EVENT HANDLERS --- */

function magnificPrev(e) {
        e.preventDefault();
        var magnificPopup = $.magnificPopup.instance;
        magnificPopup.prev();
        return false;
}

function magnificNext(e) {
        e.preventDefault();
        var magnificPopup = $.magnificPopup.instance;
        magnificPopup.next();
        return false;
}

function eventHandlers() {

    $('body').off('click', '.js-arrow-popup-prev', magnificPrev).on('click', '.js-arrow-popup-prev', magnificPrev);
    $('body').off('click', '.js-arrow-popup-next', magnificNext).on('click', '.js-arrow-popup-next', magnificNext);

    /* @todo: change classes so style and js don't interfere */
    $('.menu-item--parent').hoverIntent({
        over: function() {
            $(this).addClass('js--is-active');
            $(this).children('.site-navigation__sub-menu').slideDown(200, 'easeInOutSine');
        },
        out: function() {
            $(this).removeClass('js--is-active');
            $(this).children('.site-navigation__sub-menu').slideUp(200, 'easeInOutSine');
        },
        timeout: 300
    });    

    likeBoxAnimation();
};





/* ====== ON DOCU READY ====== */

$(function(){

    /* --- INITIALIZE --- */

    init();

    /* --- CONDITIONAL LOADING --- */

    loadUp();

    /* --- VISUAL LOADING --- */

});





/* --- $LAZY LOADING --- */

/**
*
* When an image finished loaded add class to parent for
* the image to fade in
*
**/

function imgLoaded(img) {

    setTimeout(function() {
        img.closest('.mosaic__item').addClass('js--is-loaded');
    }, 80 * Math.floor((Math.random()*5)+1));

};


function lazyLoad() {

    var $images = $('.js-lazy-load');

    $images.each(function(){

        var $img = $(this),
            src = $img.attr('data-src'),
            $newImg = $('<img src="'+src+'" />');

        $img.replaceWith($newImg);
        $newImg.on('load', imgLoaded($newImg));
    });
};





/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
    
    var domain = 'http://192.168.1.104/prism/';

    /* --- START PRE-CACHING IMAGES --- */
    if (typeof imagesArr !== "undefined") {
        if(!lteie9 && !phone){
            $.each(imagesArr, function(){
                var imgUrl = domain+this,
                x = new Image();
                x.src = imgUrl;
            });
        };
    }

    $('html').removeClass('loading');

    lazyLoad();
});




function animateGallery(direction) {

    direction = direction == "in" ? direction : "out";

    $('.mosaic__item').each(function(){
        var $item = $(this);
        setTimeout(function() {
            $item.addClass('slide-' + direction);
        }, 80 * Math.floor((Math.random()*5)+1));
    });

}


function animateBlog(direction) {
    
    if (!is_android) {

        direction = direction == "in" ? direction : "out";

        var sizes = new Array();
        var columns = new Array();
        var items = $('.masonry .span .masonry__item').length;

        $('.masonry .span').each(function(i, e){
            columns[i] = $(this).children('.masonry__item');
            sizes[i] = columns[i].length;
        });

        var max = Math.max.apply(null, sizes);
        
        for (var item = 0; item < max; item++) {

            $(columns).each(function(column) {

                if (columns[column][item] !== undefined) {

                    if (direction == "in") {

                        var $item = $(columns[column][item]),
                            timeout = item * columns.length + column;

                        setTimeout(function() {
                            $item.addClass('is-loaded');
                        }, 100 * timeout);

                    } else {

                        var $item = $(columns[column][item]),
                            timeout = items - (item * columns.length + column);

                        setTimeout(function() {
                            $item.removeClass('is-loaded');
                        }, 100 * timeout);
                    }
                }
            });
        }
    }
}





/* ====== ON DJAX REQUEST ====== */

$(window).bind('djaxClick', function(e, data) {

    $('html').addClass('loading');
    $('html, body').animate({scrollTop: 0}, 300);

    if ($('html').hasClass('navigation--is-visible')) {
        $('#page').css({'height': ''});
        $('html').removeClass('navigation--is-visible');
        // $(window).trigger('resize');
    }

    /* --- ANIMATE STUFF OUT --- */
    animateGallery('out');
    animateBlog('out');

    /* --- KILL ROYALSLIDER ---*/
    var sliders = $('.js-pixslider');
    if (sliders.length) {
        sliders.each(function() {
            var slider = $(this).data('royalSlider');
            slider.destroy();
        });
    }   
});





/* ====== ON DJAX LOAD ====== */

$(window).bind('djaxLoad', function(e, data) {

    // get data and replace the body tag with a nobody tag
    // because jquery strips the body tag when creating objects from data
    data = data.response.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>', data);
    // get the nobody tag's classes
    var nobodyClass = $(data).filter('notbody').attr("class");
    // set it to current body tag
    $('body').attr("class", nobodyClass);
    // let the party begin
    $('html').removeClass('loading');

    // progressbars ?

    eventHandlers();

    browserSize();
    resizeVideos();

    lazyLoad();
    loadUp();
});





/* ====== ON RESIZE ====== */

$(window).resize(function(){

    browserSize();
    niceScrollInit();
    resizeVideos();

    if (ww < 901) {
        $('[data-smoothscrolling]').getNiceScroll().hide();
    } else {
        $('[data-smoothscrolling]').getNiceScroll().show();
    }
});





/* ====== ON SCROLL ======  */

$(window).scroll(function(e){


    if ($('.entry__likes').length) {

        if (ww > 1599) {
            
            var likes = $('.entry__likes'),
                likesOffset = likes.offset(),
                likesh = likes.height(),
                likesTop = likesOffset.top,
                likesBottom = likesTop + likesh,
                post = $('.post .entry__wrap'),
                posth = post.height(),
                postOffset = post.offset(),
                postTop = postOffset.top,
                postBottom = postTop + posth,
                scroll = $('body').scrollTop();

            // hacky way to get scroll consisten in chrome / firefox
            if (scroll == 0) scroll = $('html').scrollTop();

            // if scrolled past the top of the container but not below the bottom of it
            if (scroll > postTop && scroll + likesh < postBottom) {

                // insert after content for fixed position to work properly
                // set left value to the box's initial left offset
                likes.insertAfter('.content').css({
                    position: 'fixed',
                    top: 0,
                    left: likesOffset.left
                });

            // the box should follow scroll anymore
            } else {

                // we are below the container's bottom
                // so we have to move to box back up while scrolling down
                if (scroll + likesh > postBottom) {

                    likes.insertAfter('.content').css({
                        top: postBottom - scroll - likesh,
                    });

                // we are back up so we must put the box back in it's place
                } else {

                    likes.prependTo('.entry__wrap').css({
                        position: '',
                        top: 0,
                        left: ''
                    });

                }
            }

        } else {

            // make sure that the box is in it's lace when resizing the browser
            likes.prependTo('.entry__wrap').css({
                position: '',
                top: 0,
                left: ''
            });
            
        }
    }
});
})(jQuery, window);
