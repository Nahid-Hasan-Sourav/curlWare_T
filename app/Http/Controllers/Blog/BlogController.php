<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function store(Request $request){
        


    }
}
