<template>
<!--*~*~*~*~*~*~*~*~*~*~*~*~[CARD]~*~*~*~*~*~*~*~*~*~*~*~*-->
    <v-flex xs12 sm6 md4 lg3>
        <v-card class="grey darken-3 text-center ma-3">
            <v-responsive class="pt-4">
                <v-avatar size="100" elevation="12" color="orange">
                    <img :src=" url + user.profile" alt="" />
                </v-avatar>
            </v-responsive>
            <!--~!~!~!~!~!~!~!~!~!~|USER NAME & JOP|~!~!~!~!~!~!~!~!~!~-->
            <v-card-text>
                <div class="subheading white--text">Name: {{ user.username }}</div>
                <div class="subheading white--text">Role: {{ user.roles }}</div>
                <div class="white--text">Email: {{ user.email }}</div>
            </v-card-text>

            <!--~!~!~!~!~!~!~!~!~!~|BUTTON|~!~!~!~!~!~!~!~!~!~-->
            <div class="d-inline-flex">
                <v-card-actions>
                    <v-btn color="info" text-color="white">
                    <v-icon small left>mdi-pencil</v-icon>
                    <span>Edit</span>
                    </v-btn>
                </v-card-actions>
                <v-card-actions>
                    <v-btn color="warning">
                    <v-icon small left>mdi-delete</v-icon>
                    <span>remove</span>
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
    </v-flex>
</template>

<script>
export default {
    props:["user"],
    data(){
        return {
            url : 'http://localhost:8000/storage/images/users/',
        }
    }


}
</script>

<style >
    
  
</style>