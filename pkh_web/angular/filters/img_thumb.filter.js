export function ImgThumbFilter () {
  'ngInject'
  return function (val) {
    if (val == null || val.length == 0) 
      return null;
    let index = val.lastIndexOf('/');
    if( index > 0 ) {
      val = val.substr(0, index) + '/thumb' + val.substr(index);
    }
    return val;
  }
}
