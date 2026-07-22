<?php

class OverviewController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();

        $user = User::selectById(1);
        $user->setPassword('konata12');
        $user->save();


        var_dump($user);
        die();

        $this->view('overview/index', [
            'title'   => 'Overview',
            'objects' => Collectable::dummyAll(),
        ]);
    }
}
