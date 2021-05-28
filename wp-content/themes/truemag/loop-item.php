<?php
global $wp_query;
global $listing_query;
if($listing_query){
	$wp_query = $listing_query;
}

if( (isset($_GET['orderby']) && $orderby = $_GET['orderby']) || ($orderby = ot_get_option('default_blog_order')) ){ //process custom order by
		if($orderby == 'like'){
				$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page')?get_query_var('page'):1);

				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => '-1',
					'orderby' => 'latest',
					'cat' => $cat,
				);
				if(is_category()){
					$cat = get_query_var('cat');
					$args['cat'] = $cat;
				}elseif(is_tag()){
					$tag = get_query_var('tag');
					$args['tag'] = $tag;
				}elseif(is_tax('video-series')){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$args['video-series'] = $term->slug;
				}
				$postlist = get_posts($args);
				$posts_id = array();
				foreach ( $postlist as $post ) {
				   $posts_id[] += $post->ID;
				}
				wp_reset_postdata();
				//print_r($posts_id);
				global $wpdb;
				$time_range = 'all';
				//$show_type = $instance['show_type'];
				$order_by = 'ORDER BY like_count DESC, post_title';
				$show_excluded_posts = get_option('wti_like_post_show_on_widget');
				$excluded_post_ids = explode(',', get_option('wti_like_post_excluded_posts'));
				if(!$show_excluded_posts && get_option('wti_like_post_excluded_posts') != '' && count($excluded_post_ids) > 0) {
					$where = "AND post_id NOT IN (" . get_option('wti_like_post_excluded_posts') . ")";
				}
				else{$where = '';}
				$query = "SELECT post_id, SUM(value) AS like_count, post_title FROM `{$wpdb->prefix}wti_like_post` L, {$wpdb->prefix}posts P ";
				$query .= "WHERE L.post_id = P.ID AND post_status = 'publish' AND value > -1 $where GROUP BY post_id $order_by";
				$posts = $wpdb->get_results($query);
				//$cates_ar = $cates;
				$p_data = array();
				//print_r($posts);
				if(count($posts) > 0) {
					foreach ($posts as $post) {
						$p_data[] = $post->post_id;
					}
				}
				$diff_result= array_diff($posts_id,$p_data);
				$common_result = array_intersect($p_data,$posts_id);
				$posts_id = array_merge($common_result, $diff_result);
				//print_r($posts_id);
				$args = null;
				$args = array(
					  'post_type' => 'post',
					  'orderby'=> 'post__in',
					  'post__in' =>  $posts_id,
					  'ignore_sticky_posts' => 1,
					  'paged' => $paged,
				);
				$wp_query = new WP_Query( $args );
				
				$loop_count=0;
				echo '
				<div class="post_ajax_tm" >
				<div class="row">';
				while ($wp_query->have_posts()) : $wp_query->the_post();
				$loop_count++;
				$class ='';
				$format = get_post_format(get_the_ID());
				
				?>
					<div class="col-md-3 col-sm-6 col-xs-6 <?php echo $class; ?>">
						<div id="post-<?php the_ID(); ?>" <?php post_class('video-item') ?>>
						<?php 
						  $quick_if = ot_get_option('quick_view_info');
						  if($quick_if=='1'){
						  echo '
								<div class="qv_tooltip"  title="
									<h4 class=\'gv-title\'>'.esc_attr(get_the_title()).'</h4>
									<div class=\'gv-ex\' >'.esc_attr(get_the_excerpt()).'</div>
									<div class= \'gv-button\'>';
										if($format=='video'){
											echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Watch Now','cactusthemes').'</a></div>';
										}else{
											echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Read more','cactusthemes').'</a></div>';
										}
										echo '
										<div class= \'gv-link\'>'.quick_view_tm().'</div>
									</div>
									</div>
								">';}
						?>
							<div class="item-thumbnail">
                                <?php echo do_shortcode('[cactus_badges]');?>
								<a href="<?php the_permalink() ?>">
									<?php
									if(has_post_thumbnail()){
										$size = apply_filters('truemag_video_thumb_size','thumb_520x293', 'loop');
										$thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
									}else{
										$thumbnail = '<img src="'.(function_exists('tm_get_default_image')?tm_get_default_image():'').'">';
									}
									echo $thumbnail;
									if($format=='' || $format =='standard'){ ?>
									<div class="link-overlay fa fa-search"></div>
									<?php }else {?>
									<div class="link-overlay fa fa-play"></div>
									<?php }  ?>
								</a>
								<?php echo tm_post_rating(get_the_ID());
								$time_video = get_post_meta(get_the_id(),'time_video',true);
								if($time_video!='00:00' && $time_video!='00' && $time_video!='' ){
									echo '<span class="rating-bar bgcolor2 time_dur">'.$time_video.'</span>';
								}
								?>
							</div>
							<?php if($quick_if=='1'){
								echo '</div>';
							}?>
							<div class="item-head">
								<h3><a href="<?php the_permalink() ?>" rel="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="item-info hidden">
								<?php if(ot_get_option('blog_show_meta_author',1)){ ?>
									<span class="item-author"><?php the_author_posts_link(); ?></span>
								<?php }
									if(ot_get_option('blog_show_meta_date',1)){ ?>
									<span class="item-date"><?php the_time(get_option('date_format')); ?></span>
								<?php }?>
									<div class="item-meta">
										<?php echo tm_html_video_meta(false,false,false,true) ?>
									</div>
								</div>
							</div>
							<div class="item-content hidden">
								<?php
								$content = new CT_ContentHtml;  
                                $content->ct_remove_viewcount();
								?>
                            </div>
							<div class="clearfix"></div>
						</div>
					</div><!--/col3-->
				<?php
				if($loop_count%4==0){ echo '</div><div class="row">';}
				endwhile;
				echo '</div>';
				tm_display_ads('ad_recurring');
				echo '</div>';
		}else{
			global $wp_query;
			$atts = array();
			if($orderby == 'view'){
                $synchronize_views_count = function_exists('ot_get_option') ? ot_get_option('synchronize_views_count', '') : '';
                // check if BAW is installed and active
                if(function_exists('bawpvc_main') || $synchronize_views_count != ''){
                    $atts['orderby'] = 'meta_value_num';
                    $atts['meta_key'] = '_count-views_all'; //view metadata
                } elseif(function_exists('get_tptn_post_count_only')) {

                    if (is_tax() || is_category() || is_tag()) {

                        $queried_object = get_queried_object();
                        $taxonomy = $queried_object->taxonomy;
                        $slug = $queried_object->slug;

                        $tax_query = array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'slug',
                                'terms' => array($slug),
                            )
                        );
                        $cactus_wpdb = cactus_global_wpdb();
                        $tax_sql = get_tax_sql($tax_query, $cactus_wpdb->base_prefix . "top_ten", 'postnumber');

                        $ids = cactus_get_tptn_pop_posts(array(
                            'daily' => 0,
                            'post_types' => 'post',
                            'join' => $tax_sql['join'],
                            'where' => $tax_sql['where']
                        ));
                    } else {

                        $args2 = array(
                            'daily' => 0,
                            'post_types' => 'post',
                        );
                        $ids = cactus_get_tptn_pop_posts($args2);
                    }

                    $atts['post__in'] = $ids;
                    $atts['orderby'] = 'post__in';
                    $atts['page'] = 1; /** we don't need to increase page if using Top 10 **/
                }
			}elseif($orderby == 'comment'){
				if( is_plugin_active('facebook/facebook.php') && get_option('facebook_comments_enabled') || is_plugin_active('disqus-comment-system/disqus.php') ){
					$atts['orderby'] = 'meta_value_num';
					$atts['meta_key'] = 'custom_comment_count';
				}else{
					$atts['orderby'] = 'comment_count';
				}
			}elseif($orderby == 'title'){
				$atts['orderby'] = $orderby;
				$atts['order'] = 'ASC';
			}else{
				$atts['orderby'] = 'date';
				$atts['order'] = 'DESC';
			}
			$atts = array_merge( $wp_query->query_vars, $atts );
			$wp_query = new WP_Query($atts);
			
			$loop_count=0;
			echo '
			<div class="post_ajax_tm" >
			<div class="row">';
			while ($wp_query->have_posts()) : $wp_query->the_post();
			$loop_count++;
			$class ='';
			$format = get_post_format(get_the_ID());
			if($format!='' || $format =='standard'){$class ='news';}
			?>
				<div class="col-md-3 col-sm-6 col-xs-6  <?php echo $class; ?>">
					<div id="post-<?php the_ID(); ?>" <?php post_class('video-item') ?>>
						<?php 
						  $quick_if = ot_get_option('quick_view_info');
						  if($quick_if=='1'){
						  echo '
								<div class="qv_tooltip"  title="
									<h4 class=\'gv-title\'>'.esc_attr(get_the_title()).'</h4>
									<div class=\'gv-ex\' >'.esc_attr(get_the_excerpt()).'</div>
									<div class= \'gv-button\'>';
										if($format=='video'){
											echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Watch Now','cactusthemes').'</a></div>';
										}else{
											echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Read more','cactusthemes').'</a></div>';
										}
										echo '
										<div class= \'gv-link\'>'.quick_view_tm().'</div>
									</div>
									</div>
								">';}
                        ?>                   
						<div class="item-thumbnail">
                            <?php echo do_shortcode('[cactus_badges]');?>
							<a href="<?php the_permalink() ?>">
								<?php
								if(has_post_thumbnail()){
									$size = apply_filters('truemag_video_thumb_size','thumb_520x293', 'loop');
									$thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
								}else{
									$thumbnail = '<img src="'.(function_exists('tm_get_default_image')?tm_get_default_image():'').'">';
								}
								echo $thumbnail;
								if($format=='' || $format =='standard'){ ?>
                                <div class="link-overlay fa fa-search"></div>
                                <?php }else {?>
                                <div class="link-overlay fa fa-play"></div>
                                <?php }  ?>
							</a>
							<?php echo tm_post_rating(get_the_ID());
							$time_video = get_post_meta(get_the_id(),'time_video',true);
							if($time_video!='00:00' && $time_video!='00' && $time_video!='' ){
								echo '<span class="rating-bar bgcolor2 time_dur">'.$time_video.'</span>';
							} ?>
						</div>
                        <?php if($quick_if=='1'){
							echo '</div>';
						}?>
						<div class="item-head">
							<h3><a href="<?php the_permalink() ?>" rel="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </h3>
							<div class="item-info hidden">
								<?php if(ot_get_option('blog_show_meta_author',1)){ ?>
                                    <span class="item-author"><?php the_author_posts_link(); ?></span>
                                <?php }
                                    if(ot_get_option('blog_show_meta_date',1)){ ?>
                                    <span class="item-date"><?php the_time(get_option('date_format')); ?></span>
                                <?php }?>
                                <div class="item-meta">
									<?php echo tm_html_video_meta(false,false,false,true) ?>
								</div>
							</div>
						</div>
						<div class="item-content hidden">
								<?php
								$content = new CT_ContentHtml;  
                                $content->ct_remove_viewcount();
								?>				
                        </div>
						<div class="clearfix"></div>
					</div>
				</div><!--/col3-->
			<?php
			if($loop_count%4==0){ echo '</div><div class="row">';}
			endwhile;
			echo '</div>
			</div>';
			
			
			
		}
	}else
	{
		$loop_count=0;
		echo '
		<div class="post_ajax_tm" >
		<div class="row">';
		while ($wp_query->have_posts()) : $wp_query->the_post();
		$loop_count++;
		$class ='';
		$format = get_post_format(get_the_ID());
		
		?>
			<div class="col-md-3 col-sm-6 col-xs-6 <?php echo $class; ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class('video-item') ?>>
                <?php 
				  $quick_if = ot_get_option('quick_view_info');
				  if($quick_if=='1'){
				  echo '
						<div class="qv_tooltip"  title="
							<h4 class=\'gv-title\'>'.esc_attr(get_the_title()).'</h4>
							<div class=\'gv-ex\' >'.esc_attr(get_the_excerpt()).'</div>
							<div class= \'gv-button\'>';
								if($format=='video'){
									echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Watch Now','cactusthemes').'</a></div>';
								}else{
									echo  '<div class=\'quick-view\'><a href='.get_permalink().' title=\''.esc_attr(get_the_title()).'\'>'.__('Read more','cactusthemes').'</a></div>';
								}
								echo '
								<div class= \'gv-link\'>'.quick_view_tm().'</div>
							</div>
							</div>
						">';}
				?>
					<div class="item-thumbnail">
                        <?php echo do_shortcode('[cactus_badges]');?>
						<a href="<?php the_permalink() ?>">
							<?php
							if(has_post_thumbnail()){
								$size = apply_filters('truemag_video_thumb_size','thumb_520x293', 'loop');
								$thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
							}else{
								$thumbnail = '<img src="'.(function_exists('tm_get_default_image')?tm_get_default_image():'').'">';
							}
							echo $thumbnail;
							if($format=='' || $format =='standard'){ ?>
							<div class="link-overlay fa fa-search"></div>
                            <?php }else {?>
                            <div class="link-overlay fa fa-play"></div>
                            <?php }  ?>
						</a>
						<?php echo tm_post_rating(get_the_ID());
						$time_video = get_post_meta(get_the_id(),'time_video',true);
						if($time_video!='00:00' && $time_video!='00' && $time_video!='' ){
							echo '<span class="rating-bar bgcolor2 time_dur">'.$time_video.'</span>';
						} ?>
					</div>
                    <?php if($quick_if=='1'){
                        echo '</div>';
                    }?>
					<div class="item-head">
						<h3><a href="<?php the_permalink() ?>" rel="<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h3>
						<div class="item-info hidden">
                        <?php if(ot_get_option('blog_show_meta_author',1)){ ?>
							<span class="item-author"><?php the_author_posts_link(); ?></span>
                        <?php }
							if(ot_get_option('blog_show_meta_date',1)){ ?>
							<span class="item-date"><?php the_time(get_option('date_format')); ?></span>
                       	<?php }?>
							<div class="item-meta">
								<?php echo tm_html_video_meta(false,false,false,true) ?>
							</div>
						</div>
					</div>
					<div class="item-content hidden">
						  <?php
						  $content = new CT_ContentHtml;  
						  $content->ct_remove_viewcount();
						  ?>						
                    </div>
					<div class="clearfix"></div>
				</div>
			</div><!--/col3-->
		<?php
		if($loop_count%4==0){ echo '</div><div class="row">';}
		endwhile;
		echo '</div>';
		tm_display_ads('ad_recurring');
		echo '</div>';
		
	}
?>