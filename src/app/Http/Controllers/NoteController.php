<?php

namespace App\Http\Controllers;

use App\Handlers\NoteHandler;
use App\Models\Note;
use Exception;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }

    public function create()
    {
        return view('note.create');
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        try {
            $note = $this->getNoteHandler()->createNote($data);

            $request->session()->flash('message', ['type' => 'success', 'description' => 'Note is created.']);

            return redirect()->route('note.edit', $note->id);
  

        } catch(Exception $ex) {
            // return redirect()->back();
        }
    }

    public function show($id)
    {
        $note = Note::find((int)$id)->toArray();

        return view('note.show')
            ->with([
                'note' => $note,
            ])
        ;
    }

    public function edit($id)
    {
        $note = Note::find((int)$id)->toArray();

        return view('note.edit')
            ->with([
                'note' => $note,
            ])
        ;
    }

    public function update(Request $request, $id)
    {
        dd($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getNoteHandler(): NoteHandler
    {
        return app(NoteHandler::class);
    }
}
