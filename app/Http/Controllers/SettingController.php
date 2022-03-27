<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
class SettingController extends Controller
{
    public function index(){
        return view('setting');
    }

    public function store(Request $request){
        $data = Setting::where('nama','logo')->first();
        if($request->file('logo')){

            $image_path = $data->value;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            
            $file = $request->file('logo');
            $name   = Str::random(20).".".$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
            })->save(\base_path() ."/public/".$name);
            $data->value = $name;
            $data->save();
        }

        $data = Setting::where('nama','ketua_pokdarwis')->first();
        $data->value = $request->ketua_pokdarwis;
        $data->save();

        
        $data = Setting::where('nama','manager')->first();
        $data->value = $request->manager;
        $data->save();

        $data = Setting::where('nama','bendahara')->first();
        $data->value = $request->bendahara;
        $data->save();

        $data = Setting::where('nama','sekretaris')->first();
        $data->value = $request->sekretaris;
        $data->save();

        
        $data = Setting::where('nama','pengawas')->first();
        $data->value = $request->pengawas;
        $data->save();

        return redirect()->route('pengaturan')->with('success','Berhasil');
    }
}
