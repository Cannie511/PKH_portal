class NavSidebarController {
    constructor(AclService, ContextService) {
        'ngInject'

        let navSideBar = this
        this.can = AclService.can

        ContextService.me(function(data) {
            navSideBar.userData = data
        })
    }

    $onInit() {}
}

export const NavSidebarComponent = {
    // templateUrl: './views/app/components/nav-sidebar/nav-sidebar.component.html',
    templateUrl: '/views/admin.nav-sidebar',
    controller: NavSidebarController,
    controllerAs: 'vm',
    bindings: {}
}