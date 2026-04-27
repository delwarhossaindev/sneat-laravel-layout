@include('errors.minimal', [
    'code' => 403,
    'title' => 'Forbidden',
    'message' => $exception->getMessage() ?: 'You do not have permission to access this page.',
    'svg' => '403.svg',
])
