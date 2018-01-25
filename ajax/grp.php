<?php 
$_DIR = $_SERVER['DOCUMENT_ROOT'];
$type = $_POST['type']; 
if(isset($_POST['val'])){
  $groupe = $_POST['val'];
}
if ($type === "create") $title = "Créer";
if ($type === "edit") $title = "Modifier";
if ($type === "delete") $title = "Supprimer";
if ($type === "addelv") $title = "Ajouter des élèves";
if ($type === "addacti") $title = "Programmer une activité";
if ($type === "delelv") {
   $title = "Supprimer un élève";
   $buttoncolor ="red";
} else $buttoncolor="primary";
if ($type === "delacti") {
  $title = "Supprimer une activité";
  $buttoncolor ="red";
} else $buttoncolor="primary";

$genre="un groupe";
?>

<i class="close icon"></i>
<div class="header">
  <?php if($type != "Créer" || $type != "Modifier" || $type != "Supprimer" ){
                echo $title;
        }
        else{
          echo $title." groupes"; 
        } ?>
</div>

<?php include_once $_DIR.'/ajax/content/grp/'.$type.'.php'; ?>

<div class="actions">
  <div class="ui <?php echo $buttoncolor; ?> button" data-submit="<?php echo 'req_grp_'.$type; ?>"><?php 
  if($type != "Créer" || $type != "Modifier" || $type != "Supprimer" ){
    echo "Valider";
  }
  else{
    echo $title; 
}?></div>
</div>

<?php include_once $_DIR.'/ajax/content/supprimer.php'; ?>

