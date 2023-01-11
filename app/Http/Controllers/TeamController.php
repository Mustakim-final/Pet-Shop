<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function teamhome()
    {
        return view('Admin.Team.index');
    }

    public function teampost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
        ]);

        $data= array();
        $data['name']=$request->name;
        $data['title']=$request->title;
        $data['description']=$request->description;
        $data['status']=$request->status;

        $image=$request->file('image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['image']=$image_url;
                //DB::table('products')->insert($data);
                Team::insert($data);
                $notification=array('message'=>'Team member Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            //DB::table('products')->insert($data);
            Team::insert($data);
            $notification=array('message'=>'Team member Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function teamshow()
    {
        $team=Team::all();
        return view('Admin.Team.show',compact('team'));
    }

    public function teamupdatepage($id)
    {
        $team=Team::find($id);

        return view('Admin.Team.edit',compact('team'));
    }

    public function teamupdate(Request $request,$id)
    {
        $data= array();
        $data['name']=$request->name;
        $data['title']=$request->title;
        $data['description']=$request->description;
        $data['status']=$request->status;

        $image=$request->file('image');
        if($image){

            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());

            $image_full_name=$image_name.'.'.$ext;

            $uploadpath='image/';
            $image_url=$uploadpath.$image_full_name;

            $success=$image->move($uploadpath,$image_full_name);

            if($success){
                $data['image']=$image_url;
                //DB::table('products')->insert($data);
                DB::table('teams')->where('id',$id)->update($data);
                $notification=array('message'=>'Team member Update','alert-type'=>'success');
                return redirect()->route('adminteam.show')->with($notification);
            }
        }else{
            //DB::table('products')->insert($data);
            DB::table('teams')->where('id',$id)->update($data);
            $notification=array('message'=>'Team member Update','alert-type'=>'success');
            return redirect()->route('adminteam.show')->with($notification);
        }
    }

    public function active($id)
    {
        $team=Team::find($id);
        $team->update(['status'=>0]);
        $notification=array('message'=>'Team Unactive','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function unactive($id)
    {
        $team=Team::find($id);
        $team->update(['status'=>1]);
        $notification=array('message'=>'Team Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $team=Team::find($id);
        File::delete($team->image);
        $team->delete();
        $notification=array('message'=>'Team Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
