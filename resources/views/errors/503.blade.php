@include('errors.minimal', [
    'code' => 503,
    'title' => 'Service Unavailable',
    'message' => $exception->getMessage() ?: 'We are performing scheduled maintenance. Please check back soon.',
    'svg' => '503.svg',
])
