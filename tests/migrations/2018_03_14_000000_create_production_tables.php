<?php

use Illuminate\Database\Migrations\Migration;

require __DIR__.'/../../database/migrations/create_features_table.php.stub';
require __DIR__.'/../../database/migrations/create_feature_toggles_table.php.stub';

class CreateProductionTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        (new CreateFeaturesTable())->up();
        (new CreateFeatureTogglesTable())->up();
    }
}
