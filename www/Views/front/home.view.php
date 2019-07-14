<?php
use LeaffyMvc\Core\Routing;
$this->addHeader("homeHeader", "front")
?>

<main>
    <div id="discover-anchor"></div>
    <section id="about" class="front-page-section">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h3">À propos</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-12 d-flex">
                        <div id="avatar" class="margin-auto d-flex">
                            <img class="margin-auto" src="../../public/img/avatar.jpg" alt="logo-leaffy">
                        </div>
                    </div>
                    <div class="col-sm-8 col-12">
                        <div class="section-description section-description--about">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                            </br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="approche" class="front-page-section">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h3">Mon approche</h3>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-8 col-12">
                      <div class="section-description section-description--approach">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p></br>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                      </div>
                  </div>
                  <div class="col-sm-4 col-12">
                      <div id="approach" class="" style="background-image: url(../../public/img/Approche.jpg);">
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <?php $postModel = new \LeaffyMvc\Models\Post();
    //TODO ALix faire une mathode pour reccupere les 3 Derniers article LIMIT 3
    $posts = $postModel->findAllBy(['status'=>'PUBLISHED']);
    if(!empty($posts)) : ?>
    <section id="latest-news" class="front-page-section">
        <div class="section-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h3--white h3">Derniers articles</h3>
                    </div>
                </div>
            </div>
        </div>
        <a href="/?page=3" title="See blog" class="button button--three"><i class="fa fa-chevron-circle-right"></i>Voir le Blog </a>
        <div class="section-content">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $post): ?>
                    <div class="leaffy-blog-post col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3 col-12">
                        <div class="post" style="">
                            <div class="post-image" style="background-image: url('../../public/img/blog3.jpg');">
                            </div>
                            <h5><a href="#" class="post-title"><?= $post->title ?></a></h5>
                            <div class="post-entry">
                                <?= $post->description ?>
                            </div>
                            <a href="<?php echo Routing::getSlug("Post", "showOnePost").'?id='.$post->id ?>" title="Read more" class="post-button"><i class="fa fa-chevron-circle-right"></i>Lire plus </a>
                        </div>
                    </div>
                  <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php
    $testimonialModel = new \LeaffyMvc\Models\Testimonial();
    $testimonials = $testimonialModel->findAllBy(['status'=>'APPROVED']);
    $str='';
     if(!empty($testimonials)) : ?>
    <section id="testimonials" class="front-page-section" style="">
        <div class="section-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="h3">Témoignages</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-12 no-padding">
                       <div class="testimonials-carousel">
                            <div id="slide-container" class="widget_testimonial slider">

                    <?php
                    foreach ($testimonials as $testimonial){
                        $str.= '<div class="slide">'
                                  .'<div class="testimonial-image">'
                                      .'<img src="../../public/img/avatar_testi.png" width="100" alt="avatar-testimonial">'
                                  .'</div>'
                                .'<div class="testimonial-content">'
                                    .'<blockquote><q>'. $testimonial->content.' </q></blockquote>'
                                .'</div>'
                                .'<div class="testimonial-meta">'
                                    .'<h6>'.$testimonial->user_name.'</h6>'
                                .'</div>'
                             .'</div>';
                        }
                        echo $str   ?>
                                <div id="nav-slider">
                                  <button class="button-slider nav-prev" data-dir="prev"><img src="../../public/img/left-arrow.png" alt="left-arrow"></button>
                                  <button class="button-slider nav-next" data-dir="next"><img src="../../public/img/right-arrow.png" alt="right-arrow"></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section id="contact-us" class="front-page-section">
        <div class="section-contact">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="h3">Laissez un témoignage</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-content form-testimonial-front">
                            <?php $testimonialController = new \LeaffyMvc\Controllers\TestimonialController();
                            $this->addModal("formTestimonial", $testimonialController->getTestimonialForm());?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
