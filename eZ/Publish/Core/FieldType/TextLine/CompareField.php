<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace eZ\Publish\Core\FieldType\TextLine;

use eZ\Publish\SPI\Compare\Field;
use eZ\Publish\SPI\FieldType\Comparable;
use eZ\Publish\SPI\Persistence\Content\FieldValue;

class CompareField implements Comparable
{
    public function getDataToCompare(FieldValue $value): array
    {
        return [
            'text' => new Field\StringCompareField([
                'value' => $value->data,
                'name' => 'text',
            ]),
        ];
    }
}