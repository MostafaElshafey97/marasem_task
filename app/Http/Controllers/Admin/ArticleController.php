<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleComment;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }


    public function create()
    {

        return view('admin.articles.create');
    }

   




    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable',
        ];



        $messages = [
            'name.required' => 'حقل الاسم مطلوب.',
            'specialization.required' => 'حقل التخصص مطلوب.',
            'image.required' => 'حقل الصورة مطلوب.',
            'image.image' => 'يجب أن يكون الملف المرفق صورة.',
            'image.mimes' => 'الصور المسموح بها: jpeg, png, jpg, gif.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request_data = $request->except(['image']);

        if ($image = $request->file('image')) {
//            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
//            $path = public_path('/admin-asset/img/articles/' . $file_name);
//            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($path, 100);
            $request_data['image'] = store_file($request->file('image'),'admin-assets/img/articles');
        }
        Article::create($request_data);
        return redirect()->route('admin.articles.index')->with('success', 'تم حفظ المقال بنجاح.');
    }
    public function show(string $id)
    {
        //
    }


    public function edit(Article $article)
    {
       

        return view('admin.articles.edit', compact('article'));

    }



    public function update(Request $request, Article $article)
    {
         $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable',
    ];

        $messages = [
            'name.required' => 'حقل الاسم مطلوب.',
            'specialization.required' => 'حقل التخصص مطلوب.',
            'image.image' => 'يجب أن يكون الملف المرفق صورة.',
            'image.mimes' => 'الصور المسموح بها: jpeg, png, jpg, gif.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request_data = $request->except(['image']);

        if ($image = $request->file('image')) {
//            $file_name = Str::slug($request->title).".".$image->getClientOriginalExtension();
//            $path = public_path('/admin-asset/img/articles/' . $file_name);
//            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($path, 100);
//            delete_file($article->image);
            $request_data['image'] = store_file($request->file('image'),'admin-assets/img/articles');

        }

        $article->update($request_data);

        return redirect()->route('admin.articles.index')->with('success', __('تم تعديل المقال بنجاح'));
    }


    public function destroy($id)
    {
        $article = Article::find($id);
        if($article->image != null && file_exists(public_path('/admin-asset/img/articles/' . $article->image))){
            unlink('admin-asset/img/articles/' . $article->image);
        }
        $article->delete();
        return back()->with('success', trans('تم الحذف  بنجاح'));
    }


}
