<?php 
	$GLOBALS['contador'] = true;

class indexController extends BaseController
{

	public function index()
	{
		if(Auth::check()){

			$usuario = User::where('name', '=', Auth::user()->name)->take(1)->get();

			$data = array(
				'title' => 'Inicio',
				'username' => Auth::user()->name,
				);
			return View::make('admin/admin', $data);
		}else{
			return Redirect::to('admin')
			->withErrors(array('Recuerda ingresar primero!'))
			->withInput();
		}
	}

	public function dologin()
	{
		if(Auth::check()){
			$data = array(
				'title' => 'Inicio',
				'username' =>  Auth::user()->name,
				);
			return Redirect::to(route('admin.index', $data));
		}else{
			$data = array('contador' => $GLOBALS['contador']);
			return View::make('admin/login', $data);
		}

	}

	public function login()
	{	
		$usuario = Input::get('username');
		$password = Input::get('password');
		$_token = Input::get('_token');

		$attempt = Auth::attempt(array(
				'username' => $usuario,
				'password' => md5($password),
			));

		if($attempt){
			$data = array(
				'title' => 'Inicio',
				'username' =>  Auth::user()->name,
				);
			return Redirect::to(route('admin.index', $data));
		}else{
			return Redirect::to('admin')
			->withErrors(array('El usuario o la contraseña estan incorrectos'))
			->withInput();
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}

	public function registro()
	{
		$nombre = Input::get('name');
		$apellido = Input::get('apellido');
		$email = Input::get('email');
		$username = Input::get('username');
		$password = Input::get('password');
		$uid = uniqid();

		$usuario = new User;

		$usuario->uid = $uid;
		$usuario->name = $nombre;
		$usuario->apellido = $apellido;
		$usuario->email = $email;
		$usuario->username = $username;
		$usuario->password = Hash::make(md5($password));
		$usuario->md5 = md5($password);
		$usuario->save();

		$GLOBALS['contador'] = true;

		return Redirect::to(route('admin.index'));
	}
}