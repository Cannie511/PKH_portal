import { DateMillisFilter } from './filters/date_millis.filter'
import { CapitalizeFilter } from './filters/capitalize.filter'
import { HumanReadableFilter } from './filters/human_readable.filter'
import { TruncatCharactersFilter } from './filters/truncate_characters.filter'
import { TruncateWordsFilter } from './filters/truncate_words.filter'
import { TrustHtmlFilter } from './filters/trust_html.filter'
import { UcFirstFilter } from './filters/ucfirst.filter'
import { CurrentDateFilter } from './filters/currentdate.filter'

angular.module('app.filters')
  .filter('datemillis', DateMillisFilter)
  .filter('capitalize', CapitalizeFilter)
  .filter('humanreadable', HumanReadableFilter)
  .filter('truncateCharacters', TruncatCharactersFilter)
  .filter('truncateWords', TruncateWordsFilter)
  .filter('trustHtml', TrustHtmlFilter)
  .filter('ucfirst', UcFirstFilter)
  .filter('currentdate', CurrentDateFilter)