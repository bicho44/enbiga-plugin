<?php
/*
Title: Imagenes Personalizada
Post Type: imgd_chefs, imgd_invitado, post, page
Description: Imagen Principal
Order: 3
Context: side
*/

piklist('field', array(
    'type' => 'file'
    ,'field' => '_thumbnail_id' // Use these field to match WordPress featured images.
    ,'scope' => 'post_meta'
    ,'options' => array(
        'title' => __('Imagen Principal', 'imgd')
        ,'button' => __('Inserte la imagen Principal', 'imgd')
    )
));