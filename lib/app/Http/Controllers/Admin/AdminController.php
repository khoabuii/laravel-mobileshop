<?php

namespace App\Http\Controllers\Admin;

use App\Bill;
use App\Blog;
use App\Category;
use App\Comment;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Callback;

class AdminController extends Controller
{
    //
    public function getHome(){
        $data['product']=Product::all();
        $data['prod_count']=count($data['product']);

        $data['comment']=Comment::all();
        $data['com_count']=count($data['comment']);

        $data['users']=User::all();
        $data['count_users']=count($data['users']);

        $data['blog']=Blog::all();
        $data['count_blog']=count($data['blog']);

        $data['cate']=Category::all();
        $data['count_cate']=count($data['cate']);

        $data['slide']=Slide::all();
        $data['count_slide']=count($data['slide']);

        $data['order']=Bill::all();
        return view('admin.index',$data);


    }

    public function getCustomers(){
        $data['customers']=User::all();
        return view('admin.customer.customers',$data);
    }
    public function getDeleteCustomers($id){
        User::destroy($id);
        return back()->with('success','Đã xóa thành công');
    }
    public function getFeedback(){
        $data['feed']=Feedback::all();
        return view('admin.feedback',$data);
    }
    public function getFeedbackDelete($id){
        Feedback::destroy($id);
        return back()->with('success','Xóa thành công');
    }

    public function getOrder(){
        $data['bill']=Bill::all()->sortByDesc('bill_id');
        $data['order']=DB::table('bills')
        ->join('users','bills.bill_user','=','users.id')
        ->orderBy('bill_id','desc')->get();
        //dd($data['order']);

        $data['sum']=0;
        $data['bill_total']=DB::table('bills')
        ->where('bill_status',2)->get('bill_total');
        foreach($data['bill_total'] as $value){
            $total=$value->bill_total;
            $data['sum'] +=$total;
        }
        $fromDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $tillDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $data['nowDate']=Carbon::now()->toDateString();


        $data['nowMonthDate']=Carbon::now()->firstOfMonth()->toDateString();
        $data['lastDay']=Carbon::yesterday()->toDateString();
        $data['nowMonth']=Bill::
        whereBetween('created_at',[$data['nowMonthDate'],$data['nowDate']])
        ->where('bill_status',2)
        ->get();

        $data['startOfMonth']=Bill::
        whereBetween('created_at',[$fromDate,$tillDate])
        ->where('bill_status',2)
        ->get();

        $data['today']=Bill::
        where('created_at',$data['nowDate'])
        ->where('bill_status',2)
        ->get();

        $data['yesterday']=Bill::
        where('created_at',Carbon::yesterday()->toDateString())
        ->where('bill_status',2)
        ->get();


        $data['totalMonthAfter']=0;
        foreach($data['startOfMonth'] as $value){
            $startOfMonth=$value->bill_total;
            $data['totalMonthAfter'] +=$startOfMonth;
        }

        $data['totalToday']=0;
        foreach($data['today'] as $value){
            $startOfMonth=$value->bill_total;
            $data['totalToday'] +=$startOfMonth;
        }

        $data['totalTodayMonth']=0;
        foreach($data['nowMonth'] as $value){
            $startOfMonth=$value->bill_total;
            $data['totalTodayMonth'] +=$startOfMonth;
        }
        $data['totalYesterday']=0;
        foreach($data['yesterday'] as $value){
            $startOfMonth=$value->bill_total;
            $data['totalYesterday'] +=$startOfMonth;
        }

        return view("admin.order.order",$data,['fromDate' =>$fromDate,'tillDate'=>$tillDate]);

    }
    public function getViewOrder($id){

        $data['bill_detail']=DB::table('billsdetail')
        ->where('bill_id',$id)
        ->orderBy('detail_id','desc')
        ->get();
        $data['bill']=Bill::find($id);

        return view('admin.order.vieworder',$data);
    }

    public function postViewOrder(Request $request, $id){
        $status=new Bill();
        $arr['bill_status']=$request->status;
        $status::where('bill_id',$id)->update($arr);
        return redirect('admin/order');
    }
}
