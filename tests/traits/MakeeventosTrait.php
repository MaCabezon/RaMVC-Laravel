<?php

use Faker\Factory as Faker;
use App\Models\eventos;
use App\Repositories\eventosRepository;

trait MakeeventosTrait
{
    /**
     * Create fake instance of eventos and save it in database
     *
     * @param array $eventosFields
     * @return eventos
     */
    public function makeeventos($eventosFields = [])
    {
        /** @var eventosRepository $eventosRepo */
        $eventosRepo = App::make(eventosRepository::class);
        $theme = $this->fakeeventosData($eventosFields);
        return $eventosRepo->create($theme);
    }

    /**
     * Get fake instance of eventos
     *
     * @param array $eventosFields
     * @return eventos
     */
    public function fakeeventos($eventosFields = [])
    {
        return new eventos($this->fakeeventosData($eventosFields));
    }

    /**
     * Get fake data of eventos
     *
     * @param array $postFields
     * @return array
     */
    public function fakeeventosData($eventosFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'abreviautra' => $fake->word,
            'nombre' => $fake->word,
            'grupo' => $fake->word,
            'nombreProfesor' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $eventosFields);
    }
}
