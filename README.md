# 🎨 Sneat Laravel Layout

একটি production-ready Laravel 10 starter project, যেটি **[Sneat Bootstrap 5](https://themeselection.com/products/sneat-bootstrap-html-admin-template/) admin template** এর উপরে তৈরি। এতে আছে সম্পূর্ণ Role/Permission-based access control, DB-driven dynamic sidebar, Sneat-styled authentication এবং custom error pages।

🗄️ **MySQL**, **SQLite**, এবং **MSSQL** — তিনটি database driver-ই সাপোর্ট করে। শুধু `.env` ফাইলের একটি লাইন বদলালেই যেকোনো database এ চালানো যায়।

---

## 📑 সূচিপত্র

- [✨ ফিচারসমূহ](#-ফিচারসমূহ)
- [🛠️ টেক স্ট্যাক](#-টেক-স্ট্যাক)
- [📋 প্রয়োজনীয়তা](#-প্রয়োজনীয়তা)
- [⚙️ ইনস্টলেশন](#-ইনস্টলেশন)
- [🗄️ ডাটাবেস কনফিগারেশন](#-ডাটাবেস-কনফিগারেশন)
- [🚀 অ্যাপ্লিকেশন চালু করা](#-অ্যাপ্লিকেশন-চালু-করা)
- [📂 প্রজেক্ট স্ট্রাকচার](#-প্রজেক্ট-স্ট্রাকচার)
- [🔐 Roles ও Permissions](#-roles-ও-permissions)
- [🛣️ রাউট রেফারেন্স](#-রাউট-রেফারেন্স)
- [🔑 অথেনটিকেশন](#-অথেনটিকেশন)
- [❌ এরর পেজ](#-এরর-পেজ)
- [🗂️ Menu Manager](#️-menu-manager)
- [🎨 সাইডবার ও লেআউট](#-সাইডবার-ও-লেআউট)
- [💡 দরকারি Artisan কমান্ড](#-দরকারি-artisan-কমান্ড)
- [🔧 সমস্যা সমাধান (Troubleshooting)](#-সমস্যা-সমাধান-troubleshooting)
- [🚢 ডিপ্লয়মেন্ট](#-ডিপ্লয়মেন্ট)
- [📄 লাইসেন্স](#-লাইসেন্স)

---

## ✨ ফিচারসমূহ

- 🎨 **Sneat Bootstrap 5 admin template** — modern, fully responsive UI সহ vertical sidebar
- 🔑 **অথেনটিকেশন** — Login, Register, Forgot Password (Sneat-styled forms)
- 🛡️ **Role-Based Access Control** — [spatie/laravel-permission](https://spatie.be/docs/laravel-permission) দিয়ে তৈরি
  - 3টি pre-seeded role: **Admin**, **Manager**, **User**
  - 17টি granular permission (users, roles, permissions, menus, dashboard)
  - **Admin** role স্বয়ংক্রিয়ভাবে সব permission check বাইপাস করে (`Gate::before` দিয়ে)
- 📝 **CRUD ইন্টারফেস** — Users, Roles, Permissions এবং **Menu Items** এর জন্য
- 🗂️ **DB-driven Dynamic Sidebar** — Settings থেকে menu items add/edit/delete করলে sidebar instantly update হয়
- 👁️ **Permission-aware sidebar** — logged-in user এর permission অনুযায়ী menu item স্বয়ংক্রিয়ভাবে hide হয়
- 🎯 **Smart section header** — কোনো section এর নিচে visible item না থাকলে header নিজেই লুকিয়ে যায়
- 🔄 **Active menu auto-scroll** — page load এ active sidebar item টি স্বয়ংক্রিয়ভাবে center এ scroll হয়
- ❌ **Custom Sneat-styled error pages** (403, 404, 500, 503) — `public/svg/` এর illustrations সহ
- 🗄️ **Multi-database support** — MySQL / SQLite / MSSQL, `.env` দিয়ে switch করা যায়
- 📄 **Bootstrap 5 pagination** — Laravel paginator এর সাথে integrated

---

## 🛠️ টেক স্ট্যাক

| 🔹 লেয়ার | 🔧 প্রযুক্তি |
|---|---|
| ⚡ Framework | Laravel 10.x |
| 🐘 PHP | 8.1+ (PHP 8.3 এ tested) |
| 🎨 Front-end | Sneat Bootstrap 5 + Boxicons + Public Sans font |
| 📦 Build tool | Vite 5 |
| 🔑 Auth | Laravel native sessions + Sanctum |
| 🛡️ Permissions | spatie/laravel-permission ^6.25 |
| 🗄️ DB drivers | `pdo_mysql`, `pdo_sqlite`, `pdo_sqlsrv` |

---

## 📋 প্রয়োজনীয়তা

- 🐘 **PHP 8.1+** — extensions: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- 📦 **Composer 2.x**
- 🟢 **Node.js 18+ ও npm** (শুধু front-end assets rebuild করতে চাইলে)
- 🗄️ **যেকোনো একটি database**:
  - 🐬 MySQL 5.7+ / MariaDB 10.3+, **অথবা**
  - 📁 SQLite 3, **অথবা**
  - 🪟 SQL Server 2017+ ([`pdo_sqlsrv`](https://learn.microsoft.com/en-us/sql/connect/php/microsoft-php-driver-for-sql-server) দরকার)

---

## ⚙️ ইনস্টলেশন

```bash
# 1️⃣ Repository clone করুন
git clone <your-repo-url> sneat-laravel-layout
cd sneat-laravel-layout

# 2️⃣ PHP dependencies install করুন
composer install

# 3️⃣ .env file copy করে APP_KEY generate করুন
cp .env.example .env
php artisan key:generate

# 4️⃣ .env এ DB credentials set করুন (নিচে দেখুন)

# 5️⃣ Migration চালান এবং সব data seed করুন
php artisan migrate --seed

# 6️⃣ (Optional) Vite assets rebuild করতে চাইলে
npm install && npm run build
```

> 💡 **নোট:** Sneat template এর সব assets আগে থেকেই pre-built `public/assets/` এ আছে — সাধারণ ব্যবহারে **`npm install` লাগবে না**।

---

## 🗄️ ডাটাবেস কনফিগারেশন

`.env` ফাইলে `DB_CONNECTION` বদলে যেকোনো database ব্যবহার করুন।

### 🐬 MySQL (default)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sneat_laravel_layout
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ MySQL এর জন্য InnoDB engine enforce করা আছে — Spatie এর composite unique index handle করতে। `Schema::defaultStringLength(191)` শুধু MySQL এ auto-apply হয় ([AppServiceProvider.php](app/Providers/AppServiceProvider.php))।

### 📁 SQLite

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

```bash
touch database/database.sqlite
php artisan migrate --seed
```

### 🪟 MSSQL (SQL Server)

```env
DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1433
DB_DATABASE=sneat_laravel_layout
DB_USERNAME=sa
DB_PASSWORD=YourStrong!Password
DB_TRUST_SERVER_CERTIFICATE=true
```

### 🔄 Database switch করা

```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

---

## 🚀 অ্যাপ্লিকেশন চালু করা

```bash
php artisan serve
```

🌐 Browser এ <http://localhost:8000> খুলুন।

### 👤 Pre-seeded test users

সবার password: **`password`**

| 📧 ইমেইল | 🎭 রোল | 🔓 অ্যাক্সেস |
|---|---|---|
| `admin@example.com` | 👑 Admin | সম্পূর্ণ access — সব gate বাইপাস |
| `manager@example.com` | 👔 Manager | Dashboard + user view/create/edit + role view |
| `user@example.com` | 👤 User | শুধু Dashboard |

---

## 📂 প্রজেক্ট স্ট্রাকচার

```
sneat-laravel-layout/
├── 📁 app/
│   ├── 📁 Http/Controllers/
│   │   ├── 📁 Auth/
│   │   │   ├── 🔑 LoginController.php           # Login + logout
│   │   │   ├── 📝 RegisterController.php        # Registration (auto "User" role)
│   │   │   └── 🔐 ForgotPasswordController.php  # Password reset link
│   │   ├── 🗂️ MenuController.php                # Menu items CRUD
│   │   ├── 🛡️ PermissionController.php          # Permissions CRUD
│   │   ├── 🎭 RoleController.php                # Roles CRUD
│   │   └── 👤 UserController.php                # Users CRUD
│   ├── 📁 Models/
│   │   ├── 🗂️ Menu.php                          # DB menu — parent/children, href(), isActive()
│   │   └── 👤 User.php                          # HasRoles trait
│   └── 📁 Providers/
│       └── ⚙️ AppServiceProvider.php            # Gate::before + sidebar View Composer
├── 📁 database/
│   ├── 📁 migrations/
│   │   ├── 📜 *_create_permission_tables.php
│   │   └── 📜 *_create_menus_table.php
│   └── 📁 seeders/
│       ├── 🌱 DatabaseSeeder.php
│       ├── 🌱 RolesAndPermissionsSeeder.php     # 17 perms + 3 roles
│       ├── 🌱 UserSeeder.php                    # 3 test users
│       └── 🌱 MenuSeeder.php                   # 20 menu items (full sidebar)
├── 📁 public/
│   ├── 🎨 assets/                              # Sneat CSS/JS/fonts (pre-built)
│   └── 🖼️ svg/                                 # 403/404/500/503 illustrations
├── 📁 resources/views/
│   ├── 📁 auth/                                # login, register, forgot-password
│   ├── 📁 errors/                              # Sneat-styled error pages + minimal layout
│   ├── 📁 layouts/
│   │   ├── 🎨 app.blade.php                    # Authenticated layout (sidebar + navbar)
│   │   ├── 🎨 auth.blade.php                   # Guest layout (centered card)
│   │   └── 📁 partials/
│   │       ├── 🗂️ sidebar.blade.php            # DB-driven dynamic menu render
│   │       ├── 🧭 navbar.blade.php
│   │       └── 📝 footer.blade.php
│   └── 📁 pages/
│       ├── 📊 dashboard.blade.php
│       ├── 📁 menus/{index,create,edit,_form}.blade.php
│       ├── 📁 users/{index,create,edit}.blade.php
│       ├── 📁 roles/{index,create,edit,_form}.blade.php
│       └── 📁 permissions/{index,create,edit}.blade.php
└── 📁 routes/
    └── 🛣️ web.php
```

---

## 🔐 Roles ও Permissions

### 📜 Seeded permissions (17টি)

| 📂 Group | 🔑 Permissions |
|---|---|
| 👤 User management | `user.view`, `user.create`, `user.edit`, `user.delete` |
| 🎭 Role management | `role.view`, `role.create`, `role.edit`, `role.delete` |
| 🛡️ Permission management | `permission.view`, `permission.create`, `permission.edit`, `permission.delete` |
| 🗂️ Menu management | `menu.view`, `menu.create`, `menu.edit`, `menu.delete` |
| 📊 Dashboard | `dashboard.view` |

### 🎭 Seeded roles

| 🎭 Role | 🔑 Permissions |
|---|---|
| 👑 **Admin** | সব 17টি + `Gate::before` দিয়ে সব check বাইপাস |
| 👔 **Manager** | `dashboard.view`, `user.view/create/edit`, `role.view` |
| 👤 **User** | `dashboard.view` |

### 🔒 Permissions কীভাবে enforce হয়

**তিনটি লেয়ারে:**

**1 — Route middleware**
```php
Route::get('/dashboard', ...)->middleware('permission:dashboard.view');
```

**2 — Controller constructor**
```php
$this->middleware('permission:menu.view')->only(['index']);
$this->middleware('permission:menu.create')->only(['create', 'store']);
$this->middleware('permission:menu.edit')->only(['edit', 'update']);
$this->middleware('permission:menu.delete')->only(['destroy']);
```

**3 — Blade directives**
```blade
@can('menu.create')
  <a href="{{ route('menus.create') }}" class="btn btn-primary">Add Item</a>
@endcan
```

### 👑 Admin bypass

```php
// app/Providers/AppServiceProvider.php
Gate::before(function ($user, $ability) {
    return $user->hasRole('Admin') ? true : null;
});
```

### 🛡️ Safety guards

- ❌ **Admin** role delete করা যায় না
- ❌ User নিজের account নিজে delete করতে পারে না
- ✅ Self-registered user-দের স্বয়ংক্রিয়ভাবে `User` role assign হয়

---

## 🛣️ রাউট রেফারেন্স

### 🌐 Guest routes

| Method | URI | Controller | Name |
|---|---|---|---|
| GET | `/login` | `LoginController@showLoginForm` | `login` |
| POST | `/login` | `LoginController@login` | — |
| GET | `/register` | `RegisterController@showRegistrationForm` | `register` |
| POST | `/register` | `RegisterController@register` | — |
| GET | `/forgot-password` | `ForgotPasswordController@showLinkRequestForm` | `password.request` |
| POST | `/forgot-password` | `ForgotPasswordController@sendResetLinkEmail` | `password.email` |

### 🔐 Authenticated routes

| Method | URI | Permission gate | Name |
|---|---|---|---|
| POST | `/logout` | — | `logout` |
| GET | `/dashboard` | `dashboard.view` | `dashboard` |
| Resource | `/users` | `user.{view,create,edit,delete}` | `users.*` |
| Resource | `/roles` | `role.{view,create,edit,delete}` | `roles.*` |
| Resource | `/permissions` | `permission.{view,create,edit,delete}` | `permissions.*` |
| Resource | `/menus` | `menu.{view,create,edit,delete}` | `menus.*` |

---

## 🔑 অথেনটিকেশন

### 🚪 Login

- `email` + `password` validate → `Auth::attempt()` → session regenerate → `/dashboard`
- "Remember me" checkbox সাপোর্ট করে

### 📝 Registration

- `name`, `email` (unique), `password` (min 6, confirmed), `terms` validate করে
- Password bcrypt hash → user create → `User` role auto-assign → login → `/dashboard`

### 🔓 Password reset

- Laravel `Password` broker দিয়ে reset link send করে
- ⚠️ `.env` এ `MAIL_*` configure না করলে email যাবে না

---

## ❌ এরর পেজ

`APP_DEBUG=false` থাকলে Laravel স্বয়ংক্রিয়ভাবে এগুলো দেখায়:

| Code | View | Illustration | Trigger |
|---|---|---|---|
| 🚫 403 | `errors/403.blade.php` | `public/svg/403.svg` | Permission নেই |
| ❓ 404 | `errors/404.blade.php` | `public/svg/404.svg` | Non-existent URL |
| 💥 500 | `errors/500.blade.php` | `public/svg/500.svg` | Uncaught exception |
| 🔧 503 | `errors/503.blade.php` | `public/svg/503.svg` | `php artisan down` |

চারটিই [errors/minimal.blade.php](resources/views/errors/minimal.blade.php) layout extend করে।

---

## 🗂️ Menu Manager

> **Settings → Menu Manager** থেকে sidebar এর প্রতিটি item database এ manage করা যায়। কোনো code change ছাড়াই menu add, edit, reorder, বা hide করা সম্ভব।

### 🏗️ `menus` Table Schema

| Column | Type | বিবরণ |
|---|---|---|
| `id` | bigint PK | — |
| `label` | string | Sidebar এ যা দেখাবে, যেমন `Dashboard` |
| `type` | enum | `link` · `toggle` · `header` |
| `icon` | string\|null | Boxicons class, যেমন `bx bx-home-circle` |
| `route` | string\|null | Laravel named route, যেমন `users.index` |
| `url` | string\|null | External URL (route না থাকলে fallback) |
| `route_pattern` | string\|null | `routeIs()` pattern, যেমন `users.*` |
| `permission` | string\|null | Spatie permission — blank হলে সবাই দেখবে |
| `parent_id` | bigint\|null | FK → `menus.id` — শুধু `link` type এ ব্যবহার |
| `sort_order` | smallint | ছোট সংখ্যা উপরে আসে |
| `is_active` | boolean | `false` হলে sidebar এ দেখাবে না |
| `target_blank` | boolean | External link নতুন tab এ খুলবে |

### 🔖 Item Types

```
header  ──  Section title, যেমন "Administration", "Settings"
            ► কোনো icon, route, বা parent নেই
            ► নিচে কোনো visible item না থাকলে নিজেই লুকিয়ে যায়

toggle  ──  Collapsible parent, যেমন "Access Control"
            ► icon থাকে, route নেই (href = javascript:void)
            ► child link গুলো menu-sub এ render হয়
            ► অন্তত একটি visible child না থাকলে render হয় না

link    ──  Regular menu item, যেমন "Dashboard", "Users"
            ► icon, route/url, permission, parent_id সব থাকতে পারে
            ► parent_id দিলে কোনো toggle এর sub-item হয়
```

### 🔄 Sidebar Rendering Flow

```
AppServiceProvider (View Composer)
  └─► DB থেকে top-level active menus load (with activeChildren)
        └─► sidebar.blade.php এ $sidebarMenus inject

sidebar.blade.php
  ├─ header  → pendingHeader এ রাখে (defer)
  ├─ toggle  → visibleChildren filter করে
  │           → কোনো child না থাকলে skip (pendingHeader ও বাদ)
  │           → child থাকলে pendingHeader flush → toggle render
  └─ link    → @can check → pass হলে pendingHeader flush → render
```

### ⚙️ Permission Check Logic

```php
// Model helper — Menu.php
public function isActive(): bool
{
    $pattern = $this->route_pattern ?: $this->route;
    return $pattern ? request()->routeIs($pattern) : false;
}

public function href(): string
{
    if ($this->route) {
        return route($this->route);   // named route
    }
    return $this->url ?? 'javascript:void(0);';
}
```

### 🌱 Seeded Menu Items (20টি)

```
sort  type     label
────────────────────────────────
  1   link     Dashboard          (permission: dashboard.view)
 10   header   Administration
 11   toggle   Access Control
              └─  1  link  Users        (permission: user.view)
              └─  2  link  Roles        (permission: role.view)
              └─  3  link  Permissions  (permission: permission.view)
 20   header   Settings
 21   toggle   Settings
              └─  1  link  Menu Manager (permission: menu.view)
 30   header   Components
 31   toggle   Layouts
              └─  1-4  link  (Without menu / Container / Fluid / Blank)
 32   link     Cards
 33   link     Tables
 40   header   Misc
 41   link     Support       (target_blank)
 42   link     Documentation (target_blank)
```

### ✏️ নতুন Menu Item যোগ করার উদাহরণ

ধরুন **Settings → Profile** নামে একটি link যোগ করতে চান:

1. Sidebar এ **Settings → Menu Manager** → **Add Item** ক্লিক করুন
2. ফর্মে দিন:
   - **Label:** `Profile`
   - **Type:** `Link`
   - **Icon:** `bx bx-user-circle`
   - **Named Route:** `profile.edit` _(অথবা External URL)_
   - **Active Route Pattern:** `profile.*`
   - **Permission:** _(blank = সবাই দেখবে)_
   - **Parent Toggle:** `Settings`
   - **Sort Order:** `2`
   - **Active:** ✅
3. **Create** — সঙ্গে সঙ্গে sidebar এ দেখাবে

---

## 🎨 সাইডবার ও লেআউট

Sidebar এখন **সম্পূর্ণ database-driven** — hardcoded HTML নেই।

### 📡 View Composer

[app/Providers/AppServiceProvider.php](app/Providers/AppServiceProvider.php) এ register করা:

```php
View::composer('layouts.partials.sidebar', function ($view) {
    $sidebarMenus = Menu::whereNull('parent_id')
        ->where('is_active', true)
        ->with(['activeChildren'])
        ->orderBy('sort_order')
        ->get();
    $view->with('sidebarMenus', $sidebarMenus);
});
```

### 🎯 Smart Header Hiding

কোনো `header` type item এর নিচে visible item না থাকলে সেই header টি render হয় না — "Administration" দেখাবে না যদি user এর কোনো ACL permission না থাকে:

```blade
@php $pendingHeader = null; @endphp
@foreach ($sidebarMenus as $menu)
  @if ($menu->type === 'header')
    @php $pendingHeader = $menu; @endphp   {{-- defer --}}
  @elseif (/* item is visible */)
    @if ($pendingHeader)
      {{-- flush header only when a real item follows --}}
      <li class="menu-header">{{ $pendingHeader->label }}</li>
      @php $pendingHeader = null; @endphp
    @endif
    {{-- render item --}}
  @endif
@endforeach
```

### 🔄 Active Menu Auto-Scroll (Centered)

Page load এ active sidebar item টি `.menu-inner` এর vertically center এ আসে ([app.blade.php](resources/views/layouts/app.blade.php)):

```js
var leaf   = menuInner.querySelector('li.menu-item.active:not(.open)');
var offset = link.getBoundingClientRect().top - menuInner.getBoundingClientRect().top
             + menuInner.scrollTop;
var target = offset - (menuInner.clientHeight / 2) + (link.offsetHeight / 2);
menuInner.scrollTop = Math.max(0, Math.min(target, menuInner.scrollHeight - menuInner.clientHeight));
```

> Sneat এর built-in `Helpers.scrollToActive()` এ 2/3 height guard আছে — active item উপরে থাকলে scroll করে না। এই custom script সবসময় center করে।

### 🖼️ Layouts

| Layout | Path | ব্যবহার |
|---|---|---|
| 🔐 Authenticated | [layouts/app.blade.php](resources/views/layouts/app.blade.php) | Sidebar + navbar + footer সহ সব logged-in page |
| 🌐 Guest | [layouts/auth.blade.php](resources/views/layouts/auth.blade.php) | Centered card — login, register, forgot-password |

---

## 💡 দরকারি Artisan কমান্ড

```bash
# 🔄 সব কিছু মুছে fresh start (⚠️ DESTRUCTIVE)
php artisan migrate:fresh --seed

# 🌱 শুধু permissions + roles re-seed
php artisan db:seed --class=RolesAndPermissionsSeeder

# 🌱 শুধু menu items re-seed (⚠️ truncate করে)
php artisan db:seed --class=MenuSeeder

# 🌱 শুধু test users re-seed
php artisan db:seed --class=UserSeeder

# 🧹 সব cache clear
php artisan optimize:clear

# 🛣️ সব routes দেখুন
php artisan route:list

# 🔍 DB ad-hoc queries
php artisan tinker

# 🔧 Maintenance mode
php artisan down
php artisan up
```

---

## 🔧 সমস্যা সমাধান (Troubleshooting)

### ❌ `Target class [permission] does not exist`

[app/Http/Kernel.php](app/Http/Kernel.php) এ Spatie middleware aliases নেই:

```php
'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```

### ❌ Sidebar blank / menu দেখাচ্ছে না

`menus` table empty — seed চালানো হয়নি:

```bash
php artisan db:seed --class=MenuSeeder
```

### ❌ `SQLSTATE[42000]: Specified key was too long`

MySQL MyISAM ব্যবহার করছে। Cache clear করুন:

```bash
php artisan config:clear && php artisan migrate:fresh
```

### ❌ `Cannot make non static method Controller::middleware() static`

Laravel 11+ এর feature এই project এ use করা হয়েছে। Laravel 10 এ middleware controller constructor এ দিতে হয় — [MenuController.php](app/Http/Controllers/MenuController.php) এর pattern follow করুন।

### ❌ MSSQL connection refused

```bash
php -m | grep sqlsrv
```

`pdo_sqlsrv` না থাকলে Microsoft এর official driver pack install করুন।

---

## 🚢 ডিপ্লয়মেন্ট

### ✅ Production checklist

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan db:seed --class=MenuSeeder   # প্রথমবার deploy এ
```

### ⚙️ Production `.env`

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true
```

> 💡 `APP_DEBUG=false` থাকলে custom error pages দেখাবে, Ignition debug page নয়।

---

## 📄 লাইসেন্স

🆓 এই project [MIT License](https://opensource.org/licenses/MIT) এর অধীনে open-source।

🎨 Sneat Bootstrap admin template [ThemeSelection](https://themeselection.com) এর property এবং তাদের free license terms এর অধীনে included।

---

<p align="center">Made with ❤️ using Laravel + Sneat</p>
