<div class="ui basic segment">
  <h2 class="ui dividing header">
    <i class="icon setting"></i>Paramètres
  </h2>

<button id="req_year_create" class="ui button primary"><i class="icon add "></i>Ajouter une nouvelle année</button>

<?php include_once $_DIR.'/ajax/imp.php'; ?>

</div>
<script type="text/javascript">
  $(document).on('click','#req_year_create',function() {
    $("#modal_year").modal({
      closable: false,
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
  $("#uploadfile").click(function(){
    $("#file").click();
  });

  // file selected
  $("#file").change(function(){ 
    var error = $('#modal_year .message.error');   
    var file = $("#file")[0].files[0];

    if (checkFile(file)) {
      $("h3").text(file.name);
      error.addClass("hidden");
      next();
    } else {
      error.removeClass("hidden");
      $("#next").addClass("disabled");
    }
  });

$(document).on('click', '#next', function() {
  
  var file = $('#file')[0].files[0];
  var post = loadFile(file);

  if (post) {
    uploadFile(post);
    var modal = 1;
  	goToModal(modal);
  } 

});

function goToModal(modal) {
  $.ajax({
    method: 'POST',
    url: '/ajax/imp/modal'+modal+'.php',
    success: function(data) {
      $("#modal_year .content").html(data);
    }
  })
}

function next() {
  $('#next').removeClass("disabled");
}

function loadFile(file) {
  var fd = new FormData();
  if (checkFile(file)) {
    fd.append('file',file);
    return fd;
  } else {
    alert("Il faut un fichier .csv");
    return false;
  }

}

function uploadFile(formdata) {
  $.ajax({
    url: '/ajax/file_csv.php',
    type : 'post',
    data: formdata,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(response){
      console.log(response);
    }
  });
}

function checkFile(file) {
  var ext = file.name.slice((file.name.lastIndexOf(".") - 1 >>> 0) + 2);
  return ext === "csv";
}

</script>