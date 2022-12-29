<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminSliderController extends Controller
{
    public function sliderhome()
    {
        return view('Admin.Ad.index');
    }

    public function sliderpost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
        ]);

        $data= array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['details']=$request->description;
        $data['status']=$request->check;

        $image=$request->file('slider_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['banner_image']=$image_url;
                DB::table('banner')->insert($data);
                $notification=array('message'=>'Slider Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('banner')->insert($data);
            $notification=array('message'=>'Slider Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }

    }


    public function slidershow()
    {
        $slide=DB::table('banner')->get();

        return view('Admin.Ad.show',compact('slide'));
    }

    public function sliderupdatepage($id)
    {
        $data=DB::table('banner')->where('id',$id)->first();

        return view('Admin.Ad.edit',compact('data'));
    }

    public function sliderupdate(Request $request,$id)
    {


        $data= array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['details']=$request->description;
        $data['status']=$request->check;

        $image=$request->file('slider_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['banner_image']=$image_url;
                DB::table('banner')->where('id',$id)->update($data);
                $notification=array('message'=>'Slider Update with image','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('banner')->where('id',$id)->update($data);
            $notification=array('message'=>'Slider Update','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }

    }

    public function active($id)
    {
        $data=DB::table('banner')->where('id',$id)->update(['status'=>0]);
        $notification=array('message'=>'Slider Unactive','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function unactive($id)
    {
        $data=DB::table('banner')->where('id',$id)->update(['status'=>1]);
        $notification=array('message'=>'Slider Active','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function delete($id)
    {
        $data=DB::table('banner')->where('id',$id)->first();
        File::delete($data->banner_image);
        DB::table('banner')->where('id',$id)->delete();
        $notification=array('message'=>'Slider Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
