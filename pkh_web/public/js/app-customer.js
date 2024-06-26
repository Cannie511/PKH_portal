/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	__webpack_require__(1);

	__webpack_require__(2);

	__webpack_require__(4);

	__webpack_require__(5);

	__webpack_require__(12);

	__webpack_require__(21);

	__webpack_require__(32);

	__webpack_require__(36);

/***/ }),
/* 1 */
/***/ (function(module, exports) {

	'use strict';

	angular.module('app', ['app.run', 'app.filters', 'app.services', 'app.components', 'app.routes', 'app.config', 'app.constants', 'app.partials']);

	angular.module('app.run', []);
	angular.module('app.routes', []);
	angular.module('app.filters', []);
	angular.module('app.services', []);
	angular.module('app.config', []);
	angular.module('app.constants', []);
	angular.module('app.components', ['ui.router', 'angular-loading-bar', 'restangular', 'ngStorage', 'satellizer', 'ui.bootstrap', 'chart.js', 'mm.acl', 'datatables', 'datatables.bootstrap', 'checklist-model', 'toaster', 'ngAnimate', 'ngSanitize', 'pascalprecht.translate']);

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _routes = __webpack_require__(3);

	angular.module('app.run').run(_routes.RoutesRun);

/***/ }),
/* 3 */
/***/ (function(module, exports) {

	'use strict';

	RoutesRun.$inject = ["$rootScope", "$state", "$auth", "AclService", "$timeout", "API", "ContextService"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.RoutesRun = RoutesRun;
	function RoutesRun($rootScope, $state, $auth, AclService, $timeout, API, ContextService) {
	  'ngInject';

	  AclService.resume();

	  /*eslint-disable */
	  var deregisterationCallback = $rootScope.$on('$stateChangeStart', function (event, toState) {
	    if (toState.data && toState.data.auth) {
	      if (!$auth.isAuthenticated()) {
	        event.preventDefault();
	        return $state.go('login');
	      }
	    }

	    $rootScope.bodyClass = 'hold-transition login-page';
	  });

	  function stateChange() {
	    $timeout(function () {
	      // fix sidebar
	      var neg = $('.main-header').outerHeight() + $('.main-footer').outerHeight();
	      var window_height = $(window).height();
	      var sidebar_height = $('.sidebar').height();

	      if ($('body').hasClass('fixed')) {
	        $('.content-wrapper, .right-side').css('min-height', window_height - $('.main-footer').outerHeight());
	      } else {
	        if (window_height >= sidebar_height) {
	          $('.content-wrapper, .right-side').css('min-height', window_height - neg);
	        } else {
	          $('.content-wrapper, .right-side').css('min-height', sidebar_height);
	        }
	      }

	      // get user current context
	      if ($auth.isAuthenticated() && !$rootScope.me) {
	        ContextService.getContext().then(function (response) {
	          response = response.plain();
	          $rootScope.me = response.data;
	        });
	      }
	    });
	  }

	  $rootScope.$on('$destroy', deregisterationCallback);
	  $rootScope.$on('$stateChangeSuccess', stateChange);
	  /*eslint-enable */
	}

/***/ }),
/* 4 */
/***/ (function(module, exports) {

	'use strict';

	angular.module('app.constants').constant('appSetting', {
		'debug': true
	});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _app = __webpack_require__(6);

	var _translate = __webpack_require__(7);

	var _acl = __webpack_require__(8);

	var _routes = __webpack_require__(9);

	var _loading_bar = __webpack_require__(10);

	var _satellizer = __webpack_require__(11);

	angular.module('app.config').config(_app.AppConfig).config(_translate.TranslateConfig).config(_acl.AclConfig).config(_routes.RoutesConfig).config(_loading_bar.LoadingBarConfig).config(_satellizer.SatellizerConfig);

/***/ }),
/* 6 */
/***/ (function(module, exports) {

	"use strict";

	AppConfig.$inject = ["$compileProvider", "$logProvider", "uibPaginationConfig"];
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.AppConfig = AppConfig;
	function AppConfig($compileProvider, $logProvider, uibPaginationConfig) {
	    'ngInject';

	    // compile config

	    $compileProvider.debugInfoEnabled(false);

	    // log config
	    $logProvider.debugEnabled(true);

	    // Set pagination
	    uibPaginationConfig.boundaryLinks = true;
	    uibPaginationConfig.firstText = "«";
	    uibPaginationConfig.lastText = "»";
	    uibPaginationConfig.nextText = "›";
	    uibPaginationConfig.previousText = "‹";
	    uibPaginationConfig.numPage = "numPages";
	    uibPaginationConfig.maxSize = 5;
	    uibPaginationConfig.rotate = false;
	}

/***/ }),
/* 7 */
/***/ (function(module, exports) {

	'use strict';

	TranslateConfig.$inject = ["$translateProvider"];
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.TranslateConfig = TranslateConfig;
	function TranslateConfig($translateProvider) {
	    'ngInject';

	    //$translateProvider.useSanitizeValueStrategy('sanitize');

	    $translateProvider.useSanitizeValueStrategy('escaped');
	    $translateProvider.useStaticFilesLoader({
	        prefix: '/backend/lang/',
	        suffix: '.json'
	    });

	    var defaultLang = "en";
	    $translateProvider.preferredLanguage(defaultLang).fallbackLanguage(defaultLang);
	    //$translateProvider.forceAsyncReload(true);
	    //$translateProvider.useLocalStorage();
	}

/***/ }),
/* 8 */
/***/ (function(module, exports) {

	'use strict';

	AclConfig.$inject = ["AclServiceProvider"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.AclConfig = AclConfig;
	function AclConfig(AclServiceProvider) {
	  'ngInject';

	  var myConfig = {
	    //storage: 'localStorage',
	    storage: 'sessionStorage',
	    storageKey: 'AppAcl'

	    /*eslint-disable */
	  };AclServiceProvider.config(myConfig);
	  /*eslint-enable */
	}

/***/ }),
/* 9 */
/***/ (function(module, exports) {

	'use strict';

	RoutesConfig.$inject = ["$stateProvider", "$urlRouterProvider"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.RoutesConfig = RoutesConfig;
	function RoutesConfig($stateProvider, $urlRouterProvider) {
	  'ngInject';

	  var getView = function getView(viewName) {
	    return './views/app/pages/' + viewName + '/' + viewName + '.page.html';
	  };

	  var getLayout = function getLayout(layout) {
	    return './views/app/pages/layout/' + layout + '.page.html';
	  };

	  $urlRouterProvider.otherwise('/');

	  $stateProvider.state('app', {
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
	  }).state('app.landing', {
	    url: '/',
	    data: {
	      auth: true
	    },
	    views: {
	      'main@app': {
	        templateUrl: getView('landing')
	      }
	    }
	  }).state('app.profile', {
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
	  }).state('loginloader', {
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
	  }).state('reset_password', {
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
	  }).state('app.logout', {
	    url: '/logout',
	    views: {
	      'main@app': {
	        controller: ["$rootScope", "$scope", "$auth", "$state", "AclService", function controller($rootScope, $scope, $auth, $state, AclService) {
	          $auth.logout().then(function () {
	            delete $rootScope.me;
	            AclService.flushRoles();
	            AclService.setAbilities({});
	            $state.go('login');
	          });
	        }]
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
	  });
	}

/***/ }),
/* 10 */
/***/ (function(module, exports) {

	'use strict';

	LoadingBarConfig.$inject = ["cfpLoadingBarProvider"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.LoadingBarConfig = LoadingBarConfig;
	function LoadingBarConfig(cfpLoadingBarProvider) {
	  'ngInject';

	  cfpLoadingBarProvider.includeSpinner = true;
	}

/***/ }),
/* 11 */
/***/ (function(module, exports) {

	'use strict';

	SatellizerConfig.$inject = ["$authProvider"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.SatellizerConfig = SatellizerConfig;
	function SatellizerConfig($authProvider) {
	  'ngInject';

	  $authProvider.httpInterceptor = function () {
	    return true;
	  };

	  $authProvider.loginUrl = '/api/auth/login';
	  $authProvider.signupUrl = '/api/auth/register';
	  $authProvider.tokenRoot = 'data'; // compensates success response macro
	}

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _date_millis = __webpack_require__(13);

	var _capitalize = __webpack_require__(14);

	var _human_readable = __webpack_require__(15);

	var _truncate_characters = __webpack_require__(16);

	var _truncate_words = __webpack_require__(17);

	var _trust_html = __webpack_require__(18);

	var _ucfirst = __webpack_require__(19);

	var _currentdate = __webpack_require__(20);

	angular.module('app.filters').filter('datemillis', _date_millis.DateMillisFilter).filter('capitalize', _capitalize.CapitalizeFilter).filter('humanreadable', _human_readable.HumanReadableFilter).filter('truncateCharacters', _truncate_characters.TruncatCharactersFilter).filter('truncateWords', _truncate_words.TruncateWordsFilter).filter('trustHtml', _trust_html.TrustHtmlFilter).filter('ucfirst', _ucfirst.UcFirstFilter).filter('currentdate', _currentdate.CurrentDateFilter);

/***/ }),
/* 13 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.DateMillisFilter = DateMillisFilter;
	function DateMillisFilter() {
	  'ngInject';

	  return function (input) {
	    return Date.parse(input);
	  };
	}

/***/ }),
/* 14 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.CapitalizeFilter = CapitalizeFilter;
	function CapitalizeFilter() {
	  return function (input) {
	    return input ? input.replace(/([^\W_]+[^\s-]*) */g, function (txt) {
	      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	    }) : '';
	  };
	}

/***/ }),
/* 15 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.HumanReadableFilter = HumanReadableFilter;
	function HumanReadableFilter() {
	  return function humanize(str) {
	    if (!str) {
	      return '';
	    }
	    var frags = str.split('_');
	    for (var i = 0; i < frags.length; i++) {
	      frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
	    }
	    return frags.join(' ');
	  };
	}

/***/ }),
/* 16 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.TruncatCharactersFilter = TruncatCharactersFilter;
	function TruncatCharactersFilter() {
	  return function (input, chars, breakOnWord) {
	    if (isNaN(chars)) {
	      return input;
	    }
	    if (chars <= 0) {
	      return '';
	    }
	    if (input && input.length > chars) {
	      input = input.substring(0, chars);

	      if (!breakOnWord) {
	        var lastspace = input.lastIndexOf(' ');
	        // Get last space
	        if (lastspace !== -1) {
	          input = input.substr(0, lastspace);
	        }
	      } else {
	        while (input.charAt(input.length - 1) === ' ') {
	          input = input.substr(0, input.length - 1);
	        }
	      }
	      return input + '...';
	    }
	    return input;
	  };
	}

/***/ }),
/* 17 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.TruncateWordsFilter = TruncateWordsFilter;
	function TruncateWordsFilter() {
	  return function (input, words) {
	    if (isNaN(words)) {
	      return input;
	    }
	    if (words <= 0) {
	      return '';
	    }
	    if (input) {
	      var inputWords = input.split(/\s+/);
	      if (inputWords.length > words) {
	        input = inputWords.slice(0, words).join(' ') + '...';
	      }
	    }
	    return input;
	  };
	}

/***/ }),
/* 18 */
/***/ (function(module, exports) {

	"use strict";

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.TrustHtmlFilter = TrustHtmlFilter;
	function TrustHtmlFilter($sce) {
	  return function (html) {
	    return $sce.trustAsHtml(html);
	  };
	}

/***/ }),
/* 19 */
/***/ (function(module, exports) {

	"use strict";

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.UcFirstFilter = UcFirstFilter;
	function UcFirstFilter() {
	  return function (input) {
	    if (!input) {
	      return null;
	    }
	    return input.substring(0, 1).toUpperCase() + input.substring(1);
	  };
	}

/***/ }),
/* 20 */
/***/ (function(module, exports) {

	'use strict';

	CurrentDateFilter.$inject = ["$filter"];
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.CurrentDateFilter = CurrentDateFilter;
	function CurrentDateFilter($filter) {
	  'ngInject';

	  return function () {
	    return $filter('date')(new Date(), 'yyyy-MM-dd');
	  };
	}

/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _cus = __webpack_require__(22);

	var _userProfile = __webpack_require__(23);

	var _userVerification = __webpack_require__(24);

	var _dashboard = __webpack_require__(25);

	var _navSidebar = __webpack_require__(26);

	var _navHeader = __webpack_require__(27);

	var _loginLoader = __webpack_require__(28);

	var _resetPassword = __webpack_require__(29);

	var _forgotPassword = __webpack_require__(30);

	var _loginForm = __webpack_require__(31);

	// import { RegisterFormComponent } from './app/components/register-form/register-form.component'

	angular.module('app.components').component('cus0110', _cus.Cus0110Component)
	// .component('crm0310', Crm0310Component)
	// .component('crm0300', Crm0300Component)
	// .component('crm0210', Crm0210Component)
	// .component('crm0200', Crm0200Component)
	// .component('crm0130', Crm0130Component)
	// .component('infoContact', InfoContactComponent)
	// .component('supplierEdit', SupplierEditComponent)
	// .component('supplierAdd', SupplierAddComponent)
	// .component('supplierLists', SupplierListsComponent)
	//  .component('tablesSimple', TablesSimpleComponent)
	// .component('uiModal', UiModalComponent)
	// .component('uiTimeline', UiTimelineComponent)
	// .component('uiButtons', UiButtonsComponent)
	// .component('uiIcons', UiIconsComponent)
	// .component('uiGeneral', UiGeneralComponent)
	// .component('formsGeneral', FormsGeneralComponent)
	// .component('chartsChartjs', ChartsChartjsComponent)
	// .component('widgets', WidgetsComponent)
	.component('userProfile', _userProfile.UserProfileComponent).component('userVerification', _userVerification.UserVerificationComponent)
	// .component('comingSoon', ComingSoonComponent)
	// .component('userEdit', UserEditComponent)
	// .component('userPermissionsEdit', UserPermissionsEditComponent)
	// .component('userPermissionsAdd', UserPermissionsAddComponent)
	// .component('userPermissions', UserPermissionsComponent)
	// .component('userRolesEdit', UserRolesEditComponent)
	// .component('userRolesAdd', UserRolesAddComponent)
	// .component('userRoles', UserRolesComponent)
	// .component('userLists', UserListsComponent)
	.component('dashboard', _dashboard.DashboardComponent).component('navSidebar', _navSidebar.NavSidebarComponent).component('navHeader', _navHeader.NavHeaderComponent).component('loginLoader', _loginLoader.LoginLoaderComponent).component('resetPassword', _resetPassword.ResetPasswordComponent).component('forgotPassword', _forgotPassword.ForgotPasswordComponent).component('loginForm', _loginForm.LoginFormComponent);
	// .component('registerForm', RegisterFormComponent)

	// import { ComingSoonComponent } from './app/components/coming-soon/coming-soon.component'
	// import { UserEditComponent } from './app/components/user-edit/user-edit.component'
	// import { UserPermissionsEditComponent } from './app/components/user-permissions-edit/user-permissions-edit.component'
	// import { UserPermissionsAddComponent } from './app/components/user-permissions-add/user-permissions-add.component'
	// import { UserPermissionsComponent } from './app/components/user-permissions/user-permissions.component'
	// import { UserRolesEditComponent } from './app/components/user-roles-edit/user-roles-edit.component'
	// import { UserRolesAddComponent } from './app/components/user-roles-add/user-roles-add.component'
	// import { UserRolesComponent } from './app/components/user-roles/user-roles.component'
	// import { UserListsComponent } from './app/components/user-lists/user-lists.component'

	// import {Crm0310Component} from './app/components/crm0310/crm0310.component';
	// import {Crm0300Component} from './app/components/crm0300/crm0300.component';
	// import {Crm0210Component} from './app/components/crm0210/crm0210.component';
	// import {Crm0200Component} from './app/components/crm0200/crm0200.component';
	// import {Crm0130Component} from './app/components/crm0130/crm0130.component';
	// import {InfoContactComponent} from './app/components/info-contact/info-contact.component';
	// import {SupplierEditComponent} from './app/components/supplier_edit/supplier_edit.component';
	// import {SupplierAddComponent} from './app/components/supplier_add/supplier_add.component';
	// import { SupplierListsComponent } from './app/components/supplier_lists/supplier_lists.component';
	// import { TablesSimpleComponent } from './app/components/tables-simple/tables-simple.component'
	// import { UiModalComponent } from './app/components/ui-modal/ui-modal.component'
	// import { UiTimelineComponent } from './app/components/ui-timeline/ui-timeline.component'
	// import { UiButtonsComponent } from './app/components/ui-buttons/ui-buttons.component'
	// import { UiIconsComponent } from './app/components/ui-icons/ui-icons.component'
	// import { UiGeneralComponent } from './app/components/ui-general/ui-general.component'
	// import { FormsGeneralComponent } from './app/components/forms-general/forms-general.component'
	// import { ChartsChartjsComponent } from './app/components/charts-chartjs/charts-chartjs.component'
	// import { WidgetsComponent } from './app/components/widgets/widgets.component'

/***/ }),
/* 22 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Cus0110Controller = function () {
	    Cus0110Controller.$inject = ["$scope", "$state", "API", "$log", "$stateParams", "RouteService", "ClientService"];
	    function Cus0110Controller($scope, $state, API, $log, $stateParams, RouteService, ClientService) {
	        'ngInject';

	        _classCallCheck(this, Cus0110Controller);

	        this.API = API;
	        this.$state = $state;
	        this.$log = $log;
	        this.ClientService = ClientService;
	        this.RouteService = RouteService;

	        this.m = {
	            data: null,
	            mode: 'EDIT'
	        };
	    }

	    _createClass(Cus0110Controller, [{
	        key: '$onInit',
	        value: function $onInit() {
	            this.loadInitData();
	        }
	    }, {
	        key: 'loadInitData',
	        value: function loadInitData() {
	            var _this = this;

	            var $log = this.$log;

	            var param = {};

	            var service = this.API.service('load-init', this.API.all('cus0110'));
	            service.post(param).then(function (response) {
	                _this.m.data = response.data;
	                $log.debug('response', response);
	                $log.debug('this.m', _this.m);
	            });
	        }
	    }, {
	        key: 'confirm',
	        value: function confirm() {
	            this.m.mode = 'CONFIRM';
	        }
	    }, {
	        key: 'back',
	        value: function back() {
	            this.m.mode = 'EDIT';
	        }
	    }, {
	        key: 'order',
	        value: function order() {
	            var _this2 = this;

	            var $log = this.$log;
	            var ClientService = this.ClientService;

	            $log.info('click order', this.m.data);
	            //this.RouteService.goState('app.landing');

	            var param = [];

	            angular.forEach(this.m.data, function (cat) {
	                angular.forEach(cat.items, function (pro) {
	                    if (pro.qty > 0) {
	                        param.push({
	                            product_id: pro.product_id,
	                            qty: pro.qty
	                        });
	                    }
	                });
	            });

	            $log.info("param", param);

	            var service = this.API.service('order', this.API.all('cus0110'));
	            service.post(param).then(function (response) {
	                if (response.data.rtnCd == 'OK') {
	                    ClientService.success('Đã gửi thông tin đơn hàng');
	                    _this2.RouteService.goState('app.landing');
	                }
	                $log.debug('response', response);
	                $log.debug('this.m', _this2.m);
	            });
	        }
	    }]);

	    return Cus0110Controller;
	}();

	var Cus0110Component = exports.Cus0110Component = {
	    templateUrl: './views/app/components/cus0110/cus0110.component.html',
	    controller: Cus0110Controller,
	    controllerAs: 'vm',
	    bindings: {}
	};

/***/ }),
/* 23 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var UserProfileController = function () {
	  UserProfileController.$inject = ["$stateParams", "$state", "API"];
	  function UserProfileController($stateParams, $state, API) {
	    'ngInject';

	    var _this = this;

	    _classCallCheck(this, UserProfileController);

	    this.$state = $state;
	    this.formSubmitted = false;
	    this.alerts = [];
	    this.userRolesSelected = [];

	    if ($stateParams.alerts) {
	      this.alerts.push($stateParams.alerts);
	    }

	    var UserData = API.service('me', API.all('users'));
	    UserData.one().get().then(function (response) {
	      _this.userdata = API.copy(response);
	      _this.userdata.data.current_password = '';
	      _this.userdata.data.new_password = '';
	      _this.userdata.data.new_password_confirmation = '';
	    });
	  }

	  _createClass(UserProfileController, [{
	    key: 'save',
	    value: function save(isValid, userForm) {
	      var _this2 = this;

	      if (isValid) {
	        var $state = this.$state;

	        this.userdata.put().then(function () {
	          var alert = { type: 'success', 'title': 'Success!', msg: 'Profile has been updated.' };
	          $state.go($state.current, { alerts: alert });
	        }, function (response) {
	          var formErrors = [];

	          if (angular.isDefined(response.data.errors.message)) {
	            formErrors = response.data.errors.message[0];
	          } else {
	            formErrors = response.data.errors;
	          }

	          angular.forEach(formErrors, function (value, key) {
	            var varkey = key.replace('data.', '');
	            userForm[varkey].$invalid = true;
	            userForm[varkey].customError = value[0];
	          });

	          _this2.formSubmitted = true;
	        });
	      } else {
	        this.formSubmitted = true;
	      }
	    }
	  }, {
	    key: '$onInit',
	    value: function $onInit() {}
	  }]);

	  return UserProfileController;
	}();

	var UserProfileComponent = exports.UserProfileComponent = {
	  templateUrl: './views/app/components/user-profile/user-profile.component.html',
	  controller: UserProfileController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 24 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var UserVerificationController = function () {
	  UserVerificationController.$inject = ["$stateParams"];
	  function UserVerificationController($stateParams) {
	    'ngInject';

	    _classCallCheck(this, UserVerificationController);

	    this.alerts = [];

	    if ($stateParams.status === 'success') {
	      this.alerts.push({ type: 'success', 'title': 'Success!', msg: 'Email Verification Success.' });
	    } else {
	      this.alerts.push({ type: 'danger', 'title': 'Error:', msg: 'Email verification failed.' });
	    }
	  }

	  _createClass(UserVerificationController, [{
	    key: '$onInit',
	    value: function $onInit() {}
	  }]);

	  return UserVerificationController;
	}();

	var UserVerificationComponent = exports.UserVerificationComponent = {
	  templateUrl: './views/app/components/user-verification/user-verification.component.html',
	  controller: UserVerificationController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 25 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var DashboardController = function DashboardController($scope) {
	  'ngInject';

	  _classCallCheck(this, DashboardController);

	  $scope.labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
	  $scope.series = ['Series A', 'Series B'];
	  $scope.data = [[65, 59, 80, 81, 56, 55, 40], [28, 48, 40, 19, 86, 27, 90]];

	  $scope.onClick = function () {};

	  $scope.pieLabels = ['Download Sales', 'In-Store Sales', 'Mail-Order Sales'];
	  $scope.pieData = [300, 500, 100];
	};
	DashboardController.$inject = ["$scope"];

	var DashboardComponent = exports.DashboardComponent = {
	  templateUrl: './views/app/components/dashboard/dashboard.component.html',
	  controller: DashboardController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 26 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var NavSidebarController = function () {
	  NavSidebarController.$inject = ["AclService", "ContextService"];
	  function NavSidebarController(AclService, ContextService) {
	    'ngInject';

	    _classCallCheck(this, NavSidebarController);

	    var navSideBar = this;
	    this.can = AclService.can;
	    this.hasRole = AclService.hasRole;

	    ContextService.me(function (data) {
	      navSideBar.userData = data;
	    });
	  }

	  _createClass(NavSidebarController, [{
	    key: '$onInit',
	    value: function $onInit() {}
	  }]);

	  return NavSidebarController;
	}();

	var NavSidebarComponent = exports.NavSidebarComponent = {
	  templateUrl: './views/app/components/nav-sidebar/nav-sidebar.component.html',
	  controller: NavSidebarController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 27 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var NavHeaderController = function () {
	  NavHeaderController.$inject = ["$rootScope", "ContextService"];
	  function NavHeaderController($rootScope, ContextService) {
	    'ngInject';

	    _classCallCheck(this, NavHeaderController);

	    var navHeader = this;

	    ContextService.me(function (data) {
	      navHeader.userData = data;
	    });
	  }

	  _createClass(NavHeaderController, [{
	    key: '$onInit',
	    value: function $onInit() {}
	  }]);

	  return NavHeaderController;
	}();

	var NavHeaderComponent = exports.NavHeaderComponent = {
	  templateUrl: './views/app/components/nav-header/nav-header.component.html',
	  controller: NavHeaderController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 28 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var LoginLoaderController = function LoginLoaderController($state, $auth, API, AclService) {
	  'ngInject';

	  _classCallCheck(this, LoginLoaderController);

	  API.oneUrl('authenticate').one('user').get().then(function (response) {
	    if (!response.error) {
	      var data = response.data;

	      angular.forEach(data.userRole, function (value) {
	        AclService.attachRole(value);
	      });

	      AclService.setAbilities(data.abilities);
	      $auth.setToken(data.token);
	      $state.go('app.landing');
	    }
	  });
	};
	LoginLoaderController.$inject = ["$state", "$auth", "API", "AclService"];

	var LoginLoaderComponent = exports.LoginLoaderComponent = {
	  templateUrl: './views/app/components/login-loader/login-loader.component.html',
	  controller: LoginLoaderController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 29 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var ResetPasswordController = function () {
	  ResetPasswordController.$inject = ["API", "$state"];
	  function ResetPasswordController(API, $state) {
	    'ngInject';

	    _classCallCheck(this, ResetPasswordController);

	    this.API = API;
	    this.$state = $state;
	    this.alerts = [];
	  }

	  _createClass(ResetPasswordController, [{
	    key: '$onInit',
	    value: function $onInit() {
	      this.password = '';
	      this.password_confirmation = '';
	      this.isValidToken = false;
	      this.formSubmitted = false;

	      this.verifyToken();
	    }
	  }, {
	    key: 'verifyToken',
	    value: function verifyToken() {
	      var _this = this;

	      var email = this.$state.params.email;
	      var token = this.$state.params.token;

	      this.API.all('auth/password').get('verify', {
	        email: email, token: token }).then(function () {
	        _this.isValidToken = true;
	      }, function () {
	        _this.$state.go('app.landing');
	      });
	    }
	  }, {
	    key: 'submit',
	    value: function submit(isValid) {
	      var _this2 = this;

	      if (isValid) {
	        this.alerts = [];
	        var data = {
	          email: this.$state.params.email,
	          token: this.$state.params.token,
	          password: this.password,
	          password_confirmation: this.password_confirmation
	        };

	        this.API.all('auth/password/reset').post(data).then(function () {
	          _this2.$state.go('login', { successMsg: 'Your password has been changed, You may now login.' });
	        }, function (res) {
	          var alrtArr = [];

	          angular.forEach(res.data.errors, function (value) {
	            alrtArr = { type: 'error', 'title': 'Error!', msg: value[0] };
	          });

	          _this2.alerts.push(alrtArr);
	        });
	      } else {
	        this.formSubmitted = true;
	      }
	    }
	  }]);

	  return ResetPasswordController;
	}();

	var ResetPasswordComponent = exports.ResetPasswordComponent = {
	  templateUrl: './views/app/components/reset-password/reset-password.component.html',
	  controller: ResetPasswordController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 30 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var ForgotPasswordController = function () {
	  ForgotPasswordController.$inject = ["API", "$state"];
	  function ForgotPasswordController(API, $state) {
	    'ngInject';

	    _classCallCheck(this, ForgotPasswordController);

	    this.API = API;
	    this.$state = $state;
	    this.formSubmitted = false;
	    this.serverError = '';
	  }

	  _createClass(ForgotPasswordController, [{
	    key: '$onInit',
	    value: function $onInit() {
	      this.email = '';
	    }
	  }, {
	    key: 'submit',
	    value: function submit() {
	      var _this = this;

	      this.serverError = '';

	      this.API.all('auth/password/email').post({
	        email: this.email
	      }).then(function () {
	        _this.$state.go('login', { successMsg: 'Please check your email for instructions on how to reset your password.' });
	      }, function (res) {
	        for (var error in res.data.errors) {
	          _this.serverError += res.data.errors[error] + ' ';
	        }
	        _this.formSubmitted = true;
	      });
	    }
	  }]);

	  return ForgotPasswordController;
	}();

	var ForgotPasswordComponent = exports.ForgotPasswordComponent = {
	  templateUrl: './views/app/components/forgot-password/forgot-password.component.html',
	  controller: ForgotPasswordController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 31 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var LoginFormController = function () {
	  LoginFormController.$inject = ["$rootScope", "$auth", "$state", "$stateParams", "API", "AclService"];
	  function LoginFormController($rootScope, $auth, $state, $stateParams, API, AclService) {
	    'ngInject';

	    _classCallCheck(this, LoginFormController);

	    delete $rootScope.me;

	    this.$auth = $auth;
	    this.$state = $state;
	    this.$stateParams = $stateParams;
	    this.AclService = AclService;

	    this.registerSuccess = $stateParams.registerSuccess;
	    this.successMsg = $stateParams.successMsg;
	    this.loginfailederror = '';
	    this.loginfailed = false;
	    this.unverified = false;
	  }

	  _createClass(LoginFormController, [{
	    key: '$onInit',
	    value: function $onInit() {
	      this.email = '';
	      this.password = '';
	    }
	  }, {
	    key: 'login',
	    value: function login() {
	      var _this = this;

	      this.loginfailederror = '';
	      this.loginfailed = false;
	      this.unverified = false;

	      var user = {
	        email: this.email,
	        password: this.password
	      };

	      this.$auth.login(user).then(function (response) {
	        var data = response.data.data;
	        var AclService = _this.AclService;

	        angular.forEach(data.userRole, function (value) {
	          AclService.attachRole(value);
	        });

	        AclService.setAbilities(data.abilities);
	        _this.$auth.setToken(response.data);
	        _this.$state.go('app.landing');
	      }).catch(this.failedLogin.bind(this));
	    }
	  }, {
	    key: 'failedLogin',
	    value: function failedLogin(res) {
	      if (res.status == 401) {
	        this.loginfailed = true;
	      } else {
	        if (res.data.errors.message[0] == 'Email Unverified') {
	          this.unverified = true;
	        } else {
	          // other kinds of error returned from server
	          for (var error in res.data.errors) {
	            this.loginfailederror += res.data.errors[error] + ' ';
	          }
	        }
	      }
	    }
	  }]);

	  return LoginFormController;
	}();

	var LoginFormComponent = exports.LoginFormComponent = {
	  templateUrl: './views/app/components/login-form/login-form.component.html',
	  controller: LoginFormController,
	  controllerAs: 'vm',
	  bindings: {}
	};

/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _fkColSortable = __webpack_require__(33);

	var _routeBodyclass = __webpack_require__(34);

	var _passwordVerify = __webpack_require__(35);

	angular.module('app.components').directive('routeBodyclass', _routeBodyclass.RouteBodyClassComponent).directive('passwordVerify', _passwordVerify.PasswordVerifyClassComponent).directive('fkColSortable', _fkColSortable.FkColSortableComponent);

/***/ }),
/* 33 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	// fkColSortable.$inject = ['$rootScope']
	function fkColSortable() /*$rootScope*/{
	    return {
	        templateUrl: './views/directives/fk-col-sortable/fk-col-sortable.component.html',
	        scope: {
	            orderBy: '=',
	            columnName: '=',
	            orderDirection: '='

	        },
	        link: function fkColSortableLink() /*scope, elem, attrs*/{
	            // $rootScope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState) { // eslint-disable-line angular/on-watch
	            //   let fromClassnames = angular.isDefined(fromState.data) && angular.isDefined(fromState.data.bodyClass) ? fromState.data.bodyClass : null
	            //   let toClassnames = angular.isDefined(toState.data) && angular.isDefined(toState.data.bodyClass) ? toState.data.bodyClass : null

	            //   if (fromClassnames != toClassnames) {
	            //     if (fromClassnames) {
	            //       elem.removeClass(fromClassnames)
	            //     }

	            //     if (toClassnames) {
	            //       elem.addClass(toClassnames)
	            //     }
	            //   }
	            // })
	        },
	        restrict: 'AE'
	    };
	}

	var FkColSortableComponent = exports.FkColSortableComponent = fkColSortable;

