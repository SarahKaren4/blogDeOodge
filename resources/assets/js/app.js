
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// mix.js('node_modules/moment/src/moment.js', 'public/js');
// mix.js('node_modules/moment/locale/ru.js', 'public/js');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    methods: {
        greet: function (event) {
            if(event.target.checked) {
                $('#new_password').show()
                $('#new_password input').prop('disabled', false)
            } else {
                $('#new_password').hide()
                $('#new_password input').prop('disabled', true)
            }
        }
    },
});
