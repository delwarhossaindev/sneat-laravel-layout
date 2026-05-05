<div class="row g-3">

  {{-- Label --}}
  <div class="col-md-6">
    <label class="form-label">Label <span class="text-danger">*</span></label>
    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
           value="{{ old('label', $menu->label ?? '') }}" placeholder="e.g. Dashboard" required>
    <div class="form-text">Sidebar এ যা লেখা দেখাবে। যেমন: <code>Dashboard</code>, <code>Users</code></div>
    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Type --}}
  <div class="col-md-3">
    <label class="form-label">Type <span class="text-danger">*</span></label>
    <select name="type" id="typeSelect" class="form-select @error('type') is-invalid @enderror" required>
      <option value="link"   {{ old('type', $menu->type ?? 'link') === 'link'   ? 'selected' : '' }}>Link</option>
      <option value="toggle" {{ old('type', $menu->type ?? '') === 'toggle' ? 'selected' : '' }}>Toggle (collapsible parent)</option>
      <option value="header" {{ old('type', $menu->type ?? '') === 'header' ? 'selected' : '' }}>Header (section title)</option>
    </select>
    <div class="form-text" id="typeHelp"></div>
    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Sort Order --}}
  <div class="col-md-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
           value="{{ old('sort_order', $menu->sort_order ?? 0) }}" min="0" max="9999">
    <div class="form-text">ছোট সংখ্যা উপরে আসে। যেমন: <code>1</code> সবার আগে।</div>
    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Icon --}}
  <div class="col-md-6" id="iconRow">
    <label class="form-label">Icon <small class="text-muted">(Boxicons class)</small></label>
    <div class="input-group">
      <span class="input-group-text"><i id="iconPreviewIcon" class="{{ old('icon', $menu->icon ?? 'bx bx-circle') }}"></i></span>
      <input type="text" name="icon" id="iconInput" class="form-control @error('icon') is-invalid @enderror"
             value="{{ old('icon', $menu->icon ?? '') }}" placeholder="e.g. bx bx-home-circle">
    </div>
    <div class="form-text">
      Sidebar এ menu item এর বাঁ পাশে icon দেখাবে।
      <a href="https://boxicons.com" target="_blank">boxicons.com</a> থেকে class copy করুন।
      যেমন: <code>bx bx-user</code>, <code>bx bx-cog</code>
    </div>
    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Parent --}}
  <div class="col-md-6" id="parentRow">
    <label class="form-label">Parent Toggle</label>
    <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
      <option value="">— None (top level) —</option>
      @foreach ($parents as $parent)
        <option value="{{ $parent->id }}"
          {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
          {{ $parent->label }}
        </option>
      @endforeach
    </select>
    <div class="form-text">
      এই item টি কোনো collapsible menu এর ভেতরে রাখতে চাইলে select করুন।
      যেমন: <em>Access Control</em> এর নিচে <em>Users</em> রাখতে <code>Access Control</code> select করুন।
    </div>
    @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Route --}}
  <div class="col-md-6" id="routeRow">
    <label class="form-label">Named Route <small class="text-muted">(Laravel route name)</small></label>
    <input type="text" name="route" class="form-control @error('route') is-invalid @enderror"
           value="{{ old('route', $menu->route ?? '') }}" placeholder="e.g. dashboard, users.index">
    <div class="form-text">
      Laravel এর named route। Click করলে ওই page এ যাবে।
      <code>php artisan route:list</code> থেকে route name দেখুন।
      যেমন: <code>dashboard</code>, <code>users.index</code>, <code>roles.index</code>
    </div>
    @error('route') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- URL --}}
  <div class="col-md-6" id="urlRow">
    <label class="form-label">External URL <small class="text-muted">(fallback if no route)</small></label>
    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
           value="{{ old('url', $menu->url ?? '') }}" placeholder="e.g. https://example.com">
    <div class="form-text">
      Named Route না থাকলে এই URL ব্যবহার হবে। বাইরের সাইটের link এর জন্য ব্যবহার করুন।
      যেমন: <code>https://github.com/...</code>
    </div>
    @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Route Pattern --}}
  <div class="col-md-6" id="patternRow">
    <label class="form-label">Active Route Pattern <small class="text-muted">(routeIs check)</small></label>
    <input type="text" name="route_pattern" class="form-control @error('route_pattern') is-invalid @enderror"
           value="{{ old('route_pattern', $menu->route_pattern ?? '') }}" placeholder="e.g. users.*, dashboard">
    <div class="form-text">
      কোন route এ থাকলে এই menu item <strong>active</strong> (highlighted) দেখাবে।
      Wildcard <code>*</code> ব্যবহার করা যায়।
      যেমন: <code>users.*</code> মানে users এর যেকোনো page এ active থাকবে।
    </div>
    @error('route_pattern') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Permission --}}
  <div class="col-md-6">
    <label class="form-label">Permission <small class="text-muted">(leave blank = always visible)</small></label>
    <select name="permission" class="form-select @error('permission') is-invalid @enderror">
      <option value="">— No restriction (সবাই দেখবে) —</option>
      @foreach ($permissions as $perm)
        <option value="{{ $perm }}" {{ old('permission', $menu->permission ?? '') === $perm ? 'selected' : '' }}>
          {{ $perm }}
        </option>
      @endforeach
    </select>
    <div class="form-text">
      শুধুমাত্র এই permission আছে এমন user এই item দেখতে পাবে।
      Blank রাখলে সব logged-in user দেখবে।
      যেমন: <code>user.view</code> select করলে শুধু যাদের সেই permission আছে তারা দেখবে।
    </div>
    @error('permission') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  {{-- Checkboxes --}}
  <div class="col-12 d-flex gap-4 align-items-start flex-wrap mt-1">
    <div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
               {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-medium" for="isActive">Active</label>
      </div>
      <div class="form-text mt-0">Off করলে sidebar এ দেখাবে না।</div>
    </div>
    <div id="targetBlankRow">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="target_blank" id="targetBlank" value="1"
               {{ old('target_blank', $menu->target_blank ?? false) ? 'checked' : '' }}>
        <label class="form-check-label fw-medium" for="targetBlank">Open in new tab</label>
      </div>
      <div class="form-text mt-0">External link নতুন tab এ খুলবে।</div>
    </div>
  </div>

</div>

@push('page-js')
<script>
  (function () {
    var typeSelect = document.getElementById('typeSelect');
    var iconInput  = document.getElementById('iconInput');
    var iconPreviewIcon = document.getElementById('iconPreviewIcon');
    var typeHelp   = document.getElementById('typeHelp');

    var typeDescriptions = {
      link:   'Regular menu item — click করলে page এ যাবে। Parent toggle এর ভেতরেও রাখা যায়।',
      toggle: 'Collapsible parent — click করলে sub-menu খোলে/বন্ধ হয়। এর নিচে Link type item রাখুন।',
      header: 'Section title — sidebar এ section header হিসেবে দেখায়। যেমন: "Administration", "Settings"।',
    };

    var rows = {
      icon:    document.getElementById('iconRow'),
      parent:  document.getElementById('parentRow'),
      route:   document.getElementById('routeRow'),
      url:     document.getElementById('urlRow'),
      pattern: document.getElementById('patternRow'),
      target:  document.getElementById('targetBlankRow'),
    };

    function applyType(type) {
      typeHelp.textContent = typeDescriptions[type] || '';

      if (type === 'header') {
        rows.icon.classList.add('d-none');
        rows.parent.classList.add('d-none');
        rows.route.classList.add('d-none');
        rows.url.classList.add('d-none');
        rows.pattern.classList.add('d-none');
        rows.target.classList.add('d-none');
      } else if (type === 'toggle') {
        rows.icon.classList.remove('d-none');
        rows.parent.classList.add('d-none');
        rows.route.classList.add('d-none');
        rows.url.classList.add('d-none');
        rows.pattern.classList.add('d-none');
        rows.target.classList.add('d-none');
      } else {
        rows.icon.classList.remove('d-none');
        rows.parent.classList.remove('d-none');
        rows.route.classList.remove('d-none');
        rows.url.classList.remove('d-none');
        rows.pattern.classList.remove('d-none');
        rows.target.classList.remove('d-none');
      }
    }

    typeSelect.addEventListener('change', function () { applyType(this.value); });
    iconInput.addEventListener('input', function () {
      iconPreviewIcon.className = this.value || 'bx bx-circle';
    });

    applyType(typeSelect.value);
  })();
</script>
@endpush
