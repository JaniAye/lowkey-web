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
        $videos = [];
        $sampleTitles = [
            'Laravel for Beginners', 'Vue.js Crash Course', 'Understanding Docker', 'Python for Data Science',
            'Advanced CSS Techniques', 'Introduction to Kubernetes', 'Mastering Microservices', 'Building REST APIs with Node.js',
            'Data Analysis with Pandas', 'Machine Learning A-Z', 'Cybersecurity Fundamentals', 'Ethical Hacking Explained',
            'Game Development with Unity', 'Unreal Engine 5 Guide', 'Blender 3D Modeling', 'The Art of Photography',
            'Digital Painting Masterclass', 'Music Production in Ableton', 'Financial Markets Overview', 'Stock Trading Strategies',
            'Content Creation Bootcamp', 'YouTube Success Blueprint', 'Effective Communication Skills', 'Project Management Professional (PMP) Prep'
        ];
        $sampleUploaders = ['CodeMaster', 'FrontendGuru', 'DevOpsPro', 'DataScientist', 'DesignWizard', 'CloudNative', 'ApiArchitect', 'MLExpert'];
        $sampleTags = [['PHP', 'Laravel'], ['JS', 'Vue'], ['Docker', 'DevOps'], ['Python', 'Data'], ['CSS', 'Design'], ['K8s', 'Cloud'], ['Java', 'Spring'], ['Node.js', 'API']];

        for ($i = 1; $i <= 24; $i++) {
            $videos[] = [
                'id' => $i,
                'title' => $sampleTitles[$i - 1],
                'uploader' => $sampleUploaders[array_rand($sampleUploaders)],
                'price' => rand(10, 99),
                'tags' => $sampleTags[array_rand($sampleTags)],
                'thumbnail' => "https://via.placeholder.com/350x200?text=Video+{$i}:+" . urlencode(substr($sampleTitles[$i-1], 0, 20))
            ];
        }

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

    /**
     * Show the YouTube application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function youtubeHome()
    {
        // The index() method fetches videos and returns the 'home' view.
        // We want to reuse the video fetching logic but return a different view.
        $videos = [];
        $sampleTitles = [
            'Laravel for Beginners', 'Vue.js Crash Course', 'Understanding Docker', 'Python for Data Science',
            'Advanced CSS Techniques', 'Introduction to Kubernetes', 'Mastering Microservices', 'Building REST APIs with Node.js',
            'Data Analysis with Pandas', 'Machine Learning A-Z', 'Cybersecurity Fundamentals', 'Ethical Hacking Explained',
            'Game Development with Unity', 'Unreal Engine 5 Guide', 'Blender 3D Modeling', 'The Art of Photography',
            'Digital Painting Masterclass', 'Music Production in Ableton', 'Financial Markets Overview', 'Stock Trading Strategies',
            'Content Creation Bootcamp', 'YouTube Success Blueprint', 'Effective Communication Skills', 'Project Management Professional (PMP) Prep'
        ];
        $sampleUploaders = ['CodeMaster', 'FrontendGuru', 'DevOpsPro', 'DataScientist', 'DesignWizard', 'CloudNative', 'ApiArchitect', 'MLExpert'];
        $sampleTags = [['PHP', 'Laravel'], ['JS', 'Vue'], ['Docker', 'DevOps'], ['Python', 'Data'], ['CSS', 'Design'], ['K8s', 'Cloud'], ['Java', 'Spring'], ['Node.js', 'API']];

        for ($i = 1; $i <= 24; $i++) {
            $videos[] = [
                'id' => $i,
                'title' => $sampleTitles[$i - 1],
                'uploader' => $sampleUploaders[array_rand($sampleUploaders)],
                'price' => rand(10, 99), // Price is kept for now, can be removed/changed in view
                'tags' => $sampleTags[array_rand($sampleTags)],
                'thumbnail' => "https://via.placeholder.com/350x200?text=Video+{$i}:+" . urlencode(substr($sampleTitles[$i-1], 0, 20))
            ];
        }
        // Instead of calling $this->index() which returns view('home', ...),
        // we directly return the new view with the same data.
        return view('youtube.home', ['videos' => $videos]);
    }
}
