<div class="modal_content">
  <p>Souhaitez-vous vraiment supprimer ?</p>

  <div class="modal_form_container">

    <form action=<?= $processLink ?> method="POST">
      <input type="hidden" name=<?= $nameRendezVous ?> value="<?= $modalValue ?>">
      <button type="submit" class="button_modal_yes" id="modal_yes">Oui</button>
    </form>
    <button class="button_modal_no" id="modal_no">Non</button>

  </div>
</div>