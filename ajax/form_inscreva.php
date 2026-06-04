<?php

function formInscreva(){

  $titulo = $_POST['titulo'];
  $unidade = $_POST['unidade'];
  $turno = $_POST['turno'];

  echo do_shortcode('[contact-form-7 id="157" title="Inscrição"]');

?>
<script>
jQuery(function($){

    var treinamento = '<?php echo $titulo; ?> <?php echo $unidade; ?> <?php echo $turno; ?>';

    $(window).on('load', function () {
      $('#treinamento').val(treinamento);
    });
});
</script>
<?php

exit;
}


add_action('wp_ajax_formInscreva', 'formInscreva');
add_action('wp_ajax_nopriv_formInscreva', 'formInscreva');
