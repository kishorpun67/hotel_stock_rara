<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TaxVat;
use Session;

class TaxVatController extends Controller
{
    public function taxVat()
    {
        $taxVat = TaxVat::get();
        Session::flash('page', 'taxVat');
        return view('admin.taxVat.view_taxVat', compact('taxVat'));
    }

    public function addEditTaxVat(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add TaxVat";
            $button ="Submit";
            $taxVat = new TaxVat;
            $taxVatdata = array();
            $message = "TaxVat has been added sucessfully";
        }else{
            $title = "Edit TaxVat";
            $button ="Update";
            $taxVatdata = TaxVat::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $taxVatdata= json_decode(json_encode($taxVatdata),true);
            $taxVat = TaxVat::find($id);
            $message = "TaxVat has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['vat'])){
                return redirect()->back()->with('error_message', 'Vat is required !');
            }

            if(empty($data['vat_type']))
            {
                $data['vat_type'] = "";
            }
            
            if(empty($data['tax']))
            {
                $data['tax'] = "";
            }
            if(empty($data['service']))
            {
                $data['service'] = "";
            }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $taxVat->admin_id = auth('admin')->user()->id;
            $taxVat->vat_type = $data['vat_type'];
            $taxVat->vat = $data['vat'];
            $taxVat->tax = $data['tax'];
            $taxVat->service = $data['service'];
            $taxVat->save();
            Session::flash('success_message', $message);
            return redirect('admin/taxVat');
        }
        Session::flash('page', 'taxVat');
        return view('admin.taxVat.add_edit_taxVat', compact('title','button','taxVatdata'));
    }

    public function deleteTaxVat($id)
    {
      $id =TaxVat::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'TaxVat has been deleted successfully!');
    }
}
