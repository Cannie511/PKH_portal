export function AclConfig (AclServiceProvider) {
  'ngInject'

  var myConfig = {
    //storage: 'localStorage',
    storage: 'sessionStorage',
    storageKey: 'AppAcl'
  }

  /*eslint-disable */
  AclServiceProvider.config(myConfig)
/*eslint-enable */
}
