<?php

use Joaopaulolndev\FilamentGeneralSettings\Enums\TypeFieldEnum;

return [
    'show_application_tab' => true,
    'show_analytics_tab' => false,
    'show_seo_tab' => false,
    'show_email_tab' => false,
    'show_social_networks_tab' => false,
    'expiration_cache_config_time' => 60,
    'show_custom_tabs'=> true,
    'custom_tabs' => [
        'more_configs' => [
            'label' => 'Больше конфигураций',
            'icon' => 'heroicon-o-plus-circle',
            'columns' => 1,
            'fields' => [
                'offer' => [
                    'type' => TypeFieldEnum::Boolean->value,
                    'label' => 'Спец предложения',
                    'placeholder' => 'Boolean'
                ],
            ]
        ],
    ]
];
