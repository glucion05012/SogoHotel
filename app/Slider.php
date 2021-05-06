<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Slider extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','image_id','status_id'];
	private $id;

	public function _getsliders(){

		$query = DB::table('sliders as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as slider_id', 'b.*')
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getslider(){

		$query = DB::table('sliders as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as slider_id', 'b.*')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedsliders(){

		$query = DB::table('sliders as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as slider_id', 'b.*')
				->where('a.status_id', 1)
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
