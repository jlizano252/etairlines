<?php

return [
    'allowed_ides' => array_filter(
        array_map('trim', explode(',', env('TSE_IMPORT_ALLOWED_IDES', '')))
    ),
];
