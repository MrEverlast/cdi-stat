<div class="ui basic segment">
	<h2 class="ui dividing header">
		<i class="icon setting"></i>Paramètres
	</h2>

<button id="req_year_create" class="ui button primary"><i class="icon add	"></i>Ajouter une nouvelle année</button>

<div id="modal_year" class="ui modal">

	<div class="content">
		<div class="container" >
      <input type="file" name="file" id="file" accept=".csv">
      
      <!-- Drag and Drop container-->
      <div class="upload-area"  id="uploadfile">
        <h3>Cliquez pour importer le fichier .csv</h3>
        <div class="ui horizontal divider">OU</div>
        <h3>Glissez déposez le fichier .csv</h3>
      </div>
    </div>
	</div>

	<div class="actions">
		<button class="ui button cancel red"><i class="icon delete"></i>Annuler</button>
		<button class="ui button disabled"><i class="icon chevron left"></i>Précédent</button>
		<button id="next" class="ui button disabled">Suivant<i class="icon chevron right"></i></button>
	</div>

</div>
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

    $("h3").text("Upload");

    var file = e.originalEvent.dataTransfer.files;
    var fd = new FormData();
    file = file[0];

    $('#file')[0].files[0] = file;

    if (checkFile(file)) {

      fd.append('file',file);

      next();

    } else {
      alert("Il faut un fichier .csv");
    }
    

    //uploadData(fd);
  });

  // Open file selector on div click
  $("#uploadfile").click(function(){
    $("#file").click();
  });

  // file selected
  $("#file").change(function(){
    var fd = new FormData();

    var file = $('#file')[0].files[0];
    
    if (checkFile(file)) {

      fd.append('file',file);

      next();

    } else {
      alert("Il faut un fichier .csv");
    }

  });
});

$(document).on('click', '#next', function() {
  var fd = new FormData();
  var file = $('#file')[0].files[0];
  fd.append('file',file);
  
  uploadFile(fd);
});

function next() {
  $('#next').removeClass("disabled");
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