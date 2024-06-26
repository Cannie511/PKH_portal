export function SubstrFilter () {
  return function (input, begin, length) {
    return input == null ? '': input.substr(begin, length);
  }
}
