<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class About_us extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','seo_id','image_id','status_id'];
    private $id;

	public function _getabouts(){

		$query = DB::table('about_uses as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as about_id', 'b.*')
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getabout(){

		$query = DB::table('about_uses as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as about_id', 'a.title as about_title', 'a.description as about_description', 'b.*', 'c.*')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedabouts(){

		$query = DB::table('about_uses as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as about_id', 'b.*')
				->where('a.status_id', 1)
				->orderBy('a.id', 'desc')
				->get();

		return $query;
	}

	public function _getpostedabout(){

		$query = DB::table('about_uses as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as about_id', 'a.title as about_title', 'a.description as about_description', 'b.*', 'c.*')
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
