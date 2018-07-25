<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Members</h1>

            <div class="btn-toolbar" role="toolbar">

              <div class="btn-group mr-2" role="group">
                <sort-button v-bind:sortColumns="sortColumns"></sort-button>
              </div>
              <div class="btn-group mr-2" role="group">
                <item-limit limitName="members"></item-limit>
              </div>
              <div class="btn-group" role="group">
                <div>
                    <button type="button" class="btn btn-outline-secondary" v-on:click="goToAddMember">+ Add Member</button>
                </div>
              </div>

            </div>
        </div>

        <div v-if="loading">
            <spinner></spinner>
        </div>
        <div v-else>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last Updated</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="user in users">
                        <tr v-on:click="goToUserDetails(user.id)">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.updated_at }}</td>
                            <td>{{ user.created_at }}</td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <pagination v-bind:pageData="data" v-on:pageNumberClicked="goToPage"></pagination>

        </div>
    </div>
</template>

<script>
import Constants from '../constants.js';
import Helper from '../helper.js';
import PaginationComponent from './utilities/pagination.vue';
import ItemLimitComponent from './utilities/itemlimit.vue';
import SortComponent from './utilities/sortbutton.vue';

export default {
    data: function() {
        return {
            users: [],
            data: [],

            loading: true,

            sortColumns: [
                { name :'id', text: 'ID' },
                { name :'name', text: 'Name' },
                { name :'email', text: 'Email' },
                { name :'updated_at', text: 'Last Updated' },
                { name :'created_at', text: 'Date Created' }
            ]
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers(){
            var url = Constants.API_URL + 'users?' + Helper.convertObjToUrlParams(this.$route.query);

            this.loading = true;
            axios.get(url).then(response => {
                this.users = response.data.data;
                this.data = response.data;
                this.loading = false;

            }).catch(e => {
                var res = e.response;
                if( res.status == 400 ){
                    console.log(res.data);
                }

                console.log(e.response);
                this.loading = false;
            });
        },
        goToUserDetails(id) {
            this.$router.push({ path: '/members/'+ id});
        },
        goToPage(pageNumber){
            this.$router.push({query: {...this.$route.query, page: pageNumber}});
            this.getUsers();
        },
        goToAddMember(){
            this.$router.push({ path: '/members/add'});
        }
    },
    watch: {
        '$route' (to, from) {
            this.getUsers();
            this.$router.push({query: this.$route.query});
        }
    },
    components: {
        'pagination': PaginationComponent,
        'item-limit': ItemLimitComponent,
        'sort-button': SortComponent,
    }
}
</script>
