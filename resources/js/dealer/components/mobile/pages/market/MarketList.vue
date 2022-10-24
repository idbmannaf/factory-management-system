<template>
    <div class="pading-top">
        <div class="card">
            <div class="card-header">
                Market List <router-link class="btn btn-sm btn-primary float-right" :to="{name: 'dealer.market.add'}"><i class="fa fa-plus"></i> add new market</router-link>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Active Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <market-list-item v-for="(market, index) in markets" :key="index" :market="market"></market-list-item>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            markets: [
                {
                    id: 1,
                    name: 'a',
                },
                {
                    id: 2,
                    name: 'a',
                },
            ],
        }
    },
}
</script>