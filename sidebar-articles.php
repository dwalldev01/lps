<div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
			   
			   
<?php 
	global $post;	
global $currentterms;
$articleterms = get_terms( array(
    'taxonomy' => 'article_category',
    'hide_empty' => false,
) );

?>
<?php if ( ! empty( $articleterms ) && ! is_wp_error( $articleterms ) )
{

	  foreach ( $articleterms as $term ) {
	?>
	 <div class="panel panel-default">
                    <div class="panel-heading active">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#articlesection_<?php _e($term->term_id);?>"><span class="glyphicon glyphicon-folder-close">
                            </span><?php _e($term->name); ?></a>
                        </h4> 
                    </div> 
                    <div id="articlesection_<?php _e($term->term_id);?>" class="panel-collapse collapse <?php if($currentterms[0]->term_id==$term->term_id) { _e(" in "); } ?>">
                        <div class="panel-body">
                            <table class="table">
	
	<?php
	$allarticles = get_posts(array(
  'post_type' => 'articles',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'article_category',
      'field' => 'id',
      'terms' => $term->term_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));

	foreach ( $allarticles as $article )
	{
	
	?>
	    <tr>
                                    <td>
                                       <a href="<?php _e(get_permalink($article->ID));?>" id="<?php _e($article->ID);?>" 
									   class="<?php if($post->ID==$article->ID) { _e(" active "); } ?>" ><?php _e($article->post_title);?></a>
                                    </td>
                                </tr>
<?php }
?>
</table>
                        </div>
                    </div>
                </div>
				

<?php 
	  }
} ?>

		
            
				            </div>
        </div>
     