<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Trave;

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
        $data = Trave::orderBy('id', 'DESC')
            ->paginate(500);

        return view('home', compact('data'));
    }

    public function create()
    {
        $data = Category::get();
        return view('trave.create', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'image.*' => ['required', 'file', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'history_tourist' => ['required'],
            'video' => ['required', 'url'], // ตรวจสอบว่า 'video' เป็น URL
            'gps' => ['required', 'url'],
            'opening_closing_time' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],

        ]);

        $data = new Trave;
        if ($request->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $image) {
                // Generate unique filename
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Move the image to the specified directory
                $image->move(public_path('assets/images/trave'), $imageName);

                // Store or use $imageName as needed
                $imagePaths[] = 'assets/images/trave/' . $imageName; // Store paths to use or save in database
            }
            $data->image = json_encode($imagePaths);
            // $imagePaths now contains paths to all uploaded images
        }

        $data->name = $request['name'];
        $data->history_tourist = $request['history_tourist'];
        $data->video = $request['video'];
        $data->gps = $request['gps'];
        $data->video = $request['video'];
        $data->opening_closing_time = $request['opening_closing_time'];
        $data->category = $request['category'];
        $data->save();

        return redirect('home')->with('message', "บันทึกสำเร็จ");
    }

    public function edit($id)
    {


        $data = Category::get();
        $dataTrave  =  Trave::find($id);
        return view('trave.edit', compact('data', 'dataTrave'));
    }


    public function update(Request $request, $id)
    {
        $data =  Trave::find($id);



        if ($request->hasFile('image')) {
            if ($data->image) {
                $desImage = json_decode($data->image);
                foreach ($desImage as $imagePath) {
                    // Assuming images are stored in public directory
                    $imagePath = public_path($imagePath); // Adjust if stored differently

                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Delete the file from the server
                    }
                }
            }


            // Upload new images        
            $images = $request->file('image');



            foreach ($images as $image) {
                // Generate unique filename
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Move the image to the specified directory
                $image->move(public_path('assets/images/trave'), $imageName);

                // Store or use $imageName as needed
                $imagePaths[] = 'assets/images/trave/' . $imageName; // Store paths to use or save in database
            }
            $data->image = json_encode($imagePaths);
            // $imagePaths now contains paths to all uploaded images 1721051708_Acer H6518STi.pdf

        }

        $data->name = $request['name'];
        $data->history_tourist = $request['history_tourist'];
        $data->video = $request['video'];
        $data->gps = $request['gps'];
        $data->video = $request['video'];
        $data->opening_closing_time = $request['opening_closing_time'];
        $data->category = $request['category'];
        $data->save();

        return redirect('home')->with('message', "เเก้ไขสำเร็จ");
    }
}