/***/ }),
/* 34 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	routeBodyClass.$inject = ['$rootScope'];
	function routeBodyClass($rootScope) {
	  return {
	    scope: { ngModel: '=ngModel' },
	    link: function routeBodyClassLink(scope, elem) {
	      $rootScope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState) {
	        // eslint-disable-line angular/on-watch
	        var fromClassnames = angular.isDefined(fromState.data) && angular.isDefined(fromState.data.bodyClass) ? fromState.data.bodyClass : null;
	        var toClassnames = angular.isDefined(toState.data) && angular.isDefined(toState.data.bodyClass) ? toState.data.bodyClass : null;

	        if (fromClassnames != toClassnames) {
	          if (fromClassnames) {
	            elem.removeClass(fromClassnames);
	          }

	          if (toClassnames) {
	            elem.addClass(toClassnames);
	          }
	        }
	      });
	    },
	    restrict: 'EA'
	  };
	}

	var RouteBodyClassComponent = exports.RouteBodyClassComponent = routeBodyClass;

/***/ }),
/* 35 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	function passwordVerifyClass() {
	  return {
	    require: 'ngModel',
	    scope: {
	      passwordVerify: '='
	    },
	    link: function link(scope, element, attrs, ctrl) {
	      scope.$watch(function () {
	        var combined;

	        if (scope.passwordVerify || ctrl.$viewValue) {
	          combined = scope.passwordVerify + '_' + ctrl.$viewValue;
	        }

	        return combined;
	      }, function (value) {
	        if (value) {
	          ctrl.$parsers.unshift(function (viewValue) {
	            var origin = scope.passwordVerify;

	            if (origin !== viewValue) {
	              ctrl.$setValidity('passwordVerify', false);
	              return undefined;
	            } else {
	              ctrl.$setValidity('passwordVerify', true);
	              return viewValue;
	            }
	          });
	        }
	      });
	    }
	  };
	}

	var PasswordVerifyClassComponent = exports.PasswordVerifyClassComponent = passwordVerifyClass;

/***/ }),
/* 36 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _Client = __webpack_require__(37);

	var _Utils = __webpack_require__(38);

	var _Route = __webpack_require__(39);

	var _context = __webpack_require__(40);

	var _API = __webpack_require__(41);

	angular.module('app.services').service('ClientService', _Client.ClientService).service('UtilsService', _Utils.UtilsService).service('RouteService', _Route.RouteService).service('ContextService', _context.ContextService).service('API', _API.APIService);

/***/ }),
/* 37 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var ClientService = exports.ClientService = function () {
	    ClientService.$inject = ["toaster"];
	    function ClientService(toaster) {
	        'ngInject';

	        _classCallCheck(this, ClientService);

	        this.toaster = toaster;
	        this.getTitle = function (alert, defaultTitle) {
	            var result = defaultTitle;
	            if (alert !== null && angular.isDefined(alert)) {
	                if (alert.title !== null && angular.isDefined(alert.title)) {
	                    result = alert.title;
	                }
	            }

	            return result;
	        };
	    }

	    /**
	     * Show alert
	     * @param  {Object, List} alerts List alert or one
	     * @return {None} 
	     */


	    _createClass(ClientService, [{
	        key: 'show',
	        value: function show(alerts) {

	            if (alerts === null || angular.isUndefined(alerts)) {
	                return;
	            }

	            if (angular.isArray(alerts)) {
	                var len = alerts.length;
	                for (var i = 0; i < len; i++) {
	                    this.showOne(alerts[i]);
	                }
	            } else {
	                this.showOne(alerts);
	            }
	        }

	        /**
	         * Show alert
	         * Format: alert = { type: 'success', 'title': 'Success!', msg: 'Your message here' }
	         * Type: success, info, warning
	         * @param  {Object} alerts List alert or one
	         * @return {None} 
	         */

	    }, {
	        key: 'showOne',
	        value: function showOne(alert) {
	            if (alert === null || angular.isUndefined(alert)) {
	                return;
	            }

	            var type = alert.type;
	            var body = "";
	            if (type === 'success') {
	                var title = this.getTitle(alert, 'Success!');
	                this.toaster.pop(type, title, body, 5000, 'trustedHtml');
	            } else if (type === 'info') {
	                var _title = this.getTitle(alert, 'Infomation!');
	                this.toaster.pop(type, _title, body, 5000, 'trustedHtml');
	            } else if (type === 'warning') {
	                var _title2 = this.getTitle(alert, 'Warning!');
	                this.toaster.pop(type, _title2, body, 5000, 'trustedHtml');
	            } else if (type === 'error') {
	                var _title3 = this.getTitle(alert, 'Error!');
	                this.toaster.pop(type, _title3, body, 60000, 'trustedHtml');
	            }
	        }
	    }, {
	        key: 'success',
	        value: function success(body) {
	            this.toaster.pop('success', "Success", body, 5000, 'trustedHtml');
	        }
	    }, {
	        key: 'error',
	        value: function error(body) {
	            this.toaster.pop('error', "Error", body, 60000, 'trustedHtml');
	        }
	    }, {
	        key: 'warning',
	        value: function warning(body) {
	            this.toaster.pop('warning', "Warning", body, 5000, 'trustedHtml');
	        }
	    }]);

	    return ClientService;
	}();

