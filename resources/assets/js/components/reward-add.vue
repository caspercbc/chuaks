<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Product</h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
                <sort-button v-bind:sortColumns="sortColumns" style="margin-right: 12px"></sort-button>
                <item-limit></item-limit>
            </div> -->
        </div>
                       
        <form>
            <div class="form-group">
                <label for="imagefile">Upload Image File</label>
                <input type="file" class="form-control-file" id="imagefile">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Product name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" placeholder="Product description" rows="6"></textarea>
            </div>
            <div class="form-group">
                <label for="point">Point</label>
                <input type="number" class="form-control" id="point" placeholder="1000">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="text-right">
            <button type="button" class="btn btn-default" v-on:click="goBack">Back</button>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            product: [],
            loading: true,
        }
    },
    created() {
    },
    watch: {
        '$route' (to, from) {
        }
    },
    methods: {
        goBack () {
            this.$router.push('./');
        }
    }
}
</script>
