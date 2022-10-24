<?php
namespace App\Globals;
use Illuminate\Support\Facades\DB;
class Counts{
    public $productCount = null;
    public $requisitionCount = null;
    public $stockCount = null;
    public $productionCount = null;
    public $afterProccessProduct = null;
    public  function porductCount()
    {
        if ($this->productCount == null){
        $productManufuctureCount = DB::table('products')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
        ->selectRaw("count(case when status = 'confirmed' then 1 end) as confirmed")
        ->selectRaw("count(case when status = 'processing' then 1 end) as processing")
        ->selectRaw("count(case when status = 'packaging' then 1 end) as packaging")
        ->selectRaw("count(case when status = 'ready_to_stock' then 1 end) as ready_to_stock")
        ->selectRaw("count(case when status = 'in_stocked' then 1 end) as in_stocked")
        ->selectRaw("count(case when status = 'rejected' then 1 end) as rejected")
        ->where('status', '!=', 'temp')
        ->first();
            $this->productCount= $productManufuctureCount;
        }
        return $this->productCount;

    }
    public function requisitionCount()
    {

        if ($this->requisitionCount == null){
            $totalRequisitions = DB::table('requisitions')
                ->selectRaw('count(*) as total')
                ->where('status', '!=', 'temp')
                ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
                ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
                ->selectRaw("count(case when status = 'pending_purchase' then 1 end) as pending_purchase")
                ->selectRaw("count(case when status = 'approved_purchase' then 1 end) as approved_purchase")
                ->selectRaw("count(case when status = 'purchase' then 1 end) as purchase")
                ->selectRaw("count(case when status = 'collected' then 1 end) as collected")
                ->selectRaw("count(case when status = 'stocked' then 1 end) as stocked")
                ->first();
            $this->requisitionCount= $totalRequisitions;
        }
        return $this->requisitionCount;

    }
    public function stocks()
    {
        if ($this->stockCount == null){
            $totalStocks = DB::table('raw_stocks')
                ->selectRaw('count(*) as total')
                ->selectRaw("count(case when type = 'raw' then 1 end) as raw")
                ->selectRaw("count(case when type = 'pack' then 1 end) as pack")
                ->selectRaw("count(case when type = 'stationery' then 1 end) as stationery")
                ->first();
            $this->stockCount= $totalStocks;
        }
        return $this->stockCount;

    }
    public function production()
    {
        if ($this->productionCount == null){
            $production = DB::table('daily_productions')
                ->selectRaw('count(*) as total')
                ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
                ->selectRaw("count(case when status = 'rejected' then 1 end) as rejected")
                ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
                ->first();
            $this->productionCount= $production;
        }
        return $this->productionCount;

    }
    public function afterProccessingProduct()
    {
        if ($this->afterProccessProduct == null){
            $afterProccessProductManufuctureCount = DB::table('after_proccess_products')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = 'packaging' then 1 end) as packaging")
            ->selectRaw("count(case when status = 'in_stocked' then 1 end) as stocked")
            ->first();
                $this->afterProccessProduct= $afterProccessProductManufuctureCount;
            }
            return $this->afterProccessProduct;
    }
}
