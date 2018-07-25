<template>
    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort</button>
        <div class="dropdown-menu">
          <a class="dropdown-item" v-for="col in sortColumns" v-on:click="sort(col.name)">{{ col.text }}</a>

          <div role="separator" class="dropdown-divider"></div>
          <a class="dropdown-item" v-on:click="direction('asc')">Ascending</a>
          <a class="dropdown-item" v-on:click="direction('desc')">Descending</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['sortColumns'],
    data: function() {
        return {
            currentSort: null,
            sortDirection: 'desc',
        }
    },
    methods: {
        sort(columnName){
            this.currentSort = columnName;
            this.$router.replace({query: {...this.$route.query, sort: columnName + ',' + this.sortDirection }});
        },
        direction(direction){

          //if currentSort is empty, check for route param
          if( !this.currentSort ){
            if( !this.$route.query.sort ){
              return;
            }
            this.currentSort = this.$route.query.sort.substr(0, this.$route.query.sort.indexOf(','));
          }

          this.sortDirection = direction;
          this.$router.replace({query: {...this.$route.query, sort: this.currentSort + ',' + this.sortDirection }});
        }
    }
}
</script>
