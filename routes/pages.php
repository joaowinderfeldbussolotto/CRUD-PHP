<?php
    use \app\Http\Response;
    use \app\Controller\Pages;

    // Rota Home
    $obRouter-> get('/',[
        function(){
            return new Response(200, Pages\Home::getHome());
        }
    ]); 

    // Rota About
    $obRouter-> get('/sobre',[
        function(){
            return new Response(200, Pages\About::getAbout());
        }
    ]); 

    // Rota DINÂMICA
   $obRouter-> get('/depoimentos', [
    function($request){
        return new Response(200, Pages\Testimony::getTestimonies($request));
    }
]);

   $obRouter-> post('/depoimentos', [
    function($request){
        
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);

?>
