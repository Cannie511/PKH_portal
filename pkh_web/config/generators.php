<?php

return [
      'source' => [
            'root'            => 'angular',
            'page'            => 'app/pages',
            'components'      => 'app/components',
            'directives'      => 'directives',
            'config'          => 'config',
            'dialogs'         => 'dialogs',
            'filters'         => 'filters',
            'services'        => 'services',
      ],
      'suffix' => [
            'component'       => '.component.js',
            'componentView'   => '.component.html',
            'dialog'          => '.dialog.js',
            'dialogView'      => '.dialog.html',
            'directive'       => '.directive.js',
            'service'         => '.service.js',
            'config'          => '.config.js',
            'filter'          => '.filter.js',
            'pageView'        => '.page.html',
            'stylesheet'      => 'scss', // less, scss or css
      ],
      'tests' => [
            'enable' => [
                'components'      => false,
                'services'        => false,
                'directives'      => false,
            ],
            'source' => [
                'root'            => 'tests/angular/',
                'components'      => 'app/components',
                'directives'      => 'directives',
                'services'        => 'services',
            ],
      ],
      'misc' => [
            'auto_import'         => true,
      ],
      'php' => [
            'controller'          => 'app/Http/Controllers/Admin',
            'command'             => 'app/Console/Commands',
            'service'             => 'app/Services',
            'view'                => 'resources/views/views/admin',
      ]
];
