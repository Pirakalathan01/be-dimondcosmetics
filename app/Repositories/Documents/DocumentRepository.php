<?php

namespace App\Repositories\Documents;

use App\Contracts\Repositories\Documents\DocumentRepositoryInterface;
use App\Models\Document;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{
    /**
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->setModel($document);
    }


    /**
     * @param array $data
     * @return Document
     */
    public function create(array $data): Document
    {
        $document = $this->model->create([
            'documentable_type' => $data['class'],
            'documentable_id' => $data['id'],
            'user_id' => $data['user_id'],
            'type' => $data['type'],
            'image_type' => $data['image_type'],
        ]);

        $model = $data['model'];
        $type = $data['type'];
        $file = $data[$type];


        $key = Str::plural($type) . '/' . Str::plural($model) . '/' . $data['id'] . '_' . time() . '.' . $file->getClientOriginalExtension();



        $document->file_name = $key;
        $document->save();

            $result = Storage::disk('s3')->put($key, file_get_contents($file));
            if ($result === false) {
                Log::error('S3 put failed', ['key' => $key, 'file' => $file]);
            } else {
                Log::info('S3 put successful', ['key' => $key]);
            }

        return $document;
    }
}
