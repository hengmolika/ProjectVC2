import Vue from 'vue'
import VueRouter from 'vue-router'
import UserView from '../components/views/userView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/users',
    component: UserView,
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
