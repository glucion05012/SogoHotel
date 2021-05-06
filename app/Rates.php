<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Rates extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','status_id','branch_id','room_id'];
    private $id;

	public function _getrates(){

		$query = DB::table('rates as a')
				->join('categories as b', 'b.id', '=', 'a.room_id')
				->select('a.*', 'a.id as rates_id', 'a.status_id as rates_status', 'b.name')
				->where(['a.branch_id' => $this->getID(), 'b.type' => 'photos'])
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
