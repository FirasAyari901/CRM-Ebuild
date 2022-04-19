import Vue from 'vue';
import Router from 'vue-router';
import Body from '../components/body';


import Stuff from '../pages/tables/bootstrap/stuff';
import Clients from '../pages/tables/bootstrap/clients';
import FormWizrd from '../pages/forms/form_wizard';



/* Authentication */
import LoginValidate from '../pages/authentication/login_with_validation';
import ResetPassword from '../pages/authentication/reset_password';


// component

Vue.use(Router);

const routes = [
{ path: '', redirect: { name: 'LoginValidate' } },
{
  path: '/table',
  component: Body, 
  children: [

  {
    path: 'stuff',
    name: 'FilterTable',
    component: Stuff,
     
  },
  {
    path: 'clients',
    name: 'FilterTable',
    component: Clients,
     
  },
  ]
},
{
  path: '/form',
  component: Body, 
  children: [

  {
    path: 'form',
    name: 'FilterTable',
    component: FormWizrd,
     
  },
 
  ]
},

  
  

{
  path:'/login',
  name:'LoginValidate',
  component:LoginValidate,
  meta: {
      title: 'LoginValidate | Cuba - Premium Admin Template',
    }
},




{
  path:'/authentication/resetpassword',
  name:'ResetPassword',
  component:ResetPassword,
  meta: {
      title: 'ResetPassword | Cuba - Premium Admin Template',
    }
},

];

const router = new Router({
  routes,
  base: process.env.BASE_URL,
  mode: 'history',
  linkActiveClass: 'active',
  scrollBehavior () {
    return { x: 0, y: 0 };
  }
});



export default router;
