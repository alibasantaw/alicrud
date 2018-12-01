<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Profil_model; 
use App\Http\Requests\ProfilRequest;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input; 
use Excel;
use Storage;

class Profil extends Controller
{
    public function index()
    {
    	$profil_model = Profil_model::all();
    	return view('profil',compact('profil_model'));
    }

    public function create()
    {
    	return view('create');
    }

    public function edit($id)
    {
    	$profil_model=Profil_model::find($id);
    	return view('edit', compact('profil_model'));
    }

    public function text()
    {
        return view('createtext');
    }
    public function store(ProfilRequest $request)
    {
     	$profil_model 			= new Profil_model();
    	$profil_model->nama 	=$request->profil_nama;
    	$profil_model->email 	=$request->profil_email;
    	$profil_model->dob 		=$request->profil_dob;
    	$profil_model->telepon 	=$request->profil_telepon;
    	$profil_model->gender 	=$request->profil_gender;
    	$profil_model->alamat 	=$request->profil_alamat;
    	$profil_model->save();
    	// Storage::put('file.txt', 'Your name');
    	//return redirect()->route('profil.index');
        return view('success');
    }

    public function submit()
    {
        // $request->validate([
        //     'nama'          => 'required|max:255',
        //     'email'         => 'required|max:255',
        //     'dob'           => 'required',
        //     'telepon'       => 'required|numeric',
        //     '--gender--'    => 'required',
        //     'alamat'        => 'required|max:255',
        // ]);

        $nama       = Input::get('nama');
        $email      = Input::get('email');
        $dob        = Input::get('dob');
        $telepon    = Input::get('telepon');
        $gender     = Input::get('--gender--');
        $alamat     = Input::get('alamat');;
        

        $namaFile = $nama."-".date("YmdHis");


        $profil_model           = new Profil_model();
        $profil_model->nama     = Input::get('nama');
        $profil_model->email    = Input::get('email');
        $profil_model->dob      = Input::get('dob');
        $profil_model->telepon  = Input::get('telepon');
        $profil_model->gender   = Input::get('--gender--');
        $profil_model->alamat   = Input::get('alamat');
        $profil_model->save();

        $fp = fopen("C:\\".str_replace(" ", "", $namaFile).".txt","a");
        $data = $nama.','.$email.','.$dob.','.$telepon.','.$gender.','.$alamat. "\r\n";
        fwrite($fp, $data);
        fclose($fp);
        return view('success');
    }

    public function update($id){

    	$profil_model=Profil_model::find($id);
        $profil_model->nama     =Input::get('profil_nama');
        $profil_model->email    =Input::get('profil_email');
        $profil_model->dob      =Input::get('profil_dob');
        $profil_model->telepon  =Input::get('profil_telepon');
        $profil_model->gender   =Input::get('profil_gender');
        $profil_model->alamat   =Input::get('profil_alamat');
        $profil_model->save();
    	
    	// return redirect()->route('profil.index');
        return view('success');
    }

    public function destroy($id)
    {
    	$profil_model=Profil_model::find($id);
    	$profil_model->delete();
    	
    	return redirect()->route('profil.index');
    }

    public function detail($namaFile)
    {
        $content = file_get_contents("C:\\".str_replace(" ", "", $namaFile).".txt");
        $str_arr = explode (",", $content);
        
        // print_r($str_arr);
        return view('create', ['nama' => $str_arr[0], 'email' => $str_arr[1], 'dob' => $str_arr[2], 'telepon' => $str_arr[3],  'gender' => $str_arr[4], 'alamat' => $str_arr[5]]);
    }

     public function downloadExcel($type)
    {
        $data = Profil_model::get()->toArray();
        return Excel::create('profildata', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}

