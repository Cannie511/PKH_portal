export class APIService {
  constructor (Restangular, $window, $log, ClientService, RouteService) {
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
          $log.debug('[Error]', response);
          if (response.status === 422) {
            ClientService.warning("Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.")
          } else if (response.status === 401) {
            RouteService.goState("login")
            ClientService.error("Vui lòng đăng nhập lại")
          } else if (response.status === 503) {
            ClientService.error("Bạn không có quyền để thực hiện chức năng này")
          } else {
            ClientService.error(response.statusText)
          }
        })
        .addFullRequestInterceptor(function (element, operation, what, url, headers) {
          $log.debug('[Request]', element, operation, what, url, headers);
          var token = $window.localStorage.satellizer_token;
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
