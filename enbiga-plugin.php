<?php
/*
Plugin Name: IMGD ENBIGA
Plugin URI: http://imgdigital.com.ar/portfolio/projects/
Description: Este es un Plug-in para el sitio del ENBIGA
Version: 1.0.2
Author: Federico Reinoso
Author URI: http://imgdigital.com.ar
Text Domain: imgd
Domain Path: languages/
Plugin Type: Piklist
License: GPL2
*/

define( 'TURISMO_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

/**
 * Check if Piklist is activated and installed
 */
add_action('init', 'turismo_init_function');
function turismo_init_function()
{
    if(is_admin())
    {
        include_once(plugin_dir_path(__FILE__).'class-piklist-checker.php');

        if (!piklist_checker::check(__FILE__))
        {
            return;
        }
    }
}

/**
 * Loading Translation
 */
function turismo_plugin_init() {
    $plugin_dir = basename(dirname(__FILE__)).'/languages';
    //echo '<h1>'.$plugin_dir.'</h1>';
    load_plugin_textdomain( 'imgd', false, $plugin_dir );
    //wp_enqueue_script( 'enbiga-programa', TURISMO_PLUGIN_PATH.'assets/js/jquery.fitvids.js', array( 'jquery' ), null, true );
}
add_action('plugins_loaded', 'turismo_plugin_init');

/**
 * Definir El Custom Post Type
 *
 * @name: Casino
 * @dependencies: Piklist
 */
add_filter('piklist_post_types', 'turismo_post_type');

function turismo_post_type($post_types)
{
    $singular = 'Chef';
    $plural = 'Chefs';

    $post_types['imgd_chef'] = array(
        'labels' => array(
                'name'               => _x( $plural, 'post type general name', 'imgd' ),
                'singular_name'      => _x( $singular, 'post type singular name', 'imgd' ),
                'menu_name'          => _x( $plural, 'admin menu', 'imgd' ),
                'name_admin_bar'     => _x( $singular, 'add new on admin bar', 'imgd' ),
                'add_new'            => _x( 'Agregue un '.$singular, 'barco', 'imgd' ),
                'add_new_item'       => __( 'Agregue un nuevo '.$singular, 'imgd' ),
                'new_item'           => __( 'Nuevo '.$singular, 'imgd' ),
                'edit_item'          => __( 'Edite el '.$singular, 'imgd' ),
                'view_item'          => __( 'Ver '.$singular, 'imgd' ),
                'all_items'          => __( 'Todos los '.$plural, 'imgd' ),
                'search_items'       => __( 'Buscar '.$plural, 'imgd' ),
                'parent_item_colon'  => __( $singular.' Pariente:', 'imgd' ),
                'not_found'          => __( 'No se encontraron '.$plural, 'imgd' ),
                'not_found_in_trash' => __( 'No se encontraron '.$plural.' en la Basura.', 'imgd' )
            )
        ,'type' => 'page'
        ,'title' => __('Ingrese un nuevo '.$singular, 'imgd')
        ,'description'=>__('Chefs participantes de ENBIGA en sus diferentes ediciones','imgd')
        ,'public' => true
        ,'capability_type' => 'page'
        ,'has_archive' => __('chefs','imgd')
        ,'menu_icon' => 'dashicons-tickets-alt'
        ,'page_icon' => 'dashicons-tickets-alt'
        ,'rewrite' => array(
            'slug' => __('chef', 'imgd')
        )
        /*,'status' => array(
          'draft' => array(
              'label' => __('draft', LANG),
              'public' => false
              ),
          'pending' => array(
              'label' => __('pending', LANG),
              'public' => false
              ),
          'publish' => array(
            'label' => __('publish', LANG),
            'public' => true
        )
      )*/
    ,'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail'
        )
    ,'menu_position'=>20
    ,'edit_columns' => array(
            'title' => __($plural, 'imgd')
        )
    ,'hide_meta_box' => array(
            'slug'
            ,'author'
            ,'revisions'
            ,'comments'
            ,'mymetabox_revslider_0' // Rev Slider Metabox
            ,'postimagediv' //Feature Image div
            ,'commentstatus'
        )
    );

    $singular = 'Periodista';
    $plural = 'Periodistas';

    $post_types['imgd_periodista'] = array(
        'labels' => array(
                'name'               => _x( $plural, 'post type general name', 'imgd' ),
                'singular_name'      => _x( $singular, 'post type singular name', 'imgd' ),
                'menu_name'          => _x( $plural, 'admin menu', 'imgd' ),
                'name_admin_bar'     => _x( $singular, 'add new on admin bar', 'imgd' ),
                'add_new'            => _x( 'Agregue un '.$singular, 'barco', 'imgd' ),
                'add_new_item'       => __( 'Agregue un nuevo '.$singular, 'imgd' ),
                'new_item'           => __( 'Nuevo '.$singular, 'imgd' ),
                'edit_item'          => __( 'Edite el '.$singular, 'imgd' ),
                'view_item'          => __( 'Ver '.$singular, 'imgd' ),
                'all_items'          => __( 'Todos los '.$plural, 'imgd' ),
                'search_items'       => __( 'Buscar '.$plural, 'imgd' ),
                'parent_item_colon'  => __( $singular.' Pariente:', 'imgd' ),
                'not_found'          => __( 'No se encontraron '.$plural, 'imgd' ),
                'not_found_in_trash' => __( 'No se encontraron '.$plural.' en la Basura.', 'imgd' )
            )
        ,'type' => 'page'
        ,'title' => __('Ingrese un nuevo '.$singular, 'imgd')
        ,'public' => true
        ,'capability_type' => 'page'
        ,'has_archive' => __('Periodistas','imgd')
        ,'menu_icon' => 'dashicons-tickets-alt'
        ,'page_icon' => 'dashicons-tickets-alt'
        ,'rewrite' => array(
            'slug' => __('periodista', 'imgd')
        )
        /*,'status' => array(
          'draft' => array(
              'label' => __('draft', LANG),
              'public' => false
              ),
          'pending' => array(
              'label' => __('pending', LANG),
              'public' => false
              ),
          'publish' => array(
            'label' => __('publish', LANG),
            'public' => true
        )
      )*/
    ,'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail'
        )
    ,'menu_position'=>20
    ,'edit_columns' => array(
            'title' => __($plural, 'imgd')
        )
    ,'hide_meta_box' => array(
            'slug'
            ,'author'
            ,'revisions'
            ,'comments'
            ,'mymetabox_revslider_0' // Rev Slider Metabox
            ,'postimagediv' //Feature Image div
            ,'commentstatus'
        )
    );


    return $post_types;
}


