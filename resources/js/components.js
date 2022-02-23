import Vue from 'vue';

//Registro global de componentes
Vue.component('users-list-component', require('./components/UsersListComponent.vue').default);
Vue.component('user-emails-list', require('./components/UserEmailsListComponent.vue').default);
