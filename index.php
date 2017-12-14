<?php 
  session_start();
  $_DIR = $_SERVER['DOCUMENT_ROOT'];
  if (isset($_GET['p'])) $page = $_GET['p']; else $page = "main";
  if (isset($_GET['s'])) $setting = $_GET['s']; else $setting = "";

  include_once $_DIR.'/cfg/init.php';
  
  
 ?>

<!DOCTYPE html>
<html lang="fr">
<?php include_once $_DIR.'/content/head.php'; ?>
<body>

<?php 
$array = array("inscription","main","activity","student","settings","group");
if (in_array($page, $array)) {
  if (isset($_SESSION['connected'])) {
  
    ##- START ADMIN -CONNECTED- -## 
    
      include_once $_DIR.'/content/admin_navbar.php'; ?>

      <div class="ui bottom attached segment pushable" style="height: calc(100% - 3em);">
        <?php include_once $_DIR.'/content/admin_sidebar.php'; ?>
        <div class="pusher" style="width: calc(100% - 260px);">
          <?php include_once $_DIR.'/pages/admin_'.$page.".php"; ?>
        </div>
        </div>
     <?php 
    } else { 
    include_once $_DIR.'/pages/inscription.php';
  }
   
}
 ?>

</body>

</html>