<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$type = $_POST['type']; 
if ($type === "create") $title = "Créer";
if ($type === "edit") $title = "Modifier";
if ($type === "delete") $title = "Supprimer";
?>
<i class="close icon"></i>
<div class="header">
  <?php echo $title." activité"; ?>
</div>

<?php include_once $_DIR.'/ajax/content/act/'.$type.'.php'; ?>

<div class="actions">
  <div class="ui primary button" data-submit="<?php echo 'req_act_'.$type; ?>"><?php echo $title; ?></div>
</div>

<div id="modal_del" class="ui modal mini">
  <div class="header">
    <?php echo $title; ?>
  </div>
  <div class="content">
    <p>Etes-vous sur de vouloir supprimer cette activité?</p>
    <p>Supprimer une activité peut engendrer la perte de stat</p>
  </div>
  <div class="actions">
    <div class="ui negative button">
      No
    </div>
    <div class="ui positive right labeled icon button">
      Yes
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>