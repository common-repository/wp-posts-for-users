<?php
/*
Plugin Name: Posts and products for users
Plugin URI: https://danielesparza.studio/wp-posts-for-users/
Description: Posts and products for users, es un plugin para WordPress que permite mostrar una categoría de artículos (posts) o productos a usuarios registrados a través  del uso de un shortcode. Este plugin hace uso de algunos recursos de bootstrap 4.3.0.
Version: 1.0
Author: Daniel Esparza
Author URI: https://danielesparza.studio/
License: GPL v3

Posts and products for users
©2020 Daniel Esparza, inspirado por #openliveit #dannydshore | Consultoría en servicios y soluciones de entorno web - https://danielesparza.studio/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(function_exists('admin_menu_desparza')) { 
    //menu exist
} else {
	add_action('admin_menu', 'admin_menu_desparza');
	function admin_menu_desparza(){
		add_menu_page('DE Plugins', 'DE Plugins', 'manage_options', 'desparza-menu', 'wp_desparza_function', 'dashicons-editor-code', 90 );
		add_submenu_page('desparza-menu', 'Sobre Daniel Esparza', 'Sobre Daniel Esparza', 'manage_options', 'desparza-menu' );
	
    function wp_desparza_function(){  	
	?>
		<div class="wrap">
            <h2>Daniel Esparza</h2>
            <p>Consultoría en servicios y soluciones de entorno web.<br>¿Qué tipo de servicio o solución necesita tu negocio?</p>
            <h4>Contact info:</h4>
            <p>
                Sitio web: <a href="https://danielesparza.studio/" target="_blank">https://danielesparza.studio/</a><br>
                Contacto: <a href="mailto:hi@danielesparza.studio" target="_blank">hi@danielesparza.studio</a><br>
                Messenger: <a href="https://www.messenger.com/t/danielesparza.studio" target="_blank">enviar mensaje</a><br>
                Información acerca del plugin: <a href="https://danielesparza.studio/wp-posts-for-users/" target="_blank">sitio web del plugin</a><br>
                Daniel Esparza | Consultoría en servicios y soluciones de entorno web.<br>
                ©2020 Daniel Esparza, inspirado por #openliveit #dannydshore
            </p>
		</div>
	<?php }
        
    }	
    
    add_action( 'admin_enqueue_scripts', 'wppfu_register_adminstyle' );
    function wppfu_register_adminstyle() {
        wp_register_style( 'wppfu_register_adminstyle_css', plugin_dir_url( __FILE__ ) . 'css/wppfu_style_admin.css', array(), '1.0' );
        wp_enqueue_style( 'wppfu_register_adminstyle_css' );
    }
    
}


if ( ! function_exists( 'wp_pp_for_users_add' ) ) {

add_action( 'admin_menu', 'wp_pp_for_users_add' );
function wp_pp_for_users_add() {
    add_submenu_page('desparza-menu', 'P&P for users', 'P&P for users', 'manage_options', 'wp-pp-for-users-settings', 'wppfu_how_to_use' );
}

function wppfu_how_to_use(){ 
    echo '
    <div class="wrap">
		<h2>Posts and products for users</h2>
		<p>Posts and products for users, es un plugin para WordPress que permite mostrar una categoría de artículos (posts) o productos a usuarios registrados a través  del uso de un shortcode. Este plugin hace uso de algunos recursos de bootstrap 4.3.0.</p>
        <h2>¿Como usar el shortcode para artículos o entradas?</h2>
        <ul>
			<li>[wppfu_posts_for_users post_type="post" post_number="4"] // Muestra 4 entradas de todas las categorías.</li>
            <li>[wppfu_posts_for_users post_type="post" label_btn="Ver más"] // Cambia la etiqueta del botón Leer más.</li>
            <li>[wppfu_posts_for_users post_type="post" post_col="2"] // Muestra 2 columnas de entradas (solo desktop 2, 3 y 4 columnas).</li>
            <li>[wppfu_posts_for_users post_type="post" post_id="ID" post_number="NUMBER" order_post="DESC"] // order_post="DESC" ordena los post ascendente o descendente.</li>
            <li>[wppfu_posts_for_users post_type="post" post_id="ID" post_number="NUMBER" excerpt_post="15"] // excerpt_post="15" es el número de palabras para mostrar (longitud del extracto).</li>
			<li>[wppfu_posts_for_users post_type="post" post_id="ID" post_number="NUMBER" msg_user="TEXT"] // msg_user="TEXT" muestra un mensaje a los usuarios registrados si no hay entradas.</li>
            <li>[wppfu_posts_for_users post_type="post" post_id="ID" post_number="NUMBER" msg_non_user="TEXT"] // msg_non_user="TEXT" muestra un mensaje a los usuarios no registrados.</li>
        </ul>
        <h2>¿Como usar el shortcode para productos?</h2>
        <ul>
			<li>[wppfu_posts_for_users post_type="product" post_number="4"] // Muestra 4 productos de todas las categorías.</li>
            <li>[wppfu_posts_for_users post_type="product" label_btn="Comprar"] // Cambia la etiqueta del botón Leer más.</li>
            <li>[wppfu_posts_for_users post_type="product" post_col="2"] // Muestra 2 columnas de productos (solo desktop 2, 3 y 4 columnas).</li>
            <li>[wppfu_posts_for_users post_type="product" post_products="slug" post_number="NUMBER" order_products="rand"] // order_products="rand" ordena los productos aleatoriamente.</li>
            <li>[wppfu_posts_for_users post_type="product" post_products="slug" post_number="NUMBER" excerpt_post="15"] // excerpt_post="15" es el número de palabras para mostrar (longitud del extracto).</li>
			<li>[wppfu_posts_for_users post_type="product" post_products="slug" post_number="NUMBER" msg_user="TEXT"] // msg_user="TEXT" muestra un mensaje a los usuarios registrados si no hay entradas.</li>
            <li>[wppfu_posts_for_users post_type="product" post_products="slug" post_number="NUMBER" msg_non_user="TEXT"] // msg_non_user="TEXT" muestra un mensaje a los usuarios no registrados.</li>
        </ul>
    </div>';
}

// Add style and scripts
add_action('wp_enqueue_scripts', 'wppfu_posts_for_users_ss');
function wppfu_posts_for_users_ss() {
    //css
    wp_register_style( 'wppfu_style_css', plugin_dir_url( __FILE__ ) . 'css/wppfu_style.css', array(), '1.0' );
    wp_register_style( 'wppfu_bootstrap', plugin_dir_url( __FILE__ ) . 'css/wppfu_bootstrap.css', array(), '1.0' );
    wp_enqueue_style( 'wppfu_style_css' );
    wp_enqueue_style( 'wppfu_bootstrap' );
    //scripts
}

// Add function
add_shortcode('wppfu_posts_for_users', 'wppfu_posts_for_users_function');
function wppfu_posts_for_users_function($atts){
ob_start();
	
    extract( shortcode_atts( array(
      'post_type' => '', //post or proudct
      'post_id' => '', //id
      'post_products' => '', //slug        
      'post_number' => '4',
      'post_col' => '4',
      'order_post' => 'DESC', //order post 
      'order_products' => '', //order products  
      'excerpt_post' => '15',
      'label_btn' => 'Leer más',	
      'msg_user' => 'No hay contenido para mostrar, por favor revisa el shortcode',
      'msg_non_user' => 'Este contenido solo esta disponible para miembros registrados.'
    ), $atts ) );
    
    global $current_user;
    get_currentuserinfo();
    
    $post_col = 12 / $post_col;
    
    if ( is_user_logged_in() && $post_type == NULL) { ?>
        <div class="alert alert-secondary" role="alert"><?php echo esc_attr($msg_user); ?></div>
	<?php } elseif (is_user_logged_in() && $post_type == 'product') { ?>

    <div class="row">
	<?php $wc_query_products = new WP_Query( 'post_type=product&product_cat='.$post_products.'&posts_per_page='.$post_number.'&orderby='.$order_products.''); ?>
    <?php while ( $wc_query_products->have_posts() ) : $wc_query_products->the_post(); ?>

        <div class="col-xs-12 col-md-6 col-lg-<?php echo $post_col; ?>">
			<div class="card">
			  <img class="card-img-top" src="<?php if(has_post_thumbnail()){echo get_the_post_thumbnail_url();}else{echo plugin_dir_url( __FILE__ ) . 'img/default.png';}?>">
			  <div class="card-body">
				<h5 class="card-title"><?php the_title(); ?></h5>
				<p class="card-text"><?php $excerpt = get_the_excerpt(); echo wp_trim_words( $excerpt, $excerpt_post ); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php echo esc_attr($label_btn); ?></a>
			  </div>
			</div>	
		</div>
                    
    <?php endwhile; ?>        
    </div>    
    <?php wp_reset_postdata(); ?>	

    <?php } elseif (is_user_logged_in() && $post_type == 'post') { ?>

	<div class="row">
	<?php $catquery = new WP_Query( 'cat='.$post_id.'&posts_per_page='.$post_number.'&order='.$order_post.'' ); ?>
	<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
		
	  	<div class="col-xs-12 col-md-6 col-lg-<?php echo $post_col; ?>">
			<div class="card">
			  <img class="card-img-top" src="<?php if(has_post_thumbnail()){echo get_the_post_thumbnail_url();}else{echo plugin_dir_url( __FILE__ ) . 'img/default.png';}?>">
			  <div class="card-body">
				<h5 class="card-title"><?php the_title(); ?></h5>
				<p class="card-text"><?php $excerpt = get_the_excerpt(); echo wp_trim_words( $excerpt, $excerpt_post ); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php echo esc_attr($label_btn); ?></a>
			  </div>
			</div>	
		</div>
	
	<?php endwhile; ?>
	</div>
	<?php wp_reset_postdata(); ?>	
															  
    <?php } else { ?>
        <div class="alert alert-secondary" role="alert"><?php echo esc_attr($msg_non_user); ?></div>
    <?php }
    
$output_string = ob_get_contents();
ob_end_clean();
return $output_string;
}
}