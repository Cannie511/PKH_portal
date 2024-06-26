<!doctype html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<%% asset_url('css/final.css?'.ah_js_version()) %%>">
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <title>Phan Khang Home Portal</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <script async src="https://googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script> -->
    <script src="<%% asset_url('js/markerclusterer.js') %%>" async defer></script>
</head>
<body route-bodyclass>
    <div class="wrapper">
        <div ui-view="layout"></div>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
    function getContextPath() {
        <?php
        $contextPath = url("/"); 
        if( !ends_with($contextPath, '/')) {
            $contextPath = $contextPath . "/";
        }
        echo "return '" . $contextPath . "';";
        ?>
    }
    function getEnv() {
        let URL_WWW = "<?php echo env('URL_WWW','https://wwww.phankhangco.com'); ?>";

        return {
            URL_WWW
        }
    }
    </script>
    <script src="<%% asset_url('js/final.js?'.ah_js_version()) %%>" async defer></script>
</body>
</html>
