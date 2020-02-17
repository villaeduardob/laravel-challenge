<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Http\Requests\EventReuqest;
use App\Http\Controllers\Controller;

use App\Models\Events;

class EventsController extends Controller
{
	/**
	 * @var
	 */
	protected $user_id;


	public function __construct()
	{
		$this->user_id = Auth::id();
	}


	public function index()
	{
		$events = Events::select(
			'id', 'users_id', 'title', 'description',
			DB::raw('DATE_FORMAT(date_start, "%d/%m/%Y") date_start'),
			DB::raw('DATE_FORMAT(date_end, "%d/%m/%Y") date_end')
		)->where('users_id', $this->user_id)->get();
		return view('admin.events.index', [
			'events' => $events
		]);
	}
	

	public function create()
	{
		return view('admin.events.create', [
			'title_page' => 'Cadastrar novo evento',
			'action' => 'admin.events.store',
		]);
	}
	

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'date_start' => 'required',
			'date_end' => 'required',
        ]);

		$event = new Events;
		$event->title = $request->input('title');
		$event->description = $request->input('description');
		$event->date_start = \Carbon\Carbon::parse($request->input('date_start'))->format('Y-m-d');
		$event->date_end = \Carbon\Carbon::parse($request->input('date_end'))->format('Y-m-d');
		$event->users_id = $request->input('user_id');
        if ($event->save()) {

			return redirect()->route('admin.events.index')->with('class', 'success')->with('message', 'Evento cadastrado com sucesso!');
		
		} else {

			return redirect()->route('admin.events.create')->with('class', 'danger')->with('message', 'Não foi possível cadastrar o evento!');

		}
	}


	public function show($id)
	{
		$event = Events::findOrFail($id);
		if ($this->user_id !== $event->user_id) {
			return redirect('/events')->with('error', 'Acesso bloqueado');
		}

		return view('Events.show')->with('event', $event);
	}


	public function edit($id)
	{
		$event = Events::select(
			'id', 'users_id', 'title', 'description',
			DB::raw('DATE_FORMAT(date_start, "%d/%m/%Y") date_start'),
			DB::raw('DATE_FORMAT(date_end, "%d/%m/%Y") date_end')
		)->where('id', $id)->first();
		if ($event) {

			return view('admin.events.create', [
				'title_page' => 'Editar evento #' . $id,
				'action' => 'admin.events.update',
				'event' => $event,
			]);
		
		} else {
			return redirect()->route('admin.events.index')->with('class', 'danger')->with('message', 'Não foi possível editar o evento!');
		}

		
	}


	public function update(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'date_start' => 'required',
			'date_end' => 'required',
        ]);

		$event = Events::findOrFail($request->id);
		if ($event) {

			$event->title = $request->input('title');
			$event->description = $request->input('description');
			$event->date_start = \Carbon\Carbon::parse($request->date_start)->format('Y-m-d');
			$event->date_end = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d');
			if ($event->update()) {
				
				return redirect()->route('admin.events.index')->with('class', 'success')->with('message', 'Evento editado com sucesso!');
			
			} else {
				return redirect()->route('admin.events.create')->with('class', 'danger')->with('message', 'Não foi possível editar o evento!');
			}

		} else {
			return redirect()->route('admin.events.create')->with('class', 'danger')->with('message', 'Evento não localizado!');
		}
	}

	
	public function destroy($id)
	{
		$event = Events::findOrFail($id);
		if ($event) {

			$event->delete();
			return redirect()->route('admin.events.index')->with('class', 'success')->with('message', 'Evento excluído com sucesso!');
		
		} else {
			return redirect()->route('admin.events.index')->with('class', 'danger')->with('message', 'Não foi possível excluir o evento!');
		}
	}
}
