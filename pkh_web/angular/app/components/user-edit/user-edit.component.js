class UserEditController {
    constructor($stateParams, $state, API, $log) {
        'ngInject'

        this.$state = $state
        this.formSubmitted = false
        this.alerts = []
        this.$log = $log;
        this.userRolesSelected = []

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }

        let userId = $stateParams.userId

        let Roles = API.service('roles', API.all('users'))
        Roles.getList()
            .then((response) => {
                let systemRoles = []

                let roleResponse = response.plain()
                this.$log.info('check', response.plain())
                angular.forEach(roleResponse, function(value) {
                    systemRoles.push({ id: value.id, name: value.name })
                })

                this.systemRoles = systemRoles
            })

        let Branches = API.service('branches', API.all('users'))
        Branches.getList()
            .then((response) => {
                let systemBranches = []
                let branchResponse = response.plain()
                this.$log.info('check', response.plain())
                angular.forEach(branchResponse, function(value) {
                    systemBranches.push({ id: value.branch_id, name: value.branch_name })
                })

                this.systemBranches = systemBranches
            })

        let UserData = API.service('show', API.all('users'))
        UserData.one(userId).get()
            .then((response) => {
                let userRole = []
                let userResponse = response.plain()

                angular.forEach(userResponse.data.role, function(value) {
                    userRole.push(value.id)
                })
                response.data.branch = userResponse.data.branch_id
                response.data.role = userRole
                response.data.email_verified = response.data.email_verified === '1' ? 1 : 0;
                this.usereditdata = API.copy(response)
            })
    }

    save(isValid) {
        if (isValid) {
            let $state = this.$state
            this.usereditdata.put()
                .then(() => {
                    let alert = { type: 'success', 'title': 'Success!', msg: 'User has been updated.' }
                    $state.go($state.current, { alerts: alert })
                }, (response) => {
                    let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                    $state.go($state.current, { alerts: alert })
                })
        } else {
            this.formSubmitted = true
        }
    }

    $onInit() {}
}

export const UserEditComponent = {
    templateUrl: './views/app/components/user-edit/user-edit.component.html',
    controller: UserEditController,
    controllerAs: 'vm',
    bindings: {}
}