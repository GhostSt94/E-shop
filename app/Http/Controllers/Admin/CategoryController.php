<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::orderBY('created_at','DESC')->paginate(5);
        return view('admin.category.index',[
            'categories'=>$category
        ]);
    }

    public function getCategories($name=null){
        $page=false;
        if($name==null || $name==''){
            $products=Category::orderBY('created_at','DESC')->paginate(5);
            $page=true;
        }else{
            $products=Category::where('name','LIKE',"%$name%")->get();
        }
        $txt="";
        foreach ($products as $item) {
                $txt.="<tr>
                        <td>$item->id</td>
                        <td>$item->name</td>
                        <td>$item->description</td>
                        <td>";
                            if ($item->image)
                            $txt.="<img src='".asset('assets/uploads/category/'.$item->image) ."' alt='".$item->name."' width='100'>";
                            else{
                            $txt.="...";}
                        $txt.="</td>
                        <td>
                            <a href='".url('/dashboard/categories/edit/'.$item->id)."' class='btn btn-outline-primary'>
                                <span class='material-icons'>edit</span>
                            </a>
                            <a href='".url('delete-category/'.$item->id)."' class='btn btn-outline-danger'>
                                <span class='material-icons'>delete</span>
                            </a>
                        </td>
                    </tr>";
        }
        $page ? 
            $pagination="
            <div class='row justify-content-center my-2'>
                <div class='col-md-4'>"
                     .$products->links()."
                    <p>
                        Displaying ".$products->count()." of ".$products->total() ." categorie(s).
                    </p>
                </div>
            </div>" : $pagination=null;
        return [$txt,$pagination];
    }
 

    public function add(){
        return view('admin.category.add');
    }

    public function insert(Request $request){
        $category= new Category();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image=$filename;
        }

        $category->name=$request->name;
        $category->slug=Str::slug($request->name);
        $category->description=$request->description;
        $category->status=$request->status==true?"1":"0";
        $category->popular=$request->popular==true?"1":"0";
        $category->meta_title=$request->meta_title;
        $category->meta_keywords=$request->meta_keywords;
        $category->meta_description=$request->meta_description;
        $category->save();
        return redirect('/dashboard/categories')->with('status','Catégory added');
    }

    public function edit($id){
        $category=Category::find($id);
        return view('admin.category.edit',[
            'category'=>$category
        ]);
    }
    public function update(Request $request,$id){
        $category=Category::find($id);
        if($request->hasFile('image')){
            $path='assets/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image=$filename;
        }
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);
        $category->description=$request->description;
        $category->status=$request->status==true?"1":"0";
        $category->popular=$request->popular==true?"1":"0";
        $category->meta_title=$request->meta_title;
        $category->meta_keywords=$request->meta_keywords;
        $category->meta_description=$request->meta_description;
        $category->update();
        return redirect('/dashboard/categories')->with('status','Category updated successfully');
    }


    public function destroy($id){
        $category=Category::find($id);
        if($category->image){
            $path='assets/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/dashboard/categories')->with('status','Category deleted successfully');
    }
}
