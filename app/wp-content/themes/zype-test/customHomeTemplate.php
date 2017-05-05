<?php
/* 
 * Template Name: Home Template 
 */
/**
 * @package Zype_Test
 */
get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">
                    <?php
			while ( have_posts() ) : the_post();
                     ?>
                        <div class="col-lg-12 col-sm-12 col-md-12"><h1 class="text-center"> <?php the_title(); ?></h1></div>
                        <div class="col-lg-12 col-sm-12 col-md-12 text-center"><h2>Posts</h2></div>
                
                    <?php
                            // The Query
                             $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 3
                            );
                            $posts = new WP_Query( $args );
                            // The Loop
                                if ( $posts->have_posts() ) :?>
                                      <div class='col-lg-12 col-sm-12 col-md-12'>
                                    <?php    while ( $posts->have_posts() ): $posts->the_post();
                                                ?>
                                                <div class='col-lg-4 col-sm-4 col-md-4'>
                                                    <h4> <?php echo get_the_title();?> </h4>
                                                    <p> <?php echo get_the_content();?> </p>
                                                    <a href="<?php echo the_permalink(); ?>">READ MORE</a>
                                                </div>
                                        <?php endwhile; ?>
                                          
                                     </div>
                                           <?php    /* Restore original Post Data */
                                                wp_reset_postdata();
                                                endif;
                                        ?>
                        <div class='col-lg-12 col-sm-12 col-md-12 text-center'><h2>Customers</h2></div>
                            <?php       
           
                          //get custom fields
                            $args_custom_filed = array(
                                                  'post_type' => 'customers',
                                                  'posts_per_page' => 2
                                              );
                            $customers = new WP_Query($args_custom_filed);
                            
                            if ( $customers->have_posts() ) :?>
                                  <div class='col-lg-12 col-sm-12 col-md-12'>
                                 <?php
                                  while ( $customers->have_posts() ) : $customers->the_post();
                                          $id = get_the_ID();
                                          ?>
                                                <div class='col-lg-6 col-sm-6 col-md-6'>
                                                     <?php  $img= CFS()->get( 'customer_logo', $id );  ?> 
                                                    <img src="<?php echo $img ?>" >                                                    
                                                    <h4> <?php echo get_the_title();?> </h4>
                                                    <p> <?php echo  CFS()->get( 'customer_description', $id );?> </p>
                                                     <?php 
                                                     
                                                    $loop = CFS()->get( 'customer_urls', $id );
                                                        foreach ( $loop as $row ) {
                                                           //$row['url_name'];
                                                           echo "<p>".$row['url']."</p>";

                                                            }
                                                    
                                                     ?>
                                                      <p><?php $term_list=  wp_get_post_terms( $id, 'sagments' );
                                                             foreach($term_list as $term_single) {
                                                                echo $term_single->name.", "; //do something here
                                                                }?>                                        
                                                    </p>
                                                    
                                                </div>
                                  <?php endwhile;?>
                                  </div>
                        <?php
                                  /* Restore original Post Data */
                                  wp_reset_postdata();
                          endif;
                          ?>
                        <div class="col-md-12 col-sm-12 col-lg-12 text-center"> 
                            <h2>Home page content</h2>
                            <p> <?php the_content(); ?></p>
                        </div>
		</main><!-- #main -->
	</div><!-- #primary -->
 
                        <?php endwhile; // End of the loop. ?>
<?php
//get_sidebar();
get_footer();