/**
 * Definir Taxonomía del Custom Post Type
 *
 * @name: IMGD Ciudad y Pais del Programa
 * @dependencies: Piklist
 */

add_filter('piklist_taxonomies', 'show_categoria');

function show_categoria($taxonomies)
{
$labelUbicaplural = 'Grupos';
  $labelUbicasingular = 'Grupo';

  $labelUbica = array(
    'name'                          => __( $labelUbicaplural, 'imgd' ),
    'singular_name'                 => __( $labelUbicasingular, 'imgd' ),
    'search_items'                  => __( 'Buscar la '.$labelUbicasingular, 'imgd' ),
    'popular_items'                 => __( $labelUbicaplural.' Populares', 'imgd' ),
    'all_items'                     => __( 'Todas las '.$labelUbicaplural, 'imgd' ),
    'parent_item'                   => __( $labelUbicasingular.' pariente', 'imgd' ),
    'edit_item'                     => __( 'Editar '.$labelUbicasingular, 'imgd' ),
    'update_item'                   => __( 'Actualizar '.$labelUbicasingular, 'imgd' ),
    'add_new_item'                  => __( 'Agregar una nueva ',$labelUbicasingular, 'imgd' ),
    'new_item_name'                 => __( 'Nueva '.$labelUbicasingular, 'imgd' ),
    'separate_items_with_commas'    => __( 'Separe las'.$labelUbicaplural.' con comas', 'imgd' ),
    'add_or_remove_items'           => __( 'Agregue o Borre '.$labelUbicaplural, 'imgd' ),
    'choose_from_most_used'         => __( 'Elija alguna '.$labelUbicasingular.' entre las más usadas', 'imgd' )
);
    $taxonomies[] = array(
        'post_type' => array('imgd_chef', 'post', 'page')
        ,'name' => 'imgd_servicio_grupo'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => true
            ,'labels' => $labelUbica
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('grupo', 'imgd')
                )
            )
    );


  $labelUbicaplural = 'Ciudades';
  $labelUbicasingular = 'Ciudad';

  $labelUbica = array(
    'name'                          => __( $labelUbicaplural, 'imgd' ),
    'singular_name'                 => __( $labelUbicasingular, 'imgd' ),
    'search_items'                  => __( 'Buscar la '.$labelUbicasingular, 'imgd' ),
    'popular_items'                 => __( $labelUbicaplural.' Populares', 'imgd' ),
    'all_items'                     => __( 'Todas las '.$labelUbicaplural, 'imgd' ),
    'parent_item'                   => __( $labelUbicasingular.' pariente', 'imgd' ),
    'edit_item'                     => __( 'Editar '.$labelUbicasingular, 'imgd' ),
    'update_item'                   => __( 'Actualizar '.$labelUbicasingular, 'imgd' ),
    'add_new_item'                  => __( 'Agregar una nueva ',$labelUbicasingular, 'imgd' ),
    'new_item_name'                 => __( 'Nueva '.$labelUbicasingular, 'imgd' ),
    'separate_items_with_commas'    => __( 'Separe las'.$labelUbicaplural.' con comas', 'imgd' ),
    'add_or_remove_items'           => __( 'Agregue o Borre '.$labelUbicaplural, 'imgd' ),
    'choose_from_most_used'         => __( 'Elija alguna '.$labelUbicasingular.' entre las más usadas', 'imgd' )
);
    $taxonomies[] = array(
        'post_type' => array('imgd_periodista','imgd_chef', 'post', 'page')
        ,'name' => 'imgd_servicio_ciudad'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => true
            ,'labels' => $labelUbica
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('ciudad', 'imgd')
                )
            )
    );

    

    $labelevento = array(
      'name'                          => __( 'Eventos', 'imgd' ),
      'singular_name'                 => __( 'Evento', 'imgd' ),
      'search_items'                  => __( 'Buscar la Evento', 'imgd' ),
      'popular_items'                 => __( 'Eventos Populares', 'imgd' ),
      'all_items'                     => __( 'Todas las Eventos', 'imgd' ),
      'parent_item'                   => __( 'Evento pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar Evento', 'imgd' ),
      'update_item'                   => __( 'Actualizar Evento', 'imgd' ),
      'add_new_item'                  => __( 'Agregar una nueva Evento', 'imgd' ),
      'new_item_name'                 => __( 'Nueva Evento', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe las Eventos con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre Eventos', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija algún Evento entre las más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_periodista','imgd_chef', 'page', 'post')
        ,'name' => 'imgd_servicio_categoria'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelevento
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('evento', 'imgd')
                )
            )
    );

    return $taxonomies;

}

