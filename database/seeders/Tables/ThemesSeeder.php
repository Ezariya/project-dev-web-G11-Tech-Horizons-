<?php
namespace Database\Seeders\Tables;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Command :
         * artisan seed:generate --table-mode --tables=themes
         *
         */

        $dataTables = [
            [
                'id' => 1,
                'name' => 'Machine Learning & AI',
                'description' => 'Explorez le monde des algorithmes d’apprentissage automatique, de l’apprentissage profond, des réseaux neuronaux, de l’apprentissage par renforcement et de leurs applications dans divers secteurs.',
                'responsable_id' => 10,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:48:08',
            ],
            [
                'id' => 2,
                'name' => 'Natural Language Processing (NLP]',
                'description' => 'Découvrez le domaine du PNL qui implique l\'interaction entre les ordinateurs et le langage humain, en vous concentrant sur des tâches telles que l\'analyse des sentiments, les modèles linguistiques et la traduction automatique.',
                'responsable_id' => 12,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:48:39',
            ],
            [
                'id' => 3,
                'name' => 'Computer Vision',
                'description' => 'Comprendre comment les machines peuvent être formées pour interpréter et analyser les données visuelles, notamment la reconnaissance d’images, la détection d’objets, la reconnaissance faciale et la réalité augmentée (AR].',
                'responsable_id' => 12,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:48:58',
            ],
            [
                'id' => 4,
                'name' => 'Data Science',
                'description' => 'Découvrez les concepts clés de l\'analyse de données, de la visualisation de données, de l\'analyse prédictive, du Big Data et de l\'ingénierie des données. Apprenez à transformer des données brutes en informations utiles pour la prise de décision.',
                'responsable_id' => 25,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:49:23',
            ],
            [
                'id' => 5,
                'name' => 'Web Development',
                'description' => 'Maîtrisez l\'art de créer des sites Web et des applications Web. Les sujets abordés couvrent à la fois le front-end (UI/UX, React.js] et le back-end (Node.js, bases de données], le développement full-stack et la sécurité Web.',
                'responsable_id' => 11,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:49:43',
            ],
            [
                'id' => 6,
                'name' => 'DevOps & Cloud',
                'description' => 'Comprendre les pratiques et les outils permettant d\'automatiser les processus entre le développement logiciel et les opérations informatiques. Découvrez les plateformes de cloud computing telles qu\'AWS, Azure, GCP, la conteneurisation et les pipelines CI/CD.',
                'responsable_id' => 14,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:50:06',
            ],
            [
                'id' => 7,
                'name' => 'Cybersecurity',
                'description' => 'Protégez vos systèmes, vos réseaux et vos données contre les attaques numériques. Ce thème couvre des sujets tels que la sécurité des réseaux, la cryptographie, le piratage éthique et la sécurisation des applications Web et des infrastructures cloud.',
                'responsable_id' => 10,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:50:26',
            ],
            [
                'id' => 8,
                'name' => 'Crypto & Blockchain',
                'description' => 'Apprenez-en plus sur la technologie blockchain, les crypto-monnaies comme Bitcoin et Ethereum, les contrats intelligents, la finance décentralisée (DeFi], les NFT et les aspects de sécurité des réseaux blockchain.',
                'responsable_id' => 10,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:50:50',
            ],
            [
                'id' => 9,
                'name' => 'Mobile Development',
                'description' => 'Découvrez les outils et techniques de création d\'applications mobiles pour iOS (Swift] et Android (Kotlin], le développement multiplateforme (Flutter, React Native] et l\'optimisation des performances des applications mobiles.',
                'responsable_id' => 25,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:51:16',
            ],
            [
                'id' => 10,
                'name' => 'Tech News & Trends',
                'description' => 'Restez informé des dernières tendances technologiques, notamment des développements en matière d’IA, de cloud computing, de cybersécurité, de langages de programmation et d’innovations qui façonnent l’industrie technologique.',
                'responsable_id' => 10,
                'created_at' => '2025-01-28 18:42:03',
                'updated_at' => '2025-01-29 12:51:35',
            ]
        ];
        
        DB::table("themes")->insert($dataTables);
    }
}