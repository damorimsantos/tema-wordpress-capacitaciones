<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
   <section class="hero_cursos pb-2 bg-azul claro mb-5">
    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="col-md-5 align-self-center offset-md-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                <h1 class="tit wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                    <?php echo $term->name; ?>
                </h1>
                <div class="pt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <?php the_field('texto', 82); ?>
                </div>
            </div>
            <div class="col-md-5 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <img src="<?php the_field('imagem', 82); ?>" alt="<?php echo get_the_title(82); ?>">
            </div>
        </div>
    </div>
</section>

<?php 
    $args = array(
        'post_type' => 'cursos',
        'post_per_page' => -1,
        'tax_query' => array(
            array (
                'taxonomy' => 'categoria',
                'field' => 'slug',
                'terms' => $term->slug,
            )
        ),
    );
                    $posts = new WP_Query($args);
                     if ($posts->have_posts()) :
                    ?>                    
<section class="py-5">
    <div class="container pt-3 text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">Conheça nossos Cursos Presenciais</h2>
        <div class="grid_cursos py-4 mb-md-4">
            <div class="row">
               <?php while ($posts->have_posts()) :
                             $posts->the_post();
                        $post = get_post(get_the_ID()); ?>
                <div class="col-md-4 col-12 mb-md-0 mb-4">
                    <div class="mini_curso">
                        <h5 class="laranja"><?php the_title(); ?></h5>
                        <div class="desc cinza mb-4">+ Apostila Completa<br>+ Bônus: Plataforma Online</div>
                        <div class="botoes_chamada">
                            <a href="<?php the_permalink(); ?>" class="btn font-13 fw-400 btn-laranja px-3 py-2 mr-3"><?php the_field('botao_curso', $term); ?></a>
                        <button class="btn font-13 fw-400 btn-cinza px-3 py-2 turm" data-curso="<?php the_ID(); ?>" data-toggle="modal" data-target="#turmas"><?php the_field('botao_inscreva', $term); ?></button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <a href="<?php echo get_home_url()."/cursos/cursos-online/"; ?>" class="btn btn-laranja text-uppercase px-4 py-3 mr-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Conheça também os cursos Online</a>
    </div>
</section>
<?php
wp_reset_postdata();
endif; ?>

<section class="py-5 bg-azul claro">
    <div class="container-fluid text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">Nossos diferenciais</h2>
        <?php if(get_field('diferenciais', $term)): ?>
        <div class="container pt-4">
        <div class="row">
            <?php $c = 1; while(has_sub_field('diferenciais', $term)): ?>
            <div class="col-md-4 mb-4">
                <div class="diferencial_cat font-14 wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php if($c < 10){echo '.' . $c;}else{echo number_format($c, 1);} ?>s">
                    <h5>
                        <?php the_sub_field('titulo'); ?>
                    </h5>
                    <p>
                        <?php the_sub_field('texto'); ?>
                    </p>
                </div>
            </div>
            <?php $c++; endwhile; ?>
        </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<section class="py-5">
    <div class="container text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">Conteúdos Gratuitos</h2>
        <div class="pt-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="row text-center">
                    <div class="col-md-4 align-self-center mb-md-0 mb-4">
                        <a href="<?php the_permalink(48); ?>" class="btn btn-laranja text-uppercase px-4 py-3 mr-3" style="width: 100%;">Blog Hashtag</a>
                    </div>
                    <div class="col-md-4 align-self-center mb-md-0 mb-4">
                        <a href="<?php the_field('youtube', 'option'); ?>" target="_blank" class="btn btn-laranja text-uppercase px-4 py-3 mr-3" style="width: 100%;"><i class="fab fa-youtube font-22 mr-2"></i> Youtube</a>
                    </div>
                    <div class="col-md-4 align-self-center mb-md-0 mb-4">
                        <a href="<?php the_field('instagram', 'option'); ?>" target="_blank" class="btn btn-laranja text-uppercase px-4 py-3 mr-3" style="width: 100%;"><i class="fab fa-instagram font-22 mr-2"></i> Instagram</a>
                    </div>
                </div>
            </div>
    </div>
</section>

<section class="galeria">
    <?php $images = get_field('galeria', $term);
            if( $images ):
    ?>
    <div class="galeria_fotos">
        <div class="row mx-0">
            <?php foreach( $images as $image ): ?>
            <div class="col-md col-4 px-0"><a data-fancybox="gallery" href="<?php echo $image['url']; ?>"><div class="foto" style="background-image:url(<?php echo $image['sizes']['large']; ?>)"></div></a></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</section>

<section class="py-5 bg-azul2">
    <div class="container pt-5 text-center">
        <h5 class="laranja text-uppercase texto-18">O que nossos alunos dizem</h5>
        <?php $post_objects = get_field('depoimentos', $term);
        if( $post_objects ): ?>
        <div class="slider_depoimentos pt-2">
           <?php foreach( $post_objects as $post): setup_postdata($post); ?>
            <div class="slide">
                <div class="depoimento">
                    <div class="texto text-center"><?php the_content(); ?></div>
                    <div class="infos text-center">
                       <div class="foto" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>)"></div>
                        <div class="nome"><?php the_title(); ?></div>
                        <div class="cargo" style="color:#fff"><?php the_field('cargo'); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata(); endif; ?>
    </div>
</section>

<section class="chamada_whatsapp py-5 text-md-left text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 align-self-center mb-md-0 mb-4">
                <h3 class="mb-0 fw-600"><?php the_field('titulo_wp', $term); ?></h3>
                <p class="mb-0"><?php the_field('texto_wp', $term); ?></p>
            </div>
            <div class="col-md-4 align-self-center">
                <a href="<?php the_field('whatsapp_alon', 'option'); ?>" target="_blank" class="btn btn-outline text-uppercase px-4 py-3"><?php the_field('texto_botao_wp', $term); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container pt-3 text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">FAQ</h2>
        <div class="faq text-left pt-4">
            <?php
            if (get_field('faq', $term)):
        $count = 1;
                while(has_sub_field('faq', $term)): ?>
                    <div class="mb-4">
                        <div class="pergunta bg-azul2 branco px-3 py-2" data-toggle="collapse" data-target="#<?php echo 'pergunta_'. $count; ?>" aria-expanded="false"><div class="perg"><?php the_sub_field('pergunta'); ?></div>
                    <div class="seta branco"><i class="fas fa-angle-down"></i></div></div>
                    <div class="resposta collapse bg-azul claro px-3 py-2" id="<?php echo 'pergunta_'. $count; ?>"><?php the_sub_field('resposta'); ?></div>
                    </div>

        <?php
        $count++;
                endwhile;
            endif;
        ?>
        </div>
    </div>
</section>

<!-- FormTurmas -->
<div class="modal fade" id="turmas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center">Turmas Abertas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.gif" alt="" class="loader">
       </div>
        <div id="turmasAbertas"></div>
      </div>
    </div>
  </div>
</div>


<!-- FormInscreva -->
<div class="modal fade" id="formInscreva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inscreva-se</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_inscreva">
          <?php echo do_shortcode('[contact-form-7 id="157" title="Inscrição"]'); ?>
        </div>
      </div>
    </div>
  </div>
</div>