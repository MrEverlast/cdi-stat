<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Statistiques
</h2>


<div class="ui grid padded">
  <div class="row">
    <div class="col">
      <h3>Debut</h3>
      <div class="ui calendar" id="calendar1"></div>
      <br>
      <h3>Fin</h3>
      <div class="ui calendar" id="calendar2"></div>
    </div>
    <div class="col">
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
    onChange: function() {
      $('#calendar1').calendar('refresh');
      $('#calendar2').calendar('refresh');

      var date1 = $('#calendar1').calendar('get date');
      var date2 = $('#calendar2').calendar('get date');

      if (verifDates(date1, date2)) {
        $.ajax({
          method: 'POST',
          url: '/ajax/stats/req/ele_inscrit_test.php',
          data: {
            diff: getDayDiff(date1, date2),
            date: date1
          },
          success: function(data) {
            console.log(data);
          }
        });
      }
      
    }
  });
  
}

loadCalender('calendar1');
loadCalender('calendar2', maxDate);

$('#calendar1').calendar('set date', minDate, updateInput = false, fireChange = true);
$('#calendar2').calendar('set date', maxDate, updateInput = false, fireChange = true);

function getDayGiff(date1, date2) {
  return date1.diff(date2,'days');
}

function verifDates(date1, date2) {
  return moment(date1).isBefore(date2);
}

</script>
