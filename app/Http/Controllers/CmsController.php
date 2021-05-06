<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use File;

use App\User;
use App\Page;
use App\Seo;
use App\Image;
use App\Slider;
use App\About_us;
use App\Food_beverages;
use App\Promos;
use App\Events;
use App\Careers;
use App\Photos;
use App\Category;
use App\Branches;
use App\Rates;
use App\Province;
use App\City;
use App\Gallery;
use App\Inquiry;
use App\Activity_log;
use App\Social_media;
use App\Setting;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InquiriesExport;
use App\Exports\LogsExport;

class CmsController extends Controller {
    
	public function __construct(){
		parent::__construct();
	}

	public function account_setting(){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();
        
		$this->params['title'] = 'Account Setting | Sogo';
		$this->params['account'] = User::find(Auth::id());

		return view('cms.body.account_setting', $this->params);
	}

	public function user_manager($type, $id = null){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();
        
		$this->params['title'] = 'User Manager | Sogo';
		$this->params['type'] = $type;
		$this->params['account'] = User::find($id);

		return view('cms.body.user_manager', $this->params);
	}

	public function page_manager($type, $id = null){
		$p = new Page;
		$p->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();
        
		$this->params['title'] = 'Page Manager | Sogo';
		$this->params['type'] = $type;
		$this->params['page'] = $p->_getpage();

		return view('cms.body.page_manager', $this->params);
	}

	public function homepage_banner($type, $id = null){
		$sl = new Slider;
		$sl->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Slider Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['slider'] = $sl->_getslider();

		return view('cms.body.homepage_banner', $this->params);
	}

	public function about_us($type, $id = null){
		$au = new About_us;
		$au->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'About Us Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['about'] = $au->_getabout();

		return view('cms.body.about_us', $this->params);
	}

	public function mfood_beverages($type, $id = null){
		$fb = new Food_beverages;
		$fb->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Food & Beverages Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['category'] = Category::where(['type' => \Request::segment(3), 'status_id' => 1])->get();
		$this->params['foods'] = $fb->_getfood();

		return view('cms.body.mfood_beverages', $this->params);
	}

	public function promos($type, $id = null){
		$pr = new Promos;
		$pr->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Promos Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['promos'] = $pr->_getpromo();

		return view('cms.body.promos', $this->params);
	}

	public function events($type, $id = null){
		$e = new Events;
		$e->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Events Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['events'] = $e->_getevent();

		return view('cms.body.events', $this->params);
	}

	public function careers($type, $id = null){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Careers Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['careers'] = Careers::find($id);

		return view('cms.body.careers', $this->params);
	}

	public function mphotos($type, $id = null){
		$pt = new Photos;
		$pt->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Photos Maintenance | Sogo';
		$this->params['type'] = $type;
		$this->params['category'] = Category::where(['type' => \Request::segment(3), 'status_id' => 1])->get();
		$this->params['photos'] = $pt->_getphoto();

		return view('cms.body.mphotos', $this->params);
	}

	public function cfood_beverages($type, $id = null){
		$c = new Category;
		$c->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Food & Beverages Category | Sogo';
		$this->params['type'] = $type;
		$this->params['category'] = $c->_getcategory();

		return view('cms.body.cfood_beverages', $this->params);
	}

	public function cphotos($type, $id = null){
		$c = new Category;
		$c->setID($id);

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Photos Category | Sogo';
		$this->params['type'] = $type;
		$this->params['category'] = $c->_getcategory();

		return view('cms.body.cphotos', $this->params);
	}

	public function branch_manager($type, $id = null){
		$b = new Branches;
		$g = new Gallery;

		$b->setID($id);
		$branch = $b->_getbranch();
		$g->setID($id);
		$gallery = $g->_getgalleries();

		$gallery->map(function($item){
            return $item->size = File::size(public_path('images/'.$item->directory.'/'. $item->filename));
        });

		$this->_check_account_not_aut();
		$this->load_cms_header_files();
        
		$this->params['title'] = 'Branch Manager | Sogo';
		$this->params['type'] = $type;
		$this->params['id'] = $id;
		$this->params['province'] = Province::all();
		$this->params['city'] = $branch ? City::where('province_id', $branch->province_id)->get() : City::all();
		$this->params['branch'] = $branch;
		$this->params['gallery'] = $gallery;
		$this->params['rooms'] = Category::where(['type' => 'photos', 'status_id' => 1])->get();

		return view('cms.body.branch_manager', $this->params);
	}

