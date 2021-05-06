<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Photos extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','image_id','status_id','category_id'];
    private $id;

	public function _getphotos(){

		$query = DB::table('photos as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as photos_id', 'b.*', 'c.name as category_name')
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getphoto(){

		$query = DB::table('photos as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as photos_id', 'b.*', 'c.id as category_id', 'c.name as category_name')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedphotos(){

		$query = DB::table('photos as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as photos_id', 'b.*')
				->where(['c.url' => $this->getID(), 'c.type' => 'photos', 'a.status_id' => 1])
				->orderBy('a.id', 'desc')
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
