<?php

    require_once "vendor/autoload.php";
    

    $collection = (new MongoDB\Client)->testdb;


    //$all__services = $collection->service->find()->toArray();

    $all__sellers = $collection->users->find([
        'role'  => 'seller',
        'rating' => 5
    ])->toArray();

    
    

    



    
?>