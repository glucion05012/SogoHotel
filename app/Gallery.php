<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Gallery extends Model {
    private $id;

   	public function updatestatus(){

   		DB::table('galleries')->where('branch_id', $this->getID())->update(['status_id' => 0]);

   	}

	public function _getgalleries(){

		$query = DB::table('galleries as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as gallery_id', 'b.*')
				->where('a.branch_id', $this->getID())
				->get();

		return $query;	
	}

	public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }
}
