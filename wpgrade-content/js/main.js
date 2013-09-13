( function( $ ) {

/* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;
var nav_is_open = $('body').hasClass('.navigation--is-visible');

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

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



/* ====== PLUGINS & EXTENSIONS ====== */

/* --- EASING --- */

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





/* --- WEB FONT LOADER --- */

$.support.touch = 'ontouchend' in document;

if (!$.support.touch) {

    WebFontConfig = {
        custom: { families: ['Roboto:n3,i3,n5,i5','Open Sans:n3,i3,n4,i4,n7,i7','Crimson Text: n4,i4','Josefin Slab:n4,n6,n7'],
        urls: [ 'wp-content/themes/lens/wpgrade-content/css/webfonts.css' ] },
        active: function(){
            $('html').addClass('wf-loaded');
        },
        inactive: function(){
            $('html').addClass('wf-loaded');
        }
    };

/* --- WEBFONT JS -- */

/* https://github.com/typekit/webfontloader */

/*
 * Copyright 2013 Small Batch, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
;(function(window,document,undefined){
var j=void 0,k=!0,l=null,p=!1;function q(a){return function(){return this[a]}}var aa=this;function ba(a,b){var c=a.split("."),d=aa;!(c[0]in d)&&d.execScript&&d.execScript("var "+c[0]);for(var e;c.length&&(e=c.shift());)!c.length&&b!==j?d[e]=b:d=d[e]?d[e]:d[e]={}}aa.Ba=k;function ca(a,b,c){return a.call.apply(a.bind,arguments)}
function da(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}}function s(a,b,c){s=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?ca:da;return s.apply(l,arguments)}var ea=Date.now||function(){return+new Date};function fa(a,b){this.G=a;this.u=b||a;this.z=this.u.document;this.R=j}fa.prototype.createElement=function(a,b,c){a=this.z.createElement(a);if(b)for(var d in b)if(b.hasOwnProperty(d))if("style"==d){var e=a,f=b[d];ga(this)?e.setAttribute("style",f):e.style.cssText=f}else a.setAttribute(d,b[d]);c&&a.appendChild(this.z.createTextNode(c));return a};function t(a,b,c){a=a.z.getElementsByTagName(b)[0];a||(a=document.documentElement);a&&a.lastChild&&a.insertBefore(c,a.lastChild)}
function u(a,b){return a.createElement("link",{rel:"stylesheet",href:b})}function ha(a,b){return a.createElement("script",{src:b})}function v(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;d<e;d++)if(c[d]==b)return;c.push(b);a.className=c.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"")}function w(a,b){for(var c=a.className.split(/\s+/),d=[],e=0,f=c.length;e<f;e++)c[e]!=b&&d.push(c[e]);a.className=d.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"")}
function ia(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;d<e;d++)if(c[d]==b)return k;return p}function ga(a){if(a.R===j){var b=a.z.createElement("p");b.innerHTML='<a style="top:1px;">w</a>';a.R=/top/.test(b.getElementsByTagName("a")[0].getAttribute("style"))}return a.R}function x(a){var b=a.u.location.protocol;"about:"==b&&(b=a.G.location.protocol);return"https:"==b?"https:":"http:"};function y(a,b,c){this.w=a;this.T=b;this.Aa=c}ba("webfont.BrowserInfo",y);y.prototype.qa=q("w");y.prototype.hasWebFontSupport=y.prototype.qa;y.prototype.ra=q("T");y.prototype.hasWebKitFallbackBug=y.prototype.ra;y.prototype.sa=q("Aa");y.prototype.hasWebKitMetricsBug=y.prototype.sa;function z(a,b,c,d){this.e=a!=l?a:l;this.o=b!=l?b:l;this.ba=c!=l?c:l;this.f=d!=l?d:l}var ja=/^([0-9]+)(?:[\._-]([0-9]+))?(?:[\._-]([0-9]+))?(?:[\._+-]?(.*))?$/;z.prototype.toString=function(){return[this.e,this.o||"",this.ba||"",this.f||""].join("")};
function A(a){a=ja.exec(a);var b=l,c=l,d=l,e=l;a&&(a[1]!==l&&a[1]&&(b=parseInt(a[1],10)),a[2]!==l&&a[2]&&(c=parseInt(a[2],10)),a[3]!==l&&a[3]&&(d=parseInt(a[3],10)),a[4]!==l&&a[4]&&(e=/^[0-9]+$/.test(a[4])?parseInt(a[4],10):a[4]));return new z(b,c,d,e)};function B(a,b,c,d,e,f,g,h,n,m,r){this.J=a;this.Ha=b;this.za=c;this.ga=d;this.Fa=e;this.fa=f;this.xa=g;this.Ga=h;this.wa=n;this.ea=m;this.k=r}ba("webfont.UserAgent",B);B.prototype.getName=q("J");B.prototype.getName=B.prototype.getName;B.prototype.pa=q("za");B.prototype.getVersion=B.prototype.pa;B.prototype.la=q("ga");B.prototype.getEngine=B.prototype.la;B.prototype.ma=q("fa");B.prototype.getEngineVersion=B.prototype.ma;B.prototype.na=q("xa");B.prototype.getPlatform=B.prototype.na;B.prototype.oa=q("wa");
B.prototype.getPlatformVersion=B.prototype.oa;B.prototype.ka=q("ea");B.prototype.getDocumentMode=B.prototype.ka;B.prototype.ja=q("k");B.prototype.getBrowserInfo=B.prototype.ja;function C(a,b){this.a=a;this.H=b}var ka=new B("Unknown",new z,"Unknown","Unknown",new z,"Unknown","Unknown",new z,"Unknown",j,new y(p,p,p));
C.prototype.parse=function(){var a;if(-1!=this.a.indexOf("MSIE")){a=D(this);var b=E(this),c=A(b),d=F(this.a,/MSIE ([\d\w\.]+)/,1),e=A(d);a=new B("MSIE",e,d,"MSIE",e,d,a,c,b,G(this.H),new y("Windows"==a&&6<=e.e||"Windows Phone"==a&&8<=c.e,p,p))}else if(-1!=this.a.indexOf("Opera"))a:{a="Unknown";var b=F(this.a,/Presto\/([\d\w\.]+)/,1),c=A(b),d=E(this),e=A(d),f=G(this.H);c.e!==l?a="Presto":(-1!=this.a.indexOf("Gecko")&&(a="Gecko"),b=F(this.a,/rv:([^\)]+)/,1),c=A(b));if(-1!=this.a.indexOf("Opera Mini/")){var g=
F(this.a,/Opera Mini\/([\d\.]+)/,1),h=A(g);a=new B("OperaMini",h,g,a,c,b,D(this),e,d,f,new y(p,p,p))}else{if(-1!=this.a.indexOf("Version/")&&(g=F(this.a,/Version\/([\d\.]+)/,1),h=A(g),h.e!==l)){a=new B("Opera",h,g,a,c,b,D(this),e,d,f,new y(10<=h.e,p,p));break a}g=F(this.a,/Opera[\/ ]([\d\.]+)/,1);h=A(g);a=h.e!==l?new B("Opera",h,g,a,c,b,D(this),e,d,f,new y(10<=h.e,p,p)):new B("Opera",new z,"Unknown",a,c,b,D(this),e,d,f,new y(p,p,p))}}else if(/AppleWeb(K|k)it/.test(this.a)){a=D(this);var b=E(this),
c=A(b),d=F(this.a,/AppleWeb(?:K|k)it\/([\d\.\+]+)/,1),e=A(d),f="Unknown",g=new z,h="Unknown",n=p;-1!=this.a.indexOf("Chrome")||-1!=this.a.indexOf("CrMo")||-1!=this.a.indexOf("CriOS")?f="Chrome":/Silk\/\d/.test(this.a)?f="Silk":"BlackBerry"==a||"Android"==a?f="BuiltinBrowser":-1!=this.a.indexOf("Safari")?f="Safari":-1!=this.a.indexOf("AdobeAIR")&&(f="AdobeAIR");"BuiltinBrowser"==f?h="Unknown":"Silk"==f?h=F(this.a,/Silk\/([\d\._]+)/,1):"Chrome"==f?h=F(this.a,/(Chrome|CrMo|CriOS)\/([\d\.]+)/,2):-1!=
this.a.indexOf("Version/")?h=F(this.a,/Version\/([\d\.\w]+)/,1):"AdobeAIR"==f&&(h=F(this.a,/AdobeAIR\/([\d\.]+)/,1));g=A(h);n="AdobeAIR"==f?2<g.e||2==g.e&&5<=g.o:"BlackBerry"==a?10<=c.e:"Android"==a?2<c.e||2==c.e&&1<c.o:526<=e.e||525<=e.e&&13<=e.o;a=new B(f,g,h,"AppleWebKit",e,d,a,c,b,G(this.H),new y(n,536>e.e||536==e.e&&11>e.o,"iPhone"==a||"iPad"==a||"iPod"==a||"Macintosh"==a))}else-1!=this.a.indexOf("Gecko")?(a="Unknown",b=new z,c="Unknown",d=E(this),e=A(d),f=p,-1!=this.a.indexOf("Firefox")?(a=
"Firefox",c=F(this.a,/Firefox\/([\d\w\.]+)/,1),b=A(c),f=3<=b.e&&5<=b.o):-1!=this.a.indexOf("Mozilla")&&(a="Mozilla"),g=F(this.a,/rv:([^\)]+)/,1),h=A(g),f||(f=1<h.e||1==h.e&&9<h.o||1==h.e&&9==h.o&&2<=h.ba||g.match(/1\.9\.1b[123]/)!=l||g.match(/1\.9\.1\.[\d\.]+/)!=l),a=new B(a,b,c,"Gecko",h,g,D(this),e,d,G(this.H),new y(f,p,p))):a=ka;return a};
function D(a){var b=F(a.a,/(iPod|iPad|iPhone|Android|Windows Phone|BB\d{2}|BlackBerry)/,1);if(""!=b)return/BB\d{2}/.test(b)&&(b="BlackBerry"),b;a=F(a.a,/(Linux|Mac_PowerPC|Macintosh|Windows|CrOS)/,1);return""!=a?("Mac_PowerPC"==a&&(a="Macintosh"),a):"Unknown"}
function E(a){var b=F(a.a,/(OS X|Windows NT|Android) ([^;)]+)/,2);if(b||(b=F(a.a,/Windows Phone( OS)? ([^;)]+)/,2))||(b=F(a.a,/(iPhone )?OS ([\d_]+)/,2)))return b;if(b=F(a.a,/(?:Linux|CrOS) ([^;)]+)/,1))for(var b=b.split(/\s/),c=0;c<b.length;c+=1)if(/^[\d\._]+$/.test(b[c]))return b[c];return(a=F(a.a,/(BB\d{2}|BlackBerry).*?Version\/([^\s]*)/,2))?a:"Unknown"}function F(a,b,c){return(a=a.match(b))&&a[c]?a[c]:""}function G(a){if(a.documentMode)return a.documentMode};function la(a){this.va=a||"-"}la.prototype.f=function(a){for(var b=[],c=0;c<arguments.length;c++)b.push(arguments[c].replace(/[\W_]+/g,"").toLowerCase());return b.join(this.va)};function H(a,b){this.J=a;this.U=4;this.K="n";var c=(b||"n4").match(/^([nio])([1-9])$/i);c&&(this.K=c[1],this.U=parseInt(c[2],10))}H.prototype.getName=q("J");function I(a){return a.K+a.U}function ma(a){var b=4,c="n",d=l;a&&((d=a.match(/(normal|oblique|italic)/i))&&d[1]&&(c=d[1].substr(0,1).toLowerCase()),(d=a.match(/([1-9]00|normal|bold)/i))&&d[1]&&(/bold/i.test(d[1])?b=7:/[1-9]00/.test(d[1])&&(b=parseInt(d[1].substr(0,1),10))));return c+b};function na(a,b,c){this.c=a;this.h=b;this.M=c;this.j="wf";this.g=new la("-")}function pa(a){v(a.h,a.g.f(a.j,"loading"));J(a,"loading")}function K(a){w(a.h,a.g.f(a.j,"loading"));ia(a.h,a.g.f(a.j,"active"))||v(a.h,a.g.f(a.j,"inactive"));J(a,"inactive")}function J(a,b,c){if(a.M[b])if(c)a.M[b](c.getName(),I(c));else a.M[b]()};function L(a,b){this.c=a;this.C=b;this.s=this.c.createElement("span",{"aria-hidden":"true"},this.C)}
function M(a,b){var c=a.s,d;d=[];for(var e=b.J.split(/,\s*/),f=0;f<e.length;f++){var g=e[f].replace(/['"]/g,"");-1==g.indexOf(" ")?d.push(g):d.push("'"+g+"'")}d=d.join(",");e="normal";f=b.U+"00";"o"===b.K?e="oblique":"i"===b.K&&(e="italic");d="position:absolute;top:-999px;left:-999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:"+d+";"+("font-style:"+e+";font-weight:"+f+";");ga(a.c)?c.setAttribute("style",d):c.style.cssText=
d}function N(a){t(a.c,"body",a.s)}L.prototype.remove=function(){var a=this.s;a.parentNode&&a.parentNode.removeChild(a)};function qa(a,b,c,d,e,f,g,h){this.V=a;this.ta=b;this.c=c;this.q=d;this.C=h||"BESbswy";this.k=e;this.F={};this.S=f||5E3;this.Z=g||l;this.B=this.A=l;a=new L(this.c,this.C);N(a);for(var n in O)O.hasOwnProperty(n)&&(M(a,new H(O[n],I(this.q))),this.F[O[n]]=a.s.offsetWidth);a.remove()}var O={Ea:"serif",Da:"sans-serif",Ca:"monospace"};
qa.prototype.start=function(){this.A=new L(this.c,this.C);N(this.A);this.B=new L(this.c,this.C);N(this.B);this.ya=ea();M(this.A,new H(this.q.getName()+",serif",I(this.q)));M(this.B,new H(this.q.getName()+",sans-serif",I(this.q)));ra(this)};function sa(a,b,c){for(var d in O)if(O.hasOwnProperty(d)&&b===a.F[O[d]]&&c===a.F[O[d]])return k;return p}
function ra(a){var b=a.A.s.offsetWidth,c=a.B.s.offsetWidth;b===a.F.serif&&c===a.F["sans-serif"]||a.k.T&&sa(a,b,c)?ea()-a.ya>=a.S?a.k.T&&sa(a,b,c)&&(a.Z===l||a.Z.hasOwnProperty(a.q.getName()))?P(a,a.V):P(a,a.ta):setTimeout(s(function(){ra(this)},a),25):P(a,a.V)}function P(a,b){a.A.remove();a.B.remove();b(a.q)};function R(a,b,c,d){this.c=b;this.t=c;this.N=0;this.ca=this.Y=p;this.S=d;this.k=a.k}function ta(a,b,c,d,e){if(0===b.length&&e)K(a.t);else{a.N+=b.length;e&&(a.Y=e);for(e=0;e<b.length;e++){var f=b[e],g=c[f.getName()],h=a.t,n=f;v(h.h,h.g.f(h.j,n.getName(),I(n).toString(),"loading"));J(h,"fontloading",n);(new qa(s(a.ha,a),s(a.ia,a),a.c,f,a.k,a.S,d,g)).start()}}}
R.prototype.ha=function(a){var b=this.t;w(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"loading"));w(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"inactive"));v(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"active"));J(b,"fontactive",a);this.ca=k;ua(this)};R.prototype.ia=function(a){var b=this.t;w(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"loading"));ia(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"active"))||v(b.h,b.g.f(b.j,a.getName(),I(a).toString(),"inactive"));J(b,"fontinactive",a);ua(this)};
function ua(a){0==--a.N&&a.Y&&(a.ca?(a=a.t,w(a.h,a.g.f(a.j,"loading")),w(a.h,a.g.f(a.j,"inactive")),v(a.h,a.g.f(a.j,"active")),J(a,"active")):K(a.t))};function S(a,b,c){this.G=a;this.W=b;this.a=c;this.O=this.P=0}function T(a,b){U.W.$[a]=b}S.prototype.load=function(a){var b=a.context||this.G;this.c=new fa(this.G,b);b=new na(this.c,b.document.documentElement,a);if(this.a.k.w){var c=this.W,d=this.c,e=[],f;for(f in a)if(a.hasOwnProperty(f)){var g=c.$[f];g&&e.push(g(a[f],d))}a=a.timeout;this.O=this.P=e.length;a=new R(this.a,this.c,b,a);f=0;for(c=e.length;f<c;f++)d=e[f],d.v(this.a,s(this.ua,this,d,b,a))}else K(b)};
S.prototype.ua=function(a,b,c,d){var e=this;d?a.load(function(a,d,h){var n=0==--e.P;n&&pa(b);setTimeout(function(){ta(c,a,d||{},h||l,n)},0)}):(a=0==--this.P,this.O--,a&&(0==this.O?K(b):pa(b)),ta(c,[],{},l,a))};var va=window,wa=(new C(navigator.userAgent,document)).parse(),U=va.WebFont=new S(window,new function(){this.$={}},wa);U.load=U.load;function V(a,b){this.c=a;this.d=b}V.prototype.load=function(a){var b,c,d=this.d.urls||[],e=this.d.families||[];b=0;for(c=d.length;b<c;b++)t(this.c,"head",u(this.c,d[b]));d=[];b=0;for(c=e.length;b<c;b++){var f=e[b].split(":");if(f[1])for(var g=f[1].split(","),h=0;h<g.length;h+=1)d.push(new H(f[0],g[h]));else d.push(new H(f[0]))}a(d)};V.prototype.v=function(a,b){return b(a.k.w)};T("custom",function(a,b){return new V(b,a)});function W(a,b){this.c=a;this.d=b}var xa={regular:"n4",bold:"n7",italic:"i4",bolditalic:"i7",r:"n4",b:"n7",i:"i4",bi:"i7"};W.prototype.v=function(a,b){return b(a.k.w)};W.prototype.load=function(a){t(this.c,"head",u(this.c,x(this.c)+"//webfonts.fontslive.com/css/"+this.d.key+".css"));for(var b=this.d.families,c=[],d=0,e=b.length;d<e;d++)c.push.apply(c,ya(b[d]));a(c)};
function ya(a){var b=a.split(":");a=b[0];if(b[1]){for(var c=b[1].split(","),b=[],d=0,e=c.length;d<e;d++){var f=c[d];if(f){var g=xa[f];b.push(g?g:f)}}c=[];for(d=0;d<b.length;d+=1)c.push(new H(a,b[d]));return c}return[new H(a)]}T("ascender",function(a,b){return new W(b,a)});function X(a,b,c){this.a=a;this.c=b;this.d=c;this.m=[]}
X.prototype.v=function(a,b){var c=this,d=c.d.projectId,e=c.d.version;if(d){var f=c.c.u,g=c.c.createElement("script");g.id="__MonotypeAPIScript__"+d;var h=p;g.onload=g.onreadystatechange=function(){if(!h&&(!this.readyState||"loaded"===this.readyState||"complete"===this.readyState)){h=k;if(f["__mti_fntLst"+d]){var e=f["__mti_fntLst"+d]();if(e)for(var m=0;m<e.length;m++)c.m.push(new H(e[m].fontfamily))}b(a.k.w);g.onload=g.onreadystatechange=l}};g.src=c.D(d,e);t(this.c,"head",g)}else b(k)};
X.prototype.D=function(a,b){var c=x(this.c),d=(this.d.api||"fast.fonts.com/jsapi").replace(/^.*http(s?):(\/\/)?/,"");return c+"//"+d+"/"+a+".js"+(b?"?v="+b:"")};X.prototype.load=function(a){a(this.m)};T("monotype",function(a,b){var c=(new C(navigator.userAgent,document)).parse();return new X(c,b,a)});function Y(a,b){this.c=a;this.d=b;this.m=[]}Y.prototype.D=function(a){var b=x(this.c);return(this.d.api||b+"//use.typekit.net")+"/"+a+".js"};
Y.prototype.v=function(a,b){var c=this.d.id,d=this.d,e=this.c.u,f=this;c?(e.__webfonttypekitmodule__||(e.__webfonttypekitmodule__={}),e.__webfonttypekitmodule__[c]=function(c){c(a,d,function(a,c,d){for(var e=0;e<c.length;e+=1){var g=d[c[e]];if(g)for(var Q=0;Q<g.length;Q+=1)f.m.push(new H(c[e],g[Q]));else f.m.push(new H(c[e]))}b(a)})},c=ha(this.c,this.D(c)),t(this.c,"head",c)):b(k)};Y.prototype.load=function(a){a(this.m)};T("typekit",function(a,b){return new Y(b,a)});function za(a,b,c){this.L=a?a:b+Aa;this.p=[];this.Q=[];this.da=c||""}var Aa="//fonts.googleapis.com/css";za.prototype.f=function(){if(0==this.p.length)throw Error("No fonts to load !");if(-1!=this.L.indexOf("kit="))return this.L;for(var a=this.p.length,b=[],c=0;c<a;c++)b.push(this.p[c].replace(/ /g,"+"));a=this.L+"?family="+b.join("%7C");0<this.Q.length&&(a+="&subset="+this.Q.join(","));0<this.da.length&&(a+="&text="+encodeURIComponent(this.da));return a};function Ba(a){this.p=a;this.aa=[];this.I={}}
var Ca={latin:"BESbswy",cyrillic:"&#1081;&#1103;&#1046;",greek:"&#945;&#946;&#931;",khmer:"&#x1780;&#x1781;&#x1782;",Hanuman:"&#x1780;&#x1781;&#x1782;"},Da={thin:"1",extralight:"2","extra-light":"2",ultralight:"2","ultra-light":"2",light:"3",regular:"4",book:"4",medium:"5","semi-bold":"6",semibold:"6","demi-bold":"6",demibold:"6",bold:"7","extra-bold":"8",extrabold:"8","ultra-bold":"8",ultrabold:"8",black:"9",heavy:"9",l:"3",r:"4",b:"7"},Ea={i:"i",italic:"i",n:"n",normal:"n"},Fa=RegExp("^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$");
Ba.prototype.parse=function(){for(var a=this.p.length,b=0;b<a;b++){var c=this.p[b].split(":"),d=c[0].replace(/\+/g," "),e=["n4"];if(2<=c.length){var f;var g=c[1];f=[];if(g)for(var g=g.split(","),h=g.length,n=0;n<h;n++){var m;m=g[n];if(m.match(/^[\w]+$/)){m=Fa.exec(m.toLowerCase());var r=j;if(m==l)r="";else{r=j;r=m[1];if(r==l||""==r)r="4";else var oa=Da[r],r=oa?oa:isNaN(r)?"4":r.substr(0,1);r=[m[2]==l||""==m[2]?"n":Ea[m[2]],r].join("")}m=r}else m="";m&&f.push(m)}0<f.length&&(e=f);3==c.length&&(c=c[2],
f=[],c=!c?f:c.split(","),0<c.length&&(c=Ca[c[0]])&&(this.I[d]=c))}this.I[d]||(c=Ca[d])&&(this.I[d]=c);for(c=0;c<e.length;c+=1)this.aa.push(new H(d,e[c]))}};function Z(a,b,c){this.a=a;this.c=b;this.d=c}var Ga={Arimo:k,Cousine:k,Tinos:k};Z.prototype.v=function(a,b){b(a.k.w)};Z.prototype.load=function(a){var b=this.c;if("MSIE"==this.a.getName()&&this.d.blocking!=k){var c=s(this.X,this,a),d=function(){b.z.body?c():setTimeout(d,0)};d()}else this.X(a)};
Z.prototype.X=function(a){for(var b=this.c,c=new za(this.d.api,x(b),this.d.text),d=this.d.families,e=d.length,f=0;f<e;f++){var g=d[f].split(":");3==g.length&&c.Q.push(g.pop());var h="";2==g.length&&""!=g[1]&&(h=":");c.p.push(g.join(h))}d=new Ba(d);d.parse();t(b,"head",u(b,c.f()));a(d.aa,d.I,Ga)};T("google",function(a,b){var c=(new C(navigator.userAgent,document)).parse();return new Z(c,b,a)});function $(a,b){this.c=a;this.d=b;this.m=[]}$.prototype.D=function(a){return x(this.c)+(this.d.api||"//f.fontdeck.com/s/css/js/")+(this.c.u.location.hostname||this.c.G.location.hostname)+"/"+a+".js"};
$.prototype.v=function(a,b){var c=this.d.id,d=this.c.u,e=this;c?(d.__webfontfontdeckmodule__||(d.__webfontfontdeckmodule__={}),d.__webfontfontdeckmodule__[c]=function(a,c){for(var d=0,n=c.fonts.length;d<n;++d){var m=c.fonts[d];e.m.push(new H(m.name,ma("font-weight:"+m.weight+";font-style:"+m.style)))}b(a)},c=ha(this.c,this.D(c)),t(this.c,"head",c)):b(k)};$.prototype.load=function(a){a(this.m)};T("fontdeck",function(a,b){return new $(b,a)});window.WebFontConfig&&U.load(window.WebFontConfig);
})(this,document);

} else {
    $('html').addClass('wf-loaded');
};





