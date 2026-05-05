# 🎨 Sneat Laravel Layout

একটি production-ready Laravel 10 starter project, যেটি **[Sneat Bootstrap 5](https://themeselection.com/products/sneat-bootstrap-html-admin-template/) admin template** এর উপরে তৈরি। এতে আছে:

- 🛡️ সম্পূর্ণ **Role/Permission-based access control** (matrix UI সহ)
- 🗂️ **DB-driven dynamic sidebar** (Menu Manager থেকে add/edit/reorder)
- 🌗 **User-wise dark/light theme** (DB তে saved preference)
- 🔔 **Toast notifications** (success/error/warning/info)
- 👤 **Avatar upload** ও **My Profile** page
- 📊 **Dashboard** with real project stats
- 🔍 **Search + pagination + per-page selector** সব table এ

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
- [🛡️ Assign Permissions Matrix](#️-assign-permissions-matrix)
- [🛣️ রাউট রেফারেন্স](#-রাউট-রেফারেন্স)
- [🔑 অথেনটিকেশন](#-অথেনটিকেশন)
- [👤 My Profile Page](#-my-profile-page)
- [📊 Dashboard](#-dashboard)
- [🗂️ Menu Manager](#️-menu-manager)
- [🎨 সাইডবার ও লেআউট](#-সাইডবার-ও-লেআউট)
- [🌗 Dark / Light Mode](#-dark--light-mode)
- [🔔 Toast Notifications](#-toast-notifications)
- [🖼️ Avatar / Profile Image](#️-avatar--profile-image)
- [🔍 Search ও Pagination](#-search-ও-pagination)
- [❌ এরর পেজ](#-এরর-পেজ)
- [💡 দরকারি Artisan কমান্ড](#-দরকারি-artisan-কমান্ড)
- [🔧 সমস্যা সমাধান (Troubleshooting)](#-সমস্যা-সমাধান-troubleshooting)
- [🚢 ডিপ্লয়মেন্ট](#-ডিপ্লয়মেন্ট)
- [📄 লাইসেন্স](#-লাইসেন্স)

---

## ✨ ফিচারসমূহ

### 🎨 UI / UX
- **Sneat Bootstrap 5 admin template** — modern, fully responsive
- **🌗 User-wise dark/light theme** — navbar toggle, DB তে save (`users.theme` column)
- **🔔 Toast notifications** — success/error/warning/info, auto-dismiss
- **🔄 Active menu auto-scroll** — page load এ active item center এ scroll হয়
- **🖼️ Avatar system** — upload + default fallback (storage link দিয়ে serve)
- **🚫 Demo content removed** — "Upgrade to Pro" button, footer template links সরানো হয়েছে

### 🔐 Auth & Authorization
- **Login, Register, Forgot Password** — Sneat-styled forms
- **Role-Based Access Control** — [spatie/laravel-permission](https://spatie.be/docs/laravel-permission) দিয়ে
- **18 granular permissions** (users, roles, permissions, menus, dashboard, assign)
- **3 pre-seeded roles** — Admin, Manager, User
- **Admin** role auto-bypasses সব permission check (`Gate::before`)
- **Direct user permissions** — role এর বাইরে user-কে individual permission দেওয়া যায়
- **🛡️ Permissions Matrix UI** — সব role × permission এক page এ bulk assign

### 📝 CRUD Modules
- **Users** — avatar, role assign, search by name/email
- **Roles** — permission assign (grouped, "select all" toggle)
- **Permissions** — name-based search
- **Menu Items** — sidebar dynamic, parent/child, icon, route, permission gate

### 📊 Dashboard
- Welcome banner with logged-in user info
- Stats cards: Users / Roles / Permissions / Active Menus
- Recent users list, role distribution chart, system info
- Permission-aware widget visibility

### 👁️ Sidebar
- **DB-driven** — Menu Manager থেকে edit করলে sidebar instantly update
- **Permission-aware** — যে permission নেই, menu item-ও দেখাবে না
- **Smart section header** — section এর নিচে visible item না থাকলে header হাইড
- **Auto-scroll** active item to vertical center

### 🗄️ Multi-DB & Misc
- **MySQL / SQLite / MSSQL** support
- **Bootstrap 5 pagination** + per-page selector (10/25/50/100)
- **Search + filter preserved** with `withQueryString()`
- **Custom error pages** (403/404/500/503) Sneat-styled

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
| 🖼️ File storage | `storage/app/public` + symlink to `public/storage` |

---

## 📋 প্রয়োজনীয়তা

- 🐘 **PHP 8.1+** — extensions: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd` (image upload)
- 📦 **Composer 2.x**
- 🟢 **Node.js 18+ ও npm** (front-end assets rebuild করতে হলে)
- 🗄️ **যেকোনো একটি database**:
  - 📁 SQLite 3 (default — সবচেয়ে সহজ), **অথবা**
  - 🐬 MySQL 5.7+ / MariaDB 10.3+, **অথবা**
  - 🪟 SQL Server 2017+ ([`pdo_sqlsrv`](https://learn.microsoft.com/en-us/sql/connect/php/microsoft-php-driver-for-sql-server))

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

# 4️⃣ Storage symlink (avatar uploads এর জন্য)
php artisan storage:link

# 5️⃣ Migration ও seed
php artisan migrate --seed

# 6️⃣ (Optional) Vite assets rebuild
npm install && npm run build

# 7️⃣ চালু
php artisan serve
```

> 💡 **নোট:** Sneat template এর সব assets আগে থেকেই pre-built `public/assets/` এ আছে — সাধারণ ব্যবহারে **`npm install` লাগবে না**।

---

## 🗄️ ডাটাবেস কনফিগারেশন

`.env` ফাইলে `DB_CONNECTION` বদলে যেকোনো database ব্যবহার করুন।

### 📁 SQLite (default — recommended for quick start)

```env
DB_CONNECTION=sqlite
DB_DATABASE=D:\full\absolute\path\to\database\database.sqlite
```

> ⚠️ SQLite এ **absolute path** দিতে হয় (relative path কাজ করে না)। Windows e backslash `\\` বা Unix-style `/` দুটোই কাজ করে।

```bash
touch database/database.sqlite     # খালি file তৈরি
php artisan migrate --seed
```

### 🐬 MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sneat_laravel_layout
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ MySQL এর জন্য InnoDB engine enforce করা আছে — Spatie এর composite unique index handle করতে। `Schema::defaultStringLength(191)` শুধু MySQL এ auto-apply হয় ([AppServiceProvider.php](app/Providers/AppServiceProvider.php))।

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
| `superadmin@example.com` | 👑 Super Admin | সম্পূর্ণ access — সব gate বাইপাস |
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
│   │   ├── 📊 DashboardController.php           # Stats + recent users + system info
│   │   ├── 👤 ProfileController.php             # My profile (account + password)
│   │   ├── 🛡️ AssignPermissionController.php    # Matrix UI (role-wise + user-wise)
│   │   ├── 🗂️ MenuController.php                # Menu items CRUD
│   │   ├── 🛡️ PermissionController.php          # Permissions CRUD
│   │   ├── 🎭 RoleController.php                # Roles CRUD
│   │   └── 👤 UserController.php                # Users CRUD with avatar upload
│   ├── 📁 Models/
│   │   ├── 🗂️ Menu.php                          # parent/children, href(), isActive()
│   │   └── 👤 User.php                          # HasRoles + avatarUrl() + theme
│   └── 📁 Providers/
│       └── ⚙️ AppServiceProvider.php            # Gate::before + sidebar View Composer
├── 📁 database/
│   ├── 📁 migrations/
│   │   ├── 📜 *_create_permission_tables.php
│   │   ├── 📜 *_create_menus_table.php
│   │   ├── 📜 *_add_avatar_to_users_table.php
│   │   └── 📜 *_add_theme_to_users_table.php
│   └── 📁 seeders/
│       ├── 🌱 DatabaseSeeder.php
│       ├── 🌱 RolesAndPermissionsSeeder.php     # 18 perms + 3 roles
│       ├── 🌱 UserSeeder.php                    # 4 test users (incl. Super Admin)
│       └── 🌱 MenuSeeder.php                    # Default menu items
├── 📁 public/
│   ├── 🎨 assets/                              # Sneat CSS/JS/fonts (pre-built)
│   │   └── 📁 css/
│   │       └── 🌗 dark-mode.css                 # Dark theme overrides
│   ├── 🔗 storage/                             # symlink → storage/app/public
│   └── 🖼️ svg/                                 # 403/404/500/503 illustrations
├── 📁 storage/app/public/
│   ├── 🖼️ default-avatar.png                   # Fallback avatar
│   └── 📁 avatars/                             # Uploaded user avatars
├── 📁 resources/views/
│   ├── 📁 auth/                                # login, register, forgot-password
│   ├── 📁 errors/                              # 403/404/500/503
│   ├── 📁 layouts/
│   │   ├── 🎨 app.blade.php                    # Authenticated layout
│   │   ├── 🎨 auth.blade.php                   # Guest layout
│   │   └── 📁 partials/
│   │       ├── 🗂️ sidebar.blade.php            # DB-driven dynamic menu
│   │       ├── 🧭 navbar.blade.php             # Theme toggle + user dropdown
│   │       ├── 🔔 toasts.blade.php             # Toast notifications
│   │       └── 📝 footer.blade.php
│   └── 📁 pages/
│       ├── 📊 dashboard.blade.php
│       ├── 📁 profile/index.blade.php          # Account + Security tabs
│       ├── 📁 assign-permissions/index.blade.php
│       ├── 📁 menus/{index,create,edit,_form}.blade.php
│       ├── 📁 users/{index,create,edit}.blade.php
│       ├── 📁 roles/{index,create,edit,_form}.blade.php
│       └── 📁 permissions/{index,create,edit}.blade.php
└── 📁 routes/
    └── 🛣️ web.php
```

---

## 🔐 Roles ও Permissions

### 📜 Seeded permissions (18টি)

| 📂 Group | 🔑 Permissions |
|---|---|
| 👤 User management | `user.view`, `user.create`, `user.edit`, `user.delete` |
| 🎭 Role management | `role.view`, `role.create`, `role.edit`, `role.delete` |
| 🛡️ Permission management | `permission.view`, `permission.create`, `permission.edit`, `permission.delete`, `permission.assign` |
| 🗂️ Menu management | `menu.view`, `menu.create`, `menu.edit`, `menu.delete` |
| 📊 Dashboard | `dashboard.view` |

### 🎭 Seeded roles

| 🎭 Role | 🔑 Permissions |
|---|---|
| 👑 **Admin** | সব 18টি + `Gate::before` দিয়ে সব check বাইপাস |
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

## 🛡️ Assign Permissions Matrix

> **Access Control → Assign Permissions** menu থেকে accessible (permission: `permission.assign`)।

দুটি **tab** এ split করা:

### 🪪 By Role tab
- প্রতিটি permission group আলাদা **collapsible card** এ (dashboard, user, role, permission, menu)
- **Matrix table** — rows = roles, columns = permissions
- **Column header toggle** → সব role এ একই permission একসাথে on/off
- **Row end "All" toggle** → এক role এ ওই group এর সব permission একসাথে on/off
- **Indeterminate state** support (partial selection দেখায়)

### 👤 By User tab
- প্রতিটি user এর **avatar + role(s)** দেখায়
- **Direct user permissions** — role এর extra হিসেবে কাজ করে
- যে permission already role এ আছে, পাশে 🔗 **chain icon** (tooltip: "Granted via role")
- Avatar সহ stats card (Users, Direct Assigned, Coverage %)

### 📊 Live features
- **Stats dashboard** top এ — Total Roles/Users/Permissions, Assigned count, Coverage % (animated progress bar)
- **Per-group counter** — "X / Y cells assigned" header এ live update
- **Sticky save bar** — bottom এ floating, "Unsaved changes" badge
- **Sticky role/user column** — horizontal scroll এ left side fixed

### ⚙️ Backend logic
```php
// Single save handles both role & user matrix
$role->syncPermissions($matrix[$role->id] ?? []);          // role-wise
$user->syncPermissions($userMatrix[$user->id] ?? []);      // user-wise direct
PermissionRegistrar::forgetCachedPermissions();
```

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
| Resource | `/menus` (no `show`) | `menu.{view,create,edit,delete}` | `menus.*` |
| GET / PUT | `/assign-permissions` | `permission.assign` | `assign-permissions.*` |
| GET | `/profile` | — | `profile.index` |
| PUT | `/profile` | — | `profile.update` |
| PUT | `/profile/password` | — | `profile.password` |
| POST | `/preferences/theme` | — | `preferences.theme` |

---

## 🔑 অথেনটিকেশন

### 🚪 Login

- `email` + `password` validate → `Auth::attempt()` → session regenerate → `/dashboard`
- "Remember me" checkbox সাপোর্ট করে

### 📝 Registration

- Validate করে: `name`, `email` (unique), `password` (min 6, confirmed), `terms`
- Password bcrypt hash → user create → `User` role auto-assign → login → `/dashboard`

### 🔓 Password reset

- Laravel `Password` broker দিয়ে reset link send করে
- ⚠️ `.env` এ `MAIL_*` configure না করলে email যাবে না

---

## 👤 My Profile Page

> Navbar dropdown এর **My Profile** এ click করুন → `/profile`

দুটি **tab**:

### 📝 Account tab
- **Avatar upload** — live preview (FileReader), JPG/PNG/WEBP, max 2MB
- **Remove avatar** checkbox — current photo মুছে default এ ফিরবে
- **Name + Email** edit (email unique validation)
- **Roles** — read-only badge (admin only assign করতে পারে)
- **Joined date** — read-only

### 🔒 Security tab
- **Change password** — current password verify করতে হবে
- New password min 6, confirmation match
- Save এর পর session intact থাকে

```php
// app/Http/Controllers/ProfileController.php
$request->validate([
    'current_password' => ['required', 'current_password'],  // Laravel built-in rule
    'password'         => ['required', 'confirmed', Password::min(6)],
]);
```

---

## 📊 Dashboard

> `/dashboard` (`permission: dashboard.view`)

### Sections

| Section | Data |
|---|---|
| 👋 **Welcome banner** | Logged-in user name, role, today's date, avatar, quick action buttons |
| 📊 **Stats cards** (4) | Total Users / Roles / Permissions / Active Menus — clickable |
| 🕐 **Recent Users** | Last 5 registered — avatar, email, role badge, "X minutes ago" |
| 📈 **Role Distribution** | Users per role with colored progress bars |
| 🪪 **My Account** | Current user snapshot — permissions count, theme, joined date |
| 📋 **Recent Menus** | Latest 5 menu items — icon, type, parent, active badge |
| 🖥️ **System Info** | PHP version, Laravel version, DB driver, environment, server time |

**🔒 Permission-aware** — যে user এর `user.view` নেই, "Recent Users" card দেখাবে না। `menu.view` নেই, "Recent Menus" দেখাবে না।

---

## 🗂️ Menu Manager

> **Settings → Menu Manager** থেকে sidebar এর প্রতিটি item database এ manage করা যায়। কোনো code change ছাড়াই menu add, edit, reorder, বা hide করা সম্ভব।

### 🏗️ `menus` Table Schema

| Column | Type | বিবরণ |
|---|---|---|
| `id` | bigint PK | — |
| `label` | string | Sidebar এ যা দেখাবে |
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
header  ──  Section title — কোনো icon, route বা parent নেই
            ► নিচে কোনো visible item না থাকলে নিজেই লুকিয়ে যায়

toggle  ──  Collapsible parent — icon থাকে, route নেই
            ► child link গুলো menu-sub এ render হয়
            ► অন্তত একটি visible child না থাকলে render হয় না

link    ──  Regular menu item — icon, route/url, permission, parent_id সব থাকতে পারে
            ► parent_id দিলে কোনো toggle এর sub-item হয়
```

### ✏️ Add/Edit Form Fields

| Field | বিবরণ |
|---|---|
| **Label** ✱ | Sidebar এ যা লেখা দেখাবে |
| **Type** ✱ | Link / Toggle / Header — change করলে dynamic help text |
| **Sort Order** | ছোট সংখ্যা উপরে |
| **Icon** | Boxicons class (live preview সহ) |
| **Parent Toggle** | কোন collapsible parent এর নিচে বসবে |
| **Named Route** | `php artisan route:list` থেকে route name |
| **External URL** | Route না থাকলে fallback |
| **Active Route Pattern** | `users.*` wildcard — কখন highlight হবে |
| **Permission** | কারা দেখতে পাবে |
| **Active** | Off করলে sidebar এ লুকাবে |
| **Open in new tab** | External link এর জন্য |

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

কোনো `header` type item এর নিচে visible item না থাকলে সেই header টি render হয় না — "Administration" দেখাবে না যদি user এর কোনো ACL permission না থাকে। `pendingHeader` deferred-flush pattern দিয়ে implement করা।

### 🔄 Active Menu Auto-Scroll (Centered)

Page load এ active sidebar item টি `.menu-inner` এর vertically center এ আসে। Sneat এর built-in `Helpers.scrollToActive()` এ 2/3 height guard থাকায় উপরের item-এ কাজ করত না — এই custom script সবসময় center করে।

### 🖼️ Layouts

| Layout | Path | ব্যবহার |
|---|---|---|
| 🔐 Authenticated | [layouts/app.blade.php](resources/views/layouts/app.blade.php) | Sidebar + navbar + footer + toast container |
| 🌐 Guest | [layouts/auth.blade.php](resources/views/layouts/auth.blade.php) | Login, register, forgot-password |

---

## 🌗 Dark / Light Mode

> Navbar এর **moon/sun icon** click করুন — instantly toggle হবে এবং DB তে save হবে।

### 🗄️ Storage

- `users.theme` column (enum: `light` / `dark`, default `light`)
- AJAX call → `POST /preferences/theme` → updates current user

### 🎨 CSS

[public/assets/css/dark-mode.css](public/assets/css/dark-mode.css) — Sneat color override যখন `<html>` এ `dark-mode` class থাকে:
- Sidebar / Navbar / Cards / Tables / Forms / Dropdowns / Pagination
- Custom toast colors (success/warning/info/error variants)
- Code block, badges, borders

### ⚡ No flash on load

`<html>` এ initial class server-side render হয়:

```blade
<html class="light-style {{ $userTheme === 'dark' ? 'dark-mode' : '' }}">
```

---

## 🔔 Toast Notifications

> Bootstrap 5 toast দিয়ে built — top-right corner এ stack হয়, auto-dismiss।

### 4 ধরনের toast

| Type | Color | Icon | Default delay |
|---|---|---|---|
| ✅ Success | সবুজ (`#28c76f`) | `bx-check-circle` | 4s |
| ❌ Error | লাল (`#ea5455`) | `bx-x-circle` | 5s |
| ⚠️ Warning | কমলা (`#ff9f43`) | `bx-error` | 5s |
| ℹ️ Info | নীল (`#00cfe8`) | `bx-info-circle` | 4s |

### Controller থেকে use

```php
return redirect()->route('users.index')->with('status', 'User created.');
return back()->with('error', 'Something went wrong.');
return back()->with('warning', 'Please review your input.');
return back()->with('info', 'Record updated.');
```

`$errors->any()` থাকলে validation error toast auto দেখাবে।

[resources/views/layouts/partials/toasts.blade.php](resources/views/layouts/partials/toasts.blade.php) — left colored border + icon + title + message format।

---

## 🖼️ Avatar / Profile Image

### 📤 Upload

- **`users.avatar`** column (nullable string — file path)
- Storage: `storage/app/public/avatars/<file>`
- Public URL: `/storage/avatars/<file>` (via `storage:link`)
- Validation: `image | mimes:jpeg,png,jpg,webp | max:2048`
- Old image **automatically deleted** when replaced or removed

### 🎨 Default Avatar

Avatar না থাকলে **`storage/app/public/default-avatar.png`** serve হয় — কোনো external dependency নেই।

### 🛠️ Helper

```php
// app/Models/User.php
public function avatarUrl(): string
{
    if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
        return Storage::url($this->avatar);
    }
    return Storage::url('default-avatar.png');
}
```

ব্যবহার:

```blade
<img src="{{ $user->avatarUrl() }}" class="rounded-circle" width="40" height="40">
```

---

## 🔍 Search ও Pagination

### 🔎 Search

সব 4টি table-এ (Users, Roles, Permissions, Menus) search input আছে:

| Table | Search by |
|---|---|
| Users | name অথবা email |
| Roles | role name |
| Permissions | permission name |
| Menus | label |

### 📊 Pagination footer

প্রতিটি table এর footer এ:

- **"Showing X–Y of Z results"** counter
- **Per page selector** (10 / 25 / 50 / 100) — change এ auto-submit
- **Page links** — `withQueryString()` দিয়ে search/per_page preserve

### Controller pattern

```php
public function index(Request $request)
{
    $perPage = in_array(request('per_page'), [10, 25, 50, 100]) ? request('per_page') : 10;
    $search  = trim((string) $request->input('q'));

    $users = User::with('roles')
        ->when($search !== '', fn ($q) => $q->where('name', 'like', "%{$search}%")
                                              ->orWhere('email', 'like', "%{$search}%"))
        ->paginate($perPage)
        ->withQueryString();

    return view('pages.users.index', compact('users', 'search'));
}
```

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

# 🔗 Storage symlink (avatar uploads এর জন্য — once)
php artisan storage:link

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

### ❌ `Database file at path [database/database.sqlite] does not exist`

SQLite এ relative path কাজ করে না। `.env` এ **absolute path** দিন:

```env
DB_DATABASE=D:\full\absolute\path\to\database\database.sqlite
```

তারপর `php artisan config:clear`।

### ❌ Avatar image দেখা যাচ্ছে না (404)

Storage symlink missing:

```bash
php artisan storage:link
```

### ❌ Sidebar blank / menu দেখাচ্ছে না

`menus` table empty — seed চালানো হয়নি:

```bash
php artisan db:seed --class=MenuSeeder
```

### ❌ `Target class [permission] does not exist`

[app/Http/Kernel.php](app/Http/Kernel.php) এ Spatie middleware aliases নেই:

```php
'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```

### ❌ Theme toggle কাজ করছে না

CSRF token meta missing হলে AJAX fail হবে। `<head>` এ check করুন:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

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
php artisan storage:link                       # avatar uploads
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan db:seed --class=MenuSeeder         # প্রথমবার deploy এ
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

### 📁 Permissions (Linux)

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

---

## 📄 লাইসেন্স

🆓 এই project [MIT License](https://opensource.org/licenses/MIT) এর অধীনে open-source।

🎨 Sneat Bootstrap admin template [ThemeSelection](https://themeselection.com) এর property এবং তাদের free license terms এর অধীনে included।

---

<p align="center">Made with ❤️ using Laravel + Sneat</p>
