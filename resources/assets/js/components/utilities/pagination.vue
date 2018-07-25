<template>
    <!-- <nav aria-label="Page navigation example"> -->
    <nav>
      <div v-if="totalPages > 1">
      <ul class="pagination justify-content-center">

        <li class="page-item" v-bind:class="pageData.current_page == 1 ? 'disabled' : ''">
          <a class="page-link" aria-label="Previous" v-on:click="pageNumberClicked(1)">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>

        <li v-for="page in pages" class="page-item" v-bind:class="pageData.current_page == page ? 'disabled current-page' : ''">
            <a class="page-link" v-on:click="pageNumberClicked(page)">{{page}}</a>
        </li>

        <li class="page-item" v-bind:class="pageData.current_page == pageData.last_page ? 'disabled' : ''">
          <a class="page-link" aria-label="Next" v-on:click="pageNumberClicked(pageData.last_page)">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>

      </ul>
      </div>
    </nav>

</template>

<script>
import Helper from '../../helper.js';

export default {
    props: [ 'pageData' ],
    data: function() {
        return {
            pages: Helper.determinePages( this.pageData.current_page, 1, this.pageData.last_page),
        }
    },
    computed: {
        totalPages: function() {
            return this.pages.length;
        }
    },
    methods: {
        pageNumberClicked(pageNumber) {
            this.$emit('pageNumberClicked', pageNumber);
        }
    }
}
</script>

<style>
.current-page a {
    background-color: rgba(0,0,0,0.1) !important;
    color: rgba(50,50,200,1) !important;
    font-weight: 900 !important;
}
</style>