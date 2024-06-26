// fkColSortable.$inject = ['$rootScope']
function fkColSortable( /*$rootScope*/ ) {
    return {
        templateUrl: './views/directives/fk-col-sortable/fk-col-sortable.component.html',
        scope: {
            orderBy: '=',
            columnName: '=',
            orderDirection: '='

        },
        link: function fkColSortableLink( /*scope, elem, attrs*/ ) {
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
    }
}

export const FkColSortableComponent = fkColSortable