<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        // SELECT * FROM vendors WHERE vendor_name
        $inputFilter =  $request->all();
        $vendorName = $inputFilter["vendor_name"] ?? "";

        $vendorList = Vendor::select("*");
        if ($vendorName != "") {
            $vendorList->whereRaw("vendor_name LIKE '%$vendorName%'");
        }

        return $vendorList->get();
    }

    public function search(Request $request)
    {
        $vendor = DB::selectOne("SELECT * FROM vendors WHERE id = 1");
        return response()->json($vendor);
    }

    public function create(Request $request)
    {
        $inputVendor =  $request->all();

        $validator = Validator::make($inputVendor, [
            'vendor_name' => 'required',
            'vendor_address' => 'required',
            'email' => 'nullable|email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // insert into vendor(vendor_name..) values(....)
        $vendor = new Vendor();
        $vendor->vendor_name = $inputVendor["vendor_name"];
        $vendor->vendor_address = $inputVendor["vendor_address"];
        $vendor->email = $inputVendor["email"];
        $vendor->save();
        return $vendor;
    }

    public function update($id)
    {
        // UPDATE vendors SET ..... WHERE id =
        $inputVendor =  request()->all();
        $vendor = Vendor::find($id);
        $vendor->vendor_name = $inputVendor["vendor_name"];
        $vendor->vendor_address = $inputVendor["vendor_address"];
        $vendor->email = $inputVendor["email"];
        $vendor->save();
        return $vendor;
    }

    public function delete($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        return [
            "message" => "Berhasil menghapus data Vendor dengan id : " . $id
        ];
    }
}
