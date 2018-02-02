<h2 class="ui dividing header">
  <i class="icon setting"></i>Paramètres
</h2>
    <div class="row">
      <div class="ui segment basic">
        <button id="req_year_create" class="ui button primary"><i class="icon add "></i>Ajouter une nouvelle année</button>
      </div>
    </div>
<div class="ui container fluid">
  <div class="ui equal width grid padded">
    <div class="row" >

        <div class="column" > 
          <h3>
            Gestion de mot de passe
          </h3>
          <div class="ui form" id="form_mdp">
            <div class="row">
                    <div class="field">
                      <label>Mot de passe actuel</label>
                      <input id="id_mdpactuel" placeholder="" type="password">
                    </div>
            </div>
            <div class="row">
                    <div class="field">
                      <label>Nouveau mot de passe</label>
                      <input id="id_newmdp" placeholder="" type="password">
                    </div>
            </div>
            <div class="row">
                    <div class="field">
                      <label>Confirmation du nouveau mot de passe</label>
                      <input id="id_confirm_newmdp" placeholder="" type="password">
                    </div>
            </div>
            <div class="ui success message">
                    <p>Le mot de passe a bien été changé.</p>
            </div>
            <div class="row">
                    <button id="btn_modifmdp" class="ui button primary myTrigger">Modifier</button>
            </div>
          </div>
        </div>

       
        <div class="column">
          <h3>
             Planning
          </h3> 
            <div class="ui equal width grid padded">
              <div class="row" >
                <div class="column" >
                  <div class="ui form">           
                    <div class="grouped fields">
                      <?php
                                $semaine= array(
                                      0 => "Lundi",
                                      1 => "Mardi",
                                      2 => "Mercredi",
                                      3 => "Jeudi",
                                      4 => "Vendredi",
                                      5 => "Samedi",
                                      6 => "Dimanche"
                                );

                                for($i = 0; $i<7;$i++){
                                  ?>
                                  <div class="field">
                                    <div class="ui radio checkbox">
                                      <input name="frequency" checked="checked" type="radio">
                                      <label><?= $semaine[$i]; ?></label>
                                    </div>
                                  </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>

                <div class="column">
                  <label> Matin</label>

                  <div class="field">     
                      <div class="ui calendar" id="horaireMatin1">
                          <div class="ui input left icon">
                              <i class="calendar icon"></i>
                              <input id='horaireMatin1' type="text" placeholder="hh:mm" readonly="true">
                          </div>
                      </div>
                  </div>

                  <div class="field">     
                      <div class="ui calendar" id="horaireMatin2">
                          <div class="ui input left icon">
                              <i class="calendar icon"></i>
                              <input id='horaireMatin2' type="text" placeholder="hh:mm" readonly="true">
                          </div>
                      </div>
                  </div>

                  <label> Après midi</label>

                  <div class="field">     
                      <div class="ui calendar" id="horaireAprem1">
                          <div class="ui input left icon">
                              <i class="calendar icon"></i>
                              <input id='horaireAprem1' type="text" placeholder="hh:mm" readonly="true">
                          </div>
                      </div>
                  </div>

                  <div class="field">     
                      <div class="ui calendar" id="horaireAprem2">
                          <div class="ui input left icon">
                              <i class="calendar icon"></i>
                              <input id='horaireAprem2' type="text" placeholder="hh:mm" readonly="true">
                          </div>
                      </div>
                  </div>




                </div>
              </div>      
            </div>
        </div>
    </div>      
  </div>
</div>

<?php include_once $_DIR.'/ajax/imp.php'; ?>

<script type="text/javascript">
  $(document).on('click','#req_year_create',function() {
  	goToModal(0);
  	var error = $('#modal_year .message.error');
  	var next = $('#next');
  	var previous = $('#previous');
  	
  	error.removeClass("hidden");
  	next.addClass("disabled");
  	previous.addClass("disabled");

    $("#modal_year").modal({
      closable: false,
      transition : 'fade up',
      onDeny    : function(){
      }
    }).modal('show');
  });


// ----------------------------------------

// Open file selector on div click
$(document).on('click', '#uploadfile', function() {
  $("#file").click();
});

// file selected
$(document).on('change', '#file', function(){ 
  var error = $('#modal_year .message.error');
  var next = $('#next');
  var previous = $('#previous');

  var file = $("#file")[0].files[0];

  if (checkFile(file)) {
    $("h3").text(file.name);
    error.addClass("hidden");
    next.removeClass("disabled");
  	previous.addClass("disabled");
  } else {
    error.removeClass("hidden");
    next.addClass("disabled");
  	previous.addClass("disabled");
  }
});

$(document).on('click', '#next', function() {
  var modal = $('#modal_year').attr('data-page');
  var next = $('#next');
  var previous = $('#previous');
  var fade = 'left';
  $("#modal_year").modal('setting', 'transition', 'fade right');
  next.removeClass("disabled");
  previous.removeClass("disabled");

	switch(modal) {
	  case '0':
	  	modal++;
		  var file = $('#file')[0].files[0];
		  var post = loadFile(file);
      next.removeClass("disabled");
      previous.addClass("disabled");
		  if (post) {
		    uploadFile(post);
		  }
	    break;

    case '4':
      modal++;
      next.addClass("disabled");
      changeStatus(modal,fade);
      break;

    case '5':
      importBDD();
      break;

	  default:
      modal++;   
      changeStatus(modal, fade);
	    break;
	}

});

$(document).on('keyup', '#bddName', function(e) {
  var next = $("#next");
  if ($(this)["0"].value.length > 4) {
    next.html("Importer<i class=\"icon chevron right\"></i>");
    next.removeClass("disabled");
  } else {
    next.addClass("disabled");
  }
});

function importBDD() {
  var bddName = $("#bddName")["0"].value;
  var mContent = $("#modal_year .content");
  var cancel = $("#cancel");
  var next = $('#next');
  bddName = bddName.toLowerCase();
  
  if (testBddName(bddName)) {
    mContent.html('<div class="ui active inverted dimmer" style="max-height: calc(100% - 64px);"><div class="ui text loader">Importation de la base de données cela peut prendre plusieurs minutes.</div></div>');
    next.addClass("disabled");
    $.ajax({
      method: 'POST',
      url: '/ajax/imp/req/submit.php',
      data: {
        bddName: bddName
      },
      success: function(data) {
        $.ajax({
          method: 'POST',
          url: '/ajax/imp/content/success.php',
          success: function(data) {
            mContent.html(data);
          }
        });
        cancel.html("<i class=\"icon delete\"></i>Quitter")
      }
    });
  } else {
    alert("Nom de base de données non conforme.");
  }

}

function testBddName(str) {
  var filter = /^([a-z0-9_-]{3,20})+$/;
  return (filter.test(str));
}

$(document).on('click', '#previous', function() {
  var modal = $('#modal_year').attr('data-page');
  var next = $('#next');
  var previous = $('#previous');
  var fade = 'right';
  $("#modal_year").modal('setting', 'transition', 'fade left');
  next.removeClass("disabled");
  previous.removeClass("disabled");

  switch(modal) {

    case '2':
      modal--;
      goToModal(modal, fade);
      next.removeClass("disabled");
      previous.addClass("disabled");
      break;

    default:
      modal--;
      goToModal(modal, fade);
      break;
  }
});

function changeStatus(modal, fade) {
  var checkbox = $(".collapsing.ui.checkbox");
  var selected = [];
  var mContent = $("#modal_year .content.scrolling");
  mContent.html('<div class="ui active inverted dimmer" style="max-height: calc(100% - 64px);"><div class="ui text loader">Loading</div></div>');
  for(var i=0; i<checkbox.length; i++) {
    classes = checkbox[i].className.split(" ");
    if (-1 != $.inArray("checked", classes)) {
      selected[i] = true;
    } else {
      selected[i] = false;
    }
  }
  selected = JSON.stringify(selected);
  $.ajax({
    method: 'POST',
    url: '/ajax/imp/req/modal.php',
    data: {
      modal: modal,
      selected: selected
    },
    success: function() {
      goToModal(modal, fade);
    }
  });
}

function goToModal(modal, fade) {
	var mContent = $("#modal_year .content");
	var m = $("#modal_year");
  $("#next").html("Suivant<i class=\"icon chevron right\"></i>");
  m.modal('hide');
  m.modal('setting', 'transition', 'fade ' + fade);
	if (modal > 0) {
		setTimeout(function() {
			$.ajax({
		    method: 'POST',
        url: '/ajax/imp/modal.php',
        data : {
          modal: modal
        },
		    success: function(data) {
		      mContent.html(data);
		      m.attr('data-page',modal);
          setTimeout(function() {
            m.modal('show');
            $('.ui.checkbox').checkbox();
          },200);
		    }
		  });
		},200);
	} else {
		$.ajax({
	    method: 'POST',
	    url: '/ajax/imp/modal'+modal+'.php',
	    success: function(data) {
	      mContent.html(data);
	      m.attr('data-page',modal);
	    }
	  });
	}
}

function loadFile(file) {
  var formdata = new FormData();
  if (checkFile(file)) {
    formdata.append('file',file);
    return formdata;
  } else {
    alert("Il faut un fichier .csv");
    return false;
  }
}

function uploadFile(formdata) {
  var mContent = $("#modal_year .content.scrolling");
  mContent.html('<div class="ui active inverted dimmer" style="max-height: calc(100% - 64px);"><div class="ui text loader">Loading</div></div>');
  $.ajax({
    method : 'POST',
    url: '/ajax/file_csv.php',
    data: formdata,
    contentType: false,
    processData: false,
    success: function(data) {
      goToModal(1, 'left');
    }
  });
}

function checkFile(file) {
  var ext = file.name.slice((file.name.lastIndexOf(".") - 1 >>> 0) + 2);
  return ext === "csv";
}

//------------CALENDAR------------//
function loadHoraire(id){

    $('#'+id).calendar({
          ampm: false,
          type: 'time',
          monthFirst: false,
          formatter: {
 
              time: function (date,settings, forCalendar){
                if (!date) {
                  return '';
                }
                  if((date.getHours())<10){
                    var hourJ = date.getHours();
                    var hour ="0"+hourJ;
                  }else{
                    var hour =date.getHours();
                  }

                var minute = date.getMinutes();
                var ampm = '';
                if (settings.ampm) {
                  ampm = ' ' + (hour < 12 ? settings.text.am : settings.text.pm);
                  hour = hour === 0 ? 12 : hour > 12 ? hour - 12 : hour;
                }
              return hour + ':' + (minute < 10 ? '0' : '') + minute + ampm;
                

              }
          }
    });
}

var tabIdHoraire = ['horaireMatin1','horaireMatin2','horaireAprem1','horaireAprem2'];
for(var i=0;i<4;i++){
  loadHoraire(tabIdHoraire[i]);
  
}
</script>