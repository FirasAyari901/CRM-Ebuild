import Vue from 'vue';
import Router from 'vue-router';
import Body from '../components/body';


import Stuff from '../pages/tables/bootstrap/stuff';
import Clients from '../pages/tables/bootstrap/clients';
import FormWizrd from '../pages/forms/form_wizard';



/* Authentication */
import LoginValidate from '../pages/authentication/login_with_validation';
import ResetPassword from '../pages/authentication/reset_password';
import projectlist from '../pages/project/project-list';
import Bookmark from '../pages/bookmark';
import Creative from '../pages/cards/creative';
import OrderHistory from '../pages/ecommerce/order_history';
import Tickets from '../pages/tickets';
import Documents from '../pages/document';


 

// component

Vue.use(Router);

const routes = [
{ path: '', redirect: { name: 'LoginValidate' } },
{
  path: '/app',
  component: Body, 
  children: [

  {
    path: 'stuff',
    name: 'FilterTable',
    component: Stuff,
     
  },
  {
    path: 'customers',
    name: 'FilterTable',
    component: Clients,
     
  },
  {
    path: 'projects',
    name: 'FilterTable',
    component: projectlist,
  
  },
  {
    path: 'teams',
    name: 'FilterTable',
    component: Bookmark,
  
  },
  {
    path: 'operations',
    name: 'FilterTable',
    component: OrderHistory,
  
  },
  {
    path: 'substasks',
    name: 'FilterTable',
    component: Creative,
  
  },
  {
    path: 'tickets',
    name: 'FilterTable',
    component: Tickets,
  
  },
  {
    path: 'documents',
    name: 'FilterTable',
    component: Documents,
  
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