	public function social_media_management($type, $id = null){

		$this->add_cms_plugin_styles(array(
            'cms/plugins/fontawesome-iconpicker/fontawesome-iconpicker.min.css'
        ));

        $this->add_cms_plugin_scripts(array(
            'cms/plugins/fontawesome-iconpicker/fontawesome-iconpicker.min.js'
        ));

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Social Media Management | Sogo';
		$this->params['type'] = $type;
		$this->params['id'] = $id;
		$this->params['social'] = Social_media::find($id);

		return view('cms.body.social_media_management', $this->params);
	}

	public function database_management(){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Database Management | Sogo';

		return view('cms.body.database_management', $this->params);
	}

	public function activity_logs(){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Activity Logs | Sogo';

		return view('cms.body.activity_logs', $this->params);
	}

	public function settings(){

		$this->_check_account_not_aut();
		$this->load_cms_header_files();

		$this->params['title'] = 'Settings | Sogo';
		$this->params['setting'] = Setting::find(1);

		return view('cms.body.settings', $this->params);
	}

	public function export($page, $type = null){
		$inquiry = new InquiriesExport;
		$inquiry->type = $type;

		if($page == 'inquiry'){

			$type1 = !empty($type) ? ucwords($type) : 'Inquiries';

			return Excel::download($inquiry, $type1.'_'.time().'.xlsx');

		}else{

			return Excel::download(new LogsExport, 'Logs_'.time().'.xlsx');
		}
	}

