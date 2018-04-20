<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Statistiques
</h2>
<div class="ui container">
  <canvas id="myChart"></canvas>
</div>
<input id="stat" type="hidden" value="year,-1">
<script>

$.ajax({
  method: 'POST',
  url: '/ajax/stats/req/elv_inscrit.php',
  success: function(obj) {
    var nbEleve = [];
    obj = JSON.parse(obj);
    for (elem in obj) {
      nbEleve.push(obj[elem]);
    }
    var date = getSchoolDate();
    barChartData = loadConfigYear(nbEleve);
    loadChart(barChartData, 'Année '+date);
  }
});

// Define a plugin to provide data labels
Chart.plugins.register({
    afterDatasetsDraw: function(chart, easing) {
        // To only draw at the end of animation, check for easing === 1
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function (dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function(element, index) {
                    // Draw the text in black, with the specified font
                    ctx.fillStyle = 'rgb(0, 0, 0)';

                    var fontSize = 16;
                    var fontStyle = 'normal';
                    var fontFamily = 'Arial';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    // Just naively convert to string for now
                    var dataString = dataset.data[index].toString();

                    // Make sure alignment settings are correct
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                });
            }
        });
    }
});

function getSchoolDate() {
  var year = moment();
  if (year.month() > 8) year.year(year.year() + 1);
  return year.year();
}

function getWeeks(date) {
  var weeks;
  $.ajax({
    async: false,
    method: 'POST',
    url: '/ajax/stats/req/weeks.php',
    data: {
      date: date
    },
    success: function(data) {
      weeks = JSON.parse(data);
    }
  });
  return weeks;
}

function getDiff(nb1, nb2) {
  return (nb2 - nb1) + 1;
}


function loadChart(barChartData, title) {
    var ctx = $("#myChart");
    if (window.myBar)
      window.myBar.destroy(); 
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    },
                    scaleLabel:{
                        display: true,
                        labelString:'Nombre d\'éleves inscrit total'
                    }
                }]
            },
            onClick: handleClick,
            onHover: mouseHover
        }
    });
};

function mouseHover(evt) {
  var activeElement = window.myBar.getElementAtEvent(evt);
  if (activeElement[0])
    document.body.style.cursor = 'pointer';
  else
    document.body.style.cursor = 'default';
}

function handleClick(evt) {
  var activeElement = window.myBar.getElementAtEvent(evt);
  if (activeElement[0]) {
    var stat = $('#stat');
    var tabStat = stat.val().split(',');
    var mode = tabStat[0];
    var month = tabStat[1];
    var week = tabStat[2];
    console.log(week);
    var tabYear = ["Septembre", "Octobre", "Novembre", "Décembre", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet"];
    var iMonth = 0;
    var i = 0;
    if (month == -1) {
      month = activeElement[0]._index;
      iMonth = month;
      month++;
      while (i < 8) {
        if (month >= 12)
          month = 0;
        month++;
        i++;
      }
    }
    if (month > 8) year = getSchoolDate() -1;
    else year = getSchoolDate();

    date = moment(year + "-" + month + "-01", "YYYY-MM-DD"); // 2000-12-01

    //console.log(date.isoWeekday());

    switch (mode) {
      case 'year':
        weeks = getWeeks(date.format('YYYY-MM-DD'));
        data = dataMonth(month, weeks);
        barChartData = loadConfigMonth(data, weeks);
        loadChart(barChartData, tabYear[iMonth] + ' ' + year);
        stat.val('month,' + month + ',' + weeks['first_week']);
        break;
        
      case 'month':
        data = dataWeek(week);
        barChartData = loadConfigWeek(data, days);
        stat.val('week,' + month + ',' + week['first_week']);
        break;

      case 'month':
        data = dataWeek(week);
        barChartData = loadConfigDay(data, days);
        stat.val('week,' + month + ',' + week['first_week']);
        break;
    
      default:

        break;
    }
  }
}

function dataMonth(month, weeks) {
  var weekDiff = getDiff(weeks["first_week"], weeks['last_week']);
  var weekFirst = weeks["first_week"];
  var nbEleve = [];
  $.ajax({
    async: false,
    method: 'POST',
    url: '/ajax/stats/req/elv_inscrit_month.php',
    data: {
      weekFirst: weekFirst,
      weekDiff: weekDiff,
      month: month
    },
    success: function(obj) {
      obj = JSON.parse(obj);
      for (elem in obj) {
        nbEleve.push(obj[elem]);
      }
    }
  });
  console.log(nbEleve);
  return nbEleve;
}

function dataDay(week) {
  var nbEleve = [];
  $.ajax({
    async: false,
    method: 'POST',
    url: '/ajax/stats/req/elv_inscrit_week.php',
    data: {
      week: week
    },
    success: function(obj) {
      obj = JSON.parse(obj);
      for (elem in obj) {
        nbEleve.push(obj[elem]);
      }
    }
  });
  console.log(nbEleve);
  return nbEleve;
}

// ---------------- Year -------------------

function loadConfigYear(nbEleve) {
  var color = Chart.helpers.color;
  var config = {
      labels: ["Septembre", "Octobre", "Novembre", "Décembre", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet"],
      datasets: [{
          label: 'Éleves',
          backgroundColor: color("#FF0000").alpha(0.5).rgbString(),
          borderColor: "#FF0000",
          borderWidth: 1,
          data: nbEleve
      }]
  };
  return config;
}

// ---------------- Month -------------------

function loadConfigMonth(nbEleve, weeks) {
  var color = Chart.helpers.color;
  var labels = [];
  for (var i = 0; i < (getDiff(weeks["first_week"], weeks['last_week'])) ; i++) {
    labels[i] = "Semaine " + (parseInt(weeks["first_week"]) + i + 1);
  }
  var config = {
      labels: labels,
      datasets: [{
          label: 'Éleves',
          backgroundColor: color("#FF0000").alpha(0.5).rgbString(),
          borderColor: "#FF0000",
          borderWidth: 1,
          data: nbEleve
      }]
  };
  
  return config;
}


// ---------------- Week -------------------



// function GoInFullscreen(element) {
// 	if(element.requestFullscreen)
// 		element.requestFullscreen();
// 	else if(element.mozRequestFullScreen)
// 		element.mozRequestFullScreen();
// 	else if(element.webkitRequestFullscreen)
// 		element.webkitRequestFullscreen();
// 	else if(element.msRequestFullscreen)
// 		element.msRequestFullscreen();
// }

// $(document).on('click','div',() => {
//   GoInFullscreen($('html').get(0))
// })
</script>