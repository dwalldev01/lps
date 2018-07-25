<?php 
/* 
Template Name: About Us Page
*/
get_header(); ?>
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 100%;
    height: auto;
}

/* Style the buttons inside the tab */
.tab button {
    display: block;
    background-color: #fff;
    color: #0c0cef;
    padding: 12px 10px;
    width: 100%;
    border-top: none;
    border-bottom:1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #f1f1f1;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #f1f1f1;
    color:red;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: none;
    width: 100%;
    border-left: none;
    height: auto;
}
.certificate-area .courses1 {
    width:100%;

}
</style>
<style>
.footer-social {
    margin: 0 110px;
}
.enrol-section form {
    text-align: center;
}
</style>

<script>function refresh() {

    setTimeout(function () {
        location.reload()
    }, 100);
}</script>  
  <!-- Header Area End Here --> 
  

  <?php
global $currentpost;
  while ( have_posts() ) : the_post();
$currentpost=$post->ID;
  ?>

  <div class="inner-page-banner-area1">
    <div class="container">
      <div class="pagination-area">
        <h1><?php the_title(); ?></h1>
        <ul>
          <li><a href="<?php _e(get_option('siteurl')); ?>"><?php _e("Home"); ?></a> - </li>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    </div>
  </div>
  
  <!-- Inner Page Banner Area End Here -->
  
  <div class="clr" style="clear:both"></div>
  

  
  <!-- Certificate Area Start Here -->
  
  <div class="certificate-area" style="background-color:#f3f3f3">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
		
          <div class="tab">
		  <?php _e(cm_list_child_pages());?>
   
</div>
        </div>
        <div class="col-sm-9">
          <div class="courses-page-top-area">
            <div class="courses1">
			<?php
			global $post; 
 
if ( is_page() && $post->post_parent )
{ 

 $args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->post_parent,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );
}else 
{
 $args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );	
}	
	
$childpages = new WP_Query( $args );

//print_r($childpages);
 if ( $childpages->have_posts() ) :
			   while ( $childpages->have_posts() ) : $childpages->the_post();
			?>
                      <div id="<?php the_ID(); ?>" class="tabcontent">
             <h3><?php the_title(); ?></h3>
             <?php the_content(); ?>      </div>
			       <?php endwhile; ?>

<?php endif; wp_reset_postdata(); ?>
                
                 

		 </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
<?php endwhile; // end of the loop. ?>				

 </div>
</div>
<script>
function openCity(evt, cityName) {
	
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen<?php global $aboutusfirstpost; _e($aboutusfirstpost);?>").click();
document.getElementById("defaultOpen<?php _e($currentpost);?>").click();
</script>



<div class="section-divider"></div>


<!-- Footer Area Start Here -->
<?php get_footer(); ?>