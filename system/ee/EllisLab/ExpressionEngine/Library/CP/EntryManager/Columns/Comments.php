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

/**
 * Comment Count Column
 */
class Comments extends Column
{
	public function getTableColumnLabel()
	{
		return 'comments';
	}

	public function renderTableCell($entry)
	{
		if ($entry->comment_total > 0 && ee()->cp->allowed_group('can_moderate_comments'))
		{
			return '(<a href="' . ee('CP/URL')->make('publish/comments/entry/' . $entry->entry_id) . '">' . $entry->comment_total . '</a>)';
		}

		return '(' . $entry->comment_total . ')';
	}
}