import { FkColSortableComponent } from './directives/fk-col-sortable/fk-col-sortable.component';
import { RouteBodyClassComponent } from './directives/route-bodyclass/route-bodyclass.component'
import { PasswordVerifyClassComponent } from './directives/password-verify/password-verify.component'
import { AmchartDirective } from './directives/amchart/amchart.directive'

angular.module('app.components')
    .directive('routeBodyclass', RouteBodyClassComponent)
    .directive('passwordVerify', PasswordVerifyClassComponent)
    .directive('fkColSortable', FkColSortableComponent)
    .directive('amchart', AmchartDirective)