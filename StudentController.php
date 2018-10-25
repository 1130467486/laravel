<?php 
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StudentController extends Controller{
	// 查询原生sql语句
	public function select(){
    $sql = "select * from student";
    $student = DB::select($sql);
    var_dump($student);
	}

    // 新增原生sql语句
    public function insert(Request $request){
      $sql = "insert into student(username,sex,age) values('飞机','男',20)";
      // var_dump($sql);die();h
      $student = DB::insert($sql);
      var_dump($student);
    }
    //删除原生sql语句
    // public function delete(){
    //   $sql = "delete from student where id =1";
    //   $student = DB::delete($sql);
    //   print_r($student);
    // }
    //使用查询之类的 GET
    public function get(){
	  $sql = DB::table("student")->get();
	  dd($sql);
    }
    public function stuinsert(Request $request){
       if($request->isMethod('post')){
          
          $data = $request->all();//收集表单所有的数据
          //删除_token字段 注销
          unset($data['_token']);
          //开始增加
          $add = DB::table('student')->insert($data);

          //判断
          if($add){
          	return redirect('student4');
          }
          

       }else{
       	return view('admin.stuinsert');
       }
    }
    //展示
    public function stuindex(){
    	$data = DB::table('student')->paginate();
    	return view("admin.stuindex",['data'=>$data]);
    }
    //删除
    public function delete(){
        	//获取数据id
    	$id = $_GET['id'];
    	//执行的DB语句
    	$delete = DB::table('student')->where('id',$id)->delete();
    	if($delete){
    		return redirect('student5');
    	}else{
    		return redirect('student5');
    	}
    }
    //修改
    public function update(Request $request){
        if($request->isMethod('post')){
        	//执行sql语句
        	$up = DB::table('student')->where("id",$_POST['id'])->update(["username"=>$_POST['username'],"sex"=>$_POST['sex'],"age"=>$_POST['age']]);
        	if($up){
        		return redirect('student5');
        	}else{
        		return redirect('update');
        	}
        }else{
        	//获取id 查看数据
        	$id = $_GET['id'];

        	$res = DB::table('student')->where("id",$id)->first();

        	return view('admin.update',['res'=>$res]);
        }
    }
}



 ?>