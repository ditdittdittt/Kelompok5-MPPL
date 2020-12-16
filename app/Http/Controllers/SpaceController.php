<?php

namespace App\Http\Controllers;

use App\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class SpaceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        // Fitur Pencarian SPACE
        if($request->has('cari')){
            $spaces = Space::where('title','LIKE','%' . $request->cari . '%')->paginate(4);
        }else{
            $spaces = Space::orderBy('created_at', 'DESC')->paginate(4);
        }
        return view('pages.space.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.space.create');
    }

    public function browse()
    {
        return view('pages.space.browse');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'photo' => ['required'],
            'photo.*' => ['mimes:jpg,png,jpeg,ico']
        ]);

        $space = $request->user()->spaces()->create($request->except('photo'));

        $spacePhotos = [];

        foreach ($request->file('photo') as $file) {
            $path = Storage::disk('public')->putFile('spaces', $file);
            $spacePhotos[] = [
                'space_id' => $space->id,
                'path' => $path
            ];
        }

        $space->photos()->insert($spacePhotos);

        return redirect()->route('space.index')->with('status', 'Lokasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $space = Space::findOrFail($id);
        return view('pages.space.show', compact('space'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user()->email;
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id && $user != 'admin_adminipbyourmaps@gmail.com') {
            return redirect()->back();
        }
        return view('pages.space.edit', compact('space'));
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
        $user = Auth::user()->email;
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id && $user != 'admin_adminipbyourmaps@gmail.com') {
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => ['required', 'min:3'],
            'address' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        $space->update($request->all());
        return redirect()->route('space.index')->with('status', 'Lokasi berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user()->email;
        $space = Space::findOrFail($id);
        if ($space->user_id != request()->user()->id && $user != 'admin_adminipbyourmaps@gmail.com') {
            return redirect()->back();
        }

        foreach ($space->photos as $photo){
            Storage::delete('public/'.$photo->path);
        }
        
        $space->delete();
        return redirect()->route('space.index')->with('status', 'Lokasi berhasil dihapus!');
    }
}
