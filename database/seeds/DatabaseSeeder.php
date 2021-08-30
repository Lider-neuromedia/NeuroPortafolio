<?php

use App\Answer;
use App\Brief;
use App\Category;
use App\Client;
use App\ClientBrief;
use App\Link;
use App\Project;
use App\ProjectAsset;
use App\Question;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->seedUsers();

        // Portafolio
        $this->seedCategories();
        $this->seedTestProjects();
        $this->seedLinks();

        // Brief
        $this->seedBriefs();
    }

    public function seedUsers()
    {
        if (User::where('email', 'inge1neuro@gmail.com')->exists()) {
            return;
        }

        User::create([
            'name' => 'Jose Nieto',
            'email' => 'inge1neuro@gmail.com',
            'password' => \Hash::make("secret"),
        ]);
    }

    public function seedCategories()
    {
        $categories = [
            'Logos',
            'Identidad Corporativa',
            'Fotografia ',
            'Campañas ',
            'Paginas web',
            'Tiendas virtuales',
            'Desarrollo de software',
            'App móviles',
            'Redes sociales',
            'Pauta digital',
            'Estudios de mercado',
            'Diseño 3D',
            'BTL y Eventos',
            'Streaming ',
            'Video Animacion',
        ];

        if (Category::count() > 0) {
            return;
        }

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => \Str::slug($category),
            ]);
        }
    }

    public function seedTestProjects()
    {
        if (Project::count() > 0) {
            return;
        }

        $videos = [
            'https://www.youtube.com/watch?v=q4Zk9rZrgME',
            'https://www.youtube.com/watch?v=RxVs4al0Vm4',
            'https://www.youtube.com/watch?v=Jafr1wyEeS0',
            'https://www.youtube.com/watch?v=-w1SMAjXWWc',
            'https://www.youtube.com/watch?v=Ar4k9IzTKTQ',
            'https://www.youtube.com/watch?v=_YybasYUz9c',
            'https://www.youtube.com/watch?v=V6biU1uCA48',
            'https://www.youtube.com/watch?v=3nEyt_heKjA',
            'https://www.youtube.com/watch?v=D26nKDe8LEY',
            'https://www.youtube.com/watch?v=_Vmn_qbUrvs',
            'https://www.youtube.com/watch?v=R0moFGxQ_Ck',
            'https://www.youtube.com/watch?v=LJthdJOpa6U',
            'https://www.youtube.com/watch?v=5intp-cAk-w',
            'https://www.youtube.com/watch?v=uFiy4CBBXWE',
            'https://www.youtube.com/watch?v=7jzruMiyeec',
        ];

        $faker = Factory::create();

        for ($i = 1; $i <= 30; $i++) {
            $categories = Category::query()
                ->inRandomOrder()
                ->take($faker->numberBetween(1, 3))
                ->get()
                ->map(function ($category) {
                    return $category->id;
                })
                ->toArray();

            $project = factory(Project::class)->create();
            $project->categories()->sync($categories);

            // Videos
            for ($j = 0; $j < $faker->numberBetween(0, 3); $j++) {
                $project->assets()->save(
                    new ProjectAsset([
                        'path' => $videos[$faker->numberBetween(0, count($videos) - 1)],
                        'type' => ProjectAsset::VIDEO_ASSET,
                    ])
                );
            }

            // Logo
            $project->assets()->save($this->getProjectLogo());

            // Imagenes
            $project->assets()->saveMany($this->getProjectImages());
        }
    }

    private function getProjectLogo()
    {
        $files = \Storage::files('public/projects');
        $files = collect($files)->filter(function ($file, $key) {
            $filename = array_reverse(explode('/', $file))[0];
            return strpos($filename, 'icon-') === 0;
        });
        $file = $files->random(1)->first();
        return new ProjectAsset([
            'path' => array_reverse(explode('/', $file))[0],
            'type' => ProjectAsset::LOGO_ASSET,
        ]);
    }

    private function getProjectImages()
    {
        $list = [];
        $faker = Factory::create();
        $files = \Storage::files('public/projects');
        $files = collect($files)->filter(function ($file, $key) {
            $filename = array_reverse(explode('/', $file))[0];
            return strpos($filename, 'icon-') === false;
        });

        for ($k = 0; $k < $faker->numberBetween(1, 5); $k++) {
            $file = $files->random(1)->first();
            $list[] = new ProjectAsset([
                'path' => array_reverse(explode('/', $file))[0],
                'type' => ProjectAsset::IMAGE_ASSET,
            ]);
        }

        return $list;
    }

    public function seedLinks()
    {
        if (Link::count() > 0) {
            return;
        }

        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $projects = Project::query()
                ->inRandomOrder()
                ->take($faker->numberBetween(2, 10))
                ->get()
                ->map(function ($project) {
                    return $project->id;
                })
                ->toArray();

            $slug = Link::generateUniqueSlug();
            $link = new Link(['slug' => $slug]);
            $link->save();
            $link->projects()->sync($projects);
        }
    }

    // Brief

    public function seedBriefs()
    {
        if (Brief::count() > 0) {
            return;
        }

        $faker = Factory::create();

        $client1 = Client::create(['name' => 'Centelsa']);
        $client2 = Client::create(['name' => 'Gane']);
        $client3 = Client::create(['name' => 'Montana']);

        $brief = Brief::create(['name' => 'Marketing']);

        $brief->questions()->saveMany([
            $this->openQuestion('¿Cúal es la respuesta a esta pregunta?'),
            $this->openAreaQuestion('¿Cúal es la respuesta a esta pregunta larga?'),
            $this->seleccionQuestion('¿Cúales de estas son frutas?', ['Tomate', 'Aguacate', 'Manzana', 'Mango', 'Naranja'], true),
            $this->seleccionQuestion('¿Cúantas horas han pasado?', ['Cinco horas', 'Diez horas', 'Cuatro horas'], false),
            $this->openQuestion('¿Por qué hay otra pregunta?'),
            $this->seleccionQuestion('¿Cúales de estos son colores calidos?', ['Azul', 'Rojo', 'Amarrillo', 'Verde'], true),
            $this->seleccionQuestion('¿Cúantos continentes hay?', ["Cinco", "Siete"], false),
        ]);

        $client_brief = new ClientBrief([
            'status' => ClientBrief::STATUS_PENDING,
            'slug' => \Str::slug(\Str::random(64)),
        ]);
        $client_brief->client()->associate($client1);
        $client_brief->brief()->associate($brief);
        $client_brief->save();

        foreach ($brief->questions as $question) {
            $asw = [""];

            if ($question->isOpen() || $question->isOpenArea()) {
                $asw = [
                    "Respuesta aleatoria " . \Str::random(34) . " " . \Str::random(34),
                ];
            } else if ($question->isMultipleSelection()) {
                $asw = array_unique([
                    $question->options[$faker->numberBetween(0, count($question->options) - 1)],
                    $question->options[$faker->numberBetween(0, count($question->options) - 1)],
                ]);
            } else if ($question->isUniqueSelection()) {
                $asw = [
                    $question->options[$faker->numberBetween(0, count($question->options) - 1)],
                ];
            }

            $answer = new Answer([
                'question' => $question->question,
                'answer' => $asw,
            ]);
            $answer->clientBrief()->associate($client_brief);
            $answer->question()->associate($question);
            $answer->save();
        }
    }

    private function openQuestion($question)
    {
        return new Question([
            'question' => $question,
            'type' => Question::QUESTION_OPEN,
        ]);
    }

    private function openAreaQuestion($question)
    {
        return new Question([
            'question' => $question,
            'type' => Question::QUESTION_OPEN_AREA,
        ]);
    }

    private function seleccionQuestion($question, $options, $is_multiple)
    {
        return new Question([
            'question' => $question,
            'type' => $is_multiple ? Question::QUESTION_MULTIPLE : Question::QUESTION_UNIQUE,
            'options' => $options,
        ]);
    }
}
