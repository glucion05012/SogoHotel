<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Branches extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','seo_id','status_id','province_id','city_id'];
    private $id;
    
	public function _getbranches(){

		$query = DB::table('branches as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('provinces as c', 'c.id', '=', 'a.province_id')
				->join('cities as d', 'd.id', '=', 'a.city_id')
				->select('a.*', 'a.id as branch_id', 'a.name as branch_name', 'b.*', 'c.*', 'd.*')
				->orderBy('a.id', 'desc')
				->get();

		return $query;
	}

	public function _getbranch(){

		$query = DB::table('branches as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('provinces as c', 'c.id', '=', 'a.province_id')
				->join('cities as d', 'd.id', '=', 'a.city_id')
				->select('a.*', 'a.id as branch_id', 'a.name as branch_name', 'b.*', 'c.*', 'd.*')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedbranches(){

		$query = DB::table('branches as a')
				->join('provinces as b', 'b.id', '=', 'a.province_id')
				->join('cities as c', 'c.id', '=', 'a.city_id')
				->select('a.*', 'a.id as branch_id', 'b.*', 'c.*')
				->where('a.status_id', 1)
				->orderBy('a.id', 'asc')
				->get();

		return $query;
	}

	public function _getpostednewbranches(){

		$query = DB::table('branches as a')
				->join('galleries as b', 'b.branch_id', '=', 'a.id')
				->join('images as c', 'c.id', '=', 'b.image_id')
				->select('a.*', 'a.id as branch_id', 'b.*', 'c.*')
				->where(['a.status_id' => 1, 'b.status_id' => 1])
				->orderBy('a.id', 'desc')
				->limit(3)
				->get();

		return $query;
	}

	public function _getpostedbranch(){

		$query = DB::table('branches as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('provinces as c', 'c.id', '=', 'a.province_id')
				->join('cities as d', 'd.id', '=', 'a.city_id')
				->select('a.*', 'a.id as branch_id', 'a.name as branch_name', 'b.*', 'c.province', 'd.city')
				->where('a.url', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedgalleries(){

		$query = DB::table('branches as a')
				->leftJoin('galleries as b', 'b.branch_id', '=', 'a.id')
				->leftJoin('images as c', 'c.id', '=', 'b.image_id')
				->select('a.*', 'a.id as branch_id', 'b.*', 'c.*')
				->where('a.url', $this->getID())
				->orderByRaw("field(b.status_id, '1') desc, b.id asc")
				->get();

		return $query;
	}

	public function _getpostedrates(){

		$query = DB::table('branches as a')
				->leftJoin('rates as b', 'b.branch_id', '=', 'a.id')
				->leftJoin('categories as c', 'c.id', '=', 'b.room_id')
				->select('a.*', 'b.*', 'c.name as room_name')
				->where(['c.type' => 'photos', 'a.url' => $this->getID()])
				->orderBy('c.id', 'desc')
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
