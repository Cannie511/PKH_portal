export function RoutesConfig ($stateProvider, $urlRouterProvider) {
  'ngInject'

  var getView = (viewName) => {
    return `./views/app/pages/${viewName}/${viewName}.page.html`
  }

  var getLayout = (layout) => {
    return `./views/app/pages/layout/${layout}.page.html`
  }

  $urlRouterProvider.otherwise('/')

  $stateProvider
    .state('app', {
      abstract: true,
      views: {
        'layout': {
          templateUrl: getLayout('layout')
        },
        'header@app': {
          templateUrl: getView('header')
        },
        'footer@app': {
          templateUrl: getView('footer')
        },
        main: {}
      },
      data: {
        bodyClass: 'hold-transition skin-blue sidebar-mini'
      }
    })
    .state('app.landing', {
      url: '/',
      data: {
        auth: true
      },
      views: {
        'main@app': {
          templateUrl: getView('landing')
        }
      }
    })
    .state('app.profile', {
      url: '/profile',
      data: {
        auth: true,
        roles: ['Admin']
      },
      views: {
        'main@app': {
          template: '<user-profile></user-profile>'
        }
      },
      params: {
        alerts: null
      }
    })
    // .state('app.userlist', {
    //   url: '/user-lists',
    //   data: {
    //     auth: true,
    //     roles: ['administrator']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-lists></user-lists>'
    //     }
    //   }
    // })
    // .state('app.useredit', {
    //   url: '/user-edit/:userId',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-edit></user-edit>'
    //     }
    //   },
    //   params: {
    //     alerts: null,
    //     userId: null
    //   }
    // })
    // .state('app.userroles', {
    //   url: '/user-roles',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-roles></user-roles>'
    //     }
    //   }
    // })
    // .state('app.userpermissions', {
    //   url: '/user-permissions',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-permissions></user-permissions>'
    //     }
    //   }
    // })
    // .state('app.userpermissionsadd', {
    //   url: '/user-permissions-add',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-permissions-add></user-permissions-add>'
    //     }
    //   },
    //   params: {
    //     alerts: null
    //   }
    // })
    // .state('app.userpermissionsedit', {
    //   url: '/user-permissions-edit/:permissionId',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-permissions-edit></user-permissions-edit>'
    //     }
    //   },
    //   params: {
    //     alerts: null,
    //     permissionId: null
    //   }
    // })
    // .state('app.userrolesadd', {
    //   url: '/user-roles-add',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-roles-add></user-roles-add>'
    //     }
    //   },
    //   params: {
    //     alerts: null
    //   }
    // })
    // .state('app.userrolesedit', {
    //   url: '/user-roles-edit/:roleId',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<user-roles-edit></user-roles-edit>'
    //     }
    //   },
    //   params: {
    //     alerts: null,
    //     roleId: null
    //   }
    // })
    .state('login', {
      url: '/login',
      views: {
        'layout': {
          templateUrl: getView('login')
        },
        'header@app': {},
        'footer@app': {}
      },
      data: {
        bodyClass: 'hold-transition login-page'
      },
      params: {
        registerSuccess: null,
        successMsg: null
      }
    })
    .state('loginloader', {
      url: '/login-loader',
      views: {
        'layout': {
          templateUrl: getView('login-loader')
        },
        'header@app': {},
        'footer@app': {}
      },
      data: {
        bodyClass: 'hold-transition login-page'
      }
    })
    // .state('register', {
    //   url: '/register',
    //   views: {
    //     'layout': {
    //       templateUrl: getView('register')
    //     },
    //     'header@app': {},
    //     'footer@app': {}
    //   },
    //   data: {
    //     bodyClass: 'hold-transition register-page'
    //   }
    // })
    // .state('userverification', {
    //   url: '/userverification/:status',
    //   views: {
    //     'layout': {
    //       templateUrl: getView('user-verification')
    //     }
    //   },
    //   data: {
    //     bodyClass: 'hold-transition login-page'
    //   },
    //   params: {
    //     status: null
    //   }
    // })
    .state('forgot_password', {
      url: '/forgot-password',
      views: {
        'layout': {
          templateUrl: getView('forgot-password')
        },
        'header@app': {},
        'footer@app': {}
      },
      data: {
        bodyClass: 'hold-transition login-page'
      }
    })
    .state('reset_password', {
      url: '/reset-password/:email/:token',
      views: {
        'layout': {
          templateUrl: getView('reset-password')
        },
        'header@app': {},
        'footer@app': {}
      },
      data: {
        bodyClass: 'hold-transition login-page'
      }
    })
    .state('app.logout', {
      url: '/logout',
      views: {
        'main@app': {
          controller: function ($rootScope, $scope, $auth, $state, AclService) {
            $auth.logout().then(function () {
              delete $rootScope.me
              AclService.flushRoles()
              AclService.setAbilities({})
              $state.go('login')
            })
          }
        }
      }
    })
    // Supplier
    // .state('app.supplierlist', {
    //   url: '/supplier-lists',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<supplier-lists></supplier-lists>'
    //     }
    //   }
    // })
    // .state('app.supplieradd', {
    //   url: '/supplier-add',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<supplier-add></supplier-add>'
    //     }
    //   }
    // })
    // .state('app.supplieredit', {
    //   url: '/supplier-edit/:id',
    //   data: {
    //     auth: true
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<supplier-edit></supplier-edit>'
    //     }
    //   }
    // })
    // .state('app.crm0130', {
    //   url: '/crm0130',
    //   data: {
    //     auth: true,
    //     roles: ['administrator', 'manager', 'sale-manager', 'sales-admin', 'sales', 'accountant']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<crm0130></crm0130>'
    //     }
    //   }
    // })
    // // Danh sách đơn đặt hàng
    // .state('app.crm0200', {
    //   url: '/crm0200',
    //   data: {
    //     auth: true,
    //     roles: ['administrator', 'manager', 'sale-manager', 'sales-admin', 'sales', 'accountant']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<crm0200></crm0200>'
    //     }
    //   }
    // })
    // // Tạo đơn đặt hàng
    // .state('app.crm0210', {
    //   url: '/crm0210',
    //   data: {
    //     auth: true,
    //     roles: ['administrator', 'manager', 'sale-manager', 'sales-admin', 'sales', 'accountant']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<crm0210></crm0210>'
    //     }
    //   },
    //   params: {
    //     alerts: null,
    //     store_id: null,
    //     store_order_id: null
    //   }
    // })
    // // Danh sach cua hang
    // .state('app.crm0300', {
    //   url: '/crm0300',
    //   data: {
    //     auth: true,
    //     roles: ['administrator', 'manager', 'sale-manager', 'sales-admin', 'sales', 'accountant']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<crm0300></crm0300>'
    //     }
    //   }
    // })
    // // Tao cua hang
    // .state('app.crm0310', {
    //   url: '/crm0310',
    //   data: {
    //     auth: true,
    //     roles: ['administrator', 'manager', 'sale-manager', 'sales-admin', 'sales', 'accountant']
    //   },
    //   views: {
    //     'main@app': {
    //       template: '<crm0310></crm0310>'
    //     }
    //   },
    //   params: {
    //     alerts: null,
    //     store_id: null
    //   }
    // })
    // Tao don hang
    .state('app.cus0110', {
      url: '/cus0110',
      data: {
        auth: true,
        roles: ['customer']
      },
      views: {
        'main@app': {
          template: '<cus0110></cus0110>'
        }
      }
    })
}
