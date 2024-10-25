<?php

/**
 * @Author: Abigeater
 * @Email:  abigeater@163.com
 * @Link:   abigeater.com
 */
get_header(); 

$job_region = get_the_terms(get_the_ID(), 'job_region' );
$job_type = get_the_terms( get_the_ID(), 'job_type' );
$job_tags = get_the_terms( get_the_ID(), 'job_tag' );

?>
<main id="site-content">
    <div class="job-header py-2 py-md-4 d-flex align-items-center border-bottom mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h1 class="job-title"><?php the_title();?></h1>
                    <div class="job-tag py-1">
                    <?php
                    array_map(function($tag) {
                        echo '<span>'.$tag->name.'</span>';
                    }, $job_tags ?: []);
                    array_map(function($tag) {
                        echo '<span>'.$tag->name.'</span>';
                    }, $job_region ?: []);
                    ?>
                    </div>
                    <div class="job-excerpt">
                        <?php echo nl2br(get_the_excerpt());?>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex flex-column">
                    <span class="job-side-text"><?php echo __("Update Time", "jojo") . ':&emsp;'. get_the_date( "Y-m-d");?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 col-md-8 job-detail">
                <?php 
                while( have_posts() ): the_post();
                    the_content();
                endwhile;
                ?>
            </div>
            <div class="col-12 col-md-4 job-side-block">
                <?php
                $job_deliver_detail = get_theme_mod( 'job_deliver_detail', '' );
                $html = '<h4>'.__('Job Deliver', "jojo").'</h4><div class="job-deliver-detail">'.nl2br(esc_html($job_deliver_detail)).'</div>';
                echo apply_filters('jojo_job_side_block', $html, get_the_ID());
                ?>
            </div>
        </div>
        <?php
		$show_related_job = get_theme_mod( 'show_related_job', false );
		$show_related_job_number = get_theme_mod( 'show_related_job_number', 3 );
		if($show_related_job){
			$related_query =  wpjam_get_related_posts_query($show_related_job_number);
            if($related_query->have_posts()){
                ?>
                <h2 class="pb-2 border-bottom"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php _e("Related Job", 'jojo');?></font></font></h2>
                <?php
				while( $related_query->have_posts() ) {
					$related_query->the_post();
					get_template_part('parts/part', 'job-card');
				}
            }
			wp_reset_postdata();
		}
		?>
    </div>
</main>
<?php
get_footer(); 