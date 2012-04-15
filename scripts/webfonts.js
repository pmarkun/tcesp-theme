WebFontConfig = {
	google: { families: ['Amaranth'] },
    
	fontinactive: function (fontFamily, fontDescription) {
		WebFontConfig = {
			custom: { families: ['Amaranth'],
			urls: ['../fonts/Amaranth.css']
		}
	};
	loadFonts();
	}
};

function loadFonts() {
	var wf = document.createElement('script');
	wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	wf.type = 'text/javascript';
	wf.async = 'true';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);
}

(function () {
	loadFonts();
})();