<template>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Last update</th>
                    <th>Date created</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.updated_at }}</td>
                    <td>{{ user.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: function() {
        return {
            users: []
        }
    },
    created() {
        axios.get('http://localhost:8000/api/users').then(response => {
            this.users = response.data;
        }).catch(e => {
            this.errors.push(e);
        });
    },
    mounted() {
        console.log('User list component mounted.')
    }
}
</script>
