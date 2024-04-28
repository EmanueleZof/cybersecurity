window.onload = function () {
	drawCypherGraph();
	drawItalianGraph();
	drawCypherGraphUnordered();
	drawItalianGraphUnordered();
	highlightLetters();
}

function drawCypherGraph() {
	var target = document.getElementById('cypher_graph');
	var y = [];
	Object.values(window.cypherGraphData).forEach(function(current) {
		y.push(current['percent']);
	});
	var data = [
		{
			x: Object.keys(window.cypherGraphData),
			y: y,
    		type: 'bar',
		}
	];
	var layout = {
		title: 'Frequenze delle lettere del testo cifrato', 
		xaxis: {title: 'Lettera'}, 
		yaxis: {title: 'Percentuale di occorrenze'}
	  };
	Plotly.newPlot(target, data, layout);
}

function drawCypherGraphUnordered() {
	var target = document.getElementById('cypher_graph_unordered');
	var y = [];
	Object.values(window.cypherGraphDataUnordered).forEach(function(current) {
		y.push(current['percent']);
	});
	var data = [
		{
			x: Object.keys(window.cypherGraphDataUnordered),
			y: y,
    		type: 'bar',
			marker: {
				color: 'rgba(58,200,225,.5)'
			}
		}
	];
	var layout = {
		title: 'Frequenze delle lettere del testo cifrato', 
		xaxis: {title: 'Lettera'}, 
		yaxis: {title: 'Percentuale di occorrenze'}
	  };
	Plotly.newPlot(target, data, layout);
}

function drawItalianGraph() {
	var target = document.getElementById('italian_graph');
	var data = [
		{
			x: Object.keys(window.italianGraphData),
			y: Object.values(window.italianGraphData),
    		type: 'bar',
		}
	];
	var layout = {
		title: 'Frequenze delle lettere del testo italiano', 
		xaxis: {title: 'Lettera'}, 
		yaxis: {title: 'Percentuale di occorrenze'}
	  };
	Plotly.newPlot(target, data, layout);
}

function drawItalianGraphUnordered() {
	var target = document.getElementById('italian_graph_unordered');
	var data = [
		{
			x: Object.keys(window.italianGraphDataUnordered),
			y: Object.values(window.italianGraphDataUnordered),
    		type: 'bar',
			marker: {
				color: 'rgba(58,200,225,.5)'
			}
		}
	];
	var layout = {
		title: 'Frequenze delle lettere del testo italiano', 
		xaxis: {title: 'Lettera'}, 
		yaxis: {title: 'Percentuale di occorrenze'}
	  };
	Plotly.newPlot(target, data, layout);
}

function highlightLetters() {
	var items = document.querySelectorAll('.highlight-orange');
	for (i = 0; i < items.length; i++) {
		items[i].previousElementSibling.classList.add('highlight-yellow');
		items[i].nextElementSibling.classList.add('highlight-yellow');
	} 
}