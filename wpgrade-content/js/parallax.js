// shim layer with setTimeout fallback
window.requestAnimFrame = (function(){
	"use strict";
	return  window.requestAnimationFrame           ||
		window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame    ||
		window.oRequestAnimationFrame      ||
		window.msRequestAnimationFrame     ||
		function(callback) {
			window.setTimeout(callback, 1000 / 60);
		};
})();

(function(win, d) {
	"use strict";
	var $ = d.querySelector.bind(d);

	var blob1 = $('#featured-image');

	var blob1Obj = null;

	var canvas = $('#blob-container canvas');
	var renderer = null;
	var camera = null;
	var scene = new THREE.Scene();

	if (Modernizr.webgl) {
		renderer = new THREE.WebGLRenderer({
			canvas: canvas,
			alpha: false,
			clearColor: 0x1e2124
		});
	} else if (Modernizr.canvas) {
		renderer = new THREE.CanvasRenderer({
			canvas: canvas
		});
		renderer.setClearColorHex(0x1e2124);
	}

	var mainBG = $('section#content');

	var ticking = false;
	var lastScrollY = 0;

	function onResize () {

		if(camera === null) {
			createElements();
			camera = new THREE.OrthographicCamera(0, window.innerWidth, 0, 800, -2000, 2000);
			scene.add(camera);
		} else {
			camera.bottom = window.innerHeight;
		}
		renderer.setSize(window.innerWidth, 800);

		updateElements(win.scrollY);
	}

	function onScroll (evt) {
		if(!ticking) {
			ticking = true;
			lastScrollY = win.scrollY;
			requestAnimationFrame(updateElements);
		}
	}

	function createElements () {
		// create the sphere's material
		var blob1Texture = new THREE.Texture(blob1);
		var blob1Material = new THREE.MeshBasicMaterial({map: blob1Texture});
		blob1Texture.needsUpdate = true;
		blob1Obj = new THREE.Mesh(new THREE.PlaneGeometry(1800, 800, 1, 1), blob1Material);
		blob1Obj.rotation.x = Math.PI;
		blob1Obj.position.x = 0;
		blob1Obj.position.z = -1;

		// add the sphere to the scene
		scene.add(blob1Obj);
	}

	function updateElements () {
		var relativeY = lastScrollY / 3000;
		blob1Obj.position.y = 700 - pos(300, -4400, relativeY, 0);
		renderer.render(scene, camera);
		ticking = false;
	}

	function pos(base, range, relY, offset) {
		return base + limit(0, 1, relY - offset) * range;
	}

	function prefix(obj, prop, value) {
		var prefs = ['webkit', 'moz', 'o', 'ms'];
		for (var pref in prefs) {
			obj[prefs[pref] + prop] = value;
		}
	}

	function limit(min, max, value) {
		return Math.max(min, Math.min(max, value));
	}

	win.addEventListener('load', onResize, false);
	win.addEventListener('resize', onResize, false);
	win.addEventListener('scroll', onScroll, false);

})(window, document);
