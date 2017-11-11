<?php

return [
    'errors'  => [
        'unknown'        => [
            'code'       => 1000,
            'message'    => 'Unknown Error',
            'statusCode' => 400,
        ],
        'notFound'       => [
            'code'       => 1001,
            'message'    => 'Not Found',
            'statusCode' => 400,
        ],
        'authFailed'     => [
            'code'       => 1002,
            'message'    => 'Auth Failed',
            'statusCode' => 401,
        ],
        'signInFailed'     => [
            'code'       => 1012,
            'message'    => 'Please check email or password',
            'statusCode' => 401,
        ],
        'signInRequired' => [
            'code'       => 1003,
            'message'    => 'Sign In Required',
            'statusCode' => 401,
        ],
        'wrongParameter' => [
            'code'        => 1004,
            'message'     => 'Wrong Parameters',
            'statusCode' => 400,
        ],
        'severError'     => [
            'code'       => 1005,
            'message'    => 'Server error',
            'statusCode' => 500,
        ],
        'saveError'     => [
            'code'       => 1006,
            'message'    => 'Save error',
            'statusCode' => 500,
        ],
        'operationNotAllowed'     => [
            'code'       => 1007,
            'message'    => 'You can not do this operation',
            'statusCode' => 403,
        ],
        'groupOwnerRequired' => [
            'code'       => 3001,
            'message'    => 'Group owner can do this operation',
            'statusCode' => 403,
        ],
        'groupNotMember' => [
            'code'       => 3002,
            'message'    => 'You are not member of this group',
            'statusCode' => 400,
        ],
        'groupOwnerCanNotLeave' => [
            'code'       => 3003,
            'message'    => 'You are group owner and cannot leave this group',
            'statusCode' => 400,
        ],
        'groupAlreadyMember' => [
            'code'       => 3004,
            'message'    => 'You are already a member of this group',
            'statusCode' => 400,
        ],
        'groupIsNotPublic' => [
            'code'       => 3005,
            'message'    => 'This group is not public',
            'statusCode' => 400,
        ],
    ],
    'validateErrors' => [
    ],
    'headers' => [
        'locale'    => 'X-ACTISSO-LOCALE',
        'version'   => 'X-ACTISSO-VERSION',
        'osType'    => 'X-ACTISSO-OS-VERSION',
        'osVersion' => 'X-ACTISSO-OS-TYPE',
    ],
];
