<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Page extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','seo_id','image_id','status_id'];
	private $id;
    
	public function _getpage(){

		$query = DB::table('pages as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as page_id', 'a.title as page_title', 'a.description as page_description', 'b.*', 'c.filename', 'c.alt')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedpage(){

		$query = DB::table('pages as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.*', 'a.id as page_id', 'a.title as page_title', 'a.description as page_description', 'b.*', 'c.filename', 'c.directory', 'c.alt');
		$this->getID() != null ? $query = $query->where('a.url', $this->getID()) : '';
		$query = $query->first();

		return $query;	
	}

	public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

}
