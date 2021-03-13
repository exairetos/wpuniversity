<?php
get_header();
    while(have_posts()){
        the_post(); 
        pageBanner(array(
            // 'title' => 'Hello this is the title',
            // 'subtitle' => 'Hi, this is the subtitle',
            // 'photo' => 'https://images.unsplash.com/photo-1522337235603-5eec81a1dbff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1655&q=80'

        ));
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
            <?php get_search_form(); ?>
        </div>

        </div>

    <?php }
    get_footer();
?>