<?php
require_once('../../class2.php');
if ( ! getperms('P') || ! e107::isInstalled('mentions')) {
	e107::redirect('admin');
	exit;
}

e107::lan('mentions', 'admin', true);


class mentions_adminArea extends e_admin_dispatcher
{
	protected $modes = [
		'main' => [
			'controller' => 'mentions_ui',
			'path'       => null,
			'ui'         => 'mentions_form_ui',
			'uipath'     => null,
		],
	];

	protected $adminMenu = [

		'main/prefs' => ['caption' => LAN_PREFS, 'perm' => 'P'],

	];

	protected $menuTitle = 'Mentions';

}


class mentions_ui extends e_admin_ui
{
	protected $pluginTitle = 'Mentions';

	protected $pluginName = 'mentions';


	protected $mentionsContexts = [
		1 => 'Forum + Chatbox',
		2 => 'Forum + Chatbox + Comments',
		3 => 'Forum + Chatbox + Comments + News',
	];

	protected $preftabs = [
		'Main',
		'Suggestion Pop-up'
	];

	protected $prefs = [
		'mentions_active'   => [
			'title' => 'Enable/Disable',
			'tab'   => 0,
			'type'  => 'boolean',
			'data'  => 'int',
			'help'  => 'Turn On/Off Mentions Globally',
		],
		'mentions_contexts' => [
			'title' => 'Parse \'mentions\' in these contexts:',
			'tab'   => 0,
			'type'  => 'dropdown',
			'size'  => 'xxxlarge',
			'data'  => 'int',
			'help'  => '\'mentions\' is called in what text parse context.',
		],
		'use_global_path' => [
			'title' => 'Use global path for JS libraries:',
			'tab'   => 0,
			'type'  => 'boolean',
			'data'  => 'int',
			'help'  => 'Use global path (\'e107_web/lib/\')to load jQuery auto-complete libraries from.',
		],
		'atwho_min_char'   => [
			'title' => '<p>Min. number of characters to input after <kbd>@</kbd> to show suggestion popup-list.</p><kbd>Range: 0 - 20, Recommended: 2</kbd>',
			'tab'   => 1,
			'type'  => 'number',
			'data'  => 'int',
			'help'  => 'Minimum number of characters required to input after `@` sign to show suggestion popup-list (0 - 20):',
		],
		'atwho_max_char'   => [
			'title' => '<p>Max number of char. after <kbd>@</kbd> that would be matched to populate suggestion</p>  <kbd>Upto: 20</kbd>',
			'tab'   => 1,
			'type'  => 'number',
			'data'  => 'int',
			'help'  => 'Max number of characters after `@` that would be matched to populate suggestion.',
		],
		'atwho_item_limit' => [
			'title' => 'Number of username entries to show in popup-list',
			'tab' => 1,
			'type' => 'number',
			'data' => 'int',
			'help' => 'Number of username entries to show in suggestion popup-list',
		]

	];

	protected $fieldpref = [];


	public function init()
	{
		$this->prefs['mentions_contexts']['writeParms'] =
			$this->mentionsContexts;
	}

}


class mentions_form_ui extends e_admin_form_ui
{
}


new mentions_adminArea();

require_once(e_ADMIN . "auth.php");

e107::getAdminUI()->runPage();

require_once(e_ADMIN . "footer.php");
exit;
