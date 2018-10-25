<?php 
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Student;
class IndexController extends Controller{
	public function index(){
		 echo "帅气得小飞机";
	}
	public function getName(){
		echo "My name is lipengkun";
	}
	public function showlist(){
		return view("admin/show");
	}
	public function getStu(){
        return Student::getName();
	}
}

 ?>