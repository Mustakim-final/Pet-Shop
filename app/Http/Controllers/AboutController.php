<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AboutController extends Controller
{
    public function abouthome()
    {
        return view('Admin.About.index');
    }

    public function aboutpost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
        ]);

        $data= array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['mission']=$request->mission;
        $data['vission']=$request->vission;
        $data['status']=$request->status;

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
                DB::table('abouts')->insert($data);
                $notification=array('message'=>'About Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('abouts')->insert($data);
            $notification=array('message'=>'About Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function aboutshow()
    {
        $about=About::all();
        return view('Admin.About.show',compact('about'));
    }

    public function aboutupdatepage($id)
    {
        $about=About::find($id);
        //$about=DB::table('abouts')->where('id',$id)->first();

        return view('Admin.About.edit',compact('about'));
    }

    public function aboutupdate(Request $request,$id)
    {


        $data= array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['mission']=$request->mission;
        $data['vission']=$request->vission;
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
                DB::table('abouts')->where('id',$id)->update($data);
                $notification=array('message'=>'About Update','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('abouts')->where('id',$id)->update($data);
            $notification=array('message'=>'About Update','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id)
    {
        $data=About::find($id);
        File::delete($data->banner_image);
        $data->delete();
        $notification=array('message'=>'About Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