/* --- NiceScroll --- */

(function(e){function a(){var e=document.getElementsByTagName("script");var t=e[e.length-1].src.split("?")[0];return t.split("/").length>0?t.split("/").slice(0,-1).join("/")+"/":""}function T(e,t,n){for(var r=0;r<t.length;r++)n(e,t[r])}var t=false;var n=false;var r=false;var i=5e3;var s=2e3;var o=0;var u=e;var f=a();var l=["ms","moz","webkit","o"];var c=window.requestAnimationFrame||false;var h=window.cancelAnimationFrame||false;if(!c){for(var p in l){var d=l[p];if(!c)c=window[d+"RequestAnimationFrame"];if(!h)h=window[d+"CancelAnimationFrame"]||window[d+"CancelRequestAnimationFrame"]}}var v=window.MutationObserver||window.WebKitMutationObserver||false;var m={zindex:"auto",cursoropacitymin:0,cursoropacitymax:1,cursorcolor:"#424242",cursorwidth:"5px",cursorborder:"1px solid #fff",cursorborderradius:"5px",scrollspeed:60,mousescrollstep:8*3,touchbehavior:false,hwacceleration:true,usetransition:true,boxzoom:false,dblclickzoom:true,gesturezoom:true,grabcursorenabled:true,autohidemode:true,background:"",iframeautoresize:true,cursorminheight:32,preservenativescrolling:true,railoffset:false,bouncescroll:true,spacebarenabled:true,railpadding:{top:0,right:0,left:0,bottom:0},disableoutline:true,horizrailenabled:true,railalign:"right",railvalign:"bottom",enabletranslate3d:true,enablemousewheel:true,enablekeyboard:true,smoothscroll:true,sensitiverail:true,enablemouselockapi:true,cursorfixedheight:false,directionlockdeadzone:6,hidecursordelay:400,nativeparentscrolling:true,enablescrollonselection:true,overflowx:true,overflowy:true,cursordragspeed:.3,rtlmode:false,cursordragontouch:false,oneaxismousemode:"auto"};var g=false;var y=function(){function o(){var n=["-moz-grab","-webkit-grab","grab"];if(t.ischrome&&!t.ischrome22||t.isie)n=[];for(var r=0;r<n.length;r++){var i=n[r];e.style["cursor"]=i;if(e.style["cursor"]==i)return i}return"url(http://www.google.com/intl/en_ALL/mapfiles/openhand.cur),n-resize"}if(g)return g;var e=document.createElement("DIV");var t={};t.haspointerlock="pointerLockElement"in document||"mozPointerLockElement"in document||"webkitPointerLockElement"in document;t.isopera="opera"in window;t.isopera12=t.isopera&&"getUserMedia"in navigator;t.isoperamini=Object.prototype.toString.call(window.operamini)==="[object OperaMini]";t.isie="all"in document&&"attachEvent"in e&&!t.isopera;t.isieold=t.isie&&!("msInterpolationMode"in e.style);t.isie7=t.isie&&!t.isieold&&(!("documentMode"in document)||document.documentMode==7);t.isie8=t.isie&&"documentMode"in document&&document.documentMode==8;t.isie9=t.isie&&"performance"in window&&document.documentMode>=9;t.isie10=t.isie&&"performance"in window&&document.documentMode>=10;t.isie9mobile=/iemobile.9/i.test(navigator.userAgent);if(t.isie9mobile)t.isie9=false;t.isie7mobile=!t.isie9mobile&&t.isie7&&/iemobile/i.test(navigator.userAgent);t.ismozilla="MozAppearance"in e.style;t.iswebkit="WebkitAppearance"in e.style;t.ischrome="chrome"in window;t.ischrome22=t.ischrome&&t.haspointerlock;t.ischrome26=t.ischrome&&"transition"in e.style;t.cantouch="ontouchstart"in document.documentElement||"ontouchstart"in window;t.hasmstouch=window.navigator.msPointerEnabled||false;t.ismac=/^mac$/i.test(navigator.platform);t.isios=t.cantouch&&/iphone|ipad|ipod/i.test(navigator.platform);t.isios4=t.isios&&!("seal"in Object);t.isandroid=/android/i.test(navigator.userAgent);t.trstyle=false;t.hastransform=false;t.hastranslate3d=false;t.transitionstyle=false;t.hastransition=false;t.transitionend=false;var n=["transform","msTransform","webkitTransform","MozTransform","OTransform"];for(var r=0;r<n.length;r++){if(typeof e.style[n[r]]!="undefined"){t.trstyle=n[r];break}}t.hastransform=t.trstyle!=false;if(t.hastransform){e.style[t.trstyle]="translate3d(1px,2px,3px)";t.hastranslate3d=/translate3d/.test(e.style[t.trstyle])}t.transitionstyle=false;t.prefixstyle="";t.transitionend=false;var n=["transition","webkitTransition","MozTransition","OTransition","OTransition","msTransition","KhtmlTransition"];var i=["","-webkit-","-moz-","-o-","-o","-ms-","-khtml-"];var s=["transitionend","webkitTransitionEnd","transitionend","otransitionend","oTransitionEnd","msTransitionEnd","KhtmlTransitionEnd"];for(var r=0;r<n.length;r++){if(n[r]in e.style){t.transitionstyle=n[r];t.prefixstyle=i[r];t.transitionend=s[r];break}}if(t.ischrome26){t.prefixstyle=i[1]}t.hastransition=t.transitionstyle;t.cursorgrabvalue=o();t.hasmousecapture="setCapture"in e;t.hasMutationObserver=v!==false;e=null;g=t;return t};var b=function(e,r){function b(){var e=a.win;if("zIndex"in e)return e.zIndex();while(e.length>0){if(e[0].nodeType==9)return false;var t=e.css("zIndex");if(!isNaN(t)&&t!=0)return parseInt(t);e=e.parent()}return false}function S(e,t,n){var r=e.css(t);var i=parseFloat(r);if(isNaN(i)){i=E[r]||0;var s=i==3?n?a.win.outerHeight()-a.win.innerHeight():a.win.outerWidth()-a.win.innerWidth():1;if(a.isie8&&i)i+=1;return s?i:0}return i}function x(e,t,n,r){a._bind(e,t,function(r){var r=r?r:window.event;var i={original:r,target:r.target||r.srcElement,type:"wheel",deltaMode:r.type=="MozMousePixelScroll"?0:1,deltaX:0,deltaZ:0,preventDefault:function(){r.preventDefault?r.preventDefault():r.returnValue=false;return false},stopImmediatePropagation:function(){r.stopImmediatePropagation?r.stopImmediatePropagation():r.cancelBubble=true}};if(t=="mousewheel"){i.deltaY=-1/40*r.wheelDelta;r.wheelDeltaX&&(i.deltaX=-1/40*r.wheelDeltaX)}else{i.deltaY=r.detail}return n.call(e,i)},r)}function T(e,t,n){var r,i;var s=1;if(e.deltaMode==0){r=-Math.floor(e.deltaX*(a.opt.mousescrollstep/(18*3)));i=-Math.floor(e.deltaY*(a.opt.mousescrollstep/(18*3)))}else if(e.deltaMode==1){r=-Math.floor(e.deltaX*a.opt.mousescrollstep);i=-Math.floor(e.deltaY*a.opt.mousescrollstep)}if(t&&a.opt.oneaxismousemode&&r==0&&i){r=i;i=0}if(r){if(a.scrollmom){a.scrollmom.stop()}a.lastdeltax+=r;a.debounced("mousewheelx",function(){var e=a.lastdeltax;a.lastdeltax=0;if(!a.rail.drag){a.doScrollLeftBy(e)}},120)}if(i){if(a.opt.nativeparentscrolling&&n&&!a.ispage&&!a.zoomactive){if(i<0){if(a.getScrollTop()>=a.page.maxh)return true}else{if(a.getScrollTop()<=0)return true}}if(a.scrollmom){a.scrollmom.stop()}a.lastdeltay+=i;a.debounced("mousewheely",function(){var e=a.lastdeltay;a.lastdeltay=0;if(!a.rail.drag){a.doScrollBy(e)}},120)}e.stopImmediatePropagation();return e.preventDefault()}var a=this;this.version="3.5.1 BETA1";this.name="nicescroll";this.me=r;this.opt={doc:u("body"),win:false};u.extend(this.opt,m);this.opt.snapbackspeed=80;if(e||false){for(var l in a.opt){if(typeof e[l]!="undefined")a.opt[l]=e[l]}}this.doc=a.opt.doc;this.iddoc=this.doc&&this.doc[0]?this.doc[0].id||"":"";this.ispage=/BODY|HTML/.test(a.opt.win?a.opt.win[0].nodeName:this.doc[0].nodeName);this.haswrapper=a.opt.win!==false;this.win=a.opt.win||(this.ispage?u(window):this.doc);this.docscroll=this.ispage&&!this.haswrapper?u(window):this.win;this.body=u("body");this.viewport=false;this.isfixed=false;this.iframe=false;this.isiframe=this.doc[0].nodeName=="IFRAME"&&this.win[0].nodeName=="IFRAME";this.istextarea=this.win[0].nodeName=="TEXTAREA";this.forcescreen=false;this.canshowonmouseevent=a.opt.autohidemode!="scroll";this.onmousedown=false;this.onmouseup=false;this.onmousemove=false;this.onmousewheel=false;this.onkeypress=false;this.ongesturezoom=false;this.onclick=false;this.onscrollstart=false;this.onscrollend=false;this.onscrollcancel=false;this.onzoomin=false;this.onzoomout=false;this.view=false;this.page=false;this.scroll={x:0,y:0};this.scrollratio={x:0,y:0};this.cursorheight=20;this.scrollvaluemax=0;this.checkrtlmode=false;this.scrollrunning=false;this.scrollmom=false;this.observer=false;this.observerremover=false;do{this.id="ascrail"+s++}while(document.getElementById(this.id));this.rail=false;this.cursor=false;this.cursorfreezed=false;this.selectiondrag=false;this.zoom=false;this.zoomactive=false;this.hasfocus=false;this.hasmousefocus=false;this.visibility=true;this.locked=false;this.hidden=false;this.cursoractive=true;this.overflowx=a.opt.overflowx;this.overflowy=a.opt.overflowy;this.nativescrollingarea=false;this.checkarea=0;this.events=[];this.saved={};this.delaylist={};this.synclist={};this.lastdeltax=0;this.lastdeltay=0;this.detected=y();var p=u.extend({},this.detected);this.canhwscroll=p.hastransform&&a.opt.hwacceleration;this.ishwscroll=this.canhwscroll&&a.haswrapper;this.istouchcapable=false;if(p.cantouch&&p.ischrome&&!p.isios&&!p.isandroid){this.istouchcapable=true;p.cantouch=false}if(p.cantouch&&p.ismozilla&&!p.isios&&!p.isandroid){this.istouchcapable=true;p.cantouch=false}if(!a.opt.enablemouselockapi){p.hasmousecapture=false;p.haspointerlock=false}this.delayed=function(e,t,n,r){var i=a.delaylist[e];var s=(new Date).getTime();if(!r&&i&&i.tt)return false;if(i&&i.tt)clearTimeout(i.tt);if(i&&i.last+n>s&&!i.tt){a.delaylist[e]={last:s+n,tt:setTimeout(function(){a.delaylist[e].tt=0;t.call()},n)}}else if(!i||!i.tt){a.delaylist[e]={last:s,tt:0};setTimeout(function(){t.call()},0)}};this.debounced=function(e,t,n){var r=a.delaylist[e];var i=(new Date).getTime();a.delaylist[e]=t;if(!r){setTimeout(function(){var t=a.delaylist[e];a.delaylist[e]=false;t.call()},n)}};var d=false;this.synched=function(e,t){function n(){if(d)return;c(function(){d=false;for(e in a.synclist){var t=a.synclist[e];if(t)t.call(a);a.synclist[e]=false}});d=true}a.synclist[e]=t;n();return e};this.unsynched=function(e){if(a.synclist[e])a.synclist[e]=false};this.css=function(e,t){for(var n in t){a.saved.css.push([e,n,e.css(n)]);e.css(n,t[n])}};this.scrollTop=function(e){return typeof e=="undefined"?a.getScrollTop():a.setScrollTop(e)};this.scrollLeft=function(e){return typeof e=="undefined"?a.getScrollLeft():a.setScrollLeft(e)};BezierClass=function(e,t,n,r,i,s,o){this.st=e;this.ed=t;this.spd=n;this.p1=r||0;this.p2=i||1;this.p3=s||0;this.p4=o||1;this.ts=(new Date).getTime();this.df=this.ed-this.st};BezierClass.prototype={B2:function(e){return 3*e*e*(1-e)},B3:function(e){return 3*e*(1-e)*(1-e)},B4:function(e){return(1-e)*(1-e)*(1-e)},getNow:function(){var e=(new Date).getTime();var t=1-(e-this.ts)/this.spd;var n=this.B2(t)+this.B3(t)+this.B4(t);return t<0?this.ed:this.st+Math.round(this.df*n)},update:function(e,t){this.st=this.getNow();this.ed=e;this.spd=t;this.ts=(new Date).getTime();this.df=this.ed-this.st;return this}};if(this.ishwscroll){this.doc.translate={x:0,y:0,tx:"0px",ty:"0px"};if(p.hastranslate3d&&p.isios)this.doc.css("-webkit-backface-visibility","hidden");function g(){var e=a.doc.css(p.trstyle);if(e&&e.substr(0,6)=="matrix"){return e.replace(/^.*\((.*)\)$/g,"$1").replace(/px/g,"").split(/, +/)}return false}this.getScrollTop=function(e){if(!e){var t=g();if(t)return t.length==16?-t[13]:-t[5];if(a.timerscroll&&a.timerscroll.bz)return a.timerscroll.bz.getNow()}return a.doc.translate.y};this.getScrollLeft=function(e){if(!e){var t=g();if(t)return t.length==16?-t[12]:-t[4];if(a.timerscroll&&a.timerscroll.bh)return a.timerscroll.bh.getNow()}return a.doc.translate.x};if(document.createEvent){this.notifyScrollEvent=function(e){var t=document.createEvent("UIEvents");t.initUIEvent("scroll",false,true,window,1);e.dispatchEvent(t)}}else if(document.fireEvent){this.notifyScrollEvent=function(e){var t=document.createEventObject();e.fireEvent("onscroll");t.cancelBubble=true}}else{this.notifyScrollEvent=function(e,t){}}if(p.hastranslate3d&&a.opt.enabletranslate3d){this.setScrollTop=function(e,t){a.doc.translate.y=e;a.doc.translate.ty=e*-1+"px";a.doc.css(p.trstyle,"translate3d("+a.doc.translate.tx+","+a.doc.translate.ty+",0px)");if(!t)a.notifyScrollEvent(a.win[0])};this.setScrollLeft=function(e,t){a.doc.translate.x=e;a.doc.translate.tx=e*-1+"px";a.doc.css(p.trstyle,"translate3d("+a.doc.translate.tx+","+a.doc.translate.ty+",0px)");if(!t)a.notifyScrollEvent(a.win[0])}}else{this.setScrollTop=function(e,t){a.doc.translate.y=e;a.doc.translate.ty=e*-1+"px";a.doc.css(p.trstyle,"translate("+a.doc.translate.tx+","+a.doc.translate.ty+")");if(!t)a.notifyScrollEvent(a.win[0])};this.setScrollLeft=function(e,t){a.doc.translate.x=e;a.doc.translate.tx=e*-1+"px";a.doc.css(p.trstyle,"translate("+a.doc.translate.tx+","+a.doc.translate.ty+")");if(!t)a.notifyScrollEvent(a.win[0])}}}else{this.getScrollTop=function(){return a.docscroll.scrollTop()};this.setScrollTop=function(e){return a.docscroll.scrollTop(e)};this.getScrollLeft=function(){return a.docscroll.scrollLeft()};this.setScrollLeft=function(e){return a.docscroll.scrollLeft(e)}}this.getTarget=function(e){if(!e)return false;if(e.target)return e.target;if(e.srcElement)return e.srcElement;return false};this.hasParent=function(e,t){if(!e)return false;var n=e.target||e.srcElement||e||false;while(n&&n.id!=t){n=n.parentNode||false}return n!==false};var E={thin:1,medium:3,thick:5};this.getOffset=function(){if(a.isfixed)return{top:parseFloat(a.win.css("top")),left:parseFloat(a.win.css("left"))};if(!a.viewport)return a.win.offset();var e=a.win.offset();var t=a.viewport.offset();return{top:e.top-t.top+a.viewport.scrollTop(),left:e.left-t.left+a.viewport.scrollLeft()}};this.updateScrollBar=function(e){if(a.ishwscroll){a.rail.css({height:a.win.innerHeight()});if(a.railh)a.railh.css({width:a.win.innerWidth()})}else{var t=a.getOffset();var n={top:t.top,left:t.left};n.top+=S(a.win,"border-top-width",true);var r=(a.win.outerWidth()-a.win.innerWidth())/2;n.left+=a.rail.align?a.win.outerWidth()-S(a.win,"border-right-width")-a.rail.width:S(a.win,"border-left-width");var i=a.opt.railoffset;if(i){if(i.top)n.top+=i.top;if(a.rail.align&&i.left)n.left+=i.left}if(!a.locked)a.rail.css({top:n.top,left:n.left,height:e?e.h:a.win.innerHeight()});if(a.zoom){a.zoom.css({top:n.top+1,left:a.rail.align==1?n.left-20:n.left+a.rail.width+4})}if(a.railh&&!a.locked){var n={top:t.top,left:t.left};var s=a.railh.align?n.top+S(a.win,"border-top-width",true)+a.win.innerHeight()-a.railh.height:n.top+S(a.win,"border-top-width",true);var o=n.left+S(a.win,"border-left-width");a.railh.css({top:s,left:o,width:a.railh.width})}}};this.doRailClick=function(e,t,n){var r,i,s,o;if(a.locked)return;a.cancelEvent(e);if(t){r=n?a.doScrollLeft:a.doScrollTop;s=n?(e.pageX-a.railh.offset().left-a.cursorwidth/2)*a.scrollratio.x:(e.pageY-a.rail.offset().top-a.cursorheight/2)*a.scrollratio.y;r(s)}else{r=n?a.doScrollLeftBy:a.doScrollBy;s=n?a.scroll.x:a.scroll.y;o=n?e.pageX-a.railh.offset().left:e.pageY-a.rail.offset().top;i=n?a.view.w:a.view.h;s>=o?r(i):r(-i)}};a.hasanimationframe=c;a.hascancelanimationframe=h;if(!a.hasanimationframe){c=function(e){return setTimeout(e,15-Math.floor(+(new Date)/1e3)%16)};h=clearInterval}else if(!a.hascancelanimationframe)h=function(){a.cancelAnimationFrame=true};this.init=function(){a.saved.css=[];if(p.isie7mobile)return true;if(p.isoperamini)return true;if(p.hasmstouch)a.css(a.ispage?u("html"):a.win,{"-ms-touch-action":"none"});a.zindex="auto";if(!a.ispage&&a.opt.zindex=="auto"){a.zindex=b()||"auto"}else{a.zindex=a.opt.zindex}if(!a.ispage&&a.zindex!="auto"){if(a.zindex>o)o=a.zindex}if(a.isie&&a.zindex==0&&a.opt.zindex=="auto"){a.zindex="auto"}if(!a.ispage||!p.cantouch&&!p.isieold&&!p.isie9mobile){var e=a.docscroll;if(a.ispage)e=a.haswrapper?a.win:a.doc;if(!p.isie9mobile)a.css(e,{"overflow-y":"hidden"});if(a.ispage&&p.isie7){if(a.doc[0].nodeName=="BODY")a.css(u("html"),{"overflow-y":"hidden"});else if(a.doc[0].nodeName=="HTML")a.css(u("body"),{"overflow-y":"hidden"})}if(p.isios&&!a.ispage&&!a.haswrapper)a.css(u("body"),{"-webkit-overflow-scrolling":"touch"});var r=u(document.createElement("div"));r.css({position:"relative",top:0,"float":"right",width:a.opt.cursorwidth,height:"0px","background-color":a.opt.cursorcolor,border:a.opt.cursorborder,"background-clip":"padding-box","-webkit-border-radius":a.opt.cursorborderradius,"-moz-border-radius":a.opt.cursorborderradius,"border-radius":a.opt.cursorborderradius});r.hborder=parseFloat(r.outerHeight()-r.innerHeight());a.cursor=r;var s=u(document.createElement("div"));s.attr("id",a.id);s.addClass("nicescroll-rails");var l,c,h=["left","right"];for(var d in h){c=h[d];l=a.opt.railpadding[c];l?s.css("padding-"+c,l+"px"):a.opt.railpadding[c]=0}s.append(r);s.width=Math.max(parseFloat(a.opt.cursorwidth),r.outerWidth())+a.opt.railpadding["left"]+a.opt.railpadding["right"];s.css({width:s.width+"px",zIndex:a.zindex,background:a.opt.background,cursor:"default"});s.visibility=true;s.scrollable=true;s.align=a.opt.railalign=="left"?0:1;a.rail=s;a.rail.drag=false;var m=false;if(a.opt.boxzoom&&!a.ispage&&!p.isieold){m=document.createElement("div");a.bind(m,"click",a.doZoom);a.zoom=u(m);a.zoom.css({cursor:"pointer","z-index":a.zindex,backgroundImage:"url("+f+"zoomico.png)",height:18,width:18,backgroundPosition:"0px 0px"});if(a.opt.dblclickzoom)a.bind(a.win,"dblclick",a.doZoom);if(p.cantouch&&a.opt.gesturezoom){a.ongesturezoom=function(e){if(e.scale>1.5)a.doZoomIn(e);if(e.scale<.8)a.doZoomOut(e);return a.cancelEvent(e)};a.bind(a.win,"gestureend",a.ongesturezoom)}}a.railh=false;if(a.opt.horizrailenabled){a.css(e,{"overflow-x":"hidden"});var r=u(document.createElement("div"));r.css({position:"relative",top:0,height:a.opt.cursorwidth,width:"0px","background-color":a.opt.cursorcolor,border:a.opt.cursorborder,"background-clip":"padding-box","-webkit-border-radius":a.opt.cursorborderradius,"-moz-border-radius":a.opt.cursorborderradius,"border-radius":a.opt.cursorborderradius});r.wborder=parseFloat(r.outerWidth()-r.innerWidth());a.cursorh=r;var g=u(document.createElement("div"));g.attr("id",a.id+"-hr");g.addClass("nicescroll-rails");g.height=Math.max(parseFloat(a.opt.cursorwidth),r.outerHeight());g.css({height:g.height+"px",zIndex:a.zindex,background:a.opt.background});g.append(r);g.visibility=true;g.scrollable=true;g.align=a.opt.railvalign=="top"?0:1;a.railh=g;a.railh.drag=false}if(a.ispage){s.css({position:"fixed",top:"0px",height:"100%"});s.align?s.css({right:"0px"}):s.css({left:"0px"});a.body.append(s);if(a.railh){g.css({position:"fixed",left:"0px",width:"100%"});g.align?g.css({bottom:"0px"}):g.css({top:"0px"});a.body.append(g)}}else{if(a.ishwscroll){if(a.win.css("position")=="static")a.css(a.win,{position:"relative"});var y=a.win[0].nodeName=="HTML"?a.body:a.win;if(a.zoom){a.zoom.css({position:"absolute",top:1,right:0,"margin-right":s.width+4});y.append(a.zoom)}s.css({position:"absolute",top:0});s.align?s.css({right:0}):s.css({left:0});y.append(s);if(g){g.css({position:"absolute",left:0,bottom:0});g.align?g.css({bottom:0}):g.css({top:0});y.append(g)}}else{a.isfixed=a.win.css("position")=="fixed";var E=a.isfixed?"fixed":"absolute";if(!a.isfixed)a.viewport=a.getViewport(a.win[0]);if(a.viewport){a.body=a.viewport;if(/fixed|relative|absolute/.test(a.viewport.css("position"))==false)a.css(a.viewport,{position:"relative"})}s.css({position:E});if(a.zoom)a.zoom.css({position:E});a.updateScrollBar();a.body.append(s);if(a.zoom)a.body.append(a.zoom);if(a.railh){g.css({position:E});a.body.append(g)}}if(p.isios)a.css(a.win,{"-webkit-tap-highlight-color":"rgba(0,0,0,0)","-webkit-touch-callout":"none"});if(p.isie&&a.opt.disableoutline)a.win.attr("hideFocus","true");if(p.iswebkit&&a.opt.disableoutline)a.win.css({outline:"none"})}if(a.opt.autohidemode===false){a.autohidedom=false;a.rail.css({opacity:a.opt.cursoropacitymax});if(a.railh)a.railh.css({opacity:a.opt.cursoropacitymax})}else if(a.opt.autohidemode===true||a.opt.autohidemode==="leave"){a.autohidedom=u().add(a.rail);if(p.isie8)a.autohidedom=a.autohidedom.add(a.cursor);if(a.railh)a.autohidedom=a.autohidedom.add(a.railh);if(a.railh&&p.isie8)a.autohidedom=a.autohidedom.add(a.cursorh)}else if(a.opt.autohidemode=="scroll"){a.autohidedom=u().add(a.rail);if(a.railh)a.autohidedom=a.autohidedom.add(a.railh)}else if(a.opt.autohidemode=="cursor"){a.autohidedom=u().add(a.cursor);if(a.railh)a.autohidedom=a.autohidedom.add(a.cursorh)}else if(a.opt.autohidemode=="hidden"){a.autohidedom=false;a.hide();a.locked=false}if(p.isie9mobile){a.scrollmom=new w(a);a.onmangotouch=function(e){var t=a.getScrollTop();var n=a.getScrollLeft();if(t==a.scrollmom.lastscrolly&&n==a.scrollmom.lastscrollx)return true;var r=t-a.mangotouch.sy;var i=n-a.mangotouch.sx;var s=Math.round(Math.sqrt(Math.pow(i,2)+Math.pow(r,2)));if(s==0)return;var o=r<0?-1:1;var u=i<0?-1:1;var f=+(new Date);if(a.mangotouch.lazy)clearTimeout(a.mangotouch.lazy);if(f-a.mangotouch.tm>80||a.mangotouch.dry!=o||a.mangotouch.drx!=u){a.scrollmom.stop();a.scrollmom.reset(n,t);a.mangotouch.sy=t;a.mangotouch.ly=t;a.mangotouch.sx=n;a.mangotouch.lx=n;a.mangotouch.dry=o;a.mangotouch.drx=u;a.mangotouch.tm=f}else{a.scrollmom.stop();a.scrollmom.update(a.mangotouch.sx-i,a.mangotouch.sy-r);var l=f-a.mangotouch.tm;a.mangotouch.tm=f;var c=Math.max(Math.abs(a.mangotouch.ly-t),Math.abs(a.mangotouch.lx-n));a.mangotouch.ly=t;a.mangotouch.lx=n;if(c>2){a.mangotouch.lazy=setTimeout(function(){a.mangotouch.lazy=false;a.mangotouch.dry=0;a.mangotouch.drx=0;a.mangotouch.tm=0;a.scrollmom.doMomentum(30)},100)}}};var S=a.getScrollTop();var x=a.getScrollLeft();a.mangotouch={sy:S,ly:S,dry:0,sx:x,lx:x,drx:0,lazy:false,tm:0};a.bind(a.docscroll,"scroll",a.onmangotouch)}else{if(p.cantouch||a.istouchcapable||a.opt.touchbehavior||p.hasmstouch){a.scrollmom=new w(a);a.ontouchstart=function(e){if(e.pointerType&&e.pointerType!=2)return false;a.hasmoving=false;if(!a.locked){if(p.hasmstouch){var t=e.target?e.target:false;while(t){var n=u(t).getNiceScroll();if(n.length>0&&n[0].me==a.me)break;if(n.length>0)return false;if(t.nodeName=="DIV"&&t.id==a.id)break;t=t.parentNode?t.parentNode:false}}a.cancelScroll();var t=a.getTarget(e);if(t){var r=/INPUT/i.test(t.nodeName)&&/range/i.test(t.type);if(r)return a.stopPropagation(e)}if(!("clientX"in e)&&"changedTouches"in e){e.clientX=e.changedTouches[0].clientX;e.clientY=e.changedTouches[0].clientY}if(a.forcescreen){var i=e;var e={original:e.original?e.original:e};e.clientX=i.screenX;e.clientY=i.screenY}a.rail.drag={x:e.clientX,y:e.clientY,sx:a.scroll.x,sy:a.scroll.y,st:a.getScrollTop(),sl:a.getScrollLeft(),pt:2,dl:false};if(a.ispage||!a.opt.directionlockdeadzone){a.rail.drag.dl="f"}else{var s={w:u(window).width(),h:u(window).height()};var o={w:Math.max(document.body.scrollWidth,document.documentElement.scrollWidth),h:Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)};var f=Math.max(0,o.h-s.h);var l=Math.max(0,o.w-s.w);if(!a.rail.scrollable&&a.railh.scrollable)a.rail.drag.ck=f>0?"v":false;else if(a.rail.scrollable&&!a.railh.scrollable)a.rail.drag.ck=l>0?"h":false;else a.rail.drag.ck=false;if(!a.rail.drag.ck)a.rail.drag.dl="f"}if(a.opt.touchbehavior&&a.isiframe&&p.isie){var c=a.win.position();a.rail.drag.x+=c.left;a.rail.drag.y+=c.top}a.hasmoving=false;a.lastmouseup=false;a.scrollmom.reset(e.clientX,e.clientY);if(!p.cantouch&&!this.istouchcapable&&!p.hasmstouch){var h=t?/INPUT|SELECT|TEXTAREA/i.test(t.nodeName):false;if(!h){if(!a.ispage&&p.hasmousecapture)t.setCapture();if(a.opt.touchbehavior){if(t.onclick&&!(t._onclick||false)){t._onclick=t.onclick;t.onclick=function(e){if(a.hasmoving)return false;t._onclick.call(this,e)}}return a.cancelEvent(e)}return a.stopPropagation(e)}if(/SUBMIT|CANCEL|BUTTON/i.test(u(t).attr("type"))){pc={tg:t,click:false};a.preventclick=pc}}}};a.ontouchend=function(e){if(e.pointerType&&e.pointerType!=2)return false;if(a.rail.drag&&a.rail.drag.pt==2){a.scrollmom.doMomentum();a.rail.drag=false;if(a.hasmoving){a.lastmouseup=true;a.hideCursor();if(p.hasmousecapture)document.releaseCapture();if(!p.cantouch)return a.cancelEvent(e)}}};var T=a.opt.touchbehavior&&a.isiframe&&!p.hasmousecapture;a.ontouchmove=function(e,t){if(e.pointerType&&e.pointerType!=2)return false;if(a.rail.drag&&a.rail.drag.pt==2){if(p.cantouch&&typeof e.original=="undefined")return true;a.hasmoving=true;if(a.preventclick&&!a.preventclick.click){a.preventclick.click=a.preventclick.tg.onclick||false;a.preventclick.tg.onclick=a.onpreventclick}var n=u.extend({original:e},e);e=n;if("changedTouches"in e){e.clientX=e.changedTouches[0].clientX;e.clientY=e.changedTouches[0].clientY}if(a.forcescreen){var r=e;var e={original:e.original?e.original:e};e.clientX=r.screenX;e.clientY=r.screenY}var i=ofy=0;if(T&&!t){var s=a.win.position();i=-s.left;ofy=-s.top}var o=e.clientY+ofy;var f=o-a.rail.drag.y;var l=e.clientX+i;var c=l-a.rail.drag.x;var h=a.rail.drag.st-f;if(a.ishwscroll&&a.opt.bouncescroll){if(h<0){h=Math.round(h/2)}else if(h>a.page.maxh){h=a.page.maxh+Math.round((h-a.page.maxh)/2)}}else{if(h<0){h=0;o=0}if(h>a.page.maxh){h=a.page.maxh;o=0}}if(a.railh&&a.railh.scrollable){var d=a.rail.drag.sl-c;if(a.ishwscroll&&a.opt.bouncescroll){if(d<0){d=Math.round(d/2)}else if(d>a.page.maxw){d=a.page.maxw+Math.round((d-a.page.maxw)/2)}}else{if(d<0){d=0;l=0}if(d>a.page.maxw){d=a.page.maxw;l=0}}}var v=false;if(a.rail.drag.dl){v=true;if(a.rail.drag.dl=="v")d=a.rail.drag.sl;else if(a.rail.drag.dl=="h")h=a.rail.drag.st}else{var m=Math.abs(f);var g=Math.abs(c);var y=a.opt.directionlockdeadzone;if(a.rail.drag.ck=="v"){if(m>y&&g<=m*.3){a.rail.drag=false;return true}else if(g>y){a.rail.drag.dl="f";u("body").scrollTop(u("body").scrollTop())}}else if(a.rail.drag.ck=="h"){if(g>y&&m<=g*.3){a.rail.drag=false;return true}else if(m>y){a.rail.drag.dl="f";u("body").scrollLeft(u("body").scrollLeft())}}}a.synched("touchmove",function(){if(a.rail.drag&&a.rail.drag.pt==2){if(a.prepareTransition)a.prepareTransition(0);if(a.rail.scrollable)a.setScrollTop(h);a.scrollmom.update(l,o);if(a.railh&&a.railh.scrollable){a.setScrollLeft(d);a.showCursor(h,d)}else{a.showCursor(h)}if(p.isie10)document.selection.clear()}});if(p.ischrome&&a.istouchcapable)v=false;if(v)return a.cancelEvent(e)}}}a.onmousedown=function(e,t){if(a.rail.drag&&a.rail.drag.pt!=1)return;if(a.locked)return a.cancelEvent(e);a.cancelScroll();a.rail.drag={x:e.clientX,y:e.clientY,sx:a.scroll.x,sy:a.scroll.y,pt:1,hr:!!t};var n=a.getTarget(e);if(!a.ispage&&p.hasmousecapture)n.setCapture();if(a.isiframe&&!p.hasmousecapture){a.saved["csspointerevents"]=a.doc.css("pointer-events");a.css(a.doc,{"pointer-events":"none"})}a.hasmoving=false;return a.cancelEvent(e)};a.onmouseup=function(e){if(a.rail.drag){if(p.hasmousecapture)document.releaseCapture();if(a.isiframe&&!p.hasmousecapture)a.doc.css("pointer-events",a.saved["csspointerevents"]);if(a.rail.drag.pt!=1)return;a.rail.drag=false;if(a.hasmoving)a.triggerScrollEnd();return a.cancelEvent(e)}};a.onmousemove=function(e){if(a.rail.drag){if(a.rail.drag.pt!=1)return;if(p.ischrome&&e.which==0)return a.onmouseup(e);a.cursorfreezed=true;a.hasmoving=true;if(a.rail.drag.hr){a.scroll.x=a.rail.drag.sx+(e.clientX-a.rail.drag.x);if(a.scroll.x<0)a.scroll.x=0;var t=a.scrollvaluemaxw;if(a.scroll.x>t)a.scroll.x=t}else{a.scroll.y=a.rail.drag.sy+(e.clientY-a.rail.drag.y);if(a.scroll.y<0)a.scroll.y=0;var n=a.scrollvaluemax;if(a.scroll.y>n)a.scroll.y=n}a.synched("mousemove",function(){if(a.rail.drag&&a.rail.drag.pt==1){a.showCursor();if(a.rail.drag.hr)a.doScrollLeft(Math.round(a.scroll.x*a.scrollratio.x),a.opt.cursordragspeed);else a.doScrollTop(Math.round(a.scroll.y*a.scrollratio.y),a.opt.cursordragspeed)}});return a.cancelEvent(e)}};if(p.cantouch||a.opt.touchbehavior){a.onpreventclick=function(e){if(a.preventclick){a.preventclick.tg.onclick=a.preventclick.click;a.preventclick=false;return a.cancelEvent(e)}};a.bind(a.win,"mousedown",a.ontouchstart);a.onclick=p.isios?false:function(e){if(a.lastmouseup){a.lastmouseup=false;return a.cancelEvent(e)}else{return true}};if(a.opt.grabcursorenabled&&p.cursorgrabvalue){a.css(a.ispage?a.doc:a.win,{cursor:p.cursorgrabvalue});a.css(a.rail,{cursor:p.cursorgrabvalue})}}else{function N(e){if(!a.selectiondrag)return;if(e){var t=a.win.outerHeight();var n=e.pageY-a.selectiondrag.top;if(n>0&&n<t)n=0;if(n>=t)n-=t;a.selectiondrag.df=n}if(a.selectiondrag.df==0)return;var r=-Math.floor(a.selectiondrag.df/6)*2;a.doScrollBy(r);a.debounced("doselectionscroll",function(){N()},50)}if("getSelection"in document){a.hasTextSelected=function(){return document.getSelection().rangeCount>0}}else if("selection"in document){a.hasTextSelected=function(){return document.selection.type!="None"}}else{a.hasTextSelected=function(){return false}}a.onselectionstart=function(e){if(a.ispage)return;a.selectiondrag=a.win.offset()};a.onselectionend=function(e){a.selectiondrag=false};a.onselectiondrag=function(e){if(!a.selectiondrag)return;if(a.hasTextSelected())a.debounced("selectionscroll",function(){N(e)},250)}}if(p.hasmstouch){a.css(a.rail,{"-ms-touch-action":"none"});a.css(a.cursor,{"-ms-touch-action":"none"});a.bind(a.win,"MSPointerDown",a.ontouchstart);a.bind(document,"MSPointerUp",a.ontouchend);a.bind(document,"MSPointerMove",a.ontouchmove);a.bind(a.cursor,"MSGestureHold",function(e){e.preventDefault()});a.bind(a.cursor,"contextmenu",function(e){e.preventDefault()})}if(this.istouchcapable){a.bind(a.win,"touchstart",a.ontouchstart);a.bind(document,"touchend",a.ontouchend);a.bind(document,"touchcancel",a.ontouchend);a.bind(document,"touchmove",a.ontouchmove)}a.bind(a.cursor,"mousedown",a.onmousedown);a.bind(a.cursor,"mouseup",a.onmouseup);if(a.railh){a.bind(a.cursorh,"mousedown",function(e){a.onmousedown(e,true)});a.bind(a.cursorh,"mouseup",a.onmouseup)}if(a.opt.cursordragontouch||!p.cantouch&&!a.opt.touchbehavior){a.rail.css({cursor:"default"});a.railh&&a.railh.css({cursor:"default"});a.jqbind(a.rail,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.rail,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()});if(a.opt.sensitiverail){a.bind(a.rail,"click",function(e){a.doRailClick(e,false,false)});a.bind(a.rail,"dblclick",function(e){a.doRailClick(e,true,false)});a.bind(a.cursor,"click",function(e){a.cancelEvent(e)});a.bind(a.cursor,"dblclick",function(e){a.cancelEvent(e)})}if(a.railh){a.jqbind(a.railh,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.railh,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()});if(a.opt.sensitiverail){a.bind(a.railh,"click",function(e){a.doRailClick(e,false,true)});a.bind(a.railh,"dblclick",function(e){a.doRailClick(e,true,true)});a.bind(a.cursorh,"click",function(e){a.cancelEvent(e)});a.bind(a.cursorh,"dblclick",function(e){a.cancelEvent(e)})}}}if(!p.cantouch&&!a.opt.touchbehavior){a.bind(p.hasmousecapture?a.win:document,"mouseup",a.onmouseup);a.bind(document,"mousemove",a.onmousemove);if(a.onclick)a.bind(document,"click",a.onclick);if(!a.ispage&&a.opt.enablescrollonselection){a.bind(a.win[0],"mousedown",a.onselectionstart);a.bind(document,"mouseup",a.onselectionend);a.bind(a.cursor,"mouseup",a.onselectionend);if(a.cursorh)a.bind(a.cursorh,"mouseup",a.onselectionend);a.bind(document,"mousemove",a.onselectiondrag)}if(a.zoom){a.jqbind(a.zoom,"mouseenter",function(){if(a.canshowonmouseevent)a.showCursor();a.rail.active=true});a.jqbind(a.zoom,"mouseleave",function(){a.rail.active=false;if(!a.rail.drag)a.hideCursor()})}}else{a.bind(p.hasmousecapture?a.win:document,"mouseup",a.ontouchend);a.bind(document,"mousemove",a.ontouchmove);if(a.onclick)a.bind(document,"click",a.onclick);if(a.opt.cursordragontouch){a.bind(a.cursor,"mousedown",a.onmousedown);a.bind(a.cursor,"mousemove",a.onmousemove);a.cursorh&&a.bind(a.cursorh,"mousedown",function(e){a.onmousedown(e,true)});a.cursorh&&a.bind(a.cursorh,"mousemove",a.onmousemove)}}if(a.opt.enablemousewheel){if(!a.isiframe)a.bind(p.isie&&a.ispage?document:a.win,"mousewheel",a.onmousewheel);a.bind(a.rail,"mousewheel",a.onmousewheel);if(a.railh)a.bind(a.railh,"mousewheel",a.onmousewheelhr)}if(!a.ispage&&!p.cantouch&&!/HTML|BODY/.test(a.win[0].nodeName)){if(!a.win.attr("tabindex"))a.win.attr({tabindex:i++});a.jqbind(a.win,"focus",function(e){t=a.getTarget(e).id||true;a.hasfocus=true;if(a.canshowonmouseevent)a.noticeCursor()});a.jqbind(a.win,"blur",function(e){t=false;a.hasfocus=false});a.jqbind(a.win,"mouseenter",function(e){n=a.getTarget(e).id||true;a.hasmousefocus=true;if(a.canshowonmouseevent)a.noticeCursor()});a.jqbind(a.win,"mouseleave",function(){n=false;a.hasmousefocus=false;if(!a.rail.drag)a.hideCursor()})}}a.onkeypress=function(e){if(a.locked&&a.page.maxh==0)return true;e=e?e:window.e;var r=a.getTarget(e);if(r&&/INPUT|TEXTAREA|SELECT|OPTION/.test(r.nodeName)){var i=r.getAttribute("type")||r.type||false;if(!i||!/submit|button|cancel/i.tp)return true}if(a.hasfocus||a.hasmousefocus&&!t||a.ispage&&!t&&!n){var s=e.keyCode;if(a.locked&&s!=27)return a.cancelEvent(e);var o=e.ctrlKey||false;var u=e.shiftKey||false;var f=false;switch(s){case 38:case 63233:a.doScrollBy(24*3);f=true;break;case 40:case 63235:a.doScrollBy(-24*3);f=true;break;case 37:case 63232:if(a.railh){o?a.doScrollLeft(0):a.doScrollLeftBy(24*3);f=true}break;case 39:case 63234:if(a.railh){o?a.doScrollLeft(a.page.maxw):a.doScrollLeftBy(-24*3);f=true}break;case 33:case 63276:a.doScrollBy(a.view.h);f=true;break;case 34:case 63277:a.doScrollBy(-a.view.h);f=true;break;case 36:case 63273:a.railh&&o?a.doScrollPos(0,0):a.doScrollTo(0);f=true;break;case 35:case 63275:a.railh&&o?a.doScrollPos(a.page.maxw,a.page.maxh):a.doScrollTo(a.page.maxh);f=true;break;case 32:if(a.opt.spacebarenabled){u?a.doScrollBy(a.view.h):a.doScrollBy(-a.view.h);f=true}break;case 27:if(a.zoomactive){a.doZoom();f=true}break}if(f)return a.cancelEvent(e)}};if(a.opt.enablekeyboard)a.bind(document,p.isopera&&!p.isopera12?"keypress":"keydown",a.onkeypress);a.bind(window,"resize",a.lazyResize);a.bind(window,"orientationchange",a.lazyResize);a.bind(window,"load",a.lazyResize);if(p.ischrome&&!a.ispage&&!a.haswrapper){var C=a.win.attr("style");var k=parseFloat(a.win.css("width"))+1;a.win.css("width",k);a.synched("chromefix",function(){a.win.attr("style",C)})}a.onAttributeChange=function(e){a.lazyResize(250)};if(!a.ispage&&!a.haswrapper){if(v!==false){a.observer=new v(function(e){e.forEach(a.onAttributeChange)});a.observer.observe(a.win[0],{childList:true,characterData:false,attributes:true,subtree:false});a.observerremover=new v(function(e){e.forEach(function(e){if(e.removedNodes.length>0){for(var t in e.removedNodes){if(e.removedNodes[t]==a.win[0])return a.remove()}}})});a.observerremover.observe(a.win[0].parentNode,{childList:true,characterData:false,attributes:false,subtree:false})}else{a.bind(a.win,p.isie&&!p.isie9?"propertychange":"DOMAttrModified",a.onAttributeChange);if(p.isie9)a.win[0].attachEvent("onpropertychange",a.onAttributeChange);a.bind(a.win,"DOMNodeRemoved",function(e){if(e.target==a.win[0])a.remove()})}}if(!a.ispage&&a.opt.boxzoom)a.bind(window,"resize",a.resizeZoom);if(a.istextarea)a.bind(a.win,"mouseup",a.lazyResize);a.checkrtlmode=true;a.lazyResize(30)}if(this.doc[0].nodeName=="IFRAME"){function L(e){a.iframexd=false;try{var t="contentDocument"in this?this.contentDocument:this.contentWindow.document;var n=t.domain}catch(e){a.iframexd=true;t=false}if(a.iframexd){if("console"in window)console.log("NiceScroll error: policy restriced iframe");return true}a.forcescreen=true;if(a.isiframe){a.iframe={doc:u(t),html:a.doc.contents().find("html")[0],body:a.doc.contents().find("body")[0]};a.getContentSize=function(){return{w:Math.max(a.iframe.html.scrollWidth,a.iframe.body.scrollWidth),h:Math.max(a.iframe.html.scrollHeight,a.iframe.body.scrollHeight)}};a.docscroll=u(a.iframe.body)}if(!p.isios&&a.opt.iframeautoresize&&!a.isiframe){a.win.scrollTop(0);a.doc.height("");var r=Math.max(t.getElementsByTagName("html")[0].scrollHeight,t.body.scrollHeight);a.doc.height(r)}a.lazyResize(30);if(p.isie7)a.css(u(a.iframe.html),{"overflow-y":"hidden"});a.css(u(a.iframe.body),{"overflow-y":"hidden"});if(p.isios&&a.haswrapper){a.css(u(t.body),{"-webkit-transform":"translate3d(0,0,0)"})}if("contentWindow"in this){a.bind(this.contentWindow,"scroll",a.onscroll)}else{a.bind(t,"scroll",a.onscroll)}if(a.opt.enablemousewheel){a.bind(t,"mousewheel",a.onmousewheel)}if(a.opt.enablekeyboard)a.bind(t,p.isopera?"keypress":"keydown",a.onkeypress);if(p.cantouch||a.opt.touchbehavior){a.bind(t,"mousedown",a.ontouchstart);a.bind(t,"mousemove",function(e){a.ontouchmove(e,true)});if(a.opt.grabcursorenabled&&p.cursorgrabvalue)a.css(u(t.body),{cursor:p.cursorgrabvalue})}a.bind(t,"mouseup",a.ontouchend);if(a.zoom){if(a.opt.dblclickzoom)a.bind(t,"dblclick",a.doZoom);if(a.ongesturezoom)a.bind(t,"gestureend",a.ongesturezoom)}}if(this.doc[0].readyState&&this.doc[0].readyState=="complete"){setTimeout(function(){L.call(a.doc[0],false)},500)}a.bind(this.doc,"load",L)}};this.showCursor=function(e,t){if(a.cursortimeout){clearTimeout(a.cursortimeout);a.cursortimeout=0}if(!a.rail)return;if(a.autohidedom){a.autohidedom.stop().css({opacity:a.opt.cursoropacitymax});a.cursoractive=true}if(!a.rail.drag||a.rail.drag.pt!=1){if(typeof e!="undefined"&&e!==false){a.scroll.y=Math.round(e*1/a.scrollratio.y)}if(typeof t!="undefined"){a.scroll.x=Math.round(t*1/a.scrollratio.x)}}a.cursor.css({height:a.cursorheight,top:a.scroll.y});if(a.cursorh){!a.rail.align&&a.rail.visibility?a.cursorh.css({width:a.cursorwidth,left:a.scroll.x+a.rail.width}):a.cursorh.css({width:a.cursorwidth,left:a.scroll.x});a.cursoractive=true}if(a.zoom)a.zoom.stop().css({opacity:a.opt.cursoropacitymax})};this.hideCursor=function(e){if(a.cursortimeout)return;if(!a.rail)return;if(!a.autohidedom)return;if(a.hasmousefocus&&a.opt.autohidemode=="leave")return;a.cursortimeout=setTimeout(function(){if(!a.rail.active||!a.showonmouseevent){a.autohidedom.stop().animate({opacity:a.opt.cursoropacitymin});if(a.zoom)a.zoom.stop().animate({opacity:a.opt.cursoropacitymin});a.cursoractive=false}a.cursortimeout=0},e||a.opt.hidecursordelay)};this.noticeCursor=function(e,t,n){a.showCursor(t,n);if(!a.rail.active)a.hideCursor(e)};this.getContentSize=a.ispage?function(){return{w:Math.max(document.body.scrollWidth,document.documentElement.scrollWidth),h:Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)}}:a.haswrapper?function(){return{w:a.doc.outerWidth()+parseInt(a.win.css("paddingLeft"))+parseInt(a.win.css("paddingRight")),h:a.doc.outerHeight()+parseInt(a.win.css("paddingTop"))+parseInt(a.win.css("paddingBottom"))}}:function(){return{w:a.docscroll[0].scrollWidth,h:a.docscroll[0].scrollHeight}};this.onResize=function(e,t){if(!a||!a.win)return false;if(!a.haswrapper&&!a.ispage){if(a.win.css("display")=="none"){if(a.visibility)a.hideRail().hideRailHr();return false}else{if(!a.hidden&&!a.visibility)a.showRail().showRailHr()}}var n=a.page.maxh;var r=a.page.maxw;var i={h:a.view.h,w:a.view.w};a.view={w:a.ispage?a.win.width():parseInt(a.win[0].clientWidth),h:a.ispage?a.win.height():parseInt(a.win[0].clientHeight)};a.page=t?t:a.getContentSize();a.page.maxh=Math.max(0,a.page.h-a.view.h);a.page.maxw=Math.max(0,a.page.w-a.view.w);if(a.page.maxh==n&&a.page.maxw==r&&a.view.w==i.w){if(!a.ispage){var s=a.win.offset();if(a.lastposition){var o=a.lastposition;if(o.top==s.top&&o.left==s.left)return a}a.lastposition=s}else{return a}}if(a.page.maxh==0){a.hideRail();a.scrollvaluemax=0;a.scroll.y=0;a.scrollratio.y=0;a.cursorheight=0;a.setScrollTop(0);a.rail.scrollable=false}else{a.rail.scrollable=true}if(a.page.maxw==0){a.hideRailHr();a.scrollvaluemaxw=0;a.scroll.x=0;a.scrollratio.x=0;a.cursorwidth=0;a.setScrollLeft(0);a.railh.scrollable=false}else{a.railh.scrollable=true}a.locked=a.page.maxh==0&&a.page.maxw==0;if(a.locked){if(!a.ispage)a.updateScrollBar(a.view);return false}if(!a.hidden&&!a.visibility){a.showRail().showRailHr()}else if(!a.hidden&&!a.railh.visibility)a.showRailHr();if(a.istextarea&&a.win.css("resize")&&a.win.css("resize")!="none")a.view.h-=20;a.cursorheight=Math.min(a.view.h,Math.round(a.view.h*(a.view.h/a.page.h)));a.cursorheight=a.opt.cursorfixedheight?a.opt.cursorfixedheight:Math.max(a.opt.cursorminheight,a.cursorheight);a.cursorwidth=Math.min(a.view.w,Math.round(a.view.w*(a.view.w/a.page.w)));a.cursorwidth=a.opt.cursorfixedheight?a.opt.cursorfixedheight:Math.max(a.opt.cursorminheight,a.cursorwidth);a.scrollvaluemax=a.view.h-a.cursorheight-a.cursor.hborder;if(a.railh){a.railh.width=a.page.maxh>0?a.view.w-a.rail.width:a.view.w;a.scrollvaluemaxw=a.railh.width-a.cursorwidth-a.cursorh.wborder}if(a.checkrtlmode&&a.railh){a.checkrtlmode=false;if(a.opt.rtlmode&&a.scroll.x==0)a.setScrollLeft(a.page.maxw)}if(!a.ispage)a.updateScrollBar(a.view);a.scrollratio={x:a.page.maxw/a.scrollvaluemaxw,y:a.page.maxh/a.scrollvaluemax};var u=a.getScrollTop();if(u>a.page.maxh){a.doScrollTop(a.page.maxh)}else{a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));a.scroll.x=Math.round(a.getScrollLeft()*(1/a.scrollratio.x));if(a.cursoractive)a.noticeCursor()}if(a.scroll.y&&a.getScrollTop()==0)a.doScrollTo(Math.floor(a.scroll.y*a.scrollratio.y));return a};this.resize=a.onResize;this.lazyResize=function(e){e=isNaN(e)?30:e;a.delayed("resize",a.resize,e);return a};this._bind=function(e,t,n,r){a.events.push({e:e,n:t,f:n,b:r,q:false});if(e.addEventListener){e.addEventListener(t,n,r||false)}else if(e.attachEvent){e.attachEvent("on"+t,n)}else{e["on"+t]=n}};this.jqbind=function(e,t,n){a.events.push({e:e,n:t,f:n,q:true});u(e).bind(t,n)};this.bind=function(e,t,n,r){var i="jquery"in e?e[0]:e;if(t=="mousewheel"){if("onwheel"in a.win){a._bind(i,"wheel",n,r||false)}else{var s=typeof document.onmousewheel!="undefined"?"mousewheel":"DOMMouseScroll";x(i,s,n,r||false);if(s=="DOMMouseScroll")x(i,"MozMousePixelScroll",n,r||false)}}else if(i.addEventListener){if(p.cantouch&&/mouseup|mousedown|mousemove/.test(t)){var o=t=="mousedown"?"touchstart":t=="mouseup"?"touchend":"touchmove";a._bind(i,o,function(e){if(e.touches){if(e.touches.length<2){var t=e.touches.length?e.touches[0]:e;t.original=e;n.call(this,t)}}else if(e.changedTouches){var t=e.changedTouches[0];t.original=e;n.call(this,t)}},r||false)}a._bind(i,t,n,r||false);if(p.cantouch&&t=="mouseup")a._bind(i,"touchcancel",n,r||false)}else{a._bind(i,t,function(e){e=e||window.event||false;if(e){if(e.srcElement)e.target=e.srcElement}if(!("pageY"in e)){e.pageX=e.clientX+document.documentElement.scrollLeft;e.pageY=e.clientY+document.documentElement.scrollTop}return n.call(i,e)===false||r===false?a.cancelEvent(e):true})}};this._unbind=function(e,t,n,r){if(e.removeEventListener){e.removeEventListener(t,n,r)}else if(e.detachEvent){e.detachEvent("on"+t,n)}else{e["on"+t]=false}};this.unbindAll=function(){for(var e=0;e<a.events.length;e++){var t=a.events[e];t.q?t.e.unbind(t.n,t.f):a._unbind(t.e,t.n,t.f,t.b)}};this.cancelEvent=function(e){var e=e.original?e.original:e?e:window.event||false;if(!e)return false;if(e.preventDefault)e.preventDefault();if(e.stopPropagation)e.stopPropagation();if(e.preventManipulation)e.preventManipulation();e.cancelBubble=true;e.cancel=true;e.returnValue=false;return false};this.stopPropagation=function(e){var e=e.original?e.original:e?e:window.event||false;if(!e)return false;if(e.stopPropagation)return e.stopPropagation();if(e.cancelBubble)e.cancelBubble=true;return false};this.showRail=function(){if(a.page.maxh!=0&&(a.ispage||a.win.css("display")!="none")){a.visibility=true;a.rail.visibility=true;a.rail.css("display","block")}return a};this.showRailHr=function(){if(!a.railh)return a;if(a.page.maxw!=0&&(a.ispage||a.win.css("display")!="none")){a.railh.visibility=true;a.railh.css("display","block")}return a};this.hideRail=function(){a.visibility=false;a.rail.visibility=false;a.rail.css("display","none");return a};this.hideRailHr=function(){if(!a.railh)return a;a.railh.visibility=false;a.railh.css("display","none");return a};this.show=function(){a.hidden=false;a.locked=false;return a.showRail().showRailHr()};this.hide=function(){a.hidden=true;a.locked=true;return a.hideRail().hideRailHr()};this.toggle=function(){return a.hidden?a.show():a.hide()};this.remove=function(){a.stop();if(a.cursortimeout)clearTimeout(a.cursortimeout);a.doZoomOut();a.unbindAll();if(p.isie9)a.win[0].detachEvent("onpropertychange",a.onAttributeChange);if(a.observer!==false)a.observer.disconnect();if(a.observerremover!==false)a.observerremover.disconnect();a.events=null;if(a.cursor){a.cursor.remove()}if(a.cursorh){a.cursorh.remove()}if(a.rail){a.rail.remove()}if(a.railh){a.railh.remove()}if(a.zoom){a.zoom.remove()}for(var e=0;e<a.saved.css.length;e++){var t=a.saved.css[e];t[0].css(t[1],typeof t[2]=="undefined"?"":t[2])}a.saved=false;a.me.data("__nicescroll","");var n=u.nicescroll;n.each(function(e){if(!this)return;if(this.id===a.id){delete n[e];for(var t=++e;t<n.length;t++,e++)n[e]=n[t];n.length--;if(n.length)delete n[n.length]}});for(var r in a){a[r]=null;delete a[r]}a=null};this.scrollstart=function(e){this.onscrollstart=e;return a};this.scrollend=function(e){this.onscrollend=e;return a};this.scrollcancel=function(e){this.onscrollcancel=e;return a};this.zoomin=function(e){this.onzoomin=e;return a};this.zoomout=function(e){this.onzoomout=e;return a};this.isScrollable=function(e){var t=e.target?e.target:e;if(t.nodeName=="OPTION")return true;while(t&&t.nodeType==1&&!/BODY|HTML/.test(t.nodeName)){var n=u(t);var r=n.css("overflowY")||n.css("overflowX")||n.css("overflow")||"";if(/scroll|auto/.test(r))return t.clientHeight!=t.scrollHeight;t=t.parentNode?t.parentNode:false}return false};this.getViewport=function(e){var t=e&&e.parentNode?e.parentNode:false;while(t&&t.nodeType==1&&!/BODY|HTML/.test(t.nodeName)){var n=u(t);if(/fixed|absolute/.test(n.css("position")))return n;var r=n.css("overflowY")||n.css("overflowX")||n.css("overflow")||"";if(/scroll|auto/.test(r)&&t.clientHeight!=t.scrollHeight)return n;if(n.getNiceScroll().length>0)return n;t=t.parentNode?t.parentNode:false}console.log(u(t).parents());return t?u(t):false};this.triggerScrollEnd=function(){if(!a.onscrollend)return;var e=a.getScrollLeft();var t=a.getScrollTop();var n={type:"scrollend",current:{x:e,y:t},end:{x:e,y:t}};a.onscrollend.call(a,n)};this.onmousewheel=function(e){if(a.locked){a.debounced("checkunlock",a.resize,250);return true}if(a.rail.drag)return a.cancelEvent(e);if(a.opt.oneaxismousemode=="auto"&&e.deltaX!=0)a.opt.oneaxismousemode=false;if(a.opt.oneaxismousemode&&e.deltaX==0){if(!a.rail.scrollable){if(a.railh&&a.railh.scrollable){return a.onmousewheelhr(e)}else{return true}}}var t=+(new Date);var n=false;if(a.opt.preservenativescrolling&&a.checkarea+600<t){a.nativescrollingarea=a.isScrollable(e);n=true}a.checkarea=t;if(a.nativescrollingarea)return true;var r=T(e,false,n);if(r)a.checkarea=0;return r};this.onmousewheelhr=function(e){if(a.locked||!a.railh.scrollable)return true;if(a.rail.drag)return a.cancelEvent(e);var t=+(new Date);var n=false;if(a.opt.preservenativescrolling&&a.checkarea+600<t){a.nativescrollingarea=a.isScrollable(e);n=true}a.checkarea=t;if(a.nativescrollingarea)return true;if(a.locked)return a.cancelEvent(e);return T(e,true,n)};this.stop=function(){a.cancelScroll();if(a.scrollmon)a.scrollmon.stop();a.cursorfreezed=false;a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));a.noticeCursor();return a};this.getTransitionSpeed=function(e){var t=Math.round(a.opt.scrollspeed*10);var n=Math.min(t,Math.round(e/20*a.opt.scrollspeed));return n>20?n:0};if(!a.opt.smoothscroll){this.doScrollLeft=function(e,t){var n=a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){var r=e>a.page.maxw?a.page.maxw:e;if(r<0)r=0;var i=t>a.page.maxh?a.page.maxh:t;if(i<0)i=0;a.synched("scroll",function(){a.setScrollTop(i);a.setScrollLeft(r)})};this.cancelScroll=function(){}}else if(a.ishwscroll&&p.hastransition&&a.opt.usetransition){this.prepareTransition=function(e,t){var n=t?e>20?e:0:a.getTransitionSpeed(e);var r=n?p.prefixstyle+"transform "+n+"ms ease-out":"";if(!a.lasttransitionstyle||a.lasttransitionstyle!=r){a.lasttransitionstyle=r;a.doc.css(p.transitionstyle,r)}return n};this.doScrollLeft=function(e,t){var n=a.scrollrunning?a.newscrolly:a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.scrollrunning?a.newscrollx:a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){var r=a.getScrollTop();var i=a.getScrollLeft();if((a.newscrolly-r)*(t-r)<0||(a.newscrollx-i)*(e-i)<0)a.cancelScroll();if(a.opt.bouncescroll==false){if(t<0)t=0;else if(t>a.page.maxh)t=a.page.maxh;if(e<0)e=0;else if(e>a.page.maxw)e=a.page.maxw}if(a.scrollrunning&&e==a.newscrollx&&t==a.newscrolly)return false;a.newscrolly=t;a.newscrollx=e;a.newscrollspeed=n||false;if(a.timer)return false;a.timer=setTimeout(function(){var n=a.getScrollTop();var r=a.getScrollLeft();var i={};i.x=e-r;i.y=t-n;i.px=r;i.py=n;var s=Math.round(Math.sqrt(Math.pow(i.x,2)+Math.pow(i.y,2)));var o=a.newscrollspeed&&a.newscrollspeed>1?a.newscrollspeed:a.getTransitionSpeed(s);if(a.newscrollspeed&&a.newscrollspeed<=1)o*=a.newscrollspeed;a.prepareTransition(o,true);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);if(o>0){if(!a.scrollrunning&&a.onscrollstart){var u={type:"scrollstart",current:{x:r,y:n},request:{x:e,y:t},end:{x:a.newscrollx,y:a.newscrolly},speed:o};a.onscrollstart.call(a,u)}if(p.transitionend){if(!a.scrollendtrapped){a.scrollendtrapped=true;a.bind(a.doc,p.transitionend,a.onScrollTransitionEnd,false)}}else{if(a.scrollendtrapped)clearTimeout(a.scrollendtrapped);a.scrollendtrapped=setTimeout(a.onScrollTransitionEnd,o)}var f=n;var l=r;a.timerscroll={bz:new BezierClass(f,a.newscrolly,o,0,0,.58,1),bh:new BezierClass(l,a.newscrollx,o,0,0,.58,1)};if(!a.cursorfreezed)a.timerscroll.tm=setInterval(function(){a.showCursor(a.getScrollTop(),a.getScrollLeft())},60)}a.synched("doScroll-set",function(){a.timer=0;if(a.scrollendtrapped)a.scrollrunning=true;a.setScrollTop(a.newscrolly);a.setScrollLeft(a.newscrollx);if(!a.scrollendtrapped)a.onScrollTransitionEnd()})},50)};this.cancelScroll=function(){if(!a.scrollendtrapped)return true;var e=a.getScrollTop();var t=a.getScrollLeft();a.scrollrunning=false;if(!p.transitionend)clearTimeout(p.transitionend);a.scrollendtrapped=false;a._unbind(a.doc,p.transitionend,a.onScrollTransitionEnd);a.prepareTransition(0);a.setScrollTop(e);if(a.railh)a.setScrollLeft(t);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);a.timerscroll=false;a.cursorfreezed=false;a.showCursor(e,t);return a};this.onScrollTransitionEnd=function(){if(a.scrollendtrapped)a._unbind(a.doc,p.transitionend,a.onScrollTransitionEnd);a.scrollendtrapped=false;a.prepareTransition(0);if(a.timerscroll&&a.timerscroll.tm)clearInterval(a.timerscroll.tm);a.timerscroll=false;var e=a.getScrollTop();var t=a.getScrollLeft();a.setScrollTop(e);if(a.railh)a.setScrollLeft(t);a.noticeCursor(false,e,t);a.cursorfreezed=false;if(e<0)e=0;else if(e>a.page.maxh)e=a.page.maxh;if(t<0)t=0;else if(t>a.page.maxw)t=a.page.maxw;if(e!=a.newscrolly||t!=a.newscrollx)return a.doScrollPos(t,e,a.opt.snapbackspeed);if(a.onscrollend&&a.scrollrunning){a.triggerScrollEnd()}a.scrollrunning=false}}else{this.doScrollLeft=function(e,t){var n=a.scrollrunning?a.newscrolly:a.getScrollTop();a.doScrollPos(e,n,t)};this.doScrollTop=function(e,t){var n=a.scrollrunning?a.newscrollx:a.getScrollLeft();a.doScrollPos(n,e,t)};this.doScrollPos=function(e,t,n){function p(){if(a.cancelAnimationFrame)return true;a.scrollrunning=true;l=1-l;if(l)return a.timer=c(p)||1;var e=0;var t=sy=a.getScrollTop();if(a.dst.ay){t=a.bzscroll?a.dst.py+a.bzscroll.getNow()*a.dst.ay:a.newscrolly;var n=t-sy;if(n<0&&t<a.newscrolly||n>0&&t>a.newscrolly)t=a.newscrolly;a.setScrollTop(t);if(t==a.newscrolly)e=1}else{e=1}var r=sx=a.getScrollLeft();if(a.dst.ax){r=a.bzscroll?a.dst.px+a.bzscroll.getNow()*a.dst.ax:a.newscrollx;var n=r-sx;if(n<0&&r<a.newscrollx||n>0&&r>a.newscrollx)r=a.newscrollx;a.setScrollLeft(r);if(r==a.newscrollx)e+=1}else{e+=1}if(e==2){a.timer=0;a.cursorfreezed=false;a.bzscroll=false;a.scrollrunning=false;if(t<0)t=0;else if(t>a.page.maxh)t=a.page.maxh;if(r<0)r=0;else if(r>a.page.maxw)r=a.page.maxw;if(r!=a.newscrollx||t!=a.newscrolly)a.doScrollPos(r,t);else{if(a.onscrollend){a.triggerScrollEnd()}}}else{a.timer=c(p)||1}}var t=typeof t=="undefined"||t===false?a.getScrollTop(true):t;if(a.timer&&a.newscrolly==t&&a.newscrollx==e)return true;if(a.timer)h(a.timer);a.timer=0;var r=a.getScrollTop();var i=a.getScrollLeft();if((a.newscrolly-r)*(t-r)<0||(a.newscrollx-i)*(e-i)<0)a.cancelScroll();a.newscrolly=t;a.newscrollx=e;if(!a.bouncescroll||!a.rail.visibility){if(a.newscrolly<0){a.newscrolly=0}else if(a.newscrolly>a.page.maxh){a.newscrolly=a.page.maxh}}if(!a.bouncescroll||!a.railh.visibility){if(a.newscrollx<0){a.newscrollx=0}else if(a.newscrollx>a.page.maxw){a.newscrollx=a.page.maxw}}a.dst={};a.dst.x=e-i;a.dst.y=t-r;a.dst.px=i;a.dst.py=r;var s=Math.round(Math.sqrt(Math.pow(a.dst.x,2)+Math.pow(a.dst.y,2)));a.dst.ax=a.dst.x/s;a.dst.ay=a.dst.y/s;var o=0;var u=s;if(a.dst.x==0){o=r;u=t;a.dst.ay=1;a.dst.py=0}else if(a.dst.y==0){o=i;u=e;a.dst.ax=1;a.dst.px=0}var f=a.getTransitionSpeed(s);if(n&&n<=1)f*=n;if(f>0){a.bzscroll=a.bzscroll?a.bzscroll.update(u,f):new BezierClass(o,u,f,0,1,0,1)}else{a.bzscroll=false}if(a.timer)return;if(r==a.page.maxh&&t>=a.page.maxh||i==a.page.maxw&&e>=a.page.maxw)a.checkContentSize();var l=1;a.cancelAnimationFrame=false;a.timer=1;if(a.onscrollstart&&!a.scrollrunning){var d={type:"scrollstart",current:{x:i,y:r},request:{x:e,y:t},end:{x:a.newscrollx,y:a.newscrolly},speed:f};a.onscrollstart.call(a,d)}p();if(r==a.page.maxh&&t>=r||i==a.page.maxw&&e>=i)a.checkContentSize();a.noticeCursor()};this.cancelScroll=function(){if(a.timer)h(a.timer);a.timer=0;a.bzscroll=false;a.scrollrunning=false;return a}}this.doScrollBy=function(e,t){var n=0;if(t){n=Math.floor((a.scroll.y-e)*a.scrollratio.y)}else{var r=a.timer?a.newscrolly:a.getScrollTop(true);n=r-e}if(a.bouncescroll){var i=Math.round(a.view.h/2);if(n<-i)n=-i;else if(n>a.page.maxh+i)n=a.page.maxh+i}a.cursorfreezed=false;py=a.getScrollTop(true);if(n<0&&py<=0)return a.noticeCursor();else if(n>a.page.maxh&&py>=a.page.maxh){a.checkContentSize();return a.noticeCursor()}a.doScrollTop(n)};this.doScrollLeftBy=function(e,t){var n=0;if(t){n=Math.floor((a.scroll.x-e)*a.scrollratio.x)}else{var r=a.timer?a.newscrollx:a.getScrollLeft(true);n=r-e}if(a.bouncescroll){var i=Math.round(a.view.w/2);if(n<-i)n=-i;else if(n>a.page.maxw+i)n=a.page.maxw+i}a.cursorfreezed=false;px=a.getScrollLeft(true);if(n<0&&px<=0)return a.noticeCursor();else if(n>a.page.maxw&&px>=a.page.maxw)return a.noticeCursor();a.doScrollLeft(n)};this.doScrollTo=function(e,t){var n=t?Math.round(e*a.scrollratio.y):e;if(n<0)n=0;else if(n>a.page.maxh)n=a.page.maxh;a.cursorfreezed=false;a.doScrollTop(e)};this.checkContentSize=function(){var e=a.getContentSize();if(e.h!=a.page.h||e.w!=a.page.w)a.resize(false,e)};a.onscroll=function(e){if(a.rail.drag)return;if(!a.cursorfreezed){a.synched("scroll",function(){a.scroll.y=Math.round(a.getScrollTop()*(1/a.scrollratio.y));if(a.railh)a.scroll.x=Math.round(a.getScrollLeft()*(1/a.scrollratio.x));a.noticeCursor()})}};a.bind(a.docscroll,"scroll",a.onscroll);this.doZoomIn=function(e){if(a.zoomactive)return;a.zoomactive=true;a.zoomrestore={style:{}};var t=["position","top","left","zIndex","backgroundColor","marginTop","marginBottom","marginLeft","marginRight"];var n=a.win[0].style;for(var r in t){var i=t[r];a.zoomrestore.style[i]=typeof n[i]!="undefined"?n[i]:""}a.zoomrestore.style.width=a.win.css("width");a.zoomrestore.style.height=a.win.css("height");a.zoomrestore.padding={w:a.win.outerWidth()-a.win.width(),h:a.win.outerHeight()-a.win.height()};if(p.isios4){a.zoomrestore.scrollTop=u(window).scrollTop();u(window).scrollTop(0)}a.win.css({position:p.isios4?"absolute":"fixed",top:0,left:0,"z-index":o+100,margin:"0px"});var s=a.win.css("backgroundColor");if(s==""||/transparent|rgba\(0, 0, 0, 0\)|rgba\(0,0,0,0\)/.test(s))a.win.css("backgroundColor","#fff");a.rail.css({"z-index":o+101});a.zoom.css({"z-index":o+102});a.zoom.css("backgroundPosition","0px -18px");a.resizeZoom();if(a.onzoomin)a.onzoomin.call(a);return a.cancelEvent(e)};this.doZoomOut=function(e){if(!a.zoomactive)return;a.zoomactive=false;a.win.css("margin","");a.win.css(a.zoomrestore.style);if(p.isios4){u(window).scrollTop(a.zoomrestore.scrollTop)}a.rail.css({"z-index":a.zindex});a.zoom.css({"z-index":a.zindex});a.zoomrestore=false;a.zoom.css("backgroundPosition","0px 0px");a.onResize();if(a.onzoomout)a.onzoomout.call(a);return a.cancelEvent(e)};this.doZoom=function(e){return a.zoomactive?a.doZoomOut(e):a.doZoomIn(e)};this.resizeZoom=function(){if(!a.zoomactive)return;var e=a.getScrollTop();a.win.css({width:u(window).width()-a.zoomrestore.padding.w+"px",height:u(window).height()-a.zoomrestore.padding.h+"px"});a.onResize();a.setScrollTop(Math.min(a.page.maxh,e))};this.init();u.nicescroll.push(this)};var w=function(e){var t=this;this.nc=e;this.lastx=0;this.lasty=0;this.speedx=0;this.speedy=0;this.lasttime=0;this.steptime=0;this.snapx=false;this.snapy=false;this.demulx=0;this.demuly=0;this.lastscrollx=-1;this.lastscrolly=-1;this.chkx=0;this.chky=0;this.timer=0;this.time=function(){return+(new Date)};this.reset=function(e,n){t.stop();var r=t.time();t.steptime=0;t.lasttime=r;t.speedx=0;t.speedy=0;t.lastx=e;t.lasty=n;t.lastscrollx=-1;t.lastscrolly=-1};this.update=function(e,n){var r=t.time();t.steptime=r-t.lasttime;t.lasttime=r;var i=n-t.lasty;var s=e-t.lastx;var o=t.nc.getScrollTop();var u=t.nc.getScrollLeft();var a=o+i;var f=u+s;t.snapx=f<0||f>t.nc.page.maxw;t.snapy=a<0||a>t.nc.page.maxh;t.speedx=s;t.speedy=i;t.lastx=e;t.lasty=n};this.stop=function(){t.nc.unsynched("domomentum2d");if(t.timer)clearTimeout(t.timer);t.timer=0;t.lastscrollx=-1;t.lastscrolly=-1};this.doSnapy=function(e,n){var r=false;if(n<0){n=0;r=true}else if(n>t.nc.page.maxh){n=t.nc.page.maxh;r=true}if(e<0){e=0;r=true}else if(e>t.nc.page.maxw){e=t.nc.page.maxw;r=true}r?t.nc.doScrollPos(e,n,t.nc.opt.snapbackspeed):t.nc.triggerScrollEnd()};this.doMomentum=function(e){var n=t.time();var r=e?n+e:t.lasttime;var i=t.nc.getScrollLeft();var s=t.nc.getScrollTop();var o=t.nc.page.maxh;var u=t.nc.page.maxw;t.speedx=u>0?Math.min(60,t.speedx):0;t.speedy=o>0?Math.min(60,t.speedy):0;var a=r&&n-r<=60;if(s<0||s>o||i<0||i>u)a=false;var f=t.speedy&&a?t.speedy:false;var l=t.speedx&&a?t.speedx:false;if(f||l){var c=Math.max(16,t.steptime);if(c>50){var h=c/50;t.speedx*=h;t.speedy*=h;c=50}t.demulxy=0;t.lastscrollx=t.nc.getScrollLeft();t.chkx=t.lastscrollx;t.lastscrolly=t.nc.getScrollTop();t.chky=t.lastscrolly;var p=t.lastscrollx;var d=t.lastscrolly;var v=function(){var e=t.time()-n>600?.04:.02;if(t.speedx){p=Math.floor(t.lastscrollx-t.speedx*(1-t.demulxy));t.lastscrollx=p;if(p<0||p>u)e=.1}if(t.speedy){d=Math.floor(t.lastscrolly-t.speedy*(1-t.demulxy));t.lastscrolly=d;if(d<0||d>o)e=.1}t.demulxy=Math.min(1,t.demulxy+e);t.nc.synched("domomentum2d",function(){if(t.speedx){var e=t.nc.getScrollLeft();if(e!=t.chkx)t.stop();t.chkx=p;t.nc.setScrollLeft(p)}if(t.speedy){var n=t.nc.getScrollTop();if(n!=t.chky)t.stop();t.chky=d;t.nc.setScrollTop(d)}if(!t.timer){t.nc.hideCursor();t.doSnapy(p,d)}});if(t.demulxy<1){t.timer=setTimeout(v,c)}else{t.stop();t.nc.hideCursor();t.doSnapy(p,d)}};v()}else{t.doSnapy(t.nc.getScrollLeft(),t.nc.getScrollTop())}}};var E=e.fn.scrollTop;e.cssHooks["pageYOffset"]={get:function(e,t,n){var r=u.data(e,"__nicescroll")||false;return r&&r.ishwscroll?r.getScrollTop():E.call(e)},set:function(e,t){var n=u.data(e,"__nicescroll")||false;n&&n.ishwscroll?n.setScrollTop(parseInt(t)):E.call(e,t);return this}};e.fn.scrollTop=function(e){if(typeof e=="undefined"){var t=this[0]?u.data(this[0],"__nicescroll")||false:false;return t&&t.ishwscroll?t.getScrollTop():E.call(this)}else{return this.each(function(){var t=u.data(this,"__nicescroll")||false;t&&t.ishwscroll?t.setScrollTop(parseInt(e)):E.call(u(this),e)})}};var S=e.fn.scrollLeft;u.cssHooks.pageXOffset={get:function(e,t,n){var r=u.data(e,"__nicescroll")||false;return r&&r.ishwscroll?r.getScrollLeft():S.call(e)},set:function(e,t){var n=u.data(e,"__nicescroll")||false;n&&n.ishwscroll?n.setScrollLeft(parseInt(t)):S.call(e,t);return this}};e.fn.scrollLeft=function(e){if(typeof e=="undefined"){var t=this[0]?u.data(this[0],"__nicescroll")||false:false;return t&&t.ishwscroll?t.getScrollLeft():S.call(this)}else{return this.each(function(){var t=u.data(this,"__nicescroll")||false;t&&t.ishwscroll?t.setScrollLeft(parseInt(e)):S.call(u(this),e)})}};var x=function(e){var t=this;this.length=0;this.name="nicescrollarray";this.each=function(e){for(var n=0,r=0;n<t.length;n++)e.call(t[n],r++);return t};this.push=function(e){t[t.length]=e;t.length++};this.eq=function(e){return t[e]};if(e){for(var n=0;n<e.length;n++){var r=u.data(e[n],"__nicescroll")||false;if(r){this[this.length]=r;this.length++}}}return this};T(x.prototype,["show","hide","toggle","onResize","resize","remove","stop","doScrollPos"],function(e,t){e[t]=function(){var e=arguments;return this.each(function(){this[t].apply(this,e)})}});e.fn.getNiceScroll=function(e){if(typeof e=="undefined"){return new x(this)}else{var t=this[e]&&u.data(this[e],"__nicescroll")||false;return t}};e.extend(e.expr[":"],{nicescroll:function(e){return u.data(e,"__nicescroll")?true:false}});u.fn.niceScroll=function(e,t){if(typeof t=="undefined"){if(typeof e=="object"&&!("jquery"in e)){t=e;e=false}}var n=new x;if(typeof t=="undefined")t={};if(e||false){t.doc=u(e);t.win=u(this)}var r=!("doc"in t);if(!r&&!("win"in t))t.win=u(this);this.each(function(){var e=u(this).data("__nicescroll")||false;if(!e){t.doc=r?u(this):t.doc;e=new b(t,u(this));u(this).data("__nicescroll",e)}n.push(e)});return n.length==1?n[0]:n};window.NiceScroll={getjQuery:function(){return e}};if(!u.nicescroll){u.nicescroll=new x;u.nicescroll.options=m}})(jQuery);




