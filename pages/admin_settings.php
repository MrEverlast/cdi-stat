<h2 class="ui dividing header">
  <i class="icon setting"></i>Paramètres
</h2>
<div class="ui segment basic">
  <button id="req_year_create" class="ui button primary"><i class="icon add "></i>Ajouter une nouvelle année</button>
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

</script>