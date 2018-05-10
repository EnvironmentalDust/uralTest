function ready(callback){
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
        if (document.readyState=='complete') callback();
    });
}

var drag,
    groups;
function moveDev() {

    function dropHandler(d) {
        // console.log('dropped');
    }

    function dragmove(d) {
        var x = d3.event.x;
        var y = d3.event.y;

        d3.select(this).attr("transform", "translate(" + x + "," + y + ")");
    }

    function getXY(evt) {
        // console.log(evt);
        if (evt.getAttribute("transform") == undefined) {

            return {x:0, y:0};

        } else {
            
            translate = evt.getAttribute("transform");
            leftPar = translate.search( /\(/i) + 1;
            if (version === false) {
                comma = translate.search( /,/i);
            } else {
                comma = translate.search( / /i);
            }
            rightPar = translate.search( /\)/i);
            // console.log(leftPar);
            // console.log(comma);
            // console.log(rightPar);
            // console.log(version);

            xX = translate.substring(leftPar, comma);
            yY = translate.substring(comma + 1, rightPar);

            // console.log(xX);
            // console.log(yY);

            return {x:xX, y:yY};
        }
    }
    
    if (this.style.background == "red") {
        drag = d3.behavior.drag()
            .origin(function(d, i) { return getXY(this); })
            .on("drag", dragmove)
            .on("dragend", dropHandler);
        groups = d3.selectAll("#layer1 g, line, text, rect")
            .call(drag);
        this.style.background = "green";
    } else if (this.style.background == "green") {
        drag = d3.behavior.drag()
            .origin(function(d, i) { return getXY(this); })
            .on("drag", null)
            .on("dragend", null);
        groups = d3.selectAll("#layer1 g")
            .call(drag);
        this.style.background = "red";
    }

}

// Custom Funcs
function addPC() {
    svg = d3.select("#map svg #layer1");
    g = svg.append("g");
    g.append("rect")
        .attr("x", 100)
        .attr("y", 100)
        .attr("fill", "white")
        .attr("stroke", "black")
        .attr("stroke-width", "0.7")
        .attr("stroke-miterlimit", "10")
        .attr("width", 7.5406251)
        .attr("height", 7.5406251);
    g.append("text")
        .attr("x", 98)
        .attr("y", 112)
        .attr("font-family", "Times New Roman")
        .attr("font-style", "normal")
        .attr("font-weight", "bold")
        .attr("line-height", "2.26059794px")
        .attr("stroke-width", "0.22605978")
        .attr("font-size", "3.52777767px")
        .attr("fill", "black")
        .text(document.querySelector("#options #name").value);
        
    g.on("click", function() { clicked = this });
}

function addC() {
    svg = d3.select("#map svg #layer1");
    g = svg.append("g");
    g.append("rect")
        .attr("x", 100)
        .attr("y", 100)
        .attr("fill", "white")
        .attr("stroke", "black")
        .attr("stroke-width", "0.7")
        .attr("stroke-miterlimit", "10")
        .attr("width", 19.314583)
        .attr("height", 7.5406251);
    g.append("text")
        .attr("x", 98)
        .attr("y", 112)
        .attr("font-family", "Times New Roman")
        .attr("font-style", "normal")
        .attr("font-weight", "bold")
        .attr("line-height", "2.26059794px")
        .attr("stroke-width", "0.22605978")
        .attr("font-size", "3.52777767px")
        .attr("fill", "black")
        .text(document.querySelector("#options #name").value);
    g.on("click", function() { clicked = this });
}

function addText() {
    svg = d3.select("#map svg #layer1");
    text = svg.append("g").append("text")
        .attr("x", 95)
        .attr("y", 112)
        .attr("font-family", "Times New Roman")
        .attr("font-style", "normal")
        .attr("font-weight", "bold")
        .attr("line-height", "2.26059794px")
        .attr("stroke-width", "0.22605978")
        .attr("font-size", "3.52777767px")
        .attr("fill", "black")
        .text(document.querySelector("#options #name").value);
    text.on("click", function() { clicked = this });
}

function saveDocument() {
    svg = document.querySelector("body #map svg");
    // console.log(svg.outerHTML);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://localhost/siteExample/assets/php/editor.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        };
    };
    xmlhttp.send("newPage=" + svg.outerHTML);
    location.reload();

    
}

var clicked = 0;
function deleteDev() {
    d3.select(clicked).remove();
}

var line,
    vis;
function drawLines() {

    if (vis === undefined) {
        vis = d3.select("svg")
            .on("mousedown", mousedown)
            .on("mouseup", mouseup);
        this.style.background = "green";
    } else {
        vis = d3.select("svg")
            .on("mousedown", null)
            .on("mouseup", null);
            
        this.style.background = "red";
    }

    function mousedown() {
        var m = d3.mouse(this);
        if (vis !== null) {
            line = vis.append("line")
                .attr("fill", "none")
                .attr("stroke", "#000000")
                .attr("stroke-width", "0.7")
                .attr("stroke-miterlimit", "10")
                .attr("x1", m[0])
                .attr("y1", m[1])
                .attr("x2", m[0])
                .attr("y2", m[1]);
            vis.on("mousemove", mousemove);
        }
    }
    function mousemove() {
        var m = d3.mouse(this);
        line.attr("x2", m[0])
            .attr("y2", m[1])
            .on("click", function() { clicked = this; });
    }

    function mouseup() {
        if (vis !== null) {
            vis.on("mousemove", null);
        }
    }
}


// svg = d3.select("#layer1")
// function zoom() {
//     svg
//     .attr("width", "100%")
//     .attr("height", "100%")
//     .call(d3.behavior.zoom().on("zoom", function () {
//         svg.attr("transform", "translate(" + d3.event.translate + ")" + " scale(" + d3.event.scale + ")")
//     }));
// }

ready(function(){
    document.body.onselectstart = function() {return false};
    document.querySelector("#options #addPC").addEventListener('click', addPC, false);
    document.querySelector("#options #addC").addEventListener('click', addC, false);
    document.querySelector("#options #deleteDev").addEventListener('click', deleteDev, false);
    document.querySelector("#options #drawLines").addEventListener('click', drawLines, false);
    document.querySelector("#options #moveDev").addEventListener('click', moveDev, false);
    document.querySelector("#options #addText").addEventListener('click', addText, false);
    document.querySelector("#save").addEventListener('click', saveDocument, false);

 

    elements = d3.select("#layer1").selectAll("g")
        .on("click", function() { clicked = this; });

    lines = d3.selectAll("line")
        .on("click", function() { clicked = this; });

    text = d3.select("#layer1").selectAll("text")
        .on("click", function() { clicked = this; });


})

