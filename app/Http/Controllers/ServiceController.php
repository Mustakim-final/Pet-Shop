<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function servicehome()
    {
        return view('Admin.Servic.index');
    }

    public function servicepost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
        ]);

        $data= array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['details']=$request->description;
        $data['status']=$request->status;

        $image=$request->file('service_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['service_image']=$image_url;
                DB::table('services')->insert($data);
                $notification=array('message'=>'Service Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('services')->insert($data);
            $notification=array('message'=>'Service Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function servicshow()
    {
        $service=Service::all();
        return view('Admin.Servic.show',compact('service'));
    }

    public function serviceupdatepage($id)
    {
        $service=Service::find($id);
        return view('Admin.Servic.edit',compact('service'));
    }

    public function serviceupdate(Request $request,$id)
    {
        $data=array();

        $data['title']=$request->title;
        $data['subtitle']=$request->sub_title;
        $data['details']=$request->title;
        $data['status']=$request->check;

        $image=$request->file('service_image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['service_image']=$image_url;
                DB::table('services')->where('id',$id)->update($data);
                $notification=array('message'=>'Service update','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            DB::table('services')->where('id',$id)->update($data);
            $notification=array('message'=>'Service update','alert-type'=>'success');
            return redirect()->route('adminservice.show')->with($notification);
        }
    }

    public function active($id)
    {
        $data=Service::find($id);
        $data->update(['status'=>0]);
        $notification=array('message'=>'Service Un Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function unactive($id)
    {
        $data=Service::find($id);
        $data->update(['status'=>1]);
        $notification=array('message'=>'Service Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $service=Service::find($id);
        File::delete($service->service_image);
        $service->delete();
        $notification=array('message'=>'Service Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


}
