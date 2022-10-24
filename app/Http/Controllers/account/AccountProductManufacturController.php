<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\AfterProccessProduct;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Models\RawStock;
use App\Models\SampleItem;
use Auth;
use Carbon\Carbon;

class AccountProductManufacturController extends Controller
{
    public function productManufacturing(Request $request)
    {
        $status = $request->type;
        menuSubmenu('product', $status . 'Product');
        if ($request->type == 'all') {
            $products = Product::with('product_materials')->where('status', '!=', 'temp')->orderBy('id','DESC')->paginate(30);
        } else {
            $products = Product::with('product_materials')
                ->where('status', '!=', 'temp')
                ->orderBy("id","DESC")
                ->where('status', $status)
                ->paginate(30);
        }


        return view('accounts.productManufacturing.productManufacturing', compact('products', 'status'));
    }

    public function AddProductManufacturing()
    {
        $product = Product::where('status', 'temp')->first();
        if (!$product) {
            $product = new Product;
            $product->status = 'temp';
            $product->addedBy_id = Auth::id();
            $product->save();
        }
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        return view('accounts.productManufacturing.newProductManufacturing', compact('samples', 'product'));
    }

    public function productManufacturingAjax(Request $request, Product $product)
    {
        $product->sample_id = $request->id;
        $product->save();
        $sample_items = SampleItem::where('sample_id', $request->id)->get();
        return view('accounts.productManufacturing.ajax.appendSampleItems', compact('sample_items', 'product'))->render();
    }
    public function productManufacturingCalculateAjax(Request $request, Product $product)
    {
        $multiply = $request->multiply;
        return view('accounts.productManufacturing.ajax.appendSampleItemsWithCalculate', compact('product', 'multiply'))->render();
    }
    public function storeProductManufacturing(Product $product, Request $request)
    {
        $product->multiply_qty = $request->multiply_qty;
        $product->save();

        foreach ($product->sample->sample_items as $key => $sampleItem) {
            $totalBatchQuantity = 0;
            if ($sampleItem->raw->firstBatch()) {
                $totalBatchQuantity += $sampleItem->raw->firstBatch()->total_quantity;
            }
            if ($sampleItem->raw->secondBatch()) {
                $totalBatchQuantity += $sampleItem->raw->secondBatch()->total_quantity;
            }
            if ($sampleItem->raw->thirdBatch()) {
                $totalBatchQuantity += $sampleItem->raw->thirdBatch()->total_quantity;
            }
            if ($request->multiply > $totalBatchQuantity) {
                return redirect()->back()->with('warning', 'We do not have the quality you provided');
            }
            $totalBatchQuantity = 0;
        }
        $product->sample_name = $product->sample->name;
        $product->sample_unit = $product->sample->unit;
        $product->sample_unit_value = $product->sample->unit_value;
        $product->sample_unit_price = $request->sample_unit_price;
        $product->sample_total_price = $request->sample_total_price;
        $product->status = 'pending';
        $product->pending_at = Carbon::now();


        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->unit_value = $request->unit_value;
        $product->unit_price = $request->unit_price;
        // $product->total_price = $request->total_price;
        $product->multiply_qty = $request->multiply;
        $product->save();

        $stock_ids = $request->stock;
        $quantities = $request->quantity;
        $total_raw_quanity = 0;
        $total_raw_price = 0;
        for ($i = 0; $i < count($stock_ids); $i++) {
            $stock = RawStock::find($stock_ids[$i]);
            $product_material = new ProductMaterial;
            $product_material->product_id = $product->id;
            $product_material->stock_id = $stock->id;
            $product_material->raw_id = $stock->raw_id;
            $product_material->unit_price = $stock->unit_price;
            $product_material->unit = $stock->unit;
            $product_material->total_price = $stock->unit_price * $quantities[$i];
            $product_material->quantity = (int) $quantities[$i];
            $product_material->save();
            $total_raw_quanity += $product_material->quantity;
            $total_raw_price += $product_material->quantity * $product_material->unit_price;

            // $stock->decrement('total_quantity', $product_material->quantity);
            // $stock->save();
            // dump($quantities[$i]);
            // dump($product_material->quantity);
            // dump($product_material->stock_id);
        }
        $product->total_raw_quantity = $total_raw_quanity;
        $product->total_raw_price = $total_raw_price;
        $product->total_price = $total_raw_price;
        $product->save();

        return redirect()->back()->with('success', 'Product Successfully Added');
    }

