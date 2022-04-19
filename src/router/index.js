import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/Login',
    name: 'Login',
    component: LoginView,
  },
  {
    path: '/Trucks',
    name: 'trucks',

  },
  {
    path: '/Maintenance',
    name: 'maintenance',

  },

]

const router = new VueRouter({
  routes
})

export default router
