<?php
use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Model;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
	}
}
