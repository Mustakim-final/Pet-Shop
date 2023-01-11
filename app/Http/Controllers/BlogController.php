<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function bloghome()
    {
        return view('Admin.Blog.index');
    }

    public function blogpost(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'date'=> 'required',
            'description'=>'required',
        ]);

        $data= array();

        $data['title']=$request->title;
        $data['date']=$request->date;
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
                Blog::insert($data);
                $notification=array('message'=>'Blog Inserted','alert-type'=>'success');
                return redirect()->back()->with($notification);
            }
        }else{
            //DB::table('products')->insert($data);
            Blog::insert($data);
            $notification=array('message'=>'Blog Inserted','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function blogshow()
    {
        $blog=Blog::all();
        return view('Admin.Blog.show',compact('blog'));
    }

    public function blogupdatepage($id)
    {
        $blog=Blog::find($id);
        return view('Admin.Blog.edit',compact('blog'));
    }

    public function blogupdate(Request $request,$id)
    {
        $data= array();
        $data['title']=$request->title;
        $data['date']=$request->date;
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
                DB::table('blogs')->where('id',$id)->update($data);
                $notification=array('message'=>'Blog Update','alert-type'=>'success');
                return redirect()->route('adminblog.show')->with($notification);
            }
        }else{
            //DB::table('products')->insert($data);
            DB::table('blogs')->where('id',$id)->update($data);
            $notification=array('message'=>'Blog Update','alert-type'=>'success');
            return redirect()->route('adminblog.show')->with($notification);
        }
    }

    public function active($id)
    {
        $blog=Blog::find($id);
        $blog->update(['status'=>0]);
        $notification=array('message'=>'Blog Unactive','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function unactive($id)
    {
        $blog=Blog::find($id);
        $blog->update(['status'=>1]);
        $notification=array('message'=>'Blog Active','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $blog=Blog::find($id);
        File::delete($blog->image);
        $blog->delete();
        $notification=array('message'=>'Team Delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