/*
* Obtengo los últimos Programas
*
* @param number $cant default 'All' (-1)
* @return object WP Query
*/
function get_ultimos_programas($cant='-1'){
  $args = array(
      'post_type' => array('imgd_chef'),
      'post_status' => 'publish',
      'posts_per_page' => intval($cant)
  );
  //echo var_dump($args);
  $loop = new WP_Query($args);

  return $loop;
}

/**
 * Get terms dropdown
 *
 * Arma un Dropdwn de los términos de las Eventos
 *
 * @param $taxonomies
 * @param $args
 * @return string
 */
function get_terms_dropdown($taxonomies, $args){

    $myterms = get_terms($taxonomies, $args);

    $output ="<select name='.$taxonomies.'>";

    foreach($myterms as $term){
        $root_url = get_bloginfo('url');
        $term_taxonomy=$term->taxonomy;
        $term_slug=$term->slug;
        $term_name =$term->name;
         $link = get_term_link($term->term_id, $term->taxonomy);
        $output .="<option value='".$link."'>".$term_name."</option>";
    }
    $output .="</select>";
    return $output;
}

// add_filter('piklist_admin_pages', 'imgd_casino_setting_pages');
// function imgd_casino_setting_pages($pages)
// {
//     $pages[] = array(
//         'page_title' => __('Preferencias Casino','imgd')
//     ,'menu_title' => __('Casino', 'imgd')
//     ,'capability' => 'manage_options'
//     ,'menu_slug' => 'custom_settings'
//     ,'setting' => 'casino_settings'
//     ,'menu_icon' => plugins_url('casino-plugin/assets/img/casino-icono.png')
//     ,'page_icon' => plugins_url('casino-plugin/assets/img/casino-icono-32.png')
//     ,'single_line' => true
//     ,'position'=> '59'
//     ,'default_tab' => 'Pozos'
//     ,'save_text' => __('Actualizar','imgd')
//     );
//
//     return $pages;
// }


function imgd_get_email(){
    return $imgd_email;
}


