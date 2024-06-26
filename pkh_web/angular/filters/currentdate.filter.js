export function CurrentDateFilter ($filter) {
  'ngInject'
  return function () {
    return $filter('date')(new Date(), 'yyyy-MM-dd')
  }
}
