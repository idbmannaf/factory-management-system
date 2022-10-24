<template>
  <tr>
    <td>
      <div class="btn-group">
        <router-link
          type="button"
          class="btn w3-blue"
          v-if="this.source.active"
          :to="{
            name: 'agent.ecommerce.order.create',
            params: { shop: sourceData.id },
          }"
        >
          <i class="fas fa-cart-arrow-down"></i> Order
        </router-link>
        <button class="btn w3-red" v-else>
          <i class="fas fa-cart-arrow-down"></i> Order
        </button>
        <button
          type="button"
          @click="toggleOption(sourceData.id)"
          class="btn btn-primary dropdown-toggle dropdown-toggle-split"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" :id="'dd_' + sourceData.id">
          <router-link
            class="dropdown-item"
            :to="{
              name: 'agent.ecom.collection.create',
              params: { shopId: sourceData.id },
            }"
          >
            Payment Collection
          </router-link>

          
          <a class="dropdown-item" href="#">Order History</a>
        </div>
      </div>
    </td>
    <td>{{ sourceData.name }}</td>
    <td>{{ sourceData.mobile }}</td>
    <td>{{ sourceData.address }}</td>
    <td>{{ sourceData.owner_name }}</td>
    <td>{{ sourceData.type }}</td>
    <td>{{ sourceData.status }}</td>
  </tr>
</template>

<script>

export default {
  props: ["agent", "source"],
  data() {
    return {
      sourceData: {
        id: null,
        name: null,
        mobile: null,
        type: null,
        address: null,
        owner_name: null,
        status: null,
      },
     
    };
  },
  mounted() {},
  created() {
    //   console.log(this.agent);
    this.sourceData.id = this.source.id;
    this.sourceData.name = this.source.name.en;
    this.sourceData.mobile = this.source.mobile;
    this.sourceData.address = this.source.address.en;
    this.sourceData.type = this.source.type;
    this.sourceData.owner_name = this.source.owner_name;
    this.sourceData.status = this.source.active ? "Approved" : "Pending";
  },
  methods: {
    toggleOption(list) {
      $("#dd_" + list).dropdown("toggle");
    },
    
  },
};
</script>

<style>
</style>
