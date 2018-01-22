$(document).ready(function() {
  $(document).on("click", "#print", function() {
    PU1=window.open('/print.php','Win1', 'width=900,height=600');
    PU1.window.print();
  });
});