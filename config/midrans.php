<?php

return [
    'serverKey'     => env('MIDTRANS_SERVER_KEY'),
    'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
    'isProduction'  => false, // true kalau nanti LIVE
    'isSanitized'   => true,
    'is3ds'         => true,
];
