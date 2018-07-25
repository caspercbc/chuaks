<!-- <template>
    <div>
        <h1>Rewards</h1>

        <div v-if="loading">
            <spinner></spinner>
        </div>
        <div v-else>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image Url</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Point</th>
                        <th>Last update</th>
                        <th>Date created</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="product in products">
                        <tr v-on:click="goToProductDetails(product.id)">
                            <td>{{ product.id }}</td>
                            <td>{{ product.image_url }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.point }}</td>
                            <td>{{ product.created_at }}</td>
                            <td>{{ product.updated_at }}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template> -->

<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Rewards</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button class="btn btn-default" type="button" @click="goToAddProduct()">+ Add Product</button>
            </div>
        </div>

        <div v-if="loading">
            <spinner></spinner>
        </div>
        <div v-else>
            <div class="container-fluid">
                <div class="row">
                    <div v-for="product in products" class="col-sm-4 col-lg-3" v-on:click="goToProductDetails(product.id)">
                        <!-- {{ product.id }} -->

                        <div class="card" style="margin-bottom: 30px">
                          <img class="card-img-top" v-bind:src="product.image_url" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">{{ product.name }}</h5>
                            <!--p class="card-text">{{ product.description }}</p-->
                            <p class="card-text">Points: {{ product.point }}</p>
                          </div>
                          <!-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ product.created_at }}</li>
                            <li class="list-group-item">{{ product.updated_at }}</li>
                          </ul> -->
                          <!-- <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                          </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Constants from '../constants.js';

export default {
    data: function() {
        return {
            products: [],
            loading: true,
        }
    },
    created() {
        var url = Constants.API_URL + 'rewards';

        this.loading = true;
        axios.get(url).then(response => {
            this.products = response.data;
            this.loading = false;
        }).catch(e => {
            this.errors.push(e);
            this.loading = false;
        });
    },
    methods: {
      goToProductDetails(id) {
        this.$router.push({ path: '/rewards/'+ id});
      },
      goToAddProduct() {
        this.$router.push({ path: '/rewards/add'});
      }
    }
}
</script>
