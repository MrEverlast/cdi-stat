<div class="ui basic segment">
  <h2 class="ui dividing header">
    <i class="icon setting"></i>Paramètres
  </h2>

	<button id="req_year_create" class="ui button primary"><i class="icon add "></i>Ajouter une nouvelle année</button>

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
      },
      onApprove : function() {
        window.alert('Approved!');
        return false;
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
	switch(modal) {
	  case '0':
	  	modal++;
		  var file = $('#file')[0].files[0];
		  var post = loadFile(file);

		  if (post) {
		  	$("#modal_year").modal('setting', 'transition', 'fade right');
		    uploadFile(post);
		  	goToModal(modal);
		  }
	    break;
	  case '1':
	    break;
	}

});

function goToModal(modal) {
	console.log('goToModal --> ' + modal);
	var mContent = $("#modal_year .content");
	var m = $("#modal_year");
	if (modal > 0) {
		m.modal('hide');
		m.modal('setting', 'transition', 'fade left');
		setTimeout(function() {
			$.ajax({
		    method: 'POST',
		    url: '/ajax/imp/modal'+modal+'.php',
		    success: function(data) {
		      mContent.html(data);
		      m.attr('data-page',modal);
		    }
		  });
			setTimeout(function() {
				m.modal('show');
				$('.ui.checkbox').checkbox();
			},100);
		},225);
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
  $.ajax({
    method : 'POST',
    url: '/ajax/file_csv.php',
    data: formdata,
    contentType: false,
    processData: false,
    dataType: 'json'
  });
}

function checkFile(file) {
  var ext = file.name.slice((file.name.lastIndexOf(".") - 1 >>> 0) + 2);
  return ext === "csv";
}

</script>