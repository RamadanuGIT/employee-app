<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('dashboard.agenda.invoice',[
            'title' => 'Performance Invoice',
            'invoice' => Invoice::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.agenda.create',[
            'title' => 'Create Invoice',
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'no_invoice' => 'required',
            'date' => 'required',
            'company_name' => 'required',
            'job_name' => 'required',
            'value' => 'required',
            'penerbitan' => 'required',
            'spi' => 'required',
            'pelunasan' => 'required',
        ]);
        Invoice::create($data);
        return redirect()->route('dashboard.agenda.invoice')->with('success', 'sukses membuat invoice');
    }

    public function update(Request $request, $id)
    {
        $inv = Invoice::findOrFail($id);
        $data = $request->validate([
            'no_invoice' => 'required',
            'tanggal' => 'required',
            'company_name' => 'required',
            'job_name' => 'required',
            'value' => 'required',
            'penerbit' => 'required',
            'spi' => 'required',
            'pelunasan' => 'required',

        ]);

        $inv->update($data);
        return redirect()->back()->with('success', 'Update Performance Invoice');
    }

    public function destroy($id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->delete();
        return redirect()->back()->with('success', 'Delete Performance Invoice');
    }
}
