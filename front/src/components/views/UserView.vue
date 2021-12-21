<template>
    <section >
        <base-dialog
        :modal="dialogDisplay"
        > 
            <template v-slot:buttonAction>
                <v-btn
                    bottom
                    color="primary"
                    dark
                    fab
                    fixed
                    right
                    @click="showCreateForm"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>

            <template v-slot:dialogTitle> 
                <h5>{{dialogTitle}}</h5>
            </template>

            <template v-slot:dialogBody > 

                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    
                    <v-row class="mt-3">
                        <v-col cols="12" lg="6" md="6" sm="6" xs="12" class="m-0">
                            <v-text-field
                                v-model="firstName"
                                :rules="firstNameRules"
                                label="First name"
                                dense
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="6" md="6" sm="6" xs="12" class="m-0">
                            <v-text-field
                                v-model="lastName"
                                :rules="lastNameRules"
                                label="Last name"
  
                                dense
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-0">
                            <v-text-field
                                label="Phone Number"
  
                                v-model="phoneNumber"
                                :rules="phoneNumberRules"
                                dense
                                required
                            ></v-text-field>

                        </v-col>
                    </v-row> 
                </v-form>
            </template>

            <template v-slot:btnClose>
                <v-btn @click="closeDialog" dark color="grey"> Close </v-btn>
            </template>

            <template v-slot:btnSubmit>
                <v-btn @click="onConfirm" dark color="primary"> Create </v-btn>
            </template>
            

        </base-dialog>

    </section>
      
</template>

<script>
import BaseDialog from "../ui/BaseDialog.vue";
export default {
    
    components: {
        'base-dialog': BaseDialog,
    },
    data() {
        return {
            dialogDisplay: false,
            dialogMode: "create",
            valid: true,
            firstName: '',
            firstNameRules: [
                v => !!v || 'First name is required',
            ],
            lastName: '',
            lastNameRules: [
                v => !!v || 'First name is required',
            ],
            phoneNumber: '',
            phoneNumberRules: [
                v => !!v || 'First name is required',
            ],
        }
    },
    computed: {
        dialogTitle() {
            let message = "";
            if(this.dialogMode === 'create') {
                message = "CREATE NEW USER";
            }  else if (this.dialogMode === 'edit') {
                message = "EDIT USER"
            } else if (this.dialogMode === 'delete') {
                message = "DELETE USER"
            }
            return message;
        }
    },
    methods: {
        showCreateForm() {
            this.dialogDisplay = true
        },
        showEditForm() {

        },
        closeDialog() {
            this.dialogDisplay = false
            this.$refs.form.reset()
        },
        createStudent() {
            this.dialogMode = 'create'
            console.log(this.firstName, this.lastName, this.phoneNumber)
        },
        onConfirm() {
            if(this.dialogMode === 'create') {
                this.createStudent();
            }
            this.dialogDisplay = false
        }
    },
          

}
</script>

<style>

</style>