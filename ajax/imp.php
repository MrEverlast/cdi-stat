<div id="modal_year" class="ui modal">

  <div class="content">
    <?php include_once $_DIR.'/ajax/imp/modalmain.php'; ?>
    <div id="error" class="ui error message hidden">
      <ul class="list">
        <li>Erreur lors de l'importation du fichier</li>
        <li>Veuillez bien choisir un fichier .csv</li>
      </ul>
    </div>
  </div>

  <div class="actions">
    <button class="ui button cancel red"><i class="icon delete"></i>Annuler</button>
    <button class="ui button disabled"><i class="icon chevron left"></i>Précédent</button>
    <button id="next" class="ui button disabled">Suivant<i class="icon chevron right"></i></button>
  </div>  

</div>
