<template>
    <div>
        <div class="padding-top">
            <div class="card">
                <div class="card-header">
                    Shipment Returns
                </div>
                <div class="card-body">

                <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                <th>Shipment #</th>
                <th>Returned at</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <ecom-incoming-order-list-item v-for="(shipmentReturn, index) in returns" :key="index" :shipmentReturn="shipmentReturn" :agent="agent"></ecom-incoming-order-list-item>
                </tbody>
                </table>
                </div>
            <nav>
            <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
            <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
            <a class="page-link" v-on:click="getReturns(page.url)" tabindex="-1">
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
            <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li> -->
        </ul>
        </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            returns: null,
            links: [],
        }
    },
    created() {
        this.getReturns
    },
    methods: {
        getReturns(dataUrl = null){
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/shipment/returns
            `).then(res=>{
                if (res.status == 200) {
                    this.returns = res.data.data
                    this.links = res.data.links
                }
            });
        },
    },

}
</script>
