<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Member</h1>
        </div>

        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="" v-model:value="user.name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="" v-model:value="user.email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" placeholder="" v-model:value="user.password">
            </div>
            <div class="form-group">
                <label for="point">Starting Point</label>
                <input type="number" class="form-control" id="point" placeholder="" v-model:value="user.point">
            </div>
            <div class="form-group">
                <label for="description">Point Description</label>
                <textarea type="text" class="form-control" id="description" placeholder="(optional)" v-model:value="user.description"></textarea>
            </div>

            <button type="button" class="btn btn-secondary" v-on:click="addUser">Add Member</button>
            <button type="button" class="btn btn-warning" v-on:click="goBack">Cancel</button>
        </form>

    </div>
</template>

<script>
import Constants from '../constants.js';

export default {
    data: function() {
        return {
            user: [],
        }
    }, 
    methods: {
        addUser: function() {
            var url = Constants.API_URL + 'users';

            this.loading = true;
            axios.post(url, {

                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                point: this.user.point,
                description: this.user.description

            }).then(response => {

                console.log(response);
                this.loading = false;
                this.goBack();

            }).catch(e => {

                console.log(e.response);

                this.loading = false;
            });
        },
        goBack () {
            this.$router.push('./')
        },
    }
}

</script>

