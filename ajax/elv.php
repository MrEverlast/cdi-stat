<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$type = $_POST['type']; 
if ($type === "create") $title = "Créer";
if ($type === "edit") $title = "Modifier";
if ($type === "delete") $title = "Supprimer";
$genre="un élève";
?>
<i class="close icon"></i>
<div class="header">
  <?php echo $title." ".$genre; ?>
</div>

<?php include_once $_DIR.'/ajax/content/elv/'.$type.'.php'; ?>

<div class="actions">
  <div class="ui primary button" data-submit="<?php echo 'req_elv_'.$type; ?>"><?php echo $title; ?></div>
</div>

<?php include_once $_DIR.'/ajax/content/supprimer.php'; ?>