/* --- JQUERY TOUCHCLICK --- */

(function ($) {
    var activeClass = "touchactive",
        touchstart,
        touchmove,
        touchend,
        timestamp;

    timestamp = function () {
        return Math.round((new Date()).getTime() / 1000);
    };

    touchstart = function (e) {
        var $targetEl = $(e.target),
            currentTimestamp = timestamp(),
            lastTimestamp = $targetEl.data("touchclick-last-touch"),
            difference = currentTimestamp - lastTimestamp;

        if (lastTimestamp && difference < 3 && e.type === "mousedown") {
            $targetEl.data("touchclick-disabled", true);
        } else {
            $targetEl.data("touchclick-disabled", false);
            $targetEl.addClass(activeClass);
        }

        if (e.type === "touchstart" || e.type === "MSPointerDown") {
            $targetEl.data("touchclick-last-touch", currentTimestamp);
        }
    };

    touchmove = function (e) {
        var $targetEl = $(e.target);

        $targetEl.data("touchclick-disabled", true);
        $targetEl.removeClass(activeClass);
    };

    touchend = function (e) {
        
        var $targetEl = $(e.target);

        if (!$targetEl.data("touchclick-disabled")) {
            e.type = "touchclick";
            $.event.dispatch.call(this, e);
        }

        $targetEl.data("touchclick-disabled", false);
        $targetEl.removeClass(activeClass);
    };

    $.event.special.touchclick = {
        setup: function () {
            var $el = $(this);

            if (window.navigator.msPointerEnabled) {
                $el.on("MSPointerDown", touchstart);
                $el.on("MSPointerUp", touchend);
            } else {
                $el.on("touchstart mousedown", touchstart);
                $el.on("touchmove mousemove", touchmove);
                $el.on("touchend mouseup", touchend);
            }
        },

        teardown: function () {
            var $el = $(this);

            if (window.navigator.msPointerEnabled) {
                $el.off("MSPointerDown", touchstart);
                $el.off("MSPointerUp", touchend);
            } else {
                $el.off("touchstart mousedown", touchstart);
                $el.off("touchmove mousemove", touchmove);
                $el.off("touchend mouseup", touchend);
            }
        }
    };
})(jQuery);

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





