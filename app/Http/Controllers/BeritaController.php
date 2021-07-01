<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $beritas = Berita::all()->sortByDesc("id");

        return view('dashboard', ['beritas' => $beritas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $judul = $request->title;
        $kategori = $request->kategori;
        $konten = $request->content;
        $created_at = Carbon::now();

        $path = $request->file('image')->store('images', 'public');


        $save = new Berita;

        $save->judul = $judul;
        $save->kategori = $kategori;
        $save->konten = $konten;
        $save->foto = $path;
        $save->created_at = $created_at;

        $save->save();

        return redirect('/dashboard')->with('success', 'Berita berhasil dipublish!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        //
        return view('posts.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required',
            'kategori' => 'required',
            'content' => 'required'
        ]);

        $judul = $request->title;
        $kategori = $request->kategori;
        $konten = $request->content;

        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
            $data = Berita::find($berita->id);
            $image_path = public_path('storage').'/'.$data->foto;
            unlink($image_path);

            $berita->judul = $judul;
            $berita->kategori = $kategori;
            $berita->konten = $konten;
            $berita->foto = $path;
    
            $berita->update();
            
        } else {
            $berita->judul = $judul;
            $berita->kategori = $kategori;
            $berita->konten = $konten;

            $berita->update();
        }
        
        return redirect('/dashboard')->with('success', 'Berita berhasil diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        $data = Berita::find($berita->id);
        $image_path = public_path('storage').'/'.$data->foto;
        unlink($image_path);
        
        $berita->delete();
        return redirect('/dashboard')->with('success', 'Berita berhasil dihapus!.');
    }
}
