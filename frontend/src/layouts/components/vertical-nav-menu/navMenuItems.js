export default [
  {
    url: "/home",
    name: "Dashboard",
    slug: "home",
    icon: "HomeIcon",
  },
  {
    url: null,
    name: 'vehicles',
    icon: 'HomeIcon',
    i18n: 'vehicles',
    submenu: [
      {
        url: '/vehicle',
        name: 'Vehicle List',
        slug: 'vehicle-list',
        i18n: 'All'
      },
      {
        url: '/vehicle/assignment',
        name: 'Vehicle Assignment',
        slug: 'vehicle-assignment',
        i18n: 'Assignment'
      },      
      {
        url: '/meter',
        name: 'Meter History',
        slug: 'meter-history',
        i18n: 'Meter History'
      },
      {
        url: '/expense',
        name: 'Expense History',
        slug: 'expense-history',
        i18n: 'Expense History'
      }
    ]
  },
  {
    url: null,
    name: 'Inspections',
    icon: 'UserIcon',
    i18n: 'inspections',
    submenu: [
      {
        url: '/inspection',
        name: 'Inspection List',
        slug: 'inspection-list',
        i18n: 'All'
      },
	  {
        url: '/inspection/forms',
        name: 'Inspection Forms',
        slug: 'inspection-forms',
        i18n: 'All'
      },
    ]
  },
  {
    url: null,
    name: 'Website Management',
    icon: 'UserIcon',
    i18n: 'Website',
    submenu: [
      {
        url: '/pages',
        name: 'Pages',
        slug: 'pages',
        i18n: 'Pages'
      },
      {
        url: '/theme',
        name: 'Theme',
        slug: 'theme',
        i18n: 'Theme'
      },
      {
        url: '/testimonials',
        name: 'Testimonials',
        slug: 'testimonials',
        i18n: 'Testimonials'
      },
	  {
        url: '/plan',
        name: 'Plans',
        slug: 'plan',
        i18n: 'Plan'
      },
      {
        url: '/menu',
        name: 'Menu',
        slug: 'menu',
        i18n: 'Menu'
      },
      {
        url: '/contactlist',
        name: 'Contact list',
        slug: 'contactlist',
        i18n: 'Contactlist'
      },
      {
        url: '/careerformlist',
        name: 'Career form list',
        slug: 'careerformlist',
        i18n: 'Careerformlist'
      }
    ]
  },
  {
    url: null,
    name: 'Issues',
    icon: 'UserIcon',
    i18n: 'issues',
    submenu: [
      {
        url: '/issues',
        name: 'Issues',
        slug: 'issues-list',
        i18n: 'All'
      },
      {
        url: '/faults',
        name: 'Faults',
        slug: 'faults-list',
        i18n: 'Faults'
      }
    ]
  },
  {
    url: null,
    name: 'Reminders',
    icon: 'UserIcon',
    i18n: 'reminders',
    submenu: [
      {
        url: '/service/reminders',
        name: 'Service Reminders',
        slug: 'reminders-list',
        i18n: 'All'
      },
      {
        url: '/vehicle/renewal',
        name: 'Vehicle Renewal',
        slug: 'vehicle-renewal',
        i18n: 'Vehicle Renewal'
      },
      {
        url: '/contact/renewal',
        name: 'Contact Renewal',
        slug: 'contact-renewal',
        i18n: 'Contact Renewal'
      }
    ]
  },
  {
    url: null,
    name: 'Service',
    icon: 'UserIcon',
    i18n: 'services',
    submenu: [{
        url: '/services/history',
        name: 'services History',
        slug: 'services-history',
        i18n: 'services History'
      },
      {
        url: '/services/task',
        name: 'services Task',
        slug: 'services-task',
        i18n: 'services Task'
      },
      {
        url: '/services/program',
        name: 'services program',
        slug: 'services-program',
        i18n: 'services program'
      },
      {
        url: '/shop/directory',
        name: 'shop directory',
        slug: 'shop-directory',
        i18n: 'shop directory'
      },
      {
        url: '/shop/integration',
        name: 'shop integration',
        slug: 'shop-integration',
        i18n: 'shop integration'
      }
    ]
  },
  {
    url: null,
    name: 'Vendor',
    icon: 'UserIcon',
    i18n: 'Vendors',
    submenu: [
      {
        url: '/vendor/lists',
        name: 'Vendor lists',
        slug: 'vendor-lists',
        i18n: 'vendor lists'
      }
    ]
  },
  {
    url: null,
    name: 'Fuel',
    icon: 'UserIcon',
    i18n: 'Fuel',
    submenu: [
      {
        url: '/Fuel/lists',
        name: 'Fuel lists',
        slug: 'Fuel-lists',
        i18n: 'Fuel lists'
      }
    ]
  },
  {
    url: null,
    name: 'Master Enteries',
    icon: 'UserIcon',
    i18n: 'Master Enteries',
    submenu: [
      {
        url: '/Make',
        name: 'Make lists',
        slug: 'Make-lists',
        i18n: 'Make lists'
      },{
        url: '/Model',
        name: 'Model lists',
        slug: 'Model-lists',
        i18n: 'Model lists'
      },{
        url: '/Type',
        name: 'Trim lists',
        slug: 'Trim-lists',
        i18n: 'Trim lists'
      },
    ]
  },
  {
    url: null,
    name: 'Contacts & Users',
    icon: 'UserIcon',
    i18n: 'Contacts',
    submenu: [
      {
        url: '/users',
        name: 'Users List',
        slug: 'users-list',
        i18n: 'All'
      }
    ]
  },
  {
    url: null,
    name: 'User Settings',
    icon: 'UserIcon',
    i18n: 'User Settings',
    submenu: [
      {
        url: '/UsersSettings',
        name: 'Users Settings',
        slug: 'Users-Settings',
        i18n: 'All'
      },
	  {
        url: '/account/subscription',
        name: 'Billing & Subscriptions',
        slug: 'account-Settings',
        i18n: 'All'
      }
    ]
  },
]