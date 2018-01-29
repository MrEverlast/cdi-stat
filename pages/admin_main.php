<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Accueil
</h2>

<div class="ui padded grid">
  <div class="row">
    <div class="column ten wide">
      <h3>List des élèves présent</h3>
    </div>
    <div class="column six wide">
      <h3>Repartition des niveaux</h3>
    </div>
  </div>
  <div class="row">
    <div class="column ten wide">
      <table class="ui very compact table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Classe</th>
            <th>Heure d'arrivé</th>
            <th>Temps</th>
            <th>Activité</th>
          </tr>
        </thead>
        <tbody id="tList">

        </tbody>
      </table>
    </div>
    <div class="column six wide">
      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>

<script type="text/javascript">

setInterval(function() {
  loadPie();
  loadList();
},300000);

$(document).ready(function() {
  loadPie();
  loadList();
});

function loadList() {
  var list = $("#tList");
  $.ajax({
    method: 'POST',
    url: '/ajax/main/req/listEleve.php',
    success: function(data) {
      list.html(data);
    }
  });
}

function loadPie() {
  var nbEleve = [];
  if (window.myPie)
    window.myPie.destroy(); 
  $.ajax({
    method: 'POST',
    url: '/ajax/main/req/pie.php',
    success: function(obj) {
      obj = JSON.parse(obj);
      for (elem in obj) {
        nbEleve.push(obj[elem]);
      }
      config = pie(nbEleve);

      var ctx = $("#myChart");
      window.myPie = new Chart(ctx, config);
    }
  });
}
    
function pie(nbEleve) {
  var config = {
    type: 'pie',
    data: {
      datasets: [{
        data: nbEleve,
        backgroundColor: [
          "#EBEB00A0",
          "#00D700A0",
          "#D70000A0",
          "#0000D7A0",
        ],
        hoverBackgroundColor: [
          "#EBEB00B0",
          "#00D700B0",
          "#D70000B0",
          "#0000D7B0",
        ],
        label: 'Dataset 1'
      }],
      labels: [
        "Seconde",
        "Premi\u00e8re",
        "Terminale",
        "BTS"
      ]
    },
    options: {
      responsive: true
    }
  };
  return config;
  
}

</script>
