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

 // preventing page from redirecting
 $("html").on("dragover", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $("h3").text("Drag here");
 });

 $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });


 $(function() {

  // preventing page from redirecting
  $("html").on("dragover", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $("h3").text("Drag here");
  });

  $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

  // Drag enter
  $('.upload-area').on('dragenter', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $("h3").text("Drop");
  });

  // Drag over
  $('.upload-area').on('dragover', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $("h3").text("Drop");
  });

  // Drop
  $('.upload-area').on('drop', function (e) {
    e.stopPropagation();
    e.preventDefault();


    var file = e.originalEvent.dataTransfer.files;
    $("#file").files = file;

    console.log($("#file"));
    console.log(file[0]);
    console.log($("#file").files);
    
    var error = $('#modal_year .message.error');
    

    if (checkFile(file)) {
      $("h3").text(file.name);
      error.addClass("hidden");
      next();
    } else {
      error.removeClass("hidden");
      $("#next").addClass("disabled");
    }


  });

  // Open file selector on div click
  $("#uploadfile").click(function(){
    $("#file").click();
  });

  // file selected
  $("#file").change(function(){ 
    var error = $('#modal_year .message.error');   
    var file = $("#file")[0].files[0];

    console.log(file);

    if (checkFile(file)) {
      $("h3").text(file.name);
      error.addClass("hidden");
      next();
    } else {
      error.removeClass("hidden");
      $("#next").addClass("disabled");
    }
  });
});

$(document).on('click', '#next', function() {
  
  var file = $('#file')[0].files[0];
  var post = loadFile(file);

  if (post) {
    uploadFile(post);
  }

  var modal = 1;

  goToModal(modal);
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
  //console.log(formdata);
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

// Added thumbnail
function addThumbnail(data){
  $("#uploadfile h1").remove(); 
  var len = $("#uploadfile div.thumbnail").length;

  var num = Number(len);
  num = num + 1;

  var name = data.name;
  var size = convertSize(data.size);
  var src = data.src;

  // Creating an thumbnail
  $("#uploadfile").append('<div id="thumbnail_'+num+'" class="thumbnail"></div>');
  $("#thumbnail_"+num).append('<img src="'+src+'" width="100%" height="78%">');
  $("#thumbnail_"+num).append('<span class="size">'+size+'<span>');

}

// Bytes conversion
function convertSize(size) {
  var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
  if (size == 0) return '0 Byte';
  var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
  return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
</script>