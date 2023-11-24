
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Withdoctor from './components/appointment/Withdoctor.vue';

const app = new Vue({
    el: '#app',
    components: {Withdoctor},
});
