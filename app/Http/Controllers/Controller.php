<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $params;

    private $css_files;
    private $js_files;
    private $css_plugin_files;
    private $js_plugin_files;
    private $cms_css_files;
    private $cms_js_files;
    private $cms_css_plugin_files;
    private $cms_js_plugin_files;
        
    public function __construct(){
        
        $this->params = array();
            
        $this->css_files = array(
        	'animate.css',
            'helper.css',
        	'app.css'
        );
        
        $this->js_files = array(
        	'main.js'
        );

        $this->css_plugin_files = array(
        	'bootstrap.css',
        	'icons/fontawesome/all.min.css',
        	'icons/themify-icons/themify-icons.css',
        	'plugins/introLoader/introLoader.css',
            'plugins/jssocials/jssocials.css',
            'plugins/jssocials/jssocials-theme-flat.css',
            'plugins/font-awesome-animation/font-awesome-animation.min.css'
        );

        $this->js_plugin_files = array(
        	'jquery.min.js',
        	'bootstrap.min.js',
        	'plugins/introLoader/jquery.introLoader.min.js',
        	'plugins/waypoints/jquery.waypoints.min.js',
        	'jquery.easing.1.3.js',
            'plugins/jssocials/jssocials.min.js',
            'plugins/wow/wow.min.js'
        );

        $this->cms_css_files = array(
            'cms/sb-admin.css',
            'cms/app-admin.css'
        );
        
        $this->cms_js_files = array(
            'cms/sb-admin.js',
            'cms/scripts/cms.js'
        );

        $this->cms_css_plugin_files = array(
            'cms/bootstrap.css',
            'icons/fontawesome/all.min.css',
            'cms/plugins/datatables/dataTables.bootstrap4.css',
            'cms/plugins/dropzone/dropzone.css',
            'plugins/select2/select2.css'
        );
        
        $this->cms_js_plugin_files = array(
            'jquery.min.js',
            'cms/bootstrap.bundle.min.js',
            'jquery.easing.1.3.js',
            'cms/plugins/datatables/jquery.dataTables.min.js',
            'cms/plugins/datatables/dataTables.bootstrap4.min.js',
            'cms/plugins/dropzone/dropzone.min.js',
            'cms/plugins/sweetalert/sweetalert.min.js',
            'cms/plugins/ckeditor/ckeditor.js',
            'plugins/select2/select2.min.js',
            'cms/plugins/ajax-loading/ajax-loading.js'
        );

    }

    protected function load_header_files(){
        $include_css = '';
        $include_js = '';
        $include_plugin_css = '';
        $include_plugin_js = '';

        foreach($this->css_files as $path){
            $include_css .= sprintf('    <link href="%s" media="screen" rel="stylesheet" type="text/css" />%s',
                asset('css/'.$path), "\n");
        }

        foreach($this->js_files as $path){
            $include_js .= sprintf('    <script type="text/javascript" src="%s"></script>%s',
                asset('js/'.$path), "\n");
        }

        foreach($this->css_plugin_files as $path){
            $include_plugin_css .= sprintf('    <link href="%s" media="screen" rel="stylesheet" type="text/css" />%s',
                asset('css/'.$path), "\n");
        }

        foreach($this->js_plugin_files as $path){
            $include_plugin_js .= sprintf('    <script type="text/javascript" src="%s"></script>%s',
                asset('js/'.$path), "\n");
        }

        $this->params['css_files'] = $include_css;
        $this->params['js_files'] = $include_js;
        $this->params['css_plugin_files'] = $include_plugin_css;
        $this->params['js_plugin_files'] = $include_plugin_js;
    }

    protected function load_cms_header_files(){
        $include_cms_css = '';
        $include_cms_js = '';
        $include_cms_css_plugin_files = '';
        $include_cms_js_plugin_files = '';

        foreach($this->cms_css_files as $path){
            $include_cms_css .= sprintf('    <link href="%s" media="screen" rel="stylesheet" type="text/css" />%s',
                asset('css/'.$path), "\n");
        }

        foreach($this->cms_js_files as $path){
            $include_cms_js .= sprintf('    <script type="text/javascript" src="%s"></script>%s',
                asset('js/'.$path), "\n");
        }

        foreach($this->cms_css_plugin_files as $path){
            $include_cms_css_plugin_files .= sprintf('    <link href="%s" media="screen" rel="stylesheet" type="text/css" />%s',
                asset('css/'.$path), "\n");
        }

        foreach($this->cms_js_plugin_files as $path){
            $include_cms_js_plugin_files .= sprintf('    <script type="text/javascript" src="%s"></script>%s',
                asset('js/'.$path), "\n");
        }

        $this->params['cms_css_files'] = $include_cms_css;
        $this->params['cms_js_files'] = $include_cms_js;
        $this->params['cms_css_plugin_files'] = $include_cms_css_plugin_files;
        $this->params['cms_js_plugin_files'] = $include_cms_js_plugin_files;
    }
    
    protected function add_styles($values){
        $this->css_files = array_merge($this->css_files, (array)$values);
    }

    protected function add_scripts($values){
        $this->js_files = array_merge($this->js_files, (array)$values);
    }

    protected function add_plugin_styles($values){
        $this->css_plugin_files = array_merge($this->css_plugin_files, (array)$values);
    }

    protected function add_plugin_scripts($values){
        $this->js_plugin_files = array_merge($this->js_plugin_files, (array)$values);
    }

    protected function add_cms_styles($values){
        $this->cms_css_files = array_merge($this->cms_css_files, (array)$values);
    }

    protected function add_cms_scripts($values){
        $this->cms_js_files = array_merge($this->cms_js_files, (array)$values);
    }

    protected function add_cms_plugin_styles($values){
        $this->cms_css_plugin_files = array_merge($this->cms_css_plugin_files, (array)$values);
    }

    protected function add_cms_plugin_scripts($values){
        $this->cms_js_plugin_files = array_merge($this->cms_js_plugin_files, (array)$values);
    }


    //Url Validation
    public function _check_account_aut(){
        if(Auth::check()){
            return redirect('/cms/account-setting')->send();
        }
    }

    public function _check_account_not_aut(){
        if(!Auth::check()){
            return redirect('/login')->send();
        }
    }
}
