<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <input type="text" v-model="post.name" name="category_name" />
          <input type="text" v-model="post.price" name="category_name" />
          <button class="btn btn-primary" v-on:click="createPost">Sent</button>
          <p>{{ status }}</p>
          <img
            class="rounded-circle avatar-m2 me-3"
            src="img/useravatar/Nancy1635036683.jpeg"
          />
          <img :src="require('./assets/logo.png')" />
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "AddCategory", //the form name
  data() {
    return {
      post: { name: "", price: "" },
      status: "",
    };
  },
  methods: {
    createPost() {
      axios
        .post("prox/ad/medicinecat", this.post)
        .then((response) => {
          if (response.status == 200) {
            this.status = "sending successfully";
          }
        })
        .catch((error) => this.errors.record(error.response.data));
    },
  },
};
</script>