	public function api($type, $requests, $id = null, Request $request){
		
		if($type == 'accounts'){

			if($requests == 'save'){

				$nid = $request->id;
				$u = !empty($nid) ? User::find($nid) : new User;

				$u->status_id 		= $request->status;
				$u->name 			= $request->name;
				$u->email 			= $request->email;
				$u->password 		= !empty($request->password) ? bcrypt($request->password) : $u->password;

				$validator = Validator::make($request->all(), [
					'name' => 'required',
					'email' => 'required|email|unique:users,email,'.$nid,
		            'password' => (!empty($nid) ? 'nullable' : 'required').'|confirmed|min:6'
		        ]);
		        
		        if(!$validator->fails()){

		        	$u->save();

		        	$status1 = !empty($nid) ? 'updated.' : 'saved.';
				    $status = true;
			        $message = 'Account successfully '.$status1;

		        }else{

		        	$status = false;
		            $message = $validator->errors()->all();

		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);				

			}elseif($requests == 'update'){

				$nid = Auth::id();
				$u = User::find($nid);

				$u->name 		= $request->name;
				$u->email 		= $request->email;
				$u->password 	= !empty($request->password) ? bcrypt($request->password) : $u->password;

				$validator = Validator::make($request->all(), [
					'name' => 'required',
					'email' => 'required|email|unique:users,email,'.$nid,
		            'password' => 'nullable|confirmed|min:6'
		        ]);
		        
		        if(!$validator->fails()){

		        	$u->save();

		        	$status = true;
		            $message = 'Account successfully updated.';

		        }else{
		        	$status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$item = User::where('id', '!=', Auth::id())->orderBy('id', 'desc')->get();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/user-manager/edit/'.$rec->id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="user-'.$rec->id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        $rec->name,
	                        $rec->email,
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$u = User::find($request->item);

				$u->delete();

				$status = true;
		        $message = 'Account successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'page-manager'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$nid = $request->image_id;
				$s = Seo::find($sid);
				$i = Image::find($nid);
				$p = Page::where('seo_id', $sid)->first();
				
				$s->title 				= $request->seo_title;
				$s->description 		= $request->seo_description;
				$s->keywords 			= $request->seo_keywords;
				$p->title 				= $request->page_title;
				$i->alt 				= $request->alt;
				$image 					= $request->file('image');

				if(!empty($p->url)){

					if($p->url != 'careers'){

						$rules = [
							'seo_title' => 'required',
							'seo_description' => 'required',
							'seo_keywords' => 'required',
				            'page_title' => 'required',
				            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
						];

		            }else{

		            	$p->description_title = $request->page_description_title;
						$p->description = $request->page_description;

						$rules = [
							'seo_title' => 'required',
							'seo_description' => 'required',
							'seo_keywords' => 'required',
				            'page_title' => 'required',
				            'page_description_title' => 'required',
				            'page_description' => 'required'
				        ];

		            }

				}else{

					$p->description_title = $request->page_description_title;
					$p->description = $request->page_description;
					$p->link = $request->youtube_link;

					$rules = [
						'seo_title' => 'required',
						'seo_description' => 'required',
						'seo_keywords' => 'required',
			            'page_title' => 'required',
			            'page_description_title' => 'required',
			            'page_description' => 'required',
			            'youtube_link' => 'required',
					];

				}
				
				$validator = Validator::make($request->all(), $rules);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/banner');
                        $image->move($destinationPath, $name);
                        
                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    //seo
		        	$s->save();

		        	//page
		        	$p->save();

		        	//image
		        	$i->filename = $name;
		        	$i->save();
		        	
		            $status = true;
		            $message = $p->title.' page successfully updated.';

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$item = Page::all();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/page-manager/edit/'.$rec->id).'" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        $rec->title,
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);

			}

		}elseif($type == 'slider'){

			if($requests == 'save'){

				$nid = $request->image_id;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$sl = !empty($nid) ? Slider::where('image_id', $nid)->first() : new Slider;
				
					
				$sl->status_id 		= $request->status;
				$i->alt 			= $request->alt;
				$image 				= $request->file('image');

				$validator = Validator::make($request->all(), [
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/slider');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    if(!empty($nid)){

                    	//image
                        $i->filename = $name;
                    	$i->save();

                    	//slider
                    	$sl->save();

                    	$status = true;
		           		$message = 'Data successfully updated.';

                    }else{

                    	//image
                    	$i->filename = $name;
                    	$i->directory = 'slider';
                    	$i->save();

                    	//slider
                    	$sl->image_id = $i->id;
                    	$sl->save();

                    	$status = true;
		          	 	$message = 'Data successfully saved.';

                    }
		        	
		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$sl = new Slider;
				$item = $sl->_getsliders();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/homepage-banner/edit/'.$rec->slider_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="slider-'.$rec->slider_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$sl = Slider::find($request->item);
				$i = Image::find($sl->image_id);

				$sl->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'about-us'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$nid = $request->image_id;
				$s = !empty($sid) ? Seo::find($sid) : new Seo;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$au = !empty($nid) ? About_us::where('image_id', $nid)->first() : new About_us;

				$s->title 					= $request->seo_title;
				$s->description 			= $request->seo_description;
				$s->keywords 				= $request->seo_keywords;
				$au->title 					= $request->about_us_title;
				$au->description 			= $request->about_us_description;
				$au->status_id 				= $request->status;
				$au->url 					= str_slug($au->title);
				$i->alt 					= $request->alt;
				$image 						= $request->file('image');

				$validator = Validator::make($request->all(), [
					'seo_title' => 'required',
					'seo_description' => 'required',
					'seo_keywords' => 'required',
					'about_us_title' => 'required',
					'about_us_description' => 'required',
					'alt' => 'required',
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                       	$name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/about_us');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    //seo
                    if($s->save()){

                    	//image
                    	$i->directory = 'about_us';
                        $i->filename = $name;
                    	$i->save();

                    	//about us
                    	$au->seo_id = $s->id;
                    	$au->image_id = $i->id;
                    	$au->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }
		        	
		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$au = new About_us;
				$item = $au->_getabouts();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/about-us/edit/'.$rec->about_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="about-'.$rec->about_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$au = About_us::find($request->item);
				$s = Seo::find($au->seo_id);
				$i = Image::find($au->image_id);

				$au->delete();
				$s->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'food-beverages'){

			if($requests == 'save'){

				$nid = $request->image_id;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$fb = !empty($nid) ? Food_beverages::where('image_id', $nid)->first() : new Food_beverages;

				$fb->category_id	= $request->category;
				$fb->title 			= $request->title;
				$fb->description 	= $request->description;
				$fb->status_id 		= $request->status;
				$fb->url 			= str_slug($fb->title);
				$i->alt 			= $request->alt;
				$image 				= $request->file('image');

				$validator = Validator::make($request->all(), [
					'title' => 'required',
					'description' => 'required',
					'alt' => 'required',
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/food_beverages');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    //image
                	$i->directory = 'food_beverages';
                    $i->filename = $name;

                    if($i->save()){

                    	//food & beverages
                    	$fb->image_id = $i->id;
                    	$fb->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }
		        	
		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$fb = new Food_beverages;
				$item = $fb->_getfoods();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/food-beverages/edit/'.$rec->foods_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="foods-'.$rec->foods_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->category_name,
	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$fb = Food_beverages::find($request->item);
				$i = Image::find($fb->image_id);

				$fb->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'promos'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$nid = $request->image_id;
				$s = !empty($sid) ? Seo::find($sid) : new Seo;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$pr = !empty($nid) ? Promos::where('image_id', $nid)->first() : new Promos;

				$s->title 				= $request->seo_title;
				$s->description 		= $request->seo_description;
				$s->keywords 			= $request->seo_keywords;
				$pr->title 				= $request->promos_title;
				$pr->description 		= $request->promos_description;
				$pr->status_id 			= $request->status;
				$pr->url 				= str_slug($pr->title);
				$i->alt 				= $request->alt;
				$image 					= $request->file('image');
				$image1 				= $request->file('thumbnail');

				$validator = Validator::make($request->all(), [
					'seo_title' => 'required',
					'seo_description' => 'required',
					'seo_keywords' => 'required',
					'promos_title' => 'required',
					'promos_description' => 'required',
					'alt' => 'required',
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/promos');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    if($request->hasFile('thumbnail')){

                        $name1 = time()."_".$image1->getClientOriginalName();
                        $destinationPath1 = public_path('/images/promos');
                        $image1->move($destinationPath1, $name1);

                    }else{
                    	$name1 = !empty($nid) ? $pr->thumbnail : 'default1.jpg';
                    }

                     //seo
                    if($s->save()){

                    	//image
                    	$i->directory = 'promos';
                        $i->filename = $name;
                    	$i->save();

                    	//promos
                    	$pr->seo_id = $s->id;
                    	$pr->image_id = $i->id;
                    	$pr->thumbnail = $name1;
                    	$pr->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }

		        	
		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$pr = new Promos;
				$item = $pr->_getpromos();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/promos/edit/'.$rec->promos_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="promos-'.$rec->promos_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$pr = Promos::find($request->item);
				$s = Seo::find($pr->seo_id);
				$i = Image::find($pr->image_id);

				$pr->delete();
				$s->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'events'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$nid = $request->image_id;
				$s = !empty($sid) ? Seo::find($sid) : new Seo;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$e = !empty($nid) ? Events::where('image_id', $nid)->first() : new Events;

				$s->title 				= $request->seo_title;
				$s->description 		= $request->seo_description;
				$s->keywords 			= $request->seo_keywords;
				$e->title 				= $request->events_title;
				$e->description 		= $request->events_description;
				$e->status_id 			= $request->status;
				$e->url 				= str_slug($e->title);
				$i->alt 				= $request->alt;
				$image 					= $request->file('image');
				$image1 				= $request->file('thumbnail');

				$validator = Validator::make($request->all(), [
					'seo_title' => 'required',
					'seo_description' => 'required',
					'seo_keywords' => 'required',
					'events_title' => 'required',
					'events_description' => 'required',
					'alt' => 'required',
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/events');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    if($request->hasFile('thumbnail')){

                        $name1 = time()."_".$image1->getClientOriginalName();
                        $destinationPath1 = public_path('/images/events');
                        $image1->move($destinationPath1, $name1);

                    }else{
                    	$name1 = !empty($nid) ? $e->thumbnail : 'default1.jpg';
                    }

                    //seo
                    if($s->save()){

                    	//image
                    	$i->directory = 'events';
                        $i->filename = $name;
                    	$i->save();

                    	//events
                    	$e->seo_id = $s->id;
                    	$e->image_id = $i->id;
                    	$e->thumbnail = $name1;
                    	$e->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }
		        	
		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$e = new Events;
				$item = $e->_getevents();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/events/edit/'.$rec->events_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="events-'.$rec->events_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$e = Events::find($request->item);
				$s = Seo::find($e->seo_id);
				$i = Image::find($e->image_id);

				$e->delete();
				$s->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'careers'){

			if($requests == 'save'){

				$nid = $request->id;
				$cr = !empty($nid) ? Careers::find($nid) : new Careers;

				$cr->title 			= $request->title;
				$cr->description 	= $request->description;
				$cr->status_id 		= $request->status;

				$validator = Validator::make($request->all(), [
					'title' => 'required',
					'description' => 'required'
		        ]);
		        
		        if(!$validator->fails()){

                	$cr->save();

                	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                	$status = true;
	          	 	$message = 'Data successfully '.$status1;

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$item = Careers::orderBy('id', 'desc')->get();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/careers/edit/'.$rec->id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="careers-'.$rec->id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$cr = Careers::find($request->item);

				$cr->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'photos'){

			if($requests == 'save'){

				$nid = $request->image_id;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$pt = !empty($nid) ? Photos::where('image_id', $nid)->first() : new Photos;

				$pt->category_id	= $request->category;
				$pt->title 			= $request->title;
				$pt->description 	= $request->description;
				$pt->status_id 		= $request->status;
				$i->alt 			= $request->alt;
				$image 				= $request->file('image');

				$validator = Validator::make($request->all(), [
					'title' => 'required',
					'description' => 'required',
		            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/photos');
                        $image->move($destinationPath, $name);

                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    //image
                    $i->directory = 'photos';
                    $i->filename = $name;
                    if($i->save()){

                    	//photos
                    	$pt->image_id = $i->id;
                    	$pt->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$pt = new Photos;
				$item = $pt->_getphotos();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/maintenance/photos/edit/'.$rec->photos_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="photos-'.$rec->photos_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
	                        $rec->category_name,
	                        $rec->title,
	                        '<div class="ellipsis-5">'.$rec->description.'</div>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'search'){

				$pt = new Photos;

				$data = [];
				$pt->setID($request->item);
	            $item = $pt->_getphoto();

	            $data['photo'] = array(
	                'title'      	=> $item->title,
	                'description'   => $item->description,
	                'image'    		=> asset('images/'.$item->directory.'/'.$item->filename)
	            );
	            
	            return response()->json($data);

			}elseif($requests == 'delete'){

				$pt = Photos::find($request->item);
				$i = Image::find($pt->image_id);

				$pt->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'category'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$nid = $request->image_id;
				$s = !empty($sid) ? Seo::find($sid) : new Seo;
				$i = !empty($nid) ? Image::find($nid) : new Image;
				$c = !empty($nid) ? Category::where('seo_id', $sid)->first() : new Category;
				
				$s->title 			= $request->seo_title;
				$s->description 	= $request->seo_description;
				$s->keywords 		= $request->seo_keywords;
				$c->status_id 		= $request->status;
				$c->type 			= $request->type;
				$c->name 			= $request->category_name;
				$c->title 			= $request->category_title;
				$c->description 	= $request->category_description;
				$c->url 			= str_slug($c->name);
				$i->alt 			= $request->alt;
				$image 				= $request->file('image');

				if($c->type != 'photos'){

					$rules = [
						'seo_title' => 'required',
						'seo_description' => 'required',
						'seo_keywords' => 'required',
						'category_name' => 'required',
						'alt' => 'required',
			            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
					];

				}else{

					$rules = [
						'seo_title' => 'required',
						'seo_description' => 'required',
						'seo_keywords' => 'required',
						'category_name' => 'required',
			            'category_title' => 'required',
			            'category_description' => 'required'
					];

				}
				
				$validator = Validator::make($request->all(), $rules);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('image')){

                        $name = time()."_".$image->getClientOriginalName();
                        $destinationPath = public_path('/images/category');
                        $image->move($destinationPath, $name);
                        
                    }else{
                    	$name = !empty($nid) ? $i->filename : 'default.jpg';
                    }

                    //seo
                    if($s->save()){

                    	//image
                    	$i->directory = 'category';
                        $i->filename = $name;
                    	$i->save();

                    	//category
                    	$c->seo_id = $s->id;
                    	$c->image_id = $i->id;
                    	$c->save();
                    	
                    	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                    	$status = true;
	           			$message = 'Data successfully '.$status1;
	                    	
	                }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message,
		            'type' => $c->type
		        ]);

			}elseif($requests == 'get'){

				$c = new Category;
				$type = $request->type;
				$c->setID($type);
				$item = $c->_getcategories();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/category/'. $type .'/edit/'.$rec->category_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="category-'.$rec->category_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    if($type != 'photos'){

		                    $data['aaData'][] = array(

		                        '<img src="'.asset('images/'.$rec->directory.'/'.$rec->filename).'" height="200">',
		                        $rec->name,
		                        $rec->status_id != 1 ? 'Inactive' : 'Active',
		                        $button

		                    );

		                }else{
							
		                	$data['aaData'][] = array(

		                        $rec->name,
		                        $rec->title,
		                        '<div class="ellipsis-5">'.$rec->description.'</div>',
		                        $rec->status_id != 1 ? 'Inactive' : 'Active',
		                        $button

		                    );

		                }

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$c = Category::find($request->item);
				$s = Seo::find($c->seo_id);
				$i = Image::find($c->image_id);
				
				$c->delete();
				$s->delete();
				$i->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'branches'){

			if($requests == 'save'){

				$sid = $request->seo_id;
				$s = !empty($sid) ? Seo::find($sid) : new Seo;
				$b = !empty($sid) ? Branches::where('seo_id', $sid)->first() : new Branches;
				
				$s->title 			= $request->seo_title;
				$s->description 	= $request->seo_description;
				$s->keywords 		= $request->seo_keywords;
				$b->status_id 		= $request->status;
				$b->name 			= $request->branch_name;
				$b->street 			= $request->branch_street;
				$b->barangay 		= $request->branch_barangay;
				$b->province_id	 	= $request->branch_province;
				$b->city_id	 		= $request->branch_city;
				$b->longitude 		= $request->branch_longitude;
				$b->latitude 		= $request->branch_latitude;
				$b->phone 			= $request->branch_phone_number;
				$b->fax 			= $request->branch_fax_number;
				$b->mobile 			= $request->branch_mobile_number;
				$b->zoom 			= $request->branch_map_zoom;
				$b->url 			= str_slug($b->name);

				$validator = Validator::make($request->all(), [
					'seo_title' => 'required',
					'seo_description' => 'required',
					'seo_keywords' => 'required',
					'status' => 'required',
					'branch_name' => 'required',
					'branch_street' => 'required',
					'branch_barangay' => 'required',
					'branch_province' => 'required',
					'branch_city' => 'required',
					'branch_phone_number' => 'required',
					'branch_mobile_number' => 'required',
					'branch_map_zoom' => 'required'
		        ]);
		        
		        if(!$validator->fails()){

		        	//seo
		        	if($s->save()){

			        	//branch
			        	$b->seo_id = $s->id;
			        	$b->save();

			        	if(!empty($sid)){

				            $status = true;
				            $message = 'Data successfully updated.';
				            $type = 'update';
				        	$bid = '';

			        	}else{

			        		$status = true;
				            $message = 'Data successfully saved.';
				            $type = 'save';
				        	$bid = $b->id;

			        	}

			        }else{
	                	$status = false;
		            	$message = 'Unable to save data.';
	                }

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		            $type = '';
			        $bid = '';
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message,
		            'type' => $type,
		            'bid' => $bid
		        ]);

			}elseif($requests == 'get'){

				$b = new Branches;
				$item = $b->_getbranches();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/branch-manager/edit/'.$rec->branch_id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="branch-'.$rec->branch_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        $rec->province,
	                        $rec->city,
	                        $rec->branch_name,
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);

			}elseif($requests == 'delete'){

				$b = Branches::find($request->item);
				$s = Seo::find($b->seo_id);
				
				$b->delete();
				$s->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'gallery'){

			if($requests == 'save'){

				$g = new Gallery;
				$i = new Image;

				$image = $request->file('file');

				$validator = Validator::make($request->all(), [
		            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		        ]);
		        
		        if(!$validator->fails()){

		        	if($request->hasFile('file')){

						$name = time()."_".$image->getClientOriginalName();
	                    $destinationPath = public_path('/images/branches');
	                    $image->move($destinationPath, $name);

		            }

		            //image
		        	$i->filename = $name;
		        	$i->directory = 'branches';
		        	$i->alt = file_ext_strip($image->getClientOriginalName());
		        	if($i->save()){

		        		//gallery
			            $g->branch_id = $request->id;
		                $g->status_id = 0;
		                $g->image_id = $i->id;
		                $g->save();

		                $status = true;
				        $message = 'Data successfully saved.';
				        $gid = $g->id;

		        	}else{
		        		$status = false;
				       	$message = 'Error saving data.';
				       	$gid = '';
		        	}


		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		            $gid = '';
		        }

	        	return response()->json([
		            'status' => $status,
		            'message' => $message,
		            'id' => $gid
		        ]);

			}elseif($requests == 'active'){

				$g = new Gallery;
				
				$gid = $request->gallery_id;
				$bid = $request->branch_id;

				$g->setID($bid);
				$g->updatestatus();

				$ug = $g->find($gid);
				$ug->status_id = 1;
				$ug->save();

				$status = true;
			    $message = 'Image successfully set as primary.';
	            
	        	return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'delete'){
				$g = Gallery::find($request->item);
				$i = Image::find($g->image_id);
				
				$g->delete();
				$i->delete();

				$status = true;
		        $message = 'Image successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'rates'){

			if($requests == 'save'){

				$nid = $request->id;
				$rt = !empty($nid) ? Rates::find($nid) : new Rates;

				$rt->branch_id 		= $request->branch_id;
				$rt->room_id 		= $request->room_type;
				$rt->type 			= $request->rate_type;
				$rt->hours_12 		= $request->input('12_hours_rate');
				$rt->hours_24 		= $request->input('24_hours_rate');
				$rt->status_id 		= $request->status;

				$validator = Validator::make($request->all(), [
					'room_type' => 'required',
					'rate_type' => 'required',
					'12_hours_rate' => 'required',
					'24_hours_rate' => 'required',
					'status' => 'required'
		        ]);
		        
		        if(!$validator->fails()){

                	$rt->save();

                	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                	$status = true;
	          	 	$message = '<div class="alert alert-success">Data successfully '.$status1.'</div>';

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$rt = new Rates;
				$rt->setID($request->id);
				$item = $rt->_getrates();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="javascript:void(0)" id="rates-'.$rec->rates_id.'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="rates-'.$rec->rates_id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        ucwords($rec->type),
	                        $rec->name,
	                        'Php '.number_format($rec->hours_12, 2),
	                        'Php '.number_format($rec->hours_24, 2),
	                        $rec->rates_status != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'search'){

				$data = [];
	            $item = Rates::find($request->item);

	            $data['rates'] = array(
	                'id'      		=> $item->id,
	                'status_id'     => $item->status_id,
	                'branch_id'    	=> $item->branch_id,
	                'room_id'       => $item->room_id,
	                'type' 	  		=> $item->type,
	                'hours_12' 	  	=> $item->hours_12,
	                'hours_24'      => $item->hours_24
	            );
	            
	            return response()->json($data);

			}elseif($requests == 'delete'){

				$rt = Rates::find($request->item);

				$rt->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'social-media'){

			if($requests == 'save'){

				$nid = $request->id;
				$sm = !empty($nid) ? Social_media::find($nid) : new Social_media;

				$sm->name 			= $request->name;
				$sm->icon 			= $request->icon;
				$sm->url 			= $request->url;
				$sm->status_id 		= $request->status;

				$validator = Validator::make($request->all(), [
					'name' => 'required',
					'icon' => 'required',
					'url' => 'required',
					'status' => 'required'
		        ]);
		        
		        if(!$validator->fails()){

                	$sm->save();

                	$status1 = !empty($nid) ? 'updated.' : 'saved.';
                	$status = true;
	           		$message = 'Data successfully '.$status1;

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}elseif($requests == 'get'){

				$item = Social_media::orderBy('id', 'desc')->get();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="'.url('/cms/social-media-management/edit/'.$rec->id).'" class="btn btn-outline-info btn-sm editData" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
	                    $button .= '<li><a href="javascript:void(0)" id="social-'.$rec->id.'" class="btn btn-outline-danger btn-sm delData" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                        $rec->name,
	                        '<i class="'.$rec->icon.'"</i>',
	                        '<a href="//'.$rec->url.'" target="_blank">'.$rec->url.'</a>',
	                        $rec->status_id != 1 ? 'Inactive' : 'Active',
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);


			}elseif($requests == 'delete'){

				$sm = Social_media::find($request->item);

				$sm->delete();

				$status = true;
		        $message = 'Data successfully deleted.';

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'inquiry'){

			if($requests == 'get'){

				$item = Inquiry::orderBy('id', 'desc')->get();

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $button = '<ul class="table-button">';
	                    $button .= '<li><a href="javascript:void(0)" id="inquiry-'.$rec->id.'" class="btn btn-outline-primary btn-sm viewData" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-search"></i></a></li>';
	                    $button .= '</ul>';

	                    $data['aaData'][] = array(

	                    	date('Y-m-d', strtotime($rec->created_at)),
	                        $rec->type,
	                        $rec->email,
	                        $button

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);

			}elseif($requests == 'search'){

				$data = [];
				$item = Inquiry::find($request->item);

	            $data['inquiry'] = array(
	                'type'      => $item->type,
	                'name'   	=> $item->name,
	                'email'   	=> $item->email,
	                'number'   	=> $item->number,
	                'message'   => $item->message,
	            );
	            
	            return response()->json($data);

			}

		}elseif($type == 'logs'){

			if($requests == 'get'){

				$item = Activity::orderBy('id', 'desc')->get();
				$item->map(function($data){
		    		return $data->user = User::withTrashed()->where('id', $data->causer_id)->first()->email;
		    	});

                if($item->count() > 0){

	                foreach($item as $rec){

	                    $data['aaData'][] = array(

	                    	date('F j, Y h:i A', strtotime($rec->created_at)),
	                    	$rec->description,
	                        str_replace('App\\', '', $rec->subject_type) != 'Slider' ? str_replace('App\\', '', $rec->subject_type) : 'Home Banner',
	                        $rec->user

	                    );

	                }

                }else{
                    $data['aaData'] = array();
                }

                return response()->json($data);

			}elseif($requests == 'search'){

				$item = Activity::find($request->item)->properties;
				$data = '';

				if(count($item) > 0){

					$data .= !empty(json_decode($item)->old) ? '<h6><strong>New Data</strong></h6>' : '';
					
					foreach(json_decode($item)->attributes as $key => $row){

						$data .= '<div class="mb-2">
							<strong>'.$key.':</strong>
							<p class="m-0">'.$row.'</p>
						</div>';

					}
					if(!empty(json_decode($item)->old)){

						$data .= '<h6 class="mt-3"><strong>Previews Data</strong></h6>';

						foreach(json_decode($item)->old as $key => $row1){
							$data .= '<div class="mb-2">
								<strong>'.$key.':</strong>
								<p class="m-0">'.$row1.'</p>
							</div>';
						}

					}
				}else{
					$data .= '<strong>No data available</strong>';
				}

	           	echo $data;
			}

		}elseif($type == 'settings'){

			if($requests == 'save'){

				$setting = Setting::find(1);

				$setting->email 			= $request->email;
				$setting->phone 			= $request->phone_number;

				$validator = Validator::make($request->all(), [
					'email' => 'required',
					'phone_number' => 'required'
		        ]);
		        
		        if(!$validator->fails()){

                	$setting->save();

                	$status = true;
	           		$message = 'Settings successfully updated';

		        }else{
		            $status = false;
		            $message = $validator->errors()->all();
		        }

		        return response()->json([
		            'status' => $status,
		            'message' => $message
		        ]);

			}

		}elseif($type == 'filter'){

			if($requests == 'city'){

				$data = array();
				$pid = $request->item;
                $item = City::where('province_id', $pid)->get();

                if($item->count() > 0){

                    foreach($item as $rec){

                        $data['city'][] = array(
                            
                            'id' => $rec->id,
                            'city' => $rec->city

                        );

                    }

                }else{
                    $data['city'] = array();
                }

                return response()->json($data);

			}

		}

	}

}
