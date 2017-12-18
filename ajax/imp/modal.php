<?php 
  $_DIR = $_SERVER['DOCUMENT_ROOT']; 
  $_MODAL = $_POST['modal'] - 1;
  $class_name = ['Seconde','Première','Terminale','BTS'];

  if ($_MODAL >= 0 && $_MODAL <= 3){
  ?>

<h2 class="ui header">
  Sélectionnez
  <div class="sub header">Les classes de <b><?php echo $class_name[$_MODAL]; ?></b>.</div>
</h2>

<div class="ui container">

  <table class="ui very compact table">
  <thead>
    <tr>
      <th>Nom de la classe</th>
    </tr>
  </thead>
  <tbody>
    <?php include_once $_DIR.'/ajax/imp/content/list.php'; ?>
  </tbody>
</table>
</div>

<?php 
} elseif ($_MODAL == 4) {
  include_once $_DIR.'/ajax/imp/content/color.php';

  ?>

<script type="text/javascript">
  var colors = [
    'EB0000','D70000','C30000','AF0000','9B0000','870000','730000','5F0000','4B0000','370000',
    'EBEB00','D7D700','C3C300','AFAF00','9B9B00','878700','737300','5F5F00','4B4B00','373700',
    '00EB00','00D700','00C300','00AF00','009B00','008700','007300','005F00','004B00','003700',
    '00EBEB','00D7D7','00C3C3','00AFAF','009B9B','008787','007373','005F5F','004B4B','003737',
    '0000EB','0000D7','0000C3','0000AF','00009B','000087','000073','00005F','00004B','000037',
    'EB00EB','D700D7','C300C3','AF00AF','9B009B','870087','730073','5F005F','4B004B','370037',
  ], box;

  var picker = new Array(
    new CP(document.querySelector('#color0')),
    new CP(document.querySelector('#color1')),
    new CP(document.querySelector('#color2')),
    new CP(document.querySelector('#color3'))
    );

    for (var j = 0, len = colors.length; j < len; ++j) {
        box = document.createElement('span');
        box.className = 'color-picker-box';
        box.title = '#' +   [j];
        box.style.backgroundColor = '#' + colors[j];
        box.addEventListener("click", function(e) {
            picker[0].set(this.title);
            picker[0].trigger("change", [this.title.slice(1)], 'color0');
            e.stopPropagation();
        }, false);
        picker[0].picker.firstChild.appendChild(box);
    }

    for (var j = 0, len = colors.length; j < len; ++j) {
        box = document.createElement('span');
        box.className = 'color-picker-box';
        box.title = '#' + colors[j];
        box.style.backgroundColor = '#' + colors[j];
        box.addEventListener("click", function(e) {
            picker[1].set(this.title);
            picker[1].trigger("change", [this.title.slice(1)], 'color1');
            e.stopPropagation();
        }, false);
        picker[1].picker.firstChild.appendChild(box);
    }

    for (var j = 0, len = colors.length; j < len; ++j) {
        box = document.createElement('span');
        box.className = 'color-picker-box';
        box.title = '#' + colors[j];
        box.style.backgroundColor = '#' + colors[j];
        box.addEventListener("click", function(e) {
            picker[2].set(this.title);
            picker[2].trigger("change", [this.title.slice(1)], 'color2');
            e.stopPropagation();
        }, false);
        picker[2].picker.firstChild.appendChild(box);
    }

    for (var j = 0, len = colors.length; j < len; ++j) {
        box = document.createElement('span');
        box.className = 'color-picker-box';
        box.title = '#' + colors[j];
        box.style.backgroundColor = '#' + colors[j];
        box.addEventListener("click", function(e) {
            picker[3].set(this.title);
            picker[3].trigger("change", [this.title.slice(1)], 'color3');
            e.stopPropagation();
        }, false);
        picker[3].picker.firstChild.appendChild(box);
    }

    picker[0].on("change", function(color) {
        $("#color0").css('background-color', '#'+color)
    }, 'color0');

    picker[1].on("change", function(color) {
        $("#color1").css('background-color', '#'+color)
    }, 'color1');

    picker[2].on("change", function(color) {
        $("#color2").css('background-color', '#'+color)
    }, 'color2');

    picker[3].on("change", function(color) {
        $("#color3").css('background-color', '#'+color)
    }, 'color3');

    var color = [
      'D70000', '00D700', 'D700D7', '0000D7'
    ];

    setTimeout(function() {
      for (var i = 0; i < picker.length; i++) {
        picker[i].trigger("change", [color[i]], 'color'+i);
      }
    },500);

</script>

<?php
} elseif ($_MODAL == 5) {
  include_once $_DIR.'/ajax/imp/content/submit.php';
}
  ?>