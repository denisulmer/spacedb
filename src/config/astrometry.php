<?php

return [
    'urls' => [
        'login' => 'http://nova.astrometry.net/api/login',
        'file_upload' => 'http://nova.astrometry.net/api/upload',
        'url_upload' => 'http://nova.astrometry.net/api/url_upload',
        'jobs' => 'http://nova.astrometry.net/api/jobs',
        'submissions' => 'http://nova.astrometry.net/api/submissions',
    ],
    'api' => [
        'key' => 'onrzjwhexanvawbe',
    ],
    'imagecache' => [
        'filter' => 'astrometry'
    ],
    'upload_data' => [
        'downsample_factor' => 2,
        'publicly_visible' => 'n'
    ]
];