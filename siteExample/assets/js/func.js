// Didn't find proper way to track solely one click and interval
var hasBeenClicked = false,
    quInter;

// Sending get query to server by using XMLHR, receive JSON and parse it to updateData func
function ajaxFunc(clicked) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.response);
            if (data.length != 0){
                console.log(data);
                document.querySelector("#attr #type #type").innerHTML = data[0].type;
                document.querySelector("#attr #name #name").innerHTML = clicked;
                // console.log(clicked);
                document.querySelector("#attr #serial #serial").innerHTML = data[0].serial;
                document.querySelector("#attr #IP #IP").innerHTML = data[0].IP;
                document.querySelector("#attr #MAC #MAC").innerHTML = data[0].MAC;
                document.querySelector("#attr #inventory #inventory").innerHTML = data[0].inv;
                document.querySelector("#attr #telnum #telnum").innerHTML = data[0].telNum;
                document.querySelector("#attr #subdiv #subdiv").innerHTML = data[0].subDiv;
                document.querySelector("#attr #note #note").innerHTML = data[0].note;
                if (document.querySelector("#attr button") != undefined) {
                    document.querySelector("#attr button").textContent = "Изменить";
                }
                updateData(data);
            } else {
                document.querySelector("#attr #type #type").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #name #name").innerHTML = clicked;    
                document.querySelector("#attr #serial #serial").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #IP #IP").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #MAC #MAC").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #inventory #inventory").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #telnum #telnum").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #subdiv #subdiv").innerHTML = "Данные отсутствуют";
                document.querySelector("#attr #note #note").innerHTML = "Данные отсутствуют";
                if (document.querySelector("#attr button") != undefined) {
                    document.querySelector("#attr button").textContent = "Создать";
                }
                updateData();
            }
        };
    };
    xmlhttp.open("GET", "http://localhost/siteExample/assets/php/data.php?deviceName=" + encodeURIComponent(clicked), true);
    xmlhttp.send();
};

// Getting text and sending it on server by using ajaxFunc func
function myFunction() {
    var attribute = this.getElementsByTagName("text")[0].textContent;
    if (hasBeenClicked == true) {
        clearInterval(quInter);
        ajaxFunc(attribute);
        quInter = setInterval(function () {ajaxFunc(attribute);}, 30000);
    } else {
        ajaxFunc(attribute);
        quInter = setInterval(function () {ajaxFunc(attribute);}, 30000);
        hasBeenClicked = true;
    }
};

function changeFunction() {
    state = encodeURIComponent(document.querySelector("#attr button").textContent);
    type = encodeURIComponent(document.querySelector("#attr #type #type").value);
    name = encodeURIComponent(document.querySelector("#attr #name #name").value);    
    serial = encodeURIComponent(document.querySelector("#attr #serial #serial").value);
    IP = encodeURIComponent(document.querySelector("#attr #IP #IP").value);
    MAC = encodeURIComponent(document.querySelector("#attr #MAC #MAC").value);
    inv = encodeURIComponent(document.querySelector("#attr #inventory #inventory").value);
    telNum = encodeURIComponent(document.querySelector("#attr #telnum #telnum").value);
    subDiv = encodeURIComponent(document.querySelector("#attr #subdiv #subdiv").value);
    note = encodeURIComponent(document.querySelector("#attr #note #note").value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://localhost/siteExample/assets/php/data.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#wrapper header h1").innerHTML = "ОТОСЛАЛИ!";
        };
    };
    console.log(IP);
    xmlhttp.send("type=" + type + "&name=" + name + "&serial=" + serial + "&IP=" + IP + "&MAC=" + MAC + "&inv=" + inv + "&telNum=" + telNum + "&subDiv=" + subDiv + "&note=" + note + "&state=" + state);
    
}

// Update data section (Called from the onclick)
function updateData(data) {
    svg.selectAll("*")
        .remove();
    if (!data) {
        data = JSON.parse('[{"queryTime":"07:00", "ping":"100"}, {"queryTime":"07:00", "ping":"100"}]');
        data.forEach(function(d) {
            d.date = parseDate(d.queryTime);
            d.close = +d.ping;
        });
    } else {
        data.forEach(function(d) {
            d.date = parseDate(d.queryTime);
            d.close = +d.ping;
            
        });
    }

    x.domain([parseDate('07:00'), parseDate('19:00')]);
    y.domain([0, 200.05]);
    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
        .attr("d", valueline(data));
    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);
    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);
};