// Magnific Popup v0.9.5 by Dmitry Semenov
// http://bit.ly/magnific-popup#build=inline+image+ajax+iframe+gallery+retina+imagezoom+fastclick
(function(a){var b="Close",c="BeforeClose",d="AfterClose",e="BeforeAppend",f="MarkupParse",g="Open",h="Change",i="mfp",j="."+i,k="mfp-ready",l="mfp-removing",m="mfp-prevent-close",n,o=function(){},p=!!window.jQuery,q,r=a(window),s,t,u,v,w,x=function(a,b){n.ev.on(i+a+j,b)},y=function(b,c,d,e){var f=document.createElement("div");return f.className="mfp-"+b,d&&(f.innerHTML=d),e?c&&c.appendChild(f):(f=a(f),c&&f.appendTo(c)),f},z=function(b,c){n.ev.triggerHandler(i+b,c),n.st.callbacks&&(b=b.charAt(0).toLowerCase()+b.slice(1),n.st.callbacks[b]&&n.st.callbacks[b].apply(n,a.isArray(c)?c:[c]))},A=function(){(n.st.focus?n.content.find(n.st.focus).eq(0):n.wrap).focus()},B=function(b){if(b!==w||!n.currTemplate.closeBtn)n.currTemplate.closeBtn=a(n.st.closeMarkup.replace("%title%",n.st.tClose)),w=b;return n.currTemplate.closeBtn},C=function(){a.magnificPopup.instance||(n=new o,n.init(),a.magnificPopup.instance=n)},D=function(b){if(a(b).hasClass(m))return;var c=n.st.closeOnContentClick,d=n.st.closeOnBgClick;if(c&&d)return!0;if(!n.content||a(b).hasClass("mfp-close")||n.preloader&&b===n.preloader[0])return!0;if(b!==n.content[0]&&!a.contains(n.content[0],b)){if(d&&a.contains(document,b))return!0}else if(c)return!0;return!1},E=function(){var a=document.createElement("p").style,b=["ms","O","Moz","Webkit"];if(a.transition!==undefined)return!0;while(b.length)if(b.pop()+"Transition"in a)return!0;return!1};o.prototype={constructor:o,init:function(){var b=navigator.appVersion;n.isIE7=b.indexOf("MSIE 7.")!==-1,n.isIE8=b.indexOf("MSIE 8.")!==-1,n.isLowIE=n.isIE7||n.isIE8,n.isAndroid=/android/gi.test(b),n.isIOS=/iphone|ipad|ipod/gi.test(b),n.supportsTransition=E(),n.probablyMobile=n.isAndroid||n.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),s=a(document.body),t=a(document),n.popupsCache={}},open:function(b){var c;if(b.isObj===!1){n.items=b.items.toArray(),n.index=0;var d=b.items,e;for(c=0;c<d.length;c++){e=d[c],e.parsed&&(e=e.el[0]);if(e===b.el[0]){n.index=c;break}}}else n.items=a.isArray(b.items)?b.items:[b.items],n.index=b.index||0;if(n.isOpen){n.updateItemHTML();return}n.types=[],v="",b.mainEl&&b.mainEl.length?n.ev=b.mainEl.eq(0):n.ev=t,b.key?(n.popupsCache[b.key]||(n.popupsCache[b.key]={}),n.currTemplate=n.popupsCache[b.key]):n.currTemplate={},n.st=a.extend(!0,{},a.magnificPopup.defaults,b),n.fixedContentPos=n.st.fixedContentPos==="auto"?!n.probablyMobile:n.st.fixedContentPos,n.st.modal&&(n.st.closeOnContentClick=!1,n.st.closeOnBgClick=!1,n.st.showCloseBtn=!1,n.st.enableEscapeKey=!1),n.bgOverlay||(n.bgOverlay=y("bg").on("click"+j,function(){n.close()}),n.wrap=y("wrap").attr("tabindex",-1).on("click"+j,function(a){D(a.target)&&n.close()}),n.container=y("container",n.wrap)),n.contentContainer=y("content"),n.st.preloader&&(n.preloader=y("preloader",n.container,n.st.tLoading));var h=a.magnificPopup.modules;for(c=0;c<h.length;c++){var i=h[c];i=i.charAt(0).toUpperCase()+i.slice(1),n["init"+i].call(n)}z("BeforeOpen"),n.st.showCloseBtn&&(n.st.closeBtnInside?(x(f,function(a,b,c,d){c.close_replaceWith=B(d.type)}),v+=" mfp-close-btn-in"):n.wrap.append(B())),n.st.alignTop&&(v+=" mfp-align-top"),n.fixedContentPos?n.wrap.css({overflow:n.st.overflowY,overflowX:"hidden",overflowY:n.st.overflowY}):n.wrap.css({top:r.scrollTop(),position:"absolute"}),(n.st.fixedBgPos===!1||n.st.fixedBgPos==="auto"&&!n.fixedContentPos)&&n.bgOverlay.css({height:t.height(),position:"absolute"}),n.st.enableEscapeKey&&t.on("keyup"+j,function(a){a.keyCode===27&&n.close()}),r.on("resize"+j,function(){n.updateSize()}),n.st.closeOnContentClick||(v+=" mfp-auto-cursor"),v&&n.wrap.addClass(v);var l=n.wH=r.height(),m={};if(n.fixedContentPos&&n._hasScrollBar(l)){var o=n._getScrollbarSize();o&&(m.paddingRight=o)}n.fixedContentPos&&(n.isIE7?a("body, html").css("overflow","hidden"):m.overflow="hidden");var p=n.st.mainClass;n.isIE7&&(p+=" mfp-ie7"),p&&n._addClassToMFP(p),n.updateItemHTML(),z("BuildControls"),a("html").css(m),n.bgOverlay.add(n.wrap).prependTo(document.body),n._lastFocusedEl=document.activeElement,setTimeout(function(){n.content?(n._addClassToMFP(k),A()):n.bgOverlay.addClass(k),t.on("focusin"+j,function(b){if(b.target!==n.wrap[0]&&!a.contains(n.wrap[0],b.target))return A(),!1})},16),n.isOpen=!0,n.updateSize(l),z(g)},close:function(){if(!n.isOpen)return;z(c),n.isOpen=!1,n.st.removalDelay&&!n.isLowIE&&n.supportsTransition?(n._addClassToMFP(l),setTimeout(function(){n._close()},n.st.removalDelay)):n._close()},_close:function(){z(b);var c=l+" "+k+" ";n.bgOverlay.detach(),n.wrap.detach(),n.container.empty(),n.st.mainClass&&(c+=n.st.mainClass+" "),n._removeClassFromMFP(c);if(n.fixedContentPos){var e={paddingRight:""};n.isIE7?a("body, html").css("overflow",""):e.overflow="",a("html").css(e)}t.off("keyup"+j+" focusin"+j),n.ev.off(j),n.wrap.attr("class","mfp-wrap").removeAttr("style"),n.bgOverlay.attr("class","mfp-bg"),n.container.attr("class","mfp-container"),n.st.showCloseBtn&&(!n.st.closeBtnInside||n.currTemplate[n.currItem.type]===!0)&&n.currTemplate.closeBtn&&n.currTemplate.closeBtn.detach(),n._lastFocusedEl&&a(n._lastFocusedEl).focus(),n.currItem=null,n.content=null,n.currTemplate=null,n.prevHeight=0,z(d)},updateSize:function(a){if(n.isIOS){var b=document.documentElement.clientWidth/window.innerWidth,c=window.innerHeight*b;n.wrap.css("height",c),n.wH=c}else n.wH=a||r.height();n.fixedContentPos||n.wrap.css("height",n.wH),z("Resize")},updateItemHTML:function(){var b=n.items[n.index];n.contentContainer.detach(),n.content&&n.content.detach(),b.parsed||(b=n.parseEl(n.index));var c=b.type;z("BeforeChange",[n.currItem?n.currItem.type:"",c]),n.currItem=b;if(!n.currTemplate[c]){var d=n.st[c]?n.st[c].markup:!1;z("FirstMarkupParse",d),d?n.currTemplate[c]=a(d):n.currTemplate[c]=!0}u&&u!==b.type&&n.container.removeClass("mfp-"+u+"-holder");var e=n["get"+c.charAt(0).toUpperCase()+c.slice(1)](b,n.currTemplate[c]);n.appendContent(e,c),b.preloaded=!0,z(h,b),u=b.type,n.container.prepend(n.contentContainer),z("AfterChange")},appendContent:function(a,b){n.content=a,a?n.st.showCloseBtn&&n.st.closeBtnInside&&n.currTemplate[b]===!0?n.content.find(".mfp-close").length||n.content.append(B()):n.content=a:n.content="",z(e),n.container.addClass("mfp-"+b+"-holder"),n.contentContainer.append(n.content)},parseEl:function(b){var c=n.items[b],d=c.type;c.tagName?c={el:a(c)}:c={data:c,src:c.src};if(c.el){var e=n.types;for(var f=0;f<e.length;f++)if(c.el.hasClass("mfp-"+e[f])){d=e[f];break}c.src=c.el.attr("data-mfp-src"),c.src||(c.src=c.el.attr("href"))}return c.type=d||n.st.type||"inline",c.index=b,c.parsed=!0,n.items[b]=c,z("ElementParse",c),n.items[b]},addGroup:function(a,b){var c=function(c){c.mfpEl=this,n._openClick(c,a,b)};b||(b={});var d="click.magnificPopup";b.mainEl=a,b.items?(b.isObj=!0,a.off(d).on(d,c)):(b.isObj=!1,b.delegate?a.off(d).on(d,b.delegate,c):(b.items=a,a.off(d).on(d,c)))},_openClick:function(b,c,d){var e=d.midClick!==undefined?d.midClick:a.magnificPopup.defaults.midClick;if(!e&&(b.which===2||b.ctrlKey||b.metaKey))return;var f=d.disableOn!==undefined?d.disableOn:a.magnificPopup.defaults.disableOn;if(f)if(a.isFunction(f)){if(!f.call(n))return!0}else if(r.width()<f)return!0;b.type&&(b.preventDefault(),n.isOpen&&b.stopPropagation()),d.el=a(b.mfpEl),d.delegate&&(d.items=c.find(d.delegate)),n.open(d)},updateStatus:function(a,b){if(n.preloader){q!==a&&n.container.removeClass("mfp-s-"+q),!b&&a==="loading"&&(b=n.st.tLoading);var c={status:a,text:b};z("UpdateStatus",c),a=c.status,b=c.text,n.preloader.html(b),n.preloader.find("a").on("click",function(a){a.stopImmediatePropagation()}),n.container.addClass("mfp-s-"+a),q=a}},_addClassToMFP:function(a){n.bgOverlay.addClass(a),n.wrap.addClass(a)},_removeClassFromMFP:function(a){this.bgOverlay.removeClass(a),n.wrap.removeClass(a)},_hasScrollBar:function(a){return(n.isIE7?t.height():document.body.scrollHeight)>(a||r.height())},_parseMarkup:function(b,c,d){var e;d.data&&(c=a.extend(d.data,c)),z(f,[b,c,d]),a.each(c,function(a,c){if(c===undefined||c===!1)return!0;e=a.split("_");if(e.length>1){var d=b.find(j+"-"+e[0]);if(d.length>0){var f=e[1];f==="replaceWith"?d[0]!==c[0]&&d.replaceWith(c):f==="img"?d.is("img")?d.attr("src",c):d.replaceWith('<img src="'+c+'" class="'+d.attr("class")+'" />'):d.attr(e[1],c)}}else b.find(j+"-"+a).html(c)})},_getScrollbarSize:function(){if(n.scrollbarSize===undefined){var a=document.createElement("div");a.id="mfp-sbm",a.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(a),n.scrollbarSize=a.offsetWidth-a.clientWidth,document.body.removeChild(a)}return n.scrollbarSize}},a.magnificPopup={instance:null,proto:o.prototype,modules:[],open:function(a,b){return C(),a||(a={}),a.isObj=!0,a.index=b||0,this.instance.open(a)},close:function(){return a.magnificPopup.instance.close()},registerModule:function(b,c){c.options&&(a.magnificPopup.defaults[b]=c.options),a.extend(this.proto,c.proto),this.modules.push(b)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},a.fn.magnificPopup=function(b){C();var c=a(this);if(typeof b=="string")if(b==="open"){var d,e=p?c.data("magnificPopup"):c[0].magnificPopup,f=parseInt(arguments[1],10)||0;e.items?d=e.items[f]:(d=c,e.delegate&&(d=d.find(e.delegate)),d=d.eq(f)),n._openClick({mfpEl:d},c,e)}else n.isOpen&&n[b].apply(n,Array.prototype.slice.call(arguments,1));else p?c.data("magnificPopup",b):c[0].magnificPopup=b,n.addGroup(c,b);return c};var F="inline",G,H,I,J=function(){I&&(H.after(I.addClass(G)).detach(),I=null)};a.magnificPopup.registerModule(F,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){n.types.push(F),x(b+"."+F,function(){J()})},getInline:function(b,c){J();if(b.src){var d=n.st.inline,e=a(b.src);if(e.length){var f=e[0].parentNode;f&&f.tagName&&(H||(G=d.hiddenClass,H=y(G),G="mfp-"+G),I=e.after(H).detach().removeClass(G)),n.updateStatus("ready")}else n.updateStatus("error",d.tNotFound),e=a("<div>");return b.inlineElement=e,e}return n.updateStatus("ready"),n._parseMarkup(c,{},b),c}}});var K="ajax",L,M=function(){L&&s.removeClass(L)};a.magnificPopup.registerModule(K,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){n.types.push(K),L=n.st.ajax.cursor,x(b+"."+K,function(){M(),n.req&&n.req.abort()})},getAjax:function(b){L&&s.addClass(L),n.updateStatus("loading");var c=a.extend({url:b.src,success:function(c,d,e){var f={data:c,xhr:e};z("ParseAjax",f),n.appendContent(a(f.data),K),b.finished=!0,M(),A(),setTimeout(function(){n.wrap.addClass(k)},16),n.updateStatus("ready"),z("AjaxContentAdded")},error:function(){M(),b.finished=b.loadError=!0,n.updateStatus("error",n.st.ajax.tError.replace("%url%",b.src))}},n.st.ajax.settings);return n.req=a.ajax(c),""}}});var N,O=function(b){if(b.data&&b.data.title!==undefined)return b.data.title;var c=n.st.image.titleSrc;if(c){if(a.isFunction(c))return c.call(n,b);if(b.el)return b.el.attr(c)||""}return""};a.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var a=n.st.image,c=".image";n.types.push("image"),x(g+c,function(){n.currItem.type==="image"&&a.cursor&&s.addClass(a.cursor)}),x(b+c,function(){a.cursor&&s.removeClass(a.cursor),r.off("resize"+j)}),x("Resize"+c,n.resizeImage),n.isLowIE&&x("AfterChange",n.resizeImage)},resizeImage:function(){var a=n.currItem;if(!a||!a.img)return;if(n.st.image.verticalFit){var b=0;n.isLowIE&&(b=parseInt(a.img.css("padding-top"),10)+parseInt(a.img.css("padding-bottom"),10)),a.img.css("max-height",n.wH-b)}},_onImageHasSize:function(a){a.img&&(a.hasSize=!0,N&&clearInterval(N),a.isCheckingImgSize=!1,z("ImageHasSize",a),a.imgHidden&&(n.content&&n.content.removeClass("mfp-loading"),a.imgHidden=!1))},findImageSize:function(a){var b=0,c=a.img[0],d=function(e){N&&clearInterval(N),N=setInterval(function(){if(c.naturalWidth>0){n._onImageHasSize(a);return}b>200&&clearInterval(N),b++,b===3?d(10):b===40?d(50):b===100&&d(500)},e)};d(1)},getImage:function(b,c){var d=0,e=function(){b&&(b.img[0].complete?(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("ready")),b.hasSize=!0,b.loaded=!0,z("ImageLoadComplete")):(d++,d<200?setTimeout(e,100):f()))},f=function(){b&&(b.img.off(".mfploader"),b===n.currItem&&(n._onImageHasSize(b),n.updateStatus("error",g.tError.replace("%url%",b.src))),b.hasSize=!0,b.loaded=!0,b.loadError=!0)},g=n.st.image,h=c.find(".mfp-img");if(h.length){var i=document.createElement("img");i.className="mfp-img",b.img=a(i).on("load.mfploader",e).on("error.mfploader",f),i.src=b.src,h.is("img")&&(b.img=b.img.clone()),b.img[0].naturalWidth>0&&(b.hasSize=!0)}return n._parseMarkup(c,{title:O(b),img_replaceWith:b.img},b),n.resizeImage(),b.hasSize?(N&&clearInterval(N),b.loadError?(c.addClass("mfp-loading"),n.updateStatus("error",g.tError.replace("%url%",b.src))):(c.removeClass("mfp-loading"),n.updateStatus("ready")),c):(n.updateStatus("loading"),b.loading=!0,b.hasSize||(b.imgHidden=!0,c.addClass("mfp-loading"),n.findImageSize(b)),c)}}});var P,Q=function(){return P===undefined&&(P=document.createElement("p").style.MozTransform!==undefined),P};a.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(a){return a.is("img")?a:a.find("img")}},proto:{initZoom:function(){var a=n.st.zoom,d=".zoom";if(!a.enabled||!n.supportsTransition)return;var e=a.duration,f=function(b){var c=b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),d="all "+a.duration/1e3+"s "+a.easing,e={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},f="transition";return e["-webkit-"+f]=e["-moz-"+f]=e["-o-"+f]=e[f]=d,c.css(e),c},g=function(){n.content.css("visibility","visible")},h,i;x("BuildControls"+d,function(){if(n._allowZoom()){clearTimeout(h),n.content.css("visibility","hidden"),image=n._getItemToZoom();if(!image){g();return}i=f(image),i.css(n._getOffset()),n.wrap.append(i),h=setTimeout(function(){i.css(n._getOffset(!0)),h=setTimeout(function(){g(),setTimeout(function(){i.remove(),image=i=null,z("ZoomAnimationEnded")},16)},e)},16)}}),x(c+d,function(){if(n._allowZoom()){clearTimeout(h),n.st.removalDelay=e;if(!image){image=n._getItemToZoom();if(!image)return;i=f(image)}i.css(n._getOffset(!0)),n.wrap.append(i),n.content.css("visibility","hidden"),setTimeout(function(){i.css(n._getOffset())},16)}}),x(b+d,function(){n._allowZoom()&&(g(),i&&i.remove())})},_allowZoom:function(){return n.currItem.type==="image"},_getItemToZoom:function(){return n.currItem.hasSize?n.currItem.img:!1},_getOffset:function(b){var c;b?c=n.currItem.img:c=n.st.zoom.opener(n.currItem.el||n.currItem);var d=c.offset(),e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10);d.top-=a(window).scrollTop()-e;var g={width:c.width(),height:(p?c.innerHeight():c[0].offsetHeight)-f-e};return Q()?g["-moz-transform"]=g.transform="translate("+d.left+"px,"+d.top+"px)":(g.left=d.left,g.top=d.top),g}}});var R="iframe",S="//about:blank",T=function(a){if(n.currTemplate[R]){var b=n.currTemplate[R].find("iframe");b.length&&(a||(b[0].src=S),n.isIE8&&b.css("display",a?"block":"none"))}};a.magnificPopup.registerModule(R,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){n.types.push(R),x("BeforeChange",function(a,b,c){b!==c&&(b===R?T():c===R&&T(!0))}),x(b+"."+R,function(){T()})},getIframe:function(b,c){var d=b.src,e=n.st.iframe;a.each(e.patterns,function(){if(d.indexOf(this.index)>-1)return this.id&&(typeof this.id=="string"?d=d.substr(d.lastIndexOf(this.id)+this.id.length,d.length):d=this.id.call(this,d)),d=this.src.replace("%id%",d),!1});var f={};return e.srcAction&&(f[e.srcAction]=d),n._parseMarkup(c,f,b),n.updateStatus("ready"),c}}});var U=function(a){var b=n.items.length;return a>b-1?a-b:a<0?b+a:a},V=function(a,b,c){return a.replace("%curr%",b+1).replace("%total%",c)};a.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var c=n.st.gallery,d=".mfp-gallery",e=Boolean(a.fn.mfpFastClick);n.direction=!0;if(!c||!c.enabled)return!1;v+=" mfp-gallery",x(g+d,function(){c.navigateByImgClick&&n.wrap.on("click"+d,".mfp-img",function(){if(n.items.length>1)return n.next(),!1}),t.on("keydown"+d,function(a){a.keyCode===37?n.prev():a.keyCode===39&&n.next()})}),x("UpdateStatus"+d,function(a,b){b.text&&(b.text=V(b.text,n.currItem.index,n.items.length))}),x(f+d,function(a,b,d,e){var f=n.items.length;d.counter=f>1?V(c.tCounter,e.index,f):""}),x("BuildControls"+d,function(){if(n.items.length>1&&c.arrows&&!n.arrowLeft){var b=c.arrowMarkup,d=n.arrowLeft=a(b.replace("%title%",c.tPrev).replace("%dir%","left")).addClass(m),f=n.arrowRight=a(b.replace("%title%",c.tNext).replace("%dir%","right")).addClass(m),g=e?"mfpFastClick":"click";d[g](function(){n.prev()}),f[g](function(){n.next()}),n.isIE7&&(y("b",d[0],!1,!0),y("a",d[0],!1,!0),y("b",f[0],!1,!0),y("a",f[0],!1,!0)),n.container.append(d.add(f))}}),x(h+d,function(){n._preloadTimeout&&clearTimeout(n._preloadTimeout),n._preloadTimeout=setTimeout(function(){n.preloadNearbyImages(),n._preloadTimeout=null},16)}),x(b+d,function(){t.off(d),n.wrap.off("click"+d),n.arrowLeft&&e&&n.arrowLeft.add(n.arrowRight).destroyMfpFastClick(),n.arrowRight=n.arrowLeft=null})},next:function(){n.direction=!0,n.index=U(n.index+1),n.updateItemHTML()},prev:function(){n.direction=!1,n.index=U(n.index-1),n.updateItemHTML()},goTo:function(a){n.direction=a>=n.index,n.index=a,n.updateItemHTML()},preloadNearbyImages:function(){var a=n.st.gallery.preload,b=Math.min(a[0],n.items.length),c=Math.min(a[1],n.items.length),d;for(d=1;d<=(n.direction?c:b);d++)n._preloadItem(n.index+d);for(d=1;d<=(n.direction?b:c);d++)n._preloadItem(n.index-d)},_preloadItem:function(b){b=U(b);if(n.items[b].preloaded)return;var c=n.items[b];c.parsed||(c=n.parseEl(b)),z("LazyLoad",c),c.type==="image"&&(c.img=a('<img class="mfp-img" />').on("load.mfploader",function(){c.hasSize=!0}).on("error.mfploader",function(){c.hasSize=!0,c.loadError=!0,z("LazyLoadError",c)}).attr("src",c.src)),c.preloaded=!0}}});var W="retina";a.magnificPopup.registerModule(W,{options:{replaceSrc:function(a){return a.src.replace(/\.\w+$/,function(a){return"@2x"+a})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var a=n.st.retina,b=a.ratio;b=isNaN(b)?b():b,b>1&&(x("ImageHasSize."+W,function(a,c){c.img.css({"max-width":c.img[0].naturalWidth/b,width:"100%"})}),x("ElementParse."+W,function(c,d){d.src=a.replaceSrc(d,b)}))}}}}),function(){var b=1e3,c="ontouchstart"in window,d=function(){r.off("touchmove"+f+" touchend"+f)},e="mfpFastClick",f="."+e;a.fn.mfpFastClick=function(e){return a(this).each(function(){var g=a(this),h;if(c){var i,j,k,l,m,n;g.on("touchstart"+f,function(a){l=!1,n=1,m=a.originalEvent?a.originalEvent.touches[0]:a.touches[0],j=m.clientX,k=m.clientY,r.on("touchmove"+f,function(a){m=a.originalEvent?a.originalEvent.touches:a.touches,n=m.length,m=m[0];if(Math.abs(m.clientX-j)>10||Math.abs(m.clientY-k)>10)l=!0,d()}).on("touchend"+f,function(a){d();if(l||n>1)return;h=!0,a.preventDefault(),clearTimeout(i),i=setTimeout(function(){h=!1},b),e()})})}g.on("click"+f,function(){h||e()})})},a.fn.destroyMfpFastClick=function(){a(this).off("touchstart"+f+" click"+f),c&&r.off("touchmove"+f+" touchend"+f)}}()})(window.jQuery||window.Zepto);



