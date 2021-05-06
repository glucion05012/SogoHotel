<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;

class LoginController extends Controller {
    
	public function __construct(){
		parent::__construct();
	}

	public function login(Request $request){

		if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status_id' => 1])){

            $message = '';
            $status = true;

        }else{
            $message = '<div class="alert alert-danger"><i class="fas fa-fw fa-times-circle"></i>Incorrect email address or password.</div>';
            $status = false;
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
	}

	public function logout(){
    	Auth::logout();
    	return redirect('/login');
    }

}
