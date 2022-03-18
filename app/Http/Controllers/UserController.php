<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $tempat = Place::where('is_delete',0)->orderBy('created_at', 'asc')->get();
        return view('user.index',compact('tempat'));
    }

    public function data(Request $request){
        $data = User::where('id','!=', Auth::user()->id)->orderBy('created_at','desc')->with('place');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tempat', function($row){
            if($row->place){
                return $row->place->nama;
            }else{
                return "-";
            }
        })
        ->addColumn('level', function($row){
            if($row->role == 1){
                return "Admin";
            }else if($row->role == 2){
                return "User 1";
            }
            else if($row->role == 3){
                return "User 2";
            }
        })
        ->editColumn('is_delete', function($row){
            if($row->is_delete == 0){
                return "<span class='badge bg-success'>Aktif</span>";
            }else{
                return "<span class='badge bg-danger'>Non Aktif</span>";
            }
        })
        ->addColumn('action', function($row){
         
            if($row->is_delete == 0){
                $btn = '<div class="btn btn-danger btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
                Non Aktifkan
            </div> &nbsp;';
            }else{
                $btn = '<div class="btn btn-success btn-sm btn-delete mr-2 waves-effect" data-id="'.$row->id.'">
                Aktifkan
            </div> &nbsp;';
            }
            $btn .= '<div class="btn btn-warning btn-sm edit mr-2 waves-effect" data-id="'.$row->id.'"  data-toggle="modal"><i class="fa fa-edit"></i> Ubah</div>';
            return $btn;
        })

        ->filter(function ($instance) use ($request) {
       
            if ($request->get('place_id')) {
                $instance->where('place_id', $request->get('place_id'));
            }
            if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                   $search = $request->get('search');
                   $w->orWhere('nama', 'LIKE', "%$search%")
                   ->orWhereHas('place', function($q) use($search){
                     $q->where('nama', 'LIKE', "%$search%");
                   })
                  ->orWhere('kontak', 'LIKE', "%$search%")
                  ->orWhere('alamat', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
               });
            }
        })
       
        ->rawColumns(['action','tempat','level','is_delete'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id == null){
           
            $check = User::where('email',$request->email)->where('is_delete',0)->count();
            if($check > 0){
                return redirect()->back()->with('error', 'Email telah dipakai, silahkan input email yang lain');
            }
            $user = new User;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->alamat = $request->alamat;
            $user->kontak = $request->kontak;
            $user->password = bcrypt($request->password);
            $user->role = $request->level;
            $user->place_id = $request->place_id;
            $user->save();
            
        }else{
            $user = User::find($request->id);
        
            $check = User::where('email',$request->email)->where('email','!=',$user->email)->where('is_delete',0)->count();
            if($check > 0){
                return redirect()->back()->with('error', 'Email telah dipakai, silahkan input email yang lain');
            }
            if($request->password != null){
               
                $user->nama = $request->nama;
                $user->email = $request->email;
                $user->alamat = $request->alamat;
                $user->kontak = $request->kontak;
                $user->password = bcrypt($request->password);
                $user->role = $request->level;
                $user->place_id = $request->place_id;
                $user->save();
            }
            else{
               
                $user->nama = $request->nama;
                $user->email = $request->email;
                $user->alamat = $request->alamat;
                $user->kontak = $request->kontak;
                $user->role = $request->level;
                $user->place_id = $request->place_id;
                $user->save();
            }
        }
        return redirect()->back()->with('success', 'Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where("id",$id)->first();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->is_delete =  $data->is_delete == 1?0:1;
        $data->save();
        Session::flash('success', 'Berhasil dihapus'); 
        return 1;
    }
}
