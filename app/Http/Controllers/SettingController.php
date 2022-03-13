<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
            $file->move(public_path(), $name);
            $data->value = $name;
            $data->save();
        }

        $data = Setting::where('nama','kepala')->first();
        $data->value = $request->kepala;
        $data->save();

        $data = Setting::where('nama','bendahara')->first();
        $data->value = $request->bendahara;
        $data->save();

        $data = Setting::where('nama','sekretaris')->first();
        $data->value = $request->sekretaris;
        $data->save();

        return redirect()->route('pengaturan')->with('success','Berhasil');
    }
}
