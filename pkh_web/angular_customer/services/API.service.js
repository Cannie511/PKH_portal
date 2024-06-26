export class APIService {
  constructor (Restangular, $window, $log, ClientService) {
    'ngInject'
    // content negotiation
    var headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/x.laravel.v1+json'
    }

    return Restangular.withConfig(function (RestangularConfigurer) {
      RestangularConfigurer
        .setBaseUrl('/api/')
        .setDefaultHeaders(headers)
        .setErrorInterceptor(function (response) {
          // if (response.status === 422) {
          //   for (var error in response.data.errors) {
          //     return ClientService.error(response.data.errors[error][0])
          //   }
          // }
          $log.debug('[Error]', response);
          if (response.status !== 422) {
            ClientService.error(response.statusText)
          }
        })
        .addFullRequestInterceptor(function (element, operation, what, url, headers) {
          $log.debug('[Request]', element, operation, what, url, headers);
          var token = $window.localStorage.satellizer_token
          if (token) {
            headers.Authorization = 'Bearer ' + token
          }
        })
        .addResponseInterceptor(function (response, operation, what) {
          $log.debug('[Response]', operation, what, response);
          if (operation === 'getList') {
            var newResponse = response.data[what]
            newResponse.error = response.error
            return newResponse
          }

          return response
        })
    })
  }
}
