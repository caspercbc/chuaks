<template>
  <nav class="col-sm-2 d-none d-sm-block bg-light sidebar">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li v-for="(tab, index) in tabs" class="nav-item">
          <router-link class="nav-link" v-bind:to="tabUrl(index)">{{ tab }}</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
    export default {
      data: function() {
        return {
          tabs: [
            'dashboard', 'members', 'rewards', 'transactions', 'reports'
          ]
        }
      },
      methods: {
        // a computed getter
        tabUrl: function (index) {
          // `this` points to the vm instance
          return '/' + this.tabs[index];
        }
      }
    }
</script>

<style>
  .sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100; /* Behind the navbar */
    padding: 48px 0 0; /* Height of navbar */
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
  }

  .sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: .5rem;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
  }

  @supports ((position: -webkit-sticky) or (position: sticky)) {
    .sidebar-sticky {
      position: -webkit-sticky;
      position: sticky;
    }
  }

  .sidebar .nav-link {
    font-weight: 500;
    color: #333;
    text-transform: capitalize;
  }

  .sidebar .nav-link .feather {
    margin-right: 4px;
    color: #999;
  }

  .sidebar .nav-link.active {
    color: #007bff;
  }

  .sidebar .nav-link:hover .feather,
  .sidebar .nav-link.active .feather {
    color: inherit;
  }

  .sidebar-heading {
    font-size: .75rem;
    text-transform: uppercase;
  }

  .router-link-active {
    color: rgba(0,0,225,1) !important;
  }

</style>