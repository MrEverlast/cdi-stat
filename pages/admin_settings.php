<div class="ui basic segment">
  <h2 class="ui dividing header">
    <i class="icon setting"></i>Paramètres
  </h2>
  <div class="ui segment basic">
	  <button id="req_year_create" class="ui button primary"><i class="icon add "></i>Ajouter une nouvelle année</button>
  </div>

	<?php include_once $_DIR.'/ajax/imp.php'; ?>

</div>
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

    case '5':
      modal++;
      addColorClass(modal, fade);
      break;


	  default:
      modal++;   
      changeStatus(modal);
      goToModal(modal, fade);
	    break;
	}

});


function addColorClass(modal, fade) {
  var color = [
    $('#color0').css('backgroundColor'),
    $('#color1').css('backgroundColor'),
    $('#color2').css('backgroundColor'),
    $('#color3').css('backgroundColor')
  ];
  color = JSON.stringify(color);
  $.ajax({
    method: 'POST',
    url: '/ajax/imp/req/addColor.php',
    data: {
      color: color
    },
    success: function() {
      goToModal(modal, fade);
    }
  });
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

function changeStatus(modal) {
  var checkbox = $(".collapsing.ui.checkbox");
  var selected = [];
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
    }
  });
}

function goToModal(modal, fade) {
	var mContent = $("#modal_year .content");
	var m = $("#modal_year");
	if (modal > 0) {
		m.modal('hide');
		m.modal('setting', 'transition', 'fade ' + fade);
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
		    }
		  });
			setTimeout(function() {
				m.modal('show');
				$('.ui.checkbox').checkbox();
			},200);
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
  var mContent = $("#modal_year .content");
  mContent.html('<img src="https://i.stack.imgur.com/ATB3o.gif">');
  $.ajax({
    method : 'POST',
    url: '/ajax/file_csv.php',
    data: formdata,
    contentType: false,
    processData: false,
    success: function(data) {
      goToModal(1, 'right');
    }
  });
}

function checkFile(file) {
  var ext = file.name.slice((file.name.lastIndexOf(".") - 1 >>> 0) + 2);
  return ext === "csv";
}

</script>

