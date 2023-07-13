<?php

return [
    'status_code' => [
        'not_found' => 204,
        'success' => 200,
        'server_error' => 500,
        'validation_error' => 401
    ],
    'otp_expiration_min' => 1,
    'secret_key' => 'umasetu',
    'file' => [
        'proof_file_path' => 'upload/proof',
        'user_file_path' => 'upload/user'
    ],
   
];
?>