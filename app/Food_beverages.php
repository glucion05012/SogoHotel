<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use DB;

class Food_beverages extends Model {
	use LogsActivity;
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
	protected static $logAttributesToIgnore = ['id','image_id','status_id','category_id'];
    private $id;

	public function _getfoods(){

		$query = DB::table('food_beverages as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as foods_id', 'b.*', 'c.name as category_name')
				->orderBy('a.id', 'desc')
				->get();

		return $query;	
	}

	public function _getfood(){

		$query = DB::table('food_beverages as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as foods_id', 'b.*', 'c.id as category_id', 'c.name as category_name')
				->where('a.id', $this->getID())
				->first();

		return $query;	
	}

	public function _getpostedfoods(){

		$query = DB::table('food_beverages as a')
				->join('images as b', 'b.id', '=', 'a.image_id')
				->join('categories as c', 'c.id', '=', 'a.category_id')
				->select('a.*', 'a.id as foods_id', 'b.*', 'c.name as category_name')
				->where(['c.url' => $this->getID(), 'c.type' => 'food-beverages']);

		$query = !empty($this->sub) ? $query->orderByRaw("field(a.title, '".$this->sub."') desc, a.id desc") : $query->orderBy('a.id', 'desc');
		$query = $query->get();

		return $query;	
	}

	public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

}
