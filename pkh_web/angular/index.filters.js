import { DateMillisFilter } from './filters/date_millis.filter'
import { CapitalizeFilter } from './filters/capitalize.filter'
import { HumanReadableFilter } from './filters/human_readable.filter'
import { TruncatCharactersFilter } from './filters/truncate_characters.filter'
import { TruncateWordsFilter } from './filters/truncate_words.filter'
import { TrustHtmlFilter } from './filters/trust_html.filter'
import { UcFirstFilter } from './filters/ucfirst.filter'
import { DayOfWeekFilter } from './filters/day_of_week.filter'
import { CurrentDateFilter } from './filters/currentdate.filter'
import { ImgThumbFilter } from './filters/img_thumb.filter'
import { SubstrFilter } from './filters/substr.filter'
import { Crm0810PriceFilter } from './app/components/crm0810/crm0810.price.filter'
import { Crm2820TotalFilter } from './app/components/crm2820/crm2820.total.filter'

angular.module('app.filters')
    .filter('datemillis', DateMillisFilter)
    .filter('capitalize', CapitalizeFilter)
    .filter('humanreadable', HumanReadableFilter)
    .filter('truncateCharacters', TruncatCharactersFilter)
    .filter('truncateWords', TruncateWordsFilter)
    .filter('trustHtml', TrustHtmlFilter)
    .filter('ucfirst', UcFirstFilter)
    .filter('currentdate', CurrentDateFilter)
    .filter('dayOfWeek', DayOfWeekFilter)
    .filter('imgThumb', ImgThumbFilter)
    .filter('substr', SubstrFilter)
    .filter('crm0810Price', Crm0810PriceFilter)
    .filter('crm2820Total', Crm2820TotalFilter)