<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Import the Str class for generating unique file names
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
        return view('dashboard.blog.index');
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

    // public function store(Request $request)
    // {
    //     try {
    //         // Validate the request data
    //         $validatedData = $request->validate([
    //             'title' => 'required',
    //             'feature_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //             'content' => 'required',
    //         ]);
 
    //         // Retrieve the authenticated user's ID
    //         $user_id = Auth::id();
    
    //         // Create a new blog post
    //         Blog::create([
    //             'title' => $validatedData['title'],
    //             'user_id' => $user_id,
    //             'featured_image' => $this->getImageUrl($request->file('feature_image'), '/uploads/blog/featured-images/'),
    //             'content' => $validatedData['content'],
    //         ]);
    
    //         // Redirect back with a success message
    //         return redirect()->back()->with('success', 'Blog post created successfully.');
    //     } catch (\Exception $e) {
    //         // Log any exceptions that occur
    //         Log::error('Error storing blog post: ' . $e->getMessage());
    //         // Redirect back with an error message
    //         return redirect()->back()->with('error', 'An error occurred while creating the blog post.');
    //     }
    // }

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
    

    
}
