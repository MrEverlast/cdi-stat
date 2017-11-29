$(document).ready(function() {
  // trigger button create/edit/suppr
  $(document).on("click", ".myTrigger", function() {
    loadModal($(this));
    setTimeout(function() {
      $('select.dropdown').dropdown();
      $('.ui.radio.checkbox').checkbox();
    },150);
  
  });
});

// Afficher le contenue d'un modal
// ex: btn 'act_create' -> ajax/activity.php
// res[0] = act; res[1] = create;
function loadModal(object) {
  var res = testType(object,'id'); // Récuperation du fichier à ouvrir
  
  $.ajax({
    method: "POST",
    url: "/ajax/"+res[0]+".php",
    data: { 
      type: res[1]
    },
    success: function(data) {
      $('#modal_main').html(data);
    }
  });
  // Évite le problème de positionnement
  setTimeout(function() {
    $('#modal_main').modal({
      onShow: function() {
        if (res[1] !== 'delete') {
          loadColor();
        }
      },
      onHidden: function() {
        $('.color-picker').html("");
      }
    }).modal('show');
  },150);
}

// Transform un string en un tableau de string
function testType(object, attr) {
  var str = object.attr(attr);
  return str.split("_");
}

// Button modal requete sql 
// => Modif la BDD
$(document).on('click','[data-submit]',function() {
  // targetDir sous la forme 'req_act_create'
  // /req/act/create.php
  var targetDir = $(this).attr('data-submit');

  var name = $('#name').val();
  var color = $('#color').css('backgroundColor');
  var type = $('#checkbox_grp').is(':checked');
  var idActivity = $("#id_activity").val();
  if (color != undefined) {
    color = rgb2hex(color);
  }

  var target = targetDir.split("_");
  if(target[2] == "delete") {
    $('#modal_del').modal({
      onApprove : function() {
        query(targetDir,name,color,type,idActivity);
        window.location.reload();
      }
    }).modal('show');
  } else {
    query(targetDir,name,color,type,idActivity);
  } 

});

function query(targetDir,name,color,type,idActivity) {
  $.ajax({
    method: "POST",
    url: "/ajax/query.php",
    data: { 
      targetDir: targetDir,
      type: type,
      color: color,
      name: name,
      idActivity: idActivity
    }
  });
}

// Transforme une couleur RGB en Hex
// rgb(255,255,255) -> #FFFFFF
function rgb2hex(rgb) {
    if (/^#[0-9A-F]{6}$/i.test(rgb)) return rgb;

    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function loadColor() {
  var colors = [
    'EB0000','D70000','C30000','AF0000','9B0000','870000','730000','5F0000','4B0000','370000',
    'EBEB00','D7D700','C3C300','AFAF00','9B9B00','878700','737300','5F5F00','4B4B00','373700',
    '00EB00','00D700','00C300','00AF00','009B00','008700','007300','005F00','004B00','003700',
    '00EBEB','00D7D7','00C3C3','00AFAF','009B9B','008787','007373','005F5F','004B4B','003737',
    '0000EB','0000D7','0000C3','0000AF','00009B','000087','000073','00005F','00004B','000037',
    'EB00EB','D700D7','C300C3','AF00AF','9B009B','870087','730073','5F005F','4B004B','370037',
  ], box;

  var picker = new CP(document.querySelector('#color'));
  picker.on("change", function(color) {
      $("#color").css('background-color', '#'+color)
  }, 'main-change');

  for (var i = 0, len = colors.length; i < len; ++i) {
    box = document.createElement('span');
    box.className = 'color-picker-box';
    box.title = '#' + colors[i];
    box.style.backgroundColor = '#' + colors[i];
    box.addEventListener("click", function(e) {
        picker.set(this.title);
        picker.trigger("change", [this.title.slice(1)], 'main-change');
        e.stopPropagation();
    }, false);
    picker.picker.firstChild.appendChild(box);
  }
}