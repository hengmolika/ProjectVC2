import Vue from 'vue'
import VueRouter from 'vue-router'
// import UserView from '../components/views/userView.vue'

import LoginForm from '../authentication/LoginForm.vue'
import UserView from '../components/views/UserView.vue'
import StudentView from '../components/views/StudentView.vue'
import DiscipleView from '../components/views/DiscipleView.vue'
import PermisionView from '../components/views/PermisionView.vue'

Vue.use(VueRouter)

const routes = [
  // {path: '/users', component: UserView},
  {path: '/', component: LoginForm},
  {path: '/login', component: LoginForm},
  {path: '/user', component: UserView},
  {path: '/student', component: StudentView},
  {path: '/disciple', component: DiscipleView},
  {path: '/permision', component: PermisionView}
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

// router.beforeEach((to, from) => {
//   console.log(to);
//   console.log(from);
// });

export default router
