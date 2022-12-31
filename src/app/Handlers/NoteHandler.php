<?php

namespace App\Handlers;

use App\Models\Note;

class NoteHandler
{
    public function createNote(array $data)
    {
        $note = Note::create([
            'title' => $data['title'], 
            'description' => $data['description']
        ]);

        return $note;
    }
}