<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function store(Request $request){

        $file = $request->file('file');
        $file->store('documents', 'public');
        $document = Document::Create([
            'title' => $file->getClientOriginalName(),
            'nom' => $file->hashName(),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => $request->user()->id,
        ]);
        return response()->json([
            'id' => $document->id
        ]);

    }    
    public function destroy(Document $document){
        Storage::disk('public')->delete('documents/'. $document->nom);
                $document->delete();
                return response()->json([
                    'message' => 'ok'
                ]);
    }
    public function download(Document $document){
        $path = Storage::path('public/documents/'. $document->nom);
        return response()->download($path, $document->title);
    }
}
