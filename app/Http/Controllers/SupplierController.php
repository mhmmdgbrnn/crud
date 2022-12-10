<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\suppliers;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = suppliers::paginate(10);
        return view('suppliers.index', ['suppliers' =>
        $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //fungsi untuk memanggil view
        return view("suppliers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //fungsi logika untuk menyimpan data ke table
            $this->validate($request, [
                'kode' => 'required|unique:suppliers,kode|string|max:5',
                'nama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required|max:13'
            ]);
            $new_supplier = new suppliers();
    
            $new_supplier->kode = $request->get('kode');
            $new_supplier->nama = $request->get('nama');
            $new_supplier->alamat = $request->get('alamat');
            $new_supplier->telepon = $request->get('telepon');
    
            $new_supplier->save();
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('suppliers.index')->with('status-create', 'Tambah supplier berhasil');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = suppliers::findOrFail($id);
        return view('suppliers.edit', ['supplier' => $supplier]);
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
        $this->validate($request, [
            'kode' => 'required|unique:suppliers,kode|max:5', Rule::unique ('suppliers')->ignore($id),
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|max:13'
        ]);

        $supplier = suppliers::findOrFail($id);

        $supplier->kode = $request->get('kode');
        $supplier->nama = $request->get('nama');
        $supplier->alamat = $request->get('alamat');
        $supplier->telepon = $request->get('telepon');

        $supplier->save();
        return redirect()->route('suppliers.index')->with('status-edit', 'Supplier berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = suppliers::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('status-delete', 'Supplier berhasil dihapus');
    }
}