<template>
    <nav>
        <v-navigation-drawer v-model="sidebar" app absolute left temporary>
            <v-list nav dense>
                <v-list-item-group active-class="deep-purple--text text--accent-4">

                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                                John Leider
                            </v-list-item-title>
                            <v-list-item-subtitle>Role</v-list-item-subtitle>
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

                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar dark >
            <span class="hidden-sm-and-up">
                <v-app-bar-nav-icon @click="showSideBar">

                </v-app-bar-nav-icon>
            </span>
            <v-toolbar-title>
                <router-link to="/" tag="span" style="cursor: pointer" v-if="showUser">
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                                John Leider
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-xs-only">
                    
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
                    :to="{ path: '/login' }"
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
    data() {
        return {
            sidebar: false,
            size: 0,
            showUser: true
        }
    },
    // watch:  {
    //     width() {
    //         return window.innerWidth
    //     }
    // },
    // computed: {
    //     showUserProfile() {
    //         return window.innerWidth
    //     }
    // },
    methods: {
        showSideBar() {
            this.sidebar = !this.sidebar;
        },

    },
    mounted() {
        
        if(window.innerWidth <= 600) {
            this.showUser = false;
        }
        
    },
    
}
</script>

<style lang="scss" scoped>

</style>