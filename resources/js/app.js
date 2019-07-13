require('./bootstrap');

import swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar';
import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';
import VueRouter from 'vue-router';
import StarRating from 'vue-star-rating';

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

//let Fire = new Vue(); //custom event
window.Vue = require('vue');
window.Form = Form;
window.swal = swal;
window.toast = toast;
// window.Fire = new Vue(); // custom event

Vue.use(VueRouter)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('star-rating', StarRating);

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
})


let routes = [
    { 
      path: '/dashboard', name: 'dashboard', component: require('./components/Dashboard.vue').default  
    },

    { 
      path: '/profile', name: 'profile', component: require('./components/Profile.vue').default  
    },

    { 
      path: '/users', name: 'users', component: require('./components/Users.vue').default  
    },
    
    { 
      path: '/developer', name: 'developer', component: require('./components/Developer.vue').default  
    },

    { 
      path: '/product', name: 'product', component: require('./components/Product.vue').default  
    },

    { 
      path: '/category', name: 'category', component: require('./components/Category.vue').default  
    },

    { 
      path: '/hero', name: 'hero', component: require('./components/HeroHeader.vue').default  
    }
  ]
  
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

Vue.filter('upText', function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate', function(date){
  return moment(date).format("MMM Do YY");
});


// passport script
Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('review-form', require('./components/ReviewForm.vue').default);


const app = new Vue({
    el: '#app',
    router
});
