<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = [
            [
                'id' => 1,
                'title' => 'Laravel for Beginners',
                'uploader' => 'CodeMaster',
                'price' => 20,
                'tags' => ['PHP', 'Laravel', 'Web Development'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=Laravel+Course'
            ],
            [
                'id' => 2,
                'title' => 'Vue.js Crash Course',
                'uploader' => 'FrontendGuru',
                'price' => 25,
                'tags' => ['JavaScript', 'Vue.js', 'Frontend'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=Vue.js+Course'
            ],
            [
                'id' => 3,
                'title' => 'Understanding Docker',
                'uploader' => 'DevOpsPro',
                'price' => 30,
                'tags' => ['Docker', 'DevOps', 'Containers'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=Docker+Course'
            ],
            [
                'id' => 4,
                'title' => 'Python for Data Science',
                'uploader' => 'DataScientist',
                'price' => 35,
                'tags' => ['Python', 'Data Science', 'Machine Learning'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=Python+Course'
            ],
            [
                'id' => 5,
                'title' => 'Advanced CSS Techniques',
                'uploader' => 'DesignWizard',
                'price' => 15,
                'tags' => ['CSS', 'Web Design', 'Frontend'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=CSS+Course'
            ],
            [
                'id' => 6,
                'title' => 'Introduction to Kubernetes',
                'uploader' => 'CloudNative',
                'price' => 40,
                'tags' => ['Kubernetes', 'DevOps', 'Cloud'],
                'thumbnail' => 'https://via.placeholder.com/350x150?text=Kubernetes+Course'
            ],
        ];

        return view('home', ['videos' => $videos]);
    }

    /**
     * Show the individual video page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showVideo($id)
    {
        // In a real application, you would fetch video details from a database using $id
        // For now, we'll just pass the ID to the view.
        return view('video.show', ['videoId' => $id]);
    }
}
