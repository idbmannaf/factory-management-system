<template>
    <div class="padding-top">
    <div class="card">
            <div class="card-header">
                <div class="h3">
                    Payment Collections
                    
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive" v-if="collections.length > 0">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Shop</th>
                            <th>Amount</th>
                            <th>Commission</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in collections" :key="index">
                            <td>{{ item.id }}</td>
                            <td>{{ item.trans_date | date }}</td>
                            <td>{{ item.source.name.en }} ({{ item.source.mobile }})</td>
                            <td>{{ item.paid_amount }}</td>
                            <td>{{ item.sr_commission_amount }}</td>
                            <td>{{ item.status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav>
            <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
            <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
            <a class="page-link" v-on:click="getCollections(page.url)" tabindex="-1">
                <span class="d-flex" v-if="page.label == 'Next &raquo;'">
                    Next <i class="fa fa-arrow-right"></i>
                </span>
                <span class="d-flex" v-else-if="page.label == '&laquo; Previous'">
                    <i class="fa fa-arrow-left"></i> Previous
                </span>
                <span v-else>
                    {{ page.label }}
                </span>
                </a>
            </li>
        </ul>
        </nav>
        </div>
    </div>
    </div>
</template>

<script>
export default {
props : ['agent'],
data() {
    return {
        collections: [],
        links: [],
    }
},
created() {
    this.getCollections()
},
methods: {
    getCollections(dataUrl = null){
    axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/ecommerce/collection/list`).then(res=>{
                if (res.status == 200) {
                    this.collections = res.data.data
                    this.links = res.data.links
                }
            });
    }
},
}
</script>

<style>

</style>