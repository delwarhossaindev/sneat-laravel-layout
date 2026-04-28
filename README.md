# 🎨 Sneat Laravel Layout

একটি production-ready Laravel 10 starter project, যেটি **[Sneat Bootstrap 5](https://themeselection.com/products/sneat-bootstrap-html-admin-template/) admin template** এর উপরে তৈরি। এতে আছে সম্পূর্ণ Role/Permission-based access control system, Sneat-styled authentication pages এবং custom error pages।

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
  - 13টি granular permission (users, roles, permissions, dashboard)
  - **Admin** role স্বয়ংক্রিয়ভাবে সব permission check বাইপাস করে (`Gate::before` দিয়ে)
- 📝 **CRUD ইন্টারফেস** — Users, Roles, এবং Permissions এর জন্য
- 👁️ **Permission-aware sidebar** — logged-in user এর permission অনুযায়ী menu item স্বয়ংক্রিয়ভাবে hide হয়
- 🎯 **`@can` / `@canany` Blade directives** — সব views এবং controllers এ ব্যবহৃত
- ❌ **Custom Sneat-styled error pages** (403, 404, 500, 503) — `public/svg/` এর illustrations সহ
- 🗄️ **Multi-database support** — MySQL / SQLite / MSSQL, `.env` দিয়ে switch করা যায়
- 📄 **Bootstrap 5 pagination** — Laravel paginator এর সাথে integrated
- 🌐 **Bangla/English ready** — Laravel এর standard localization ব্যবহার করে

---

## 🛠️ টেক স্ট্যাক

| 🔹 লেয়ার | 🔧 প্রযুক্তি |
|-------|-----------|
| ⚡ Framework | Laravel 10.x |
| 🐘 PHP | 8.1+ (PHP 8.3 এ tested) |
| 🎨 Front-end | Sneat Bootstrap 5 + Boxicons + Public Sans font |
| 📦 Build tool | Vite 5 |
| 🔑 Auth | Laravel native sessions + Sanctum (API tokens এর জন্য) |
| 🛡️ Permissions | spatie/laravel-permission ^6.25 |
| 🗄️ DB drivers | `pdo_mysql`, `pdo_sqlite`, `pdo_sqlsrv` |

---

## 📋 প্রয়োজনীয়তা

- 🐘 **PHP 8.1+** — নিম্নলিখিত extensions সহ:
  `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- 📦 **Composer 2.x**
- 🟢 **Node.js 18+ ও npm** (শুধু front-end assets rebuild করার দরকার হলে)
- 🗄️ **যেকোনো একটি database server**:
  - 🐬 MySQL 5.7+ / MariaDB 10.3+, **অথবা**
  - 📁 SQLite 3, **অথবা**
  - 🪟 SQL Server 2017+ ([`pdo_sqlsrv`](https://learn.microsoft.com/en-us/sql/connect/php/microsoft-php-driver-for-sql-server) extension প্রয়োজন)

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

# 4️⃣ .env এ DB credentials set করুন (নিচে "ডাটাবেস কনফিগারেশন" দেখুন)

# 5️⃣ Migration চালান এবং sample data seed করুন
php artisan migrate --seed

# 6️⃣ (Optional) Vite assets modify করতে চাইলে npm install করুন
npm install
```

> 💡 **নোট:** Sneat template এর সব assets আগে থেকেই pre-built অবস্থায় `public/assets/` এ আছে। তাই সাধারণ ব্যবহারের জন্য **`npm install` লাগবে না**।

---

## 🗄️ ডাটাবেস কনফিগারেশন

`.env` ফাইল edit করে `DB_CONNECTION` এর value তিনটার যেকোনো একটায় set করুন।

### 🐬 MySQL (default)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sneat_laravel_layout
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ `config/database.php` এ MySQL এর জন্য InnoDB engine enforce করা হয়েছে — Spatie এর composite unique indexes (`permissions` ও `roles` table এ) handle করার জন্য। `Schema::defaultStringLength(191)` শুধু MySQL এর জন্য auto-apply হয় ([app/Providers/AppServiceProvider.php](app/Providers/AppServiceProvider.php))।

### 📁 SQLite

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

```bash
touch database/database.sqlite       # খালি file তৈরি করুন
php artisan migrate --seed
```

### 🪟 MSSQL (SQL Server)

`pdo_sqlsrv` PHP extension দরকার। **WAMP এ এটা bundled থাকে না** — Microsoft এর official driver pack থেকে install করতে হবে।

```env
DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1433
DB_DATABASE=sneat_laravel_layout
DB_USERNAME=sa
DB_PASSWORD=YourStrong!Password
DB_TRUST_SERVER_CERTIFICATE=true
```

### 🔄 ডাটাবেস switch করা

`.env` এ `DB_CONNECTION` change করার পর:

```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

---

## 🚀 অ্যাপ্লিকেশন চালু করা

```bash
php artisan serve
```

🌐 Browser এ <http://localhost:8000> খুলুন। আপনাকে `/dashboard` এ redirect করবে (login না করা থাকলে `/login` এ যাবে)।

### 👤 Pre-seeded test users

সবার password হলো **`password`**।

| 📧 ইমেইল | 🎭 রোল | 🔓 অ্যাক্সেস |
|-------|------|--------|
| `admin@example.com` | 👑 Admin | সম্পূর্ণ access (সব permission gate বাইপাস করে) |
| `manager@example.com` | 👔 Manager | Dashboard + user view/create/edit + role view |
| `user@example.com` | 👤 User | শুধু Dashboard |

---

## 📂 প্রজেক্ট স্ট্রাকচার

```
sneat-laravel-layout/
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   ├── 📁 Auth/
│   │   │   │   ├── 🔑 LoginController.php          # Login + logout
│   │   │   │   ├── 📝 RegisterController.php       # Registration ("User" role auto-assign করে)
│   │   │   │   └── 🔐 ForgotPasswordController.php # Password reset link
│   │   │   ├── 🛡️ PermissionController.php         # Permissions CRUD
│   │   │   ├── 🎭 RoleController.php               # Roles CRUD (permission attach সহ)
│   │   │   └── 👤 UserController.php               # Users CRUD (role assignment সহ)
│   │   └── 📁 Middleware/                          # Standard Laravel middleware + Authenticate
│   │   └── ⚙️ Kernel.php                           # Spatie 'role'/'permission' aliases register করা
│   ├── 📁 Models/
│   │   └── 👤 User.php                             # HasRoles trait ব্যবহার করে
│   └── 📁 Providers/
│       └── ⚙️ AppServiceProvider.php               # Admin এর জন্য Gate::before, Bootstrap pagination
├── 📁 config/
│   ├── 🔑 auth.php
│   ├── 🗄️ database.php                             # 3টি DB driver-ই configured
│   └── 🛡️ permission.php                           # Spatie permission config
├── 📁 database/
│   ├── 📁 migrations/
│   │   └── 📜 2026_04_27_*_create_permission_tables.php
│   └── 📁 seeders/
│       ├── 🌱 DatabaseSeeder.php
│       ├── 🌱 RolesAndPermissionsSeeder.php        # 13 perms + 3 roles
│       └── 🌱 UserSeeder.php                       # 3 test users
├── 📁 public/
│   ├── 🎨 assets/                                  # Sneat CSS/JS/fonts (pre-built)
│   └── 🖼️ svg/                                     # 403/404/500/503 illustrations
├── 📁 resources/views/
│   ├── 📁 auth/                                    # login, register, forgot-password
│   ├── 📁 errors/                                  # Sneat-styled 403/404/500/503 + minimal layout
│   ├── 📁 layouts/
│   │   ├── 🎨 app.blade.php                        # Authenticated layout (sidebar + navbar)
│   │   ├── 🎨 auth.blade.php                       # Guest layout (centered card)
│   │   └── 📁 partials/
│   │       ├── 📋 sidebar.blade.php                # Permission-aware menu
│   │       ├── 🧭 navbar.blade.php
│   │       ├── 📝 footer.blade.php
│   │       └── 🏷️ brand-logo.blade.php
│   └── 📁 pages/
│       ├── 📊 dashboard.blade.php
│       ├── 📁 users/{index,create,edit}.blade.php
│       ├── 📁 roles/{index,create,edit,_form}.blade.php
│       └── 📁 permissions/{index,create,edit}.blade.php
└── 📁 routes/
    └── 🛣️ web.php                                  # সব routes
```

---

## 🔐 Roles ও Permissions

### 📜 Seeded permissions (13টি)

[database/seeders/RolesAndPermissionsSeeder.php](database/seeders/RolesAndPermissionsSeeder.php) এ define করা:

| 📂 Group | 🔑 Permissions |
|-------|-------------|
| 👤 User management | `user.view`, `user.create`, `user.edit`, `user.delete` |
| 🎭 Role management | `role.view`, `role.create`, `role.edit`, `role.delete` |
| 🛡️ Permission management | `permission.view`, `permission.create`, `permission.edit`, `permission.delete` |
| 📊 Dashboard | `dashboard.view` |

### 🎭 Seeded roles

| 🎭 Role | 🔑 Permissions |
|------|-------------|
| 👑 **Admin** | সব 13টি (এছাড়া `Gate::before` দিয়ে সব check বাইপাস করে) |
| 👔 **Manager** | `dashboard.view`, `user.view/create/edit`, `role.view` |
| 👤 **User** | `dashboard.view` |

### 🔒 Permissions কীভাবে enforce হয়

তিনটি লেয়ারে কাজ করে:

1. **🛣️ Route middleware** — প্রতিটি route এ `permission:<name>` দিয়ে apply করা:
   ```php
   Route::get('/dashboard', ...)->middleware('permission:dashboard.view');
   ```

2. **⚙️ Controller constructor middleware** — প্রতিটি CRUD method gated:
   ```php
   public function __construct()
   {
       $this->middleware('permission:user.view')->only(['index', 'show']);
       $this->middleware('permission:user.create')->only(['create', 'store']);
       $this->middleware('permission:user.edit')->only(['edit', 'update']);
       $this->middleware('permission:user.delete')->only(['destroy']);
   }
   ```

3. **🎨 Blade directives** — UI elements (button, menu) conditionally render হয়:
   ```blade
   @can('user.create')
     <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
   @endcan

   @canany(['user.view', 'role.view', 'permission.view'])
     <li class="menu-header">Administration</li>
   @endcanany
   ```

### 👑 Admin bypass

[app/Providers/AppServiceProvider.php](app/Providers/AppServiceProvider.php) এ `Gate::before` register করা — যাতে **Admin** role এর user explicit permission ছাড়াই সব authorization check pass করে:

```php
Gate::before(function ($user, $ability) {
    return $user->hasRole('Admin') ? true : null;
});
```

### 🛡️ Safety guards

- ❌ **Admin** role delete করা যায় না ([RoleController::destroy](app/Http/Controllers/RoleController.php))
- ❌ User নিজের account নিজে delete করতে পারে না ([UserController::destroy](app/Http/Controllers/UserController.php))
- ✅ নতুন self-registered user-দের স্বয়ংক্রিয়ভাবে `User` role assign হয়

---

## 🛣️ রাউট রেফারেন্স

সব routes [routes/web.php](routes/web.php) এ define করা।

### 🌐 Guest routes (`middleware: guest`)

| 🔧 Method | 🔗 URI | 🎯 Controller | 🏷️ Name |
|--------|-----|------------|------|
| GET | `/login` | `LoginController@showLoginForm` | `login` |
| POST | `/login` | `LoginController@login` | — |
| GET | `/register` | `RegisterController@showRegistrationForm` | `register` |
| POST | `/register` | `RegisterController@register` | — |
| GET | `/forgot-password` | `ForgotPasswordController@showLinkRequestForm` | `password.request` |
| POST | `/forgot-password` | `ForgotPasswordController@sendResetLinkEmail` | `password.email` |

### 🔐 Authenticated routes (`middleware: auth`)

| 🔧 Method | 🔗 URI | 🛡️ Permission gate | 🏷️ Name |
|--------|-----|-----------------|------|
| POST | `/logout` | — | `logout` |
| GET | `/dashboard` | `dashboard.view` | `dashboard` |
| Resource | `/users` | `user.{view,create,edit,delete}` | `users.*` |
| Resource | `/roles` | `role.{view,create,edit,delete}` | `roles.*` |
| Resource | `/permissions` | `permission.{view,create,edit,delete}` | `permissions.*` |

---

## 🔑 অথেনটিকেশন

### 🚪 Login flow

[app/Http/Controllers/Auth/LoginController.php](app/Http/Controllers/Auth/LoginController.php)

- ✅ `email` + `password` validate করে
- 🔐 Optional "Remember me" checkbox সহ `Auth::attempt()` call করে
- 🔄 Success হলে session regenerate করে এবং intended URL এ redirect (default `/dashboard`)
- ❌ Fail হলে standard `auth.failed` validation message throw করে

### 📝 Registration flow

[app/Http/Controllers/Auth/RegisterController.php](app/Http/Controllers/Auth/RegisterController.php)

- ✅ Validate করে: `name`, `email` (unique), `password` (min 6, confirmed), `terms` (accepted হতে হবে)
- 🔒 Password hash করে এবং user create করে
- 👤 `$user->assignRole('User')` দিয়ে স্বয়ংক্রিয়ভাবে `User` role assign করে
- 🚪 সঙ্গে সঙ্গে login করিয়ে `/dashboard` এ redirect করে

### 🔓 Password reset

[app/Http/Controllers/Auth/ForgotPasswordController.php](app/Http/Controllers/Auth/ForgotPasswordController.php)

- 📧 Laravel এর `Password` broker দিয়ে reset link পাঠায়
- ⚠️ **নোট:** Email আসলেই send হওয়ার জন্য `.env` এ `MAIL_*` settings configure করতে হবে

---

## ❌ এরর পেজ

Sneat-styled error pages [resources/views/errors/](resources/views/errors/) এ আছে। এগুলো `APP_DEBUG=false` থাকলে স্বয়ংক্রিয়ভাবে render হয়।

| 🔢 Code | 📄 View | 🖼️ Illustration |
|------|------|---------------|
| 🚫 403  | `errors/403.blade.php` | `public/svg/403.svg` |
| ❓ 404  | `errors/404.blade.php` | `public/svg/404.svg` |
| 💥 500  | `errors/500.blade.php` | `public/svg/500.svg` |
| 🔧 503  | `errors/503.blade.php` | `public/svg/503.svg` |

চারটিই [resources/views/errors/minimal.blade.php](resources/views/errors/minimal.blade.php) shared layout extend করে, যেটা Sneat এর `page-misc.css` styling ব্যবহার করে।

### 🎯 প্রতিটি page কীভাবে trigger হয়

| 🔢 Code | ⚡ Trigger |
|------|---------|
| 🚫 403 | Permission নেই এমন user gated route এ visit করলে |
| ❓ 404 | যেকোনো non-existent URL |
| 💥 500 | Uncaught exception (শুধু `APP_DEBUG=false` এ দেখা যায়; নাহলে Ignition page দেখাবে) |
| 🔧 503 | `php artisan down` চালালে; back করতে `php artisan up` |

---

## 🎨 সাইডবার ও লেআউট

[resources/views/layouts/partials/sidebar.blade.php](resources/views/layouts/partials/sidebar.blade.php) এর sidebar logged-in user এর permission অনুযায়ী menu item auto-collapse এবং hide করে:

```blade
@can('dashboard.view')
  <li class="menu-item">…Dashboard…</li>
@endcan

@canany(['user.view', 'role.view', 'permission.view'])
  <li class="menu-header">Administration</li>
  …
@endcanany
```

🎯 Active-link highlighting Laravel এর `request()->routeIs()` helper দিয়ে করা।

### 🎯 Active menu item auto-scroll (centered)

[resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php) এ একটি ছোট inline script যোগ করা আছে, যা page load এর পর active sidebar menu item ke `.menu-inner` scroll container এর **vertically center** এ এনে দেয়। অনেক menu item থাকলে user কে আর scroll করে active page খুঁজতে হয় না।

🤔 **কেন custom script দরকার?** Sneat এর built-in `Helpers.scrollToActive()` এ একটি 2/3 height guard থাকে — অর্থাৎ active item যদি menu এর top 2/3 অংশের মধ্যে থাকে, তাহলে scroll-ই করে না। আমাদের custom script সবসময় active item কে center এ নিয়ে আসে।

⚙️ **কীভাবে কাজ করে:**

- 🍃 `li.menu-item.active:not(.open)` দিয়ে deepest (leaf) active item খুঁজে — কারণ parent item গুলোতে `.active.open` class থাকে, leaf item এ শুধু `.active`
- 📐 `getBoundingClientRect()` দিয়ে item এর offset হিসাব করে এবং `.menu-inner` এর `clientHeight / 2` থেকে item এর half-height বাদ দিয়ে scroll target নির্ধারণ করে
- 🛡️ `Math.max(0, Math.min(target, scrollHeight - clientHeight))` দিয়ে clamp করে — top/bottom edge এ থাকলে bound cross করে না
- 📡 `ps-scroll-y` event dispatch করে Perfect Scrollbar এর shadow indicator update করে

দুইটি layout আছে:

- 🔐 [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php) — full admin layout (sidebar + navbar + footer), authenticated pages এর জন্য
- 🌐 [resources/views/layouts/auth.blade.php](resources/views/layouts/auth.blade.php) — minimal centered layout, guest pages এর জন্য

---

## 💡 দরকারি Artisan কমান্ড

```bash
# 🔄 Migration scratch থেকে re-run + reseed (⚠️ DESTRUCTIVE — সব table drop করে)
php artisan migrate:fresh --seed

# 🌱 শুধু role/permission/user data re-seed (firstOrCreate এর কারণে idempotent)
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=UserSeeder

# 🧹 সব cache clear (config, route, view, compiled)
php artisan optimize:clear

# 🛣️ সব routes inspect করুন (middleware সহ)
php artisan route:list

# 🔍 Tinker REPL — ad-hoc DB queries এর জন্য
php artisan tinker

# 🔧 Maintenance mode toggle (503 page trigger করে)
php artisan down
php artisan up
```

---

## 🔧 সমস্যা সমাধান (Troubleshooting)

### ❌ `Target class [permission] does not exist`

[app/Http/Kernel.php](app/Http/Kernel.php) এ Spatie এর middleware aliases missing। নিম্নলিখিতভাবে register করতে হবে:

```php
'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```

### ❌ `SQLSTATE[42000]: Specified key was too long; max key length is 1000 bytes`

আপনার MySQL `utf8mb4` সহ MyISAM ব্যবহার করছে। `config/database.php` এ engine InnoDB তে pin করা আছে, কিন্তু cached config clear করতে হবে:

```bash
php artisan config:clear
php artisan migrate:fresh
```

### ❌ `Cannot make non static method Illuminate\Routing\Controller::middleware() static`

`HasMiddleware` interface এবং static `middleware()` method Laravel 11+ এর feature। এই project Laravel 10 ব্যবহার করে, তাই middleware controller constructor এ register করতে হবে — working pattern এর জন্য [UserController](app/Http/Controllers/UserController.php) দেখুন।

### ❌ MSSQL connection refused

`pdo_sqlsrv` extension install করা এবং `php.ini` তে enable আছে কিনা check করুন:

```bash
php -m | grep sqlsrv
```

---

## 🚢 ডিপ্লয়মেন্ট

### ✅ Production checklist

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
```

### ⚙️ Production এর জন্য `.env`

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true
```

> 💡 `APP_DEBUG=false` থাকলে Laravel `resources/views/errors/` এর custom error pages render করবে, Ignition debug page এর বদলে।

---

## 📄 লাইসেন্স

🆓 এই project [MIT license](https://opensource.org/licenses/MIT) এর অধীনে open-source।

🎨 Sneat Bootstrap admin template [ThemeSelection](https://themeselection.com) এর property এবং তাদের free license terms এর অধীনে included।

---

<p align="center">Made with ❤️ using Laravel + Sneat</p>
