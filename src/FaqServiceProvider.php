<?php

namespace App\Addons\Faq;

use \App\Extensions\BaseAddonServiceProvider;
use App\Core\Menu\AdminMenuItem;
use App\Core\Admin\Dashboard\AdminCountWidget;
use Illuminate\Support\Facades\Route;

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
        $this->loadViews(); // Permet de charger les vues (views/admin et views/default)
        $this->loadTranslations(); // Permet de charger les traductions (lang/fr et lang/en)
        $this->loadMigrations(); // Permet de charger les migrations
        $this->loadViewsFrom(__DIR__.'/../views', 'faq');

        $this->app['settings']->addCardItem(
			'personalization',                // UUID de la card
			'faq',               // UUID de l'item
			'faq::messages.settings.title',// Titre de l'item
			'faq::messages.settings.description', // Description de l'item
			'bi bi-gear',                  // Icône
			'', // Action ou route
			'admin.settings.manage'        // Permission requise pour voir cet item
		);

    }
}