/***/ }),
/* 38 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var UtilsService = exports.UtilsService = function () {
	    function UtilsService() {
	        'ngInject';

	        _classCallCheck(this, UtilsService);
	    }

	    /**
	     * Get Order by
	     * @param  {[type]} newOrderBy            [description]
	     * @param  {[type]} currentOrderBy        [description]
	     * @param  {[type]} currentOrderDirection [description]
	     * @return {[type]}                       [description]
	     */


	    _createClass(UtilsService, [{
	        key: 'getOrderBy',
	        value: function getOrderBy(newOrderBy, currentOrderBy, currentOrderDirection) {
	            var result = {
	                orderBy: currentOrderBy,
	                orderDirection: currentOrderDirection
	            };

	            if (newOrderBy === currentOrderBy) {
	                if (currentOrderDirection !== 'asc') {
	                    result.orderDirection = "asc";
	                } else {
	                    result.orderDirection = "desc";
	                }
	            } else {
	                result.orderBy = newOrderBy;
	                result.orderDirection = "asc";
	            }

	            return result;
	        }
	    }, {
	        key: 'joinMessageList',
	        value: function joinMessageList(list) {
	            var result = "";
	            if (angular.isDefined(list) && list != null) {
	                var isFirst = true;
	                angular.forEach(list, function (value) {
	                    if (isFirst) {
	                        result = value;
	                    } else {
	                        result = result + "\r\n" + value;
	                    }
	                });
	            }
	            return result;
	        }
	    }]);

	    return UtilsService;
	}();

