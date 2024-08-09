<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customers\Documents\DestroyRequest;
use App\Http\Requests\Api\Customers\Documents\DownloadRequest;
use App\Http\Requests\Api\Customers\Documents\IndexRequest;
use App\Http\Requests\Api\Customers\Documents\ShowRequest;
use App\Http\Requests\Api\Customers\Documents\StoreRequest;
use App\Http\Requests\Api\Customers\Documents\UpdateRequest;
use App\Models\Customer;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomersDocumentsController extends Controller
{
    public function index(IndexRequest $request, Customer $customer)
    {
        $documents = $customer->documents()->paginate();

        return response()->json($documents);
    }

    public function store(StoreRequest $request, Customer $customer)
    {
        $uuid = Str::uuid()->toString();
        $file = $request->file('file');

        $document = $customer->documents()->create([
            'name' => $request->input('name'),
            'path' => "{$uuid}.{$file->getClientOriginalExtension()}",
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        $request->file('file')->move(storage_path('/app/documents'), "{$uuid}.{$file->getClientOriginalExtension()}");

        return response()->json($document, 201);
    }

    public function show(ShowRequest $request, Customer $customer, Document $document)
    {
        return response()->json($document);
    }

    public function update(UpdateRequest $request, Customer $customer, Document $document)
    {
        $document->update([
            'name' => $request->input('name'),
        ]);

        return response()->json();
    }

    public function download(DownloadRequest $request, Customer $customer, Document $document)
    {
        return Storage::download("documents/{$document->path}");
    }

    public function destroy(DestroyRequest $request, Customer $customer, Document $document)
    {
        Storage::delete("documents/{$document->path}");
        $document->delete();

        return response()->json();
    }
}
