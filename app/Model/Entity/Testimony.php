<?php
namespace App\Model\Entity;
use \app\Db\Database;
class Testimony{
		public $id;
		public $name;
		public $message;
		public $data;

		public function save(){
				$this->data = date('Y-m-d H:i:s');
				$this->id = (new Database('depoimentos'))->insert([
					'name' => $this->name,
					'message' => $this->message,
				  'data_insercao' => $this->data
				]);

				return true;
		}

		public static function getTestimonies($where = null, $order = null, $limit = null, $fields = '*'){
            return (new Database('depoimentos'))->select($where,$order,$limit,$fields);
		}

	
}