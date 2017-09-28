<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 5; $i++) {

            $categoryData = [
                'slug' => 'test-category-' . $i,
                'status' => '1',
                'en' => [
                    'title' => 'Test category ' . $i,
                    'meta_title' => 'Test category ' . $i,
                    'meta_description' => 'This is a test category #' . $i . ' for testing the application',
                ],
                'ru' => [
                    'title' => 'Тестовая категория ' . $i,
                    'meta_title' => 'Тестовая категория ' . $i,
                    'meta_description' => 'Это тестовая категория №' . $i . ' для тестирования приложения',
                ],
            ];

            Category::create($categoryData);
        }

        for ($i = 1; $i <= 15; $i++) {

            $postData = [
                'slug' => 'test-post-' . $i,
                'published_at' => Carbon::now(),
                'status' => '1',
                'user_id' => rand(1,3),
                'en' => [
                    'title' => 'Test post blog post ' . $i,
                    'description' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p><p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>',
                    'meta_title' => 'Test post blog post ' . $i,
                    'meta_description' => 'This is a test blog post #' . $i . ' for testing the application',
                ],
                'ru' => [
                    'title' => 'Тестовый пост для блога ' . $i,
                    'description' => '<p>Lorem ipsum – псевдо-латинский текст, который используется для веб дизайна, типографии, оборудования, и распечатки вместо английского текста для того, чтобы сделать ударение не на содержание, а на элементы дизайна.</p><p>Это очень удобный инструмент для моделей (макетов). Он помогает выделить визуальные элементы в документе или презентации, например текст, шрифт или разметка.</p><p>Lorem ipsum по большей части является элементом латинского текста классического автора и философа Цицерона. </p>',
                    'meta_title' => 'Тестовый пост для блога ' . $i,
                    'meta_description' => 'Это тестовый пост для блога №' . $i . ' для тестирования приложения',
                ],
            ];

            $post = Post::create($postData);

            $post->categories()->attach(rand(1,5));

            for ($k = 1; $k <= 3; $k++) {

                $comment = new Comment([
                    'comment' => 'It is a comment #' . $k . ' for testing the application for the post:"' . $post->id . '"',
                    'status' => '1',
                    'user_id' => rand(1,3),
                    'user_type' => 'App\Models\User',
                ]);

                $post->comments()->save($comment);

            }

        }

    }
}
