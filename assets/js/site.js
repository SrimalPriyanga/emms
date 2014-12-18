//// Load the Visualization API and the piechart package.
//google.load('visualization', '1', {'packages': ['corechart']});
//// Set a callback to run when the Google Visualization API is loaded.
//google.setOnLoadCallback(drawChart1);
////google.setOnLoadCallback(drawChart2);
//
//function drawChart1() {
//    var jsonData = $.ajax({
//        url: "http://localhost/ExamResults/result/getData",
//        dataType: "json",
//        async: false
//    }).responseText;
//
//    // Create our data table out of JSON data loaded from server.
//    var data = new google.visualization.DataTable(jsonData);
//    var options = {
//        title: 'Your Exam Result History',
//        is3D: true
//    };
//    // Instantiate and draw our chart, passing in some options.
//    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
//    chart.draw(data,options);
//}


google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawVisualization);

function drawVisualization() {
  // Some raw data (not necessarily accurate)
//  var data = google.visualization.arrayToDataTable([
//    ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
//    ['2004/05',  165,      938,         522,             998,           450,      614.6],
//    ['2005/06',  135,      1120,        599,             1268,          288,      682],
//    ['2006/07',  157,      1167,        587,             807,           397,      623]
//  ]);

    var jsonData = $.ajax({
        url: "http://localhost/ExamResults/result/readFile",
        dataType: "json",
        async: false
    }).responseText;

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

  var options = {
    title : 'Your Exam Result History',
    vAxis: {title: "Marks"},
    hAxis: {title: "Grade & Term"},
    seriesType: "bars",
    series: {10: {type: "line"}}
  };

  var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
  chart.draw(data, options);
}

//function loadmodal($modal) { // load bootstrap modals
//    $($modal).modal({show: true});
//}