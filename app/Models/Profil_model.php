<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil_model extends Model{

	protected $table = 'profil';
	public $timestamps  = false;


	public static function getbyid($id){
            $CI     =& get_instance();
            $where  = array("id" => $id);
            return $CI->db->get_where("da", $where)->result_array();;
        }
}