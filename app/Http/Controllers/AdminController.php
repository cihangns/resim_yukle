<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getAllImage($userid){
        !isset($userid) ? response()->json("userid gelmiyor"):
        $isAdmin = User::find($userid)->isAdmin;
        if ($isAdmin == 1) {
            $images = Image::all();
            return response()->json($images);            
        }
        $images = Image::where("userId", $userid)->get();
    
        return response()->json($images);
    }
    public function deleteImage($id, $userid){
        if (!isset($userid)) {
            return response()->json("Not Authenticated");
        }
        $isAdmin = User::find($userid)->isAdmin;
        if ($isAdmin == 0) {
            $image = Image::find($id);
            if ($image->userId != $userid) {
                return response()->status();
            }
        }

        Image::destroy($id);

        return response()->json(200);
    }
    public function paginationImage(Request $req, $userid){
        $limit = $req->query("limit");
        $offset = $req->query("offset");

        !isset($userid) ? response()->json("userid gelmiyor"):

        $isAdmin = User::find($userid)->isAdmin;
        if ($isAdmin == 0) {
            $images = Image::where("userId", $userid)->offset($offset)->limit($limit)->get();
        }else{
            $images = Image::offset($offset)->limit($limit)->get();
        }

        $imagesCount = count($images);

        return response()->json([
            "images"=>$images,
            "count"=>$imagesCount
        ]);
    }

    public function setProfileOperation(Request $request, $userid){
        $user = User::find($userid);

        if ($request->hasFile("profilePhoto")) {
            $file = $request->file("profilePhoto");
            $fileName = $userid."-".time().$file->getClientOriginalName();
            $file->move(public_path("profilephotos"), $fileName);
            $fileUrl = url("profilephotos", $fileName);
            
            
            $user->name = $request->input("name");
            $user->profilePhoto = $fileUrl;
            $user->save();
            return response()->json($fileUrl);
        }   
        
        $user->name = $request->input("name");
        $user->save();
        return response()->json(["msg"=>"sadece isim kaydedildi"]);
    }

    public function getProfile($id){
        $user = User::find($id);
        return response()->json($user);
    }
}
