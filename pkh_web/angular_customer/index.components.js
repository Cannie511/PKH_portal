import { Cus0110Component } from "./app/components/cus0110/cus0110.component";
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
import { UserProfileComponent } from "./app/components/user-profile/user-profile.component";
import { UserVerificationComponent } from "./app/components/user-verification/user-verification.component";
// import { ComingSoonComponent } from './app/components/coming-soon/coming-soon.component'
// import { UserEditComponent } from './app/components/user-edit/user-edit.component'
// import { UserPermissionsEditComponent } from './app/components/user-permissions-edit/user-permissions-edit.component'
// import { UserPermissionsAddComponent } from './app/components/user-permissions-add/user-permissions-add.component'
// import { UserPermissionsComponent } from './app/components/user-permissions/user-permissions.component'
// import { UserRolesEditComponent } from './app/components/user-roles-edit/user-roles-edit.component'
// import { UserRolesAddComponent } from './app/components/user-roles-add/user-roles-add.component'
// import { UserRolesComponent } from './app/components/user-roles/user-roles.component'
// import { UserListsComponent } from './app/components/user-lists/user-lists.component'
import { DashboardComponent } from "./app/components/dashboard/dashboard.component";
import { NavSidebarComponent } from "./app/components/nav-sidebar/nav-sidebar.component";
import { NavHeaderComponent } from "./app/components/nav-header/nav-header.component";
import { LoginLoaderComponent } from "./app/components/login-loader/login-loader.component";
import { ResetPasswordComponent } from "./app/components/reset-password/reset-password.component";
import { ForgotPasswordComponent } from "./app/components/forgot-password/forgot-password.component";
import { LoginFormComponent } from "./app/components/login-form/login-form.component";
// import { RegisterFormComponent } from './app/components/register-form/register-form.component'

angular
    .module("app.components")
    .component("cus0110", Cus0110Component)
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
    .component("userProfile", UserProfileComponent)
    .component("userVerification", UserVerificationComponent)
    // .component('comingSoon', ComingSoonComponent)
    // .component('userEdit', UserEditComponent)
    // .component('userPermissionsEdit', UserPermissionsEditComponent)
    // .component('userPermissionsAdd', UserPermissionsAddComponent)
    // .component('userPermissions', UserPermissionsComponent)
    // .component('userRolesEdit', UserRolesEditComponent)
    // .component('userRolesAdd', UserRolesAddComponent)
    // .component('userRoles', UserRolesComponent)
    // .component('userLists', UserListsComponent)
    .component("dashboard", DashboardComponent)
    .component("navSidebar", NavSidebarComponent)
    .component("navHeader", NavHeaderComponent)
    .component("loginLoader", LoginLoaderComponent)
    .component("resetPassword", ResetPasswordComponent)
    .component("forgotPassword", ForgotPasswordComponent)
    .component("loginForm", LoginFormComponent);
// .component('registerForm', RegisterFormComponent)
