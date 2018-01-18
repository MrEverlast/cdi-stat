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
            <th>Name</th>
            <th>Status</th>
            <th>Another Status</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            for ($i=1; $i <= 4; $i++) { 
              
              $req = "SELECT *, NOW(), CURRENT_TIME 
                      FROM `t_registration` AS A
                      INNER JOIN `t_eleve` AS B ON A.id_eleve = B.id
                      WHERE NOW() < ADDDATE(`date_create`, INTERVAL $i HOUR) AND `duration` = $i";
              $statement = $bdd->requeteBDD($req);
              while ($data = $statement->fetch()) {
                echo "<tr>";
                echo "<td>".$data['last_name']."</td>";
                echo "<td>".$data['first_name']."</td>";
                echo "<td>".$data['date_create']."</td>";
                echo "<td>".$data['duration']."</td>";
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
var config = {
  type: 'pie',
  data: {
    datasets: [{
      data: [
        0,
        12,
        122,
        51
      ],
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

window.onload = function() {
  var ctx = $("#myChart");
  window.myPie = new Chart(ctx, config);
};






// $(document).ready(function() {
//   var ctx = document.getElementById("myChart");
//   var myBarChart = new Chart(ctx, {
//     type: 'bar',
//     data: {

//       labels: ['Italy', 'UK', 'USA', 'Germany', 'France', 'Japan'],
//       datasets: [
//         {
//           label: '2010 customers #',
//           fillColor: '#382765',
//           data: [2500, 1902, 1041, 610, 1245, 952]
//         },
//         {
//           label: '2014 customers #',
//           fillColor: '#7BC225',
//           data: [3104, 1689, 1318, 589, 1199, 1436]
//         }
//       ]
//     }
//   });





//   var myChart = new Chart(ctx, {
//       type: 'bar',
//       data: {
//           labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//           datasets: [{
//               label: '# of Votes',
//               data: [10,12,115,30,25],
//               backgroundColor: [
//                   'rgba(255, 99, 132, 0.2)',
//                   'rgba(54, 162, 235, 0.2)',
//                   'rgba(255, 206, 86, 0.2)',
//                   'rgba(75, 192, 192, 0.2)',
//                   'rgba(153, 102, 255, 0.2)',
//                   'rgba(255, 159, 64, 0.2)'
//               ],
//               borderColor: [
//                   'rgba(255,99,132,1)',
//                   'rgba(54, 162, 235, 1)',
//                   'rgba(255, 206, 86, 1)',
//                   'rgba(75, 192, 192, 1)',
//                   'rgba(153, 102, 255, 1)',
//                   'rgba(255, 159, 64, 1)'
//               ],
//               borderWidth: 1
//           },{
//             fillColor: "rgba(220,220,220,0.5)",
//             strokeColor: "rgba(220,220,220,0.8)",
//             highlightFill: "rgba(220,220,220,0.75)",
//             highlightStroke: "rgba(220,220,220,1)",
//             yAxesGroup: "main",
//             data: [10,14,50,15,60],
//         }]
//       },
//       options: {
//            scales: {
//             xAxes: [{
//                 stacked: true
//             }],
//             yAxes: [{
//                 stacked: true
//             }]
//         }
//       }
//   });

//    });
</script>
