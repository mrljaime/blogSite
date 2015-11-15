<?php 

class UserController extends BaseController{

	public function index()
	{
		if(Auth::check()){
		$usuario = User::all();

		$useravatar = User::where('name', '=', Auth::user()->name);

		$data = array(
			'title' => 'Usuarios',
			'usuarios' => $usuario,
			'username' => Auth::user()->name,
			);

		return View::make('admin/user', $data);
		}else{
			return Redirect::to(('login'))
			->withErrors(array('Recuerda ingresar primero!'))
			->withInput();
		}
	}

	public function create()
	{	
		if(Auth::check()){
			$data = array(
				'title' => 'Crear usuario',
				'username' => Auth::user()->name,
				);
			return View::make('/admin/usercreate', $data);
		}else{
			return Redirect::to(route('login'))
			->withErrors(array('Recuerda ingresar primero!'))
			->withInput();
		}
	}

	public function store()
	{
		if (!empty(Input::get('username'))) {
			$userform = Input::get('username');
			$userbd = User::where('username' , '=', $userform)->get();
		} else {
			unset($userbd);
		}

		$rules = array(
				'name' => 'required',
				'apellido' => 'required',
				'email' => 'required',
				'username' => 'required',
				'password' => 'required',
			);

		$messages = array(
			'name.required' => 'Necesitamos tu nombre',
			'apellido.required' => 'Necesitamos tus apellidos',
			'email.required' => 'Necesitamos tu email o uno válido',
			'username.required' => 'Necesitamos tu nombre de usuario',
			'password.required' => 'Necesitamos tu contraseña!',
			);

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails()) {
				$messages = $validator->messages();
					return Redirect::to('admin/user/create')
				->withErrors($validator)
				->withInput();
		} else if ($userbd->isEmpty() == false){
			return Redirect::to('admin/user/create')->withErrors(array('msg' => 'Ese nombre de usuario ya se esta usando.', 'class' => 'bad'))->withInput();
		} else{


		$nombre = Input::get('name');
		$apellido = Input::get('apellido');
		$email = Input::get('email');
		$username = Input::get('username');
		$password = Input::get('password');
		$md5 = md5(Input::get('password'));
		$uid = uniqid();
		$avatar_uid = Input::get('value-image');
		$avatar_uid = !empty($avatar_uid) ? $avatar_uid : '5641101e115d1';

		$usuario = new User;
		$usuario->uid = $uid;
		$usuario->name = $nombre;
		$usuario->apellido = $apellido;
		$usuario->email = $email;
		$usuario->username = $username;
		$usuario->password = Hash::make(md5($password));
		$usuario->md5 = $md5;
		$usuario->avatar_uid = $avatar_uid;
		$usuario->save();



		return Redirect::to(route('admin.user'))->withErrors(array('msg' => 'Felicidades! Nuevo usuario creado!'));
		//return "Estamos probando";
		}
	}

	public function upload()
	{

		if(Input::hasFile('imagen')){

			$image = Input::file('imagen');

			$md5 = md5_file($image);

			$imagen = Avatar::whereMd5($md5)->get();

			if($imagen->isEmpty()){
				$ext = strtolower($image->getClientOriginalExtension());
				$uid = uniqid();
				$filename = $md5.'.'.$ext;

				$image->move('recursos', $filename);

				$picture = new Avatar;
				$picture->uid = $uid;
				$picture->md5 = $md5;
				$picture->url = $filename;
				$picture->save();

				$url = URL::asset('recursos/'. $filename);

				$status = array(
					'status' => 'success',
					'url' => $url,
					'id' => $uid,
					);
			}else{

					$imagen = Avatar::whereMd5($md5)->take(1)->get();
					$uid = $imagen[0]->uid;
					$url = URL::asset('recursos/'.$imagen[0]->url);

				$status = array(
					'status' => 'interrupted',
					'description' => 'El archivo ya existe',
					'url' => $url,
					'id' => $uid,
					);
			}
		}else{
		
		}
		return Response::json($status);
	}

	public function delete($uid)
	{

		$user = User::where('uid', '=', $uid)->take(1)->get();

		if(Auth::user()->username == $user[0]->username){
			return Redirect::to(route('admin.user'))->withErrors(array('msg' => 'Hey! No puedes eliminar al usuario activo'));
		}else{
			$user[0]->delete();
			return Redirect::to(route('admin.user'))->withErrors(array('msg' => 'Usuario eliminado correctamente'));
		}
	}

	public function edit($uid)
	{
		if (Auth::check()) {
		$user = User::where('uid', '=', $uid)->take(1)->get();

		$data = array(
			'title' => 'Editar usuario',
			'usuario' => $user[0],
			'username' => Auth::user()->name,
			);

		return View::make('admin/edituser', $data);
		} else {
			return Redirect::to('admin')
			->withErrors(array('Recuerda ingresar primero!'))
			->withInput();
		}
	}

	public function update($uid)
	{
		
		$rules = array(
			'name' => 'required',
			'apellido' => 'required',
			'email' => 'required',
			'username' => 'required',
			'old-password' => 'required',
			);

		$messages = array(
			'name.required' => 'Necesitamos tu nombre',
			'apellido.required' => 'Necesitamos tu apellido',
			'email.required' => 'Necesitamos tu email o uno valido',
			'username.required' => 'Es necesario para poder ingresar',
			'old-password.required' => 'Es necesario para poder hacer cambios',
			);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()){
			$messages = $validator->messages();
			return Redirect::route('user.edit', array('uid'=>$uid))->withErrors($validator)
			->withInput();
		} else {

			$user = User::where('uid', '=', $uid)->take(1)->get();
			$userbd = $user[0];
			$old_password = md5(Input::get('old-password'));

			if ($old_password == $userbd->md5){
				if (!empty(Input::get('password'))){
					
					$password = Hash::make(md5(Input::get('password')));
				
					$userbd->name = Input::get('name');
					$userbd->apellido = Input::get('apellido');
					$userbd->email = Input::get('email');
					$userbd->username = Input::get('username');
					$userbd->password = Hash::make(md5(Input::get('password')));
					$userbd->md5 = md5(Input::get('password'));
					$userbd->avatar_uid = Input::get('value-image');
					$userbd->save();

			return Redirect::to('admin/user')->withErrors(array('msg' => 'El usuario se editó correctamente'));
				}else{
					$userbd->name = Input::get('name');
					$userbd->apellido = Input::get('apellido');
					$userbd->email = Input::get('email');
					$userbd->username = Input::get('username');
					$userbd->avatar_uid = Input::get('value-image');
					$userbd->save();

					return Redirect::to('admin/user')->withErrors(array('msg' => 'El usuario se editó correctamente'));
				}

			} else {
					return Redirect::route('user.edit', array('uid'=>$uid))->withErrors(array('msg' => 'La contraseña antigua es incorrecta'));
			}
			}
	}
}