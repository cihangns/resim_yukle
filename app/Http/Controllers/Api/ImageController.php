<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $tumResimler = Image::all();
        return $tumResimler;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile("files")) {
            $files = $request->file("files");
            $urls = array();
            foreach ($files as $file) {
                $filename = $request->input("userid")."_".time()."-".$file->getClientOriginalName();
                $file->move(public_path("uploads"), $filename);
                $fileUrl = url('uploads', $filename);
                array_push($urls, $fileUrl);
                $newImage = new Image();
                $newImage->userId = $request->input("userid");
                $newImage->image_url = $fileUrl;
                $newImage->save();
            }
            return response()->json($urls);
    
        }
        return response()->json("dosyalar bulunamadı");                                                                                                          
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $veri = Image::find($id);
        return $veri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //     $veri = Image::destroy($request->id);
    //     return response()->json(['message'=> 'Silme işlemi başarılı']);
    // }
    public function destroy($id)
    {
        Image::destroy($id);
        return response()->json(['message'=> 'Silme işlemi başarılı']);
    }
}
