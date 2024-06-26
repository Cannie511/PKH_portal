// fkColSortable.$inject = ['$rootScope']
function fkColSortable (/*$rootScope*/) {
  return {
    templateUrl: './views/directives/fk-col-sortable/fk-col-sortable.component.html',
    scope: {
            orderBy:'=orderBy',
            columnName: '@columnName',
            orderDirection: '=orderDirection'
    },
    link: function fkColSortableLink (/*scope, elem, attrs*/) {
    },
    restrict: 'AE'
  }
}

export const FkColSortableComponent = fkColSortable
