window.onload = function () {
    var graphs = document.querySelectorAll('.graph');
    for (var i = 0; i < graphs.length; i++) {
        drawComparisonGraphs(graphs[i]);
    }
}

function drawComparisonGraphs(target) {
    var data = eval(target.id + 'GraphData');
    var trace = [
		{   
            x: data.length,
			y: data,
            type: 'line',
            mode: 'lines+markers',
            marker: {
                size: 10,
              },
		}
	];
	var layout = {
		title: 'title', 
		xaxis: {
            title: 'Round',
            tickmode: 'linear'
        }, 
		yaxis: {
            title: 'Bit differenti',
            tickmode: 'linear',
        },
        shapes: [
            {
                type: 'line',
                x0: 0,
                y0: 4,
                x1: data.length,
                y1: 4,
                line: {
                  color: 'red',
                  width: 1,
                  dash: 'dot'
                }
            },
        ]
	  };
	Plotly.newPlot(target, trace, layout);
}