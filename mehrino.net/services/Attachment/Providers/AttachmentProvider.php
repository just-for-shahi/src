<?php

namespace Services\Attachment\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Attachment\Repositories\AttachmentRepository;
use Services\Attachment\Repositories\IAttachmentRepository;

#endregion

/**
 * Attachment
 * @author Sajadweb
 * Mon Dec 14 2020 14:24:30 GMT+0330 (Iran Standard Time)
 */
class AttachmentProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/AttachmentHelper.php";
        #endregion
        Route::middleware('web')
            ->namespace('Services\Attachment\Controllers')
            ->group(base_path('services/Attachment/Routes/web.php'));

            Route::middleware('api')
            ->prefix('api')
            ->namespace('Services\Attachment\Controllers')
            ->group(base_path('services/Attachment/Routes/api.php'));
        #region Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        #endregion
        $this->app->bind(IAttachmentRepository::class, AttachmentRepository::class);
    }
}
