<?php

// Definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'geners',
];

// Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if ( !in_array($resourceType, $allowedResourceTypes) ){
    die;
}

// Defino los recursos
$books = [
    1 => [
        'titulo' => 'Lo que el viento se lleno',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'titulo' => 'El Quijote',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
    3 => [
        'titulo' => 'La Odisea',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
];

header( 'Content-Type: application/json');

// Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';
// Generamos la respuesta, suponiendo que el pedido es correcto
switch( strtoupper($_SERVER['REQUEST_METHOD']) ){
    case 'GET':
        if( empty( $resourceId )){
            echo json_encode( $books );
        } else {
            if( array_key_exists( $resourceId, $books) ){
                echo json_encode( $books[ $resourceId ]);
            }
        }
    case 'POST':
        $json = file_get_contents('php://input');

        $books[] = json_decode( $json, true );

        // echo array_keys( $books )[ count($books) - 1 ];
        echo json_encode( $books );
    case 'PUT':
        break;
    case 'DELETE':
        break;  
}