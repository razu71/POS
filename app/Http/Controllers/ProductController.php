<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Validator;
use PDF;


class ProductController extends Controller
{
    public function productList(Request $request)
    {
        /*
        * Name: Naim
        * Date: 05/03/2018
        * Change: This is for Listing of product page
        */

        $data['cat'] = '';
        $data['categories'] = Category::where(['status' => STATUS_ACTIVE])->orderBy('title', 'asc')->get();

        if (isset($_GET['cat'])) $data['cat'] = $_GET['cat'];
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];

        $data['products_list'] = Product::Orderby('title', 'asc');

        if (!empty($data['cat'])) {
            $data['products_list'] = $data['products_list']->where('category_id', $data['cat']);
        }

        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['products_list'] = $data['products_list']->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('sku', 'LIKE', '%' . $search . '%');
                });
            }
        }
        $data['products_list'] = $data['products_list']->paginate(PAGINATE_SMALL, ['*'], 'p');
        return view('product.list', $data);
    }

    public function productAdd()
    {
        /*
        * Name: Naim
        * Date: 05/03/2018
        * Change: This is for view product page
        */
        $data['categoryList'] = Category::Orderby('title', 'asc')->where('status',1)->get();
        $data['supplierList'] = Supplier::Orderby('name', 'asc')->get();
        $data['brands'] = Brand::Orderby('name', 'asc')->where('status',1)->get();
        return view('product.addEdit', $data);
    }

    public function productSave(Request $request)
    {
        /*
        * Name: Naim
        * Date: 05/03/2018
        * Change: This is for add product page
        */
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'supplier_id' => 'required|max:255',
            'qty' => 'required|max:255|numeric',
            'sku' => 'required|max:255',
            'stockable' => 'required|max:255|numeric',
            'description' => 'max:500',
        ];
        if (!empty($request->discount)) {
            $rules['discount'] = 'numeric';
            $rules['discount_type'] = 'required';
        }
        $messages = [
            'title.required' => 'Title can\'t be empty.',
            'title.max' => 'Title field must be maximum 255 Character',
            'category_id.required' => 'Category can\'t be empty.',
            'brand_id.required' => 'Brand can\'t be empty.',
            'brand_id.max' => 'Brand field must be maximum 255 Character',
            'price.required' => 'Price can\'t be empty.',
            'price.numeric' => 'Price field must be numeric Character',
            'discount_price.numeric' => 'Discount price field must be numeric Character',
            'discount_type.max' => 'Discount type field must be maximum 255 Character',
            'supplier_id.required' => 'Supplier field can\'t be empty.',
            'qty.required' => 'QTY can\'t be empty.',
            'qty.max' => 'QTY field must be maximum 255 Character',
            'qty.numeric' => 'QTY field must be numeric Character',
            'sku.required' => 'Title can\'t be empty.',
            'sku.max' => 'Title field must be maximum 255 Character',
            'stockable.required' => 'Stockable field can\'t be empty.',
            'stockable.max' => 'Stockable field must be maximum 255 Character',
            'stockable.numeric' => 'Stockable field must be numeric Character',
            'description.max' => 'Title field must be maximum 255 Character',
        ];
        if ($request->image) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $messages['image.image'] = 'This is not valid image file';
            $messages['image.max'] = 'Image size is to much big!';
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
//                'barcode' => $request->sku,
                'supplier_id' => $request->supplier_id,
                'qty' => $request->qty,
                'sku' => $request->sku,
                'stockable' => $request->stockable,
                'description' => $request->description,
            ];
            if ($request->image) {
                $data['image'] = fileUpload($request->file('image'), 'upload');
            }
            if (!empty($request->edit_id)) {
                Product::where(['id' => $request->edit_id])->update($data);
                return redirect()->route('productList')->with(['message' => 'Update Successful!']);
            } else {
                Product::create($data);
                return redirect()->route('productList')->with(['message' => 'Create Successful!']);
            }
            return redirect()->route('productList')->with(['message' => 'Create Successful!']);
        }

    }

    public function productEdit($id)
    {
        /*
        * Name: Naim
        * Date: 06/03/2018
        * Change: This function for edit page.
        */
        $data['categoryList'] = Category::Orderby('title', 'asc')->get();
        $data['supplierList'] = Supplier::Orderby('name', 'asc')->get();
        $data['brands'] = Brand::Orderby('name', 'asc')->get();
        $data['productEdit'] = Product::findOrFail($id);
        return view('product.addEdit', $data)->with(['message' => 'Edit Successful!']);
    }

    public function deleteProduct($id)
    {
        /*
        * Name: Naim
        * Date: 06/03/2018
        * Change: This function for Delete single product from page.
        */
        try {
            if (!empty($id)) {
                Product::where('id', $id)->delete();
                return redirect()->back()->with(['message' => 'Delete Successful!']);
            }
            return redirect()->back()->with(['message' => 'Delete not Successful!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Opsss! Something wrong please try again']);
        }
    }

    public function printView()
    {
        /*
        * Name: Naim
        * Date: 21/03/2018
        * Change: This function for Print barcode.
        */

        $pdf = App::make('dompdf.wrapper');
        $data['products_list'] = Product::Orderby('title', 'asc')->paginate(10, ['*'], 'p');
        $pdf->loadView('product.print', $data);
        return $pdf->stream();
    }


    public function productPage()
    {
        $data = [];
        if (Session::has('cart')) {
            $data['cart'] = Session::get('cart');
            $array_key = array_keys(Session::get('cart'));
            $data['products'] = Product::whereIn('id', $array_key)->get();
        }
        return view('product', $data);
    }

    public function productSearch(Request $request)
    {
        $session_data = [];
        $data = ['message' => true, 'array_key' => '', 'total_price' => 0, 'total_qty' => 0, 'total_discount' => 0
            , 'temp_total' => 0, 'temp_discount' => 0, 'net_total_price' => 0, 'net_vat' => 0, 'data_generate' => ''];
        $data['discount'] = 0;
        $data['total'] = 0;

        $product = Product::where(['sku' => $request->search])->first();
        if (isset($product) && $product->qty>=1) {
            if (Session::has('cart')) {
                $session_data = Session::get('cart');
                if (array_key_exists($product->id, $session_data)) {
                    $session_data[$product->id] = $session_data[$product->id] + 1;
                } else {
                    $session_data[$product->id] = 1;
                }
            } else {
                $session_data[$product->id] = 1;
            }
            if($product->qty<=$session_data[$product->id]){
                return redirect()->back()->with('dismiss','This product is not in stock!');
            }
            Session::put('cart', $session_data);
        }else{
            return redirect()->back()->with('dismiss','This product is not in stock!');
        }
        return redirect()->back()->with('success','successfully added to cart');

    }

    // update cart with change of quentity
    public function updateCart(Request $request){
        $data=['success'=>true,'message'=>''];
        if($request->ajax()){
            if(isset($_GET['p_id']) && $_GET['p_id']!=''){
                $product = Product::where(['id' => $_GET['p_id']])->first();
                if (isset($product) && $product->qty>=1) {
                    if (Session::has('cart')) {
                        $session_data = Session::get('cart');
                        if (array_key_exists($product->id, $session_data)) {
                            $session_data[$product->id] = $_GET['qty'];
                        }
                    }
                    if($product->qty<=$session_data[$product->id]){
                        $data['message']='This product is not in stock!';
                        return response()->json($data);
                    }
                    Session::put('cart', $session_data);
                }else{
                    $data['message']='This product is not in stock!';
                    return response()->json($data);
                }
            }


            return response()->json($data);
        }
        return response()->json($data);
    }

    //Autocomplete search barcode and sku
    public function productBarcode(Request $request){
        $data=['success'=>true];
        if($request->ajax()){
            $data['card_no'] = $_GET['q'];

            $data['items'] = Product::select('products.*');

            if (!empty($data['card_no'])) {
                $search_token = explode(' ', $data['card_no']);
                foreach ($search_token as $search) {
                    $data['items'] = $data['items']->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%')
                            ->orWhere('sku', 'LIKE', '%' . $search . '%');
                    });
                }
            }

            $data['items'] = $data['items']->get();

            $data['success'] = true;
            return response()->json($data);
        }
        if($request->post()){
//            dd($request);
            if(!empty($request->selected_id)){
                $data['product']= Product::where(['id'=>$request->selected_id])->first();
                $data['number']= $request->number;
                if(isset($request->name)){
                    $data['name']=true;
                }
                if(isset($request->price)){
                    $data['price']= true;
                }
                if(isset($request->discount)){
                    $data['discount']= true;
                }
                if(isset($request->business)){
                    $data['business']= true;
                }

            }
            if(isset($request->print) && $request->print==1){
                $pdf = PDF::loadView('barcode.print',$data);
                return $pdf->download('barcode.pdf');
            }else{
                return view('barcode.list',$data);
            }

        }


        return view('barcode.list');
    }
}
