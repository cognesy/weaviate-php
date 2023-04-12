<?php

namespace Weaviate\Api;

use Weaviate\Collections\ObjectCollection;
use Weaviate\Model\ObjectModel;

class Objects extends Endpoint
{
    public const ENDPOINT = 'objects';

    public function get(): ObjectCollection
    {
        return new ObjectCollection(
            $this->api->get(self::ENDPOINT)->json()
        );
    }

    public function getObject(string $className, string $id): Object
    {
        return new ObjectModel(
            $this->api->get(self::ENDPOINT . '/' . $className . '/' . $id)->json()
        );
    }

    public function create(array $data): ObjectModel
    {
        return new ObjectModel(
            $this->api->post(self::ENDPOINT, $data)->json()
        );
    }

    public function update(string $className, string $id, array $data, bool $replace = false): ObjectModel
    {
        return new ObjectModel(
            $this->api->{$replace ? 'put' : 'patch'}(self::ENDPOINT . '/' . $className . '/' . $id, $data)->json()
        );
    }

    public function replace(string $className, string $id, array $data): ObjectModel
    {
        return $this->update($className, $id, $data, true);
    }
}
