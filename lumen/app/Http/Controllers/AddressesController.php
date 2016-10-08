<?php

namespace App\Address;

use App\Address;
use App\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AddressesController extends AddressesController
{
	public function index($ClientId)
	{
		if (!($client = Client::find($ClientId))){
			throw new ModelNotFoundException("Client requisitado não existe");
		}

		return son_respone()->make(Address::where('client_id', $clientId)->get());
	}

	public function show($id, $clientId)
	{
		if (!(Client::find($clientId))) {
			throw new ModelNotFoundException("Error Processing Request");
		}

		if (!(Address::find($id))) {
			throw new ModelNotFoundException("Endereço requisitado não existe");
		}

		$address = Address::where('client_id', $clientId)->where('id',$id)->get()->first();
		return son_respone()->make($address);
	}

	public function store(Request $request, $clientId)
	{
		if (!($client = Client::find($clientId))) {
			throw new Exception("Client requisitado não existe");
			
		}

		$this->validate($request, [
			'address'=> 'required',
			'city' 	 => 'required',
			'state'  => 'required',
			'zipcode'=> 'required'
		]);
		
		$address = $client->addresses()->create($request->all());
		$return son_respone()->make($address, 201);
	}

	public function update(Request $request, $id, $clientId)
	{
		if(!(Client::find($clientId))) {
			throw new ModelNotFoundException("Client requisitado não existe");
			
		}

		if(!(Address::find($id))) {
			throw new ModelNotFoundException("Endereço requisitado não existe");
			
		}

		$this->validate($request, [
			'address'=> 'required',
			'city' 	 => 'required',
			'state'  => 'required',
			'zipcode'=> 'required'
		]);

		$address = Address::where('client_id', $clientId)->where('id', $id)->get()->first();
		if(!$address) {
			throw new ModelNotFoundException("Endereço requisitado não existe");
		}
		$address->fill($request->all());
		$address->save();

		return son_respone()->make($address, 200);
	}

	public function destroy($id, $clientId)
	{
		if (!(Client::find($clientId))) {
			throw new ModelNotFoundException("Client requisitado não existe");
			
		}

		if (!(Address::find($id))) {
			throw new ModelNotFoundException("Endereço requisitado não existe");
			
		}
		$address = Address::where('client_id', $clientId)->where('id')->get()->first();

		if (!$address) {
			throw new ModelNotFoundException("Endereço requisitado não existe");
			
		}

		$address->delete();
		return son_respone()->make("",204);

	}

}