<?php

namespace App\Addons\Faq;

use \App\Extensions\BaseAddonServiceProvider;
use App\Core\Menu\AdminMenuItem;
use App\Core\Admin\Dashboard\AdminCountWidget;
use Illuminate\Support\Facades\Route;
use App\Addons\Faq\Controllers\Admin\FaqController;

class FaqServiceProvider extends BaseAddonServiceProvider
{
  protected string $uuid = "faq";
  protected string $name = 'faq';
  protected string $version = '1.0.0';

  public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutes();
        $this->loadTranslations(); // Permet de charger les traductions (lang/fr et lang/en)
        $this->loadMigrations(); // Permet de charger les migrations
        $this->loadViewsFrom(__DIR__.'/../views', 'faq');

        $this->app['settings']->addCardItem(
        'personalization',                // UUID de la card
        'faq',               // UUID de l'item
        'faq::messages.settings.title',// Titre de l'item
        'faq::messages.settings.description', // Description de l'item
        'bi bi-gear',                  // Icône
        [FaqController::class, 'index'], // Action ou route
        'admin.settings.manage'        // Permission requise pour voir cet item
        );
    }
    public function loadRoutes()
    {
        // Web
        Route::middleware('web')->group(function () {
            require __DIR__.'/../routes/web.php';
        });

        // Admin
        Route::middleware(['web', 'admin'])
            ->prefix(admin_prefix())   // → /admin
            ->name('admin.')
            ->group(function () {
                Route::prefix('faq')->name('faq.')->group(function () {
                    require __DIR__.'/../routes/admin.php';
                });
            });

        // API
        Route::middleware('api')
            ->prefix('api')
            ->group(function () {
                require __DIR__.'/../routes/api.php';
            });
    }
}