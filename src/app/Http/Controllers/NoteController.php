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
        $notes = Note::all()->toArray();
        return view('note.index')
        ->with([
            'notes' => $notes,
        ])
        ;
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

            $data = $note->toArray();
;
            return redirect()->route('note.index');
  

        } catch(Exception $ex) {
            // return redirect()->back();
        }
    }

    public function edit($id)
    {
        $note = Note::find($id)->get()->toArray();

        // dd(888,$note);
        return view('note.edit', ['note'=>$note, 'id'=> $note['id']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(222);
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
