<template>

    <vue-good-table
        :columns="columns"
        :rows="users"
        :search-options="{
            enabled: true,
            placeholder: 'Buscar usuario'}"
        styleClass="vgt-table striped">

        <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field === 'avatar'">
                <img class="rounded-circle img-thumbnail" width="45" :src="props.row.avatar" referrerPolicy="no-referrer" alt="">
            </span>
            <span v-else-if="props.column.field === 'emails'">
                <span v-for="email in props.row.emails" class="badge rounded-pill bg-secondary mt-1">{{ email.email }}</span>
            </span>
            <template v-else-if="props.column.field === 'options'">

                <div class="btn-group btn-group-sm">
                    <a :href="userProfileLink(props.row.uuid)" class="btn btn-primary mr-2" title="Editar perfil de usuario">
                        <span class="mdi mdi-pencil"></span>
                    </a>
                    <button type="button" @click="deleteUser(props.row.uuid)" class="btn btn-danger ml-2" title="Eliminar usuario">
                        <span class="mdi mdi-delete-forever"></span>
                    </button>
                </div>
            </template>

            <span v-else>
                {{props.formattedRow[props.column.field]}}
            </span>

        </template>

    </vue-good-table>

</template>

<script>

import {USERS_BASE_ROUTE} from  '../constants/api-routes'
import {USERS_WEB_ROUTE} from  '../constants/web-routes'

export default {

    data(){
        return {
            columns: [
                { label: 'Usuario', field: 'avatar' },
                { label: 'Nombre', field: 'name', type: 'string' },
                { label: 'Emails', field: 'emails', width: '500px' },
                { label: 'Opciones', field: 'options', sortable: false, globalSearchDisabled: true },
            ],
            users: [],
        };
    },

    mounted() {
        this.getUsers();
    },


    methods: {

        /**
         * Obtiene usuario al cargar el componente
         */
        getUsers(){

            axios.get(USERS_BASE_ROUTE) //Petición Endpoint GET web/api/users
                .then(response => {
                    const {message, data} = response.data
                    this.$toast.success(message);
                    this.users = data;

                }).catch(error => {
                    this.$toast.error(error.response.data.message);
                })
        },

        /**
         * Borrar usuario
         * @param user_id
         */
        deleteUser(user_id){

            axios.delete(`${USERS_BASE_ROUTE}/${user_id}`) //Petición Endpoint DELETE web/api/users/{id}
                .then(response => {
                    const {message} = response.data
                    this.$toast.success(message);
                    this.users = this.users.filter(user => user.uuid !== user_id); //Filtramos emails para descartar el eliminado

                }).catch(error => {
                    this.$toast.error(error.response.data.message);
                })
        },

        /**
         * Forma la ruta de la ficha de usuario
         * @param user_id
         * @returns {string}
         */
        userProfileLink(user_id){
            return `${USERS_WEB_ROUTE}/${user_id}`;
        },

    }
};
</script>
