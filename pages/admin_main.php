<h2 class="ui dividing header">
  <i class="icon bar chart"></i>Main
</h2>
<script type="text/javascript">
$(document).ready(function() {
  var ctx = document.getElementById("myChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    fillColor: "rgba(220,220,220,0.5)",
    strokeColor: "rgba(220,220,220,0.8)",
    highlightFill: "rgba(220,220,220,0.75)",
    highlightStroke: "rgba(220,220,220,1)",
    data: [20, 10],
    options: { scales: {} }
  });





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

    });
</script>
<div class="ui container" style="heigh=400px;">
  <canvas id="myChart"></canvas>
</div>