import { DialogService } from './services/dialog.service';
import { ClientService } from './services/Client.service';
import { UtilsService } from './services/Utils.service';
import { RouteService } from './services/Route.service';
import { ContextService } from './services/context.service'
import { APIService } from './services/API.service'
import { ChartService } from './services/chart.service'


// import { StoreDialogController } from './dialogs/store_dialog/store_dialog.dialog'

angular.module('app.services')
    .service('DialogService', DialogService)
    .service('ClientService', ClientService)
    .service('UtilsService', UtilsService)
    .service('RouteService', RouteService)
    .service('ContextService', ContextService)
    .service('API', APIService)
    .service('ChartService', ChartService)
    // .controller('StoreDialogController', StoreDialogController)