<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

/**
 * This class is responsible for getting the migration status of a flashcard set.
 * TODO: Move the db query to a repository.
 *
 *
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetMigrationStatus
{

    /**
     * This method is responsible for getting the migration status of a flashcard set.
     *
     * @return float
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute(): float
    {

        return DB::table('migrations')->exists();
    }
}
