
import { createWebHistory, createRouter } from "vue-router";
import Home from "../components/Home.vue";
import Register from "../components/Auth/Register.vue";
import Login from "../components/Auth/Login.vue";
import Dashboard from "../components/Dashboard.vue";
import NewItem from "../components/NewItem.vue";
import EditItem from "../components/EditItem.vue";
import ShowItem from "../components/ShowItem.vue";

 const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home'
    },
    {
        path: '/register',
        component: Register,
        name: 'Register'
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '/show-item/:name',
        component: ShowItem,
        name: 'ShowItem'
    },
    {
        path:'/dashboard',
        component: Dashboard,
        name: 'Dashboard',
        beforeEnter: (to, from, next) => {
            axios.get('/api/authentificated').then(()=>{
                next()
            }).catch(()=>{
                return next({name: 'Login'})
            })
        }
    },
    {
        path:'/new-item',
        component: NewItem,
        name: 'NewItem',
        beforeEnter: (to, from, next) => {
            axios.get('/api/authentificated').then(()=>{
                next()
            }).catch(()=>{
                return next({name: 'Login'})
            })
        }
       
    },
    {
        path:'/edit-item/:id',
        component: EditItem,
        name: 'EditItem',
        beforeEnter: (to, from, next) => {
            axios.get('/api/authentificated').then(()=>{
                next()
            }).catch(()=>{
                return next({name: 'Login'})
            })
        }
       
    },
    
]


const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
export default router;