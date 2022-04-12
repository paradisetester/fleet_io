import Vue from 'vue'
import Router from 'vue-router'
import VueEasySession from 'vue-easysession'
Vue.use(Router)


const router = new Router({
    mode: 'history',  
    scrollBehavior () {
 return { x: 0, y: 0 }
},routes: [
    	{
  			path: '/',
  			component: () => import('./front/Main.vue'),
  			children: [
						{
						path: '/',
						name: 'mainhome',
						component: () => import('./front/Home.vue')
						},
						{
						path: '/front/:slug',
						name: 'front-single',
						component: () => import('./front/frontSingle.vue')
						},
						{
						path: '/auth/login',
						name: 'auth-login',
						component: () => import('@/views/pages/Login.vue')
						},
						{
						path: '/auth/register',
						name: 'auth-register',
						component: () => import('@/views/pages/register/Register.vue')
						},
						{
						path: '/site/details',
						name: 'auth-details',
						component: () => import('@/views/pages/register/SiteDetails.vue')
						},
						{
						path: '/auth/forgot/password',
						name: 'auth-forgot-password',
						component: () => import('@/views/pages/ForgotPassword.vue')
						},
						{
						path: '/password/update/:token',
						name: 'auth-forgot-passwords',
						component: () => import('@/views/pages/ForgotPasswordUpdate.vue')
						}
					]
        },
        {
          path: 'backend',
          component: () => import('./layouts/main/Main.vue'),
          children: [
            {
              path: '/home',
              name: 'home',
              component: () => import('./views/DashboardECommerce.vue')
            },
            {
              path: '/auth-profile',
              name: 'app-auth-profile',
              component: () => import('@/views/apps/profile/Index.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Profile', active: true }
                ],
                pageTitle: 'Profile'
              }
            },
            {
              path: '/auth-edit-profile',
              name: 'app-auth-edit-profile',
              component: () => import('@/views/apps/profile/Edit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Profile', url: 'auth-profile' },
                  { title: 'Edit', active: true }
                ],
                pageTitle: 'Edit'
              }
            },
            {
              path: '/plan/renew',
              name: 'renew-plan',
              component: () => import('@/views/apps/profile/RenewPlan.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Profile', url: '/auth-profile' },
                  { title: 'Renew Plan', active: true }
                ],
                pageTitle: 'Renew Plan'
              }
            },
            {
              path: '/plan/upgrade',
              name: 'upgrade-plan',
              component: () => import('@/views/apps/profile/UpgradePlan.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                   { title: 'Profile', url: '/auth-profile' },
                  { title: 'Upgrade Plan', active: true }
                ],
                pageTitle: 'Upgrade Plan'
              }
            },
            {
              path: '/users',
              component: () => import('./views/apps/users/User.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Users', active: true }
                ],
                pageTitle: 'Users'
              }
            },
			      {
              path: '/orders',
              name: 'order',
              component: () => import('./views/apps/order/Orderlist.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Orders', active: true }
                ],
                pageTitle: 'Orders List'
              }
            },
			      {
              path: '/orders/view/:orderId',
              name: 'order',
              component: () => import('./views/apps/order/OrderShow.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Orders', url: '/orders' },
                  { title: 'Order View', active: true }
                ],
                pageTitle: 'Order View'
              }
            },
			      {
              path: '/tenants',
              name: 'tenant',
              component: () => import('./views/apps/tenant/TenantsList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Tenants', active: true }
                ],
                pageTitle: 'Tenants List'
              }
            },
			      {
              path: '/tenants/view/:tenantId',
              name: 'tenant',
              component: () => import('./views/apps/tenant/TenantView.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Tenants', url: '/tenants' },
                  { title: 'Tenant View', active: true }
                ],
                pageTitle: 'Tenant View'
              }
            },
            {
              path: '/users/create',
              name: 'user-create',
              component: () => import('./views/apps/user-settings/UserSettings.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Users', active: true }
                ],
                pageTitle: 'Users'
              }
            },
            {
              path: '/users/edit/:userID',
              name: 'user-edit',
              component: () => import('./views/apps/user-settings/UserSettings.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Users Edit', active: true }
                ],
                pageTitle: 'Users Edit'
              }
            },
            {
              path: '/vehicle/',
              name: 'vehicle-list',
              component: () => import('@/views/apps/vehicle/VehicleList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'vehicle' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vehicles',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/create',
              name: 'vehicle-create',
              component: () => import('@/views/apps/vehicle/VehicleCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'vehicle', url: '/vehicle/create'  },
                  { title: 'Add vehicles', active: true }
                ],
                pageTitle: 'vehicles',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/edit/:ID',
              name: 'vehicle-edit',
              component: () => import('@/views/apps/vehicle/VehicleEdits.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'vehicle', url: '/vehicle/edit'  },
                  { title: 'Edit vehicles', active: true }
                ],
                pageTitle: 'vehicles',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/assignment/',
              name: 'vehicle-assignment',
              component: () => import('@/views/apps/vehicle/Assignment/VehicleAssignment.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'vehicle', url: '/vehicle/assignments'  },
                  { title: 'Assignment vehicles', active: true }
                ],
                pageTitle: 'vehicles',
                rule: 'editor'
              }
            },
             {
              path: '/vehicle/assignment/create',
              name: 'vehicle-assignment-create',
              component: () => import('@/views/apps/vehicle/Assignment/VehicleAssignmentCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'vehicle', url: '/vehicle/assignments/create'  },
                  { title: 'Assignment vehicles add', active: true }
                ],
                pageTitle: 'vehicles',
                rule: 'editor'
              }
            },
           
			{
              path: '/meter',
              name: 'meter-history',
              component: () => import('@/views/apps/vehicle/Meter/Meter.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'meter', url: '/meter'  },
                  { title: 'Meter History', active: true }
                ],
                pageTitle: 'Meter History',
                rule: 'editor'
              }
            },
			{
              path: '/meter/create',
              name: 'meter-create',
              component: () => import('@/views/apps/vehicle/Meter/MeterCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'metercreate', url: '/meter/create'  },
                  { title: 'Meter History', active: true }
                ],
                pageTitle: 'Meter History',
                rule: 'editor'
              }
            },
			{
              path: '/meter/edit/:ID',
              name: 'meter-edit',
              component: () => import('@/views/apps/vehicle/Meter/MeterEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'metercreate', url: '/meter/edit'  },
                  { title: 'Meter History', active: true }
                ],
                pageTitle: 'Meter History',
                rule: 'editor'
              }
            },
			{
              path: '/expense',
              name: 'expense-history',
              component: () => import('@/views/apps/vehicle/Expense/Expense.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'expense', url: '/expense'  },
                  { title: 'Expense History', active: true }
                ],
                pageTitle: 'Expense History',
                rule: 'editor'
              }
            },
            {
              path: '/expense/create',
              name: 'expense-create',
              component: () => import('@/views/apps/vehicle/Expense/ExpenseCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'expense', url: '/expense/create'  },
                  { title: 'Expense Entery', active: true }
                ],
                pageTitle: 'Expense Entery',
                rule: 'editor'
              }
            },	{
              path: '/expense/edit/:ID',
              name: 'expense-edit',
              component: () => import('@/views/apps/vehicle/Expense/ExpenseEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'expense', url: '/expense/edit'  },
                  { title: 'Expense Entery', active: true }
                ],
                pageTitle: 'Expense Entery',
                rule: 'editor'
              }
            },			
            {
              path: '/inspection/',
              name: 'inspection-list',
              component: () => import('@/views/apps/inspection/InspectionList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Inspection',
                rule: 'editor'
              }
            },
            {
              path: '/inspection/forms',
              name: 'inspection-forms',
              component: () => import('@/views/apps/inspection/inspectionTemplate/InspectionForms.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection forms' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Inspection Forms',
                rule: 'editor'
              }
            },
			{
              path: '/inspection/forms/create',
              name: 'inspection-forms-create',
              component: () => import('@/views/apps/inspection/inspectionTemplate/InspectionFormCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection forms' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Inspection Forms',
                rule: 'editor'
              }
            }, 
		        {
              path: '/inspection/forms/items/:ID',
              name: 'inspection-forms-items',
              component: () => import('@/views/apps/inspection/inspectionTemplate/InspectionFormItem.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection forms' },
                  { title: 'Form Item', active: true }
                ],
                pageTitle: 'Inspection Forms Items',
                rule: 'editor'
              }
            },
            {
              path: '/inspection/forms/edit/:ID',
              name: 'inspection-forms-items-edit',
              component: () => import('@/views/apps/inspection/inspectionTemplate/InspectionFormEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection forms' },
                  { title: 'Form Item', active: true }
                ],
                pageTitle: 'Inspection Forms Edit',
                rule: 'editor'
              }
            },            
		        {
              path: '/inspection/create/:ID',
              name: 'inspection-create',
              component: () => import('@/views/apps/inspection/InspectionCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Inspection Create',
                rule: 'editor'
              }
            },            
            {
              path: '/inspection/edit/:ID',
              name: 'inspection-edit',
              component: () => import('@/views/apps/inspection/InspectionEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'inspection Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Inspection Edit',
                rule: 'editor'
              }
            },
            {
              path: '/inspection/create-form',
              name: 'inspection-create-form',
              component: () => import('@/views/apps/inspection/InspectionCreateForm.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Inspections', url: '/inspection' },
                  { title: 'Inspection create form', active: true }
                ],
                pageTitle: 'Inspection Create Form',
                rule: 'editor'
              }
            },
            {
              path: '/vendor/lists',
              name: 'Vendor-lists',
              component: () => import('@/views/apps/Vendor/Vendorlist.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vendor lists' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vendor',
                rule: 'editor'
              }
            },
            {
              path: '/vendor/create',
              name: 'vendor-create',
              component: () => import('@/views/apps/Vendor/VendorCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vendor' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vendor Create',
                rule: 'editor'
              }
            },
            {
              path: '/vendor/edit/:vendorid',
              name: 'vendor-edit',
              component: () => import('@/views/apps/Vendor/VendorEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vendor Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vendor Edit',
                rule: 'editor'
              }
            },
            {
              path: '/Fuel/lists',
              name: 'fuel-lists',
              component: () => import('@/views/apps/Fuel/FuelList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Fuel lists' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Fuel',
                rule: 'editor'
              }
            },
            {
              path: '/Fuel/create',
              name: 'fuel-create',
              component: () => import('@/views/apps/Fuel/FuelCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Fuel' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Fuel Create',
                rule: 'editor'
              }
            },
            {
              path: '/Fuel/edit/:fuelid',
              name: 'fuel-edit',
              component: () => import('@/views/apps/Fuel/FuelEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Fuel' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Fuel Edit',
                rule: 'editor'
              }
            },
			{
              path: '/pages/',
              name: 'pages',
              component: () => import('@/views/apps/website/Pages/PageList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Pages', active: true }
                ],
                pageTitle: 'Pages',
                rule: 'editor'
              }
            },
		       {
              path: '/pages/create',
              name: 'pages-create',
              component: () => import('@/views/apps/website/Pages/PageCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Pages', url: '/pages' },
                  { title: 'Page Create', active: true }
                ],
                pageTitle: 'Pages',
                rule: 'editor'
              }
            },
            {
              path: '/pages/edit/:postID',
              name: 'pages-edit',
              component: () => import('@/views/apps/website/Pages/PageEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Pages', url: '/pages' },
                  { title: 'Page Edit', active: true }
                ],
                pageTitle: 'Pages',
                rule: 'editor'
              }
            },
            {
              path: '/theme/',
              name: 'theme',
              component: () => import('@/views/apps/website/Theme/ThemeCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Theme' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Theme',
                rule: 'editor'
              }
            },
			{
              path: '/testimonials/',
              name: 'testimonials',
              component: () => import('@/views/apps/website/Testimonials/TestimonialList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Testimonials' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Testimonials',
                rule: 'editor'
              }
            },
			     {
              path: '/plan/',
              name: 'plan',
              component: () => import('@/views/apps/website/Plans/PlanList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Plan', url: '/plan' },
                  { title: 'Plans List', active: true },                 
                ],
                pageTitle: 'Plans',
                rule: 'editor'
              }
            },
			     {
              path: '/plan/create',
              name: 'plan-create',
              component: () => import('@/views/apps/website/Plans/PlanCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Plan', url: '/plan' },
                  { title: 'Plan Create', url: '/plan/create',active: true },
                                  
                ],
                pageTitle: 'Plan Create',
                rule: 'editor'
              }
            },
             {
              path: '/plan/edit/:postID',
              name: 'plan-edit',
              component: () => import('@/views/apps/website/Plans/PlanEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Plan', url: '/plan' },
                  { title: 'Plan Edit', active: true }
                ],
                pageTitle: 'Plan',
                rule: 'editor'
              }
            },
			     {
              path: '/menu/',
              name: 'Menu',
              component: () => import('@/views/apps/website/Menu/Menu.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Menu' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Menu',
                rule: 'editor'
              }
            },
            {
              path: '/careerformlist/',
              name: 'careerformlist',
              component: () => import('@/views/apps/website/Careerformlist/Careerformlist.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Career Form List', active: true }
                ],
                pageTitle: 'Career Form List',
                rule: 'editor'
              }
            },
            {
              path: '/careerformlist/edit/:ID',
              name: 'Careerformlist-edit',
              component: () => import('@/views/apps/website/Careerformlist/CareerEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Career Form Edit', active: true }
                ],
                pageTitle: 'Career Form Edit',
                rule: 'editor'
              }
            },
            {
              path: '/contactlist/',
              name: 'contactlist',
              component: () => import('@/views/apps/website/Contactlist/Contactlist.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Contact list', active: true  }
                ],
                pageTitle: 'Contact list',
                rule: 'editor'
              }
            },
			{
              path: '/testimonials/create',
              name: 'testimonials-create',
              component: () => import('@/views/apps/website/Testimonials/TestimonialCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Testimonials Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Testimonials',
                rule: 'editor'
              }
            },
            {
              path: '/testimonials/edit/:postID',
              name: 'testimonials-edit',
              component: () => import('@/views/apps/website/Testimonials/TestimonialEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Testimonials Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Testimonials',
                rule: 'editor'
              }
            },

		{
              path: '/issues/',
              name: 'issues-list',
              component: () => import('@/views/apps/issue/IssueList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'issues' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Issues',
                rule: 'editor'
              }
            },
            {
              path: '/issues/create',
              name: 'issue-add',
              component: () => import('@/views/apps/issue/IssueCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Issue', url: '/issues/create'  },
                  { title: 'Issue add', active: true }
                ],
                pageTitle: 'Issues',
                rule: 'editor'
              }
            },
            {
              path: '/issue/edit/:issueID',
              name: 'issue-edit',
              component: () => import('@/views/apps/issue/IssueEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Issue', url: '/issues/create'  },
                  { title: 'all', active: true }
                ],
                pageTitle: 'Issue Edit',
                rule: 'editor'
              }
            },
            
            {
              path: '/recalls',
              name: 'recalls-list',
              component: () => import('@/views/apps/issue/RecallList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Recalls', url: '/recalls'  },
                  { title: 'Recalls Lists', active: true }
                ],
                pageTitle: 'Recalls',
                rule: 'editor'
              }
            },
            {
              path: '/services/history',
              name: 'services-history',			  
              component: () => import('@/views/apps/Service/ServiceHistory.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service History' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service History',
                rule: 'editor'
              }
            },
             {
              path: '/ServiceHistory/create',
              name: 'service-history-create',
              component: () => import('@/views/apps/Service/ServiceHistoryCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Service', url: '/ServiceHistory/create'  },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service History Add',
                rule: 'editor'
              }
            },
            {
              path: '/ServiceHistory/edit/:serviceID',
              name: 'service-history-edit',
              component: () => import('@/views/apps/Service/ServiceHistoryEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Service', url: '/ServiceHistory/create'  },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service History Edit',
                rule: 'editor'
              }
            },
            {
              path: '/services/task',
              name: 'services-task',
              component: () => import('@/views/apps/Service/ServiceTask.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Task' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Task',
                rule: 'editor'
              }
            },
            {
              path: '/services/task-create',
              name: 'services-task-create',
              component: () => import('@/views/apps/Service/ServiceTaskCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Task Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Task Create',
                rule: 'editor'
              }
            },
            {
              path: '/services/task/edit/:taskid',
              name: 'services-task-edit',
              component: () => import('@/views/apps/Service/ServiceTaskEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Task Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Task Edit',
                rule: 'editor'
              }
            },
            {
              path: '/services/program',
              name: 'services-program',
              component: () => import('@/views/apps/Service/ServiceProgram.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service program' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service program',
                rule: 'editor'
              }
            },{
              path: '/services/program/create',
              name: 'services-program-create',
              component: () => import('@/views/apps/Service/ServiceProgramCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service program Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service program',
                rule: 'editor'
              }
            },
            {
              path: '/services/program/edit/:programid',
              name: 'services-program-Edit',
              component: () => import('@/views/apps/Service/ServiceProgramEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service program Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service program Edit',
                rule: 'editor'
              }
            },
            {
              path: '/make',
              name: 'make',
              component: () => import('@/views/apps/masterentry/Make/MakeList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Make' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Make',
                rule: 'editor'
              }
            },
			{
              path: '/make-create',
              name: 'make create',
              component: () => import('@/views/apps/masterentry/Make/MakeCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Make' },
                  { title: 'Make creat', active: true }
                ],
                pageTitle: 'Make create',
                rule: 'editor'
              }
            },
            {
              path: '/make/edit/:makeid',
              name: 'make-edit',
              component: () => import('@/views/apps/masterentry/Make/MakeEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Make', url: '/make' },
                  { title: 'Make Edit', active: true }
                ],
                pageTitle: 'Make',
                rule: 'editor'
              }
            },
			{
              path: '/model',
              name: 'model',
              component: () => import('@/views/apps/masterentry/Model/ModelList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Model' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Model',
                rule: 'editor'
              }
            },
			{
              path: '/model-create',
              name: 'model-create',
              component: () => import('@/views/apps/masterentry/Model/ModelCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Model' },
                  { title: 'Model create', active: true }
                ],
                pageTitle: 'Model create',
                rule: 'editor'
              }
            },
            {
              path: '/model/edit/:modelid',
              name: 'model-edit',
              component: () => import('@/views/apps/masterentry/Model/ModelEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Model' },
                  { title: 'Model create', active: true }
                ],
                pageTitle: 'Model create',
                rule: 'editor'
              }
            },
			{
              path: '/type',
              name: 'type',
              component: () => import('@/views/apps/masterentry/Type/TypeList.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Type' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Type',
                rule: 'editor'
              }
            },
            {
              path: '/type-create',
              name: 'type-create',
              component: () => import('@/views/apps/masterentry/Type/TypeCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Type' },
                  { title: 'Model create', active: true }
                ],
                pageTitle: 'Type create',
                rule: 'editor'
              }
            },
            {
              path: '/type/edit/:typeid',
              name: 'type-edit',
              component: () => import('@/views/apps/masterentry/Type/TypeEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Type' },
                  { title: 'Type create', active: true }
                ],
                pageTitle: 'Type create',
                rule: 'editor'
              }
            },
			{
              path: '/users',
              name: 'users',
              component: () => import('@/views/apps/users/User.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'users' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'users',
                rule: 'editor'
              }
            },
            {
              path: '/UsersSettings',
              name: 'user-setting',
              component: () => import('@/views/apps/user-settings/UserSettings.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Users Settings' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Users Settings',
                rule: 'editor'
              }
            },
            {
              path: '/service/reminders',
              name: 'Service Reminders',
              component: () => import('@/views/apps/Reminder/ServiceReminder/ServiceReminder.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Reminders' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Reminders',
                rule: 'editor'
              }
            },{
              path: '/service/reminders/create',
              name: 'Service Reminders Create',
              component: () => import('@/views/apps/Reminder/ServiceReminder/ServiceReminderCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Reminders Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Reminders Create',
                rule: 'editor'
              }
            },{
              path: '/service/reminders/edit/:ID',
              name: 'Service Reminders Edit',
              component: () => import('@/views/apps/Reminder/ServiceReminder/ServiceReminderEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Service Reminders Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Service Reminders Edit',
                rule: 'editor'
              }
            },
            {
              path: '/contact/renewal/create',
              name: 'Contact Renewal Create',
              component: () => import('@/views/apps/Reminder/ContactRenewal/ContactRenewalCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Contact Renewal Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Contact Renewal Create',
                rule: 'editor'
              }
            },
            {
              path: '/contact/renewal/edit/:ID',
              name: 'Contact Renewal Edit',
              component: () => import('@/views/apps/Reminder/ContactRenewal/ContactRenewalEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Contact Renewal Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Contact Renewal Edit',
                rule: 'editor'
              }
            },
            {
              path: '/contact/renewal',
              name: 'Contact Renewal',
              component: () => import('@/views/apps/Reminder/ContactRenewal/ContactRenewal.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Contact Renewal' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Contact Renewal',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/renewal',
              name: 'Vehicle Renewal',
              component: () => import('@/views/apps/Reminder/VehicleRenewal/VehicleRenewal.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vehicle Renewal' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vehicle Renewal',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/renewal/create',
              name: 'Vehicle Renewal Create',
              component: () => import('@/views/apps/Reminder/VehicleRenewal/VehicleRenewalCreate.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vehicle Renewal Create' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vehicle Renewal Create',
                rule: 'editor'
              }
            },
            {
              path: '/vehicle/renewal/edit/:ID',
              name: 'Vehicle Renewal Edit',
              component: () => import('@/views/apps/Reminder/VehicleRenewal/VehicleRenewalEdit.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/Home' },
                  { title: 'Vehicle Renewal Edit' },
                  { title: 'All', active: true }
                ],
                pageTitle: 'Vehicle Renewal Edit',
                rule: 'editor'
              }
            },
		       {
              path: '/account/subscription',
              name: 'Billing & Subscriptions',
              component: () => import('@/views/apps/Account/Subscriptions.vue'),
              meta: {
                breadcrumb: [
                  { title: 'Home', url: '/home' },
                  { title: 'Billing & Subscriptions', active: true }
                ],
                pageTitle: 'Billing & Subscriptions',
                rule: 'editor'
              }
            },

          ],
        },
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ],
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
 if (appLoading) {
      appLoading.style.display = "none";
  } 

  var session = VueEasySession.getInstance();

  const access = session.get('access');

  if (access == undefined || !access) {
    if (
      router.currentRoute.name != 'auth-login' && 
      router.currentRoute.name != 'auth-register' && 
      router.currentRoute.name != 'auth-forgot-password' && 
      router.currentRoute.name != 'front-single' && 
      router.currentRoute.name != 'auth-details' &&  
      router.currentRoute.name != 'mainhome'
    ) {
      session.set('cart', '');
      session.set('free_trial', '');
      session.set('profile', '');
      router.push('/auth/login');
    } 
  } 
})
const originalPush = Router.prototype.push;
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => {
    if (err.name !== 'NavigationDuplicated') throw err
  });
}
export default router
