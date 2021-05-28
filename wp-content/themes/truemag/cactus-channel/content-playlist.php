<!--item listing-->
<div class="cactus-post-item hentry">
  
  <!--content-->
  <div class="entry-content">
      <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
          <?php 
          $thumb_first = '';
          $cr_id = get_the_ID();
                  $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'meta_query' => array(
                        array(
                            'key' => 'playlist_id',
                             'value' => $cr_id,
                             'compare' => 'LIKE',
                        ),
                    )
                );
                $the_query = new WP_Query( $args );
                $it = $the_query->post_count;
                $thumb_first ='';
                $post_thubm = get_posts($args);
                
                if(!has_post_thumbnail( $cr_id ) && $it > 0){
                
                    $size = apply_filters('truemag_video_thumb_size','thumb_520x293', 'channel-playlist');
                    foreach ( $post_thubm as $post ):
                        $thumb_first = get_the_post_thumbnail($post->ID, $size);
                        break;
                    endforeach; 
                    wp_reset_postdata();
                
                }

                if(has_post_thumbnail( $cr_id ) || $thumb_first != ''){
              ?>                             
          <!--picture-->
          <div class="picture">
              <div class="picture-content">
              
                  <a href="<?php echo get_the_permalink($cr_id);?>" title="<?php echo esc_attr(get_the_title($cr_id));?>">
                      <?php
                      if(has_post_thumbnail( $cr_id )){
                            the_post_thumbnail($size);
                      }else{
                          echo $thumb_first;
                      };								 
                      ?>
                      <div class="thumb-overlay"></div>
                  </a>                                   
              </div>                          
          </div><!--picture-->
          <?php
                };
          ?>
          
          <div class="content">
              
              <!--Title-->
              <h3 class="h4 cactus-post-title entry-title"> 
                  <a href="<?php echo get_the_permalink($cr_id);?>" title="<?php echo esc_attr(get_the_title($cr_id));?>"><?php echo esc_attr(get_the_title($cr_id));?></a> 
              </h3><!--Title-->
              
              <!--info-->
              <div class="posted-on">
                  <?php echo cactus_get_datetime();?>
                  <div class="videos cactus-info"><?php echo $it; _e(' videos','cactusthemes'); ?></div>                                              			
              </div><!--info-->
              
              <div class="cactus-last-child"></div> <!--fix pixel no remove-->
          </div>
      </div>
      
  </div><!--content-->
  
</div><!--item listing-->