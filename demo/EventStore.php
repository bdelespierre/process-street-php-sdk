<?php

namespace Demo;

/**
 * This class is intented for demonstration purposes
 * and SHOULD NOT BE USED IN PRODUCTION.
 */
class EventStore
{
    private string $path;
    private bool $autosave;

    /**
     * @var \SplObjectStorage<object, float>
     */
    private \SplObjectStorage $storage;

    public function __construct(?string $path = null, bool $autosave = true)
    {
        $this->path = $path ?? __DIR__ . '/default.db';
        $this->autosave = $autosave;
        $this->open();
    }

    public function __destruct()
    {
        if ($this->autosave) {
            $this->save();
        }
    }

    private function open(): void
    {
        if (!is_readable($this->path)) {
            $this->storage = new \SplObjectStorage();
            return;
        }

        $contents = file_get_contents($this->path);
        assert(is_string($contents));

        $storage = unserialize($contents);
        assert($storage instanceof \SplObjectStorage);

        $this->storage = $storage;
    }

    private function save(): void
    {
        file_put_contents($this->path, serialize($this->storage));
    }

    public function insert(object $data, ?float $time = null): void
    {
        $this->storage->attach($data, $time ?? microtime(true));
    }

    /**
     * @return \Generator<object, float>
     */
    public function findAll(): \Generator
    {
        foreach ($this->storage as $data) {
            yield $data => $this->storage[$data];
        }
    }

    public function findById(mixed $id): ?object
    {
        foreach ($this->findAll() as $data => $time) {
            if (isset($data->id) && $data->id == $id) {
                return $data;
            }
        }

        return null;
    }
}
