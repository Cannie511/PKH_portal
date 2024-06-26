export function TranslateConfig($translateProvider) {
    'ngInject';

    //$translateProvider.useSanitizeValueStrategy('sanitize');
    $translateProvider.useSanitizeValueStrategy('escaped');
    $translateProvider.useStaticFilesLoader({
        prefix: '/backend/lang/',
        suffix: '.json'
    });

    var defaultLang = "en";
    $translateProvider.preferredLanguage(defaultLang)
        .fallbackLanguage(defaultLang);
    //$translateProvider.forceAsyncReload(true);
    //$translateProvider.useLocalStorage();
}