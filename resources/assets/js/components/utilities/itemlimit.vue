<template>
    <div class="input-group mb-3">
      <input type="text" class="form-control input-limit" v-model="itemLimit">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" v-on:click="setLimit">Item per page</button>
      </div>
    </div>
</template>

<script>
export default {
    props: [ 'limitName' ],
    data: function() {
        return {
            itemLimit: this.$root.$data.state.limit[this.limitName],
        }
    },
    mounted() {
        this.loadLimit();

        this.$root.$data.setLimit(this.limitName, this.itemLimit);
        this.$router.replace({query: {...this.$route.query, limit: this.$root.$data.state.limit[this.limitName] }});
    },
    methods: {
        setLimit(){
            // check if local storage is available
            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('limit-' + this.limitName, this.itemLimit);
            }
            
            this.$root.$data.setLimit(this.limitName, this.itemLimit);
            this.$router.replace({query: {...this.$route.query, limit: this.$root.$data.state.limit[this.limitName] }});
        },
        loadLimit(){
            this.itemLimit = localStorage.getItem('limit-' + this.limitName);
            if( !this.itemLimit ){
                this.itemLimit = 15;
            }
        }
    }
}
</script>

<style>
.input-limit {
    min-width: 40px !important;
    max-width: 60px !important;
}
</style>