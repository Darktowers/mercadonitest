
<template>
  <form enctype="multipart/form-data" @submit.prevent="submit">
    <div class="form-group">
      <input type="file" name="file" class="file" @change="processFile($event)">
      <div v-if="error && error != ''" class="text-danger">{{ error }}</div>
      <button v-if="ext && ext == 'CSV'" type="submit" class="btn btn-primary">Enviar CSV</button>
    </div>
    <div v-if="success != '' && failures != ''" class="mt-2">
      <h3>Comandos ejecutados satisfactoriamente</h3>
      <div class="alert alert-success" role="alert">Total correctos: {{success}}</div>
      <div class="alert alert-danger" role="alert">Total errados: {{failures}}</div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      error: [],
      ext: "",
      fields: {},
      success: "",
      failures: ""
    };
  },

  methods: {
    submit() {
      let formData = new FormData();
      formData.append("file", this.fields.file);
      axios
        .post("/api/products/commands", formData)
        .then(response => {
          this.success = response.data.response.success.length;
          this.failures = response.data.response.failures.length;
          this.$parent.refreshData();
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.error = error.response.data.errors || {};
          }
        });
    },
    processFile(event) {
      this.fields.file = event.target.files[0];
      this.ext = this.fields.file.name.split(".")[1].toUpperCase();
    }
  }
};
</script>
<style>
.file {
  width: 100%;
  padding: 1em 0;
}
</style>
