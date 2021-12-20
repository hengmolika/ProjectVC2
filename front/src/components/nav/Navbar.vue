<template>
    <nav>
        <v-navigation-drawer v-model="sidebar" app absolute left temporary>
            <v-list nav dense>
                <v-list-item-group active-class="deep-purple--text text--accent-4">

                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img :src="url + userdata.profile"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                                {{userdata.username}}
                            </v-list-item-title>
                            <v-list-item-subtitle>{{userdata.roles}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                    <v-divider></v-divider>

                    <v-list-item :to="{ path: '/user' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>USER</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/student' }">
                        <v-list-item-icon>
                            <v-icon>mdi-school</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>STUDENT</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/permision' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-star</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>PERMISION</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/disciple' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>DISCIPLE</v-list-item-title>
                    </v-list-item>
                    
                    <v-list-item>
                        <v-btn
                            active-class="grey-5 white--text" 
                            text
                            @click="$emit('requestToLogout')"
                        >
                            <v-icon left >mdi-logout</v-icon>
                            LOGOUT
                        </v-btn>
                    </v-list-item>

                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar dark>
            <span class="hidden-md-and-up">
                <v-app-bar-nav-icon @click="showSideBar">

                </v-app-bar-nav-icon>
            </span>
            <v-toolbar-title>
                <router-link to="/user" tag="span" style="cursor: pointer" class="hidden-sm-and-down">
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img :src="url + userdata.profile"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                                {{userdata.username}}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>

                <h5 class="hidden-md-and-up">STUDENT LIFE</h5>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                    
                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    :to="{ path: '/user' }"
                >
                    <v-icon left >mdi-account-multiple</v-icon>
                    USER
                </v-btn>
                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    :to="{ path: '/student' }"
                >
                    <v-icon left >mdi-school</v-icon>
                    STUDENT
                </v-btn>
                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    :to="{ path: '/permision' }"
                >
                    <v-icon left >mdi-account-star</v-icon>
                    PERMISION
                </v-btn>
                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    :to="{ path: '/disciple' }"
                >
                    <v-icon left >mdi-account-multiple-outline</v-icon>
                    DISCIPLE
                </v-btn>
                <v-btn
                    active-class="grey-5 white--text" 
                    text
                    @click="$emit('requestToLogout')"
                >
                    <v-icon left >mdi-logout</v-icon>
                    LOGOUT
                </v-btn>
            </v-toolbar-items> 
        </v-toolbar>
    </nav>
</template>

<script>

export default {
    props: ["userdata"],
    emits: ["requestToLogout"],
    data() {
        return {
            sidebar: false,

            url: "http://localhost:8000/storage/images/"
        }
    },
    methods: {
        showSideBar() {
            this.sidebar = !this.sidebar;
        },

    },
    
}
</script>

<style lang="scss" scoped>

</style>