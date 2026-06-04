<?php

function turmasAbertas(){
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $curso = $_POST['curso'];

?>

<section class="">
  <div class="container">
   <div class="row">
    <?php
    $args = array(
        'post_type' => 'inscricoes',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'curso',
                'compare' => '=',
                'value' => $curso
              )
	   ),
        'meta_key'	=> 'inicio',
        'orderby'	=> 'meta_value_num',
        'order'		=> 'ASC'
    );
    $posts = new WP_Query($args);
     if ($posts->have_posts()) :
         while ($posts->have_posts()) :
             $posts->the_post();
    ?>
    <div class="col-md-4">
        <div class="inscricao mb-4">
      <div class="row">
        <div class="col-md-12 mb-md-0 mb-4 align-self-center d-none">
          <div class="data bg-azul claro text-center">
            <?php
            $data = get_field('inicio', false, false);
            //$data = new DateTime($data);
             ?>
             <h3><?php echo strftime('%d', strtotime($data)); ?></h3>
             <h5><?php echo strftime('%B', strtotime($data)); ?></h5>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div class="cont">
            <h4><?php the_title(); ?> | <span><?php the_field('unidade'); ?> <b><?php the_field('turno'); ?></b></span> - <?php the_field('dia_semana'); ?></h4>
            <div class="desc">
              <p><b>Local:</b> <?php the_field('local'); ?></p>
              <p><b>Datas:</b> <?php the_field('datas'); ?> <b>(<?php the_field('dia_semana'); ?>)</b></p>
              <p><b>Horário:</b> <?php the_field('horario'); ?></p>
              <p><b>Carga horária:</b> <?php the_field('carga_horaria'); ?></p>
              <p><b>Preço</b> <?php the_field('preco'); ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-12 align-self-center">
          <?php
            $status = get_field('status');
            if($status == 'ativo'){
          ?>
          <button class="btn btn-laranja text-uppercase py-3 inscr" style="width:100%" data-titulo="<?php the_title(); ?>" data-unidade="<?php the_field('unidade'); ?>" data-turno="<?php the_field('turno'); ?>" data-toggle="modal" data-target="#formInscreva">Inscreva-se</button>
        <?php } else { ?>
          <button class="btn btn-laranja text-uppercase py-3 inscr" style="width:100%" disabled>Esgotado</button>
        <?php } ?>
        </div>
      </div>
      <hr class="mt-4 mb-0">
    </div>
    </div>
    <?php
        endwhile;
    wp_reset_postdata();
    else:
    ?>
    <p class="py-5 text-center">Nenhuma turma encontrada.</p>
    <?php
    endif;
    ?>
  </div>
  </div>
</section>

<?php

exit;
}


add_action('wp_ajax_turmasAbertas', 'turmasAbertas');
add_action('wp_ajax_nopriv_turmasAbertas', 'turmasAbertas');
