<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Mail;

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
use App\Rooms;
use App\Category;
use App\Branches;
use App\Rates;
use App\Province;
use App\City;
use App\Gallery;
use App\Inquiry;
use App\Social_media;
use App\Setting;

class HomeController extends Controller {
    
	public function __construct(){
		parent::__construct();

        $this->params['all_branches'] = Branches::where('status_id', 1)->get()->count();
        $this->params['social_icons'] = Social_media::where('status_id', 1)->get();
        $this->params['settings'] = Setting::find(1);
	}

	public function index(){
        $p = new Page;
        $sl = new Slider;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $this->add_plugin_styles(array(
            'plugins/bxslider/jquery.bxslider.css'
        ));

        $this->add_plugin_scripts(array(
            'plugins/bxslider/jquery.bxslider.min.js'
        ));

        $this->load_header_files();

        $events = Events::where('status_id', 1)->latest()->get();
        $events->map(function($data){
            return $data->alt = Image::find($data->image_id)->alt;
        });

        $promos = Promos::where('status_id', 1)->latest()->get();
        $promos->map(function($data){
           return $data->alt = Image::find($data->image_id)->alt;
        });
        
		$this->params['title'] = $page->title;
        $this->params['description'] = $page->description;
        $this->params['keywords'] = $page->keywords;
        $this->params['page'] = $page;
        $this->params['event'] = $events->first();
        $this->params['promo'] = $promos->first();
        $this->params['slider'] = $sl->_getpostedsliders();

		return view('website.body.home', $this->params);
	}

    public function about_us($pages = null){
        $p = new Page;
        $au = new About_us;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $au->setID($pages);
        $about = $au->_getpostedabout();

        $this->load_header_files();
        
        $this->params['title'] = !empty($pages) ? $about->title : $page->title;
        $this->params['description'] = !empty($pages) ? $about->description : $page->description;
        $this->params['keywords'] = !empty($pages) ? $about->keywords : $page->keywords;
        $this->params['pages'] = $pages;
        $this->params['page'] = $page;
        $this->params['about'] = !empty($pages) ? $about : $au->_getpostedabouts();

        return view('website.body.about_us', $this->params);
    }

    public function branches($pages = null){
        $p = new Page;
        $b = new Branches;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        if(!empty($pages)){

            $b->setID($pages);
            $branch = $b->_getpostedbranch();

            $this->add_plugin_styles(array(
                'plugins/lightslider/lightslider.css'
            ));

            $this->add_plugin_scripts(array(
                'plugins/lightslider/lightslider.min.js'
            ));

            $this->load_header_files();

            $this->params['title'] = $branch->title;
            $this->params['description'] = $branch->description;
            $this->params['keywords'] = $branch->keywords;
            $this->params['branch'] = $branch;
            $this->params['galleries'] = $b->_getpostedgalleries();
            $this->params['rates'] = $b->_getpostedrates();
            $this->params['page'] = $page;

            return view('website.body.each_branch', $this->params);

        }else{

            $this->load_header_files();
        
            $this->params['title'] = $page->title;
            $this->params['description'] = $page->description;
            $this->params['keywords'] = $page->keywords;
            $this->params['page'] = $page;
            $this->params['branches'] = $b->_getpostedbranches();
            $this->params['new_branches'] = $b->_getpostednewbranches();

            return view('website.body.branches', $this->params);

        }
    }

    public function food_beverages($cat, $sub = null){
        $p = new Page;
        $c = new Category;
        $fb = new Food_beverages;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $c->setID($cat);
        $category = $c->_getpostedfoodscategory();
        // dd($category)->all();
        $fb->setID($cat);
        $fb->sub = $sub;

        $this->add_plugin_styles(array(
            'plugins/owl-carousel/owl.carousel.css',
            'plugins/owl-carousel/owl.theme.default.css'
        ));

        $this->add_plugin_scripts(array(
            'plugins/owl-carousel/owl.carousel.min.js'
        ));

        $this->load_header_files();

        $this->params['title'] = $category->title;
        $this->params['description'] = $category->description;
        $this->params['keywords'] = $category->keywords;
        $this->params['sub'] = $sub;
        $this->params['page'] = $page;
        $this->params['categories'] = $c->where(['type' => 'food-beverages', 'status_id' => 1])->orderBy('id', 'desc')->get();
        $this->params['category'] = $category;
        $this->params['foods'] = $fb->_getpostedfoods();

        return view('website.body.food_beverages', $this->params);

    }

