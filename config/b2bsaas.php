<?php

// Path: b2bsaas/src/config/b2bsaas.php

return [

    'url_scheme' => env('APP_URL_SCHEME', 'http'),

    'default_team_database_connection_template' => env(
        'DEFAULT_TEAM_DATABASE_CONNECTION_TEMPLATE', 
        class_exists('\App\TeamDatabaseType')
        ? \App\TeamDatabaseType::tenant_sqlite->name
        : 'tenant_sqlite'
    ),

    'features' => [
        'invitation_only' => env('B2BSAAS_INVITATION_ONLY', true),
        'create_team_databases' => env('B2BSAAS_CREATE_TEAM_DATABASES', true),
        'team_logos' => env('B2BSAAS_TEAM_LOGOS', false),
        'team_contact_info' => env('B2BSAAS_TEAM_CONTACT_INFO', false),
        'team_landing_page' => env('B2BSAAS_TEAM_LANDING_PAGE', false),
    ],

    /**
     * The name of the database connection to use for the team databases.
     * This is only needed if the create_team_databases feature is disabled.
     */
    'team_database' => env('B2BSAAS_TEAM_DATABASE'),

    'company' => [
        'empty_logo_path' => 'profile-photos/no_image.jpg',
        'empty_phone' => '(_ _ _) _ _ _- _ _ _ _',
        'empty_fax' => '(_ _ _) _ _ _- _ _ _ _',
        'logo_path' => env('COMPANY_LOGO_PATH'), //resource_path('legacy/qwoffice/print/DigLogo.jpg'
        'name' => env('COMPANY_NAME'),
        'phone' => env('COMPANY_PHONE_NUMBER'),
        'fax' => env('COMPANY_FAX_NUMBER'),
        'street_address' => env('COMPANY_STREET_ADDRESS'),
        'city_state_zip' => env('COMPANY_CITY_STATE_ZIP'),
        'email' => env('COMPANY_EMAIL'),
    ],
];
