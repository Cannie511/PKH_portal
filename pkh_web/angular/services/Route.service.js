export class RouteService {
    constructor($state, $stateParams, $rootScope, $log) {
        'ngInject';
        this.$state = $state
        this.$rootScope = $rootScope
        this.$log = $log
    }

    goState(state, params, options) {
        let $rootScope = this.$rootScope
        let $log = this.$log
        let $state = this.$state 
        var destroyListener = $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
            // $log.debug(event)
            // $log.debug(toState)
            // $log.debug(toParams)
            // $log.debug(fromState)
            // $log.debug(fromParams)
            $.extend(true, toParams, params)
            destroyListener();
        });
        return $state.go(state, params, options);
    }
}
