import { ClientService } from './services/Client.service';
import { UtilsService } from './services/Utils.service';
import { RouteService } from './services/Route.service';
import { ContextService } from './services/context.service'
import { APIService } from './services/API.service'

angular.module('app.services')
    .service('ClientService', ClientService)
    .service('UtilsService', UtilsService)
    .service('RouteService', RouteService)
    .service('ContextService', ContextService)
    .service('API', APIService)