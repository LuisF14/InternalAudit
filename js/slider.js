(function(){ 
//propiedades slider
var propSlider = {

	slider: document.getElementById('slider'),
	primerSlide: null
}

var propSlider1 = {

	slider1: document.getElementById('slider1'),
	primerSlide1: null
}

//Metodos slide
var metSlider = {

	inicio: function(){
		setInterval(metSlider.moverSlide,3000)
	},
	moverSlide: function () {
		propSlider.slider.style.transition = 'all 1s ease';
		propSlider.slider.style.marginLeft = '-100%';

		setTimeout(function (){
			propSlider.primerSlide = propSlider.slider.firstElementChild;
			propSlider.slider.appendChild(propSlider.primerSlide);

			propSlider.slider.style.transition = 'unset';
			propSlider.slider.style.marginLeft = 0;
		},1000);
	}
}
var metSlider1 = {

	inicio: function(){
		setInterval(metSlider1.moverSlide,3000)
	},
	moverSlide: function () {
		propSlider1.slider1.style.transition = 'all 1s ease';
		propSlider1.slider1.style.marginLeft = '-100%';

		setTimeout(function (){
			propSlider1.primerSlide1 = propSlider1.slider1.firstElementChild;
			propSlider1.slider1.appendChild(propSlider1.primerSlide1);

			propSlider1.slider1.style.transition = 'unset';
			propSlider1.slider1.style.marginLeft = 0;
		},1000);
	}
}

metSlider.inicio();
metSlider1.inicio();
}())