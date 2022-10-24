 <template>
  <tr class="nowrap">
    <td>
      {{ order.id }}
    </td>
    <td>
      <router-link
        class="btn-link"
        :to="{
          name: 'agent.ecom.order.details',
          params: { orderId: order.id },
        }"
        >Details</router-link
      >
      <a
        class="btn-link text-danger"
        v-if="order.order_status === 'pending'"
        @click="deleteOrder(order.id)"
        >Delete</a
      >
        <router-link
            class="btn-link text-info"
            v-if="order.order_status === 'pending'"
            :to="{
          name: 'agent.ecom.order.details',
          params: { orderId: order.id },
        }"
        >Edit</router-link
        >
    </td>
    <td
      :class="{
        'w3-green': order.order_status == 'shipped',
        'w3-blue': order.order_status == 'confirmed',
        'w3-purple': order.order_status == 'processing',
        'w3-orange': order.order_status == 'delivered',
      }"
    >
      {{ order.order_status }}
    </td>
    <td>
      {{ order.mobile }}
    </td>
    <td>
      {{ order.created_at | date }}
    </td>
    <td>
      {{ order.total_collection_amount }}
    </td>
    <td>
      {{ order.items.length }}
    </td>
  </tr>
</template>
<style scoped>
.nowrap {
  white-space: nowrap;
}
</style>
<script>
import axios from "axios";
import router from "../pages/../../../../../router";
export default {
  props: ["order", "agent"],
  data() {
    return {};
  },
  methods: {
    deleteOrder(id) {
      axios
        .delete(window.location.origin + `/api/order/${id}`)
        .then((response) => {
            // this.getOrders();
          location.reload();
        });
    },
  },
};
</script>
