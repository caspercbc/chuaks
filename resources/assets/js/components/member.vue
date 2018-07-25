<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Member Details</h1>                
                
            <div class="btn-toolbar" role="toolbar">

              <div v-if="editUserEnabled" class="btn-group mr-2" role="group">
                  <button type="button" class="btn btn-outline-secondary" v-on:click="updateUserDetails">Commit Changes</button>
              </div>
              <div class="btn-group mr-2" role="group">
                <button class="btn btn-outline-secondary" type="button" v-on:click="toggleEdit">Edit User</button>
              </div>

            </div>
        </div>

        <div v-if="loading">
            <spinner></spinner>
        </div>
        <div v-else>
            <form>
                <div class="form-row">
                    <label for="staticId" class="col-sm-2 col-form-label">Database ID</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="staticId" v-bind:value="user.id">
                    </div>
                </div>
                <div class="form-row">
                    <label for="staticCreated" class="col-sm-2 col-form-label">Date Created</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="staticCreated" v-bind:value="user.created_at">
                    </div>
                </div>
                <div class="form-row">
                    <label for="staticUpdated" class="col-sm-2 col-form-label">Last Updated</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" id="staticUpdated" v-bind:value="user.updated_at">
                    </div>
                </div>
                <br>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="" v-model:value="user.name" :disabled="!editUserEnabled">
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="" v-model:value="user.email" :disabled="!editUserEnabled">
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Leave blank if password does not change" v-model:value="user.password" :disabled="!editUserEnabled">
              </div>
              
            </form>

        </div>

        <hr>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Point Transactions</h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
                <button class="btn btn-outline-secondary" type="button">+ Add Transaction</button>
                <sort-button v-bind:sortColumns="sortColumns" style="margin-right: 12px"></sort-button>
                <item-limit limitName="member"></item-limit>
            </div> -->

            <div class="btn-toolbar" role="toolbar">
              <div class="btn-group mr-2" role="group">
                <sort-button v-bind:sortColumns="sortColumns"></sort-button>
              </div>
              <div class="btn-group mr-2" role="group">
                <item-limit limitName="member"></item-limit>
              </div>
              <div class="btn-group" role="group">
                <div>
                    <button type="button" class="btn btn-outline-secondary" v-on:click="goToAdjustPoint">+ Adjust Point</button>
                </div>
              </div>
            </div>
        </div>

        <div v-if="loadingPtTrans">
            <spinner></spinner>
        </div>
        <div v-else>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Reward</th>
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pt in ptTrans">
                        <td>{{ pt.pt_desc }}</td>
                        <td>{{ pt.created_at }}</td>
                        <td>{{ pt.name }}</td>
                        <td class="text-right">{{ pt.point }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold">Current Points</td>
                        <td></td>
                        <td class="text-right font-weight-bold">{{user.total_points}}</td>
                    </tr>
                </tbody>
            </table>

            <pagination v-bind:pageData="pageData" v-on:pageNumberClicked="goToPage"></pagination>
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-default" v-on:click="goBack">Back</button>
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
    props: ['id'],
    data: function() {
        return {
            user: [],
            pageData: [],
            ptTrans: [],
            loading: true,
            loadingPtTrans: true,

            currentPath: this.$route.path,

            sortColumns: [
                { name :'created_at', text: 'Date Created' },
                { name :'point', text: 'Point' },
            ],

            editUserEnabled: false
        }
    },
    mounted() {
        this.getUserDetails();
        this.getPtTransDetails();
    },
    watch: {
        '$route' (to, from) {
            if( this.currentPath != this.$route.path ){
                this.getUserDetails();
                this.currentPath = this.$route.path;
            }
            this.getPtTransDetails();

            this.$router.push({query: this.$route.query});
        }
    },
    methods: {
        getUserDetails: function() {
            var url = Constants.API_URL + 'users/' + this.id + '?field=id,name,email,created_at,updated_at,total_points';

            this.loading = true;
            axios.get(url).then(response => {

                this.user = response.data;
                this.loading = false;

            }).catch(e => {
                this.errors.push(e);
                this.loading = false;
            });
        },
        getPtTransDetails: function() {
            var url = Constants.API_URL + 'users/' + this.id + '/pttrans' + '?' + Helper.convertObjToUrlParams(this.$route.query);

            this.loadingPtTrans = true;
            axios.get(url).then(response => {

                this.pageData = response.data;
                this.ptTrans = response.data.data;
                this.loadingPtTrans = false;

            }).catch(e => {
                this.errors.push(e);
                this.loadingPtTrans = false;
            });
        },
        goBack () {
            this.$router.push('./')
        },
        goToPage(pageNumber){
            this.$router.push({query: {...this.$route.query, page: pageNumber}});
        },
        toggleEdit(){
            this.editUserEnabled = true;
        },
        updateUserDetails(){
            var url = Constants.API_URL + 'users/' + this.id;

            this.loading = true;
            axios.put(url, {

                name: this.user.name,
                email: this.user.email,
                password: this.user.password

            }).then(response => {

                console.log(response.data.message);
                this.loading = false;

            }).catch(e => {

                this.errors.push(e);
                this.loading = false;

            });
        },
        goToAdjustPoint(){
            this.$router.push({ path: '/members/'+ this.id + '/adjustpt'});
        }
    },
    components: {
        'pagination': PaginationComponent,
        'item-limit': ItemLimitComponent,
        'sort-button': SortComponent,
    }
}
</script>
