
require('./bootstrap');

window.Vue = require('vue');


import HeaderComponent from './components/admin/header.vue';
import SidebarComponent from './components/admin/sidebar.vue';
import PlaceholderComponent from './components/utilities/placeholder.vue';


import MemberComponent from './components/member.vue';
import MembersComponent from './components/members.vue';
import MemberAddComponent from './components/member-add.vue';
import AdjustPointComponent from './components/adjustpoint.vue';
import RewardComponent from './components/reward.vue';
import RewardsComponent from './components/rewards.vue';
import RewardAddComponent from './components/reward-add.vue';


// Global component
Vue.component('spinner', require('./components/utilities/spinner.vue'));

// Vue Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
  { path: '/', redirect: 'dashboard' },
  { path: '/dashboard', component: PlaceholderComponent },
  { path: '/members', component: MembersComponent },
  { path: '/members/add', component: MemberAddComponent },
  { path: '/members/:id', component: MemberComponent, props: true },
  { path: '/members/:id/adjustpt', component: AdjustPointComponent, props: true },
  { path: '/transactions', component: PlaceholderComponent },
  { path: '/rewards', component: RewardsComponent },
  { path: '/rewards/add', component: RewardAddComponent },
  { path: '/rewards/:id', component: RewardComponent, props: true },
  { path: '/reports', component: PlaceholderComponent }
]

const router = new VueRouter({
  routes // short for `routes: routes`
})


// Global Constants



// Global states
var store = {
  state: {
    limit: []
  },
  setLimit(limitName, newValue) {
    this.state.limit[limitName] = newValue;
    console.log('New ' + limitName + ' limit set: ' + this.state.limit[limitName]);
  }
}


// Bootstrap everything into app
const app = new Vue({
  data: store,
  router,
  components: {
    "header-component": HeaderComponent,
    "sidebar": SidebarComponent,
  }
}).$mount('#app')
