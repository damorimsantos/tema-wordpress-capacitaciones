<?php get_header(); ?>
<section class="hero_cursos pb-2 bg-azul claro mb-5">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-5 align-self-center offset-md-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                <h1 class="tit wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                    <?php echo get_the_title(82); ?>
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
<section class="py-5">
    <div class="container pt-3 text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">Conheça nossos Cursos Presenciais</h2>
        <div class="grid_cursos py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="mini_curso">

                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-laranja text-uppercase px-4 py-3 mr-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Conheça também os cursos Online</a>
    </div>
</section>
<section class="galeria">
    <?php $images = get_field('galeria', 82);
            if( $images ):
    ?>
    <div class="galeria_fotos">
        <div class="row mx-0">
            <?php foreach( $images as $image ): ?>
            <div class="col px-0"><a data-fancybox="gallery" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"></a></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</section>
<section class="py-5 bg-azul claro">
    <div class="container-fluid text-center">
        <h2 class="tit centro wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">Nossos diferenciais</h2>
        <?php if(get_field('diferenciais', 23)): ?>
        <div class="slider_diferenciais py-4 px-4">
            <?php $c = 1; while(has_sub_field('diferenciais', 23)): ?>
            <div class="slide">
                <div class="diferencial wow fadeInUp" data-wow-duration="1s" data-wow-delay=".<?php echo $c+3; ?>s">
                    <div class="icone"><img src="<?php the_sub_field('icone'); ?>" alt="<?php the_sub_field('titulo'); ?>"></div>
                    <h4>
                        <?php the_sub_field('titulo'); ?>
                    </h4>
                    <p>
                        <?php the_sub_field('texto'); ?>
                    </p>
                    <a href="<?php the_permalink(23) ?>">Saiba mais</a>
                </div>
            </div>
            <?php $c++; endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>