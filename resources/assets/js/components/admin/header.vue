<template>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-sm-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-2 mr-0" href="#">CKS</a>
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" v-on:click="logout">Sign out</a>
        </li>
      </ul>
    </nav>

</template>

<script>

  export default {
    methods: {
      logout: function() {
        axios.post('logout').then( response => {
          // if (response.status === 302 || 401) {
              console.log('logout')
              document.location.href = "/";
          // }
        }).catch(e => {
            // this.errors.push(e);
            console.log(e);
        })
        // $this->guard()->logout();

        // $request->session()->flush();

        // $request->session()->regenerate();

        // return redirect('/');
      }
    }
  }
</script>


<style>
.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

</style>