<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$type = $_POST['type']; 
if ($type === "create") $title = "Créer";
if ($type === "edit") $title = "Modifier";
if ($type === "delete") $title = "Supprimer";
$genre="une activité";
?>
<i class="close icon"></i>
<div class="header">
  <?php echo $title." ".$genre; ?>
</div>

<?php include_once $_DIR.'/ajax/content/act/'.$type.'.php'; ?>

<div class="actions">
  <div class="ui primary button" data-submit="<?php echo 'req_act_'.$type; ?>"><?php echo $title; ?></div>
</div>

<?php include_once $_DIR.'/ajax/content/supprimer.php'; ?>

