
<template>
  <div v-if="!data.products">Please wait...</div>
  <div v-else>
    <table class="table">
      <thead>
        <tr>
          <th v-for="header in headers" :key="header">{{header}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in data.products" :key="product.id">
          <th scope="row">{{product.id}}</th>
          <th scope="row">{{product.name}}</th>
          <th scope="row">{{product.reference}}</th>
          <th scope="row">{{product.price}}</th>
          <th scope="row">{{product.cost}}</th>
          <th scope="row">{{product.quantity}}</th>
          <th scope="row">{{product.active}}</th>
          <th scope="row">{{product.created_at}}</th>
          <th scope="row">{{product.updated_at}}</th>
          <th scope="row">
            <p
              v-for="subproducts in product.sub_products"
              :key="subproducts.product.id"
            >{{subproducts.product.name}}</p>
          </th>
        </tr>
      </tbody>
    </table>
    <div class="card">
      <div class="card-header">
        <h2>Commandos</h2>
      </div>
      <div class="card-body">
        <contact></contact>
      </div>
    </div>
  </div>
</template>
<script>
import contact from "./ContactForm";

export default {
  components: {
    contact
  },
  data() {
    return {
      fields: {},
      data: {},
      headers: [],
      errors: {}
    };
  },
  beforeMount() {
    axios.get("/api/products/all").then(response => {
      this.data = response.data.response;
      for (var i in this.data.products[0]) {
        this.headers.push(i);
      }
    });
  },
  methods: {
    refreshData() {
      axios.get("/api/products/all").then(response => {
        this.data = response.data.response;
      });
    }
  }
};
</script>
