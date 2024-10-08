<?php

/**
 * @Author: Abigeater
 * @Email:  abigeater@163.com
 * @Link:   abigeater.com
 */
get_header(); 
?>
<main id="site-content">
	<div class="container my-4">
        <div class="row">
            <div class="col-12">
				<h1 class=""><?php echo get_the_title();?></h1>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
			<?php 
			while( have_posts() ): the_post();
				the_content();
			endwhile;
			?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer(); 