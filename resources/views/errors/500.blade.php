@include('errors.minimal', [
    'code' => 500,
    'title' => 'Internal Server Error',
    'message' => 'Something went wrong on our end. Please try again later.',
    'svg' => '500.svg',
])
