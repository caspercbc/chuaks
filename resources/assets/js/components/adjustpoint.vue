<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Adjust Member Point</h1>                
                
            <!-- <div class="btn-toolbar" role="toolbar">
              <div v-if="editUserEnabled" class="btn-group mr-2" role="group">
                  <button type="button" class="btn btn-outline-secondary" v-on:click="updateUserDetails">Commit Changes</button>
              </div>

              <div class="btn-group mr-2" role="group">
                <button class="btn btn-outline-secondary" type="button" v-on:click="toggleEdit">Edit User</button>
              </div>
              
            </div> -->
        </div>

        <form>
           <!--  <div class="form-row">
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
          </div> -->
          <div class="form-group">
            <label for="rewardId">Reward ID</label>
            <input type="number" class="form-control" id="rewardId" placeholder="123" v-model:value="rewardId" >
          </div>
          <div class="form-group">
            <label for="point">Point</label>
            <input type="number" class="form-control" id="point" placeholder="-12345" v-model:value="point" >
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" placeholder="Reason for point adjusting" v-model:value="description" rows="5"></textarea>
          </div>
          
          <button class="btn btn-secondary" type="button" v-on:click="adjustPoint">Commit</button>
          <button class="btn btn-warning" type="button">Cancel</button>
        </form>

    </div>
</template>

<script>
import Constants from '../constants.js';

export default {
    props: ['id'],
    data: function() {
        return {
            point: null,
            description: null,
            rewardId: ''
        }
    },
    mounted() {
    },
    methods: {
        adjustPoint: function() {
            var url = Constants.API_URL + 'users/' + this.id + '/point';

            console.log('Starts of something:');
            console.log(this.rewardId);
            console.log(this.description);
            console.log(this.point);

            // return;

            axios.post(url, {

                reward_id: this.rewardId,
                description: this.description,
                point: this.point

            }).then(response => {

                console.log(response.data.message);
                this.goBack();

            }).catch(e => {
                this.errors.push(e);
            });
        },
        goBack () {
            this.$router.push('./')
        },
        // adjustPoint(){
        //     this.$router.push({ path: '/members/'+ this.id + '/point'});
        // }
    },
}
</script>
