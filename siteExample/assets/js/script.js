function ready(callback){
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
        if (document.readyState=='complete') callback();
    });
};

ready(function(){

    clickedElement = document.getElementById("layer1").getElementsByTagName("g");
    // console.log(clickedElement);
    for (var i = 0; i < clickedElement.length; i++) {
        clickedElement[i].addEventListener('click', myFunction, false);
    };
    if (document.querySelector("body #attr #change") != null) {
        document.querySelector("body #attr #change").addEventListener('click', changeFunction, false);
    };
    var elements = document.getElementById("layer1").getElementsByTagName("rect");
    for (var i in elements) {
        if (!elements.hasOwnProperty(i)) continue;
        elements[i].addEventListener( 'mouseover', function() {
            this.style.fill = 'blue';
        })
        elements[i].addEventListener( 'mouseout', function() {
            this.style.fill = this.style.fill.replace( /(?:^|\s)blue(?!\S)/g , '' );
        })
    }

});

