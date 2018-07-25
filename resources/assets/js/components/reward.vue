<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Reward</h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
                <sort-button v-bind:sortColumns="sortColumns" style="margin-right: 12px"></sort-button>
                <item-limit></item-limit>
            </div> -->
        </div>

        <div v-if="loading">
            <spinner></spinner>
        </div>
        <div v-else>

            <div>ID: {{ product.id }}</div>
            <div>Created at: {{ product.created_at }}</div>
            <div>Last updated: {{ product.updated_at }}</div>
            <br><br>

            <form>
                <div class="form-group">
                    <label for="imagefile">Upload Image File</label>
                    <input type="file" class="form-control-file" id="imagefile">
                    {{product.image_url}}
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Product name" v-bind:value="product.name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Product description" rows="6" v-bind:value="product.description"></textarea>
                </div>
                <div class="form-group">
                    <label for="point">Point</label>
                    <input type="number" class="form-control" id="point" placeholder="1000" v-bind:value="product.point">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="text-right">
                <button type="button" class="btn btn-default" v-on:click="goBack">Back</button>
            </div>
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-default" v-on:click="goBack">Back</button>
        </div>
    </div>
</template>

<script>
import Constants from '../constants.js';

export default {
    props: ['id'],
    data: function() {
        return {
            product: [],
            loading: true,
        }
    },
    created() {
        this.getProductDetails();
    },
    watch: {
        '$route' (to, from) {
            this.getProductDetails();
        }
    },
    methods: {
        getProductDetails: function() {
            var url = Constants.API_URL + 'rewards/' + this.id;

            this.loading = true;
            axios.get(url).then(response => {
                this.product = response.data;
                this.loading = false;
            }).catch(e => {
                this.errors.push(e);
                this.loading = false;
            });
        },
        goBack () {
            this.$router.push('./');
        }
    }
}
</script>
