import Vue from 'vue';
import Router from 'vue-router';
import Body from '../components/body';


import Staff from '../pages/personnels/staff';
import Clients from '../pages/personnels/clients';
import FormWizrd from '../pages/forms/form_wizard';



/* Authentication */
import LoginValidate from '../pages/authentication/login_with_validation';
import ResetPassword from '../pages/authentication/reset_password';
import projectlist from '../pages/project/project-list';
import project from '../pages/project/project';
import Teams from '../pages/teams/teams';
import Task from '../pages/tasks/task';
import Subtask from '../pages/subtask/subtask';
import Operations from '../pages/operations/operations';
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
    path: 'staff',
    name: 'FilterTable',
    component: Staff,
     
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
    path: 'project',
    name: 'FilterTable',
    component: project,
  
  },
  {
    path: 'teams',
    name: 'FilterTable',
    component: Teams,
  
  },
  {
    path: 'operations',
    name: 'FilterTable',
    component: Operations,
  
  },
  {
    path: 'Task',
    name: 'FilterTable',
    component: Task,
  
  },
  {
    path: 'subtask',
    name: 'FilterTable',
    component: Subtask,
  
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
