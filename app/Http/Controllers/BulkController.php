<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use session;

class BulkController extends Controller
{
    //
    public function csv()
    {
        return view('bulkUpload.csv_upload');
    }

    public function csvUpload(Request $request)
    {
//        $validator = Validator::make(
//            [
//                'file'      => $request->file,
//                'extension' => strtolower($request->file->getClientOriginalExtension()),
//            ],
//            [
//                'file'          => 'required',
//                'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
//            ]
//        );
        $rules = [
            'csvfile'=>'required|max:50000|mimes:csv'
        ];
        $message = [
            'csvfile.required' => 'Must be select a file'
        ];
        $this->validate($request, $rules, $message);
        $file = $request->file('csvfile');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            $h = count($header);
            $r = count($row);
            if ($h == $r) {
                $row = array_combine($header, $row);

                Product::create([
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'category_id' => $row['category_id'],
                    'brand_id' => $row['brand_id'],
                    'price' => $row['price'],
                    'discount_percent' => $row['discount_percent'],
                    'discount_price' => $row['discount_price'],
                    'discount_type' => $row['discount_type'],
                    'supplier_id' => $row['supplier_id'],
                    'qty' => $row['qty'],
                    'sku' => $row['sku'],
                    'status' => $row['status'],
                    'total_sell' => $row['total_sell'],
                    'availability' => $row['availability'],
                    'stockable' => $row['stockable'],
                    'description' => $row['description'],
                ]);

            }
        }
        return redirect()->back()->with(['success' => 'Upload Successful!']);
    }

    //Execl file upload
    public function excel()
    {
        return view('bulkUpload.excel_upload');
    }

    public function excelUpload(Request $request)
    {
        $rules = [
            'excelfile'=>'required|max:50000|mimes:xlsx,xls'
        ];
        $message = [
            'excelfile.required' => 'Must be select a file'
        ];
        $this->validate($request, $rules, $message);

        if ($request->hasFile('excelfile')) {
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path)->get();
            if ($data->count()) {
                foreach ($data as $key => $row) {
                    $product_list[] = [
                        'title' => $row->title,
                        'image' => $row->image,
                        'category_id' => $row->category_id,
                        'brand_id' => $row->brand_id,
                        'price' => $row->price,
                        'discount_percent' => $row->discount_percent,
                        'discount_price' => $row->discount_price,
                        'discount_type' => $row->discount_type,
                        'supplier_id' => $row->supplier_id,
                        'qty' => $row->qty,
                        'sku' => $row->sku,
                        'status' => $row->status,
                        'total_sell' => $row->total_sell,
                        'availability' => $row->availability,
                        'stockable' => $row->stockable,
                        'description' => $row->description,
                    ];
                }
                if (!empty($product_list)) {
                    Product::insert($product_list);
                }
            }
        } else {
        }
        return redirect()->back()->with(['success' => 'Upload Successful!']);
    }
}