// Generated by CoffeeScript 1.6.2
/*
 * Salvattore by @rnmp and @ppold
 * http://github.com/bandd/salvattore
*/
(function() {
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
      console.log('settings', numberOfColumns, columnClasses);
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
        if (rule.selectorText.match(/\[data-columns\](.*)::?before$/)) {
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

}).call(this);




/*!
 *  GMAP3 Plugin for JQuery
 *  Version   : 5.1.1
 *  Date      : 2013-05-25
 *  Licence   : GPL v3 : http://www.gnu.org/licenses/gpl.html
 *  Author    : DEMONTE Jean-Baptiste
 *  Contact   : jbdemonte@gmail.com
 *  Web site  : http://gmap3.net
 */
(function(y,t){var z,i=0;function J(){if(!z){z={verbose:false,queryLimit:{attempt:5,delay:250,random:250},classes:{Map:google.maps.Map,Marker:google.maps.Marker,InfoWindow:google.maps.InfoWindow,Circle:google.maps.Circle,Rectangle:google.maps.Rectangle,OverlayView:google.maps.OverlayView,StreetViewPanorama:google.maps.StreetViewPanorama,KmlLayer:google.maps.KmlLayer,TrafficLayer:google.maps.TrafficLayer,BicyclingLayer:google.maps.BicyclingLayer,GroundOverlay:google.maps.GroundOverlay,StyledMapType:google.maps.StyledMapType,ImageMapType:google.maps.ImageMapType},map:{mapTypeId:google.maps.MapTypeId.ROADMAP,center:[46.578498,2.457275],zoom:2},overlay:{pane:"floatPane",content:"",offset:{x:0,y:0}},geoloc:{getCurrentPosition:{maximumAge:60000,timeout:5000}}}}}function k(M,L){return M!==t?M:"gmap3_"+(L?i+1:++i)}function d(L){var O=function(P){return parseInt(P,10)},N=google.maps.version.split(".").map(O),M;L=L.split(".").map(O);for(M=0;M<L.length;M++){if(N.hasOwnProperty(M)){if(N[M]<L[M]){return false}}else{return false}}return true}function n(P,L,N,Q,O){if(L.todo.events||L.todo.onces){var M={id:Q,data:L.todo.data,tag:L.todo.tag};if(L.todo.events){y.each(L.todo.events,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListener(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}if(L.todo.onces){y.each(L.todo.onces,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListenerOnce(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}}}function l(){var L=[];this.empty=function(){return !L.length};this.add=function(M){L.push(M)};this.get=function(){return L.length?L[0]:false};this.ack=function(){L.shift()}}function w(T,L,N){var R={},P=this,Q,S={latLng:{map:false,marker:false,infowindow:false,circle:false,overlay:false,getlatlng:false,getmaxzoom:false,getelevation:false,streetviewpanorama:false,getaddress:true},geoloc:{getgeoloc:true}};if(typeof N==="string"){N=M(N)}function M(V){var U={};U[V]={};return U}function O(){var U;for(U in N){if(U in R){continue}return U}}this.run=function(){var U,V;while(U=O()){if(typeof T[U]==="function"){Q=U;V=y.extend(true,{},z[U]||{},N[U].options||{});if(U in S.latLng){if(N[U].values){x(N[U].values,T,T[U],{todo:N[U],opts:V,session:R})}else{v(T,T[U],S.latLng[U],{todo:N[U],opts:V,session:R})}}else{if(U in S.geoloc){o(T,T[U],{todo:N[U],opts:V,session:R})}else{T[U].apply(T,[{todo:N[U],opts:V,session:R}])}}return}else{R[U]=null}}L.apply(T,[N,R])};this.ack=function(U){R[Q]=U;P.run.apply(P,[])}}function c(N){var L,M=[];for(L in N){M.push(L)}return M}function b(N,Q){var L={};if(N.todo){for(var M in N.todo){if((M!=="options")&&(M!=="values")){L[M]=N.todo[M]}}}var O,P=["data","tag","id","events","onces"];for(O=0;O<P.length;O++){A(L,P[O],Q,N.todo)}L.options=y.extend({},N.opts||{},Q.options||{});return L}function A(N,M){for(var L=2;L<arguments.length;L++){if(M in arguments[L]){N[M]=arguments[L][M];return}}}function r(){var L=[];this.get=function(S){if(L.length){var P,O,N,R,M,Q=c(S);for(P=0;P<L.length;P++){R=L[P];M=Q.length==R.keys.length;for(O=0;(O<Q.length)&&M;O++){N=Q[O];M=N in R.request;if(M){if((typeof S[N]==="object")&&("equals" in S[N])&&(typeof S[N]==="function")){M=S[N].equals(R.request[N])}else{M=S[N]===R.request[N]}}}if(M){return R.results}}}};this.store=function(N,M){L.push({request:N,keys:c(N),results:M})}}function e(Q,P,O,L){var N=this,M=[];z.classes.OverlayView.call(this);this.setMap(Q);this.onAdd=function(){var R=this.getPanes();if(P.pane in R){y(R[P.pane]).append(L)}y.each("dblclick click mouseover mousemove mouseout mouseup mousedown".split(" "),function(T,S){M.push(google.maps.event.addDomListener(L[0],S,function(U){y.Event(U).stopPropagation();google.maps.event.trigger(N,S,[U]);N.draw()}))});M.push(google.maps.event.addDomListener(L[0],"contextmenu",function(S){y.Event(S).stopPropagation();google.maps.event.trigger(N,"rightclick",[S]);N.draw()}))};this.getPosition=function(){return O};this.draw=function(){var R=this.getProjection().fromLatLngToDivPixel(O);L.css("left",(R.x+P.offset.x)+"px").css("top",(R.y+P.offset.y)+"px")};this.onRemove=function(){for(var R=0;R<M.length;R++){google.maps.event.removeListener(M[R])}L.remove()};this.hide=function(){L.hide()};this.show=function(){L.show()};this.toggle=function(){if(L){if(L.is(":visible")){this.show()}else{this.hide()}}};this.toggleDOM=function(){if(this.getMap()){this.setMap(null)}else{this.setMap(Q)}};this.getDOMElement=function(){return L[0]}}function f(O,L){function M(){this.onAdd=function(){};this.onRemove=function(){};this.draw=function(){};return z.classes.OverlayView.apply(this,[])}M.prototype=z.classes.OverlayView.prototype;var N=new M();N.setMap(O);return N}function F(ae,ao,aa){var an=false,ai=false,af=false,Z=false,W=true,V=this,N=[],T={},ad={},U={},aj=[],ah=[],O=[],ak=f(ao,aa.radius),Y,ap,am,P,Q;S();function L(aq){if(!aj[aq]){delete ah[aq].options.map;aj[aq]=new z.classes.Marker(ah[aq].options);n(ae,{todo:ah[aq]},aj[aq],ah[aq].id)}}this.getById=function(aq){if(aq in ad){L(ad[aq]);return aj[ad[aq]]}return false};this.rm=function(ar){var aq=ad[ar];if(aj[aq]){aj[aq].setMap(null)}delete aj[aq];aj[aq]=false;delete ah[aq];ah[aq]=false;delete O[aq];O[aq]=false;delete ad[ar];delete U[aq];ai=true};this.clearById=function(aq){if(aq in ad){this.rm(aq);return true}};this.clear=function(az,av,aA){var ar,ay,at,aw,au,ax=[],aq=C(aA);if(az){ar=ah.length-1;ay=-1;at=-1}else{ar=0;ay=ah.length;at=1}for(aw=ar;aw!=ay;aw+=at){if(ah[aw]){if(!aq||aq(ah[aw].tag)){ax.push(U[aw]);if(av||az){break}}}}for(au=0;au<ax.length;au++){this.rm(ax[au])}};this.add=function(aq,ar){aq.id=k(aq.id);this.clearById(aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(null);ah.push(aq);O.push(ar);ai=true};this.addMarker=function(ar,aq){aq=aq||{};aq.id=k(aq.id);this.clearById(aq.id);if(!aq.options){aq.options={}}aq.options.position=ar.getPosition();n(ae,{todo:aq},ar,aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(ar);ah.push(aq);O.push(aq.data||{});ai=true};this.todo=function(aq){return ah[aq]};this.value=function(aq){return O[aq]};this.marker=function(aq){if(aq in aj){L(aq);return aj[aq]}return false};this.markerIsSet=function(aq){return Boolean(aj[aq])};this.setMarker=function(ar,aq){aj[ar]=aq};this.store=function(aq,ar,at){T[aq.ref]={obj:ar,shadow:at}};this.free=function(){for(var aq=0;aq<N.length;aq++){google.maps.event.removeListener(N[aq])}N=[];y.each(T,function(ar){ac(ar)});T={};y.each(ah,function(ar){ah[ar]=null});ah=[];y.each(aj,function(ar){if(aj[ar]){aj[ar].setMap(null);delete aj[ar]}});aj=[];y.each(O,function(ar){delete O[ar]});O=[];ad={};U={}};this.filter=function(aq){am=aq;ag()};this.enable=function(aq){if(W!=aq){W=aq;ag()}};this.display=function(aq){P=aq};this.error=function(aq){Q=aq};this.beginUpdate=function(){an=true};this.endUpdate=function(){an=false;if(ai){ag()}};this.autofit=function(ar){for(var aq=0;aq<ah.length;aq++){if(ah[aq]){ar.extend(ah[aq].options.position)}}};function S(){ap=ak.getProjection();if(!ap){setTimeout(function(){S.apply(V,[])},25);return}Z=true;N.push(google.maps.event.addListener(ao,"zoom_changed",function(){al()}));N.push(google.maps.event.addListener(ao,"bounds_changed",function(){al()}));ag()}function ac(aq){if(typeof T[aq]==="object"){if(typeof(T[aq].obj.setMap)==="function"){T[aq].obj.setMap(null)}if(typeof(T[aq].obj.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.setMap)==="function"){T[aq].shadow.setMap(null)}delete T[aq].obj;delete T[aq].shadow}else{if(aj[aq]){aj[aq].setMap(null)}}delete T[aq]}function M(){var ay,ax,aw,au,av,at,ar,aq;if(arguments[0] instanceof google.maps.LatLng){ay=arguments[0].lat();aw=arguments[0].lng();if(arguments[1] instanceof google.maps.LatLng){ax=arguments[1].lat();au=arguments[1].lng()}else{ax=arguments[1];au=arguments[2]}}else{ay=arguments[0];aw=arguments[1];if(arguments[2] instanceof google.maps.LatLng){ax=arguments[2].lat();au=arguments[2].lng()}else{ax=arguments[2];au=arguments[3]}}av=Math.PI*ay/180;at=Math.PI*aw/180;ar=Math.PI*ax/180;aq=Math.PI*au/180;return 1000*6371*Math.acos(Math.min(Math.cos(av)*Math.cos(ar)*Math.cos(at)*Math.cos(aq)+Math.cos(av)*Math.sin(at)*Math.cos(ar)*Math.sin(aq)+Math.sin(av)*Math.sin(ar),1))}function R(){var aq=M(ao.getCenter(),ao.getBounds().getNorthEast()),ar=new google.maps.Circle({center:ao.getCenter(),radius:1.25*aq});return ar.getBounds()}function X(){var ar={},aq;for(aq in T){ar[aq]=true}return ar}function al(){clearTimeout(Y);Y=setTimeout(function(){ag()},25)}function ab(ar){var au=ap.fromLatLngToDivPixel(ar),at=ap.fromDivPixelToLatLng(new google.maps.Point(au.x+aa.radius,au.y-aa.radius)),aq=ap.fromDivPixelToLatLng(new google.maps.Point(au.x-aa.radius,au.y+aa.radius));return new google.maps.LatLngBounds(aq,at)}function ag(){if(an||af||!Z){return}var aE=[],aG={},aF=ao.getZoom(),aH=("maxZoom" in aa)&&(aF>aa.maxZoom),aw=X(),av,au,at,aA,ar=false,aq,aD,ay,az,aB,aC,ax;ai=false;if(aF>3){aq=R();ar=aq.getSouthWest().lng()<aq.getNorthEast().lng()}for(av=0;av<ah.length;av++){if(ah[av]&&(!ar||aq.contains(ah[av].options.position))&&(!am||am(O[av]))){aE.push(av)}}while(1){av=0;while(aG[av]&&(av<aE.length)){av++}if(av==aE.length){break}aA=[];if(W&&!aH){ax=10;do{az=aA;aA=[];ax--;if(az.length){ay=aq.getCenter()}else{ay=ah[aE[av]].options.position}aq=ab(ay);for(au=av;au<aE.length;au++){if(aG[au]){continue}if(aq.contains(ah[aE[au]].options.position)){aA.push(au)}}}while((az.length<aA.length)&&(aA.length>1)&&ax)}else{for(au=av;au<aE.length;au++){if(aG[au]){continue}aA.push(au);break}}aD={indexes:[],ref:[]};aB=aC=0;for(at=0;at<aA.length;at++){aG[aA[at]]=true;aD.indexes.push(aE[aA[at]]);aD.ref.push(aE[aA[at]]);aB+=ah[aE[aA[at]]].options.position.lat();aC+=ah[aE[aA[at]]].options.position.lng()}aB/=aA.length;aC/=aA.length;aD.latLng=new google.maps.LatLng(aB,aC);aD.ref=aD.ref.join("-");if(aD.ref in aw){delete aw[aD.ref]}else{if(aA.length===1){T[aD.ref]=true}P(aD)}}y.each(aw,function(aI){ac(aI)});af=false}}function a(M,L){this.id=function(){return M};this.filter=function(N){L.filter(N)};this.enable=function(){L.enable(true)};this.disable=function(){L.enable(false)};this.add=function(O,N,P){if(!P){L.beginUpdate()}L.addMarker(O,N);if(!P){L.endUpdate()}};this.getById=function(N){return L.getById(N)};this.clearById=function(P,O){var N;if(!O){L.beginUpdate()}N=L.clearById(P);if(!O){L.endUpdate()}return N};this.clear=function(P,Q,N,O){if(!O){L.beginUpdate()}L.clear(P,Q,N);if(!O){L.endUpdate()}}}function D(){var M={},N={};function L(P){return{id:P.id,name:P.name,object:P.obj,tag:P.tag,data:P.data}}this.add=function(R,Q,T,S){var P=R.todo||{},U=k(P.id);if(!M[Q]){M[Q]=[]}if(U in N){this.clearById(U)}N[U]={obj:T,sub:S,name:Q,id:U,tag:P.tag,data:P.data};M[Q].push(U);return U};this.getById=function(R,Q,P){if(R in N){if(Q){return N[R].sub}else{if(P){return L(N[R])}}return N[R].obj}return false};this.get=function(R,T,P,S){var V,U,Q=C(P);if(!M[R]||!M[R].length){return null}V=M[R].length;while(V){V--;U=M[R][T?V:M[R].length-V-1];if(U&&N[U]){if(Q&&!Q(N[U].tag)){continue}return S?L(N[U]):N[U].obj}}return null};this.all=function(S,Q,T){var P=[],R=C(Q),U=function(X){var V,W;for(V=0;V<M[X].length;V++){W=M[X][V];if(W&&N[W]){if(R&&!R(N[W].tag)){continue}P.push(T?L(N[W]):N[W].obj)}}};if(S in M){U(S)}else{if(S===t){for(S in M){U(S)}}}return P};function O(P){if(typeof(P.setMap)==="function"){P.setMap(null)}if(typeof(P.remove)==="function"){P.remove()}if(typeof(P.free)==="function"){P.free()}P=null}this.rm=function(S,Q,R){var P,T;if(!M[S]){return false}if(Q){if(R){for(P=M[S].length-1;P>=0;P--){T=M[S][P];if(Q(N[T].tag)){break}}}else{for(P=0;P<M[S].length;P++){T=M[S][P];if(Q(N[T].tag)){break}}}}else{P=R?M[S].length-1:0}if(!(P in M[S])){return false}return this.clearById(M[S][P],P)};this.clearById=function(S,P){if(S in N){var R,Q=N[S].name;for(R=0;P===t&&R<M[Q].length;R++){if(S===M[Q][R]){P=R}}O(N[S].obj);if(N[S].sub){O(N[S].sub)}delete N[S];M[Q].splice(P,1);return true}return false};this.objGetById=function(R){var Q;if(M.clusterer){for(var P in M.clusterer){if((Q=N[M.clusterer[P]].obj.getById(R))!==false){return Q}}}return false};this.objClearById=function(Q){if(M.clusterer){for(var P in M.clusterer){if(N[M.clusterer[P]].obj.clearById(Q)){return true}}}return null};this.clear=function(V,U,W,P){var R,T,S,Q=C(P);if(!V||!V.length){V=[];for(R in M){V.push(R)}}else{V=g(V)}for(T=0;T<V.length;T++){S=V[T];if(U){this.rm(S,Q,true)}else{if(W){this.rm(S,Q,false)}else{while(this.rm(S,Q,false)){}}}}};this.objClear=function(S,R,T,Q){if(M.clusterer&&(y.inArray("marker",S)>=0||!S.length)){for(var P in M.clusterer){N[M.clusterer[P]].obj.clear(R,T,Q)}}}}var m={},H=new r();function p(){if(!m.geocoder){m.geocoder=new google.maps.Geocoder()}return m.geocoder}function G(){if(!m.directionsService){m.directionsService=new google.maps.DirectionsService()}return m.directionsService}function h(){if(!m.elevationService){m.elevationService=new google.maps.ElevationService()}return m.elevationService}function q(){if(!m.maxZoomService){m.maxZoomService=new google.maps.MaxZoomService()}return m.maxZoomService}function B(){if(!m.distanceMatrixService){m.distanceMatrixService=new google.maps.DistanceMatrixService()}return m.distanceMatrixService}function u(){if(z.verbose){var L,M=[];if(window.console&&(typeof console.error==="function")){for(L=0;L<arguments.length;L++){M.push(arguments[L])}console.error.apply(console,M)}else{M="";for(L=0;L<arguments.length;L++){M+=arguments[L].toString()+" "}alert(M)}}}function E(L){return(typeof(L)==="number"||typeof(L)==="string")&&L!==""&&!isNaN(L)}function g(N){var M,L=[];if(N!==t){if(typeof(N)==="object"){if(typeof(N.length)==="number"){L=N}else{for(M in N){L.push(N[M])}}}else{L.push(N)}}return L}function C(L){if(L){if(typeof L==="function"){return L}L=g(L);return function(N){if(N===t){return false}if(typeof N==="object"){for(var M=0;M<N.length;M++){if(y.inArray(N[M],L)>=0){return true}}return false}return y.inArray(N,L)>=0}}}function I(M,O,L){var N=O?M:null;if(!M||(typeof M==="string")){return N}if(M.latLng){return I(M.latLng)}if(M instanceof google.maps.LatLng){return M}else{if(E(M.lat)){return new google.maps.LatLng(M.lat,M.lng)}else{if(!L&&y.isArray(M)){if(!E(M[0])||!E(M[1])){return N}return new google.maps.LatLng(M[0],M[1])}}}return N}function j(M){var N,L;if(!M||M instanceof google.maps.LatLngBounds){return M||null}if(y.isArray(M)){if(M.length==2){N=I(M[0]);L=I(M[1])}else{if(M.length==4){N=I([M[0],M[1]]);L=I([M[2],M[3]])}}}else{if(("ne" in M)&&("sw" in M)){N=I(M.ne);L=I(M.sw)}else{if(("n" in M)&&("e" in M)&&("s" in M)&&("w" in M)){N=I([M.n,M.e]);L=I([M.s,M.w])}}}if(N&&L){return new google.maps.LatLngBounds(L,N)}return null}function v(T,L,O,S,P){var N=O?I(S.todo,false,true):false,R=N?{latLng:N}:(S.todo.address?(typeof(S.todo.address)==="string"?{address:S.todo.address}:S.todo.address):false),M=R?H.get(R):false,Q=this;if(R){P=P||0;if(M){S.latLng=M.results[0].geometry.location;S.results=M.results;S.status=M.status;L.apply(T,[S])}else{if(R.location){R.location=I(R.location)}if(R.bounds){R.bounds=j(R.bounds)}p().geocode(R,function(V,U){if(U===google.maps.GeocoderStatus.OK){H.store(R,{results:V,status:U});S.latLng=V[0].geometry.location;S.results=V;S.status=U;L.apply(T,[S])}else{if((U===google.maps.GeocoderStatus.OVER_QUERY_LIMIT)&&(P<z.queryLimit.attempt)){setTimeout(function(){v.apply(Q,[T,L,O,S,P+1])},z.queryLimit.delay+Math.floor(Math.random()*z.queryLimit.random))}else{u("geocode failed",U,R);S.latLng=S.results=false;S.status=U;L.apply(T,[S])}}})}}else{S.latLng=I(S.todo,false,true);L.apply(T,[S])}}function x(Q,L,R,M){var O=this,N=-1;function P(){do{N++}while((N<Q.length)&&!("address" in Q[N]));if(N>=Q.length){R.apply(L,[M]);return}v(O,function(S){delete S.todo;y.extend(Q[N],S);P.apply(O,[])},true,{todo:Q[N]})}P()}function o(L,O,M){var N=false;if(navigator&&navigator.geolocation){navigator.geolocation.getCurrentPosition(function(P){if(N){return}N=true;M.latLng=new google.maps.LatLng(P.coords.latitude,P.coords.longitude);O.apply(L,[M])},function(){if(N){return}N=true;M.latLng=false;O.apply(L,[M])},M.opts.getCurrentPosition)}else{M.latLng=false;O.apply(L,[M])}}function K(T){var S=this,U=new l(),V=new D(),N=null,P;this._plan=function(Z){for(var Y=0;Y<Z.length;Y++){U.add(new w(S,R,Z[Y]))}Q()};function Q(){if(!P&&(P=U.get())){P.run()}}function R(){P=null;U.ack();Q.call(S)}function X(Y){if(Y.todo.callback){var Z=Array.prototype.slice.call(arguments,1);if(typeof Y.todo.callback==="function"){Y.todo.callback.apply(T,Z)}else{if(y.isArray(Y.todo.callback)){if(typeof Y.todo.callback[1]==="function"){Y.todo.callback[1].apply(Y.todo.callback[0],Z)}}}}}function O(Y,Z,aa){if(aa){n(T,Y,Z,aa)}X(Y,Z);P.ack(Z)}function L(aa,Y){Y=Y||{};if(N){if(Y.todo&&Y.todo.options){if(Y.todo.options.center){Y.todo.options.center=I(Y.todo.options.center)}N.setOptions(Y.todo.options)}}else{var Z=Y.opts||y.extend(true,{},z.map,Y.todo&&Y.todo.options?Y.todo.options:{});Z.center=aa||I(Z.center);N=new z.classes.Map(T.get(0),Z)}}this.map=function(Y){L(Y.latLng,Y);n(T,Y,N);O(Y,N)};this.destroy=function(Y){V.clear();T.empty();if(N){N=null}O(Y,true)};this.infowindow=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){if(Z.latLng){Z.opts.position=Z.latLng}Z.todo.values=[{options:Z.opts}]}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.position=ab.options.position?I(ab.options.position):I(ad.latLng);if(!N){L(ab.options.position)}ae=new z.classes.InfoWindow(ab.options);if(ae&&((ab.open===t)||ab.open)){if(Y){ae.open(N,ab.anchor?ab.anchor:t)}else{ae.open(N,ab.anchor?ab.anchor:(Z.latLng?t:(Z.session.marker?Z.session.marker:t)))}}aa.push(ae);af=V.add({todo:ab},"infowindow",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.circle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.opts.center=Z.latLng||I(Z.opts.center);Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.center=ab.options.center?I(ab.options.center):I(ad);if(!N){L(ab.options.center)}ab.options.map=N;ae=new z.classes.Circle(ab.options);aa.push(ae);af=V.add({todo:ab},"circle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.overlay=function(aa,Z){var ab=[],Y="values" in aa.todo;if(!Y){aa.todo.values=[{latLng:aa.latLng,options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(!e.__initialised){e.prototype=new z.classes.OverlayView();e.__initialised=true}y.each(aa.todo.values,function(ae,af){var ah,ag,ac=b(aa,af),ad=y(document.createElement("div")).css({border:"none",borderWidth:"0px",position:"absolute"});ad.append(ac.options.content);ag=new e(N,ac.options,I(ac)||I(af),ad);ab.push(ag);ad=null;if(!Z){ah=V.add(aa,"overlay",ag);n(T,{todo:ac},ag,ah)}});if(Z){return ab[0]}O(aa,Y?ab:ab[0])};this.getaddress=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getlatlng=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getmaxzoom=function(Y){q().getMaxZoomAtLatLng(Y.latLng,function(Z){X(Y,Z.status===google.maps.MaxZoomStatus.OK?Z.zoom:false,status);P.ack()})};this.getelevation=function(Z){var aa,Y=[],ab=function(ad,ac){X(Z,ac===google.maps.ElevationStatus.OK?ad:false,ac);P.ack()};if(Z.latLng){Y.push(Z.latLng)}else{Y=g(Z.todo.locations||[]);for(aa=0;aa<Y.length;aa++){Y[aa]=I(Y[aa])}}if(Y.length){h().getElevationForLocations({locations:Y},ab)}else{if(Z.todo.path&&Z.todo.path.length){for(aa=0;aa<Z.todo.path.length;aa++){Y.push(I(Z.todo.path[aa]))}}if(Y.length){h().getElevationAlongPath({path:Y,samples:Z.todo.samples},ab)}else{P.ack()}}};this.defaults=function(Y){y.each(Y.todo,function(Z,aa){if(typeof z[Z]==="object"){z[Z]=y.extend({},z[Z],aa)}else{z[Z]=aa}});P.ack(true)};this.rectangle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.bounds=ab.options.bounds?j(ab.options.bounds):j(ad);if(!N){L(ab.options.bounds.getCenter())}ab.options.map=N;ae=new z.classes.Rectangle(ab.options);aa.push(ae);af=V.add({todo:ab},"rectangle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};function M(Z,aa,ab){var ac=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}L();y.each(Z.todo.values,function(af,ah){var aj,ag,ae,ai,ad=b(Z,ah);if(ad.options[ab]){if(ad.options[ab][0][0]&&y.isArray(ad.options[ab][0][0])){for(ag=0;ag<ad.options[ab].length;ag++){for(ae=0;ae<ad.options[ab][ag].length;ae++){ad.options[ab][ag][ae]=I(ad.options[ab][ag][ae])}}}else{for(ag=0;ag<ad.options[ab].length;ag++){ad.options[ab][ag]=I(ad.options[ab][ag])}}}ad.options.map=N;ai=new google.maps[aa](ad.options);ac.push(ai);aj=V.add({todo:ad},aa.toLowerCase(),ai);n(T,{todo:ad},ai,aj)});O(Z,Y?ac:ac[0])}this.polyline=function(Y){M(Y,"Polyline","path")};this.polygon=function(Y){M(Y,"Polygon","paths")};this.trafficlayer=function(Y){L();var Z=V.get("trafficlayer");if(!Z){Z=new z.classes.TrafficLayer();Z.setMap(N);V.add(Y,"trafficlayer",Z)}O(Y,Z)};this.bicyclinglayer=function(Y){L();var Z=V.get("bicyclinglayer");if(!Z){Z=new z.classes.BicyclingLayer();Z.setMap(N);V.add(Y,"bicyclinglayer",Z)}O(Y,Z)};this.groundoverlay=function(Y){Y.opts.bounds=j(Y.opts.bounds);if(Y.opts.bounds){L(Y.opts.bounds.getCenter())}var aa,Z=new z.classes.GroundOverlay(Y.opts.url,Y.opts.bounds,Y.opts.opts);Z.setMap(N);aa=V.add(Y,"groundoverlay",Z);O(Y,Z,aa)};this.streetviewpanorama=function(Y){if(!Y.opts.opts){Y.opts.opts={}}if(Y.latLng){Y.opts.opts.position=Y.latLng}else{if(Y.opts.opts.position){Y.opts.opts.position=I(Y.opts.opts.position)}}if(Y.todo.divId){Y.opts.container=document.getElementById(Y.todo.divId)}else{if(Y.opts.container){Y.opts.container=y(Y.opts.container).get(0)}}var aa,Z=new z.classes.StreetViewPanorama(Y.opts.container,Y.opts.opts);if(Z){N.setStreetView(Z)}aa=V.add(Y,"streetviewpanorama",Z);O(Y,Z,aa)};this.kmllayer=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ad,ae){var ag,af,ac,ab=b(Z,ae);if(!N){L()}ac=ab.options;if(ab.options.opts){ac=ab.options.opts;if(ab.options.url){ac.url=ab.options.url}}ac.map=N;if(d("3.10")){af=new z.classes.KmlLayer(ac)}else{af=new z.classes.KmlLayer(ac.url,ac)}aa.push(af);ag=V.add({todo:ab},"kmllayer",af);n(T,{todo:ab},af,ag)});O(Z,Y?aa:aa[0])};this.panel=function(ab){L();var ad,Y=0,ac=0,aa,Z=y(document.createElement("div"));Z.css({position:"absolute",zIndex:1000,visibility:"hidden"});if(ab.opts.content){aa=y(ab.opts.content);Z.append(aa);T.first().prepend(Z);if(ab.opts.left!==t){Y=ab.opts.left}else{if(ab.opts.right!==t){Y=T.width()-aa.width()-ab.opts.right}else{if(ab.opts.center){Y=(T.width()-aa.width())/2}}}if(ab.opts.top!==t){ac=ab.opts.top}else{if(ab.opts.bottom!==t){ac=T.height()-aa.height()-ab.opts.bottom}else{if(ab.opts.middle){ac=(T.height()-aa.height())/2}}}Z.css({top:ac,left:Y,visibility:"visible"})}ad=V.add(ab,"panel",Z);O(ab,Z,ad);Z=null};function W(aa){var af=new F(T,N,aa),Y={},ab={},ae=[],ad=/^[0-9]+$/,ac,Z;for(Z in aa){if(ad.test(Z)){ae.push(1*Z);ab[Z]=aa[Z];ab[Z].width=ab[Z].width||0;ab[Z].height=ab[Z].height||0}else{Y[Z]=aa[Z]}}ae.sort(function(ah,ag){return ah>ag});if(Y.calculator){ac=function(ag){var ah=[];y.each(ag,function(aj,ai){ah.push(af.value(ai))});return Y.calculator.apply(T,[ah])}}else{ac=function(ag){return ag.length}}af.error(function(){u.apply(S,arguments)});af.display(function(ag){var ai,aj,am,ak,al,ah=ac(ag.indexes);if(aa.force||ah>1){for(ai=0;ai<ae.length;ai++){if(ae[ai]<=ah){aj=ab[ae[ai]]}}}if(aj){al=aj.offset||[-aj.width/2,-aj.height/2];am=y.extend({},Y);am.options=y.extend({pane:"overlayLayer",content:aj.content?aj.content.replace("CLUSTER_COUNT",ah):"",offset:{x:("x" in al?al.x:al[0])||0,y:("y" in al?al.y:al[1])||0}},Y.options||{});ak=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);am.options.pane="floatShadow";am.options.content=y(document.createElement("div")).width(aj.width+"px").height(aj.height+"px").css({cursor:"pointer"});shadow=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);Y.data={latLng:I(ag),markers:[]};y.each(ag.indexes,function(ao,an){Y.data.markers.push(af.value(an));if(af.markerIsSet(an)){af.marker(an).setMap(null)}});n(T,{todo:Y},shadow,t,{main:ak,shadow:shadow});af.store(ag,ak,shadow)}else{y.each(ag.indexes,function(ao,an){af.marker(an).setMap(N)})}});return af}this.marker=function(aa){var Y="values" in aa.todo,ad=!N;if(!Y){aa.opts.position=aa.latLng||I(aa.opts.position);aa.todo.values=[{options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(ad){L()}if(aa.todo.cluster&&!N.getBounds()){google.maps.event.addListenerOnce(N,"bounds_changed",function(){S.marker.apply(S,[aa])});return}if(aa.todo.cluster){var Z,ab;if(aa.todo.cluster instanceof a){Z=aa.todo.cluster;ab=V.getById(Z.id(),true)}else{ab=W(aa.todo.cluster);Z=new a(k(aa.todo.id,true),ab);V.add(aa,"clusterer",Z,ab)}ab.beginUpdate();y.each(aa.todo.values,function(af,ag){var ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ab.add(ae,ag)});ab.endUpdate();O(aa,Z)}else{var ac=[];y.each(aa.todo.values,function(af,ag){var ai,ah,ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ah=new z.classes.Marker(ae.options);ac.push(ah);ai=V.add({todo:ae},"marker",ah);n(T,{todo:ae},ah,ai)});O(aa,Y?ac:ac[0])}};this.getroute=function(Y){Y.opts.origin=I(Y.opts.origin,true);Y.opts.destination=I(Y.opts.destination,true);G().route(Y.opts,function(aa,Z){X(Y,Z==google.maps.DirectionsStatus.OK?aa:false,Z);P.ack()})};this.directionsrenderer=function(Y){Y.opts.map=N;var aa,Z=new google.maps.DirectionsRenderer(Y.opts);if(Y.todo.divId){Z.setPanel(document.getElementById(Y.todo.divId))}else{if(Y.todo.container){Z.setPanel(y(Y.todo.container).get(0))}}aa=V.add(Y,"directionsrenderer",Z);O(Y,Z,aa)};this.getgeoloc=function(Y){O(Y,Y.latLng)};this.styledmaptype=function(Y){L();var Z=new z.classes.StyledMapType(Y.todo.styles,Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.imagemaptype=function(Y){L();var Z=new z.classes.ImageMapType(Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.autofit=function(Y){var Z=new google.maps.LatLngBounds();y.each(V.all(),function(aa,ab){if(ab.getPosition){Z.extend(ab.getPosition())}else{if(ab.getBounds){Z.extend(ab.getBounds().getNorthEast());Z.extend(ab.getBounds().getSouthWest())}else{if(ab.getPaths){ab.getPaths().forEach(function(ac){ac.forEach(function(ad){Z.extend(ad)})})}else{if(ab.getPath){ab.getPath().forEach(function(ac){Z.extend(ac);""})}else{if(ab.getCenter){Z.extend(ab.getCenter())}else{if(ab instanceof a){ab=V.getById(ab.id(),true);if(ab){ab.autofit(Z)}}}}}}}});if(!Z.isEmpty()&&(!N.getBounds()||!N.getBounds().equals(Z))){if("maxZoom" in Y.todo){google.maps.event.addListenerOnce(N,"bounds_changed",function(){if(this.getZoom()>Y.todo.maxZoom){this.setZoom(Y.todo.maxZoom)}})}N.fitBounds(Z)}O(Y,true)};this.clear=function(Y){if(typeof Y.todo==="string"){if(V.clearById(Y.todo)||V.objClearById(Y.todo)){O(Y,true);return}Y.todo={name:Y.todo}}if(Y.todo.id){y.each(g(Y.todo.id),function(Z,aa){V.clearById(aa)||V.objClearById(aa)})}else{V.clear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag);V.objClear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag)}O(Y,true)};this.exec=function(Y){var Z=this;y.each(g(Y.todo.func),function(aa,ab){y.each(Z.get(Y.todo,true,Y.todo.hasOwnProperty("full")?Y.todo.full:true),function(ac,ad){ab.call(T,ad)})});O(Y,true)};this.get=function(aa,ad,ac){var Z,ab,Y=ad?aa:aa.todo;if(!ad){ac=Y.full}if(typeof Y==="string"){ab=V.getById(Y,false,ac)||V.objGetById(Y);if(ab===false){Z=Y;Y={}}}else{Z=Y.name}if(Z==="map"){ab=N}if(!ab){ab=[];if(Y.id){y.each(g(Y.id),function(ae,af){ab.push(V.getById(af,false,ac)||V.objGetById(af))});if(!y.isArray(Y.id)){ab=ab[0]}}else{y.each(Z?g(Z):[t],function(af,ag){var ae;if(Y.first){ae=V.get(ag,false,Y.tag,ac);if(ae){ab.push(ae)}}else{if(Y.all){y.each(V.all(ag,Y.tag,ac),function(ai,ah){ab.push(ah)})}else{ae=V.get(ag,true,Y.tag,ac);if(ae){ab.push(ae)}}}});if(!Y.all&&!y.isArray(Z)){ab=ab[0]}}}ab=y.isArray(ab)||!Y.all?ab:[ab];if(ad){return ab}else{O(aa,ab)}};this.getdistance=function(Y){var Z;Y.opts.origins=g(Y.opts.origins);for(Z=0;Z<Y.opts.origins.length;Z++){Y.opts.origins[Z]=I(Y.opts.origins[Z],true)}Y.opts.destinations=g(Y.opts.destinations);for(Z=0;Z<Y.opts.destinations.length;Z++){Y.opts.destinations[Z]=I(Y.opts.destinations[Z],true)}B().getDistanceMatrix(Y.opts,function(ab,aa){X(Y,aa===google.maps.DistanceMatrixStatus.OK?ab:false,aa);P.ack()})};this.trigger=function(Z){if(typeof Z.todo==="string"){google.maps.event.trigger(N,Z.todo)}else{var Y=[N,Z.todo.eventName];if(Z.todo.var_args){y.each(Z.todo.var_args,function(ab,aa){Y.push(aa)})}google.maps.event.trigger.apply(google.maps.event,Y)}X(Z);P.ack()}}function s(M){var L;if(!typeof M==="object"||!M.hasOwnProperty("get")){return false}for(L in M){if(L!=="get"){return false}}return !M.get.hasOwnProperty("callback")}y.fn.gmap3=function(){var M,O=[],N=true,L=[];J();for(M=0;M<arguments.length;M++){if(arguments[M]){O.push(arguments[M])}}if(!O.length){O.push("map")}y.each(this,function(){var P=y(this),Q=P.data("gmap3");N=false;if(!Q){Q=new K(P);P.data("gmap3",Q)}if(O.length===1&&(O[0]==="get"||s(O[0]))){if(O[0]==="get"){L.push(Q.get("map",true))}else{L.push(Q.get(O[0].get,true,O[0].get.full))}}else{Q._plan(O)}});if(L.length){if(L.length===1){return L[0]}else{return L}}return this}})(jQuery);


/* ====== EXTERNAL FUNCTIONS ====== */

/* --- LOADING --- */

/* SLIDESHOW LOADING */

/* INDIVIDUAL LOADING */

function imgLoaded($img){
    $img.closest('.img_wrapper').addClass('loaded');
}





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
    
    if (touch) $bod.addClass('touch');
    if (safari) $bod.addClass('safari');
    if (phone) $bod.addClass('phone');
    
    if (ltie9) {
        $bod.addClass('shitmode');
        
        var $ieBlocker = $('#IEBlocker'),
        firstVisit = $.readCookie('firstvisit');
        if(firstVisit != 'no'){
            $ieBlocker.show();
            $('#LetMeIn').click(function(){
                $.setCookie('firstvisit', 'no', { 
                    duration : 1, 
                    path: '/'
                });
                $('#IEBlocker').remove();
            });
        };
    };
    
    if (!svgSupport || !svgSupportAlt || lteie9 || ff3x){
        $bod.addClass('no_svg');
    };
    
    if(!phone && !touch && !lteie9 && !$('html').hasClass('wf-active')){
        $('#PageLoader').show();
    };
    
};

/* --- CREATE FIXED HEADER ---*/
/* --- HOMEPAGE SLIDESHOW  --- */
/* --- PROJECT SLIDESHOW --- */
/* --- CAROUSELS --- */
/* --- NICESCROLL --- */
function niceScrollInit() {
    var smoothScroll = 'on';
    if (smoothScroll == 'on' && $(window).width() > 680 && !touch && !is_OSX) {
        $('[data-nicescroll]').niceScroll({
            zindex: 9999,
            cursoropacitymin: 0.8,
            cursorwidth: 7,
            cursorborder: 0,
            mousescrollstep: 60,
            scrollspeed: 80,
            cursorcolor: "#000000"
        });
    }
}

/* --- TWITTER WIDGET + ROYAL SLIDER --- */
jQuery(document).ready(function($) {
    $(".js-widget-tweets__list").royalSlider({
        autoScaleSlider: false,
        arrowsNavAutoHide: false,
        slidesSpacing: 0
    });  

    $(".pixslider").royalSlider({
        autoScaleSlider: false,
        autoHeight: true,
        arrowsNavAutoHide: false,
        slidesSpacing: 0
    });  
});

// Helper function
// examples
// console.log(padLeft(23,5));       //=> '00023'
// console.log(padLeft(23,5,'>>'));  //=> '>>>>>>23'
function padLeft(nr, n, str){
    return Array(n-String(nr).length+1).join(str||'0')+nr;
}


/* --- GALLERY FULL SCREEN + ROYAL SLIDER --- */
jQuery(document).ready(function($) {

    $(".js-gallery").royalSlider({
        autoScaleSlider: true,
        imageScaleMode: 'fill',
        slidesSpacing: 0,
        autoHeight: true,
        controlNavigation: 'bullets'
    });

    $(".js-gallery--archive").royalSlider({
        keyboardNavEnabled: true,
        imageAlignCenter: false,
        imageScaleMode: 'fill',
        slidesSpacing: 0,
        autoHeight: true,
        controlNavigation: 'none',
        arrowsNav: false
    });

    $(".js-gallery--fullscreen").royalSlider({
        keyboardNavEnabled: true,
        imageAlignCenter: false,
        imageScaleMode: 'fill',
        slidesSpacing: 0,
        autoHeight: true,
        controlNavigation: 'none',
        arrowsNav: false,
        autoHeight: true
    });


    var slider = $('.js-gallery, .js-gallery--fullscreen, .js-gallery--archive').data('royalSlider');
    if(slider) {
        var slideNumber = slider.numSlides;
        if(slideNumber < 10) slideNumber = padLeft(slideNumber, 2);

        $('.js-gallery-slides-total').html(slideNumber);
        
        slider.ev.on('rsAfterSlideChange', function(event) {
            var currentSlide = slider.currSlideId+1;
            if(currentSlide < 10){
                $('.js-gallery-current-slide .js-unit').html(currentSlide);
            } else {
                $('.js-gallery-current-slide .js-decimal').html(currentSlide/10);
                $('.js-gallery-current-slide .js-unit').html(currentSlide%10);
            }

        });    
    }
    

    $(document).on('click', '.js-slider-arrow-prev', function(event){
        event.preventDefault();
        slider.prev();
    });

    $(document).on('click', '.js-slider-arrow-next', function(event){
        event.preventDefault();
        slider.next();
    });    
});





/* --- MAGNIFIC POPUP --- */
$(document).ready(function() {
    $('.gallery').each(function() { // the containers for all your galleries should have the class gallery
        $(this).magnificPopup({
            delegate: '.mosaic__item a', // the container for each your gallery items
            type: 'image',
            removalDelay: 500,
            mainClass: 'mfp-fade',
            image: {
                titleSrc: function (item){
                    return item.el.attr('title');
                }
            },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                tPrev: 'Previous (Left arrow key)', // title for left button
                tNext: 'Next (Right arrow key)', // title for right button
                tCounter: '<ul class="gallery-control__items gallery-control--popup"><li class="gallery-control__item gallery-control__arrow"><a href="#" class="gallery-control__arrow-button arrow-button-left js-arrow-popup-prev"></a></li><li class="gallery-control__item gallery-control__count gallery-control__count--current"><span class="gallery-control__count-current js-gallery-current-slide">%curr%</span></li><li class="gallery-control__item gallery-control__count gallery-control__count--total"><sup class="gallery-control__count-total js-gallery-slides-total">%total%</sup></li><li class="gallery-control__item gallery-control__arrow"><a href="#" class="gallery-control__arrow-button arrow-button-right js-arrow-popup-next"></a></li></ul>'
            }
        });
    });

    var magnificPopup = $.magnificPopup.instance;

    $(document).on('click', '.js-arrow-popup-prev', function(event){
        event.preventDefault();
        magnificPopup.prev();
    });

    $(document).on('click', '.js-arrow-popup-next', function(event){
        event.preventDefault();
        magnificPopup.next();
    });      
});





/* --- RESIZE VIDEO, KEEPING THE ASPECT RATIO --- */

// Find all videos
var $allVideos = $(".video-wrap iframe");

// Figure out and save aspect ratio for each video
$allVideos.each(function() {
    $(this)
        .data('aspectRatio', this.width / this.height)

        // and remove the hard coded width/height
        .removeAttr('height')
        .removeAttr('width');

});

$.fn.resizeVideos = function() {
    var theVideos = this.find('.video-wrap iframe, video');
    theVideos.each(function() {
        var theVideo = $(this),
            ratio = theVideo.data('aspectRatio'),
            newWidth = theVideo.css('width', '100%').width(),
            newHeight = newWidth/ratio;
        theVideo.height(newHeight);
    });
};
$('body').resizeVideos();

// recalculate the videos width and height on window resize
$(window).resize(function(){
    $('body').resizeVideos();
});

/* ====== INITIALIZE ====== */

function init() {
    
    /* GLOBAL VARS */

    /* GET BROWSER DIMENSIONS */
    browserSize();

    /* DETECT PLATFORM */
    platformDetect();
    
    /* INSTANTIATE DJAX */
    var djax_transition = function($newEl) {
        var $oldEl = this; // reference to the DOM element that is about to be replaced
        $newEl.hide();     // hide the new content before it comes in

        console.log('before');
        $oldEl.fadeOut("slow", function() {
            console.log('after');
            $oldEl.replaceWith($newEl);
            $newEl.show();
            $newEl.fadeIn("slow");
        });
    }
    //$('body').djax('.djax-updatable', []);
    
    /* ONE TIME EVENT HANDLERS */
    eventHandlersOnce();
    
    /* INSTANTIATE EVENT HANDLERS */
    eventHandlers();   
    niceScrollInit();
};

/* ====== CONDITIONAL LOADING ====== */

function loadUp(){

    lazyLoad();

    if ($('#work').length) {

        $('.mosaic').mixitup({
            targetSelector: '.mosaic__item',
            easing: 'snap'
        });
    }
}

/* ====== EVENT HANDLERS ====== */

function toggle_nav(e) {
    $('html').toggleClass('navigation--is-visible');
    nav_is_open = $('html').hasClass('navigation--is-visible') ? true : false;
}

function toggle_submenu() {
    $(this).toggleClass('js--is-active');
}

function eventHandlersOnce() {
    
    /* @todo: change classes so style and js don't interfere */
    $('.menu-item--parent').on('click', toggle_submenu);

    $('.js-nav-trigger').on('click', function(e) {
        $('html').toggleClass('navigation--is-visible');
    });       
};

/* --- GLOBAL EVENT HANDLERS --- */

function eventHandlers(){

};

/* --- AUDIO PLAYER HANDLERS --- */

function eventHandlersPlayer(_player, $player, built){
    
}

/* --- VIDEO JS HANDLERS --- */

function videoHandlers(){

    // PLAY VIDEO
    // TIME MOUSE INACTIVITY
    // STOP VIDEO
    // END VIDEO
    
};


/* ====== ON DOCU READY ====== */

$(function(){

    /* --- INITIALIZE --- */
    init();
    /* --- CONDITIONAL LOADING --- */
    loadUp();
    /* --- VISUAL LOADING --- */

    var gmap_link, gmap_variables, gmap_zoom;
    gmap_link = "https://maps.google.com/?ll=51.379937,-2.343757&spn=0.013058,0.033023&t=m&z=14";

    function get_url_parameter(needed_param, gmap_url) {
        var sURLVariables = (gmap_url.split('?'))[1].split('&');
        for (var i = 0; i < sURLVariables.length; i++)  {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == needed_param) {
                return sParameterName[1];
            }
        }
    }

    if (gmap_link) {
        //Parse the URL and load variables (ll = latitude/longitude; z = zoom)
        console.log(gmap_link);
        var gmap_variables = get_url_parameter('ll', gmap_link);
        if (typeof gmap_variables === "undefined") {
            gmap_variables = get_url_parameter('sll', gmap_link);
        }
        var gmap_zoom = get_url_parameter('z', gmap_link);
        if (typeof gmap_zoom === "undefined") {
            gmap_zoom = 10;
        }
        var gmap_coordinates = gmap_variables.split(',');
    }

    $("#gmap").gmap3({
        map:{
            options:{
                center: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
                zoom: parseInt(gmap_zoom),
                mapTypeId: "style1",
                mapTypeControlOptions: {mapTypeIds: []}
            }
        },
        marker:{
            latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1])
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

    var clicks = 0;
    $('body').on('click', function() {
        $('.mosaic__item').each(function(){
            var self = $(this);
            setTimeout(function(){
                if (clicks % 2 == 1) {
                    self.addClass('slide-out').removeClass('slide-in');
                } else {
                    self.addClass('slide-in').removeClass('slide-out');
                }
            }, Math.floor(Math.random()*3) * 600 + Math.floor(Math.random()*200));
        });
        clicks++;
    });
});


/**
*
* When an image finished loaded add class to parent for
* the image to fade in
*
**/
function imgLoaded(img){
  var $img = $(img);
  $img.parent().addClass('js--is-loaded');
};
 
function lazyLoad() {
    var $images = $('.js-lazy-load');
    $images.each(function(){
        var $img = $(this),
            src = $img.attr('data-src');
 
        $img
            .on('load', imgLoaded($img[0]))
            .attr('src',src);
    });
};

/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
    
    var domain = 'http://192.168.1.104/prism-html';
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

    lazyLoad();

    $('html').addClass('window-loaded');
    $('.site-navigation--main .menu-item').each(function(i,e) {
        var $self = $(e);
        setTimeout(function() {
            $self.addClass('js--is-loaded');
        }, (i+1) * 150);
    });
});



/* ====== ON DJAX REQUEST ====== */

$(window).bind('djaxClick', function(e, data) {
    var bodyelem = $("html,body");
        bodyelem.animate({scrollTop: 0});
    /* --- KILL DISQUS --- */
    /* --- KILL SLIDESHOW TIMERS --- */
    /* --- KILL VIDEO --- */
    /* --- FADE OUT HEADING --- */
    /* --- SHOW PAGE LOADER --- */
});



/* ====== ON DJAX LOAD ====== */

$(window).bind('djaxLoad', function(e, data) {
    
    /* --- PUSH GA TRACK --- */
    /* --- RECHECK HEADER COLOR/POS --- */
    /* --- INSTANTIATE EVENT HANDLERS --- */
    eventHandlers();
    /* --- GHOSTBUSTER --- */
    /* --- RECHECK --- */
    /* --- GET BROWSER DIMENSIONS --- */
    browserSize();
    /* --- CONDITIONAL LOADING --- */
    /* --- VISUAL LOADING --- */
    loadUp();
});

/* ====== ON RESIZE ====== */

$(window).resize(function(){
    
    /* --- GET BROWSER DIMENSIONS --- */
    browserSize();
    /* --- ON HOME RESIZE --- */
    /* --- ON WORK RESIZE --- */
    /* --- ON PROJECT RESIZE --- */
    /* --- ON CONTACT RESIZE --- */
    /* --- ON BLOG LANDING RESIZE --- */
    
});

/* ====== ON SCROLL ======  */

$(window).scroll(function(e){
    /* --- MAKE HEADER FIXED --- */
});

} )( jQuery );