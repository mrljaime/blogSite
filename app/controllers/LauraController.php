<?php

class LauraController extends BaseController{

    public function index()
    {
        if (Auth::check()){
            $data = array(
                'title' => 'Inicio',
                'username' => Auth::user()->name,
            );
            return View::make('admin/laura', $data);
        }else{
            return Redirect::to('admin')
                ->withErrors(array('Recuerda ingresar primero!'))
                ->withInput();
        }
    }

    public function intro()
    {
        $intro = Laura::take(1)->get();
        $title = $intro[0]->title;
        $description = $intro[0]->description;

        $notes = Note::where('user_uid', '=', '56441cee979d5')->orderBy('created_at', 'desc')->get();

        $data = array(
            'title' => 'Laura-Intro',
            'username' => Auth::user()->name,
            'titulo' => $title,
            'description' => $description,
            'notes' => $notes
        );

        return View::make('admin/laura_intro', $data);
    }

}