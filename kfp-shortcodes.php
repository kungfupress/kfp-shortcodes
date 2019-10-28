<?php
/**
 * Plugin Name:  KFP Shortcodes
 * Description: Ejemplos de shortcodes con fines didácticos
 * Plugin URI:   https://github.com/kungfupress/kfp-shortcodes
 * Version:      0.0.1
 * Author:       Juanan Ruiz
 * Author URI:   https://kungfupress.com/
 * PHP Version:  5.6
 *
 * @category Shortcode
 * @package  KFP Shortcodes
 * @author   Juanan Ruiz <kungfupress@gmail.com>
 * @license  GPLv2 http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://github.com/kungfupress/kfp-shortcodes
 */

add_shortcode( 'kfp_multiplica', 'kfp_multiplica' );
/**
 * Multiplica los parámetros x e y pasados en la llamada al shortcode.
 *
 * @param int $parametros  Multiplicandos.
 * @return int
 */
function kfp_multiplica( $parametros ) {
	$x = (int) $parametros['x'];
	$y = (int) $parametros['y'];
	return $x * $y;
}

add_shortcode( 'kfp_short_con_contenido', 'kfp_contenido' );
/**
 * Undocumented function
 *
 * @param array  $atts       Opciones para el shortcode.
 * @param string $contenido  Cadena que se mostrará.
 *
 * @return string
 */
function kfp_contenido( $atts, $contenido = '' ) {
	return "contenido = $contenido";
}

add_shortcode( 'kfp_entradas_recientes', 'kfp_entradas_recientes' );
/**
 * Muestra una lista de entradas recientes.
 *
 * @param array $atts opciones para personalizar el listado.
 * @return string
 */
function kfp_entradas_recientes( $atts ) {
	WP_Query(
		array(
			'orderby'   => 'date',
			'order'     => 'DESC',
			'showposts' => $atts['numero_entradas'],
		)
	);
	if ( have_posts() ) :
		$contenido = '<ul>';
		while ( have_posts() ) :
			the_post();
			$contenido .= '<li><a href="' . get_permalink() . '">'
				. get_the_title() . '</a></li>';
		endwhile;
		$contenido .= '<ul>';
	endif;
	wp_reset_postdata();
	return $contenido;
}
