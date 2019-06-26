/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    data: {
    	search: '',
    	isThereAdmins: 0,
        timer: null,
    },
    methods: {
    	searchit(){
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                    axios.get('api/findAdmin?q=' + this.search)
                    .then((data) => {
                        this.isThereAdmins = data.data;
                    })
                    .catch(() => {

                    })
            }, 300);
    	}
    },

    watch: {
    	isThereAdmins: function(n , o){
    		if(n == 1)
    		{
    			$('#modalLogin').modal('show'); 
    		}
    		
    	}
    },

    components: {
       
    },
});
