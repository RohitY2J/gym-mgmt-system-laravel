<?php

class ROLE {
    const USER = '0';
    const ADMIN= '1';
}

return [
    'APP_NAME' => 'My Application',
    'API_BASE_URL' => 'http://example.com/api',
    'ROLE' => ROLE::class,
    // Add more constants as needed
];