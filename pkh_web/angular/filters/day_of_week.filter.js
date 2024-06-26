export function DayOfWeekFilter () {
  'ngInject'
  return function (val) {
    var d = new Date(val);
    var n = d.getDay();

    var weekday = "";
    switch(n) {
      case 0:
        weekday = 'Chủ Nhật'
        break;
      case 1:
        weekday = 'Thứ Hai'
        break;
      case 2:
        weekday = 'Thứ Ba'
        break;
      case 3:
        weekday = 'Thứ Tư'
        break;
      case 4:
        weekday = 'Thứ Năm'
        break;
      case 5:
        weekday = 'Thứ Sáu'
        break;
      case 6:
        weekday = 'Thứ Bảy'
        break;
    }

    return weekday;
  }
}
