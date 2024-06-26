export function AppConfig($compileProvider, $logProvider, uibPaginationConfig){
    'ngInject';

    // compile config
    $compileProvider.debugInfoEnabled(false);

    // log config
    $logProvider.debugEnabled(true);

    // Set pagination
    uibPaginationConfig.boundaryLinks = true;
    uibPaginationConfig.firstText = "«";
    uibPaginationConfig.lastText = "»";
    uibPaginationConfig.nextText = "›";
    uibPaginationConfig.previousText = "‹";
    uibPaginationConfig.numPage = "numPages";
    uibPaginationConfig.maxSize = 5;
    uibPaginationConfig.rotate = false;
}
