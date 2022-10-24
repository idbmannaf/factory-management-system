<?php

namespace App\Http\Controllers;

use App\Models\AfterProccessProduct;
use App\Models\DailyProduction;
use App\Models\Product;
use App\Models\Raw;
use App\Models\RawStock;
use App\Models\Requisition;
use App\Models\Role\MyRole;
use App\Models\Sample;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadNow(Request $request)
    {
        $type = $request->type;
        $status = $request->status;

        if ($type == 'role') {
            if ($status == 'admin') {
                $fileName = "admin-" . now() . '.csv';
                $tasks = MyRole::has('user')->where('role_name', 'admin')->get();

                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );

                $columns = array(
                    'ID',
                    'Name',
                    'Mobile',
                    'NID',
                    'created_at',
                );

                $callback = function () use ($tasks, $columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['ID']  = $task->id;
                        $row['Name']  = $task->user->name;
                        $row['Mobile']    = $task->user->mobile;
                        $row['NID']    = $task->user->nid;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['ID'],
                            $row['Name'],
                            $row['Mobile'],
                            $row['NID'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }
            if ($status == 'production') {
                $fileName = "Production-" . now() . '.csv';
                $tasks = MyRole::has('user')->where('role_name', 'production')->get();

                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );

                $columns = array(
                    'ID',
                    'Name',
                    'Mobile',
                    'NID',
                    'created_at',
                );

                $callback = function () use ($tasks, $columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['ID']  = $task->id;
                        $row['Name']  = $task->user->name;
                        $row['Mobile']    = $task->user->mobile;
                        $row['NID']    = $task->user->nid;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['ID'],
                            $row['Name'],
                            $row['Mobile'],
                            $row['NID'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }
            if ($status == 'accounts') {
                $fileName = "accounts-" . now() . '.csv';
                $tasks = MyRole::has('user')->where('role_name', 'accounts')->get();

                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );

                $columns = array(
                    'ID',
                    'Name',
                    'Mobile',
                    'NID',
                    'created_at',
                );

                $callback = function () use ($tasks, $columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['ID']  = $task->id;
                        $row['Name']  = $task->user->name;
                        $row['Mobile']    = $task->user->mobile;
                        $row['NID']    = $task->user->nid;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['ID'],
                            $row['Name'],
                            $row['Mobile'],
                            $row['NID'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }
        }
        if ($type == 'materials') {
            if ($status == 'pack') {
                $fileName = $status."-materials-" . now() . '.csv';
                $tasks = Raw::with('medicine')->where('type', 'pack')->orderBy('category_id')->get();
                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
                $columns = array(
                    'ID',
                    'name_of_the_packaging_name',
                    'unit',
                    'unit_value',
                    'category',
                    'medicine_type',
                    'mandetory',
                    'created_at',
                );

                $callback = function () use ($tasks, $columns,$status) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['ID']  = $task->id;
                        $row["name_of_the_packaging_name"]  = $task->name;
                        $row['unit']    = $task->unit;
                        $row['unit_value']    = $task->unit_value;
                        $row['category']    = $task->category ? $task->category->name : '';
                        $row['medicine_type']    = $task->dhplCat ? json_decode($task->dhplCat->name)->en :'';
                        $row['mandetory']    = $task->mandatory ? 'Mandetory' :'Not Mandetory';
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['ID'],
                            $row["name_of_the_packaging_name"],
                            $row['unit'],
                            $row['unit_value'],
                            $row['category'],
                            $row['medicine_type'],
                            $row['mandetory'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }else{
                $fileName = $status."-materials-" . now() . '.csv';
                $tasks = Raw::with('category')->where('type', $status)->orderBy('id', 'DESC')->get();
                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
                $columns = array(
                    'ID',
                    'name_of_the_'.$status,
                    'category',
                    'unit',
                    'unit_value',
                    'created_at',
                );

                $callback = function () use ($tasks, $columns,$status) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['ID']  = $task->id;
                        $row["name_of_the_{$status}"]  = $task->name;
                        $row['category']    = $task->category ? $task->category->name : '';
                        $row['unit']    = $task->unit;
                        $row['unit_value']    = $task->unit_value;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['ID'],
                            $row["name_of_the_{$status}"],
                            $row['category'],
                            $row['unit'],
                            $row['unit_value'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }
        }
        if ($type == 'dailyProduction') {
            $fileName = "daily-production-" . $status . now() . '.csv';

            if ($type == 'all') {
                $tasks = DailyProduction::all();
            } elseif ($type == 'rejected') {
                $tasks = DailyProduction::latest()->where('status', 'rejected')->get();
            } elseif ($type == 'approved') {
                $tasks = DailyProduction::latest()->where('status', 'approved')->get();
            } elseif ($type == 'pending') {
                $tasks = DailyProduction::latest()->where('status', 'pending')->get();
            } else {
                $tasks = DailyProduction::all();
            }
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array(
                'ID',
                'product_name',
                'pack_quanitty',
                'category',
                'unit',
                'unit_value',
                'status',
                'created_at',
            );

            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['ID']  = $task->id;
                    $row['product_name']  = $task->product_name;
                    $row['pack_quanitty']  = $task->quantity;
                    $row['category']    = $task->category_name;
                    $row['unit']    = $task->unit;
                    $row['unit_value']    = $task->unit_value;
                    $row['status']    = $task->status;
                    $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                    fputcsv($file, array(
                        $row['ID'],
                        $row['product_name'],
                        $row['pack_quanitty'],
                        $row['category'],
                        $row['unit'],
                        $row['unit_value'],
                        $row['status'],
                        $row['created_at'],
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        if ($type == 'readyProduct') {

            if ($request->has('product_stock_id')) {
                $product = AfterProccessProduct::find($request->product_stock_id);
                $fileName = "ready-product-" . $request->product_id . now() . '.csv';
                $tasks = AfterProccessProduct::where('product_id', $product->product_id)->where('unit', $product->unit)->where('status','in_stocked')->where('unit_value', $product->unit_value)->latest()->get();

                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
                $columns = array(
                    'product_name',
                    'unit_price',
                    'quantity',
                    'unit',
                    'unit_value',
                    'created_at',
                );
                $callback = function () use ($tasks, $columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($tasks as $task) {
                        $row['product_name']  = $task->product->sample->name;
                        $row['unit_price']  = $task->unit_price;
                        $row['quantity']    = $task->packaging_quantity;
                        $row['unit']    = $task->unit;
                        $row['unit_value']    = $task->unit_value;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['product_name'],
                            $row['unit_price'],
                            $row['quantity'],
                            $row['unit'],
                            $row['unit_value'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            } else {

                $fileName = "ready-product-all" . now() . '.csv';
                $tasks = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->get();

                $headers = array(
                    "Content-type"        => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma"              => "no-cache",
                    "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                    "Expires"             => "0"
                );
                $columns = array(
                    'product_name',
                    'unit_price',
                    'quantity',
                    'unit',
                    'unit_value',
                    'status',
                    'created_at',
                );
                $callback = function () use ($tasks, $columns) {

                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);
                    foreach ($tasks as $task) {
                        $row['product_name']  = $task->product->sample->name;
                        $row['unit_price']  = $task->unit_price;
                        $row['quantity']    = AfterProccessProduct::where('product_id', $task->task_id)->where('unit', $task->unit)->where('unit_value', $task->unit_value)->sum('packaging_quantity');
                        $row['unit']    = $task->unit;
                        $row['unit_value']    = $task->unit_value;
                        $row['status']    = $task->status;
                        $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                        fputcsv($file, array(
                            $row['product_name'],
                            $row['unit_price'],
                            $row['quantity'],
                            $row['unit'],
                            $row['unit_value'],
                            $row['status'],
                            $row['created_at'],
                        ));
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }
        }
        if ($type == 'productManufacture') {
            if ($status == 'all') {
                $tasks =  Product::with('product_materials')->where('status', '!=', 'temp')->latest()->get();
            } elseif ($status == 'pending') {
                $tasks = Product::with('product_materials')
                    ->where('status', '!=', 'temp')
                    ->where('status', 'pending')
                    ->latest()
                    ->get();
            } elseif ($status == 'confirmed') {
                $tasks = Product::with('product_materials')
                    ->where('status', '!=', 'temp')
                    ->where('status', 'confirmed')
                    ->latest()
                    ->get();
            } elseif ($status == 'packaging') {
                $tasks = AfterProccessProduct::where('status', 'packaging')->get();
            } elseif ($status == 'processing') {
                $tasks = Product::with('product_materials')
                    ->where('status', '!=', 'temp')
                    ->where('status', 'processing')
                    ->latest()
                    ->get();
            } elseif ($status == 'rejected') {
                $tasks = Product::with('product_materials')
                    ->where('status', '!=', 'temp')
                    ->where('status', 'rejected')
                    ->latest()
                    ->get();
            } elseif ($status == 'in_stocked') {
                $tasks = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->get();
            } else {
                $fileName = 'all';
                $tasks =  Product::with('product_materials')->where('status', '!=', 'temp')->latest()->get();
            }

            $fileName = "product-manufacture-" . $status . now() . '.csv';

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array(
                'id',
                'sample_name',
                'product_name',
                'unit_price',
                'total_price',
                'unit',
                'unit_value',
                'created_at',
            );
            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['id']  = $task->id;
                    $row['sample_name']  = $task->sample_name;
                    $row['product_name']  = $task->name;
                    $row['unit_price']    = $task->unit_price;
                    $row['total_price']    = $task->total_price;
                    $row['unit']    = $task->unit;
                    $row['unit_value']    = $task->unit_value;
                    $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                    fputcsv($file, array(
                        $row['id'],
                        $row['sample_name'],
                        $row['product_name'],
                        $row['unit_price'],
                        $row['total_price'],
                        $row['unit'],
                        $row['unit_value'],
                        $row['created_at'],
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        if ($type == 'sample') {
            $fileName = "sample-all-" . now() . '.csv';

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array(
                'id',
                'sample_name',
                'unit',
                'unit_value',
                'instruction',
                'created_at',
            );

            $tasks = Sample::with('sample_items')->latest()->get();
            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['id']  = $task->id;
                    $row['sample_name']  = $task->name;
                    $row['unit']    = $task->unit;
                    $row['unit_value']    = $task->unit_value;
                    $row['instruction']    = $task->details;
                    $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                    fputcsv($file, array(
                        $row['id'],
                        $row['sample_name'],
                        $row['unit'],
                        $row['unit_value'],
                        $row['instruction'],
                        $row['created_at'],
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        if ($type == 'requisition') {
            if ($type == 'all') {
                $tasks = Requisition::orderByRaw("FIELD(status,'pending','collected','approved','stocked')")->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'pending') {
                $tasks = Requisition::where('status', 'pending')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'approved') {
                $tasks = Requisition::where('status', 'approved')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'purchase') {
                $tasks = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'pending_purchase') {
                $tasks = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'approved_purchase') {
                $tasks = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'purchase') {
                $tasks = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'collected') {
                $tasks = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } elseif ($type == 'stocked') {
                $tasks = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            } else {
                $tasks = Requisition::orderByRaw("FIELD(status,'pending','collected','approved','stocked')")->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
            }

            $fileName = "stocked-materials-" . $status . now() . '.csv';

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array(
                'date',
                'total_quantity',
                'total_price',
                'collected_qty',
                'collected_wise_price',
                'created_at',
            );

            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['date']  = $task->date;
                    $row['total_quantity']  = $task->total_quantity;
                    $row['total_price']    = $task->total_price;
                    $row['collected_qty']    = $task->collected_qty ?? 0;
                    $row['collected_wise_price']    = $task->collect_wise_price?? 0;
                    $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                    fputcsv($file, array(
                        $row['date'],
                        $row['total_quantity'],
                        $row['total_price'],
                        $row['collected_qty'],
                        $row['collected_wise_price'],
                        $row['created_at'],
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        if ($type == 'users') {

            $fileName = "users-all-" . now() . '.csv';
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array(
                'id',
                'status',
                'name',
                'mobile',
                'dob',
                'created_at',
            );

            $tasks = User::with('myroles','permissions')->latest()->get();

            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    // $roles = '';
                    // $permissions = '';
                    // foreach ($task->myroles as $key => $value) {
                    //     $roles .= $value;
                    // }
                    // foreach ($task->permissions as $key => $value) {
                    //     $permissions .= $value;
                    // }
                    $row['id']  = $task->id;
                    $row['status']    = $task->user_status ? 'Active' : 'Inactive';
                    $row['name']  = $task->name;
                    $row['mobile']    = $task->mobile;
                    $row['dob']    = $task->dob;
                    $row['created_at']    = Carbon::parse($task->created_at)->format("d-M-Y");

                    fputcsv($file, array(
                        $row['id'],
                        $row['status'],
                        $row['name'],
                        $row['mobile'],
                        $row['dob'],
                        $row['created_at'],
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
