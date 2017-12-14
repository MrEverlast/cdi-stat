<?php 
  $_DIR = $_SERVER['DOCUMENT_ROOT']; 
  $_MODAL = 3;
  ?>
<h2 class="ui header">
  Sélectionner
  <div class="sub header">Les classes de <b>BTS</b>.</div>
</h2>

<div class="ui container">

  <table class="ui very compact table">
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php include_once $_DIR.'/ajax/imp/content/list.php'; ?>
  </tbody>
</table>
</div>