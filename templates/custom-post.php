<?php
    /*
        Template Name: Custom Post Template
    */

    get_header();
?>

<section class="default-blogs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="category-list pb-50 d-flex justify-content-center">                    
                    <ul class="list-unstyled d-flex d-flex-wrap">
                        <?php
                            $categories = get_categories();
                            foreach($categories as $category){
                                echo '<li><a href="'. get_category_link($category->term_id) .'">'. $category->name .'</a></li>';
                            }
                        ?>                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="category-list pb-50 d-flex justify-content-center">                    
                    <ul class="list-unstyled d-flex d-flex-wrap">
                        <?php
                            $tags = get_tags();
                            foreach($tags as $tag){
                                echo '<li><a href="'. get_tag_link($tag->term_id) .'">'. $tag->name .'</a></li>';
                            }
                        ?>                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                query_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'order' => "Asc",
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => array('WordPress'),
                            'operator' => 'NOT IN'
                        )
                    )
                ));           
                
            
                if( have_posts() ): while( have_posts() ) : the_post();
                
                $thumbnailimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <div class="col-md-4">
                <div class="card d-blog-card">
                  <a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?php echo $thumbnailimg; ?>" alt="Card image cap"></a>
                  <div class="card-body">
                    <div class="post-date"><?php echo get_the_date(); ?></div>
                    <h5 class="card-title my-0"><?php the_title(); ?></h5>
                    <div class="post-category"><?php the_category(); ?></div>
                    <div class="post-content"><?php the_excerpt(); ?></div>
                      <div class="post-author"><?php the_field('author_name'); ?></div>
                      
                    <div class="mt-3">
                        <a href="<?php the_permalink(); ?>" class="btn btn-info btn-lg">View More</a>
                    </div>
                  </div>
                </div>
            </div> 
            <?php
                endwhile;
                endif;
                wp_reset_query();
            ?>
        </div>
    </div>
</section>

<?php
    get_footer();
?>