/***/ }),
/* 39 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var RouteService = exports.RouteService = function () {
	    RouteService.$inject = ["$state", "$stateParams", "$rootScope", "$log"];
	    function RouteService($state, $stateParams, $rootScope, $log) {
	        'ngInject';

	        _classCallCheck(this, RouteService);

	        this.$state = $state;
	        this.$rootScope = $rootScope;
	        this.$log = $log;
	    }

	    _createClass(RouteService, [{
	        key: 'goState',
	        value: function goState(state, params, options) {
	            var $rootScope = this.$rootScope;
	            var $log = this.$log;
	            var $state = this.$state;

	            var destroyListener = $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {

	                $log.debug(event);
	                $log.debug(toState);
	                $log.debug(toParams);
	                $log.debug(fromState);
	                $log.debug(fromParams);
	                $.extend(true, toParams, params);
	                destroyListener();
	            });

	            return $state.go(state, params, options);
	        }
	    }]);

	    return RouteService;
	}();

/***/ }),
/* 40 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var ContextService = exports.ContextService = function () {
	  ContextService.$inject = ["$auth", "$rootScope", "API"];
	  function ContextService($auth, $rootScope, API) {
	    'ngInject';

	    _classCallCheck(this, ContextService);

	    this.$auth = $auth;
	    this.API = API;
	    this.$rootScope = $rootScope;
	  }

	  _createClass(ContextService, [{
	    key: 'getContext',
	    value: function getContext() {
	      var $auth = this.$auth;

	      if ($auth.isAuthenticated()) {
	        var API = this.API;
	        var UserData = API.service('me', API.all('users'));

	        return UserData.one().get();
	      } else {
	        return null;
	      }
	    }
	  }, {
	    key: 'me',
	    value: function me(cb) {
	      this.$rootScope.$watch('me', function (nv) {
	        cb(nv);
	      });
	    }
	  }]);

	  return ContextService;
	}();

/***/ }),
/* 41 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var APIService = exports.APIService = ["Restangular", "$window", "$log", "ClientService", function APIService(Restangular, $window, $log, ClientService) {
	  'ngInject';
	  // content negotiation

	  _classCallCheck(this, APIService);

	  var headers = {
	    'Content-Type': 'application/json',
	    'Accept': 'application/x.laravel.v1+json'
	  };

	  return Restangular.withConfig(function (RestangularConfigurer) {
	    RestangularConfigurer.setBaseUrl('/api/').setDefaultHeaders(headers).setErrorInterceptor(function (response) {
	      // if (response.status === 422) {
	      //   for (var error in response.data.errors) {
	      //     return ClientService.error(response.data.errors[error][0])
	      //   }
	      // }
	      $log.debug('[Error]', response);
	      if (response.status !== 422) {
	        ClientService.error(response.statusText);
	      }
	    }).addFullRequestInterceptor(function (element, operation, what, url, headers) {
	      $log.debug('[Request]', element, operation, what, url, headers);
	      var token = $window.localStorage.satellizer_token;
	      if (token) {
	        headers.Authorization = 'Bearer ' + token;
	      }
	    }).addResponseInterceptor(function (response, operation, what) {
	      $log.debug('[Response]', operation, what, response);
	      if (operation === 'getList') {
	        var newResponse = response.data[what];
	        newResponse.error = response.error;
	        return newResponse;
	      }

	      return response;
	    });
	  });
	}];

/***/ })
/******/ ]);