<?php
/**
 * Created by PhpStorm.
 * User: ivansamofal
 * Date: 5/10/18
 * Time: 3:01 PM
 */

namespace common\components\migration;

use yii\db\Migration;

class MigrationExtended extends Migration
{
    public function tinyInteger($length = null)
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinyint', $length);
    }
}