<?php
    require_once "db.php";

    // GET

    function getOneDocument($collection , $id)
    {
        $service = $collection->service->find(['_id' => new MongoDB\BSON\ObjectID($id)])->toArray();

        echo json_encode($service);
    }

    function getCategory($collection, $page_number) 
    {
        $page_number = ($page_number == 0 or $page_number == null) ? 1 : $page_number;
        
        $limit = 24;
        $offset = ($limit * $page_number) - $limit;

        $options = [
            "limit" => 24,
            "skip" => $offset
        ];

        $all__category = $collection->category->find([],$options)->toArray();
        
        echo json_encode($all__category);
    }


    function getLetter($collection){
        $all__category = $collection->category->find([])->toArray();
        
        echo json_encode($all__category);
    }

    function getAccount($collection , $username)
    {
        $one__user = $collection->users->find(['username' => $username])->toArray();

        echo json_encode($one__user);
    }

    function getMyServices($collection , $username)
    {
        $services = $collection->service->find(['creator' => $username])->toArray();

        echo json_encode($services);
    }

    function getSubcategory($collection , $id) 
    {
        $id = (int) $id;
        $one__category = $collection->category->find(['id' => $id])->toArray();

        echo json_encode($one__category);
    }

    function getSellers($all__sellers)
    {
        echo json_encode($all__sellers);
    }

    function getServices($collection , $id)
    {
        if ($id != null or $id != "")
        {
            $id = (int) $id;
            $all__services = $collection->service->find(['category_id' => $id])->toArray();

            echo json_encode($all__services);
        }
        elseif ($id == "" or $id == null) {

            $all__services = $collection->service->find()->toArray();
            echo json_encode($all__services);

        }
        
    }


    // PUT
    function AddService($collection , $formdata) 
    {

        $collection->service->insertOne([
            'item_name' => $formdata['item_name'],
            'description' => $formdata['description'],
            'creator'  => $formdata['creator'],
            'price'  => $formdata['price'],
            'date'  => $formdata['date'],
            'category_id'  => $formdata['category_id'],
            'subcategory'  => $formdata['subcategory'],
            'image' =>  $formdata['image'],
        ]);
    }/*
    function Registration($collection , $formdata)
    {
        $find_username = $collection->users->findOne([
            'username'  => $formdata['username'],
        ]);
        $find_email = $collection->users->findOne([
            'email'     => $formdata['email'],
        ]);
        

        if ($find_username->username == $formdata['username'] || $find_email->email == $formdata['email'])
            echo "User exists! Change @username or email";

        elseif ($find_username->username == null && $find_email->email == null)
        {

            echo json_encode($find_username);
            $collection->users->insertOne([
                
                'firstname' => $formdata['firstname'],
                'secondname'=> $formdata['secondname'],*/
                //'username'  => $formdata['username'],
                //'email'     => $formdata['email'],
                //'password'  => $formdata['password'],
                /*'birthday'  => $formdata['birthday'],
                'country'   => $formdata['country'],
                'role'      => $formdata['role'],
                'comments'  => "",
                'rating'    => "",
            ]);
        }
    }*/
    /*
    function Login($collection , $formdata)
    {
        $username = $collection->users->findOne([       // create second query , which search password 
            'username' => $formdata['username'],
        ]);
        $password = $collection->users->findOne([       
            'password' => $formdata['password'],
        ]);

        if ($username->username == $formdata['username'] && $password->password == $formdata['password'])
            echo "login";
        elseif ($username->username == $formdata['username'] && $password->password != $formdata['password']) 
            echo "Forgot password?";
        else
            echo "User not exists! Registration!";
    }
    */

    // PATCH 
    function updateService($collection , $data , $id)
    {
        $collection->service->updateOne(
            [   
                '_id'    => new MongoDB\BSON\ObjectID($id),
                //'title' => 'ny',
                //'category'  => 'Alice',
            ],
            [
                '$set' => [
                    'item_name' => "$data->item_name",
                    'price' => "$data->price",
                ]
            ]
        );
    }
    function updateAccount($collection , $data , $username)
    {
        $collection->users->updateOne(
            [   
                'username'    => "$username",
            ],
            [
                '$set' => [
                    'firstname' => "$data->firstname",
                    'secondname' => "$data->secondname",
                ]
            ]
        );
    }


    // DELETE
    function DeleteAccount($collection , $id)
    {   
        $delete__account = $collection->users->deleteOne(["_id" => new MongoDB\BSON\ObjectID($id)]);
    } 
    function DeleteService($collection , $id)   
    {   
        $delete__service = $collection->service->deleteOne(["_id" => new MongoDB\BSON\ObjectID($id)]);
    }


?>