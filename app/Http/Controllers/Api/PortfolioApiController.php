<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioApiController extends Controller
{
    public function getProfile()
    {
        $profile = \App\Models\Profile::first();
        if($profile && $profile->hero_image) {
            $profile->hero_image = asset('storage/' . $profile->hero_image);
        }
        return response()->json($profile);
    }

    public function getProjects()
    {
        $projects = \App\Models\Project::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);
            
        $projects->getCollection()->transform(function ($project) {
            if($project->thumbnail) {
                $project->thumbnail = asset('storage/' . $project->thumbnail);
            }
            return $project;
        });
            
        return response()->json($projects);
    }

    public function getProject($slug)
    {
        $project = \App\Models\Project::where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();
            
        if($project->thumbnail) {
            $project->thumbnail = asset('storage/' . $project->thumbnail);
        }
            
        return response()->json($project);
    }

    public function getSkills()
    {
        $skills = \App\Models\Skill::all()->groupBy('category');
        
        $skills = $skills->map(function($categorySkills) {
            return $categorySkills->map(function($skill) {
                if($skill->icon) {
                     $skill->icon = asset('storage/' . $skill->icon);
                }
                return $skill;
            });
        });

        return response()->json($skills);
    }

    public function getExperiences()
    {
        $experiences = \App\Models\Experience::orderBy('start_date', 'desc')->get();
        return response()->json($experiences);
    }

    public function getPosts()
    {
        $posts = \App\Models\Blog::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);
            
        $posts->getCollection()->transform(function ($post) {
            if($post->thumbnail) {
                $post->thumbnail = asset('storage/' . $post->thumbnail);
            }
            if($post->additional_photos && is_array($post->additional_photos)) {
                $post->additional_photos = array_map(function($photo) {
                    return asset('storage/' . $photo);
                }, $post->additional_photos);
            }
            return $post;
        });

        return response()->json($posts);
    }

    public function getPost($slug)
    {
        $post = \App\Models\Blog::where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();
            
        if($post->thumbnail) {
            $post->thumbnail = asset('storage/' . $post->thumbnail);
        }
        
        if($post->additional_photos && is_array($post->additional_photos)) {
            $post->additional_photos = array_map(function($photo) {
                return asset('storage/' . $photo);
            }, $post->additional_photos);
        }
            
        return response()->json($post);
    }

    public function getAbout()
    {
        $about = \App\Models\About::first();
        
        $data = [
            'about_photo' => $about && $about->photo ? asset('storage/' . $about->photo) : null,
            'about_deskripsi' => $about ? $about->description : null,
            'about_univ' => $about ? $about->university : null,
            'GPA' => $about ? $about->gpa : null,
        ];

        return response()->json($data);
    }
}
