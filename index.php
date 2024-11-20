<?php

    

    header("Access-Control-Allow-Origin: http://loot.ua");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");
    header("Content-type: json/application; charset=UTF-8");


    require_once "functions.php";

    $request__method = $_SERVER['REQUEST_METHOD'];
    $page = $_GET['page'];
    $get_id = explode('/' , $page);
    $param = $get_id[1];

    switch ($request__method) 
    {

        /*
               let subcategory = await fetch(`http://api.loot.ua/subcategory/${id}`);
                let services = await fetch(`http://api.loot.ua/services/${id}`);
        */

        case 'GET':
                    if ($page === "category/" . $param)     
                        getCategory($collection, $param);

                    elseif ($page === "letter/") 
                        getLetter($collection);
                    
                    elseif ($page === "service/" . $param) 
                        getOneDocument($collection , $param);
                    
                    elseif ($page === "topsellers/")
                        getSellers($all__sellers);
                    
                    elseif ($page === "subcategory/" . $param)
                        getSubcategory($collection , $param);

                    elseif ($page === "services/" . $param) // продумать выборку по категориям и сабкатегориям 
                        getServices($collection , $param);

                    elseif ($page === "myaccount/" . $param)
                        getAccount($collection , $param);

                    elseif ($page === "myservices/" . $param)
                        getMyServices($collection , $param);

                    break;
            
        case 'POST':
                    if ($page === "myservice/")
                        AddService($collection , $_POST);
                    /*
                    elseif ($page === "form/")
                        Registration($collection , $_POST);

                    elseif ($page === "login/")
                        Login($collection , $_POST);
                    */
                    break;
            
        case 'PATCH':
                    if ($page === 'service/' . $param)
                    {
                        if (isset($param))
                        {
                            $data = file_get_contents("php://input");
                            $data = json_decode($data);

                            updateService($collection , $data , $param);
                        }
                    }
                    elseif ($page === 'myaccount/' . $param)
                    {
                        if (isset($param))
                        {
                            $data = file_get_contents("php://input");
                            $data = json_decode($data);

                            updateAccount($collection , $data , $param);
                        }
                    }
                    break;

        case 'DELETE':
                    if ($page === 'myaccount/' . $param)
                        DeleteAccount($collection , $param);

                    elseif ($page === 'myservice/' . $param) 
                        DeleteService($collection , $param);
        default:
            # code...
            break;
    }


    
    
?>