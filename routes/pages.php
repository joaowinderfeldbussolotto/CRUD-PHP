<?php
    use \app\Http\Response;
    use \app\Controller\Pages;

    // Rota Home
    $obRouter-> get('/',[
        'middlewares' => ['required-admin-login'],

        
        function(){
            return new Response(200, Pages\Home::getHome());
        }
    ]); 

    // Rota About
    $obRouter-> get('/sobre',[
        'middlewares' => ['required-admin-login'],

        function(){
            return new Response(200, Pages\About::getAbout());
        }
    ]); 

    // Rota DINÂMICA
   $obRouter-> get('/depoimentos', [
    'middlewares' => ['required-admin-login'],

    function($request){
        return new Response(200, Pages\Testimony::getTestimonies($request));
    }
]);

$obRouter-> get('/login', [
    'middlewares' => ['required-admin-logout'],
    function($request){
        return new Response(200, Pages\Login::getLogin($request));
    }
]);
$obRouter-> post('/login', [
    function($request){
        //echo password_hash('123', PASSWORD_DEFAULT); exit;
        return new Response(200, Pages\Login::setLogin($request));
    }
]);

$obRouter-> get('/logout', [
    'middlewares' => ['required-admin-login'],

    function($request){
        return new Response(200, Pages\Login::setLogout($request));
    }
]);

   $obRouter-> post('/depoimentos', [
    'middlewares' => ['required-admin-login'],

    function($request){
        
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);

?>