/* Datos del Video */
function get_datos_video($post_ID){
  $datos='';

  $nro = get_post_meta($post_ID , 'imgd_chef_nro', true);
  $produccion = get_post_meta($post_ID , 'imgd_chef_produccion', true);
  $director = get_post_meta($post_ID , 'imgd_chef_director', true);
  $ano = get_post_meta($post_ID , 'imgd_chef_ano', true);

  if($nro) $datos .= '<strong>Programa Nro:</strong> '.$nro.'<br>';
  if($produccion) $datos .= '<strong>Productor:</strong> '.$produccion.'<br>';
  if($director) $datos .= '<strong>Director:</strong> '.$director.'<br>';
  if($ano) $datos .= '<strong>Año:</strong> '.$ano.'<br>';

  if($datos!='') $datos = '<div class="datos"> <h3>'.__('Datos de Producción', 'imgd').'</h3>'.$datos.'</div>';

  return $datos;
}


/* Datos del servicio */
function get_datos_servicio($post_ID, $meta='', $title=''){
  $datos='';
  $datas = array();

  if ($meta != ''){
    $datas = get_post_meta($post_ID, $meta);
    $datas = array_filter($datas);

      if (!empty($datas)) {
        if ($title!='') $datos .= '<strong>'.$title.'</strong> ';
        foreach ($datas as $dato) {
          $datos .= $dato.'<br>';
        }
      }
  }

  return $datos;
}



/*
 * Obtengo la Fecha del Show
 */
function get_imgd_casino_show_date($post_ID){

    $data='';

    $fecha = get_post_meta($post_ID , 'imgd_casino_show_date', true);

    if (!empty($fecha)) {
        $data ='<h5>El '.$fecha.' a las '. get_post_meta($post_ID , 'imgd_casino_show_hora', true).'</h5>';
    }

    return $data;
}

/*
 * Obtengo el nombre de Salón
 */
function get_imgd_casino_show_salon($post_ID){

    $data='';

    $salones = get_post_meta($post_ID , 'imgd_casino_show_salon');
//echo var_dump($salones);
    $salon = get_term( $salones[0],'imgd_casino_salon');


    if(!empty($salon)) {
        $data = '<h4>'.$salon->name.'</h4>';
    }

    return $data;
}

