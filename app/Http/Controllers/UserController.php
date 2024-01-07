<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('body.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserController $userController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserController $userController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserController $userController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserController $userController)
    {
        //
    }

    public function dashboard()
    {
        $user = User::where('nik', session('nik'))->first();
        if($user === null)
        {
            return redirect('/');
        }
        $location = Location::get($user->ip());
        $user->checkin_human = Carbon::parse($user->checkin)->setTimezone($location->timezone)->format('H:i:s');
        if ($user !== null) {
            return view('body.dashboard', [
                'user' => $user
            ]);
        }
        return view('body.index', [
            'user' => $user
        ]);
    }

    public function checkIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'name.required' => 'Nama wajib diisi'
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        dd($request->all());

        $credentials = $request->only('nik');

        if ($credentials !== null) {
            DB::beginTransaction();
            // Authentication successful, create session
            $request->session()->put('logged_in', true);
            $request->session()->put('nik', $request->nik);
            $user = User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'password' => $request->nik,
                'checkin' => now(),
                'ip_client' => $request->ip(),
                'created_at' => now(),
                'timezone' => $request->tz
            ]);
            $user->save();

            if ($user && Hash::check($user->nik, $user->password)) {
                Auth::login($user, true);
                if (Auth::check()) {
                    DB::commit();
                    return redirect('/dashboard');
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Invalid credentials');
                }
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function checkOut()
    {
        $user = User::where('nik', session('nik'))->first();
        $user->update([
            'remember_token' => null,
            'checkout' => now()
        ]);
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
