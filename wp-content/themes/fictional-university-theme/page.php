<?php
get_header();
    while(have_posts()){
        the_post(); 
        pageBanner();
        ?>

        <div class="container container--narrow page-section">
        <?php 
            $theParentID = wp_get_post_parent_id(get_the_ID());
            if($theParentID){ ?>
                <div class="metabox metabox--position-up metabox--with-home-link">
                    <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParentID); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParentID); ?></a> <span class="metabox__main"><?php echo the_title();?></span></p>
                </div>
            <?php }
        ?>
                    
            <?php 
                if(get_pages(array('child_of' => get_the_id()))) {
            ?>
                <div class="page-links">
                <h2 class="page-links__title"><a href="<?php echo get_permalink($theParentID); ?>"><?php echo get_the_title($theParentID); ?></a></h2>
                
                <ul class="min-list">
                <?php
                    wp_list_pages(array(
                        'title_li' => NULL,
                        'child_of' => get_the_id(),
                        'sort_column' => 'menu_order'
                    ));
                ?>
                </ul>
            </div>

           <?php } ?>
           

            <div class="generic-content">
            <?php the_content(); ?>
        </div>

        </div>

    <?php }
    get_footer();
?>