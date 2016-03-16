<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
			<?php
				$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
				$article_steps_meta = get_post_meta($post->ID, 'meta-step', true);
		
				$string ='<table cellspacing="5" cellpadding="5" border="0" >';
				$string .= '<tr><td colspan="2" valign="top"><strong>'.get_the_title($post->ID).'</strong></td></tr>';

				if(isset($thumb_image_url[0])){
					$string .='<tr><td><img src="'.$thumb_image_url[0].'" alt="'.get_the_content($post->ID).'" width="'.$thumb_image_url[1].'" height="'.$thumb_image_url[2].'"></td><td style="vertical-align:top;">'.get_the_content($post->ID).'</td> </TR>';
				}else{
					$string .='<tr><td colspan="2" valign="top">'.get_the_content($post->ID).'</td> </tr>';
				}


		if(count($article_steps_meta["step"])) {
			$string .='<tr><td colspan="2">&nbsp;</td></tr><tr><td colspan="2"><table cellspacing="5" cellpadding="5" border="0"><tr>';
			for($i=0;$i<count($article_steps_meta["step"]);$i++){ 	
				if(isset($article_steps_meta["step_image"][$i])){
				 $kk=wp_get_attachment_image_src( $article_steps_meta["step_image"][$i], 'thumbnail', true );
				 $imgString='<img src="'.$kk[0].'" width="'.$kk[1].'"  height="'.$kk[2].'" >';				
				} else {
					$imgString='';
				}

				$string .='<td width="33%" valign="top">' .$imgString.'<br><br><strong>'.$article_steps_meta["step"][$i].' </strong><br><br>'.$article_steps_meta["step_title"][$i].'<br><br><strong>'.substr($article_steps_meta["note"][$i],0,125).'</strong></td>';
								
				if(($i+1)%3==0) {$string .='</tr><tr>';}
			} 

			$string .='</tr></table></td></tr></table>';
		}
		
		echo $string .=' </div>';
		?>
			</article><!-- #post -->
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();