    public function deleteProductManufacturing(Product $product)
    {
        if ($product->status != 'pending') {
            return redirect()->back()->with("warning", "You are not able to delete this product, Because this product is {$product->status}");
        }
        foreach ($product->product_materials as $key => $item) {
            $item->stock()->increment('total_quantity', $item->quantity);
            $item->delete();
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product successfully Deleted');
    }
    public function viewProductManufacturing(Product $product, Request $request)
    {
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        $product = Product::where('id',$product->id)->with('product_materials')->first();
        return view('accounts.productManufacturing.viewProductManufacturing', compact('product', 'samples'));
    }
    public function editProductManufacturing(Product $product, Request $request)
    {
        if ($product->status != 'pending') {
            return redirect()->back()->with("warning", "You are not able to edit this product. because, This product status is {$product->status}");
        }

        // $product = $product->with('product_materials')->first();
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        return view('accounts.productManufacturing.editProductManufacturing', compact('product', 'samples'));
    }



    public function editProductManufacturingAjax(Product $product, Request $request)
    {
        // $product->sample_id = $request->sample_id;
        // $product->save();
        $multiply = $request->multiply;
        if ($multiply == $product->multiply_qty) {
            $status = 'same';
            return view('account.productManufacturing.ajax.edit.isSame', compact('product', 'status'))->render();
        }
        if ($request->multiply < $product->multiply_qty) {
            $status = 'less';
            return view('account.productManufacturing.ajax.edit.isLess', compact('product', 'multiply', 'status'))->render();
        }
        if ($request->multiply > $product->multiply_qty) {
            $status = 'less';
            return 'beshi';
        }
    }

    public function updateProductManufacturing(Product $product, Request $request)
    {

        if ($request->status == 'update') {
            if ($product->status !='pending') {
                return redirect()->back()->with("warning", "We are not able to update this product. Because, this product is {$product->status}");
            }

            if (!$request->multiply) {
                return redirect()->back()->with('warning', 'Must Input Quantity');
            }
            foreach ($product->sample->sample_items as $key => $sampleItem) {
                $totalBatchQuantity = 0;
                if ($sampleItem->raw->firstBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->firstBatch()->total_quantity;
                }
                if ($sampleItem->raw->secondBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->secondBatch()->total_quantity;
                }
                if ($sampleItem->raw->thirdBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->thirdBatch()->total_quantity;
                }
                if ($request->multiply > $totalBatchQuantity) {
                    return redirect()->back()->with('warning', 'We do not have the Quantity that you provided');
                }
                $totalBatchQuantity = 0;
            }

            if ($product->product_materials) {
                $product->product_materials()->delete();
            }
            $product->sample_name = $product->sample->name;
            $product->sample_unit = $product->sample->unit;
            $product->sample_unit_value = $product->sample->unit_value;
            $product->sample_unit_price = $request->sample_unit_price;
            $product->sample_total_price = $request->sample_total_price;
            $product->status = 'pending';
            $product->pending_at = Carbon::now();


            $product->name = $request->name;
            $product->unit = $request->unit;
            $product->unit_value = $request->unit_value;
            $product->unit_price = $request->unit_price;
            // $product->total_price = $request->total_price;
            $product->multiply_qty = $request->multiply;
            $product->save();

            $stock_ids = $request->stock;
            $quantities = $request->quantity;
            $total_raw_quanity = 0;
            $total_raw_price = 0;
            for ($i = 0; $i < count($stock_ids); $i++) {
                $stock = RawStock::find($stock_ids[$i]);

                $product_material = new ProductMaterial;
                $product_material->product_id = $product->id;
                $product_material->stock_id = $stock->id;
                $product_material->raw_id = $stock->raw_id;
                $product_material->type = 'raw';
                $product_material->unit_price = $stock->final_price;
                $product_material->unit = $stock->unit;
                $product_material->total_price = $stock->final_price * $quantities[$i];
                $product_material->quantity = (int) $quantities[$i];
                $product_material->save();

                $total_raw_quanity += $product_material->quantity;
                $total_raw_price += $product_material->quantity * $product_material->unit_price;
            }
            $product->total_raw_quantity = $total_raw_quanity;
            $product->total_raw_price = $total_raw_price;
            $product->total_price = $total_raw_price;
            $product->save();
            return redirect()->back()->with('success', 'Product Successfully Updated');
        }


        if ($request->status== 'confirm') {

            if ($request->confirm =='confirm') {
                foreach ($product->product_materials as $key => $product_material) {
                    $product_material->stock->decrement('total_quantity', $product_material->quantity);
                }
                $product->status = 'confirmed';
                $product->confirmed_at = Carbon::now();
                $product->save();
             }else {
                $product->status = 'rejected';
                $product->rejected_at = Carbon::now();
                $product->save();
             }

           return redirect()->route('account.productManufacturing', ['type' => 'confirmed'])->with('success', 'Product Successfully Updated');
        }

        if ($request->status == 'in_stocked') {
            $product->status = 'in_stocked';
            $product->in_stocked = Carbon::now();
            $product->save();
            return redirect()->route('account.productManufacturing', ['type' => 'in_stocked'])->with('success', 'Product Stocked in Successfully');
        }
    }
    // public function updateProductManufacturing(Product $product, Request $request)
    // {

    //     if ($request->status == 'confirm') {
    //         foreach ($product->sample->sample_items as $key => $sampleItem) {
    //             $totalBatchQuantity = 0;
    //             if ($sampleItem->raw->firstBatch()) {
    //                 $totalBatchQuantity += $sampleItem->raw->firstBatch()->total_quantity;
    //             }
    //             if ($sampleItem->raw->secondBatch()) {
    //                 $totalBatchQuantity += $sampleItem->raw->secondBatch()->total_quantity;
    //             }
    //             if ($sampleItem->raw->thirdBatch()) {
    //                 $totalBatchQuantity += $sampleItem->raw->thirdBatch()->total_quantity;
    //             }
    //             if ($request->multiply > $totalBatchQuantity) {
    //                 return redirect()->back()->with('warning', 'We do not have the quality you provided');
    //             }
    //             $totalBatchQuantity = 0;
    //         }
    //         if ($request->confirm == 'update') {
    //             if ($product->status !='pending') {
    //                 return redirect()->back()->with("warning", "We are not able to update this product. Because, this product is {$product->status}");
    //             }

    //             if ($product->product_materials) {
    //                 $product->product_materials()->delete();
    //             }


    //             $product->sample_name = $product->sample->name;
    //             $product->sample_unit = $product->sample->unit;
    //             $product->sample_unit_value = $product->sample->unit_value;
    //             $product->sample_unit_price = $request->sample_unit_price;
    //             $product->sample_total_price = $request->sample_total_price;
    //             $product->status = 'pending';
    //             $product->pending_at = Carbon::now();

    //             $product->name = $request->name;
    //             $product->unit = $request->unit;
    //             $product->unit_value = $request->unit_value;
    //             $product->unit_price = $request->unit_price;
    //             $product->total_price = $request->total_price;
    //             $product->multiply_qty = $request->multiply;
    //             $product->save();

    //             $stock_ids = $request->stock;
    //             $quantities = $request->quantity;
    //             for ($i = 0; $i < count($stock_ids); $i++) {
    //                 $stock = RawStock::find($stock_ids[$i]);
    //                 $product_material = new ProductMaterial;
    //                 $product_material->product_id = $product->id;
    //                 $product_material->stock_id = $stock->id;
    //                 $product_material->raw_id = $stock->raw_id;
    //                 $product_material->unit_price = $stock->unit_price;
    //                 $product_material->unit = $stock->unit;
    //                 $product_material->total_price = $stock->unit_price * $quantities[$i];
    //                 $product_material->quantity = (int) $quantities[$i];
    //                 $product_material->save();
    //                 // $stock->decrement('total_quantity', $product_material->quantity);
    //                 $stock->save();
    //             }
    //             return redirect()->back()->with('success', 'Product Successfully Updated');
    //         } elseif ($request->confirm == 'confirm') {
    //             foreach ($product->product_materials as $key => $product_material) {
    //                 $product_material->stock->decrement('total_quantity', $product_material->quantity);
    //             }
    //             $product->status = 'confirmed';
    //             $product->confirmed_at = Carbon::now();
    //             $product->save();
    //            return redirect()->route('account.productManufacturing', ['type' => 'confirmed'])->with('success', 'Product Successfully Updated');
    //         }
    //     }
    //     if ($request->status == 'in_stocked') {
    //         $product->status = 'in_stocked';
    //         $product->in_stocked = Carbon::now();
    //         $product->save();
    //         return redirect()->route('account.productManufacturing', ['type' => 'in_stocked'])->with('success', 'Product Stocked in Successfully');
    //     }
    // }

    public function readyProducts(Request $request)
    {
        menuSubmenu('readyProducts','readyProductsAll');
        $readyProducts = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->paginate(30);
        return view('accounts.readyProducts',compact('readyProducts'));
    }
}
