<!--item listing-->
<div class="cactus-post-item hentry">
    
    <!--content-->
    <div class="entry-content">
        <div class="primary-post-content"> <!--addClass: related-post, no-picture -->
                     
            <?php if(has_post_thumbnail()): ?>                            
                <!--picture-->
                <div class="picture">
                    <div class="picture-content item-thumbnail">
						<?php echo do_shortcode('[cactus_badges]');?>
                        <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>">
                            <?php 
							$size = apply_filters('truemag_video_thumb_size','thumb_520x293', 'channel-video');
							the_post_thumbnail($size); ?>
                            <div class="thumb-overlay"></div>                                    
                        </a>                                          
                        <?php echo tm_post_rating(get_the_ID());?>                               
                    </div>
                    
                </div><!--picture-->
            <?php endif ?>
            
            <div class="content">
                
                <!--Title-->
                <h3 class="h4 cactus-post-title entry-title"> 
                    <a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title(get_the_ID()));?>"><?php echo esc_attr(get_the_title(get_the_ID()));?></a> 
                </h3><!--Title-->
                
                <div class="cactus-last-child"></div> <!--fix pixel no remove-->
            </div>
        </div>
        
    </div><!--content-->
    
</div><!--item listing-->
