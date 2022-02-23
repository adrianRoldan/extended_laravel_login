<template>

    <div>

        <vue-good-table
            :columns="columns"
            :rows="emails"
            :search-options="{
                enabled: true,
                placeholder: 'Buscar email',}"
            styleClass="vgt-table striped">

            <template slot="table-row" slot-scope="props">

                <template v-if="props.column.field === 'options'">

                    <div class="btn-group btn-group-sm">
                        <button type="button" @click="openEmailDialog(props.row.id)" class="btn btn-primary mr-2" title="Editar email">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                        <button v-if="emails.length > 1" type="button" @click="deleteEmail(props.row.id)" class="btn btn-danger ml-2" title="Eliminar email">
                            <span class="mdi mdi-delete-forever"></span>
                        </button>
                    </div>
                </template>

                <span v-else>
                    {{props.formattedRow[props.column.field]}}  <!-- Muestra el resto de columnas sin formatear -->
                </span>

            </template>

        </vue-good-table>

        <button type="button" @click="openEmailDialog()" class="btn btn-sm btn-primary mt-2" title="Añadir email">
            <span class="mdi mdi mdi-plus"></span>
        </button>

        <md-dialog-prompt
            :md-active.sync="dialog.active"
            v-model="dialog.value"
            @md-confirm="saveEmail()"
            :md-title="dialog.title"
            md-input-maxlength="100"
            md-input-placeholder="Introduce el email..."
            md-confirm-text="Guardar"
            md-cancel-text="Cancelar"/>
    </div>

</template>

<script>

import {EMAILS_BASE_ROUTE} from  '../constants/api-routes'

export default {

    props : {
        userId: String  //Obtenemos por paramtro el identificador del usuario para obtener los emails
    },

    data(){
        return {
            columns: [
                { label: 'Emails', field: 'email' },
                { label: 'Opciones', field: 'options', sortable: false },
            ],
            emails: [],

            dialog : {
                active: false,
                value: null,
                editing: false,
                email_id: null,
                title: ""
            }
        };
    },

    mounted() {
        this.getEmails(this.userId);
    },


    methods: {

        getEmails(userId){

            axios.get(`${EMAILS_BASE_ROUTE}/${userId}`) //Petición Endpoint GET web/api/users/emails/{user_uuid}
                .then(response => {
                    const {message, data} = response.data
                    this.$toast.success(message);   //Notificación
                    this.emails = data;
                })
                .catch(error => {
                    this.$toast.error(error.response.data.message);
                })
        },

        deleteEmail(email_id){

            axios.delete(`${EMAILS_BASE_ROUTE}/${email_id}`) //Petición Endpoint DELETE web/api/users/emails/{email_id}
                .then(response => {
                    console.log(response)
                    const {message} = response.data
                    this.$toast.success(message);
                    this.emails = this.emails.filter(email => email.id !== email_id);
                })
                .catch(error => {
                    this.$toast.error(error.response.data.message);
                })
        },


        saveEmail(){

            const email = this.dialog.value
            this.dialog.editing ?
                this.updateEmail(this.dialog.email_id, email) :
                this.saveNewEmail(email)
        },


        saveNewEmail(email)
        {
            axios.post(`${EMAILS_BASE_ROUTE}/save`, {     //Petición Endpoint POST web/api/users/emails/save
                user_id : this.userId,
                emails : [{email}]

            }).then(response => {
                this.$toast.success(response.data.message);
                this.emails.push({email})   //Añadimos email al array

            }).catch(error => {
                    this.$toast.error(error.response.data.message);
                })
        },


        updateEmail(email_id, email)
        {
            axios.put(`${EMAILS_BASE_ROUTE}/update`, {     //Petición Endpoint PUT web/api/users/emails/update/{user_uuid}
                email_id : email_id,
                email

            }).then(response => {
                this.$toast.success(response.data.message);

                let idx = this.emails.findIndex(email => email.id === email_id) //Buscamos posicion del email actualizado
                this.emails[idx].email = email  //Actualizamos email

            }).catch(error => {
                this.$toast.error(error.response.data.message);
            })

        },


        openEmailDialog(email_id = null) {

            this.initDialogData()

            if(email_id) {  //Estamos editando un email
                const email = this.emails.find(email => email.id === email_id)
                this.dialog.value = email.email
                this.dialog.editing = true
                this.dialog.title = "Editando Email"
                this.dialog.email_id = email_id
            }
        },


        initDialogData()
        {
            //Lanzamos dialog
            this.dialog.active = true

            //Reinicializamos el dialog cada vez que lo lanzamos
            this.dialog.editing = false
            this.dialog.value = null
            this.dialog.email_id = null
            this.dialog.title = "¿Cúal es el email?"
        }
    }
};
</script>
