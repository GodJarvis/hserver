<?php
declare(strict_types=1);

namespace App\Model\MongoDB;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\GoTask\MongoClient\Collection;
use Hyperf\GoTask\MongoClient\MongoClient;
use Hyperf\Stringable\Str;
use function Hyperf\Support\class_basename;

class Model
{
    public string $poolName = 'default';

    public string $database;

    public string $collection;

    #[Inject]
    protected MongoClient $mongoClient;

    #[Inject]
    protected ConfigInterface $config;

    public function setDatabase(string $database)
    {
        $this->database = $database;
        return $this;
    }

    public function getDatabase(): string
    {
        if (!isset($this->database)) {
            $this->setDatabase($this->config->get('mongodb.db', 'hyperf'));
        }
        return $this->database;
    }

    public function setCollection(string $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function getCollection(): string
    {
        if (!isset($this->collection)) {
            $this->setCollection(str_replace('\\', '', Str::snake(Str::singular(class_basename($this)))));
        }
        return $this->collection;
    }

    public static function query()
    {
        return (new static())->newCollection();
    }

    public function newQuery()
    {
        return self::query();
    }

    private function newCollection(): Collection
    {
        return $this->mongoClient->database($this->getDatabase())->collection($this->getCollection());
    }

    public function __call(string $method, array $parameters)
    {
        return $this->newCollection()->$method(...$parameters);
    }

    public static function __callStatic(string $method, array $parameters)
    {
        return self::query()->$method(...$parameters);
    }
}
