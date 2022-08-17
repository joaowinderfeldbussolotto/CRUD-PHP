<?php
    namespace app\Controller\Pages;

    use \app\Utils\View;
    use \app\Model\Entity\Organization;
    use \app\Model\Entity\Testimony as EntityTestimony;
    use \app\Db\Pagination;
    class Testimony extends Page{
        private static function getTestimonyItems ($request, &$obPagination){
            $items  = '';
            $totalQuantity = EntityTestimony::getTestimonies(null, null, null, 'count (*) as quantity')->fetchObject()->quantity;

            $queryParams = $request->getQueryParams();
            $currentPage = $queryParams['page'] ?? 1;
            
            //INSTANCIA DE PAGINAÇÃO

            $obPagination = new Pagination($totalQuantity, $currentPage, 2); // 10 por pagina

            $results = EntityTestimony::getTestimonies(null, 'id DESC',$obPagination->getLimit());
            while($obTestimony = $results->fetchObject(EntityTestimony::class)){
                $items.= View::render('pages/testimony/item', [
                    'name' => $obTestimony->name,
                    'message' => $obTestimony->message,
                    'data' => date('d/m/Y H:i:s', strtotime($obTestimony->data_insercao))
                ]);
            }
            return $items;
        }


        public static function getTestimonies($request){
            $obOrganization = new Organization;
            $content =  View::render('pages/testimonies', [
                'items' => self::getTestimonyItems($request, $obPagination),
                'pagination' => parent::getPagination($request,$obPagination)
            ]);
            return parent::getPage("Depoimentos", $content);
        }

        public static function insertTestimony($request){
            $postVars = $request->getPostVars();
            $obTestimony = new EntityTestimony;
            $obTestimony->name = $postVars['name'];
            $obTestimony->message = $postVars['message'];
            $obTestimony->save();
            return self::getTestimonies($request);    
        }
    }
?>
