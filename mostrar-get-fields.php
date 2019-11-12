<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package itv
 */

get_header();
$fields = get_fields(11);
if( $fields ): ?>
  <ul style="background-color: gold; margin-top: 50px">
      <?php foreach( $fields as $name => $value ): ?>
        <li><b><?php echo $name; ?></b> <?php echo $value; ?></li>
      <?php endforeach; ?>
  </ul>
<?php endif;

?>

<?php


//get_template_part( 'template-parts/banner', get_post_type() );
include( locate_template( 'template-parts/banner.php' ) );
//  get_template_part( 'template-parts/cita', get_post_type() );
include( locate_template( 'template-parts/cita.php' ) );
//  get_template_part( 'template-parts/cita-previa', get_post_type() );
include( locate_template( 'template-parts/cita-previa.php' ) );
//  get_template_part( 'template-parts/parallax', get_post_type() );
include( locate_template( 'template-parts/parallax.php' ) );
//  get_template_part( 'template-parts/call-service', get_post_type() );
include( locate_template( 'template-parts/call-service.php' ) );
//  get_template_part( 'template-parts/servicios', get_post_type() );
include( locate_template( 'template-parts/servicios.php' ) );
//  get_template_part( 'template-parts/buscador', get_post_type() );
include( locate_template( 'template-parts/buscador.php' ) );

//  get_template_part( 'template-parts/section', get_post_type() );
include( locate_template( 'template-parts/section.php' ) );
//  get_template_part( 'template-parts/consultas-populares', get_post_type() );
include( locate_template( 'template-parts/consultas-populares.php' ) );
//  get_template_part( 'template-parts/blog', get_post_type() );
include( locate_template( 'template-parts/blog.php' ) );
  // get_template_part( 'template-parts/content', get_post_type() );


?>



<?php
// get_sidebar();
get_footer();


