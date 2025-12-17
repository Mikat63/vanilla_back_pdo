<div class="modal_content">
  <p>Souhaitez-vous vraiment supprimer ?</p>

  <div class="modal_form_container">

    <form action="process/delete_rendezvous.php" method="POST">
      <input type="hidden" name="id_rendezvous" value="<?= $patient['id_rendezvous'] ?>">
      <button type="submit" class="button_modal_yes" id="modal_yes">Oui</button>
    </form>
    <button class="button_modal_no" id="modal_no">Non</button>

  </div>
</div>