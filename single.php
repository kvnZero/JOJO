<?php
/**
 * @Author: Abigeater
 * @Email:  abigeater@163.com
 * @Link:   abigeater.com
 */
get_header(); 

?>
<main id="site-content">
    <div class="post-header py-2 py-md-4 d-flex align-items-center border-bottom mb-4">
        <div class="container">
            <h1 class="post-title"><?php echo get_the_title();?></h1>
            <div class="post-excerpt">
                <?php echo nl2br(get_the_excerpt());?>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 post-detail">
                <?php the_content();?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer(); 