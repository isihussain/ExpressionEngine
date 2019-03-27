<?php
/**
 * This source file is part of the open source project
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2019, EllisLab Corp. (https://ellislab.com)
 * @license   https://expressionengine.com/license Licensed under Apache License, Version 2.0
 */

namespace EllisLab\ExpressionEngine\Library\CP\EntryManager\Columns;

use EllisLab\ExpressionEngine\Library\CP\EntryManager\Columns\Column;
use EllisLab\ExpressionEngine\Library\CP\Table;

/**
 * Checkbox Column
 */
class Checkbox extends Column
{
	public function getTableColumnLabel()
	{
		return 'checkbox';
	}

	public function getTableColumnConfig()
	{
		return [
			'type' => Table::COL_CHECKBOX
		];
	}

	public function renderTableCell($entry)
	{
		$title = ee('Format')->make('Text', $entry->title)->convertToEntities();

		return [
			'name' => 'selection[]',
			'value' => $entry->getId(),
			'disabled' => ! $this->canEdit($entry) && ! $this->canDelete($entry),
			'data' => [
				'title' => $title,
				'channel-id' => $entry->Channel->getId(),
				'confirm' => lang('entry') . ': <b>' . $title . '</b>'
			]
		];
	}
}