    public function promos($pages = null){
        $p = new Page;
        $pr = new Promos;
        
        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $pr->setID($pages);
        $promo = $pr->_getpostedpromo();

        $this->load_header_files();
        
        $this->params['title'] = !empty($pages) ? $promo->title : $page->title;
        $this->params['description'] = !empty($pages) ? $promo->description : $page->description;
        $this->params['keywords'] = !empty($pages) ? $promo->keywords : $page->keywords;
        $this->params['pages'] = $pages;
        $this->params['page'] = $page;
        $this->params['promos'] = !empty($pages) ? $promo : $pr->_getpostedpromos();

        return view('website.body.promos', $this->params);
    }

    public function events($pages = null){
        $p = new Page;
        $e = new Events;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $e->setID($pages);
        $event = $e->_getpostedevent();

        $this->load_header_files();
        
        $this->params['title'] = !empty($pages) ? $event->title : $page->title;
        $this->params['description'] = !empty($pages) ? $event->description : $page->description;
        $this->params['keywords'] = !empty($pages) ? $event->keywords : $page->keywords;
        $this->params['pages'] = $pages;
        $this->params['page'] = $page;
        $this->params['events'] = !empty($pages) ? $event : $e->_getpostedevents();

        return view('website.body.events', $this->params);
    }

    public function careers(){
        $p = new Page;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $this->load_header_files();
        
        $this->params['title'] = $page->title;
        $this->params['description'] = $page->description;
        $this->params['keywords'] = $page->keywords;
        $this->params['page'] = $page;
        $this->params['careers'] = Careers::orderBy('id', 'desc')->get();

        return view('website.body.careers', $this->params);
    }

    public function inquiry_comments(){
        $p = new Page;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $this->load_header_files();
        
        $this->params['title'] = $page->title;
        $this->params['description'] = $page->description;
        $this->params['keywords'] = $page->keywords;
        $this->params['page'] = $page;

        return view('website.body.inquiry_comments', $this->params);
    }

    public function photos($pages = null){
        $p = new Page;
        $c = new Category;
        $pt = new Photos;

        $p->setID(\Request::segment(1));
        $page = $p->_getpostedpage();

        $c->setID($pages);
        $category = $c->_getpostedphotoscategory();

        $pt->setID($pages);

        $this->load_header_files();
        
        $this->params['title'] = $category->title;
        $this->params['description'] = $category->description;
        $this->params['keywords'] = $category->keywords;
        $this->params['page'] = $page;
        $this->params['categories'] = $c->where(['type' => 'photos', 'status_id' => 1])->orderBy('id', 'desc')->get();
        $this->params['category'] = $category;
        $this->params['photos'] = $pt->_getpostedphotos();

        return view('website.body.photos', $this->params);
    }

    public function search(Request $request){

        $this->load_header_files();

        $key = $request->key;

        $food = Food_beverages::where('title', 'like', '%'.$key.'%')->where('status_id', 1)->get();
        $food->map(function($data){
            return $data->cat_url = Category::where(['id' => $data->category_id, 'type' => 'food-beverages'])->first()->url;
        });

        $photo = Photos::where('title', 'like', '%'.$key.'%')->where('status_id', 1)->get();
        $photo->map(function($data){
            return $data->url = Category::where(['id' => $data->category_id, 'type' => 'photos'])->first()->url;
        });

        $this->params['title'] = 'Search | Sogo';
        $this->params['description'] = '';
        $this->params['keywords'] = '';
        $this->params['promos'] = Promos::where('title', 'like', '%'.$key.'%')->where('status_id', 1)->get();
        $this->params['events'] = Events::where('title', 'like', '%'.$key.'%')->where('status_id', 1)->get();
        $this->params['branches'] = Branches::where('name', 'like', '%'.$key.'%')->where('status_id', 1)->get();
        $this->params['foods'] = $food;
        $this->params['photos'] = $photo;

        return view('website.body.search', $this->params);
    }

    public function login(){

        $this->_check_account_aut();
        
        $this->params['title'] = 'Login | Sogo';

        return view('website.body.login', $this->params);
    }

    public function send_mail(Request $request){

        $iq = new Inquiry;

        $type = $request->type;
        $email = $request->email;
        $name = $request->name;
        $number = $request->number;
        $message = $request->message;

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'number' => 'required',
            'message' => 'required'
        ]);
        
        if(!$validator->fails()){

            $data = [
                'type' => $type,
                'email' => $email,
                'name' => $name,
                'number' => $number,
                'message1' => $message
            ];

            $iq->type = $type;
            $iq->email = $email;
            $iq->name = $name;
            $iq->number = $number;
            $iq->message = $message;
            $iq->save();

            Mail::send('email.contact', $data, function($msg) use($data){
                $msg->from($data['email'], 'Hotel Sogo');
                $msg->to((Setting::find(1)->email), 'Recipient')->subject('Hotel Sogo');
            });

            $status = true;
            $message = '<div class="alert alert-success">Thank You! Your message has been sent successfully.</div>';

        }else{
            $status = false;
            $message = $validator->errors()->all();
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);

    }

}
