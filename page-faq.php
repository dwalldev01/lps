<?php
/* 
Template Name: FAQ Page
*/
 get_header(); ?>
<div id="wrapper">
<div class="container">
    <div class="row">
  <div class="acoordian faq">
    <div class="acoordian-right">
        <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">


<h2><?php the_title(); ?></h2>

<?php $faqterms = get_terms( array(
    'taxonomy' => 'faq_category',
    'hide_empty' => false,
) );

?>
<?php if ( ! empty( $faqterms ) && ! is_wp_error( $faqterms ) )
{

	  foreach ( $faqterms as $term ) {
	?><br>
	<h3><?php _e($term->name); ?></h3>
	<?php
	$allfaq = get_posts(array(
  'post_type' => 'faq',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'faq_category',
      'field' => 'id',
      'terms' => $term->term_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));

	foreach ( $allfaq as $faq )
	{
	
	?>
	  <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingEleven">
              <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php _e($faq->ID);?>" aria-expanded="true" aria-controls="collapseEleven">Q. <?php _e($faq->post_title);?></a> </h4>
            </div>
            
            <div id="collapse<?php _e($faq->ID);?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
              <div class="panel-body"> 
              <?php _e($faq->post_content);?> 
              </div>
            </div>
            
          </div>
    
	
	<?php }
?>
<?php 
	  }
} 

?>
  

</div>
</div>
</div>


</div>

 </div>   
</div>
</div>
<?php get_footer(); ?>