import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginForm from '../authentication/LoginForm.vue'
import UserView from '../components/views/UserView.vue'
import StudentView from '../components/views/StudentView.vue'
import DiscipleView from '../components/views/DiscipleView.vue'
import PermissionView from '../components/views/PermissionView.vue'

Vue.use(VueRouter)

const routes = [
  {path: '/', component: UserView},
  {path: '/login', component: LoginForm},
  {path: '/user', component: UserView},
  {path: '/student', component: StudentView},
  {path: '/disciples', component: DiscipleView},
  {path: '/permission', component: PermissionView}
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})



export default router
