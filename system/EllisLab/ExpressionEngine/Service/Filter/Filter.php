<?php
namespace EllisLab\ExpressionEngine\Service\Filter;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use EllisLab\ExpressionEngine\Library\CP\URL;
use EllisLab\ExpressionEngine\Service\View\ViewFactory;

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		http://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine abstract Filter Class
 *
 * @package		ExpressionEngine
 * @category	Service
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
abstract class Filter {

	/**
	 * @var string The name="" attribute and query string parameter name for
	 *             this filter
	 */
	public $name;

	/**
	 * @var stirng A language key to use for the display label
	 */
	protected $label;

	/**
	 * @var mixed The default value to use for this filter when no value is
	 *   submitted
	 */
	protected $default_value;

	/**
	 * @var string The display-ready value of the filter (i.e. 'admin' instead
	 *  of 1)
	 */
	protected $display_value;

	/**
	 * @var mixed The value to use for this filter (overrides any submitted data)
	 */
	protected $selected_value;

	/**
	 * @var array An associative array to use to build the option list. The
	 *   keys will be used as the values passed back, and the values will be
	 *   used for display. i.e.
	 *     'installed'   => lang('installed'),
	 *     'uninstalled' => lang('uninstalled')
	 */
	protected $options = array();

	/**
	 * @var string The value to use for the custom input's placeholder="" attribute
	 */
	protected $placeholder;

	/**
	 * @var bool Whether or not this filter has a custom <input> element
	 */
	protected $has_custom_value = TRUE;

	/**
	 * @var string The name of the view to use when rendering
	 */
	protected $view = 'filter';

	/**
	 * Determines the value of this filter. If a selected_value was set, that
	 * is used. Otherwise we'll determine the value by using the POST value, GET
	 * vale or default value (in that order).
	 *
	 * @return mixed The value of the filter
	 */
	public function value()
	{
		if (isset($this->selected_value))
		{
			return $this->selected_value;
		}

		$value = $this->default_value;

		if (isset($_POST[$this->name]) && ! empty($_POST[$this->name]))
		{
			$value = $_POST[$this->name];
		}
		elseif (isset($_GET[$this->name]))
		{
			$value = $_GET[$this->name];
		}

		return $value;
	}

	/**
	 * This is a stub for validation.
	 *
	 * @return bool True (assumed to be valid)
	 */
	public function isValid()
	{
		return TRUE;
	}

	/**
	 * This renders the filter into HTML.
	 *
	 * @uses ViewFactory::make to create a View instance
	 * @uses \EllisLab\ExpressionEngine\Service\View\View::render to generate HTML
	 *
	 * @param ViewFactory $view A view factory responsible for making a view
	 * @param URL $url A URL object for use in generating URLs for the filter
	 *   options
	 * @return string Returns HTML
	 */
	public function render(ViewFactory $view, URL $url)
	{
		$value = $this->display_value;
		if (is_null($value))
		{
			$value = (array_key_exists($this->value(), $this->options)) ?
				$this->options[$this->value()] :
				$this->value();
		}

		$filter = array(
			'label'            => $this->label,
			'name'             => $this->name,
			'value'            => $value,
			'has_custom_value' => $this->has_custom_value,
			'custom_value'     => (array_key_exists($this->name, $_POST)) ? $_POST[$this->name] : FALSE,
			'placeholder'      => $this->placeholder,
			'options'          => $this->prepareOptions($url),
		);
		return $view->make('filter')->render($filter);
	}

	/**
	 * Compiles URLs for all the options
	 *
	 * @uses URL::compile To generate a full URL i.e.
	 *    http://example.com/admin.php?/cp/foo/bar&perpage=25&S=12345
	 *
	 * @param obj $base_url A CP/URL object that serves as the base of the URLs
	 * @return array An associative array of the options where the key is a
	 *   URL and the value is the label. i.e.
	 *     'http://index/admin.php?cp/foo&filter_by_bar=2' => 'Baz'
	 */
	protected function prepareOptions(URL $base_url)
	{
		$options = array();
		foreach ($this->options as $show => $label)
		{
			$url = clone $base_url;
			$url->setQueryStringVariable($this->name, $show);
			$options[$url->compile()] = $label;
		}
		return $options;
	}

}
// END CLASS

/* End of file Filter.php */
/* Location: ./system/EllisLab/ExpressionEngine/Service/Filter/Filter.php */