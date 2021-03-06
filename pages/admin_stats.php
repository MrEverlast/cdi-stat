<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Statistiques
</h2>

<div class="ui grid padded">
  <div class="row">
    <div class="column" style="width: 306px;">
      <h3>Debut</h3>
      <div class="ui calendar" id="calendar1"></div>
      
    </div>
    <div class="column" style="width: 306px;">
      <h3>Fin</h3>
      <div class="ui calendar" id="calendar2"></div>
    </div>
  </div>
  <div class="row">
    <div id="test">
      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>


<script>

function getSchoolDate() {
  var year = moment();
  if (year.month() > 8) year.year(year.year() + 1);
  return year.year();
}

function getCalendarEdge(selector = 'min') {
  switch (selector) {
    case 'min':
      return new Date((getSchoolDate()-1) + '-09-01');
      break;
    case 'max':
      return new Date(getSchoolDate() + '-08-31');
      break;
  }
}

var text = {
  days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
  months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
  monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
  today: 'Aujourd\'hui',
  now: 'Maintenant',
  am: 'AM',
  pm: 'PM'
};

window.chartColors = {
	red: '#ff6384'
};

var minDate = getCalendarEdge();
var maxDate = getCalendarEdge('max');

function loadCalender(id, initialDate = getCalendarEdge()) {
  if (id == 'calendar1') {
    endCalendar = $('#calendar2');
    startCalendar = null;
  } else {
    endCalendar = null;
    startCalendar = $('#calendar1');
  }

  $('#'+id).calendar({
    firstDayOfWeek: 1, 
    initialDate: initialDate,
    minDate: minDate,
    maxDate: maxDate,
    type: 'date',
    ampm: false,
    text: text,
    monthFirst: false,
    endCalendar: endCalendar,
    startCalendar: startCalendar,
    onChange: function(date) {
      var calendar1 = $('#calendar1');
      var calendar2 = $('#calendar2');

      calendar1.calendar('refresh');
      calendar2.calendar('refresh');

      var date1;
      var date2;
      if (calendar2.calendar('get date') !== null || this.id === 'calendar2') {
        if (this.id === 'calendar1') {
          date1 = moment(date).format('YYYY-MM-DD');
          date2 = moment(calendar2.calendar('get date')).format('YYYY-MM-DD');
        } else if (this.id === 'calendar2') {
          date1 = moment(calendar1.calendar('get date')).format('YYYY-MM-DD');
          date2 = moment(date).format('YYYY-MM-DD');
        }

        if (verifDates(date1, date2)) {
          $.ajax({
            method: 'POST',
            url: '/ajax/stats/req/elv_inscrit.php',
            data: {
              diff: getDayDiff(moment(date1), moment(date2)),
              date: date1
            },
            success: function(data) {
              get_activities((activities) => {
                console.log(activities)
                loadGraph(data, date1, date2, activities);
              });
            }
          });
        }
      }
      
    }
  });
  
}

loadCalender('calendar1');
loadCalender('calendar2', maxDate);

$('#calendar1').calendar('set date', minDate, updateInput = false, fireChange = true);
$('#calendar2').calendar('set date', maxDate, updateInput = false, fireChange = true);

function getDayDiff(date1, date2) {
  return Math.abs(date1.diff(date2.format(),'days'));
}

function verifDates(date1, date2) {
  return moment(date1).isBefore(date2) || moment(date1).isSame(date2);
}

function loadGraph(_data, date1, date2, activities) {
  var json = JSON.parse(_data);
  var jsonActivities = JSON.parse(activities);
  var ctx = $("#myChart");
  var arr = $.map(json, function(el) { return el });
  var datasets = [];


  arr.forEach((element, index) => {
    if (index == 0) {
      label = 'Élèves total'
      backgroundColor = window.chartColors.red + "14";
      borderColor = window.chartColors.red;
    } else {
      label = jsonActivities[index].name;
      backgroundColor = jsonActivities[index].color + "14";
      borderColor = jsonActivities[index].color;
    }
    tempDatasets = {
            label: label,
            data: [],
            backgroundColor: backgroundColor,
					  borderColor: borderColor,
            borderSize: 1
          };

    datasets[index] = tempDatasets;
  });


  var title = moment(date1).format('D MMM YYYY') + ' à ' + moment(date2).format('D MMM YYYY'); 
  if (window.myLineChart)
      window.myLineChart.destroy();
  
  window.myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: datasets
    },
    options: {
				responsive: true,
				title: {
					display: true,
					text: title
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Nombre'
						}
					}]
				}
			}
  });

  arr.forEach((element, index) => {
    var eacharr = $.map(element, function(el) { return el });

    eacharr.forEach((element, i) => {
      addData(window.myLineChart, moment(date1).add(i, 'days').format('D MMM'), element, index);
    });

  });
  window.myLineChart.update();
}

function addData(chart, label, data, datasetIndex) {
  if (datasetIndex === 0)
    chart.data.labels.push(label);
  chart.data.datasets[datasetIndex].data.push(data);
}

function get_activities(cb) {
  $.ajax({
    method: 'POST',
    url: '/ajax/stats/req/get_act.php',
    success: function(data) {
      cb(data);
    }
  });
}

$(window).on('resize', () => {
  resize();
});

$(window).on('load', () => {
  resize();
});

function resize() {
  $("#test").css("width", (window.innerWidth - 260) + "px");
}

</script>
