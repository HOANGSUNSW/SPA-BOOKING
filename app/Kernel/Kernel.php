<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  /**
   * Global middleware áp dụng cho mọi request.
   */
  protected $middleware = [
    \App\Http\Middleware\TrustProxies::class,
    \Illuminate\Http\Middleware\HandleCors::class,
    \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class, // dùng class của framework
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
  ];

  /**
   * Nhóm middleware cho web và api.
   */
  protected $middlewareGroups = [
    'web' => [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      // \Illuminate\Session\Middleware\AuthenticateSession::class, // bật nếu cần
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
      \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];

  /**
   * Alias middleware cấp route (Laravel 12).
   */
  protected $middlewareAliases = [
    // mặc định...
    'auth'       => \App\Http\Middleware\Authenticate::class,
    'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified'   => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // bạn cần:
    'admin'      => \App\Http\Middleware\AdminMiddleware::class,
    'staff'      => \App\Http\Middleware\StaffMiddleware::class,      // nếu dùng
    'auth.jwt'   => \App\Http\Middleware\AuthJwtMiddleware::class,    // nếu dùng
    // 'attach.jwt' => \App\Http\Middleware\AttachJwtFromSession::class, // nếu dùng
  ];
}
