<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Future of Web Development with AI',
                'slug' => 'future-of-web-dev-with-ai',
                'content' => "## Introduction\nArtificial Intelligence is transforming how we build the web. From code generation to automated testing, AI tools are becoming indispensable.\n\n## Copilot and Beyond\nTools like GitHub Copilot and ChatGPT are changing the coding workflow. Developers can now focus more on architecture and less on boilerplate code.\n\n## Conclusion\nEmbracing AI is not just an option; it's a necessity for staying competitive in the modern tech landscape.",
                'thumbnail' => null,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Mastering Laravel Service Container',
                'slug' => 'mastering-laravel-service-container',
                'content' => "## What is the Service Container?\nThe Laravel Service Container is a powerful tool for managing class dependencies and performing dependency injection.\n\n## Dependency Injection\nUnderstanding DI is crucial for writing testable and maintainable code. Laravel makes this incredibly easy with its automatic resolution features.\n\n## Binding and Resolving\nLearn how to bind interfaces to implementations and resolve them anywhere in your application.",
                'thumbnail' => null,
                'published_at' => now()->subWeeks(2),
            ],
            [
                'title' => '10 Tips for scalable React Apps',
                'slug' => '10-tips-scalable-react-apps',
                'content' => "Building small React apps is easy, but scaling them requires discipline. Here are my top tips:\n\n1. **Component Structure**: Organize by feature, not type.\n2. **State Management**: Don't overengineer. Use Context for simple state.\n3. **Performance**: Use React.memo and useMemo wisely.\n4. **Testing**: Write integration tests with React Testing Library.\n5. **Typescript**: Just use it. It catches bugs before you run the code.",
                'thumbnail' => null,
                'published_at' => now()->subMonth(),
            ],
        ];

        foreach ($posts as $post) {
            Blog::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