if (!function_exists('imgd_paises')){
/**
* IMGD Paises
* Devuelve un array con los países
*
**/
function imgd_paises(){
    $paises = array
        (
        93 => "Afghanistan",
        355 => "Albania",
        213 => "Algeria",
        1 => "American Samoa",
        376 => "Andorra",
        244 => "Angola",
        1 => "Anguilla",
        1 => "Antigua and Barbuda",
        54 => "Argentina",
        374 => "Armenia",
        297 => "Aruba",
        247 => "Ascension",
        61 => "Australia",
        43 => "Austria",
        994 => "Azerbaijan",
        1 => "Bahamas",
        973 => "Bahrain",
        880 => "Bangladesh",
        1 => "Barbados",
        375 => "Belarus",
        32 => "Belgium",
        501 => "Belize",
        229 => "Benin",
        1 => "Bermuda",
        975 => "Bhutan",
        591 => "Bolivia",
        387 => "Bosnia and Herzegovina",
        267 => "Botswana",
        55 => "Brazil",
        1 => "British Virgin Islands",
        673 => "Brunei",
        359 => "Bulgaria",
        226 => "Burkina Faso",
        257 => "Burundi",
        855 => "Cambodia",
        237 => "Cameroon",
        1 => "Canada",
        238 => "Cape Verde",
        1 => "Cayman Islands",
        236 => "Central African Republic",
        235 => "Chad",
        56 => "Chile",
        86 => "China",
        57 => "Colombia",
        269 => "Comoros",
        242 => "Congo",
        682 => "Cook Islands",
        506 => "Costa Rica",
        385 => "Croatia",
        53 => "Cuba",
        357 => "Cyprus",
        420 => "Czech Republic",
        243 => "Democratic Republic of Congo",
        45 => "Denmark",
        246 => "Diego Garcia",
        253 => "Djibouti",
        1 => "Dominica",
        1 => "Dominican Republic",
        670 => "East Timor",
        593 => "Ecuador",
        20 => "Egypt",
        503 => "El Salvador",
        240 => "Equatorial Guinea",
        291 => "Eritrea",
        372 => "Estonia",
        251 => "Ethiopia",
        500 => "Falkland (Malvinas) Islands",
        298 => "Faroe Islands",
        679 => "Fiji",
        358 => "Finland",
        33 => "France",
        594 => "French Guiana",
        689 => "French Polynesia",
        241 => "Gabon",
        220 => "Gambia",
        995 => "Georgia",
        49 => "Germany",
        233 => "Ghana",
        350 => "Gibraltar",
        30 => "Greece",
        299 => "Greenland",
        1 => "Grenada",
        590 => "Guadeloupe",
        1 => "Guam",
        502 => "Guatemala",
        224 => "Guinea",
        245 => "Guinea-Bissau",
        592 => "Guyana",
        509 => "Haiti",
        504 => "Honduras",
        852 => "Hong Kong",
        36 => "Hungary",
        354 => "Iceland",
        91 => "India",
        62 => "Indonesia",
        870  => "Inmarsat Satellite",
        98 => "Iran",
        964 => "Iraq",
        353 => "Ireland",
        972 => "Israel",
        39 => "Italy",
        225 => "Ivory Coast",
        1 => "Jamaica",
        81 => "Japan",
        962 => "Jordan",
        7 => "Kazakhstan",
        254 => "Kenya",
        686 => "Kiribati",
        965 => "Kuwait",
        996 => "Kyrgyzstan",
        856 => "Laos",
        371 => "Latvia",
        961 => "Lebanon",
        266 => "Lesotho",
        231 => "Liberia",
        218 => "Libya",
        423 => "Liechtenstein",
        370 => "Lithuania",
        352 => "Luxembourg",
        853 => "Macau",
        389 => "Macedonia",
        261 => "Madagascar",
        265 => "Malawi",
        60 => "Malaysia",
        960 => "Maldives",
        223 => "Mali",
        356 => "Malta",
        692 => "Marshall Islands",
        596 => "Martinique",
        222 => "Mauritania",
        230 => "Mauritius",
        262 => "Mayotte",
        52 => "Mexico",
        691 => "Micronesia",
        373 => "Moldova",
        377 => "Monaco",
        976 => "Mongolia",
        382 => "Montenegro",
        1 => "Montserrat",
        212 => "Morocco",
        258 => "Mozambique",
        95 => "Myanmar",
        264 => "Namibia",
        674 => "Nauru",
        977 => "Nepal",
        31 => "Netherlands",
        599 => "Netherlands Antilles",
        687 => "New Caledonia",
        64 => "New Zealand",
        505 => "Nicaragua",
        227 => "Niger",
        234 => "Nigeria",
        683 => "Niue Island",
        850 => "North Korea",
        1 => "Northern Marianas",
        47 => "Norway",
        968 => "Oman",
        92 => "Pakistan",
        680 => "Palau",
        507 => "Panama",
        675 => "Papua New Guinea",
        595 => "Paraguay",
        51 => "Peru",
        63 => "Philippines",
        48 => "Poland",
        351 => "Portugal",
        1 => "Puerto Rico",
        974 => "Qatar",
        262 => "Reunion",
        40 => "Romania",
        7 => "Russian Federation",
        250 => "Rwanda",
        290 => "Saint Helena",
        1 => "Saint Kitts and Nevis",
        1 => "Saint Lucia",
        508 => "Saint Pierre and Miquelon",
        1 => "Saint Vincent and the Grenadines",
        685 => "Samoa",
        378 => "San Marino",
        239 => "Sao Tome and Principe",
        966 => "Saudi Arabia",
        221 => "Senegal",
        381 => "Serbia",
        248 => "Seychelles",
        232 => "Sierra Leone",
        65 => "Singapore",
        421 => "Slovakia",
        386 => "Slovenia",
        677 => "Solomon Islands",
        252 => "Somalia",
        27 => "South Africa",
        82 => "South Korea",
        34 => "Spain",
        94 => "Sri Lanka",
        249 => "Sudan",
        597 => "Suriname",
        268 => "Swaziland",
        46 => "Sweden",
        41 => "Switzerland",
        963 => "Syria",
        886 => "Taiwan",
        992 => "Tajikistan",
        255 => "Tanzania",
        66 => "Thailand",
        228 => "Togo",
        690 => "Tokelau",
        1 => "Trinidad and Tobago",
        216 => "Tunisia",
        90 => "Turkey",
        993 => "Turkmenistan",
        1 => "Turks and Caicos Islands",
        688 => "Tuvalu",
        256 => "Uganda",
        380 => "Ukraine",
        971 => "United Arab Emirates",
        44 => "United Kingdom",
        1 => "United States of America",
        1 => "U.S. Virgin Islands",
        598 => "Uruguay",
        998 => "Uzbekistan",
        678 => "Vanuatu",
        379 => "Vatican City",
        58 => "Venezuela",
        84 => "Vietnam",
        681 => "Wallis and Futuna",
        967 => "Yemen",
        260 => "Zambia",
        263 => "Zimbabwe"
        );
        return $paises;
}
}