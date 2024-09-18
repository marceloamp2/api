<?php

namespace App\Services\Image;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class StoreImageService
{
    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function run($image, int $projectId): object
    {
        preg_match('/^data:image\/(\w+);base64,/', $image, $type);

        $image = base64_decode(substr($image, strpos($image, ',') + 1));

        $fileName = uniqid() . '.' . strtolower($type[1]);

        $filePath = 'layouts/' . $fileName;

        Storage::put($filePath, $image);

        return $this->image->create([
            'name' => $filePath,
            'url' => $filePath,
            'project_id' => $projectId,
        ]);
    }
}
