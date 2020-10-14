<?php

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Rememberable\Traits\Rememberable;

class RememberableTest extends TestCase
{
    private $faker;
    private $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        $this->createTestModelsTable();

        $this->model = $this->createTestModel();
    }

    /** @test */
    public function caches_model_when_creating()
    {
        $this->assertTrue($this->model->is(
            Cache::get($this->model->getCacheKey())
        ));
    }

    /** @test */
    public function updates_cached_model_when_updating()
    {
        $this->model->update(['name' => 'Updated']);

<<<<<<< HEAD
        $this->assertEquals(
            'Updated',
            Cache::get($this->model->getCacheKey())->name
        );
=======
        $this->assertEquals($rememberableModel, cache()->get('RememberableModel:'.$rememberableModel->id));
>>>>>>> origin/adminlte
    }

    /** @test */
    public function removes_cached_model_from_cache_when_deleting()
    {
        $this->model->delete();

        $this->assertFalse(
            Cache::has($this->model->getCacheKey())
        );
    }

<<<<<<< HEAD
    /** @test */
    public function gets_cached_model()
    {
        $this->assertTrue($this->model->is(
            RememberableModel::cacheGet($this->model->id)
        ));
=======
        $this->assertTrue(cache()->get('RememberableModel:'.$rememberableModel->id)->name === 'Updated');
>>>>>>> origin/adminlte
    }

    /** @test */
    public function gets_cached_model_from_memory_layer()
    {
        RememberableModel::cacheGet($this->model->id);

        Cache::forget($this->model->getCacheKey());

        $this->assertTrue($this->model->is(
            RememberableModel::cacheGet($this->model->id)
        ));

<<<<<<< HEAD
        $this->assertFalse(Cache::has($this->model->getCacheKey()));
=======
        $this->assertFalse(cache()->has('RememberableModel:'.$rememberableModel->id));
>>>>>>> origin/adminlte
    }

    private function createTestModel()
    {
        return RememberableModel::create([
            'name' => $this->faker->word
        ]);
    }

    private function createTestModelsTable()
    {
        Schema::create('rememberable_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}

class RememberableModel extends Model
{
    use Rememberable;

    protected $cacheLifetime = 100;

    protected $fillable = ['name'];
}
