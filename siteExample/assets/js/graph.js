// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 950 - margin.left - margin.right,
    height = 270 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%H:%M").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(11);
var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(2);

// Define format of time for ticks
xAxis.tickFormat(d3.time.format("%H:%M"));
// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.date); })
    .y(function(d) { return y(d.close); });


// Adds the svg canvas
var svg = d3.select("#graph svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
        .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Get the data
d3.json("", function(error, data) {
    data = JSON.parse('[{"queryTime":"07:00", "ping":"100"}, {"queryTime":"07:00", "ping":"100"}]');
        data.forEach(function(d) {
            d.date = parseDate(d.queryTime);
            d.close = +d.ping;
        });

    // Scale the range of the data
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

});
x.domain([parseDate('07:00'), parseDate('19:00')]);
y.domain([0, 200.05]);