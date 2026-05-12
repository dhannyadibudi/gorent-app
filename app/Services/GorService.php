<?php

namespace App\Services;

use App\Repositories\Interfaces\GorRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GorService
{
    public function __construct(
        protected GorRepositoryInterface $gorRepository
    ) {}

    public function paginate(
        int $perPage = 10,
        ?string $search = null,
        ?bool $isActive = null
    ) {
        return $this->gorRepository
            ->paginate($perPage, $search, $isActive);
    }

    public function create(array $data)
    {
        if (isset($data['thumbnail'])) {

            $data['thumbnail'] = $this
                ->uploadThumbnail($data['thumbnail']);

        }

        return $this->gorRepository
            ->create($data);
    }

    public function update(string $id, array $data)
    {
        if (isset($data['thumbnail'])) {

            $data['thumbnail'] = $this
                ->uploadThumbnail($data['thumbnail']);

        }

        return $this->gorRepository
            ->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->gorRepository
            ->delete($id);
    }

    private function uploadThumbnail(
        UploadedFile $file
    ): string {

        return $file->store(
            'gors',
            'public'
        );
    }

    public function findById(string $id)
    {
        return $this->gorRepository
            ->findById($id);
    }
}