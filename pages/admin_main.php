<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Main
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
            <th>Prenom</th>
            <th>Heure d'arrivé</th>
            <th>Temps</th>
            <th>Activité</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            for ($i=1; $i <= 4; $i++) { 
              
              $req = "SELECT A.date_create, A.duration, B.last_name, B.first_name, C.name
                      FROM `t_registration` AS A
                      INNER JOIN `t_eleve` AS B ON A.`id_eleve` = B.`id`
                      INNER JOIN `t_activity` AS C ON A.`id_activity` = C.`id`
                      WHERE NOW() < ADDDATE(A.`date_create`, INTERVAL $i HOUR) AND A.`duration` = $i";

              $statement = $bdd->requeteBDD($req);
              while ($data = $statement->fetch()) {
                $date = new DateTime($data['date_create']);
                $date = $date->getTimestamp();
                echo "<tr>";
                echo "<td>".$data['last_name']."</td>";
                echo "<td>".$data['first_name']."</td>";
                echo "<td>".date("H:i:s", $date)."</td>";
                echo "<td>".$data['duration']."h</td>";
                echo "<td>".$data['name']."</td>";
                echo "<tr>";
              }
            }
          ?>
        </tbody>
      </table>
    </div>
    <div class="column six wide">
      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>

<script type="text/javascript">
var nbEleve = [];
 $.ajax({
  method: 'POST',
  url: '/ajax/main/req/pie.php',
  success: function(obj) {
    obj = JSON.parse(obj);
    for (elem in obj) {
       nbEleve.push(obj[elem]);
    }
    console.log(nbEleve);
    config = pie(nbEleve);

    var ctx = $("#myChart");
    window.myPie = new Chart(ctx, config);
  }
});
    
function pie(nbEleve) {
  var test = {
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
  return test;
  
}

</script>
