<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Promos extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','seo_id','image_id','status_id'];
    private $id;

	public function _getpromos(){

		$query = DB::table('promos as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as promos_id', 'b.*')
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getpromo(){

		$query = DB::table('promos as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as promos_id', 'a.title as promos_title', 'a.description as promos_description', 'b.*', 'c.*')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedpromos(){

		$query = DB::table('promos as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as promos_id', 'b.*')
				->where('a.status_id', 1)
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getpostedpromo(){

		$query = DB::table('promos as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as promos_id', 'a.title as promos_title', 'a.description as promos_description', 'b.*', 'c.*')
				->where(['a.status_id' => 1, 'a.url' => $this->getID()])
				->first();

		return $query;
	}

	public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

}
