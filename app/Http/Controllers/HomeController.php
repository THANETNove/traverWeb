<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }

    public function create()
    {
        $data = Category::get();
        return view('trave.create', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'string', 'max:255'],

        ]);

        /*   if ($request->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $image) {
                // Generate unique filename
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Move the image to the specified directory
                $image->move(public_path('assets/images/product'), $imageName);

                // Store or use $imageName as needed
                $imagePaths[] = 'assets/images/product/' . $imageName; // Store paths to use or save in database
            }
            $data->image = json_encode($imagePaths);
            // $imagePaths now contains paths to all uploaded images
        }

        $data = new Category;
        $data->name = $request->input('name');
        $data->save(); */

        return redirect('category')->with('message', "บันทึกสำเร็จ");
    }
}