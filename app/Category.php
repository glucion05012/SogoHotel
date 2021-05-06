<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Category extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','seo_id','image_id','status_id'];
    private $id;

	public function _getcategories(){

		$query = DB::table('categories as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->select('a.*', 'a.id as category_id', 'b.*')
				->where('a.type', $this->getID())
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getcategory(){

		$query = DB::table('categories as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.id as category_id', 'a.seo_id', 'a.image_id', 'a.status_id', 'a.type', 'a.name', 'a.title as category_title', 'a.description as category_description', 'b.*', 'c.*')
				->where('a.id', $this->getID())
				->orderBy('a.id', 'desc')
				->first();

		return $query;	
	}

	public function _getpostedphotoscategory(){

		$query = DB::table('categories as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->select('a.name as category_name', 'a.title as category_title', 'a.description as category_description', 'b.*')
				->where(['a.url' => $this->getID(), 'a.type' => 'photos'])
				->first();

		return $query;	
	}

	public function _getpostedfoodscategory(){

		$query = DB::table('categories as a')
				->join('seos as b', 'b.id', '=', 'a.seo_id')
				->join('images as c', 'c.id', '=', 'a.image_id')
				->select('a.name as category_name', 'a.title as category_title', 'a.description as category_description', 'b.*', 'c.*')
				->where(['a.url' => $this->getID(), 'a.type' => 'food-beverages'])
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
