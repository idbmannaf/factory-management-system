<template>
    <div class="padding-top-">
        <div class="card">
            <div class="card-header">
                <div class="h3">
                    Products  
                    <!-- <router-link class="btn btn-primary btn-sm h6 float-right" :to="{name: 'agent.ecommerce.product.create'}">
                        <i class="fa fa-plus"></i> new
                    </router-link> -->
                </div>
            </div>  
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>a</th>
                                <th>b</th>
                            </tr>
                        </thead>
                        <tbody>
                               <ecommerce-product-list-item></ecommerce-product-list-item> 
                               <ecommerce-product-list-item></ecommerce-product-list-item> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>