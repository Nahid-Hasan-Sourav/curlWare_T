<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    public function getImageUrl($file, $path){
        $file_path = null;
        if ($file && $file !== 'null') {
            $file_name = date('Ymd-his') . '.' . $file->getClientOriginalName();
            $file->move(public_path($path), $file_name);
            $file_path = $path . $file_name;
        }
        return $file_path ? url($file_path) : null;
    }
    public function index(){
        $user_id = Auth::id();

        $allBlog = Blog::where('user_id',$user_id)->paginate(5);
        return view('dashboard.blog.index',compact('allBlog'));
    }

    public function create(){
        return view('dashboard.blog.create');
    }

    public function uploadImages(Request $request){
        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }

    }

    

    public function store(BlogStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $user_id = Auth::id();
    
            Blog::create([
                'title' => $validatedData['title'],
                'user_id' => $user_id,
                'featured_image' => $this->getImageUrl($request->file('feature_image'), '/uploads/blog/featured-images/'),
                'content' => $validatedData['content'],
            ]);
    
            return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing blog post: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the blog post.');
        }
    }

    public function edit(Blog $blog){
        return view('dashboard.blog.edit',compact('blog'));
    }
    public function update(Request $request, $id){
        $blog = Blog::find($id);
    
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
    
        if ($request->hasFile('feature_image')) {
            if ($blog->featured_image) {
                if (file_exists(public_path($blog->featured_image))) {
                    unlink(public_path($blog->featured_image));
                }
            }
            $blog->featured_image = $this->getImageUrl($request->file('feature_image'), '/uploads/blog/featured-images/');
        }
    
        $blog->save();
    
        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id){
        $blog = Blog::find($id);

        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');

    }

    public function details($id){
        $blog = Blog::with('user')->find($id);

        return view('frontend.blog-details.index',compact('blog'));

    }
    
    

    
}
