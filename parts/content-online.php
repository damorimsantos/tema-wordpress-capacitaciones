<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
<section class="hero_cursos hero_online pb-2 bg-azul claro mb-5">
    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="col-md-5 align-self-center offset-md-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                <h1 class="tit wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                    Programa Excel Impressionador Online
                </h1>
                <div class="pt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    Aprenda tudo o que você precisa para se tornar uma referência na empresa onde você
                    trabalha ou vai trabalhar só por causa do Excel.
                </div>
            </div>
            <div class="col-md-5 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <img src="<?php echo get_home_url(); ?>/wp-content/uploads/2019/04/curso_online.svg" alt="<?php echo get_the_title(82); ?>">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container pt-3 text-center">
        <div class="_form_178"></div>
        <script src="https://hashtagtreinamentos.activehosted.com/f/embed.php?id=178" type="text/javascript" charset="utf-8"></script>
    </div>
</section>

<section class="py-5 bg-azul claro">
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

<section class="py-5">
    <div class="container">
        <div class="_form_173"></div>
        <script src="https://hashtagtreinamentos.activehosted.com/f/embed.php?id=173" type="text/javascript" charset="utf-8"></script>
    </div>
</section>

<section class="vc_quer py-5 bg-azul claro">
    <div class="container">
        <div class="titulo mb-4">
            <div class="row">
                <div class="col-md-3 mb-md-0 mb-2">
                    <h2 class="text-uppercase text-md-right text-center mb-0">Você quer:</h2>
                </div>
                <div class="col-md-9">
                    <div class="perguntas_quer">
                        <p>Passar em QUALQUER processo seletivo que exija Excel?</p>
                        <p>Usar o Excel para se tornar o funcionário destaque da sua empresa, impressionando qualquer gestor, coordenador ou diretor?</p>
                        <p>Se tornar uma referência, mesmo que atualmente não saiba nada ou muito pouco, e ser reconhecido e elogiado só por causa das suas planilhas?</p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="texto">
            <?php the_field('texto_vc', $term); ?>
        </div>
        <div class="form py-4">
            <div class="_form_178"></div><script src="https://hashtagtreinamentos.activehosted.com/f/embed.php?id=178" type="text/javascript" charset="utf-8"></script>
        </div>
        <div class="texto pt-3">
            <?php the_field('texto_vc2', $term); ?>
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
                <div class="pergunta bg-azul2 branco px-3 py-2" data-toggle="collapse" data-target="#<?php echo 'pergunta_'. $count; ?>" aria-expanded="false">
                    <div class="perg"><?php the_sub_field('pergunta'); ?></div>
                    <div class="seta branco"><i class="fas fa-angle-down"></i></div>
                </div>
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
