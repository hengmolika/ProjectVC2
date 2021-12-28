import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginForm from '../authentication/LoginForm.vue'
import UserView from '../components/views/UserView.vue'
import StudentView from '../components/views/StudentView.vue'
import DiscipleView from '../components/views/DiscipleView.vue'
import PermisionView from '../components/views/PermisionView.vue'
import PageNotFound from '../components/views/notFound.vue'

Vue.use(VueRouter)

const routes = [{
    path: '/',
    component: UserView,
    meta: {
      needLogin: true,
      needAdmin: true
    }
  },
  {
    path: '/login',
    component: LoginForm
  },
  {
    path: '/user',
    component: UserView,
    meta: {
      needLogin: true,
      needAdmin: true
    }
  },
  {
    path: '/student',
    component: StudentView,
    meta: {
      needLogin: true,
      needAdmin: true,
      needSpecialUser: true
    }
  },
  {
    path: '/disciple',
    component: DiscipleView,
    meta: {
      needLogin: true,
      needAdmin: true
    }
  },
  {
    path: '/permision',
    component: PermisionView,
    meta: {
      needLogin: true,
      needAdmin: true
    }
  },
  {
    path: '/*',
    component: PageNotFound,
  },
]

let authenticationGuard = (to, from, next) => {
  let needLogin = to.meta.needLogin;
  if (needLogin) {
    if (!localStorage.userId) {
      next("/login")
    } else {
      if (to.path === "/login") {
        next("/");
      } else {
        next();
      }
    }
  } else {
    if (localStorage.userId) {
      if (to.path === "/login") {
        next("/");
      }
    }
  }
  next()
}


const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(authenticationGuard);

export default router