<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Carbon\Carbon;
class FakerServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    *
    * @return void
    */
    public function boot()
    {
        //
    }

    /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {
        //$this->app->singleton('Faker', function($app) {
        $this->app->singleton(FakerGenerator::class, function () {
            //$faker = \Faker\Factory::create('pt_BR');
            $faker = FakerFactory::create('pt_BR');
            $newClass = new class($faker) extends \Faker\Provider\Base {
                protected static $neighborhood = [
                    'Abadia','Alfredo Freire II','Alfredo Freire III','Amoroso Costa','Antônia Cândida I',
                    'Área Rural de Uberaba','Beija-Flor','Beija-Flor II','Bela Vista','Boa Vista','Bom Retiro',
                    'Capelinha do Barreiro','Centro','Chácaras Bouganville','Chácaras das Orquideas',
                    'Chácaras Mariitas','Chácaras Minas Gerais','Chácaras Morada do Verde','Chácaras Quintas Del Rey',
                    'Chácaras São Basílio','Chácaras Vila Real','Cidade Jardim','Cidade Nova','Cidade Ozanan',
                    'COHAB Boa Vista','Conjunto Alfredo Freire','Conjunto Antônio Barbosa de Souza',
                    'Conjunto Cássio Rezende','Conjunto Chica Ferreira','Conjunto Costa Telles I',
                    'Conjunto Costa Telles II','Conjunto Frei Eugênio','Conjunto Guanabara','Conjunto José Barbosa',
                    'Conjunto José Vallim de Melo','Conjunto Manoel Mendes','Conjunto Margarida Rosa de Azevedo',
                    'Conjunto Maringá I','Conjunto Maringá II','Conjunto Morada do Sol','Conjunto Pontal',
                    'Conjunto Sete Colinas','Conjunto Treze de Maio','Conjunto Uberaba','Conjunto Umuarama',
                    'Conquistinha','Cyrela Landscape','Damha Residencial Uberaba I','Damha Residencial Uberaba II',
                    'Deolinda Freire','Deolinda Laura','Distrito Industrial I','Distrito Industrial II',
                    'Distrito Industrial III','Distrito Industrial IV','Dom Eduardo','Estados Unidos',
                    'Estância dos Ipês','Estrela da Vitória','Europark','Fabrício','Flamboyant Residencial Park',
                    'Gleba Déa Maria','Gleba Santa Mônica','Grande Horizonte','Indianópolis','Irmãos Soares',
                    'Jardim Alexandre Campos','Jardim Alvorada','Jardim Amélia','Jardim América',
                    'Jardim Aquárius','Jardim Belo Horizonte','Jardim Bento de Assis Valim','Jardim Brasília',
                    'Jardim Califórnia','Jardim Canadá','Jardim Copacabana','Jardim do Lago','Jardim Eldorado',
                    'Jardim Elza Amuí I','Jardim Elza Amuí II','Jardim Elza Amuí III','Jardim Elza Amuí IV',
                    'Jardim Espanha','Jardim Espírito Santo','Jardim Esplanada','Jardim Imperador','Jardim Induberaba',
                    'Jardim Itália','Jardim Itália II','Jardim Maracanã','Jardim Maria Alice','Jardim Metrópole',
                    'Jardim Nenê Gomes','Jardim Primavera','Jardim Santa Clara','Jardim Santa Inez','Jardim São Bento',
                    'Jardim Terra Santa','Jardim Triângulo','Jardim Uberaba','Jockey Park','Josa Bernardino I',
                    'Josa Bernardino II','Leblon','Loteamento Craide','Loteamento das Américas',
                    'Loteamento das Gameleiras','Loteamento Guilherme Borges','Loteamento Jardim Santa Clara',
                    'Loteamento Petrópolis','Loteamento Residencial Cândida Borges','Lourdes','Mangueiras','Manhattan',
                    'Mercês','Mônica Cristina','Morada das Fontes','Nossa Senhora da Abadia','Novo Horizonte',
                    'Núcleo Habitacional Silvério Cartafina','Núcleo Residencial Tutunas','Olinda','Oneida Mendes',
                    'Pacaembu','Pacaembu II','Parque Colibri','Parque das Américas','Parque das Gameleiras',
                    'Parque das Laranjeiras','Parque do Café','Parque do Mirante','Parque dos Buritis',
                    'Parque dos Girassóis','Parque dos Ipês','Parque Exposição','Parque Hiléia','Parque São Geraldo',
                    'Peirópolis','Planalto','Portal Beija Flor','Portal do Sol','Princesa do Sertão',
                    'Quinta Boa Esperança','Recanto da Terra','Recanto das Flores','Recanto das Torres',
                    'Recanto do Sol','Recreio dos Bandeirantes','Residencial 2000','Residencial Alves Valim',
                    'Residencial Anita','Residencial Budeus','Residencial Doutor Abel Reis',
                    'Residencial Estados Unidos','Residencial Jardim Anatê I','Residencial Jardim Anatê II',
                    'Residencial Mário de Almeida Franco','Residencial Monte Castelo','Residencial Morada Du Park',
                    'Residencial Morumbi','Residencial Nova Era','Residencial Palmeiras','Residencial Paulo Cury',
                    'Residencial Presidente Tancredo Neves','Residencial Rio de Janeiro',
                    'Residencial Sebastião Rezende Braga','Residencial Terra Nova','Residencial Veneza','Santa Fé',
                    'Santa Maria','Santa Marta','Santa Rosa','Santos Dumont','São Benedito','São José','São Sebastião',
                    'Seriema','Serra do Sol','Serra Dourada','Tiago e Jéssica','Tita Rezende',
                    'Unidade de Planejamento e Gestão Urbana Portal','Univerdecidade','Universitário','Vale do Sol',
                    'Vila Alvorada','Vila Arquelau','Vila Boa Vista','Vila Celeste','Vila Ceres','Vila Craide',
                    'Vila Esperança','Vila Frei Eugênio','Vila Maria Helena','Vila Militar',
                    'Vila Nossa Senhora Aparecida','Vila Olímpica','Vila Presidente Vargas','Vila São Cristóvão',
                    'Vila São Cristóvão II','Vila São José','Vila São Vicente','Villaggio Di Fiori'
                ];

                protected static function generatePIN($digits = 4) {
                    $i = 0;
                    $pin = "";
                    while($i < $digits){
                        $pin .= mt_rand(0, 9);
                        $i++;
                    }

                    return $pin . Carbon::now()->format('Ymd');
                }

                public function neighborhood()
                {
                    return static::randomElement(static::$neighborhood);
                }

                public function contract()
                {
                    return static::generatePIN();
                }
            };

            $faker->addProvider($newClass);
            return $faker;
        });
    }
}
