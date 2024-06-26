class UserPermissionsAddController {
  constructor (API, $state, $stateParams, $log) {
    'ngInject'

    this.$state = $state
    this.formSubmitted = false
    this.API = API
    this.alerts = []
    this.$log = $log

    $log.debug('UserPermissionsAddController')
    if ($stateParams.alerts) {
      $log.debug('show alert')
      this.alerts.push($stateParams.alerts)
    }
  }

  save (isValid) {
    this.$state.go(this.$state.current, {}, { alerts: 'test' })
    if (isValid) {
      let Permissions = this.API.service('permissions', this.API.all('users'))
      let $state = this.$state
      let $log = this.$log

      Permissions.post({
        'name': this.name,
        'slug': this.slug,
        'description': this.description
      }).then(function () {
        $log.debug('OK')
        let alert = { type: 'success', 'title': 'Success!', msg: 'Permission has been added.' }
        $state.go($state.current, { alerts: alert})
      }, function (response) {
        let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
        $state.go($state.current, { alerts: alert})
      })
    } else {
      this.formSubmitted = true
    }
  }

  $onInit () {}
}

export const UserPermissionsAddComponent = {
  templateUrl: './views/app/components/user-permissions-add/user-permissions-add.component.html',
  controller: UserPermissionsAddController,
  controllerAs: 'vm',
  bindings: {}
}
