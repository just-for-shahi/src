<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */
    'route' => [
        'prefix' => 'translations',
        'namespace' => 'HighSolutions\TranslationManager',
        'middleware' => [
	        'web',
	        'admin',
		],
    ],

	/**
	 * Enable deletion of translations
	 *
	 * @type boolean
	 */
	'delete_enabled' => true,

	/**
	 * Exclude specific groups from Laravel Translation Manager. 
	 * This is useful if, for example, you want to avoid editing the official Laravel language files.
	 *
	 * @type array
	 *
	 * 	array(
	 *		'pagination',
	 *		'reminders',
	 *		'validation',
	 *	)
	 */
	'exclude_groups' => array(),

    /**
     * Exclude specific langs from Laravel Translation Manager.
     * This is useful if, for example, you want to avoid editing spare lang files or vendor catalog.
     *
     * @type array
     *
     *  array(
     *      'en',
     *      'vendor',
     *  )
     */
    'exclude_langs' => array(
        'vendor',
        // ...
    ),

    /**
     * Basic language used by translator.
     */
    'basic_lang' => 'en',

	/**
	 * Export translations with keys output alphabetically.
	 */
	'sort_keys ' => false,

	/**
	 * Highlight lines with locale marked (e.g. EN at the end of text)
	 */
	'highlight_locale_marked' => false,

	/**
	 * Enable live translation of content.
	 */
	'live_translation_enabled' => false,

	/**
	 * Position of live translation popup.
	 */
	'popup_placement' => 'top',

	/**
	 * Define who and when can manage module.
	 * 
	 * @return bool
	 */
	'permissions' => env('APP_ENV') == 'local',

);
