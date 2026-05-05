{{-- Toast container --}}
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999; min-width: 320px">

  @if (session('status'))
    <div class="sneat-toast toast show mb-2 sneat-toast--success" role="alert" data-bs-delay="4000">
      <div class="toast-body d-flex align-items-start gap-3">
        <span class="sneat-toast__icon"><i class="bx bx-check-circle"></i></span>
        <div class="flex-grow-1">
          <div class="sneat-toast__title">Success</div>
          <div class="sneat-toast__msg">{{ session('status') }}</div>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="sneat-toast toast show mb-2 sneat-toast--error" role="alert" data-bs-delay="5000">
      <div class="toast-body d-flex align-items-start gap-3">
        <span class="sneat-toast__icon"><i class="bx bx-x-circle"></i></span>
        <div class="flex-grow-1">
          <div class="sneat-toast__title">Error</div>
          <div class="sneat-toast__msg">{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if (session('warning'))
    <div class="sneat-toast toast show mb-2 sneat-toast--warning" role="alert" data-bs-delay="5000">
      <div class="toast-body d-flex align-items-start gap-3">
        <span class="sneat-toast__icon"><i class="bx bx-error"></i></span>
        <div class="flex-grow-1">
          <div class="sneat-toast__title">Warning</div>
          <div class="sneat-toast__msg">{{ session('warning') }}</div>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if (session('info'))
    <div class="sneat-toast toast show mb-2 sneat-toast--info" role="alert" data-bs-delay="4000">
      <div class="toast-body d-flex align-items-start gap-3">
        <span class="sneat-toast__icon"><i class="bx bx-info-circle"></i></span>
        <div class="flex-grow-1">
          <div class="sneat-toast__title">Info</div>
          <div class="sneat-toast__msg">{{ session('info') }}</div>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if ($errors->any())
    <div class="sneat-toast toast show mb-2 sneat-toast--error" role="alert" data-bs-delay="6000">
      <div class="toast-body d-flex align-items-start gap-3">
        <span class="sneat-toast__icon"><i class="bx bx-x-circle"></i></span>
        <div class="flex-grow-1">
          <div class="sneat-toast__title">Error</div>
          <div class="sneat-toast__msg">{{ $errors->first() }}</div>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

</div>

<style>
  .sneat-toast {
    background: #fff;
    border: none;
    border-radius: 6px;
    box-shadow: 0 4px 18px rgba(75, 70, 92, 0.15);
    border-left: 4px solid transparent;
    min-width: 300px;
  }
  .sneat-toast .toast-body { padding: 14px 16px; }
  .sneat-toast__icon { font-size: 1.4rem; line-height: 1; margin-top: 1px; }
  .sneat-toast__title { font-weight: 600; font-size: 0.9rem; line-height: 1.3; }
  .sneat-toast__msg { font-size: 0.82rem; color: #6d6b7b; margin-top: 2px; }
  .sneat-toast .btn-close { width: 0.7em; height: 0.7em; margin-top: 2px; flex-shrink: 0; }

  /* Success */
  .sneat-toast--success { border-left-color: #28c76f; background: #f0faf5; }
  .sneat-toast--success .sneat-toast__icon { color: #28c76f; }
  .sneat-toast--success .sneat-toast__title { color: #28c76f; }

  /* Warning */
  .sneat-toast--warning { border-left-color: #ff9f43; background: #fff9f3; }
  .sneat-toast--warning .sneat-toast__icon { color: #ff9f43; }
  .sneat-toast--warning .sneat-toast__title { color: #ff9f43; }

  /* Info */
  .sneat-toast--info { border-left-color: #00cfe8; background: #f0fbfd; }
  .sneat-toast--info .sneat-toast__icon { color: #00cfe8; }
  .sneat-toast--info .sneat-toast__title { color: #00cfe8; }

  /* Error */
  .sneat-toast--error { border-left-color: #ea5455; background: #fff5f5; }
  .sneat-toast--error .sneat-toast__icon { color: #ea5455; }
  .sneat-toast--error .sneat-toast__title { color: #ea5455; }
</style>

@push('page-js')
<script>
  document.querySelectorAll('#toast-container .toast').forEach(function (el) {
    new bootstrap.Toast(el, { delay: parseInt(el.dataset.bsDelay) || 4000 }).show();
  });
</script>
@endpush
