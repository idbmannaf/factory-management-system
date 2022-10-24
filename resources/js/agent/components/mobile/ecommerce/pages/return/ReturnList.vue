<template>
  <div class="padding-around">
      <div class="card">
          <div class="card-header h5">
              Shipment Return List
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-sm table-bordered table-striped">
                      <thead>
                          <th>#</th>
                          <th>Shipment Id</th>
                          <th>Return at</th>
                          <th>Items</th>
                          <th>Status</th>
                          <th>Action</th>
                      </thead>
                      <tbody>
                          <tr v-for="(item, index) in returns" :key="index">
                              <td>{{item.id}}</td>
                              <td>{{item.shipment_id}}</td>
                              <td>{{item.return_at | date}}</td>
                              <td>{{item.items_count}}</td>
                              <td>{{item.return_status}}</td>
                              <td>
                                  <router-link class="btn btn-sm btn-secondary" :to="{name: 'agent.ecom.return.details', params:{'returnId': item.id}}">Details</router-link>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <nav aria-label="...">
                <ul class="pagination table-responsive" v-if="links.length > 3">
                    <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                    <a class="page-link" v-on:click="getReturns(page.url)" tabindex="-1">
                            <span v-if="page.label == 'Next &raquo;'">
                                Next <i class="fa fa-arrow-right"></i>
                            </span>
                            <span v-else-if="page.label == '&laquo; Previous'">
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
props: ['agent'],
    data() {
        return {
            returns: [],
            links: [],
        }
    },
    created() {
        this.getReturns()
    },
    methods: {
        getReturns(dataUrl = null){
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/ecommerce/shipment/returns
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

<style>

</style>