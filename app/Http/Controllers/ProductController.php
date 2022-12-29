<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function producthome()
    {
        return view('Admin.Product.index');
    }

    public function productpost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
        ]);

        $data= array();

        $data['title']=$request->title;
        $data['price']=$request->price;
        $data['details']=$request->description;
        $data['status']=$request->check;

        $image=$request->file('product_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['product_image']=$image_url;
                //DB::table('products')->insert($data);
                Product::insert($data);
                $notification=array('message'=>'Product Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            //DB::table('products')->insert($data);
            Product::insert($data);
            $notification=array('message'=>'Product Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function productshow()
    {
        $data=Product::all();
        return view('Admin.Product.show',compact('data'));
    }

    public function productupdatepage($id)
    {
        $product=Product::find($id);
        return view('Admin.Product.edit',compact('product'));
    }

    public function productupdate(Request $request,$id)
    {
        $data=array();

        $data['title']=$request->title;
        $data['price']=$request->price;
        $data['details']=$request->description;
        $data['status']=$request->check;

        $image=$request->file('product_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['product_image']=$image_url;
                DB::table('products')->where('id',$id)->update($data);
                $notification=array('message'=>'Product update','alert-type'=>'success');
                return redirect()->route('adminproduct.show')->with($notification);
            }
        }else{
            DB::table('products')->where('id',$id)->update($data);
            $notification=array('message'=>'Product update','alert-type'=>'success');
            return redirect()->route('adminproduct.show')->with($notification);
        }
    }

    public function active($id)
    {
        $data=Product::find($id);
        $data->update(['status'=>0]);
        $notification=array('message'=>'Service Un Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function unactive($id)
    {
        $data=Product::find($id);
        $data->update(['status'=>1]);
        $notification=array('message'=>'Service Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $service=Product::find($id);
        File::delete($service->product_image);
        $service->delete();
        $notification=array('message'=>'Service Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
