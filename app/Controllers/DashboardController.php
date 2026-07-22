<?php
class DashboardController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $this->view('dashboard/index', ['title' => 'Dashboard']);
    }
}
